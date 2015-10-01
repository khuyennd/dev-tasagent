<?php
/**
 * Created by PhpStorm.
 * User: zhangyang
 * Date: 15/5/12
 * Time: 下午2:17
 */
define('IN_TAS', true);

require(dirname(__FILE__) . '/../config/config.inc.php');
$passwd = trim(Tools::getValue('LoginPass'));
$username = trim(Tools::getValue('LoginID'));
if (empty($username) || $username == "User Name")
    Tools::echo_str('"NG","User ID required"');
elseif (empty($passwd))
    Tools::echo_str('"NG","Password is required"');
elseif (Tools::strlen($passwd) > 32)
    Tools::echo_str('"NG","Password is too long"');

else {
    $passwd=str_replace(' ','+',trim($passwd));
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
	HT_RoomPlan.RoomPlanId,HT_RoomType.RoomTypeName_jp
FROM
	HT_HotelRoomPlanLink
LEFT JOIN HT_RoomPlan ON HT_RoomPlan.RoomPlanId = HT_HotelRoomPlanLink.RoomPlanId
LEFT JOIN HT_RoomType ON HT_RoomPlan.RoomTypeId = HT_RoomType.RoomTypeId
WHERE
	HT_HotelRoomPlanLink.HotelId = " . $member->HotelId;

                $result = Db::getInstance()->ExecuteS($sql);
                if ($result && $result[0]) {
                    ob_clean();
                    foreach ($result as $row) {

                        echo '"' . $row['RoomPlanId'] . '","' . $row['RoomTypeName_jp'] . '"' . "\r\n";
                    }
                    exit;
                } else {
                    Tools::echo_str('"NG","Not have result"');
                }
                //echo '"OK"';
            } else {
                Tools::echo_str('"NG","Not a hotel"');

            }
        }
    }
}