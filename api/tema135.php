<?php
/**
 * Created by PhpStorm.
 * User: zhangyang
 * Date: 15/6/11
 * Time: 下午2:13
 */
define('IN_TAS', true);

require(dirname(__FILE__) . '/../config/config.inc.php');
$passwd = trim(Tools::getValue('LoginPass'));
$username = trim(Tools::getValue('LoginID'));
$heyaid = trim(Tools::getValue('HeyaID'));
$daystart = trim(Tools::getValue('DayStart'));
$dayend = trim(Tools::getValue('DayEnd'));
$planid = trim(Tools::getValue('PlanID'));
if (empty($username) || $username == "User Name")
    Tools::echo_str('"NG","User ID required"');
elseif (empty($passwd))
    Tools::echo_str('"NG","Password is required"');
elseif (Tools::strlen($passwd) > 32)
    Tools::echo_str('"NG","Password is too long"');
elseif (empty($heyaid))
    Tools::echo_str('"NG","HeyaID is required"');
elseif (empty($daystart))
    Tools::echo_str('"NG","DayStart is required"');
elseif (empty($dayend))
    Tools::echo_str('"NG","DayEnd is required"');
elseif (empty($planid))
    Tools::echo_str('"NG","PlanID is required"');
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

            if ($member->RoleID == 1) {
                $sql = "
SELECT
	count(*) AS c
FROM
	`HT_HotelRoomPlanLink` hrpl
LEFT JOIN HT_RoomPlan rp ON hrpl.RoomPlanId=rp.RoomPlanId
WHERE
	hrpl.HotelId = {$member->HotelId} AND liaojin=1
AND hrpl.RoomPlanId = $planid";
                $result = Db::getInstance()->ExecuteS($sql);

                if ($result[0]['c'] == '1') {
                    ob_clean();
                    //时间差计算
                    $Date_List_a1 = explode("-", $day_end);

                    $Date_List_a2 = explode("-", $day_start);

                    $d1 = mktime(0, 0, 0, $Date_List_a1[1], $Date_List_a1[2], $Date_List_a1[0]);

                    $d2 = mktime(0, 0, 0, $Date_List_a2[1], $Date_List_a2[2], $Date_List_a2[0]);

                    $Days = round(($d1 - $d2) / 3600 / 24);
                    //开始输出
                    echo '"' . $heyaid . '","' . $planid . '","' . $daystart . '","' . $dayend . '","0","1",';
                    for ($i = 0; $i <= $Days; $i++) {
                        //判断时间
                        $day = date('Y-m-d', strtotime("$day_start +$i day"));

                        echo '"OP","RC",';
                        //读取库存
                        $sql = "
SELECT
	*
FROM
	HT_RoomStockAndPrice
WHERE
	RoomPlanId = $planid
AND ApplyDate = '$day'";
                        $result = Db::getInstance()->ExecuteS($sql);
                        $price = $result[0]['Price'];
                        if ($price == '') {
                            $price = 0;
                        }
                        if ($i == $Days)
                            echo '"' . $price . '"';
                        else
                            echo '"' . $price . '",';
                    }

                } else {
                    Tools::echo_str('"NG","Hotel not have this room"');
                }
            } else {
                Tools::echo_str('"NG","Not a hotel"');
            }
        }
    }
}