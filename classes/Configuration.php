<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class Configuration 
{
	
	public static function get($option)
	{
		if ($option == 'TAS_LANG_DEFAULT') 
			return 0;
		else if ($option == 'TAS_ITEMS_PER_PAGE') 
			return 20;
	} 
}

