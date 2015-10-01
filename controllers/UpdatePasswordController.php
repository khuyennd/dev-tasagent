<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class UpdatePasswordController extends FrontController
{
	public function __construct()
	{
		$this->php_self = "updatepassword.php";
		$this->auth = true;
		$this->content_only = false; 
		parent::__construct();
        $this->brandNavi[] = array("name"=>"Update Password", "url"=>$this->php_self);
	}
	public function preProcess() {
		parent::preProcess();
		global $cookie;
		if (Tools::isSubmit("checkpass")) {
			$result = Member::checkReset($cookie->Email, Tools::getValue("password"));
			if($result)	{
				echo "true";
			}else {
				echo "false";
			}
			exit();
		}
		
	}
	
	public function process()
	{
		parent::process();
		
		global $cookie;
		
		self::$smarty->assign("email", $cookie->Email);
		if (Tools::isSubmit('SubmitUpdatepassword')) {
			$password = Tools::getValue("password");
			$confirm = Tools::getValue("confirm");
			$npassword = Tools::getValue("npassword");
			$email = Tools::getValue("email");
			
			if(!$password)	$this->errors[] = Tools::displayError('password is required');
			else if(!$email)	$this->errors[] = Tools::displayError('email is required!!');
			else if(!$confirm)	$this->errors[] = Tools::displayError('confirm password is required');
			else if(!$npassword)	$this->errors[] = Tools::displayError('new password is required!!');
			else {
				if($npassword != $confirm) {
					$this->errors[] = Tools::displayError('Password confirmation is not mismatch');
				} else {
					$result = Member::checkReset($email, $password);
					if($result)	{
						if(Member::resetPassword($email, $npassword)) {
							self::$smarty->assign("LanguageID", $result['LanguageID']);
							self::$smarty->assign("message", "Updated!");
						}
						else 
							$this->errors[] = Tools::displayError('Invalid Operation!');
					} else {
						$this->errors[] = Tools::displayError('Invalid Operation!');
					}
				}
			}
		} 
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display(_TAS_THEME_DIR_.'updatepassword.tpl');
	}

	public function setMedia()
	{
		parent::setMedia();
		Tools::addJS(_THEME_JS_DIR_.'jquery.validate.js');
	}
}
