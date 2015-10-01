<?php
/**
 * Created by PhpStorm.
 * User: zhangyang
 * Date: 15/5/6
 * Time: 下午1:23
 */
define('IN_TAS', true);

require(dirname(__FILE__).'/../config/config.inc.php');
$passwd = trim(Tools::getValue('LoginPass'));
$username = trim(Tools::getValue('LoginID'));
if (empty($username) || $username == "User Name")
    Tools::echo_str('"NG","User ID required"');
elseif (empty($passwd))
    Tools::echo_str('"NG","Password is required"');
elseif (Tools::strlen($passwd) > 32)
    Tools::echo_str('"NG","Password is too long"');

else
{
    $member = new Member();
    $passwd=str_replace(' ','+',trim($passwd));

    $authentication = $member->getByLoginUserName(trim($username), trim($passwd));
    //echo $authentication;
    if (!$authentication OR !$member->UserID)
    {
        /* Handle brute force attacks */
        sleep(1);
        Tools::echo_str('"NG","Login failed"');
       // Tools::echo_str(str_replace(' ','+',trim($passwd)));
    }
    else
    {
        if ($member->IsActive == 0) {
            Tools::echo_str('"NG","Not Activated User"');
        } else if ($member->IsDelete == 1) {
            Tools::echo_str('"NG","Deleted User"');
        } else {
            if ($member->RoleID == 1) {
                Tools::echo_str('"OK"');

            } else {
                Tools::echo_str('"NG","Not a hotel"');

            }

        }
    }
}