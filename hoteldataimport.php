<?php
	define('IN_TAS', true);
	require(dirname(__FILE__).'/config/config.inc.php');
	
	//import php excel engine
	require_once (_TAS_PHPEXCEL_DIR_.'PHPExcel.php');
	ControllerFactory::getController('HotelDataImportController')->run();