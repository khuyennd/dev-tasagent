<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
define('_TAS_SMARTY_DIR_', _TAS_TOOL_DIR_.'smarty/');

require_once(_TAS_SMARTY_DIR_.'Smarty.class.php');

global $smarty;
$smarty = new Smarty();
$smarty->template_dir = _TAS_THEME_DIR_.'tpl';
$smarty->compile_dir = _TAS_SMARTY_DIR_.'compile';
$smarty->cache_dir = _TAS_SMARTY_DIR_.'cache';
$smarty->config_dir = _TAS_SMARTY_DIR_.'configs';
$smarty->caching = false;
$smarty->force_compile = false;
$smarty->compile_check = true;
$smarty->debugging = false; 
$smarty->debugging_ctrl = 'URL'; // 'NONE' on production
$smarty->deprecation_notices = false; // so many depreciated yet not migrated smarty calls

/*
if (Configuration::get('PS_HTML_THEME_COMPRESSION'))
	$smarty->registerFilter('output', 'smartyMinifyHTML');
if (Configuration::get('PS_JS_HTML_THEME_COMPRESSION'))
	$smarty->registerFilter('output', 'smartyPackJSinHTML');
*/

smartyRegisterFunction($smarty, 'modifier', 'truncate', 'smarty_modifier_truncate');
smartyRegisterFunction($smarty, 'modifier', 'secureReferrer', array('Tools', 'secureReferrer'));

smartyRegisterFunction($smarty, 'function', 't', 'smartyTruncate'); // unused
smartyRegisterFunction($smarty, 'function', 'm', 'smartyMaxWords'); // unused
smartyRegisterFunction($smarty, 'function', 'p', 'smartyShowObject'); // Debug only
smartyRegisterFunction($smarty, 'function', 'd', 'smartyDieObject'); // Debug only
smartyRegisterFunction($smarty, 'function', 'l', 'smartyTranslate');

smartyRegisterFunction($smarty, 'function', 'dateFormat', array('Tools', 'dateFormat'));
smartyRegisterFunction($smarty, 'function', 'displayPrice','displayPriceSmarty');
//smartyRegisterFunction($smarty, 'modifier', 'convertAndFormatPrice', array('Product', 'convertAndFormatPrice')); // used twice

function smartyTranslate($params, &$smarty)
{
	global $_LANG, $cookie;
	
	$string = str_replace('\'', '\\\'', $params['s']);
	
	$key = '';
	
	$filename = ((!isset($smarty->compiler_object) OR !is_object($smarty->compiler_object->template)) ? $smarty->template_filepath : $smarty->compiler_object->template->getTemplateFilepath());
	
	$pref_key = Tools::substr(basename($filename), 0, -4).'_'.$string;
	$key = $string;
	$lang_array = $_LANG;
	if (is_array($lang_array) AND key_exists($pref_key, $lang_array)) {
		$msg = $lang_array[$pref_key];
	} else if (is_array($lang_array) AND key_exists($key, $lang_array)) {
		$msg = $lang_array[$key];
	}
	elseif (is_array($lang_array) AND key_exists(Tools::strtolower($key), $lang_array))
		$msg = $lang_array[Tools::strtolower($key)];
	else {
		$msg = $params['s'];

		/**************************** Begin **************/
		@include(_TAS_THEME_DIR_.'lang/new.php');			//This file will be create
		global $_NEW_LANG;
		$lang_new = $_NEW_LANG;
		if(!array_key_exists($msg, $lang_new)) {
			$data = "\t\$_NEW_LANG['" . $msg . "'] = '';\n";
			file_put_contents(_TAS_THEME_DIR_.'lang/new.php', $data, FILE_APPEND);	//FILE_APPEND 
		}
		/***************************** End ***************/
	}
	
	if ($msg != $params['s'])
		$msg = $params['js'] ? addslashes($msg) : stripslashes($msg);
	return $params['js'] ? $msg : Tools::htmlentitiesUTF8($msg);
}

function smartyDieObject($params, &$smarty)
{
	return Tools::d($params['var']);
}

function smartyShowObject($params, &$smarty)
{
	return Tools::p($params['var']);
}

function smartyMaxWords($params, &$smarty)
{
	Tools::displayAsDeprecated();
	$params['s'] = str_replace('...', ' ...', html_entity_decode($params['s'], ENT_QUOTES, 'UTF-8'));
	$words = explode(' ', $params['s']);
	
	foreach($words AS &$word)
		if(Tools::strlen($word) > $params['n'])
			$word = Tools::substr(trim(chunk_split($word, $params['n']-1, '- ')), 0, -1);

	return implode(' ',  Tools::htmlentitiesUTF8($words));
}

function smartyTruncate($params, &$smarty)
{
	Tools::displayAsDeprecated();
	$text = isset($params['strip']) ? strip_tags($params['text']) : $params['text'];
	$length = $params['length'];
	$sep = isset($params['sep']) ? $params['sep'] : '...';

	if (Tools::strlen($text) > $length + Tools::strlen($sep))
		$text = Tools::substr($text, 0, $length).$sep;

	return (isset($params['encode']) ? Tools::htmlentitiesUTF8($text, ENT_NOQUOTES) : $text);
}

function smarty_modifier_truncate($string, $length = 80, $etc = '...', $break_words = false, $middle = false, $charset = 'UTF-8')
{
	if (!$length)
		return '';
 
	if (Tools::strlen($string) > $length)
	{
		$length -= min($length, Tools::strlen($etc));
		if (!$break_words && !$middle)
			$string = preg_replace('/\s+?(\S+)?$/u', '', Tools::substr($string, 0, $length+1, $charset));
		return !$middle ? Tools::substr($string, 0, $length, $charset).$etc : Tools::substr($string, 0, $length/2, $charset).$etc.Tools::substr($string, -$length/2, $length, $charset);
	}
	else
		return $string;
}


function smartyPackJSinHTML($tpl_output, &$smarty)
{
    $tpl_output = Tools::packJSinHTML($tpl_output);
    return $tpl_output;
}

function smartyRegisterFunction($smarty, $type, $function, $params)
{
	if (!in_array($type, array('function', 'modifier')))
		return false;
    $smarty->{'register_'.$type}($function, $params); // or keep a backward compatibility if PHP version < 5.1.2
}

function displayPriceSmarty ($params, &$smarty) {
	$price = str_replace('\'', '\\\'', $params['s']);
	$nomark = (int)$params['nomark'];
	$ret = ($nomark ?  "" : "￥").number_format($price, 0, '.', ',');
	return $ret;
}