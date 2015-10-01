<?php
/*
* 2012 TAS
*/
define('IN_TAS', true);
require(dirname(__FILE__).'/config/config.inc.php');
// $smarty->testInstall();
ControllerFactory::getController('BookingListController')->run();
