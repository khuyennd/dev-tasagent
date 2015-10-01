<?php
/**
 * Created by PhpStorm.
 * User: zhangyang
 * Date: 15/6/11
 * Time: 下午2:14
 */
define('IN_TAS', true);

require(dirname(__FILE__) . '/../config/config.inc.php');
$passwd = trim(Tools::getValue('LoginPass'));
$username = trim(Tools::getValue('LoginID'));

$heyaid = trim(Tools::getValue('HeyaID'));
$Nengetsu = trim(Tools::getValue('Nengetsu'));
if (empty($username) || $username == "User Name")
    Tools::echo_str('"NG","User ID required"');
elseif (empty($passwd))
    Tools::echo_str('"NG","Password is required"');
elseif (Tools::strlen($passwd) > 32)
    Tools::echo_str('"NG","Password is too long"');
elseif (empty($heyaid))
    Tools::echo_str('"NG","HeyaID is required"');
elseif (empty($Nengetsu))
    Tools::echo_str('"NG","Nengetsu is required"');

else {
    $passwd = str_replace(' ', '+', trim($passwd));
    $ny = str_replace('/', '-', trim($Nengetsu));
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
	hrpl.HotelId = {$member->HotelId} AND zaiku=1
AND hrpl.RoomPlanId = $heyaid";
                $result = Db::getInstance()->ExecuteS($sql);

                if ($result[0]['c'] == '1') {
                    for ($i = 1; $i <= 31; $i++) {
                        if ($i < 10) {
                            $day = "$ny-0$i";
                            $amount = trim(Tools::getValue('Zaiko0' . $i));
                        } else {
                            $day = "$ny-$i";
                            $amount = trim(Tools::getValue('Zaiko' . $i));
                        }

                        echo $i . '-' . $amount . "\r\n";

                        if ($amount == '') {
                            continue;
                        }
                        if ($amount == '-999') {
                            $amount = 0;
                        }

                        $sql = "
                        SELECT
	RoomPriceId
FROM
	HT_RoomStockAndPrice
WHERE
	ApplyDate = '$day'
AND RoomPlanId = $heyaid";
                        $result = Db::getInstance()->ExecuteS($sql);
                        $rpid = $result[0]['RoomPriceId'];

                        if ($rpid != '') {
                            $sql = "
UPDATE HT_RoomStockAndPrice
SET Amount = $amount
WHERE
	RoomPriceId = $rpid";
                        } else {
                            $sql = "
INSERT INTO HT_RoomStockAndPrice (roomplanid, applydate, amount)
VALUES
	($heyaid, '$day', $amount)";
                        }
                        echo $sql . "\r\n";
                        $result = Db::getInstance()->ExecuteS($sql);
                    }
                    Tools::echo_str('"OK"');
                } else {
                    Tools::echo_str('"NG","Hotel not have this room"');
                }
            } else {
                Tools::echo_str('"NG","Not a hotel"');
            }
        }
    }
}