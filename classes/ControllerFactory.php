<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class ControllerFactory
{
	public static function includeController($className)
	{
		if (!class_exists($className, false))
		{	
			require_once(dirname(__FILE__).'/../controllers/'.$className.'.php');
			
			$class = new ReflectionClass($className);
		}
	}

	public static function getController($className, $auth = false, $ssl = false)
	{
		ControllerFactory::includeController($className);
		return new $className($auth, $ssl);
	}
}