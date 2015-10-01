<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class LoginController extends FrontController
{
	public function __construct()
	{
		$this->php_self = "login.php";
		$this->auth = false;
		$this->content_only = true; 
		parent::__construct();
	}
	
	public function preProcess()
	{
		

		parent::preProcess();

		if (self::$cookie->isLogged()) {	//如果已经登录则跳转至index.php
			if ((self::$cookie->RoleID > 3 && Tools::getValue('changeto')) || Tools::getValue('changeback')) {
				if (Tools::getValue('changeto')) {
					$username = Tools::getValue('username');
				} else {
					$username = self::$cookie->OldLoginUserName;					
				}
				
				$member = new Member();
				$authentication = $member->getByLoginUserName(trim($username));
				
				if (!$authentication OR !$member->UserID) {
					sleep(1);
					$this->errors[] = Tools::displayError('Login failed');
				} else {
					if (Tools::getValue('changeto')) {
						$oldLoginUserName = self::$cookie->LoginUserName;
						self::$cookie->mylogout();
						self::$cookie->OldLoginUserName = $oldLoginUserName;
					} else {
						self::$cookie->mylogout();
						self::$cookie->OldLoginUserName = NULL;
					}
					
					if ($member->IsActive == 0) {
						$this->errors[] = Tools::displayError('Not Activated User');
					} else if ($member->IsDelete == 1) {
						$this->errors[] = Tools::displayError('Deleted User');
					} else {	
						self::$cookie->UserID = (int)($member->UserID);
						self::$cookie->LoginUserName = $member->LoginUserName;
						self::$cookie->logged = 1;
						
						self::$cookie->Password = $member->Password;
						self::$cookie->Email = $member->Email;
						self::$cookie->Name = $member->Name;
						
						self::$cookie->LanguageID = $member->RoleID > 3 ? 4 : $member->LanguageID;
						self::$cookie->RoleID = $member->RoleID;
						
						self::$cookie->RoleList = $member->getFunctions();
						self::$cookie->CompanyID = $member->CompanyID;
						self::$cookie->HotelID = $member->HotelId;

						if ($member->RoleID == 1)
							Tools::redirect('hotelpage.php?mid='.$member->HotelId);
						else 
							Tools::redirect('index.php');
					}
				}
			} else {
				Tools::redirect('index.php');				
			}
		}
		
		if (Tools::isSubmit('SubmitLogin'))
		{
			$passwd = trim(Tools::getValue('passwd'));
			$username = trim(Tools::getValue('username'));
			if (empty($username) || $username == "User Name")
				$this->errors[] = Tools::displayError('User ID required');
			elseif (empty($passwd))
				$this->errors[] = Tools::displayError('Password is required');
			elseif (Tools::strlen($passwd) > 32)
				$this->errors[] = Tools::displayError('Password is too long');
			
			else
			{
				$member = new Member();
				$authentication = $member->getByLoginUserName(trim($username), trim($passwd));//var_dump($member->UserID);die;
				if (!$authentication OR !$member->UserID)
				{
					/* Handle brute force attacks */
					sleep(1);
					$this->errors[] = Tools::displayError('Login failed');
				}
				else
				{
					if ($member->IsActive == 0) {
						$this->errors[] = Tools::displayError('Not Activated User');
					} else if ($member->IsDelete == 1) {
						$this->errors[] = Tools::displayError('Deleted User');
					} else {	
						
												
						self::$cookie->UserID = (int)($member->UserID);
						self::$cookie->LoginUserName = $member->LoginUserName;
						self::$cookie->logged = 1;
						self::$cookie->Password = $member->Password;
						self::$cookie->Email = $member->Email;
						self::$cookie->Name = $member->Name;
						//self::$cookie->LanguageID = $member->RoleID > 3 ? 4 : (Tools::getValue("languageId")==0? $member->LanguageID : Tools::getValue("languageId"));
						//self::$cookie->LanguageID = (Tools::getValue("languageId") == 0 ? $member->LanguageID : ($member->RoleID > 3 ? 4 : Tools::getValue("languageId")));
						self::$cookie->LanguageID = Tools::getValue("languageId") != 0 ? Tools::getValue("languageId") : ($member->RoleID > 3 ? 4 : $member->LanguageID);

						self::$cookie->RoleID = $member->RoleID;
						self::$cookie->RoleList = $member->getFunctions();
						self::$cookie->CompanyID = $member->CompanyID;
						self::$cookie->HotelID = $member->HotelId;
						self::$cookie->OldLoginUserName = NULL;
//var_dump(self::$cookie);die;
						if ($member->RoleID == 1) {
							Tools::redirect('hotelpage.php?mid='.$member->HotelId);
						}
						else {
							$url = $_POST['back'];
                            //p($url);
                            if($url=='/') {
                                Tools::redirect('index.php');
                            } elseif($url = "/tas-agent/"){
                            	Tools::redirect('index.php');
                        	} 
                            elseif($url != ""){
                        		Tools::redirect($url);
                            } 
                            else {
                                Tools::redirect('index.php');
                            }
						}
					}
				}
			}
		}
		
		$back = $_GET['back'];
		if (isset($back) && $back != '') {
			self::$smarty->assign("back", urldecode($_GET['back']));
		}

		self::$smarty->assign(array(
			'languages' => Tools::getLanguages(), 
			'sl_lang' => self::$cookie->LanguageID 
		));
	}

	public function setMedia()
	{
		parent::setMedia();
		Tools::addJS(_THEME_JS_DIR_.'slider.js');
	}

	public function process()
	{
		parent::process();
	}

	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display(_TAS_THEME_DIR_.'login.tpl');
	}
}

