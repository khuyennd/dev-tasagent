<?php
/**
 * Created by PhpStorm.
 * User: zhangyang
 * Date: 15/5/12
 * Time: 下午3:09
 */
define('IN_TAS', true);

require(dirname(__FILE__) . '/../config/config.inc.php');
$passwd = trim(Tools::getValue('LoginPass'));
$username = trim(Tools::getValue('LoginID'));
$heyaid = trim(Tools::getValue('HeyaID'));
if (empty($username) || $username == "User Name")
    Tools::echo_str('"NG","User ID required"');
elseif (empty($passwd))
    Tools::echo_str('"NG","Password is required"');
elseif (Tools::strlen($passwd) > 32)
    Tools::echo_str('"NG","Password is too long"');
elseif (empty($heyaid))
    Tools::echo_str('"NG","HeyaID is required"');

else {
    $passwd = str_replace(' ', '+', trim($passwd));
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
                $sql = "SELECT
	count(*) AS c
FROM
	`HT_HotelRoomPlanLink`
WHERE
	HotelId = {$member->HotelId}
AND RoomPlanId = " . $heyaid;
                $result = Db::getInstance()->ExecuteS($sql);

                if ($result[0]['c'] == '1') {

                    $sql = "
SELECT
	*
FROM
	HT_RoomPlan
WHERE
	RoomPlanId =" . $heyaid;

                    $result = Db::getInstance()->ExecuteS($sql);
                    if ($result && $result[0]) {
                        ob_clean();
                        foreach ($result as $row) {

                            $count = 1;
//                            if ($row['RoomTypeId'] == '2' || $row['RoomTypeId'] == '3' || $row['RoomTypeId'] == '4')
//                                $count = 2;
//                            elseif ($row['RoomTypeId'] == '5')
//                                $count = 3;
//                            elseif ($row['RoomTypeId'] == '6')
//                                $count = 4;

                            echo '"' . $row['RoomPlanId'] . '","' . $row['RoomPlanName_jp'] . '","' .
                                str_replace(' 00:00:00', '', str_replace('-', '/', $row['StartTime'])) . '-' .
                                str_replace(' 00:00:00', '', str_replace('-', '/', $row['EndTime'])) .
                                '","1","' . $count . '","RC"' . "\r\n";
                        }
                        exit;
                    } else {
                        Tools::echo_str('"NG","Not have result"');
                    }
                } else {
                    Tools::echo_str('"NG","Hotel not have this room"');
                }
                //echo '"OK"';
            } else {
                Tools::echo_str('"NG","Not a hotel"');

            }
        }
    }
}