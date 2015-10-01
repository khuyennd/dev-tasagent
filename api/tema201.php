<?php
/**
 * Created by PhpStorm.
 * User: zhangyang
 * Date: 15/6/11
 * Time: 下午2:10
 */
define('IN_TAS', true);

require(dirname(__FILE__) . '/../config/config.inc.php');
$passwd = trim(Tools::getValue('LoginPass'));
$username = trim(Tools::getValue('LoginID'));
//
$shubetsu = trim(Tools::getValue('Shubetsu'));
$daystart = trim(Tools::getValue('DayStart'));
$dayend = trim(Tools::getValue('DayEnd'));
if (empty($username) || $username == "User Name")
    Tools::echo_str('"NG","User ID required"');
elseif (empty($passwd))
    Tools::echo_str('"NG","Password is required"');
elseif (Tools::strlen($passwd) > 32)
    Tools::echo_str('"NG","Password is too long"');
elseif (empty($shubetsu))
    Tools::echo_str('"NG","Shubetsu is required"');
elseif (empty($daystart))
    Tools::echo_str('"NG","DayStart is required"');
elseif (empty($dayend))
    Tools::echo_str('"NG","DayEnd is required"');

else {
    $passwd = str_replace(' ', '+', trim($passwd));
    $day_start = str_replace('/', '-', trim($daystart));
    $day_end = str_replace('/', '-', trim($dayend));
    $member = new Member();
    $authentication = $member->getByLoginUserName(trim($username), trim($passwd));
    if (!$authentication OR !$member->UserID) {
        /* Handle brute force attacks */
        sleep(1);
        Tools::echo_str('"NG","Login failed"');
    } else {
        if ($member->IsActive == 0) {
            Tools::echo_str('"NG","Not Activated User"');
        } else if ($member->IsDelete == 1) {
            Tools::echo_str('"NG","Deleted User"');
        } else {
            ob_clean();
            if ($member->RoleID == 1) {
                //:201
                if ($shubetsu == '1') {
                    $sql = "
                    SELECT
	OrderId
FROM
	`HT_Order`
WHERE
	(
		HotelId = {$member->HotelId}
		AND CheckInDate >= '$day_start'
		AND CheckOutDate <= '$day_end'
	)
OR (
	HotelId = {$member->HotelId}
	AND CheckOutDate >= '$day_start'
	AND CheckOutDate <= '$day_end'
)
OR (
	HotelId = {$member->HotelId}
	AND CheckInDate >= '$day_start'
	AND CheckInDate <= '$day_end'
)";
                } elseif ($shubetsu == '2') {
                    $sql = "
                    SELECT
	OrderId
FROM
	HT_Order
WHERE
	last_time >= '$day_start 00:00:00'
AND last_time <= '$day_end 23:59:59'
AND HotelId = {$member->HotelId}";

                } else {
                    Tools::echo_str('"NG","Shubetsu Error!"');
                }
                //echo $sql;
                $result = Db::getInstance()->ExecuteS($sql);

                if (count($result) == 0) {
                    Tools::echo_str('');
                } else {
                    foreach ($result as $r) {
                        $order_id = $r['OrderId'];
                        $sql = "
                       SELECT
	*
FROM
	HT_OrderRoom odr
LEFT JOIN HT_Order o ON odr.OrderId = o.OrderId
WHERE
	o.OrderId = $order_id";
                        $res = Db::getInstance()->ExecuteS($sql);
                        $i = 1;
                        foreach ($res as $room) {
                            //住宿人信息
                            $sql = "
SELECT
	*, (
		SELECT
			count(*)
		FROM
			HT_OrderCustomer
		WHERE
			OrderRoomId = {$room['OrderRoomId']}
		AND CustomerSex = 1
	) AS man,
	(
		SELECT
			count(*)
		FROM
			HT_OrderCustomer
		WHERE
			OrderRoomId = {$room['OrderRoomId']}
		AND CustomerSex = 0
	) AS woman
FROM
	HT_OrderCustomer
	INNER join HT_Country ON HT_OrderCustomer.CustomerCountryId=HT_Country.CountryId
WHERE
	OrderRoomId = {$room['OrderRoomId']} ";

                            $persons = Db::getInstance()->ExecuteS($sql);
                            $p1 = $persons[0]['CustomerFamilyName'] . ' ' . $persons[0]['CustomerGivenName'].'('.$persons[0]['CountryName_jp'].')';
                            $cp = count($persons);
                            $order_person_info_str = '';
                            foreach ($persons as $p) {
                                if ($p['CustomerSex'] == 1) {
                                    $sex = 'Mr.';
                                } elseif ($p['CustomerSex'] == 0) {
                                    $sex = 'Mrs.';
                                }
                                $order_person_info_str .= $sex . $p['CustomerFamilyName'] . ' ' . $p['CustomerGivenName'] .'('.$p['CountryName_jp']. '),ZZ';
                            }

                            //RoomPlan
                            $sql = "
                            SELECT
	*
FROM
	HT_RoomPlan
WHERE
	RoomPlanId=" . $room['RoomPlanId'];
                            $RoomPlans = Db::getInstance()->ExecuteS($sql);
                            $room_type = $RoomPlans[0]['RoomTypeId'];
                            if ($RoomPlans[0]['Breakfast'] == 1) {
                                $order_person_info_str .= "Breakfast(朝食): Yes,ZZ";
                            } elseif ($RoomPlans[0]['Breakfast'] == 0) {
                                $order_person_info_str .= "Breakfast(朝食): None,ZZ";
                            }
                            if ($RoomPlans[0]['Dinner'] == 1) {
                                $order_person_info_str .= "Dinner(夕食): Yes,ZZ";
                            } elseif ($RoomPlans[0]['Dinner'] == 0) {
                                $order_person_info_str .= "Dinner(夕食): None,ZZ";
                            }
                            $order_person_info_str .= "Special Request(特別リクエスト):";
                            if ($room['SpecialRequestNoSmoking'] == 1) {
                                $order_person_info_str .= "NoSmoking ";
                            }
                            if ($room['SpecialRequestSmoking'] == 1) {
                                $order_person_info_str .= "Smoking ";
                            }
                            $order_person_info_str .=  ",ZZ";
                            if ($room['SpecialRequestRemark'] != '') {
                                $room['SpecialRequestRemark']=str_replace("\r",',ZZ',$room['SpecialRequestRemark']);
                                $room['SpecialRequestRemark']=str_replace("\n",',ZZ',$room['SpecialRequestRemark']);
                                $room['SpecialRequestRemark']=str_replace(",ZZ,ZZ",',ZZ',$room['SpecialRequestRemark']);
                                $order_person_info_str .= $room['SpecialRequestRemark'] . ",ZZ";
                            }
                            // agent info
                            $sql = "
                            SELECT
	u.`Name`,
	u.Email AS uemail,
	u.tel AS utel,
	c.CompanyName,
	c.City,
	c.Address,
	c.Website,
	c.ManagingDirector,
	c.Tel AS ctel,
	c.fax AS cfax,
	c.AgentID,
	con.CountryName_jp,
	con.ContinentCode
FROM
	HT_User u
LEFT JOIN HT_Company c ON u.CompanyID = c.CompanyId
LEFT JOIN HT_Country con ON c.CountryId = con.CountryId
WHERE
	UserID = " . $room['OrderUserId'];
                            $agent = Db::getInstance()->ExecuteS($sql);
                            $agent = $agent[0];
                            //预约种别
                            $order_type='B';
                            $cancel_Date='';
                            if($room['OrderStatusId']=='7'||$room['OrderStatusId']=='5'){
                                $order_type='C';
                                $cancel_Date=$room['last_time'];
                            }
                            if($room['OrderStatusId']=='6'){
                                $order_type='M';
                            }
                            //部屋毎情報
                            //时间差计算

                            $Date_List_a1 = explode("-", $room['CheckOutDate']);

                            $Date_List_a2 = explode("-", $room['CheckInDate']);

                            $d1 = mktime(0, 0, 0, $Date_List_a1[1], $Date_List_a1[2], $Date_List_a1[0]);

                            $d2 = mktime(0, 0, 0, $Date_List_a2[1], $Date_List_a2[2], $Date_List_a2[0]);

                            $Days = round(($d1 - $d2) / 3600 / 24);
                            $room_info_str='';
                            $day = $room['CheckInDate'];
                            for ($j = 1; $j <= $Days; $j++) {
                                $sql = "
SELECT
	*
FROM
	`HT_RoomStockAndPrice`
WHERE
	RoomPlanId = {$room['RoomPlanId']}
AND ApplyDate = '$day'";
                                $dps = Db::getInstance()->ExecuteS($sql);
                                $dps = $dps[0];
                                $price = 0;
                                if ($agent['ContinentCode'] == 'AS' && (int)$dps['Asia'] != 0 && $dps['Asia'] != '') {
                                    $price = (int)$dps['Asia'];
                                } else if ($agent['ContinentCode'] == 'EU' && (int)$dps['Euro'] != 0 && $dps['Euro'] != '') {
                                    $price = (int)$dps['Euro'];
                                } else {
                                    $price = (int)$dps['Price'];
                                }
                                $room_info_str .= $day . '[' . $j . '泊目] 1室目 大人' . $cp . '名(男性' . $persons[0]['man'] . '名 女性' . $persons[0]['woman'] . '名) 合計' . $price . '円';
                                if ($j != $Days) {
                                    $room_info_str .= ',ZZ';
                                }
                                $day = date('Y-m-d', strtotime("{$room['CheckInDate']} +$j day"));
                            }

                            //开始输出
                            echo '"' . $room['BookingNo'] . '-' . $i . '","' .$order_type . '","' . $p1 . '","",';
                            echo '"' . $room['CheckInDate'] . '","' . $room['CheckOutDate'] . '","1","' . $cp . '","0",';
                            echo '"' . (int)$room['OrgPrice'] . '","'.$room['ContactPhoneNumber'] .'","'.$room['ContactEmail'] .'","' . $room['RoomPlanId'] . '","' . $room['RoomPlanId'] . '",';
                            echo '"' . $room['OrderedDate'] . '","' . $cancel_Date . '","' . $room['ContactPhoneNumber'] . '","","","","' . $room['ContactPhoneNumber'] . '",';
                            echo '"' . $persons[0]['man'] . '","' . $persons[0]['woman'] . '",';
                            echo '"' . $order_person_info_str . '","",';
                            echo '"' . $agent['CompanyName'] . ' ' . $agent['Name'] . '","","' . $agent['CountryName_jp'] . '","' . $agent['utel'] . '","","' . $agent['uemail'] . '","","",';
                            echo '"' . $agent['CompanyName'] . '","' . $agent['CountryName_jp'] . $agent['City'] . $agent['Address'] . '","' . $agent['ctel'] . '","' . $agent['cfax'] . '","0","0",';
                            echo '"' . ((int)$room['paymentMethod']+1). '","' . (int)$room['OrgPrice'] . '","'.$room_info_str.'"';
                            $i++;
                            echo "\r\n";
                        }

                    }
                }
            } else {
                Tools::echo_str('"NG","Not a hotel"');
            }
        }
    }
}