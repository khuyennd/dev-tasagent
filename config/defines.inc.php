<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
define('_TAS_MODE_DEV_', false);

$currentDir = dirname(__FILE__);

if (!defined('PHP_VERSION_ID'))
{
    $version = explode('.', PHP_VERSION);
    define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
}

define('__TAS_BASE_URI__', '/');
/* Theme URLs */
define('_THEME_DIR_',     __TAS_BASE_URI__.'themes/default/');
define('_THEME_IMG_DIR_',  _THEME_DIR_.'img/');
define('_THEME_CSS_DIR_',  _THEME_DIR_.'css/');
define('_THEME_JS_DIR_',   _THEME_DIR_.'js/');

/* Image URLs */

/* Other URLs */

/* Directories */
define('_TAS_ROOT_DIR_',             realpath($currentDir.'/..'));
define('_TAS_CLASS_DIR_',            _TAS_ROOT_DIR_.'/classes/');
define('_TAS_MODEL_DIR_',            _TAS_ROOT_DIR_.'/models/');
define('_TAS_CONTROLLER_DIR_',       _TAS_ROOT_DIR_.'/controllers/');
define('_TAS_THEME_DIR_',            _TAS_ROOT_DIR_.'/themes/default/');
define('_TAS_TOOL_DIR_',             _TAS_ROOT_DIR_.'/tools/');
define('_TAS_LOGS_DIR_',             _TAS_ROOT_DIR_.'/logs/');
/* FCK Editor Directory */
define('_TAS_CKEDITOR_DIR_', _TAS_TOOL_DIR_.'/ckeditor/');

/* PHP Excel Directory */
define('_TAS_PHPEXCEL_DIR_', _TAS_TOOL_DIR_.'/PHPExcel/');

define('_CAN_LOAD_FILES_', 1);


if (!defined('_TAS_MAGIC_QUOTES_GPC_'))
	define('_TAS_MAGIC_QUOTES_GPC_', get_magic_quotes_gpc());
if (!defined('_TAS_MYSQL_REAL_ESCAPE_STRING_'))
	define('_TAS_MYSQL_REAL_ESCAPE_STRING_', function_exists('mysql_real_escape_string'));

