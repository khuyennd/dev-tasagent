<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}

function trim_value(&$item1, $key)
{
   	$item1 = trim($item1);
   	
}


class HotelDataImportController extends FrontController{
	
	protected $hotelClasses;
	protected $roomTypes;
	
	
	public function __construct()
	{
		$this->php_self = "hoteldataimport.php";
		parent::__construct();
	}
	
	public function preProcess(){
		if (!Tools::hasFunction('hotel_data_import')) Tools::redirect('index.php');
		$this->brandNavi[] = array("name"=>"Hotel Data Import", "url"=>'hoteldataimport.php');
	}
	
	public function process(){
		
		if(Tools::isSubmit("import")){//when import clicked
			$excelinfos = $this->parseImportFile();	//从文件中获取录入信息
			$result = $this->importHotelData($excelinfos);
			
			self::$smarty->assign('result',$result);
			self::$smarty->assign('cnt',count($result));
			self::$smarty->assign('status',1);	
		}
		else
			self::$smarty->assign('status',0);
	}
	
	public function displayContent(){
		parent::displayContent();
		self::$smarty->display(_TAS_THEME_DIR_.'hoteldataimport.tpl');
	}
	
	//protected function importHotelData() {
	//	$excelinfos = $this->parseImportFile();	//从文件中获取录入信息
	protected function importHotelData(&$exceldata, $page = 0, $length = 10) {
		$count = count($exceldata);
		$start = $page * $length;
		if ($start + $length < $count) {
			$page++;
			$result = $this->importHotelData($exceldata,  $page, $length);
			$excelinfos = array_slice($exceldata, $start, $length, true);
		} else {
			$length = $count - $start;
			$excelinfos = array_slice($exceldata, $start, $length, true);
		}	

		//录入信息
		$rowno = 1; 
		foreach($excelinfos as $row) {
			/*** Start: 检查该行信息中是否有空值, 如果除了price_all, price AS, price EU之外有空值，则跳过本行**/
			foreach($row as $key => $value) {
				if($value == '' || $value == null) {
					if ($key == 'HotelCode' || $key == 'HotelContactNo') continue;
					else break;
				}
			}
            $row['Amount']=$row['RoomStock'];
//var_dump($row);
			if(substr($key, 0, 5) != 'price') { 
				$this->errors[] = Tools::displayError("Excel File Line {$rowno}: < {$key} > invalid.");
				$rowno++;
				continue;
			}
			if(!($row['price_all'] || $row['price_as'] || $row['price_eu'])) {
				$this->errors[] = Tools::displayError("Excel File Line {$rowno}: < price_all, price_as, price_eu > can't be simultaneously empty.");
				$rowno++;
				continue;
			}
			if (!is_numeric($row['RoomMaxPersons'])) {
				$this->errors[] = Tools::displayError("Excel File Line {$rowno}: < RoomMaxPersons > invalid.");
				$rowno++;
				continue;
			}
			if (!is_numeric($row['Amount'])) {
				$this->errors[] = Tools::displayError("Excel File Line {$rowno}: < Amount > invalid.");
				$rowno++;
				continue;
			}
            if(strcmp(strtolower($row['Breakfast']),"include")==0){
                $row['Breakfast']=1;
            }
            if(strcmp(strtolower($row['Breakfast']),"none")==0){
                $row['Breakfast']=0;
            }
            if(strcmp(strtolower($row['Dinner']),"include")==0){
                $row['Dinner']=1;
            }
            if(strcmp(strtolower($row['Dinner']),"none")==0){
                $row['Dinner']=0;
            }
			if ($row['Breakfast'] != 0 && $row['Breakfast'] != 1) {
				$this->errors[] = Tools::displayError("Excel File Line {$rowno}: < Breakfast > invalid.");
				$rowno++;
				continue;
			}
			if ($row['Dinner'] != 0 && $row['Dinner'] != 1) {
				$this->errors[] = Tools::displayError("Excel File Line {$rowno}: < Dinner > invalid.");
				$rowno++;
				continue;
			}
			if ($row['StartTime'] > $row['EndTime']) {
				$this->errors[] = Tools::displayError("Excel File Line {$rowno}: < StartTime or EndTime > invalid.");
				$rowno++;
				continue;
			}
			$roomTypeId = $this->getRoomTypeId($row['RoomTypeName']);
			if (empty($roomTypeId)) {
				$this->errors[] = Tools::displayError("Excel File Line {$rowno}: <{RoomTypeName}> invalid.");
				$rowno++;
				continue;
			}
			$hotel->HotelClass = $this->getHotelClassId($row['HotelClass']);
			if (empty($hotel->HotelClass)) {
				$this->errors[] = Tools::displayError("Excel File Line {$rowno}: <{HotelClass}> invalid.");
				$rowno++;
				continue;
			}
			$hotel->HotelCity = $this->getCityId($row['CityName_en']);
			if (empty($hotel->HotelCity)) {
				$this->errors[] = Tools::displayError("Excel File Line {$rowno}: <{HotelCity}> invalid.");
				$rowno++;
				continue;
			}
			$hotel->HotelArea = $this->getAreaId($row['AreaName_en']);
			if (empty($hotel->HotelArea)) {
				$this->errors[] = Tools::displayError("Excel File Line {$rowno}: <{HotelArea}> invalid.");
				$rowno++;
				continue;
			}

			if (!$row['HotelCode']) {	//当HotelCode为空是, //要么生成一个，要么用数据库中的
				$search = array('HotelName_en', 'HotelName_jp', 'HotelName_S_CN', 'HotelName_T_CN', 
					'HotelClass', 'AreaName_en', 'CityName_en', 'HotelContactNo');
				$searchinfo = array_intersect_key($row, array_flip($search));
				$row['HotelCode'] = $this->getHotelCode($searchinfo);

				if ($row['HotelCode'] == -1) {
					$this->errors[] = Tools::displayError("Adding Hotel <{HotelClass} or {HotelArea} or {HotelCity}> failed.");
				} 
				
				if (!is_string($row['HotelCode'])) {
					$row['HotelCode'] = '_';
				}
			}
			/***** End: 讲过检查本行之后，确保本行信息中没有空值。之后不再做检查 ****************/

			/************** Start: 酒店处理 *****************/
			$hoteldata = array('HotelCode', 'HotelName_en', 'HotelName_jp', 'HotelName_S_CN', 'HotelName_T_CN', 
				'HotelClass', 'AreaName_en', 'CityName_en', 'HotelContactNo');
			$hotelinfo = array_intersect_key($row, array_flip($hoteldata));
			$hotelId = $this->addHotelData($hotelinfo);	//如果hotelCode已经存在，则更新否则插入
			if ($hotelinfo['HotelCode'] == '_') {
				$hotelinfo['HotelCode'] = "JP".str_pad($hotelId, 6, "0", STR_PAD_LEFT);
			}

			if($hotelId == -1) {
				$this->errors[] = Tools::displayError("Adding Hotel <{$row['HotelCode']}> failed.");
			} else {
				global $cookie;
				$iso = Language::getIsoById((int)$cookie->LanguageID);
				$result[] = array('code' => $hotelinfo['HotelCode'], 'name' => $hotelinfo['HotelName_'.$iso]);
			}
			/************** End: 酒店处理结束 *******************************/

			/***************** Start: RoomPlan处理 **************************/
			$roomplandata = array('RoomTypeName', 'RoomPlanName_en', 'RoomPlanName_jp', 'RoomPlanName_S_CN', 'RoomPlanName_T_CN', 
				'RoomMaxPersons', 'StartTime', 'EndTime', 'Breakfast', 'Dinner');
			$roomplaninfo = array_intersect_key($row, array_flip($roomplandata));
			$roomplanId = $this->addRoomPlan($hotelId, $roomplaninfo);
			
			if(!$roomplanId) {
				$rowno++;
				continue;
			}
			/***************** End: RoomPlan处理结束 ************************/

			/**************** Start: RoomStock处理 ********************/
			$roomstockdata = array('StartTime', 'EndTime', 'Amount', 'price_all', 'price_as', 'price_eu');
			$roomstockinfo = array_intersect_key($row, array_flip($roomstockdata));
			$stocks = $this->addRoomStock($roomplanId, $roomstockinfo);
			/***************** End: RoomStock处理结束 *****************/

			$rowno++;
		}
		
		return $result;
		//self::$smarty->assign('result',$result);
		//self::$smarty->assign('cnt',count($result));
	}

