<?php
/*
* 2012 TAS
*/
define('IN_TAS', true);
//echo "1";
require(dirname(__FILE__).'/config/config.inc.php');
//echo "2";die;
ControllerFactory::getController('LoginController')->run();
