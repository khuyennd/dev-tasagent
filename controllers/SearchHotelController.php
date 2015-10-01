<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class SearchHotelController extends FrontController
{
	
	public function __construct()
	{
		$this->php_self = "searchhotel.php";
		parent::__construct();
	}
	public function preProcess()
	{
		parent::preProcess();
	}

    /*
     * Search hotel page controller
     *
     * @param
     *
     * @author zotiger
     * @created
     * @modified 2012-11-16 add continent code for price
     */
	public function process()
	{
		global $cookie;
		
		parent::process();
		
		$roomtype_list = RoomPlan::getRoomTypeList();
		
		$roomtype_form_list = array();
        $search_form = array();

        // get contient code
        self::$cookie->UserID;
        $continentCode = Tools::getUserContinentCode(self::$cookie->CompanyID);
		if (Tools::isSubmit("search")) {
			$search_form = Tools::element_copy($_REQUEST, 'CityId', 'AreaId', 'CheckIn', 'CheckOut', 'Nights', 'HotelClassId', 'HotelName', 'SortBy', 'SortOrder');

            if (self::$cookie->RoleID == 2 || self::$cookie->RoleID == 3) {
                $search_form['ContinentCode'] = $continentCode;
                $search_form['HideRQ'] = @$_REQUEST['HideRQ'];
                $search_form['Role'] = 'Agent';
            }

			foreach($roomtype_list as $roomtype)
			{
				$roomTypeId = $roomtype['RoomTypeId'];
				$roomtype_form_list[$roomTypeId] = $_REQUEST['RoomType_'.$roomTypeId];
			}
			$search_form['RoomTypeVals'] = $roomtype_form_list;
            
			if (self::$cookie->RoleID == 2 || self::$cookie->RoleID == 3 || ($search_form['CheckIn'] && $search_form['CheckOut'])) {
                $search_form['Role'] = 'Agent';
				$hotel_roomplan_count = RoomPlan::searchHotelRoomPlanCount($search_form);
				parent::pagination($hotel_roomplan_count);
				$hotel_roomplan_list = RoomPlan::searchHotelRoomPlan($search_form, $this->p, $this->n);
			} else {
				$hotel_roomplan_count = HotelDetail::getHotelByAreaCityCount($search_form);
				parent::pagination($hotel_roomplan_count);
				$hotel_roomplan_list = HotelDetail::getHotelByAreaCity($search_form, $this->p, $this->n);
			}
		} else { 
			// redirect 
			Tools::redirect('index.php');
		}
		
		self::$smarty->assign("hotel_roomplan_list", $hotel_roomplan_list);
		self::$smarty->assign("hotel_roomplan_count", $hotel_roomplan_count);
		self::$smarty->assign("search_form", $search_form);
		self::$smarty->assign("search_city_name", Tools::getCityName($search_form['CityId']));
		self::$smarty->assign("search_area_name", Tools::getAreaName($search_form['AreaId']));

		self::$smarty->assign("roomTypeList", $roomtype_list);
		self::$smarty->assign("classList", Tools::getAllHotelClasses());
		self::$smarty->assign("areaList", Tools::getJapanAreas());
		
	}
	
	
	public function setMedia() {
		parent::setMedia();
		Tools::addJS(_THEME_JS_DIR_.'google_map.js');
		Tools::addJS(_THEME_JS_DIR_.'jquery-ui-1.9.1.custom.min.js');		
	}
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display(_TAS_THEME_DIR_.'searchhotel.tpl');
	}
}
