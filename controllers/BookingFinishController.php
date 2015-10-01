<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class BookingFinishController extends FrontController
{
	
	public function __construct()
	{
		$this->php_self = "booking_finish.php";
		
		
		parent::__construct();
	}
	public function preProcess()
	{
		parent::preProcess();
		
		// if (!Tools::hasFunction('room_plan_edit')) Tools::redirect('index.php');

		
	}
	
	public function process()
	{
		global $cookie;
		
		parent::process();
	}
	
	
	public function setMedia() {
		parent::setMedia();
		
	}
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display(_TAS_THEME_DIR_.'booking_finish.tpl');
	}
}
