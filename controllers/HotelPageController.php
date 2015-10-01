<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class HotelPageController extends FrontController
{
	var	$mid;
	
	public function __construct()
	{
		$this->php_self = "hotelpage.php";
		
		parent::__construct();
	}
	
	public function preProcess()
	{
		parent::preProcess();
		
		if (self::$cookie->RoleID==1)
        {
            $this->mid = self::$cookie->HotelID;
        }
		else{
            $this->mid = Tools::getValue("mid");
        }/*else
		{
			$error['no'] = 1;
			$error['message'] = 'User can not access this page';
			self::$smarty->assign("error", $error);
			self::$smarty->display(_TAS_THEME_DIR_.'error_redirect.tpl');
			exit();
		}
		*/
		
		// $this->mid = Tools::getValue("mid")!="" ? Tools::getValue("mid") : ((self::$cookie->RoleID==1) ? self::$cookie->HotelID : "");
		
		if (((self::$cookie->RoleID==1) || (self::$cookie->RoleID==4 || self::$cookie->RoleID==5))  && $_GET['setOrder']) // hotel user changed order
		{
			$hotel_roomplan_list = RoomPlan::getRoomPlanListDetailByHotelIdHotelAndAdmin($this->mid);

            print_r($hotel_roomplan_list);
			
			$order_list = explode(",", trim($_REQUEST['orderList'], ','));
			
			$new_orders = array();
			foreach($order_list as $key => $rpid)
			{
				$new_orders[$rpid] = $key + 1;
			}
			
			foreach($hotel_roomplan_list as $roomplan)
			{
				$rpid = $roomplan['RoomPlanId'];
				$rp_order = 1; // default order value is 1
				if (array_key_exists($rpid, $new_orders))
				{
					$rp_order = $new_orders[$rpid];					
				} 
				
				$sql = "
					UPDATE HT_HotelRoomPlanLink SET ShowOrder = {$rp_order} WHERE RoomPlanId = {$rpid}
				";
				
				Db::getInstance()->ExecuteS($sql);
			}

            $search_form['HotelId'] = $this->mid;

            $continentCode = Tools::getUserContinentCode(self::$cookie->CompanyID);

            if (self::$cookie->RoleID == 2 || self::$cookie->RoleID == 3)
            {
                $search_form['ContinentCode'] = $continentCode;
                $search_form['Role'] = 'Agent';
            }


            $hotel_roomplan_count = RoomPlan::searchHotelRoomPlanCount($search_form);

            parent::pagination($hotel_roomplan_count);

            $hotel_roomplan_list = RoomPlan::searchHotelRoomPlan($search_form, $this->p, $this->n);

			// $hotel_roomplan_list = RoomPlan::getRoomPlanListDetailByHotelId($this->mid);
			self::$smarty->assign("hotel_roomplan_list", $hotel_roomplan_list);
            self::$smarty->assign("mid", $this->mid);
			self::$smarty->display(_TAS_THEME_DIR_.'hotelpage_roomplan_list.tpl');
			exit;
		}
        if (self::$cookie->RoleID > 1) {
            global $cookie;
            $iso = Language::getIsoById((int)$cookie->LanguageID);
            $hotel = new HotelDetail($this->mid);
            $HotelNameKey = 'HotelName_' . $iso;
            $this->brandNavi[] = array("name" => $hotel->$HotelNameKey, "url" => "hotelpage.php?mid=" . $this->mid);
        }
	}
	
	public function process()
	{
		parent::process();
		global $cookie;
		$iso = Language::getIsoById((int)$cookie->LanguageID);

		$mid = $this->mid; //Tools::getValue("mid")!="" ? Tools::getValue("mid") : ((self::$cookie->RoleID==1) ? self::$cookie->HotelID : "");
		$hotel = new HotelDetail($mid);

		$HotelNameKey = 'HotelName_'.$iso;
		$hotel->HotelName = $hotel->$HotelNameKey;
		$HotelAddressKey = 'HotelAddress_'.$iso;
		$hotel->HotelAddress = $hotel->$HotelAddressKey;
		$HotelDescriptionKey = 'HotelDescription_'.$iso;
		$hotel->HotelDescription = $hotel->$HotelDescriptionKey;	
		$HotelPoliciesKey = 'HotelPolicies_'.$iso;
		$hotel->HotelPolicies = $hotel->$HotelPoliciesKey;
		$UsefulInformationKey = 'UsefulInformation_'.$iso;
		$hotel->UsefulInformation = $hotel->$UsefulInformationKey;

        $continentCode = Tools::getUserContinentCode(self::$cookie->CompanyID);

		// get CityName and AreaName of Hotel 
		$hotel->HotelAreaName = Tools::getAreaName($hotel->HotelArea);
		$hotel->HotelCityName = Tools::getCityName($hotel->HotelCity);
		$hotel->HotelClassName = $hotel->getClassName();
 		
 		$number_star = 0;
        if($hotel->HotelClass == 1 || $hotel->HotelClass == 4 || $hotel->HotelClass == 7) {
            $number_star = 5;
        } elseif($hotel->HotelClass == 2 || $hotel->HotelClass == 5 || $hotel->HotelClass == 8) {
            $number_star = 4;
        } elseif($hotel->HotelClass == 3 || $hotel->HotelClass == 6 || $hotel->HotelClass == 9) {
            $number_star = 3;
        }

        $isOnsen = 0;
        $isResort = 0;
        if($hotel->HotelClass == 4 || $hotel->HotelClass == 5 || $hotel->HotelClass == 6) {
            $isOnsen = 1;
        } elseif($hotel->HotelClass == 9 || $hotel->HotelClass == 8 || $hotel->HotelClass == 7) {
            $isResort = 1;
        }
		self::$smarty->assign("number_star", $number_star);
      	self::$smarty->assign("isOnsen", $isOnsen);
		self::$smarty->assign("isResort", $isResort);
		self::$smarty->assign("hotel", $hotel);
		self::$smarty->assign("featureList", $hotel->getAllFeatures());
		$photoList = HotelDetail::getAllHotelFiles($hotel->HotelId);
        foreach ($photoList as $key => $var) {
                    $iso_name='HotelFileName_'.$iso;
                    $photoList[$key]['HotelFileName'] =$photoList[$key][$iso_name];
                    //d($photoList[$key]);
                }
		self::$smarty->assign("photoList", $photoList);
		self::$smarty->assign("photoCount", sizeof($photoList));
		self::$smarty->assign("mid", $mid);

		
		// Get Similar Hotel List
		$simList = $hotel->getSimilarHotelList();
		$similarList = array();
		foreach ($simList as $similar) {
			$image = HotelDetail::getFirstFileOfHotel($similar['HotelId'], 145, 145);
			if (is_file(_TAS_ROOT_DIR_."/asset/".$image['w5_path']))  {
					$similar['HotelFilePath'] = $image['w5_path'];
					$similar['w5'] = $image['w5'];
					$similar['h5'] = $image['h5'];
				}
			$similar['LowestPrice'] = HotelDetail::getLowestPriceOfHotel($similar['HotelId']);
			$similar['AreaName'] = Tools::getAreaName($similar['HotelArea']);
			
			$HotelNameKey = 'HotelName_'.$iso;
			$similar['HotelName'] = $similar[$HotelNameKey];
			
			$similarList[] = $similar;
		}
		self::$smarty->assign("similarList", $similarList);
		
		$roomtype_list = RoomPlan::getRoomTypeList();
		
		$roomtype_form_list = array();
		
		if (Tools::isSubmit("search")) { // search result
			$search_form = Tools::element_copy($_REQUEST, 'CheckIn', 'CheckOut', 'Nights', 'SortBy', 'SortOrder');
			
			$search_form['HotelId'] = $mid;
			
			foreach($roomtype_list as $roomtype)
			{
				$roomTypeId = $roomtype['RoomTypeId'];
				$roomtype_form_list[$roomTypeId] = $_REQUEST['RoomType_'.$roomTypeId];
			}
			$search_form['RoomTypeVals'] = $roomtype_form_list;

            if (self::$cookie->RoleID == 2 || self::$cookie->RoleID == 3)
            {
                $search_form['ContinentCode'] = $continentCode;
                $search_form['Role'] = 'Agent';
            }

			$hotel_roomplan_count = RoomPlan::searchHotelRoomPlanCount($search_form);
			
			parent::pagination($hotel_roomplan_count);
						
			$hotel_roomplan_list = RoomPlan::searchHotelRoomPlan($search_form, $this->p, $this->n);
			
			// print_r($hotel_roomplan_list);
						
			self::$smarty->assign("hotel_roomplan_list", $hotel_roomplan_list);
			self::$smarty->assign("hotel_roomplan_count", $hotel_roomplan_count);
			self::$smarty->assign("search_form", $search_form);
			
		} else {
			$search_form = array();
			$search_form['CityId'] = 0;
			$search_form['AreaId'] = 0;

            if (self::$cookie->RoleID == 2 || self::$cookie->RoleID == 3)
            {
                $search_form['Role'] = 'Agent';
                $search_form['CheckIn'] = Tools::get_default_val($_REQUEST['CheckIn'], date('Y-m-d', strtotime(date('Y-m-d') . " + 5 days")));
                $search_form['Nights'] = Tools::get_default_val($_REQUEST['Nights'], 1);
                $search_form['CheckOut'] = date('Y-m-d', strtotime($search_form['CheckIn'] . " + {$search_form['Nights']} days"));
            }

			$search_form['HotelClassId'] = 0;
			$search_form['HotelName'] = '';
			$search_form['HotelId'] = $mid;
			
			foreach($roomtype_list as $roomtype)
			{
				$roomTypeId = $roomtype['RoomTypeId'];
				$roomtype_form_list[$roomTypeId] = Tools::get_default_val($_REQUEST['RoomType_'.$roomTypeId], 0);
			}
			$search_form['RoomTypeVals'] = $roomtype_form_list;

            if (self::$cookie->RoleID == 2 || self::$cookie->RoleID == 3)
            {
                $search_form['ContinentCode'] = $continentCode;
                $search_form['Role'] = 'Agent';
            }

			self::$smarty->assign("search_form", $search_form);
				
			
			if ((self::$cookie->RoleID==1 && self::$cookie->HotelID == $mid) || (self::$cookie->RoleID==4 || self::$cookie->RoleID==5) ) // hotel user
			{
                $search_form = array();

                $search_form['CityId'] = 0;
                $search_form['AreaId'] = 0;
                // $search_form['ContinentCode'] = $continentCode;

                $search_form['HotelClassId'] = 0;
                $search_form['HotelName'] = '';
                $search_form['HotelId'] = $mid;

				// $hotel_roomplan_list = RoomPlan::getRoomPlanListDetailByHotelId($mid);
                $hotel_roomplan_count = RoomPlan::searchHotelRoomPlanCount($search_form);
                parent::pagination($hotel_roomplan_count);
                $hotel_roomplan_list = RoomPlan::searchHotelRoomPlan($search_form, $this->p, $this->n);
				self::$smarty->assign("hotel_roomplan_list", $hotel_roomplan_list);
			}
			else
			{	
				$temp = 0;
				foreach($roomtype_form_list as $roomtype) {
					if($roomtype != 0)
						$temp = $roomtype;
				}
				
				$hotel_roomplan_count = RoomPlan::searchHotelRoomPlanCount($search_form);
				parent::pagination($hotel_roomplan_count);
				$hotel_roomplan_list = RoomPlan::searchHotelRoomPlan($search_form, $this->p, $this->n);
				
				if($temp == 0) {
					$hotel_roomplan_list = array();
				}
				self::$smarty->assign("hotel_roomplan_list", $hotel_roomplan_list);
				self::$smarty->assign("hotel_roomplan_count", $hotel_roomplan_count);
				
			}
		}
		
		self::$smarty->assign("roomTypeList", $roomtype_list);
	}
	
	public function setMedia() {
		parent::setMedia();

		Tools::addCSS('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
      	Tools::addCSS(_THEME_CSS_DIR_.'jquery.fancybox.css?v=2.1.5');
        Tools::addCSS(_THEME_CSS_DIR_.'jquery.fancybox-thumbs.css?v=1.0.7');
        Tools::addCSS(_THEME_CSS_DIR_.'style.slider.css', 'all');
        

		Tools::addJS(_THEME_JS_DIR_.'slider.js');
		// Tools::addJS(_THEME_JS_DIR_.'jquery.slide.js');
		// Tools::addJS(_THEME_JS_DIR_.'slides.min.jquery.js');
		Tools::addJS(_THEME_JS_DIR_.'google_map.js');
		// Tools::addJS(_THEME_JS_DIR_.'jquery.tablednd.0.7.min.js');


        Tools::addJS("https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js");
        Tools::addJS(_THEME_JS_DIR_.'vendors/bootstrap.min.js');
        Tools::addJS(_THEME_JS_DIR_.'vendors/bootstrap-select.min.js');
        Tools::addJS(_THEME_JS_DIR_.'vendors/jquery.flexslider-min.js');
        Tools::addJS(_THEME_JS_DIR_.'vendors/jquery.fancybox.pack.js?v=2.1.5');
        Tools::addJS(_THEME_JS_DIR_.'vendors/jquery.fancybox-thumbs.js?v=1.0.7');
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display(_TAS_THEME_DIR_.'hotelpage.tpl');
	}
}
