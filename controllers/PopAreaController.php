<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class PopAreaController extends FrontController
{
	
	public function __construct()
	{
		$this->php_self = "poparea.php";
		parent::__construct();
	}
	public function preProcess()
	{
		if (!Tools::hasFunction("popular_area")) Tools::redirect("index.php");
		$this->brandNavi[] = array("name"=>"Popular Area Edit", "url"=>$this->php_self);
		parent::preProcess();
		
		if (Tools::isSubmit("Submit")) {
			$fidList = $_POST['fids'] == '' ? '' : $_POST['fids'];
			Db::getInstance()->Execute("update HT_Area set IsPopular = 0");
			if (is_array($fidList)) {
				foreach ($fidList as $aid) {
					Db::getInstance()->Execute("update HT_Area set IsPopular = 1 where AreaId = ".$aid);
				}
			}
		}
		
		$areaList = Db::getInstance()->ExecuteS('
		select  *, AreaName_'.$this->iso.' as AreaName from `HT_Area` where CountryId = 109');
		self::$smarty->assign("areaList", $areaList);
	}
	public function displayContent() {
		parent::displayContent();	
		
		self::$smarty->display(_TAS_THEME_DIR_.'poparea.tpl');
	}
	
}
