<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class RoomStockController extends FrontController
{
	protected  $searchField = array ('CompanyName' => 'like', 'LoginUserName' => 'like', 'Email' => 'like', 'Name' => 'like');
	 
	public function __construct()
	{
		$this->php_self = "roomstock.php";
		
		
		parent::__construct();
	}
	public function preProcess()
	{
		if (!Tools::hasFunction('room_stock')) Tools::redirect('index.php');

		if (self::$cookie->RoleID == 2 || self::$cookie->RoleID == 3) // hotel user
		{
			$error['no'] = 1;
			$error['message'] = 'User can not access this page';
			self::$smarty->assign("error", $error);
			self::$smarty->display(_TAS_THEME_DIR_.'error_redirect.tpl');
			exit();
		}
		
		
		if (Tools::isSubmit('SubmitBatch')){
			$roomplanId = trim(Tools::getValue('RoomPlanId'));
			$date = trim(Tools::getValue('staDate'));
			$endDate = trim(Tools::getValue('endDate'));
			$amount = trim(Tools::getValue('Amount'));
			$price = trim(Tools::getValue('Price')); if($price=="") $price =0;
			$asia = trim(Tools::getValue('Asia'));	if($asia=="") $asia =0;
			$euro = trim(Tools::getValue('Euro'));	if($euro=="") $euro =0;
			
			$amount = str_replace(",", "", $amount);
			$price = str_replace(",", "", $price);
			$asia = str_replace(",", "", $asia);
			$euro = str_replace(",", "", $euro);
			
			$sql = "";
			while (strtotime($date) <= strtotime($endDate)) {								
				$sql .=",(0, $roomplanId, '$date', $price, $amount, $asia, $euro)";
				$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
			}			
			if($sql != ""){	$sql = substr($sql, 1);
				Db::getInstance()->Execute("INSERT INTO `"._DB_PREFIX_."RoomStockAndPrice` 
					VALUES $sql
					ON DUPLICATE KEY UPDATE Amount=VALUES(Amount), Price=VALUES(Price), Asia=VALUES(Asia), Euro=VALUES(Euro)");
			}			
		}else if (Tools::isSubmit('SubmitCal')){
			$roomplanId = trim(Tools::getValue('RoomPlanId'));
			$dateArr = $_POST['adate'];			
			$amountArr = $_POST['amount'];
			$priceArr = $_POST['price'];
			$asiaArr = $_POST['asia'];
			$euroArr = $_POST['euro'];
			
			$sql = "";
			for ($i=0; $i<count($dateArr); $i++ ){
				$priceArr[$i] = str_replace(",", "", $priceArr[$i]);
				$asiaArr[$i] = str_replace(",", "", $asiaArr[$i]);
				$euroArr[$i] = str_replace(",", "", $euroArr[$i]);
				$amountArr[$i] = str_replace(",", "", $amountArr[$i]);
				
				if($priceArr[$i]=='') $priceArr[$i]=0;					if($amountArr[$i]=='') $amountArr[$i]=0;
				if($asiaArr[$i]=='') $asiaArr[$i]=0;					if($euroArr[$i]=='') $euroArr[$i]=0;
				
				
				$sql .=",(0, $roomplanId, '{$dateArr[$i]}', {$priceArr[$i]}, {$amountArr[$i]}, {$asiaArr[$i]}, {$euroArr[$i]})";
			}
			//...echo $sql;
			if($sql != ""){	$sql = substr($sql, 1);
				Db::getInstance()->Execute("INSERT INTO `"._DB_PREFIX_."RoomStockAndPrice` 
					VALUES $sql
					ON DUPLICATE KEY UPDATE Amount=VALUES(Amount), Price=VALUES(Price), Asia=VALUES(Asia), Euro=VALUES(Euro)");
			}
		}
        if (self::$cookie->RoleID > 1) {
            global $cookie;
            $iso = Language::getIsoById((int)$cookie->LanguageID);
            $hotel = new HotelDetail($_REQUEST['hid']);
            $HotelNameKey = 'HotelName_' . $iso;
            $this->brandNavi[] = array("name" => $hotel->$HotelNameKey, "url" => "hotelpage.php?mid=" . $_REQUEST['hid']);
        }
        $this->brandNavi[] = array("name"=>"Room Stock Management", "url"=>"room_stock.php?hid=". $_REQUEST['hid']);
	}
	public function process()
	{
		parent::process();
		$hid = Tools::getValue("hid") ? Tools::getValue("hid") : self::$cookie->HotelID;
		
		//... room plan list 
		global $cookie;
		$iso = Language::getIsoById((int)$cookie->LanguageID);

		$sql = "SELECT ln.RoomPlanId, RoomPlanName_".$iso." as RoomPlanName, CAST(StartTime AS Date) AS staDate, CAST(EndTime AS Date) AS endDate
			FROM HT_HotelRoomPlanLink AS ln, HT_RoomPlan pl 
			WHERE ln.HotelId=".$hid." AND ln.RoomPlanId=pl.RoomPlanId ";
		$planList = Db::getInstance()->ExecuteS($sql);
		self::$smarty->assign("planList", $planList);
		
		if (count($planList) == 0){
			$error['no'] = 1;
			$error['message'] = 'No Room Plan';
			self::$smarty->assign("error", $error);
			self::$smarty->display(_TAS_THEME_DIR_.'error_redirect.tpl');
			
			//$this->errors[] = Tools::displayError('No Room Plan');
			exit();
		}
		
		$dateYm = (Tools::getValue('dateYm')!=null) ? trim(Tools::getValue('dateYm')) : date("Y-m");
		$pno = (Tools::getValue('pno')!=null) ? Tools::getValue('pno') : (Tools::getValue("RoomPlanId")!="" ? Tools::getValue("RoomPlanId") :  $planList[0]['RoomPlanId']) ;
		
		$prow = null;
		for($i=0; $i<count($planList); $i++){			
			if ($planList[$i]['RoomPlanId']==$pno){ 
				$prow=$planList[$i]; 
				$prow['staDate1'] = date("Y-m-d");
				$prow['endDate1'] = date("Y-m-d", strtotime('-1 second', strtotime('+2 month', strtotime(date("Y-m")."-01"))));
				break;
			}
		}	

		if ($prow == null){	
			$error['no'] = 1;
			$error['message'] = 'No Room Plan';
			self::$smarty->assign("error", $error);
			self::$smarty->display(_TAS_THEME_DIR_.'error_redirect.tpl');
		}

		self::$smarty->assign("prow", $prow);
		self::$smarty->assign("pno", $pno);
		self::$smarty->assign("hid", $hid);
		

		$ts = strtotime($dateYm."-01");
		$staTime = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
		$endTime = strtotime("+41 day", $staTime);
		$stock = new Stock();
		$stockList = $stock->getStockList(date("Y-m-d",$staTime), date("Y-m-d",$endTime), $pno); 
		$pos = 0;
		$resList = array();
		while($staTime <= $endTime){ $staDate = date("Y-m-d", $staTime);
			if($stockList[$pos]["ApplyDate"] == $staDate){
				$stock = $stockList[$pos];
				/*if($stock["Amount"]==0) $stock["Amount"]="";*/			if($stock["Price"]==0) $stock["Price"]="";
				if($stock["Asia"]==0) $stock["Asia"]="";				if($stock["Euro"]==0) $stock["Euro"]="";				
				$resList[] = $stock; 
				$pos ++;
			}else{
				$resList[]["ApplyDate"] = $staDate;
			}
			//... outside of Room Plan Duration
			if ($staTime<strtotime($prow['staDate']) || $staTime>strtotime($prow['endDate'])){
				$resList[count($resList)-1]["isout"] = "true";
			}
			$staTime = strtotime("+1 day", $staTime);
		}
        $dateYrar = date('Y');
        $dateMonth = date('m');
        $dateList=array();
        for($i=0;$i<13;$i++){
            $dateList[$i]=$dateYrar.'-'.$dateMonth;
            $dateMonth++;
            if($dateMonth>12){
                $dateMonth=1;
                $dateYrar=$dateYrar+1;
            }
            if($dateMonth<10){
                $dateMonth="0".$dateMonth;
            }
        }
		//p($dateList);
		self::$smarty->assign("list", $resList);		
		self::$smarty->assign("dateYm", $dateYm);
        self::$smarty->assign("dateList", $dateList);
	}
	
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display(_TAS_THEME_DIR_.'roomstock.tpl');
	}
}
