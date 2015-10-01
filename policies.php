<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ZhangYang
 * Date: 13-5-14
 * Time: 上午11:23
*/
define('IN_TAS', true);
require(dirname(__FILE__).'/config/config.inc.php');
//$smarty->testInstall();
ControllerFactory::getController('PoliciesController')->run();