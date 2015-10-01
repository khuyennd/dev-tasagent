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
$Nengetsu = trim(Tools::getValue('Mon'));
$planid = trim(Tools::getValue('PlanID'));
if (empty($username) || $username == "User Name")
    Tools::echo_str('"NG","User ID required"');
elseif (empty($passwd))
    Tools::echo_str('"NG","Password is required"');
elseif (Tools::strlen($passwd) > 32)
    Tools::echo_str('"NG","Password is too long"');
elseif (empty($heyaid))
    Tools::echo_str('"NG","HeyaID is required"');
elseif (empty($Nengetsu))
    Tools::echo_str('"NG","Mon is required"');
elseif (empty($planid))
    Tools::echo_str('"NG","PlanID is required"');
///$heyaid=$planid;
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
	hrpl.HotelId = {$member->HotelId} AND liaojin=1
AND hrpl.RoomPlanId = $heyaid";
                $result = Db::getInstance()->ExecuteS($sql);

                if ($result[0]['c'] == '1') {
                    for ($i = 1; $i <= 31; $i++) {
                        if ($i < 10) {
                            $day = "$ny-0$i";
                            $price = trim(Tools::getValue('Ryokin1_0' . $i));
                        } else {
                            $day = "$ny-$i";
                            $price = trim(Tools::getValue('Ryokin1_' . $i));
                        }

                        echo $i . '-' . $price . "\r\n";

                        if ($price == '') {
                            continue;
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
SET Price = $price,Asia=0,Euro=0
WHERE
	RoomPriceId = $rpid";
                        } else {
                            $sql = "
INSERT INTO HT_RoomStockAndPrice (roomplanid, applydate, amount,price)
VALUES
	($heyaid, '$day', 0,$price)";
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