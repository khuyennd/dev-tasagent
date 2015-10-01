<?php
	define('IN_TAS', true);
	require(dirname(__FILE__).'/config/config.inc.php');
	
	ControllerFactory::getController('PromotionDetailController')->run();