<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class MessageController extends FrontController
{
	 
	public function __construct()
	{
		$this->php_self = "message.php";
		
		
		parent::__construct();
	}
	public function preProcess()
	{
		if (!Tools::hasFunction('message')) Tools::redirect('index.php');
		$this->brandNavi[] = array("name"=>"Notices", "url"=>$this->php_self);
		
		if (Tools::isSubmit('SubmitMsg')){
			$MsgId = Tools::getValue('MsgId');
			$Cont = trim(Tools::getValue('Cont'));
			$curtime = time();

			if ($MsgId == 0){ //... new 
				$Title = trim(Tools::getValue('Title'));
				$UserId = (self::$cookie->RoleID < 4) ? self::$cookie->UserID : trim(Tools::getValue('UserId'));
				$CompanyId = (self::$cookie->RoleID < 4) ? self::$cookie->CompanyID : trim(Tools::getValue('CompanyId'));
				$sql = "INSERT INTO "._DB_PREFIX_."Message	VALUES(0, '{$Title}', {$UserId}, {$CompanyId}, {$curtime},0) ";
				Db::getInstance()->Execute($sql);
				$MsgId = Db::getInstance()->Insert_ID();
				$sql =  "INSERT INTO "._DB_PREFIX_."MessageCont	VALUES(0, {$MsgId}, '{$Cont}',".self::$cookie->UserID." ,{$curtime}) ";
				Db::getInstance()->Execute($sql);				
			}else{//... modify add
				
				Db::getInstance()->Execute("INSERT INTO "._DB_PREFIX_."MessageCont	VALUES(0, {$MsgId}, '{$Cont}',".self::$cookie->UserID." ,{$curtime} ) " );
				Db::getInstance()->Execute("UPDATE "._DB_PREFIX_."Message SET lastDate={$curtime} WHERE MsgId ={$MsgId}  " );
			}
						
		}
		
		if (Tools::isSubmit('delete')){		
			$idList = $_POST['idlist'] == '' ? '' : $_POST['idlist'];
			if (is_array($idList)) {
				foreach ($idList as $MsgId) {
					echo $sql = "DELETE FROM "._DB_PREFIX_."Message WHERE MsgId ={$MsgId} ";
					Db::getInstance()->Execute($sql);
				}
			}
			exit();
		}
		
		
		
		
	}
	public function process()
	{
		
		//... edit window
		if(trim(Tools::getValue('ajaxType'))=="edit"){
			$msgId = trim(Tools::getValue('msgId'));		
			
			// get Writer User ID from MSG 
			$sql = "SELECT UserId from "._DB_PREFIX_."Message where MsgId = {$msgId}"; 
			$writerId = Db::getInstance()->getValue($sql);
			if (self::$cookie->UserID <> $writerId) {
				$sql = "update "._DB_PREFIX_."Message set  isRead = 1 where MsgId = {$msgId}"; 
				Db::getInstance()->Execute($sql);
			}
			
			$sql = "SELECT m.*, u.LoginUserName, u.RoleID, r.RoleName FROM ".
					_DB_PREFIX_."MessageCont AS m, "._DB_PREFIX_."User AS u, "._DB_PREFIX_."Role r 
						WHERE m.MsgId={$msgId} AND  m.UserId=u.UserID AND u.RoleId=r.RoleId  ORDER BY m.regDate DESC ";
			self::$smarty->assign("list", Db::getInstance()->ExecuteS($sql));
			$sql = "SELECT m.Title FROM HT_Message AS m WHERE m.MsgId={$msgId} ";
			self::$smarty->assign("info", Db::getInstance()->getRow($sql));
			return;
		}
		
		
		//... main window
		parent::process();		
		$schKey = trim(Tools::getValue('schKey'));
		$where = " m.UserId=u.UserID AND u.RoleId=r.RoleId ";
		
		if ($schKey != "") $where .= " AND CONCAT(m.Title,'-|-',u.LoginUserName,'-|-',u.Name) LIKE '%{$schKey}%' ";
		
		if (self::$cookie->RoleID == 3){//... agent admin
			$where .= " AND m.CompanyId=".self::$cookie->CompanyID;
		}else if(self::$cookie->RoleID < 3){ //.... agent user or hotel
			$where .= " AND m.UserId=".self::$cookie->UserID;
		}
		$subsql = " FROM "._DB_PREFIX_."Message AS m, "._DB_PREFIX_."User AS u, "._DB_PREFIX_."Role r WHERE {$where}  ";
		$sql ="SELECT COUNT(*) ".$subsql;
		
		$this->pagination((int)Db::getInstance()->getValue($sql));
		
		$sql = "SELECT m.*, u.LoginUserName, u.Name, r.RoleName {$subsql} ORDER BY lastDate DESC ".
					($this->p ? ' LIMIT '.(((int)($this->p) - 1) * (int)($this->n)).','.(int)($this->n) : '');
		
		self::$smarty->assign("list", Db::getInstance()->ExecuteS($sql));
	}
	
	
	public function displayContent()
	{
		//... edit window
		if(trim(Tools::getValue('ajaxType'))=="edit"){
			self::$smarty->display(_TAS_THEME_DIR_.'message_edit.tpl');		return;
		}
		parent::displayContent();
		self::$smarty->display(_TAS_THEME_DIR_.'message.tpl');
	}
}
