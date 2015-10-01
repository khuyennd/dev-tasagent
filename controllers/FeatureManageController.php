<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class FeatureManageController extends FrontController
{
	protected  $searchField = array ('FeatureName' => 'like', 'FeatureType' => '=');
	protected  $FeatureType = array( 1 => "Hotel Facilities", 2 => "Room Facilities", 3 => "Transfer");
	
	public function __construct()
	{
		$this->php_self = "featuremanage.php";
		parent::__construct();
	}
	public function preProcess()
	{
		if (!Tools::hasFunction('feature_manage')) Tools::redirect('index.php');
		$this->brandNavi[] = array("name"=>"Hotel Features Edit", "url"=>"featuremanage.php");
		if (Tools::isSubmit("delete") ) {
			$idList = $_POST['idlist'] == '' ? '' : $_POST['idlist'];
			if (is_array($idList)) {
				foreach ($idList as $aid) {
					HotelFeature::DeleteFeatures($aid);
				}
			}
			exit();
		} else if (Tools::isSubmit("submit")) {
			$feature = new HotelFeature((int)Tools::getValue("idx"));
			$feature->FeatureType = (int)Tools::getValue("type");
            $name=Tools::getValue("name");
			$feature->FeatureName = $name;
            global $cookie;
            $iso = Language::getIsoById((int)$cookie->LanguageID);
            if($iso!=''){
                if($iso=='en'){
                    $feature->FeatureName_en= $name;
                }
                if($iso=='jp'){
                    $feature->FeatureName_jp= $name;
                }
                if($iso=='S_CN'){
                    $feature->FeatureName_S_CN= $name;
                }
                if($iso=='T_CN'){
                    $feature->FeatureName_T_CN=$name;
                }
            }
            if($feature->FeatureId ==''){
                $feature->FeatureName_en= $name;
                $feature->FeatureName_jp= $name;
                $feature->FeatureName_S_CN=$name;
                $feature->FeatureName_T_CN=$name;
            }
			if ($feature->FeatureId > 0) 
				$feature->update();
			else $feature->add();
            //p($feature);
			echo "success";exit();
		}
	}
	public function process()
	{
		global $cookie;
		
		parent::process();
		
		$swhere = parent::getSearchWhere();
		
		$featureCount = HotelFeature::getFeatureCount($swhere);
		$this->pagination($featureCount);
		
		$hotelList = HotelFeature::getFeatureList($swhere, $this->p, $this->n);
		self::$smarty->assign("listData", $hotelList);
		self::$smarty->assign("featureList", $this->FeatureType);
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display(_TAS_THEME_DIR_.'featuremanage.tpl');
	}
}
