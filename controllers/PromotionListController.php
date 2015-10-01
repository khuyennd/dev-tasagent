<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}

class PromotionListController extends FrontController
{
	protected $type;
	protected $searchField = array();
	
	public function __construct()
	{
		$this->php_self = "promotionlist.php";
		parent::__construct();
	}
	
	
	protected function processAddOrUpdate(){
		//promotion create
		$promotion = new Promotion();
		
		//1.assign values
		$promotion -> PromotionId = Tools::getValue('PromotionId');
		$promotion -> getById($promotion -> PromotionId);
		$promotion -> HotelName = Tools::getValue('HotelName');
		$promotion -> AreaId = Tools::getValue('AreaId');
		$promotion -> Title = Tools::getValue('Title');
		$promotion -> StaDate = Tools::getValue('StaDate');
		$promotion -> EndDate = Tools::getValue('EndDate');
		$promotion -> Content = Tools::getValue('Content');
		$promotion -> Type = Tools::getValue('Type');
		$promotion -> WriterId = self::$cookie->UserID;
		$promotion -> id = Tools::getValue('PromotionId');

		//2.validation check
		if(empty($promotion->HotelName)){
			$this->errors[] = Tools::displayError('HotelName is required');
		}
		if(empty($promotion->AreaId)){
			$this->errors[] = Tools::displayError('Area is required');
		}
		if(empty($promotion->StaDate)){
			$this->errors[] = Tools::displayError('Effective period start is required');
		}
		if(empty($promotion->EndDate)){
			$this->errors[] = Tools::displayError('Effective period end is required');
		}
		if(empty($promotion->Title)){
			$this->errors[] = Tools::displayError('Title is required');
		}
		
		//3.update or add
		$result = false;
		if(!sizeof($this->errors)){
			$result = $promotion->save();
			/*if($promotion -> PromotionId == 0)
				$result = $promotion -> add();
			else
				$result = $promotion -> update();*/
		}

		if(!sizeof($this->errors) && result){
			echo('true');
		}
		else{
			self::$smarty->assign('errors',$this->errors);
			self::$smarty->display(_TAS_THEME_DIR_."common/errors_ajax.tpl");
		}
		exit();
	}
	
	protected function processGetContent(){
		
		$id = Tools::getValue('PromotionId');
		if($id == '0' || Tools::isEmpty($id))
			exit(); 
			
		$promotion = new Promotion();
		$promotion->getById($id);
		
		$fields = $promotion->getAsArray();
		echo(json_encode($fields));
		exit();
	}
	
	protected function processDelete(){
		$idlist = Tools::getValue('idlist');
		if (is_array($idlist)) {
			foreach ($idlist as $pid) {
				Promotion::delPromotion($pid);
			}
		}
		exit();	
	}
	
	protected function processUploadImage(){
		$funcNum = $_GET['CKEditorFuncNum'] ;
		$CKEditor = $_GET['CKEditor'] ;
		$langCode = $_GET['langCode'] ;
		if(!isset($_FILES['upload']['tmp_name']))
			exit();
		
		$file_name = $_FILES['upload']['name'];
    	$ext = strtolower(substr($file_name, (strrpos($file_name, '.') + 1)));
		if ('jpg' != $ext && 'jpeg' != $ext && 'gif' != $ext && 'png' != $ext)
    	{
        	$this->errors[] = Tools::displayError('Only image upload is available.');
        	echo("<script>alert('Not image file');</script>");
        	exit();
    	}
    	$file_name = round(microtime(true) * 1000);
		$save_dir = sprintf('%s/%s.%s', _TAS_ROOT_DIR_."/asset/promotion", $file_name,$ext);
    	$save_url = sprintf('%s/%s.%s', __TAS_BASE_URI__."asset/promotion", $file_name,$ext);
    	if (move_uploaded_file($_FILES["upload"]["tmp_name"],$save_dir))
        	echo "<script>window.parent.CKEDITOR.tools.callFunction($funcNum, '$save_url', '업로드완료');</script>";
        exit();	
	}
	
	public function preProcess()
	{
		$type = $_GET['type'];
		
		if(Tools::isSubmit("add")){
			$this -> processAddOrUpdate();
		}
		else if(Tools::isSubmit("getdetail")){
			$this -> processGetContent();
		}
		else if(Tools::isSubmit("delete")){
			$this -> processDelete();
		}
		else if(Tools::isSubmit("uploadimage")){
			$this -> processUploadImage();
		}
		if(!isset($type))
			$type=$_POST['type'];
			
		if(!isset($type)){//if type is not set, invalid request
			exit();
		}
		
		$navi_url = $this->php_self."?type=".$type;
		$navi_name = ( $type == Promotion::$TYPE_PROMOTION)?'Promotion List':'Event List';
		$this->brandNavi[] = array("name"=>$navi_name, "url"=>$navi_url);
		$this->type = $type;
		
	}
	
	public function setMedia(){
		parent::setMedia();
		///add ckeditor js
		Tools::addJS(__TAS_BASE_URI__.'tools/ckeditor/ckeditor.js');
	}
	
	public function process()
	{
		parent::process();
		
		$type = $this->type;

		$swhere = parent::getSearchWhere();
		
		//if not admin, add date condition
		/*
		if(self::$cookie -> RoleID <= 3 ){
			$swhere.= ($swhere=='')?'':" AND ";
			$swhere.= " (CURDATE() BETWEEN A.`StaDate` AND A.`EndDate`) ";
		}*/
		
		$promotionCount = Promotion::getPromotionCount($type, $swhere);
		$this->pagination($promotionCount);
		
		$promotionList = Promotion::getPromotionList($type,$swhere, $this->p, $this->n);
		self::$smarty->assign("listData", $promotionList);
		self::$smarty->assign("areaList", Tools::getJapanAreas());
		self::$smarty->assign("count", $promotionCount);
		
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display(_TAS_THEME_DIR_.'promotionlist.tpl');
	}
}