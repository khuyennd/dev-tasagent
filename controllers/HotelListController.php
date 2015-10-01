<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class HotelListController extends FrontController
{
	protected  $searchField = array ('CompanyName' => 'like', 'LoginUserName' => 'like', 'Email' => 'like', 'Name' => 'like');

	public function __construct()
	{
		$this->php_self = "hotellist.php";

		
		parent::__construct();
	}
	public function preProcess()
	{
		if (!Tools::hasFunction('hotel_list')) Tools::redirect('index.php');
		$this->brandNavi[] = array("name"=>"Hotel List", "url"=>$this->php_self);
		
		$idList = $_POST['idlist'] == '' ? '' : $_POST['idlist'];
		if (Tools::isSubmit("verify")) {
			if (is_array($idList)) {
				foreach ($idList as $aid) {
					Member::VerifyMember($aid);
				}
			}
			exit();
		} else if (Tools::isSubmit("delete")) {
			if (is_array($idList)) {
				foreach ($idList as $aid) {
					Member::DeleteMember($aid);
				}
			}
			exit();
		} else if (Tools::isSubmit("del_permanent")) {
			if (is_array($idList)) {
				foreach ($idList as $aid) {
					Member::DeleteMemberPermanent($aid);
				}
			}
			exit();
		} else if (Tools::isSubmit("undel")) {
			if (is_array($idList)) {
				foreach ($idList as $aid) {
					Member::UnDeleteMember($aid);
				}
			}
			exit();
		}
		//... add new msg
		if (Tools::isSubmit('SubmitMsg')){
			$MsgId = Tools::getValue('MsgId');
			$Cont = trim(Tools::getValue('Cont'));
			$curtime = time();

			if ($MsgId == 0 && self::$cookie->RoleID >= 4){ //... new 
				$Title = trim(Tools::getValue('Title'));
				$UserId =  trim(Tools::getValue('UserId'));
				$CompanyId = trim(Tools::getValue('CompanyId'));
				$sql = "INSERT INTO "._DB_PREFIX_."Message	VALUES(0, '{$Title}', {$UserId}, {$CompanyId}, {$curtime}, 0) ";
				Db::getInstance()->Execute($sql);
				$MsgId = Db::getInstance()->Insert_ID();
				$sql =  "INSERT INTO "._DB_PREFIX_."MessageCont	VALUES(0, {$MsgId}, '{$Cont}',".self::$cookie->UserID." ,{$curtime} ) ";
				Db::getInstance()->Execute($sql);				
			}
		}
	}
	public function process()
	{
        global $cookie;
        parent::process();
        $iso = Language::getIsoById((int)$cookie->LanguageID);
        $member = new Member();
        $member->getByLoginUserName($cookie->LoginUserName);
        $swhere = parent::getSearchWhere();
        if ($swhere == "")
            $swhere .= " 1 = 1 ";
        if (Tools::getValue("HotelName") != "") {
            $swhere .= " AND HotelName_" . $iso . " like '%" . Tools::getValue("HotelName") . "%'";
        }
        $hotelCount = $member->getHotelCount($swhere);
        $this->pagination($hotelCount);

        $hotelList = $member->getHotelList($swhere, $this->p, $this->n);

        self::$smarty->assign("listData", $hotelList);
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display(_TAS_THEME_DIR_.'hotellist.tpl');
	}
}
