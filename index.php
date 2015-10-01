<?php
/*
* 2012 TAS
*/
define('IN_TAS', true);
//echo 111;
//die();
require(dirname(__FILE__).'/config/config.inc.php');
// $smarty->testInstall();
ControllerFactory::getController('IndexController')->run();
