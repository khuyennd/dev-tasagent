<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ZhangYang
 * Date: 13-4-10
 * Time: 下午12:13
*/
define('IN_TAS', true);
require(dirname(__FILE__).'/config/config.inc.php');
ControllerFactory::getController('IpnListenController')->run();
