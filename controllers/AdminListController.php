<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class AdminListController extends FrontController
{
	protected  $searchField = array ('Email' => 'like', 'Name' => 'like');
	 
	public function __construct()
	{
		$this->php_self = "hotellist.php";
		
		
		parent::__construct();
	}
	public function preProcess()
	{
		if (!Tools::hasFunction('admin_list')) Tools::redirect('index.php');
		$this->brandNavi[] = array("name"=>"Admin List", "url"=>$this->php_self);
		
		$idList = $_POST['idlist'] == '' ? '' : $_POST['idlist'];
		if (Tools::isSubmit("delete")) {
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
	}
	public function process()
	{
		global $cookie;
		
		parent::process();
		
		$member = new Member();
		$member->getByLoginUserName($cookie->LoginUserName);
		
		$swhere = parent::getSearchWhere();
		
		$agentCount = $member->getAdminCount($swhere);
		$this->pagination($agentCount);
		
		$hotelList = $member->getAdminList($swhere, $this->p, $this->n);
		
		self::$smarty->assign("listData", $hotelList);
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display(_TAS_THEME_DIR_.'adminlist.tpl');
	}
}
