<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}

class Promotion extends ObjectModel
{
	
	//Db - fields
	public $PromotionId;
	
	public $HotelName;
	public $AreaId;
	public $StaDate;
	public $EndDate;
	public $Title;
	public $Content;
	public $Type;
	public $WriteId;
	
	public $CreateDate;
	public $UpdateDate;
	
	//extra fields
	public $AreaName;
	public $UserName;
	
	public static $TYPE_PROMOTION = 0;
	public static $TYPE_EVENT = 1;
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	protected 	$fieldsRequired = array('AreaId', 'HotelName', 'Title', 'StaDate','EndDate');
 	protected 	$fieldsSize = array('HotelName' => 255, 'Title' => 255);
 	protected 	$fieldsValidate = array( 'AreaId' => 'isUnsignedId');
	protected	$exclude_copy_post = array();

	protected 	$table = 'Promotion';
	protected 	$identifier = 'PromotionId';
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	public function getFields()
	{	
		parent::validateFields();
		if (isset($this->PromotionId) && $this->PromotionId > 0)
			$fields['PromotionId'] = (int)($this->PromotionId);
			
		$fields['HotelName'] = pSQL($this->HotelName);
		$fields['AreaId'] 	= (int)($this->AreaId);
		$fields['Title'] 		= pSQL($this->Title);
		$fields['StaDate'] 	= pSQL($this->StaDate);
		$fields['EndDate'] = pSQL($this->EndDate);
		$fields['Content'] = pSQL($this->Content);
		$fields['Type'] = (int)($this->Type);
		$fields['WriterId'] = (int)($this->WriterId);
		$fields['CreateDate'] = pSQL($this->CreateDate);
		$fields['UpdateDate'] = pSQL($this->UpdateDate);
		
		return $fields;
	}
	
	public function getAsArray(){
		$fields['PromotionId'] = $this->PromotionId;
		$fields['HotelName'] = $this->HotelName;
		$fields['AreaId'] = $this->AreaId;
		$fields['StaDate'] = $this->StaDate;
		$fields['EndDate'] = $this->EndDate;
		$fields['Title'] = $this->Title;
		$fields['Content'] = $this->Content;
		$fields['Type'] = $this->Type;
		$fields['WriteId'] = $this->WriteId;
		
		$fields['AreaName'] = $this->AreaName;
		$fields['UserName'] = $this->UserName;
		
		return $fields;
	}
	
	public function getById($id){
		global $cookie;
		$iso = Language::getIsoById((int)$cookie->LanguageID);
		
		$A = _DB_PREFIX_."Promotion";
		$B = _DB_PREFIX_."Area";
		$C = _DB_PREFIX_."User";
		$query = "SELECT A.*,B.AreaName_".$iso." AreaName ,C.`Name` AS UserName FROM $A A, $B B, $C C WHERE A.PromotionId='$id' AND A.AreaId=B.AreaId AND A.WriterId = C.UserID";
		//echo($query);
		$result = Db::getInstance()->getRow($query);
		if (!$result)
			return false;

		foreach ($result AS $key => $value)
			if (key_exists($key, $this))
				$this->{$key} = $value;
				
	}
	
	public static function getPromotionCount($type,$swhere){
		$query = "SELECT COUNT(*) FROM "._DB_PREFIX_."Promotion A WHERE A.`isDelete` = 0 AND A.`Type`='$type' ".(($swhere == '') ? '' : ' AND '.$swhere);
		return (int)Db::getInstance()->getValue($query);
	}
	
	public static function getPromotionList($type,$swhere,$p,$n,$orderBy = NULL, $orderWay = NULL){
		global $cookie;
		$iso = Language::getIsoById((int)$cookie->LanguageID);
		
		return Db::getInstance()->ExecuteS('SELECT A.PromotionId, A.HotelName, A.`Type`, A.StaDate, A.EndDate, A.CreateDate, A.`Title`, B.AreaName_'.$iso.' AreaName FROM '._DB_PREFIX_.'Promotion A '.
										   'LEFT JOIN '._DB_PREFIX_.'Area B ON A.AreaId=B.AreaId'.
										   " WHERE A.`isDelete` = 0 AND A.`Type`='$type' ". ($swhere==''?'':('AND '.$swhere)).
										   ' ORDER BY A.PromotionId DESC '.
										   ($p ? ' LIMIT '.(((int)($p) - 1) * (int)($n)).','.(int)($n) : ''));
	}
	
	
	public static function getHomePromotionList($type,$cnt=6){
		/*
		return Db::getInstance()->ExecuteS('SELECT A.PromotionId, A.`Type`, DATE(A.UpdateDate) AS UpdateDate, A.`Title` FROM '._DB_PREFIX_.'Promotion A'.
										   " WHERE A.`isDelete` = 0 AND (CURDATE() BETWEEN A.`StaDate` AND A.`EndDate`) AND A.`Type`='$type' LIMIT 0,$cnt");
		*/										   
		$cnt = 10;
		return Db::getInstance()->ExecuteS('SELECT A.PromotionId, A.`Type`, DATE(A.UpdateDate) AS UpdateDate, DATE(A.CreateDate) AS CreateDate, A.`Title` FROM '._DB_PREFIX_.'Promotion A'.
										   " WHERE A.`isDelete` = 0 AND  A.`Type`='$type' ORDER BY A.PromotionId DESC LIMIT 0,$cnt");
	}

	public static function delPromotion($pid){
		if(Tools::isEmpty($pid))
			return;
		Db::getInstance()->Execute('update `'._DB_PREFIX_.'Promotion` set IsDelete = 1 WHERE `PromotionId` = '.(int)($pid));			
	}
	
}