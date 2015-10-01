<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
/* Debug only */
//error_reporting(E_ALL);
@ini_set('display_errors', 'off');
define('_TAS_DEBUG_SQL_', false);

$start_time = microtime(true);

/* Compatibility warning */
define('_TAS_DISPLAY_COMPATIBILITY_WARNING_', false);
define('UPLOAD_DIR', dirname(dirname(__FILE__)).'/asset');
//define('UPLOAD_DIR', dirname(__FILE__).'/asset');
//define('UPLOAD_DIR', dirname(__FILE__).'/../../asset');

/* Improve PHP configuration to prevent issues */
ini_set('upload_max_filesize', '120M');
ini_set('default_charset', 'utf-8');
ini_set('magic_quotes_runtime', 0);

// correct Apache charset (except if it's too late
if (!headers_sent())
	header('Content-Type: text/html; charset=utf-8');

require_once(dirname(__FILE__).'/settings.inc.php');

/* Include all defines */
require_once(dirname(__FILE__).'/defines.inc.php');

/* Autoload */
require_once(dirname(__FILE__).'/autoload.php');

/* Redefine REQUEST_URI if empty (on some webservers...) */
if (!isset($_SERVER['REQUEST_URI']) OR empty($_SERVER['REQUEST_URI']))
{
	if (substr($_SERVER['SCRIPT_NAME'], -9) == 'index.php' && empty($_SERVER['QUERY_STRING']))
		$_SERVER['REQUEST_URI'] = dirname($_SERVER['SCRIPT_NAME']).'/';
	else
	{
		$_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'];
		if (isset($_SERVER['QUERY_STRING']) AND !empty($_SERVER['QUERY_STRING']))
			$_SERVER['REQUEST_URI'] .= '?'.$_SERVER['QUERY_STRING'];
	}
}

/* Trying to redefine HTTP_HOST if empty (on some webservers...) */
if (!isset($_SERVER['HTTP_HOST']) OR empty($_SERVER['HTTP_HOST']))
	$_SERVER['HTTP_HOST'] = @getenv('HTTP_HOST');

/* aliases */
function p($var) {
	return (Tools::p($var));
}
function d($var) {
	Tools::d($var);
}

function ppp($var) {
	return (Tools::p($var));
}
function ddd($var) {
	Tools::d($var);
}

global $_MODULES;
$_MODULES = array();

/* Load all language definitions */
Language::loadLanguages();

/* Smarty */
require_once(dirname(__FILE__).'/smarty.config.inc.php');
/* Possible value are true, false, 'URL'
 (for 'URL' append SMARTY_DEBUG as a parameter to the url)
 default is false for production environment */
define('SMARTY_DEBUG_CONSOLE', true);

/*paypal */
define("DEFAULT_DEV_CENTRAL", "developer");
define("DEFAULT_ENV", "sandbox");
define("DEFAULT_EMAIL_ADDRESS", "takaya.tomose-facilitator@tas-japan.net");
//define("DEFAULT_IDENTITY_TOKEN", "6vwLEY_ogPGnoQac2a0x4PRsSGrmzJPMkyGbJtpiCSwrkYsNSYxWfPY2ZLO");
//define("DEFAULT_EWP_CERT_PATH", "cert/my-pubcert.pem");
//define("DEFAULT_EWP_PRIVATE_KEY_PATH", "cert/my-prvkey.pem");
//define("DEFAULT_EWP_PRIVATE_KEY_PWD", "password");
//define("DEFAULT_CERT_ID", "B62GVU8RWNBFC");
//define("PAYPAL_CERT_PATH", "cert/paypal_cert_pem.txt");
//define("BUTTON_IMAGE", "https://www.paypal.com/en_US/i/btn/x-click-but23.gif");
define("DEFAULT_PAYMENT_CURRENCY", "JPY");
define("PAYPAL_IPN_LOG", _TAS_LOGS_DIR_.'paypal-ipn-'.strftime("%Y_%m_%d").'.log');
define("RETURN_URL", "http://tas-agent.com/");
define("NOTIFY_URL", "http://tas-agent.com:80/ipnlisten.php");

define("DOMAIN", "tas-agent.com");
