<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class CompanyInfoController extends FrontController
{
	public function __construct()
	{
		$this->php_self = "companyinfo.php";
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
		self::$smarty->display(_TAS_THEME_DIR_.'companyinfo.tpl');
	}
}
