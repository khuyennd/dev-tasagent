<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class Member extends ObjectModel
{
	public 		$UserID;
	
	
	/** @var string LoginUserName */
	public 		$LoginUserName;
	
	/** @var integer Company ID */
	public		$CompanyID;
	
	/** @var integer LanguageID */ 
	public 		$LanguageID;
	
	public		$HotelId;
	
	/** @var integer Role ID */
	public		$RoleID;
	
	/** @var string Firstname */
	public 		$Name;
	
	/** @var String Password */
	public 		$Password;
	
	/** @var String Email */
	public		$Email; 
	
	/** @var String Tel */ 
	public		$Tel;
	

	
	/** @var boolean Status */
	public 		$IsActive = 0;
	
	/** @var boolean True if carrier has been deleted (staying in database as deleted) */
	public 		$IsDelete = 0;
	
	/** @var string Object creation date */
	public 		$CreateDate;

	/** @var string Object last modification date */
	public 		$UpdateDate;
	
	protected $tables = array ('User');

 	protected 	$fieldsRequired = array('LoginUserName', 'Name', 'Password', 'Email');
 	protected 	$fieldsSize = array('LoginUserName' => 32, 'Name' => 32, 'Password' => 32, 'Email' => 128, 'Tel' => 20);
 	protected 	$fieldsValidate = array( 'Email' => 'isEmail', 'LanguageID' => 'isUnsignedId', 'IsActive' => 'isBool', 'IsDelete' => 'isBool');
	protected	$exclude_copy_post = array();

	protected 	$table = 'User';
	protected 	$identifier = 'UserID';

	public function getFields()
	{
		parent::validateFields();
		if (isset($this->UserID))
			$fields['UserID'] = (int)($this->UserID);
		
		$fields['LoginUserName'] = pSQL($this->LoginUserName);
		$fields['CompanyID'] 	= (int)($this->CompanyID);
		$fields['RoleID'] 		= (int)($this->RoleID);
		$fields['LanguageID'] 	= (int)($this->LanguageID);
		$fields['HotelId'] 	= (int)($this->HotelId);
		$fields['Name'] = pSQL($this->Name);
		$fields['Email'] = pSQL($this->Email);
		$fields['Tel'] = pSQL($this->Tel);
		$fields['Password'] = pSQL($this->Password);
		$fields['IsActive'] = (int)($this->IsActive);
		$fields['CreateDate'] = pSQL($this->CreateDate);
		$fields['UpdateDate'] = pSQL($this->UpdateDate);
		$fields['IsDelete'] = (int)($this->IsDelete);
		return $fields;
	}

	public function add($autodate = true, $nullValues = true)
	{
		if (empty($this->RoleID))
			$this->RoleID = 1;
	 	if (!parent::add($autodate, $nullValues))
			return false;
			
		$this->UserID = $this->id;	
		return true;
	}

	public function update($nullValues = false)
	{
	 	return parent::update(true);
	}

	
	
	/*
	 * Return member instance from its LoginUserID (optionnaly check password)
	 *
	 * @param string $loginUserName loginUserName
	 * @param string $passwd Password is also checked if specified
	 * @return Member instance
	 */
	public function getByLoginUserName($loginUserName, $passwd = null)
	{

		$result = Db::getInstance()->getRow('
		SELECT *
		FROM `'._DB_PREFIX_	.'User`
		WHERE `IsDelete` = 0
		AND `LoginUserName` = \''.pSQL($loginUserName).'\'
		'.(isset($passwd) ? 'AND `Password` = \''.$passwd.'\'' : ''));
		
		if (!$result)
			return false;
		$this->UserID = $result['UserID'];
		foreach ($result AS $key => $value)
			if (key_exists($key, $this))
				$this->{$key} = $value;

		return $this;
	}
	
	public static function isExistLoginUserName($loginUserName) {
		$result = Db::getInstance()->getRow('
		SELECT *
		FROM `'._DB_PREFIX_	.'User`
		WHERE `LoginUserName` = \''.pSQL($loginUserName).'\'
		');
		
		if (!$result)
			return false;
		return true;
	}
	
	public static function isExistEmail($email, $mid) {
		$result = Db::getInstance()->getRow('
		SELECT *
		FROM `'._DB_PREFIX_	.'User`
		WHERE `IsDelete` = 0
		AND `Email` = \''.pSQL($email).'\''.(($mid!=0) ? " AND UserID <> ".$mid : "")
		);

		if (!$result)
			return false;
		return true;
	}
	/*
	 * Check if Member password is the right one
	 *
	 * @param string $passwd Password
	 * @return boolean result
	 */
	public static function checkPassword($userid, $passwd)
	{
	 	if (!Validate::isUnsignedId($userid))
	 		die (Tools::displayError());

		return (bool)Db::getInstance()->getValue('
		SELECT `UserID`
		FROM `'._DB_PREFIX_.'User`
		WHERE `UserID` = '.(int)($userid).'
		AND `Password` = \''.pSQL($passwd).'\'');
	}
	
	/*
	 * Check id the Member is active or not
	 *
	 * @return boolean customer validity
	 */
	public static function isBanned($id_member)
	{
	 	if (!Validate::isUnsignedId($id_member))
			return true;
		$result = Db::getInstance()->getRow('
		SELECT `UserID`
		FROM `'._DB_PREFIX_.'User`
		WHERE `UserID` = \''.(int)($id_member).'\'
		AND IsActive = 1
		AND `IsDelete` = 0');
		if (isset($result['UserID']))
			return false;
        return true;
	}
	
 	

	/*
	 * Return member functions
	 *
	 * @return array Functions
	 */
	public function getFunctions()
	{
		$functionList = Db::getInstance()->ExecuteS('
		select  b.FunctionId, b.FunctionName
		from `'._DB_PREFIX_.'RoleFunctionLink` a
		left join `'._DB_PREFIX_.'Function` b on a.FunctionId = b.FunctionId 
		where a.RoleId = '.(int)($this->RoleID));
		
		$functions = "";
		foreach ($functionList as $function) {
			$functions .= $function['FunctionName'].",";
		}
		return substr($functions, 0, strlen($functions) -1);
	}

	public static function VerifyMember($aid) {
		if ($aid == "") return;
		Db::getInstance()->Execute('update `'._DB_PREFIX_.'User` set IsActive = 1 WHERE `UserID` = '.(int)($aid));
		
		$sql = "select * from HT_User where `UserID` = ".(int)($aid);
		$udata = Db::getInstance()->getRow($sql);
		if ($udata['LanguageID'] == 4) {
			$title = "<TAS Agent> 登録申し込み完了のご連絡";
			$content = $udata['Name']."　様 <br/><br/>
			TAS Agentへの登録が完了いたしました！<br/>
			お客様のIDは".$udata['LoginUserName']."です。<br/>
			TAS Agentを宜しくお願いいたします。<br/><br/>
			Tas-agent.com <br/>
			web@tas-agent.com";
		} else {
			$title = "<TAS Agent> Your Account registration completed!";
			$content = "Dear ".$udata['Name']."<br/><br/>
			Welcome to TAS Agent!<br/>
			Now your accout(Your accout ID: ".$udata['LoginUserName'].") is created! <br/><br/>
			Please visit our service and enjoy our special product! <br/><br/>  
			Tas-agent.com <br/>
			web@tas-agent.com";
		}
		//$headers = 'From: web@tas-agent.com'."\r\n";
       // $headers .= 'MIME-Version: 1.0'."\r\n";
        //$headers .= 'Content-Type: text/html; charset=utf-8'."\r\n";
		Tools::sendEmail($udata['Email'], $title, $content);
		//mail($udata['Email'], $title, $content, $headers);
	}
	
	public static function DeleteMember($aid)
	{
		if ($aid == "") return;
		Db::getInstance()->Execute('update `'._DB_PREFIX_.'User` set IsDelete = 1 WHERE `UserID` = '.(int)($aid));
	}
	
	public static function UnDeleteMember($aid) {
		if ($aid == "") return;
		Db::getInstance()->Execute('update `'._DB_PREFIX_.'User` set IsDelete = 0 WHERE `UserID` = '.(int)($aid));
	}
	
	public static function DeleteMemberPermanent($aid) {
		if ($aid == "") return;
		Db::getInstance()->Execute('delete from `'._DB_PREFIX_.'User` WHERE `UserID` = '.(int)($aid));
	}
	
	
	public function getHotelCount($swhere) {
        $sql='SELECT count(*)
        		FROM `'._DB_PREFIX_.'User` A
        		LEFT JOIN `'._DB_PREFIX_.'Company` B on A.CompanyID = B.CompanyId
        		LEFT JOIN '._DB_PREFIX_.'Hotel C on A.HotelId = C.HotelId
        		WHERE A.RoleID = 1
        		'.(($swhere == "") ? "" : ' AND '.$swhere);
 		return (int)Db::getInstance()->getValue($sql);
 	}
	/*
	 * Return hotel list
	 *
	 * @return array Hotels
	 */
	public function getHotelList($swhere, $p, $n, $orderBy = NULL, $orderWay = NULL)
	{
		global $cookie;
		$iso = Language::getIsoById((int)$cookie->LanguageID);	

		if ($p < 1) $p = 1;
	 	if (empty($orderBy) ||$orderBy == 'position') $orderBy = 'name';
	 	if (empty($orderWay)) $orderWay = 'ASC';
	 	$sql='
	 			SELECT A.UserID,A.HotelId, A.LoginUserName, A.CompanyID, A.Name, A.Email, A.IsActive, A.IsDelete, B.CompanyName, C.HotelName_'.$iso.' as HotelName
	 			FROM `'._DB_PREFIX_.'User` A
	 			LEFT JOIN `'._DB_PREFIX_.'Company` B on A.CompanyID = B.CompanyId
	 			LEFT JOIN HT_Hotel C on A.HotelId = C.HotelId
	 			WHERE A.RoleID = 1
	 			'.(($swhere == "") ? "" : ' AND '.$swhere) .'
	 			ORDER BY A.IsDelete ASC, A.UserID DESC'
	 			.($p ? ' LIMIT '.(((int)($p) - 1) * (int)($n)).','.(int)($n) : '');
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getAgentCount($swhere) {
		
		$sRole = "A.RoleID = 2"; 
	 	if ($this->RoleID > 3) $sRole .= " OR A.RoleID = 3";
	 	
 		return (int)Db::getInstance()->getValue('
		SELECT count(*)
		FROM `'._DB_PREFIX_.'User` A
		LEFT JOIN `'._DB_PREFIX_.'Company` B on A.CompanyID = B.CompanyId 
		WHERE ('.$sRole.') 
		'.(($swhere == "") ? "" : ' AND '.$swhere) );
 	}
	/*
	 * Return hotel list
	 *
	 * @return array Hotels
	 */
	public function getAgentList($swhere, $p, $n, $orderBy = NULL, $orderWay = NULL)
	{
		if ($p < 1) $p = 1;
	 	if (empty($orderBy) ||$orderBy == 'position') $orderBy = 'name';
	 	if (empty($orderWay)) $orderWay = 'ASC';
	 	
	 	$sRole = "A.RoleID = 2"; 
	 	if ($this->RoleID > 3) $sRole .= " OR A.RoleID = 3";
	 	
		return Db::getInstance()->ExecuteS('
		SELECT A.UserID, A.LoginUserName,A.CompanyID, A.Name, A.Email, A.RoleID, A.IsActive, A.IsDelete, A.CreateDate, B.CompanyName, B.AgentID
		FROM `'._DB_PREFIX_.'User` A
		LEFT JOIN `'._DB_PREFIX_.'Company` B on A.CompanyID = B.CompanyId 
		WHERE ('.$sRole.')
		'.(($swhere == "") ? "" : ' AND '.$swhere) .' 
		ORDER BY A.IsDelete ASC, A.UserID DESC' 
		.($p ? ' LIMIT '.(((int)($p) - 1) * (int)($n)).','.(int)($n) : ''));
	}
	
	public function getAdminCount($swhere) {
		
 		return (int)Db::getInstance()->getValue('
		SELECT count(*)
		FROM `'._DB_PREFIX_.'User` A
		WHERE (A.RoleID = 4 OR A.RoleID = 5) 
		'.(($swhere == "") ? "" : ' AND '.$swhere) );
 	}
	/**
	  * Return hotel list
	  *
	  * @return array Hotels
	  */
	public function getAdminList($swhere, $p, $n, $orderBy = NULL, $orderWay = NULL)
	{
		if ($p < 1) $p = 1;
	 	if (empty($orderBy) ||$orderBy == 'position') $orderBy = 'name';
	 	if (empty($orderWay)) $orderWay = 'ASC';
	 	
		return Db::getInstance()->ExecuteS('
		SELECT A.UserID, A.LoginUserName, A.Name, A.Email, A.RoleID, A.IsActive, A.IsDelete, A.CreateDate, A.UpdateDate
		FROM `'._DB_PREFIX_.'User` A
		WHERE (A.RoleID = 4 OR A.RoleID = 5)
		'.(($swhere == "") ? "" : ' AND '.$swhere) .' 
		ORDER BY A.IsDelete ASC, A.UserID DESC' 
		.($p ? ' LIMIT '.(((int)($p) - 1) * (int)($n)).','.(int)($n) : ''));
	}
	
	public function isExistAgentAdmin() {
		return (int)Db::getInstance()->getValue('
		SELECT count(*)
		FROM `'._DB_PREFIX_.'User` 
		WHERE  RoleID = 3  and CompanyID = '.$this->CompanyID.' and UserID <> '.$this->UserID);
	}
		
	public function resetCompanyUser() {
		return (int)Db::getInstance()->Execute('
		Update `'._DB_PREFIX_.'User` 
		set RoleID = 2  where  CompanyID = '.$this->CompanyID.' and UserID <> '.$this->UserID);
	}
	
	public function isExistSuperAdmin() {
		return (int)Db::getInstance()->getValue('
		SELECT count(*)
		FROM `'._DB_PREFIX_.'User` 
		WHERE  RoleID = 5  and UserID <> '.$this->UserID);
	}
	
	public static function getHotelId($userId)
	{
		return (int)Db::getInstance()->getValue('
		SELECT HotelId
		FROM `'._DB_PREFIX_.'User` 
		WHERE  UserID ='.$userId);
	}

	public static function checkReset($email, $tmpPswd = '') {
		$result = Db::getInstance()->getRow('SELECT `Name`, `LanguageID` 
			FROM `'._DB_PREFIX_	.'User`
			WHERE `IsDelete` = 0
			AND `Email` = \''.pSQL($email).'\''.(($tmpPswd != '') ? ' AND Password = \''.pSQL($tmpPswd).'\'' : '')
		);
		
		
		if (!$result)					
			return false;
		
		if ($tmpPswd == '') {
			$tmpPswd = strtotime("+1 day");
			$result['Password'] = $tmpPswd;
		} 
		
		return $result;
	}
	
	/* reset password */
	public static function resetPassword($email, $password) {
		if ($email == "") return false;
		if ($password == "") return false;
		return Db::getInstance()->Execute('update `'._DB_PREFIX_.'User` set Password = \''.pSQL($password).'\' WHERE `IsDelete` = 0 AND `Email` = \''.pSQL($email).'\'');
	}
	
	public static function getPaymentMethod($companyID) {
		$sql = 'select `PaymentMethod` from '._DB_PREFIX_.'Company where CompanyId = '.$companyID;
		return Db::getInstance()->getValue($sql);
	}

	//通过用户ID获取用户信息
	public static function getUserInfoById($userid) {
		$sql = "select U.`Name`, U.`Email`, U.`Tel`, U.`CompanyID`, U.`LanguageID`, L.`LanguageShortName`, U.`RoleID`, C.`CompanyName`  
					from `HT_User` as U, HT_Company as C, HT_Language as L  
					where U.`CompanyID` = C.`CompanyId` 
					and U.`LanguageID` = L.`LanguageId` 
					and U.`UserID` = '$userid'"; 
		return Db::getInstance()->getRow($sql);
	}

	public static function getUserInfoByHotelId($hotelid) {
		$sql = "select U.`UserID`, U.`Name`, H.`HotelEmail` as Email, U.`Tel`, U.`LanguageID`, L.`LanguageShortName`, U.`RoleID`,
					C.`CompanyID`, H.`HotelFax` as Fax, H.`PrefFax`, H.`PrefEmail`
					from `HT_User` as U, HT_Language as L, HT_Company as C ,HT_Hotel as H
					where U.`LanguageID` = L.`LanguageId` 
					and U.`CompanyID` = C.`CompanyID`
					and U.`HotelId`=H.`HotelId`
					and U.`HotelId` = '$hotelid'";
        $sql2="select H.`HotelName` as Name, H.`HotelEmail` as Email, H.`HotelFax` as Fax, H.`PrefFax`, H.`PrefEmail`
        					from HT_Hotel as H
        					where H.`HotelId` = '$hotelid'";

        if(Db::getInstance()->getRow($sql)==false){
            return Db::getInstance()->getRow($sql2);
        }else{
            return Db::getInstance()->getRow($sql);
        }

	}

	public static function checkHotelCodeUseful($HotelCode, $UserId) {
		$hotelinfo = HotelDetail::getHotelByHotelCode($HotelCode);
		$HotelId = $hotelinfo['HotelId'];
		if (!$HotelId) return 0;

		$sql = "select UserID from HT_User where 1=1 ";
		$sql .= $HotelId ? "and HotelId='{$HotelId}' " : "";
		$sql .= $UserId ? "and UserID <> '{$UserId}' " : "";
		$userinfo = Db::getInstance()->getRow($sql);
		$userId = $userinfo['UserID'];

		if ($userId) return 0;
		return $HotelId;		
	}
    public static function getCustomerList($oid)
   	{
   	 	$sql="SELECT
   	 		c.*, r.OrderId,
   	 		r.OrderRoomId AS orId
   	 	FROM
   	 		`HT_OrderCustomer` AS c,
   	 		`HT_OrderRoom` AS r
   	 	WHERE
   	 		c.OrderRoomId = r.OrderRoomId
   	 	AND r.OrderId = $oid
   	 	ORDER BY
   	 		OrderRoomId;";
   		return Db::getInstance()->ExecuteS($sql);
   	}

}
