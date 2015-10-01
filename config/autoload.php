<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
function __autoload($className)
{
	if (function_exists('smartyAutoload') AND smartyAutoload($className))
		return true;

	$className = str_replace(chr(0), '', $className);
	$file_in_classes = file_exists(_TAS_CLASS_DIR_.$className.'.php');
	$file_in_models = file_exists(_TAS_MODEL_DIR_.$className.'.php');
	if ($file_in_classes)
	{
		require_once(_TAS_CLASS_DIR_.str_replace(chr(0), '', $className).'.php');
	} else if ($file_in_models) 
	{
		require_once(_TAS_MODEL_DIR_.str_replace(chr(0), '', $className).'.php');
	}
}

