<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class RoomPlanEditController extends FrontController
{
	var $hotelId;
	
	public function __construct()
	{
		$this->php_self = "roomplanedit.php";
		parent::__construct();
	}

    private function as_array(&$arr_r)
    {
        foreach ($arr_r as &$val) is_array($val) ? as_array($val):$val=addslashes($val);
        unset($val);
    }

    public function preProcess()
	{
		parent::preProcess();

		if (!Tools::hasFunction('room_plan_edit')) Tools::redirect('index.php');
		//
		if (self::$cookie->RoleID == 4 || self::$cookie->RoleID == 5) // admin
		{
			$this->hotelId = $_REQUEST['hid'];
		}
		else
			$this->hotelId = Member::getHotelId(self::$cookie->UserID);

		$hotelId = $this->hotelId;
		$isHotel = 0;
        if (self::$cookie->RoleID == 1) // hotel
        {
            $isHotel = 1;
        }
        self::$smarty->assign("isHotel", $isHotel);
		// 
		if (!$hotelId)
		{
			$error['no'] = 1;
			$error['message'] = 'User can not access this page';
			self::$smarty->assign("error", $error);
			self::$smarty->display(_TAS_THEME_DIR_.'error_redirect.tpl');
			exit();
		}
		
		// check parameter if it contains delete function
		if ('save' == $_REQUEST['action']) // save click
		{
			// post process
			$total_count = $_POST['roomPlanListCount'];
			
			for ($i = 0; $i < $total_count; $i++)
			{
				$roomPlanClientId = $_POST['RoomPlanClientId'][$i];
				
				$roomPlanId = $_POST['RoomPlanId'][$i];
				$roomTypeId = $_POST['RoomTypeId'][$i];
				$roomPlanName = $_POST['RoomPlanName'][$i];
                $roomMaxPersons = $_POST['RoomMaxPersons'][$i];
				$startTime = '2012-01-01';
				$endTime = '2112-01-01';
				$roomSize = $_POST['RoomSize'][$i];
                $zaiku = Tools::get_default_val($_POST['zaiku_'.$roomPlanClientId][0], 0);
                $liaojin =Tools::get_default_val($_POST['liaojin_'.$roomPlanClientId][0], 0);
				$roomPlanDesc = $_POST['RoomPlanDesc'][$i];
				$breakfast = Tools::get_default_val($_POST['Breakfast_'.$roomPlanClientId][0], 0);
				$dinner = Tools::get_default_val($_POST['Dinner_'.$roomPlanClientId][0], 0);
				$useCon = $_POST['UseCon_'.$roomPlanClientId][0]; // radio box
				$conFromTime = $_POST['ConFromTime'][$i];
				$conToTime = $_POST['ConToTime'][$i];
				$nights = $_POST['Nights'][$i];
				$priceAll = $_POST['PriceAll'][$i];
				$priceAsia = $_POST['PriceAsia'][$i];
				$priceEuro = $_POST['PriceEuro'][$i];
			
				// $retVal = $roomPlanId;
				
				// echo $roomPlanId;
				
				if ($roomPlanId == 0)
					$roomPlanId = RoomPlan::insertRoomPlan($hotelId, $roomTypeId, $roomPlanName, $roomMaxPersons, $startTime, $endTime, $roomSize, $roomPlanDesc, $breakfast, $dinner, $useCon, $conFromTime, $conToTime, $nights, $priceAll, $priceAsia, $priceEuro,$liaojin,$zaiku);
				else
				{
					RoomPlan::updateRoomPlan($hotelId, $roomPlanId, $roomTypeId, $roomPlanName, $roomMaxPersons, $startTime, $endTime, $roomSize, $roomPlanDesc, $breakfast, $dinner, $useCon, $conFromTime, $conToTime, $nights, $priceAll, $priceAsia, $priceEuro,$liaojin,$zaiku);
					RoomFile::deleteAllFilesByRoomPlanId($roomPlanId);
				}

				if (array_key_exists('rp_fid_'.$roomPlanClientId, $_POST))
				{
					foreach ($_POST['rp_fid_'.$roomPlanClientId] as $order => $rp_fid)
					{
                        $rp_fname = mysql_real_escape_string($_POST['rp_fname_'.$roomPlanClientId][$order]);

						RoomFile::insertRoomFileById($roomPlanId, $rp_fid, $order + 1);
                        global $cookie;
                       	$iso = Language::getIsoById((int)$cookie->LanguageID);
                        RoomFile::updateRoomFileName($rp_fid, $rp_fname,$iso);
					}
				}
			}

			// delete all item in the Roomplan id delete list
			$delRpidList = $_POST['delRpidList'];
			RoomPlan::deleteRoomPlanByIdList($delRpidList);
			
			// redirect list page
			Tools::redirect("roomplanedit.php?hid=$hotelId");
				
			exit();
		} else if ('upload' == $_REQUEST['action']) // save click
		{
			// insert image file
			$fileIds = RoomFile::insertRoomFiles($_FILES, 1);
			// print_r($_FILES);
			$output = implode(',', $fileIds);
			// print_r($fileId);
			echo $output;
			exit();
		}
        if (self::$cookie->RoleID > 1) {
            global $cookie;
            $iso = Language::getIsoById((int)$cookie->LanguageID);
            $hotel = new HotelDetail($this->hotelId);
            $HotelNameKey = 'HotelName_' . $iso;
            $this->brandNavi[] = array("name" => $hotel->$HotelNameKey, "url" => "hotelpage.php?mid=" . $this->hotelId);
        }
        $this->brandNavi[] = array("name"=>"Room Plan Edit", "url"=>"roomplanedit.php?hid=". $this->hotelId);
	}
	
	public function process()
	{
		global $cookie;
		
		parent::process();
		
		// get hotel id
		
		// its value will retain from session.
		// get room plan list by hotel id
		$hotelId = $this->hotelId;
		
		//
		// action switch
		
		global $cookie;
		$iso = Language::getIsoById((int)$cookie->LanguageID);
		
		// show default list page
		$resRoomPlanList = RoomPlan::getRoomPlanListByHotelId($hotelId);
		// print_r($resRoomPlanList);
		$roomPlanList = array();
        foreach ($resRoomPlanList as $roomPlan) {
            $RoomPlanNameKey = 'RoomPlanName_' . $iso;
            $roomPlan['RoomPlanName'] = $roomPlan[$RoomPlanNameKey];

            $RoomPlanDescriptionKey = 'RoomPlanDescription_' . $iso;
            $roomPlan['RoomPlanDescription'] = addslashes($roomPlan[$RoomPlanDescriptionKey]);
            $roomPlan['FileIdList'] = RoomFile::getRoomFileListByRoomPlanId($roomPlan['RoomPlanId']);
            $photoList = RoomFile::getRoomFileListByRoomPlanId($roomPlan['RoomPlanId']);
            foreach ($photoList as $key => $var) {
                $iso_name = 'RoomFileName_' . $iso;
                $photoList[$key]['RoomFileName'] = $photoList[$key][$iso_name];
            }
            $roomPlan['FileIdList'] = $photoList;
            $roomPlanList[] = $roomPlan;
        }
		
		$roomTypeList = RoomPlan::getRoomTypeList();

        $today = date('Y-m-d');
        $tomorrow = date('Y-m-d', strtotime($today . " + 1 days"));
		
		self::$smarty->assign("roomPlanList", $roomPlanList);
		self::$smarty->assign("roomTypeList", $roomTypeList);
		self::$smarty->assign("hid", $hotelId);
        self::$smarty->assign("today", $today);
        self::$smarty->assign("tomorrow", $tomorrow);
	}
	
	
	public function setMedia() {
		parent::setMedia();
		
		Tools::addJS(_THEME_JS_DIR_.'slider.js');
		Tools::addJS(_THEME_JS_DIR_.'slides.min.jquery.js');
		Tools::addJS(_THEME_JS_DIR_.'jquery.slide.js');
		Tools::addJS(_THEME_JS_DIR_.'jquery.form.js');
		Tools::addJS(_THEME_JS_DIR_.'jquery-ui-1.9.1.custom.min.js');
		Tools::addJS(_THEME_JS_DIR_.'jquery.blockUI.js');
	}
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display(_TAS_THEME_DIR_.'roomplanedit.tpl');
	}
}
