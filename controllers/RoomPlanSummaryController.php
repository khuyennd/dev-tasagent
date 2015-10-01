<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class RoomPlanSummaryController extends FrontController
{
	
	public function __construct()
	{
		$this->php_self = "roomplan_summary.php";
		
		
		parent::__construct();
	}
	public function preProcess()
	{
		parent::preProcess();
		// if (!Tools::hasFunction('room_plan_edit')) Tools::redirect('index.php');

		
		$rpid = Tools::getValue("rpid");
        $price = Tools::getValue("price");
		
		$roomplan_summary = RoomPlan::getRoomPlanSummary($rpid);
		
		self::$smarty->assign("roomplan_summary", $roomplan_summary);
        self::$smarty->assign('price', $price);
		
		parent::displayContent();
		self::$smarty->display(_TAS_THEME_DIR_.'roomplan_summary.tpl');
		
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
		self::$smarty->display(_TAS_THEME_DIR_.'roomplan_summary.tpl');
	}
}
