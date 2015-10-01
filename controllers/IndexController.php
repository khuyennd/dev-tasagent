<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class IndexController extends FrontController
{
	public function __construct()
	{
		$this->php_self = "index.php";
		parent::__construct();
	}
	
	public function preProcess()
	{
		parent::preProcess();
		//echo "vao day";die;
		if (Tools::isSubmit("getPopHotel")) {
			$areaid = Tools::getValue("areaid");
			// Get Popular Hotel List
			$poList = HotelDetail::getPopularHotelList($areaid);
			$popularList = array();
			
			global $cookie;
			$iso = Language::getIsoById((int)$cookie->LanguageID);

			foreach ($poList as $popular) {
				$image = HotelDetail::getFirstFileOfHotel($popular['HotelId'], 150, 150);
				if (is_file(_TAS_ROOT_DIR_."/asset/".$image['w5_path']))  {
					$popular['HotelFilePath'] = $image['w5_path'];
					$popular['w5'] = $image['w5'];
					$popular['h5'] = $image['h5'];
				}
				$popular['LowestPrice'] = HotelDetail::getLowestPriceOfHotel($popular['HotelId']);
				$popular['AreaName'] = HotelDetail::getAreaName($popular['HotelArea']);
				
				$HotelNameKey = 'HotelName_'.$iso;
				$popular['HotelName'] = $popular[$HotelNameKey];

				$popularList[] = $popular;
			}
			self::$smarty->assign("popularList", $popularList);
			self::$smarty->display(_TAS_THEME_DIR_.'homepage_popitem.tpl');
			exit();
		}
	}
	public function process()
	{
		parent::process();
		//echo "vao day";die;
		if (self::$cookie->RoleID == 1)
			Tools::redirect('hotelpage.php?mid='. self::$cookie->HotelID);

        $continentCode = Tools::getUserContinentCode(self::$cookie->CompanyID);
		
		$search_form = array();
		$search_form['CityId'] = 0;
		$search_form['AreaId'] = 0;
        if ((self::$cookie->RoleID == 2 || self::$cookie->RoleID == 3) && self::$cookie->OldLoginUserName == NULL)
        {
            $search_form['CheckIn'] = date('Y-m-d', strtotime(date('Y-m-d') . " + 5 days"));
            $search_form['Nights'] = 1;
            $search_form['CheckOut'] = date('Y-m-d', strtotime($search_form['CheckIn'] . " + {$search_form['Nights']} days"));
        }
		$search_form['HotelClassId'] = 0;
		$search_form['HotelName'] = '';
        $search_form['ContinentCode'] = $continentCode;
		
		$roomtype_list = RoomPlan::getRoomTypeList();
		
		$roomtype_form_list = array();
		
		foreach($roomtype_list as $roomtype)
		{
			$roomTypeId = $roomtype['RoomTypeId'];
			$roomtype_form_list[$roomTypeId] = 0;
		}
		$search_form['RoomTypeVals'] = $roomtype_form_list;
		
		self::$smarty->assign("roomTypeList", $roomtype_list);
		self::$smarty->assign("search_form", $search_form);
		self::$smarty->assign("classList", Tools::getAllHotelClasses());
		self::$smarty->assign("areaList", Tools::getJapanAreas());
		
		//get Hotel List and Promotion List
		$promotionList = Promotion::getHomePromotionList(Promotion::$TYPE_PROMOTION);
		self::$smarty->assign('homePromotionList',$promotionList);
		
		$eventList = Promotion::getHomePromotionList(Promotion::$TYPE_EVENT);
		self::$smarty->assign('homeEventList',$eventList);
		
		// Get Popular Hotel List
		$poList = HotelDetail::getPopularHotelList(3); // 東京・横浜 - 関東 areaid = 3
		$popularList = array();

		global $cookie;
		$iso = Language::getIsoById((int)$cookie->LanguageID);	

		foreach ($poList as $popular) {
			$image = HotelDetail::getFirstFileOfHotel($popular['HotelId'], 150, 150);
			if (is_file(_TAS_ROOT_DIR_."/asset/".$image['w5_path']))  {
					$popular['HotelFilePath'] = $image['w5_path'];
					$popular['w5'] = $image['w5'];
					$popular['h5'] = $image['h5'];
				}
			$popular['LowestPrice'] = HotelDetail::getLowestPriceOfHotel($popular['HotelId']);
			$popular['AreaName'] = HotelDetail::getAreaName($popular['HotelArea']);
			
			$HotelNameKey = 'HotelName_'.$iso;
			$popular['HotelName'] = $popular[$HotelNameKey];
			
			$popularList[] = $popular;
		}
		//self::$smarty->assign('homeAreaList', Db::getInstance()->ExecuteS("select *, AreaName_".$this->iso." as AreaName from HT_Area where AreaId in (3, 5, 8, 12)"));
		self::$smarty->assign('homeAreaList', Db::getInstance()->ExecuteS('select  *, AreaName_'.$this->iso.' as AreaName from `HT_Area` where isPopular = 1' ));
		self::$smarty->assign("popularList", $popularList);
	}
	
	public function setMedia() {
		parent::setMedia();
		Tools::addJS(_THEME_JS_DIR_.'slider.js');
		Tools::addJS(_THEME_JS_DIR_.'jquery.slide.js');
		Tools::addJS(_THEME_JS_DIR_.'slides.min.jquery.js');
		Tools::addJS(_THEME_JS_DIR_.'jquery.tablednd.0.7.min.js');
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display(_TAS_THEME_DIR_.'homepage.html');
	}
}
