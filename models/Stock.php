<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class Stock extends ObjectModel
{
	public 		$RoomPriceId;
	public 		$RoomPlanId;
	public 		$ApplyDate;
	public 		$Price;
	public 		$Amount;	
	public 		$Asia;
	public 		$Euro;
	
	protected $tables = array ('RoomStockAndPrice');

 	protected 	$fieldsRequired = array('RoomPlanId', 'ApplyDate', 'Amount');
 	protected 	$fieldsSize = array();
 	protected 	$fieldsValidate = array( 'ApplyDate' => 'isBirthDate', 'RoomPlanId' => 'isUnsignedInt', 'Amount' => 'isUnsignedInt'
 			, 'Price' => 'isFloat', 'Asia' => 'isFloat', 'Euro' => 'isFloat');
	protected	$exclude_copy_post = array();

	protected 	$table = 'RoomStockAndPrice';
	protected 	$identifier = 'RoomPriceId';

	public function getFields()
	{
		parent::validateFields();
		if (isset($this->RoomPriceId))
			$fields['RoomPriceId'] = (int)($this->RoomPriceId);
			
		$fields['ApplyDate'] 		= pSQL($this->ApplyDate);
		$fields['Amount'] = (int)($this->Amount);
		$fields['Price'] = pSQL($this->Price);
		$fields['Asia'] = pSQL($this->Asia);
		$fields['Euro'] = pSQL($this->Euro);
		$fields['RoomPlanId'] = (int)($this->RoomPlanId);
		
		return $fields;
	}
	
	
	/*
	 * Return stock list
	 *
	 * @return array Room Stocks
	 */
	public function getStockList($staDate, $endDate, $RoomPlanId)
	{
		/*$staDate = $dateYm."-01";
		$endDate = date ("Y-m-d", strtotime("+1 month", strtotime($staDate)));*/
		$sql =  "SELECT * FROM `"._DB_PREFIX_."RoomStockAndPrice`  
					WHERE RoomPlanId={$RoomPlanId} AND ApplyDate >= '{$staDate}' AND ApplyDate<='{$endDate}'  
					ORDER BY ApplyDate ";
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public static function addExcelStock($roomPriceId, $roomstockdata) {
		if ($roomPriceId) {
			$setsdata = array('RoomPlanId', 'ApplyDate', 'Amount', 'Price', 'Asia', 'Euro');
			$setsinfo = array_intersect_key($roomstockdata, array_flip($setsdata));
			$sets = '';
			foreach($setsinfo as $key => $value)
				$sets .= $key."='".$value."',";
			$sets = substr($sets, 0, -1);
			
			$sql = "update "._DB_PREFIX_."RoomStockAndPrice set ".$sets." where `RoomPriceId` = '{$roomPriceId}'";
			Db::getInstance() -> Execute($sql);
			return $roomPriceId;
		} else {
			$setsdata = array('RoomPlanId', 'ApplyDate', 'Amount', 'Price', 'Asia', 'Euro');
			$setsinfo = array_intersect_key($roomstockdata, array_flip($setsdata));
			$sets = '';
			foreach($setsinfo as $key => $value)
				$sets .= $key."='".$value."',";
			$sets = substr($sets, 0, -1);
			
			$sql = "insert into "._DB_PREFIX_."RoomStockAndPrice set ".$sets;
			Db::getInstance() -> Execute($sql);
			return Db::getInstance()->Insert_ID();
		}
	}

	//    Author: quyennd
	//    Update amount stock
    public static function updateAmountStock($checkin, $night, $roomplan_list) {
        for($j=0; $j<count($roomplan_list);$j++) {
            $checkinFor = $checkin;
            for ($i = 0; $i < $night; $i++) {
                $sql = "update " . _DB_PREFIX_ . "RoomStockAndPrice SET Amount = Amount +1 where `RoomPlanId` = ".$roomplan_list[$j]." and `ApplyDate` = '" . $checkinFor . "'";
                Db::getInstance()->Execute($sql);
                $checkinFor = date('Y-m-d', strtotime($checkinFor . ' +1 day'));
            }
        }
    }
}
