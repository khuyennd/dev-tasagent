<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ZhangYang
 * Date: 13-5-14
 * Time: 上午11:24
*/

if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class PoliciesController extends FrontController
{
	public function __construct()
	{
		$this->php_self = "policies.php";
		$this->auth = false;
		$this->content_only = true;
		parent::__construct();
	}

	public function process()
	{
		parent::process();

	}

	public function displayContent()
	{
		parent::displayContent();

	 self::$smarty->display(_TAS_THEME_DIR_.'policies.tpl');
	}

	public function setMedia()
	{
		parent::setMedia();
		Tools::addJS(_THEME_JS_DIR_.'jquery.validate.js');
	}
}
