<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class HotelDetailController extends FrontController
{
	public $mid = "";
	public function __construct()
	{
		$this->php_self = "hoteldetail.php";
		parent::__construct();
	}
	public function preProcess()
	{
		global $cookie;
		$iso = Language::getIsoById((int)$cookie->LanguageID);

		if (Tools::isSubmit("getcity")) {
			$areaid = (int)Tools::getValue("cityid");
			$cityList = Tools::getCitys($areaid);
			$rstr = "";
			foreach ($cityList as $city) {
				$rstr .= $city['CityId'].",".$city['CityName'].",".$city['HotelNum']."|";
			}
			echo substr($rstr, 0, strlen($rstr)-1);
			exit();
		}
		
		if (!Tools::hasFunction('hotel_detail_edit')) Tools::redirect('index.php');

		$mid = (int)Tools::getValue("mid");
        if($mid ==0){
            $this->brandNavi[] = array("name"=>"Add Hotel", "url"=>"hoteldetail.php");
        }else{
            if (self::$cookie->RoleID > 1) {
                $hotel = new HotelDetail($mid);
                $HotelNameKey = 'HotelName_' . $iso;
                $this->brandNavi[] = array("name" => $hotel->$HotelNameKey, "url" => "hotelpage.php?mid=" . $this->mid);
            }
            $this->brandNavi[] = array("name"=>"Hotel Detail Edit", "url"=>"hoteldetail.php");
        }
		if ($mid == 0 && self::$cookie->RoleID == 1) $mid = self::$cookie->HotelID;
		if ($mid == 0 && self::$cookie->RoleID > 1) {
			$hotelDetail = new HotelDetail();
			$hotelDetail->HotelCode = "_";
			$hotelDetail->HotelClass = 0;
			$hotelDetail->HotelCity = 0;
			$hotelDetail->HotelArea = 0; 
			$hotelDetail->add(true, false);
			$hotelDetail->HotelCode = "JP".str_pad($hotelDetail->HotelId, 6, "0", STR_PAD_LEFT);
			$hotelDetail->update(false);
			$mid = $hotelDetail->HotelId;
		}
		$hotel = new HotelDetail($mid);
		if (Tools::isSubmit("Submit")) {
			//$hotel->HotelCode = trim(Tools::getValue("HotelCode"));
			
			$HotelNameKey = 'HotelName_'.$iso;
			$hotel->$HotelNameKey = trim(Tools::getValue("HotelName"));

			$hotel->HotelCity = trim(Tools::getValue("HotelCity"));
			$hotel->HotelArea = trim(Tools::getValue("HotelArea"));
			
			$HotelAddressKey = 'HotelAddress_'.$iso;
			$hotel->$HotelAddressKey = trim(Tools::getValue("HotelAddress"));

			//$hotel->HotelCode = trim(Tools::getValue("HotelCode"));
			$hotel->HotelClass = trim(Tools::getValue("HotelClass"));
			$hotel->HotelContactNo = trim(Tools::getValue("HotelContactNo"));

			$HotelDescriptionKey = 'HotelDescription_'.$iso;
			$hotel->$HotelDescriptionKey = trim(Tools::getValue("HotelDescription"));	
			$HotelPoliciesKey = 'HotelPolicies_'.$iso;
			$hotel->$HotelPoliciesKey = trim(Tools::getValue("HotelPolicies"));
			$UsefulInformationKey = 'UsefulInformation_'.$iso;
			$hotel->$UsefulInformationKey = trim(Tools::getValue("UsefulInformation"));

            $hotel->HotelFax = trim(Tools::getValue("HotelFax"));
            $hotel->HotelEmail = trim(Tools::getValue("HotelEmail"));
            $prefCon=trim(Tools::getValue("prefCon"));
            if($prefCon=='prefFax'){
                $hotel->PrefEmail =  0;
                $hotel->PrefFax = 1;
            }
            elseif($prefCon=='prefEmail'){
                $hotel->PrefEmail =  1;
                $hotel->PrefFax = 0;
            }
            elseif($prefCon=='prefAll'){
                $hotel->PrefEmail =  1;
                $hotel->PrefFax = 1;
            }
            elseif($prefCon=='prefNone'){
                $hotel->PrefEmail =  0;
                $hotel->PrefFax = 0;
            }
            else{
                $hotel->PrefEmail =  0;
                $hotel->PrefFax = 0;
            }
			/*if (empty($hotel->HotelCode)) {
				$this->errors[] = Tools::displayError("Hotel Code required");
			}*/


			if (empty($hotel->$HotelNameKey)) {
				$this->errors[] = Tools::displayError("Hotel Name required");
			}
			if ((int)$hotel->HotelCity == 0) {
				$this->errors[] = Tools::displayError("Hotel City required");
			}
			if (empty($hotel->$HotelAddressKey)) {
				$this->errors[] = Tools::displayError("Hotel Address required");
			}
            if (!sizeof($this->errors)) {
                if ($hotel->HotelId > 0) {
                    //echo $hotel->getHotelName($hotel->HotelId, 'en');
                    $hid=$hotel->HotelId;
                    $HotelName = trim(Tools::getValue("HotelName"));
                    $HotelAddress = trim(Tools::getValue("HotelAddress"));
                    $HotelDescription = trim(Tools::getValue("HotelDescription"));
                    $HotelPolicies = trim(Tools::getValue("HotelPolicies"));
                    $UsefulInformation = trim(Tools::getValue("UsefulInformation"));

                    if ($hotel->getHotelName($hotel->HotelId, 'en') == null) {
                        $hotel->HotelName_en = $HotelName;
                    }
                    if ($hotel->getHotelName($hotel->HotelId, 'jp') == null) {
                        $hotel->HotelName_jp = $HotelName;
                    }
                    if ($hotel->getHotelName($hotel->HotelId, 'S_CN') == null) {
                        $hotel->HotelName_S_CN = $HotelName;
                    }
                    if ($hotel->getHotelName($hotel->HotelId, 'T_CN') == null) {
                        $hotel->HotelName_T_CN = $HotelName;
                    }

                    if($hotel->getHotelInfo($hid,'HotelAddress','en')==null){
                        $hotel->HotelAddress_en = $HotelAddress;
                    }
                    if($hotel->getHotelInfo($hid,'HotelAddress','jp')==null){
                        $hotel->HotelAddress_jp = $HotelAddress;
                    }
                    if($hotel->getHotelInfo($hid,'HotelAddress','S_CN')==null){
                        $hotel->HotelAddress_S_CN = $HotelAddress;
                    }
                    if($hotel->getHotelInfo($hid,'HotelAddress','T_CN')==null){
                        $hotel->HotelAddress_T_CN = $HotelAddress;
                    }

                    if($hotel->getHotelInfo($hid,'HotelDescription','en')==null){
                        $hotel->HotelDescription_en = $HotelDescription;
                    }
                    if($hotel->getHotelInfo($hid,'HotelDescription','jp')==null){
                        $hotel->HotelDescription_jp = $HotelDescription;
                    }
                    if($hotel->getHotelInfo($hid,'HotelDescription','S_CN')==null){
                        $hotel->HotelDescription_S_CN = $HotelDescription;
                    }
                    if($hotel->getHotelInfo($hid,'HotelDescription','T_CN')==null){
                        $hotel->HotelDescription_T_CN = $HotelDescription;
                    }

                    if($hotel->getHotelInfo($hid,'HotelPolicies','en')==null){
                        $hotel->HotelPolicies_en = $HotelPolicies;
                    }
                    if($hotel->getHotelInfo($hid,'HotelPolicies','jp')==null){
                        $hotel->HotelPolicies_jp = $HotelPolicies;
                    }
                    if($hotel->getHotelInfo($hid,'HotelPolicies','S_CN')==null){
                        $hotel->HotelPolicies_S_CN = $HotelPolicies;
                    }
                    if($hotel->getHotelInfo($hid,'HotelPolicies','T_CN')==null){
                        $hotel->HotelPolicies_T_CN = $HotelPolicies;
                    }

                    if($hotel->getHotelInfo($hid,'UsefulInformation','en')==null){
                        $hotel->UsefulInformation_en = $UsefulInformation;
                    }
                    if($hotel->getHotelInfo($hid,'UsefulInformation','jp')==null){
                        $hotel->UsefulInformation_jp = $UsefulInformation;
                    }
                    if($hotel->getHotelInfo($hid,'UsefulInformation','S_CN')==null){
                        $hotel->UsefulInformation_S_CN = $UsefulInformation;
                    }
                    if($hotel->getHotelInfo($hid,'UsefulInformation','T_CN')==null){
                        $hotel->UsefulInformation_T_CN = $UsefulInformation;
                    }

                    $hotel->update(false);
                }
				else {
					$hotel->HotelId = $mid;
					$hotel->add();
                    self::$cookie->HotelID = $mid;
				}
				// Update HotelFeatureLink 
				$fidList = $_POST['fids'] == '' ? '' : $_POST['fids'];
				$hotel->deleteAllFeatures();
				$hotel->updateFeatures($fidList);
				
				// Update Name and Order of hotel images
				$imageids = Tools::getValue("hotelFileId");
				$imagenames = Tools::getValue("hotelFileName");

				if ($imageids!="" && sizeof($imageids)) {
					for ($i = 0; $i < sizeof($imageids); $i++) {
						HotelDetail::updateHotelImage($imageids[$i], $imagenames[$i], $i,$iso);
					}
				}

				if($_POST['admin_add_hotel'] == 1) {
                    Tools::redirect('auth.php?prev_page=hotellist&nohotel=1&hid='.$mid);
                } else {
                    Tools::redirect('hotelpage.php?mid=' . $mid);
                }
			}
		}  else if ('upload' == $_REQUEST['action']) // save click
		{
			// insert image file
			$fileArray = HotelDetail::insertHotelFiles($mid, 1);
			foreach ($fileArray as $file) {
				echo $file[0]."|||".$file[1]."|||".$file[2]."*";
			}
			exit();
		} else if (Tools::isSubmit("delimage")) {
			$fid = Tools::getValue("fid");
			HotelDetail::delHotelFile($fid);
			exit();
		}
		
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
		
		self::$smarty->assign("mid", $mid);
		self::$smarty->assign("hotel", $hotel);
		if ($hotel->HotelCity > 0) self::$smarty->assign("cityList", Tools::getCitys($hotel->HotelArea));
		self::$smarty->assign("featureList", $hotel->getAllFeatures());
        $photoList= HotelDetail::getAllHotelFiles($mid);
        foreach ($photoList as $key => $var) {
            $iso_name='HotelFileName_'.$iso;
            $photoList[$key]['HotelFileName'] =$photoList[$key][$iso_name];
            //d($photoList[$key]);
        }
		self::$smarty->assign("photoList", $photoList);

	}
	public function process()
	{
		global $cookie;
		
		parent::process();
		self::$smarty->assign("classList", Tools::getAllHotelClasses());
		self::$smarty->assign("areaList", Tools::getJapanAreas());
		
		$isie = false;
		if (isset($_SERVER['HTTP_USER_AGENT']) && 
	    (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
	        $isie = true;
	    self::$smarty->assign("isie", $isie);
	}
	
	public function setMedia(){
		parent::setMedia();
		Tools::addJS(_THEME_JS_DIR_.'slider.js');
		Tools::addJS(_THEME_JS_DIR_.'slides.min.jquery.js');
		Tools::addJS(_THEME_JS_DIR_.'jquery.slide.js');
		Tools::addJS(_THEME_JS_DIR_.'jquery.form.js');
		Tools::addJS(_THEME_JS_DIR_.'jquery-ui-1.9.1.custom.min.js');
		//Tools::addJS(_THEME_JS_DIR_.'jquery.validate.js');
        global $cookie;
      	$iso = Language::getIsoById((int)$cookie->LanguageID);
      	Tools::addJS(_THEME_JS_DIR_.'jquery.validate_'.$iso.'.js');
	}
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display(_TAS_THEME_DIR_.'hoteldetailedit.tpl');
	}
}