	//将Excel文件解析为数组的形式 
	protected function parseImportFile() {
		/********************* Start: 解析上传文件 ************************************/
 		$error = $_FILES['hotelexcel']['error'];
 		if($error != 0){
 			$this->errors[] = Tools::displayError('File not found. try again');
 			return null;
 		}

 		$inputFileName = $_FILES['hotelexcel']['tmp_name'];
 		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		try {
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objReader->setReadDataOnly(true);
			$objPHPExcel = $objReader->load($inputFileName);
		} catch(Exception $e) {
			$this->errors[] = Tools::displayError('Loading excel file failed.');
			return null;
		}

		$excelinfo = $objPHPExcel->getActiveSheet()->toArray();	//获取文件内容
		
		//关闭相关资源
		$objPHPExcel->disconnectWorksheets();
		unset($objPHPExcel);
		unlink($inputFileName);

		$column_names = array_shift($excelinfo);	//获取列标题
		
		$result = array();		//获取数据，并以assoc方式保存
 		foreach ($excelinfo as $value) {
			$result[] = array_combine($column_names, $value);
		}

		foreach ($result as $key => $value) {
			$result[$key]['StartTime'] = date("Y-m-d",PHPExcel_Shared_Date::ExcelToPHP($value['StartTime']));
			$result[$key]['EndTime'] = date("Y-m-d",PHPExcel_Shared_Date::ExcelToPHP($value['EndTime']));
		}
		/******************** End 将Excel文件转储为 assoc array的形式 *******************/
		
		return $result;
	}

