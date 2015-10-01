<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class HotelDetail extends ObjectModel
{
	public 		$HotelId;
	public 		$HotelCode;
	public 		$HotelName;

	public 		$HotelName_en;
	public 		$HotelName_jp;
	public 		$HotelName_S_CN;
	public 		$HotelName_T_CN;

	public		$HotelClass;
	public 		$HotelCity;
	public 		$HotelArea;
	public 		$HotelAddress;

	public 		$HotelAddress_en;
	public 		$HotelAddress_jp;
	public 		$HotelAddress_S_CN;
	public 		$HotelAddress_T_CN;

	public		$HotelDescription;

	public		$HotelDescription_en;
	public		$HotelDescription_jp;
	public		$HotelDescription_S_CN;
	public		$HotelDescription_T_CN;

	public		$HotelPolicies;

	public		$HotelPolicies_en;
	public		$HotelPolicies_jp;
	public		$HotelPolicies_S_CN;
	public		$HotelPolicies_T_CN;

	public		$UsefulInformation;

	public		$UsefulInformation_en;
	public		$UsefulInformation_jp;
	public		$UsefulInformation_S_CN;
	public		$UsefulInformation_T_CN;

	public		$Active;
	
	public		$HotelClassName;
	public		$HotelAreaName;
	public		$HotelCityName;
	
	public 		$HotelContactNo;
	
	/** @var string Object creation date */
	public 		$CreateDate;

	/** @var string Object last modification date */
	public 		$UpdateDate;
    /** @var String HotelEmail */
  	public 		$HotelEmail;

  	/** @var string HotelFax */
  	public 		$HotelFax;

  	public		$PrefFax;
  	public		$PrefEmail;
	protected $tables = array ('Hotel');

 	protected 	$fieldsRequired = array('HotelCity', 'HotelArea');	//'HotelName'
 	protected 	$fieldsSize = array('HotelName' => 64);
 	protected 	$fieldsValidate = array();
	protected	$exclude_copy_post = array();

	protected 	$table = 'Hotel';
	protected 	$identifier = 'HotelId';

	public function getFields()
	{
		parent::validateFields();
		//if (isset($this->HotelId))
		$fields['HotelId'] = (int)($this->HotelId);
		
		$fields['HotelCode'] = pSQL($this->HotelCode);
		$fields['HotelName'] 	= pSQL($this->HotelName);
				
		$fields['HotelName_en'] 	= pSQL($this->HotelName_en);
		$fields['HotelName_jp'] 	= pSQL($this->HotelName_jp);
		$fields['HotelName_S_CN'] 	= pSQL($this->HotelName_S_CN);
		$fields['HotelName_T_CN'] 	= pSQL($this->HotelName_T_CN);
		
		$fields['HotelClass'] = (int)($this->HotelClass);
		$fields['HotelCity'] = (int)($this->HotelCity);
		$fields['HotelArea'] = (int)($this->HotelArea);
		$fields['HotelAddress'] = pSQL($this->HotelAddress);
				
		$fields['HotelAddress_en'] = pSQL($this->HotelAddress_en);
		$fields['HotelAddress_jp'] = pSQL($this->HotelAddress_jp);
		$fields['HotelAddress_S_CN'] = pSQL($this->HotelAddress_S_CN);
		$fields['HotelAddress_T_CN'] = pSQL($this->HotelAddress_T_CN);
		
		$fields['HotelDescription'] = pSQL($this->HotelDescription);
		
		$fields['HotelDescription_en'] = pSQL($this->HotelDescription_en);
		$fields['HotelDescription_jp'] = pSQL($this->HotelDescription_jp);
		$fields['HotelDescription_S_CN'] = pSQL($this->HotelDescription_S_CN);
		$fields['HotelDescription_T_CN'] = pSQL($this->HotelDescription_T_CN);

		$fields['HotelPolicies'] = pSQL($this->HotelPolicies);
		
		$fields['HotelPolicies_en'] = pSQL($this->HotelPolicies_en);
		$fields['HotelPolicies_jp'] = pSQL($this->HotelPolicies_jp);
		$fields['HotelPolicies_S_CN'] = pSQL($this->HotelPolicies_S_CN);
		$fields['HotelPolicies_T_CN'] = pSQL($this->HotelPolicies_T_CN);

		$fields['UsefulInformation'] = pSQL($this->UsefulInformation);
				
		$fields['UsefulInformation_en'] = pSQL($this->UsefulInformation_en);
		$fields['UsefulInformation_jp'] = pSQL($this->UsefulInformation_jp);
		$fields['UsefulInformation_S_CN'] = pSQL($this->UsefulInformation_S_CN);
		$fields['UsefulInformation_T_CN'] = pSQL($this->UsefulInformation_T_CN);

        $fields['HotelContactNo'] = pSQL($this->HotelContactNo);
        $fields['CreateDate'] = pSQL($this->CreateDate);
        $fields['UpdateDate'] = pSQL($this->UpdateDate);
        $fields['HotelEmail'] = pSQL($this->HotelEmail);
        $fields['HotelFax'] = pSQL($this->HotelFax);
        $fields['PrefFax'] = (int)($this->PrefFax);
        $fields['PrefEmail'] = (int)($this->PrefEmail);
		return $fields;
	}

	public function add($autodate = true, $nullValues = true)
	{
	 	if (!parent::add($autodate, $nullValues))
			return false;
		$this->HotelId = $this->id;
		return true;
	}

	public function update($nullValues = false)
	{
	 	return parent::update(true);
	}
	
	public function updateFeatures($fids) {
		if (is_array($fids)) {
			foreach ($fids as $fid) {
				Db::getInstance()->Execute('insert into `'._DB_PREFIX_.'HotelFeatureLink` (HotelID, FeatureID) values('.(int)$this->HotelId.', '.$fid.')');
			}
		}
	}

	public function deleteAllFeatures() {
		Db::getInstance()->Execute('delete from `'._DB_PREFIX_.'HotelFeatureLink` WHERE `HotelID` = '.(int)($this->HotelId));
	}
	
	public function getAllFeatures($iso = "") {
		global $cookie;
        if ($iso == "") $iso = Language::getIsoById((int)$cookie->LanguageID);

		return Db::getInstance()->ExecuteS('
		SELECT `FeatureId`, `FeatureType`, `FeatureName_'.$iso.'` as FeatureName, `FeatureInformation`, `CreateDate`, 
		(select HotelFeatureLinkId from HT_HotelFeatureLink where HT_HotelFeatureLink.FeatureID = HT_Feature.FeatureId and HT_HotelFeatureLink.HotelID = '.(int)$this->HotelId.') LinkId
		from `HT_Feature`
		order by featuretype asc, featureid asc ');
	}
	
	public static function insertHotelFiles($hotelId, $type)
	{
		
		$ufiles = array(); 
		$uploads_dir = UPLOAD_DIR;

		foreach ($_FILES["myfile"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$tmp_name = $_FILES["myfile"]["tmp_name"][$key];
				//die("vao day");
				$name = Tools::uploadMultiFile($uploads_dir, $_FILES["myfile"], $key, true);//echo "name".$name;die("vao day");
				$fn = $_FILES["myfile"]['name'][$key];
				$fp = mysql_real_escape_string($name);
				$ft = $type;
				$fi = 1000;

				$sql = "INSERT INTO "._DB_PREFIX_."HotelFile(HotelId, HotelFileName, HotelFileName_jp, HotelFileName_en, HotelFileName_S_CN, HotelFileName_T_CN, HotelFilePath, HotelFileType, HotelFileIndex) ";
				$sql .="values('$hotelId', '$fn','$fn','$fn','$fn','$fn', '$fp', '$ft', '$fi')";
//echo $sql;die("vao day");
				Db::getInstance()->ExecuteS($sql);
				
				$fileId = Db::getInstance()->Insert_ID();
				
				/*$sql = 'INSERT INTO '._DB_PREFIX_.'HotelFileLink(HotelId, HotelFileId) ';
				$sql .="values('$hotelId', '$fileId')";
				Db::getInstance()->ExecuteS($sql);
				*/
                //p($sql);
				$ufiles[] = array($fileId, $fn, $fp); 
			}
		}
	
		return $ufiles;
	}
	
	public static function getHotelFile($fid)
	{
		$sql = 'SELECT * FROM '._DB_PREFIX_.'HotelFile where HotelFileId = '.$fid;
		return Db::getInstance()->ExecuteS($sql);
	}
	public static function delHotelFile($fid) {
		$sql = 'DELETE FROM '._DB_PREFIX_.'HotelFile where HotelFileId = '.$fid;
		return Db::getInstance()->ExecuteS($sql);
	}
	public static function getAllHotelFiles($hotelId) {
		$sql = ' select HT_HotelFile.* from HT_HotelFile 
				Where HT_HotelFile.HotelId = '.$hotelId . '
				ORDER By HT_HotelFile.HotelFileId ASC';
		$result = Db::getInstance()->ExecuteS($sql);
		$photoList = array();
		foreach ($result as $row) {
			$filepath = substr($row['HotelFilePath'], 0, strlen($row['HotelFilePath'])-4)."_n".substr($row['HotelFilePath'], strlen($row['HotelFilePath']) -4);
			list($width, $height, $type, $attr) = getimagesize(_TAS_ROOT_DIR_."/asset/".$filepath);
			
			// photo number 1
			if ($width < 160 && $height < 160) {
				$w1 = $width; $h1 = $height;
				$w1_path = $filepath;
			}  else {
				if ($width > $height) {
					$ratio1 = $width / 160; $w1 = 160; $h1 = intval($height / $ratio1);
				} else {
					$ratio1 = $height / 160; $h1 = 160; $w1 = intval($width / $ratio1);
				}
				$w1_path = $row['HotelFilePath'];
			}
			$row['w1'] = $w1; $row['h1'] = $h1; $row['w1_path'] = $w1_path;
			
			// photo number 2
			if ($width < 80 && $height < 60) {
				$w2 = $width; $h2 = $height; $w2_path = $filepath;
			} else {
				$ratio1=$width/80;
				$ratio2=$height/60;
				if ($ratio1 < $ratio2) {
					$w2 = 80;$h2 = intval($height / $ratio1);
				} else {
					$h2 = 60;$w2 = intval($width / $ratio2); 
				}
				$w2_path = $row['HotelFilePath'];
			}
			$row['w2'] = $w2; $row['h2'] = $h2; $row['w2_path'] = $w2_path; $row['w2_opath'] = $filepath;
			
			// photo number 5
			if ($width < 200 && $height < 200) {
				$w5 = $width; $h5 = $height; $w5_path = $filepath;
			}  else {
				if ($width > $height) {
					$ratio5 = $width / 200; $w5 = 200; $h5 = intval($height / $ratio5);
				} else {
					$ratio5 = $height / 200; $h5 = 200; $w5 = intval($width / $ratio5);
				}
				$w5_path = $row['HotelFilePath'];
			}
			$row['w5'] = $w5; $row['h5'] = $h5; $row['w5_path'] = $w5_path;
			$photoList[] = $row;
		}
		return $photoList;
	}
	
	public function getClassName() {
		return Db::getInstance()->getValue('
		SELECT `HotelClassName`
		FROM `'._DB_PREFIX_.'HotelClass`
		WHERE `HotelClassId` = '.(int)($this->HotelClass));
	}
	
	public function getSimilarHotelList() {
		$sql = 'SELECT DISTINCT HT_Hotel.* FROM '._DB_PREFIX_.'Hotel 
		left join HT_HotelRoomPlanLink on HT_HotelRoomPlanLink.HotelId = HT_Hotel.HotelId 
			left join HT_RoomPlan on HT_RoomPlan.RoomPlanId = HT_HotelRoomPlanLink.RoomPlanId 
			left join HT_RoomStockAndPrice on HT_RoomPlan.RoomPlanId = HT_RoomStockAndPrice.RoomPlanId 
			where HT_RoomStockAndPrice.Price>0 and HT_RoomStockAndPrice.ApplyDate > now() 
				and HT_Hotel.HotelId <> '.$this->HotelId.' and HT_Hotel.HotelArea <> '.$this->HotelArea.' LIMIT 0, 5';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public static function getPopularHotelList($areaid = 702) {
		$sql = 'SELECT DISTINCT HT_Hotel.*, 
			(select count(*) from HT_Order where HT_Order.HotelId = HT_Hotel.HotelId) orderCnt  
			FROM HT_Hotel 
			left join HT_HotelRoomPlanLink on HT_HotelRoomPlanLink.HotelId = HT_Hotel.HotelId 
			left join HT_RoomPlan on HT_RoomPlan.RoomPlanId = HT_HotelRoomPlanLink.RoomPlanId 
			left join HT_RoomStockAndPrice on HT_RoomPlan.RoomPlanId = HT_RoomStockAndPrice.RoomPlanId 
			where HT_RoomStockAndPrice.Price>0 and HT_RoomStockAndPrice.ApplyDate > now() AND HT_Hotel.HotelId !=827
			'; 
		if ($areaid!=0) $sql .= " and HT_Hotel.HotelArea = ".$areaid ;
		$sql .=' order by orderCnt desc LIMIT 0, 5';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public static function getFirstFileOfHotel($hid, $img_width=200, $img_height=200) {
		$sql = ' select HT_HotelFile.* from HT_HotelFile 
				Where HT_HotelFile.HotelId = '.$hid . '
				ORDER By HT_HotelFile.HotelFileIndex ASC 
				LIMIT 0, 1';
		$result = Db::getInstance()->ExecuteS($sql);
		$row = "";
		if ($result && $result[0]) {
			$row = $result[0]; 
			$filepath = substr($row['HotelFilePath'], 0, strlen($row['HotelFilePath'])-4)."_n".substr($row['HotelFilePath'], strlen($row['HotelFilePath']) -4);
			list($width, $height, $type, $attr) = getimagesize(_TAS_ROOT_DIR_."/asset/".$filepath);
			// photo number 5
			if ($width < $img_width && $height < $img_height) {
				$w5 = $width; $h5 = $height; $w5_path = $filepath;
			}  else {
				if ($width > $height) {
					$ratio5 = $width / $img_width; $w5 = $img_width; $h5 = intval($height / $ratio5);
				} else {
					$ratio5 = $height / $img_height; $h5 = $img_height; $w5 = intval($width / $ratio5);
				}
				$w5_path = $row['HotelFilePath'];
			}
			$row['w5'] = $w5; $row['h5'] = $h5; $row['w5_path'] = $w5_path;
		}
		return $row;  
	}
	public static function getLowestPriceOfHotel($hid) {
		$sql = 'SELECT HT_RoomStockAndPrice.Price
				from HT_HotelRoomPlanLink 
				left join HT_RoomPlan on HT_RoomPlan.RoomPlanId = HT_HotelRoomPlanLink.RoomPlanId 
				left join HT_RoomStockAndPrice on HT_RoomPlan.RoomPlanId = HT_RoomStockAndPrice.RoomPlanId 
				where HT_RoomStockAndPrice.Price>0 and HT_RoomStockAndPrice.ApplyDate > now() and HT_HotelRoomPlanLink.HotelId = '.$hid . '
				order by Price asc
				limit 0, 1';
		$result = Db::getInstance()->ExecuteS($sql);
		if ($result && $result[0]) return $result[0]['Price'];
	}
	public static function getAreaName($areaId) {
		$sql = "select AreaName from HT_Area where AreaId = ".$areaId;
		$result = Db::getInstance()->ExecuteS($sql);
		if ($result && $result[0]) return $result[0]['AreaName'];
	}

	// Author: quyennd
	// Description: get cityName
	public static function getCityName($cityId) {
		$sql = "select CityName_en from HT_City where CityId = ".$cityId;
		$result = Db::getInstance()->ExecuteS($sql);
		if ($result && $result[0]) return $result[0]['CityName_en'];
	}
	
	/*
	 *  get hotel info with relative description
	 *
	 * hotel contains meta info such as HotelClass's id, we need get that's name (HotelClassName exists the other table)
	 *
	 * @param int $hotelId hotel id
	 *
	 * @author zotiger
	 * @created 2012-11-09
	 */
	public static function getHotelDescription($hotelId, $iso="")
	{
        global $cookie;
        if ($iso == "") $iso = Language::getIsoById((int)$cookie->LanguageID);

		$sql = '
		SELECT
			A.HotelId, A.HotelCode, A.HotelName_'.$iso.' as HotelName, A.HotelClass, A.`HotelCity`, A.HotelArea, A.HotelAddress_'.$iso.' as HotelAddress, A.HotelContactNo, B.`HotelClassName`, C.`AreaName_'.$iso.'` as AreaName, D.`CityName_'.$iso.'` as CityName
		FROM
			HT_Hotel as A, `HT_HotelClass` as B, HT_Area as C, HT_City as D
		WHERE
			A.`HotelClass` = B.`HotelClassId` AND A.HotelArea = C.`AreaId` AND A.`HotelCity` = D.CityId AND  A.`HotelId` = '.$hotelId.'
		';
		$result = Db::getInstance()->ExecuteS($sql);
		if (!$result)
			return null;
		return $result[0];
	}
	
	public static function getHotelByAreaCityCount($search_form, $iso = "") {
		global $cookie;
        if ($iso == "") $iso = Language::getIsoById((int)$cookie->LanguageID);
		
		$areaid = $search_form['AreaId'];
		$cityid = $search_form['CityId'];
		$hotelclass = $search_form['HotelClassId'];
		$hotelname = $search_form['HotelName']; 
		
		$sql = 'select count(HotelId) from HT_Hotel ';
        if ($cityid == 0 && $areaid == 0) {
            $sql .= 'WHERE `HotelArea` >0 ';
        } else {
            $sql .= 'WHERE `HotelArea` = '.$areaid;
            $sql .= $cityid != 0 ? ' AND `HotelCity` = '.$cityid : '';
          	$sql .= $hotelclass != 0 ? ' AND `HotelClass` = '.$hotelclass : '';
        }
		$sql .= $hotelname != "" ? " AND `HotelName_{$iso}` like '%{$hotelname}%' " : '';
		return (int)Db::getInstance()->getValue($sql);
	}
	
	public static function getHotelByAreaCity($search_form, $p, $n, $iso = "") {
		global $cookie;
        if ($iso == "") $iso = Language::getIsoById((int)$cookie->LanguageID);
		
        $areaid = $search_form['AreaId'];
		$cityid = $search_form['CityId'];
		$hotelclass = $search_form['HotelClassId'];
		$hotelname = $search_form['HotelName']; 
		
		$sql = '
		SELECT
			A.HotelId, A.HotelName_'.$iso.' as HotelName, A.HotelClass, B.`HotelClassName`, A.HotelAddress_'.$iso.' as HotelAddress,
			A.`HotelCity`, D.`CityName_'.$iso.'` as CityName, A.HotelArea, C.`AreaName_'.$iso.'` as AreaName, A.HotelDescription_'.$iso.' as HotelDescription 
		FROM
			HT_Hotel as A LEFT JOIN (`HT_HotelClass` as B, HT_Area as C, HT_City as D) 
		ON (A.`HotelClass` = B.`HotelClassId` AND A.`HotelArea` = C.`AreaId` AND A.`HotelCity` = D.CityId) ';
        if ($cityid == 0 && $areaid == 0) {
            $sql .= 'WHERE A.`HotelArea` >0 ';
        } else {
            $sql .= 'WHERE A.`HotelArea` = ' . $areaid;
            $sql .= $cityid != 0 ? ' AND `HotelCity` = ' . $cityid : '';
            $sql .= $hotelclass != 0 ? ' AND `HotelClass` = ' . $hotelclass : '';
        }
		$sql .= $hotelname != "" ? " AND `HotelName_{$iso}` like '%{$hotelname}%' " : '';
		$sql .= ' LIMIT '.(($p - 1) * $n).','.$n;
		$res = Db::getInstance()->ExecuteS($sql);
		if (!$res) {
			return null;
		}
		
		$search_result = array();
		foreach ($res as $hotel_roomplan) {
			$hotel_id = $hotel_roomplan['HotelId'];
			
			$search_record = array();
			if (array_key_exists($hotel_id, $search_result)) {
				$search_record = $search_result[$hotel_id];
			} else { 
				$search_record = Tools::element_copy($hotel_roomplan, 'HotelId', 'HotelName', 'HotelClass', 'HotelClassName', 'HotelAddress', 
				'HotelCity', 'CityName' , 'HotelArea', 'AreaName', 'HotelDescription');
				
				$image = HotelDetail::getFirstFileOfHotel($search_record['HotelId']);
				$search_record['HotelFilePath'] = $image['HotelFilePath'];
				$search_record['w5_path'] = $image['w5_path'];
				$search_record['w5'] = $image['w5'];
				$search_record['h5'] = $image['h5'];
			}
			
			$search_result[$hotel_id] = $search_record;
		}
		
		return $search_result;
	}

	public static function updateHotelImage($imageid, $name, $order,$iso='jp') {
		$sql = "update HT_HotelFile set HotelFileName_$iso = '".$name."', HotelFileIndex = ".$order. " where HotelFileId = ".$imageid;
		Db::getInstance()->Execute($sql);
	}

	public static function addExcelHotel($hotelinfo) {
		$code = $hotelinfo['HotelCode'];
		$query = "SELECT HotelId FROM "._DB_PREFIX_."Hotel WHERE HotelCode='$code'";
		$result = Db::getInstance()->getRow($query);
		
		if ($result) {		//如果$hotelid不为空，则进行更新操作
			$hotelid = $result['HotelId'];
			
			$setsdata = array('HotelCode', 'HotelName_en', 'HotelName_jp', 'HotelName_S_CN', 'HotelName_T_CN',
				'HotelClass', 'HotelCity', 'HotelArea', 'HotelContactNo');
			$setsinfo = array_intersect_key($hotelinfo, array_flip($setsdata));
			$sets = '';
			foreach($setsinfo as $key => $value)
				$sets .= $key."='".$value."',";
			$sets = substr($sets, 0, -1);
			
			$sql = "update "._DB_PREFIX_."Hotel set ".$sets." where `HotelId` = '{$hotelid}'";
			Db::getInstance() -> Execute($sql);
			return $hotelid;
		} else {			//$hotelid不存在，进行插入操作
			$setsdata = array('HotelCode', 'HotelName_en', 'HotelName_jp', 'HotelName_S_CN', 'HotelName_T_CN',
				'HotelClass', 'HotelCity', 'HotelArea', 'HotelContactNo');
			$setsinfo = array_intersect_key($hotelinfo, array_flip($setsdata));
			$sets = '';
			foreach($setsinfo as $key => $value)
				$sets .= $key."='".$value."',";
			$sql = "insert into "._DB_PREFIX_."Hotel set ".$sets." Active = 1";
			Db::getInstance() -> Execute($sql);
			$hotelid = Db::getInstance()->Insert_ID();

			if ($code == '_') {
				$hotelCode = "JP".str_pad($hotelid, 6, "0", STR_PAD_LEFT);
				$sql = "update "._DB_PREFIX_."Hotel set `HotelCode` = '{$hotelCode}' where `HotelId` = '{$hotelid}'";
				Db::getInstance() -> Execute($sql);
			}
			return $hotelid;
		}
	}

		
	//获取数据中符合搜索条件的第一条信息
	public static function getHotelInfoByExcel($hotelinfo) {
		$setsdata = array('HotelName_en', 'HotelName_jp', 'HotelName_S_CN', 'HotelName_T_CN',
				'HotelClass', 'HotelCity', 'HotelArea', 'HotelContactNo');
		$setsinfo = array_intersect_key($hotelinfo, array_flip($setsdata));
		$search = '';
		foreach($setsinfo as $key => $value)
			$search .= " and ".$key." = '".$value."' ";
				
		$sql = "select HotelId, HotelCode from HT_Hotel where 1 = 1".$search." order by HotelId ";
		return Db::getInstance() -> getRow($sql);
	}

	public static function getHotelByUserId($UserlId) {
		$sql = "select HT_User.HotelId, HT_Hotel.HotelCode from HT_Hotel, HT_User where HT_Hotel.HotelId=HT_User.HotelId ";
		$sql .= $UserlId ? "and HT_User.UserId='{$UserlId}' " : "";
		return Db::getInstance()->getRow($sql);
	}
	
	
	public static function getHotelByHotelCode($HotelCode) {
		$sql = "select HotelId, HotelCode from HT_Hotel where 1=1 ";
		$sql .= $HotelCode ? "and HotelCode='{$HotelCode}' " : "";
		return Db::getInstance()->getRow($sql);
	}

    public static function getHotelName($hotelId, $iso = "")
    {
        global $cookie;
        if ($iso == "") $iso = Language::getIsoById((int)$cookie->LanguageID);

        $sql = 'SELECT
   			 A.HotelName_' . $iso . '
   		FROM
   			'._DB_PREFIX_.'Hotel as A
   		WHERE
   			 A.`HotelId` = ' . $hotelId;
        //echo $sql;
        return Db::getInstance()->getValue($sql);
    }
    public static function getHotelInfo($hotelId,$info, $iso = "")
    {
        global $cookie;
        if ($iso == "") $iso = Language::getIsoById((int)$cookie->LanguageID);

        $sql = 'SELECT
   			 A.'.$info.'_' . $iso . '
   		FROM
   			'._DB_PREFIX_.'Hotel as A
   		WHERE
   			 A.`HotelId` = ' . $hotelId;
        //echo $sql;
        return Db::getInstance()->getValue($sql);
    }
}
