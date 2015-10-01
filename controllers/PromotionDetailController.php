<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}

class PromotionDetailController extends FrontController
{
	public function __construct()
	{
		$this->php_self = "promotiondetail.php";
		parent::__construct();
	}
	
	public function preProcess()
	{
		//parent::preProcess();
		
		$id = Tools::getValue('PromotionId');
		if($id == '0' || Tools::isEmpty($id))
			exit();
		
		
		$promotion = new Promotion();
		$promotion -> getById($id);
		
		//promotion list navigation
		$navi_url = "promotionlist.php?type=".$promotion->Type;
		$navi_name = ( $promotion->Type == Promotion::$TYPE_PROMOTION)?'Promotion List':'Event List';
		$this->brandNavi[] = array("name"=>$navi_name, "url"=>$navi_url);
		
		//promotoin detail navigation
		$navi_url = $this->php_self."?PromotionId=".$id;
		$navi_name = $promotion -> Title;
		$this->brandNavi[] = array("name"=>$promotion -> Title, "url"=>$navi_url, "nolang" =>1);
		
		$fields = $promotion->getAsArray();
		$fields['Content'] = urldecode($fields['Content']);
		self::$smarty -> assign("data",$fields);
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display(_TAS_THEME_DIR_.'promotiondetail.tpl');
	}
	
}