	//添加酒店信息到数据库中，但如果酒店信息已经存在，则返回他得HotelId
	protected function addHotelData($hotelinfo) {
		$hotelinfo['HotelClass'] = $this->getHotelClassId($hotelinfo['HotelClass']);
		$hotelinfo['HotelCity'] = $this->getCityId($hotelinfo['CityName_en']);
		$hotelinfo['HotelArea'] = $this->getAreaId($hotelinfo['AreaName_en']);
	
		if(!$hotelinfo['HotelClass'] || !$hotelinfo['HotelCity'] || !$hotelinfo['HotelArea'])
			return -1;
		return HotelDetail::addExcelHotel($hotelinfo);
	}

	//添加RoomPlan
	function addRoomPlan($hotelId, $roomplaninfo) {
		$roomTypeId = $this->getRoomTypeId($roomplaninfo['RoomTypeName']);
		return RoomPlan::addExcelRoomPlan($hotelId, $roomTypeId, $roomplaninfo);
	}
	
	//添加RoomStock
	function addRoomStock($roomplanId, $roomstockdata) {
		$start = strtotime($roomstockdata['StartTime']);
		$end = strtotime($roomstockdata['EndTime']);
		$roomstockdata['RoomPlanId'] = $roomplanId;
		
		$roomstockdata['Price'] = $roomstockdata['price_all'];
		$roomstockdata['Asia'] = $roomstockdata['price_as'];
		$roomstockdata['Euro'] = $roomstockdata['price_eu'];
		
		$DAY_IN_SECONDS = 24*60*60;
		while($start <= $end) {
			$sql = "SELECT `RoomPriceId` FROM "._DB_PREFIX_."RoomStockAndPrice WHERE `RoomPlanId`='{$roomplanId}' AND `ApplyDate`='".date("Y-m-d", $start)."'";
			$result = Db::getInstance() -> getRow($sql);
			
			$roomstockdata['ApplyDate'] = date("Y-m-d", $start);
			$temp = Stock::addExcelStock($result['RoomPriceId'], $roomstockdata);
			$start += $DAY_IN_SECONDS;
		}
	}
	
	//获取酒店信息ID
	protected function getHotelClassId($hotelClassName) {
		$hotelClassName = pSQL($hotelClassName);
		$hotelclass = Db::getInstance()->getRow("SELECT HotelClassId FROM "._DB_PREFIX_."HotelClass where HotelClassName='$hotelClassName'");
		return $hotelclass['HotelClassId'];
	}

	//获取房间类型ID
	protected function getRoomTypeId($roomTypeName) {
		$roomTypeName = pSQL($roomTypeName);
		$roomtypes = Db::getInstance()->getRow("SELECT RoomTypeId FROM "._DB_PREFIX_."RoomType where RoomTypeName='{$roomTypeName}'");
		return $roomtypes['RoomTypeId'];
	}
	
	//获取城市ID
	protected function getCityId($cityName) {
		$cityName = pSQL($cityName);
		$citys = Db::getInstance()->getRow("SELECT CityId FROM "._DB_PREFIX_."City WHERE CityName_en='{$cityName}'");
		return $citys['CityId'];
	}
	//获取区域ID
	protected function getAreaId($areaName) {
		$areaName = pSQL($areaName);
		$areas = Db::getInstance()->getRow("SELECT AreaId FROM "._DB_PREFIX_."Area WHERE AreaName_en='{$areaName}'");
		return $areas['AreaId'];
	}

	protected function getHotelCode($hotelinfo) {
		$hotelinfo['HotelClass'] = $this->getHotelClassId($hotelinfo['HotelClass']);
		$hotelinfo['HotelCity'] = $this->getCityId($hotelinfo['CityName_en']);
		$hotelinfo['HotelArea'] = $this->getAreaId($hotelinfo['AreaName_en']);
	
		if(!$hotelinfo['HotelClass'] || !$hotelinfo['HotelCity'] || !$hotelinfo['HotelArea'])
			return -1;
		$searchinfo = HotelDetail::getHotelInfoByExcel($hotelinfo);
		if ($searchinfo['HotelCode']) {
			return $searchinfo['HotelCode'];	
		} else {
			return 0;			
		}
	}
}

?>