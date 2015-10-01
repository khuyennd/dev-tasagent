<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class RoomPlanSalesController extends FrontController
{
	
	public function __construct()
	{
		$this->php_self = "roomplanedit.php";
		
		
		parent::__construct();
	}
	public function preProcess()
	{
		parent::preProcess();
		// if (!Tools::hasFunction('room_plan_edit')) Tools::redirect('index.php');

		
		$rpid = Tools::getValue("rpid");
		
		$roomplan_sales = RoomPlan::getRoomPlanSales($rpid);
		// $roomplan_sales['Nights'] =(strtotime($roomplan_sales['ConToTime']) - strtotime($roomplan_sales['ConFromTime'])) / (24 * 60 * 60); // diff day
		
		self::$smarty->assign("roomplan_sales", $roomplan_sales);
		
		parent::displayContent();
		self::$smarty->display(_TAS_THEME_DIR_.'roomplan_sales.tpl');
		
		exit();
	}
	
	public function process()
	{
		global $cookie;
		
		parent::process();
		
	}
	
	
	public function setMedia() {
		parent::setMedia();
		
		Tools::addJS(_THEME_JS_DIR_.'slider.js');
		Tools::addJS(_THEME_JS_DIR_.'slides.min.jquery.js');
		Tools::addJS(_THEME_JS_DIR_.'jquery.slide.js');
		Tools::addJS(_THEME_JS_DIR_.'jquery.form.js');
	}
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display(_TAS_THEME_DIR_.'roomplan_sales.tpl');
	}
}
