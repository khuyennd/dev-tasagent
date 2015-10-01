<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class RegisterController extends FrontController
{
	private $member = null;
	private $company = null;
	private $regSuccess = 0;
	
	public function __construct()
	{
		$this->php_self = "register.php";
		$this->auth = false;
		parent::__construct();
	}
	
	public function preProcess()
	{
		parent::preProcess();
		
		if (Tools::isSubmit("checkemail")) {
			if (Member::isExistEmail(Tools::getValue("email"), Tools::getValue("mid"))) 
				echo "false";
			else echo "true";
			exit();
		}else if (Tools::isSubmit("checkid")) {
			if (Member::isExistLoginUserName(Tools::getValue("loginUserName"))) 
				echo "false";
			else echo "true";
			exit();
		}else if (Tools::isSubmit("agentid")) {
			if (Company::isExistAgentID(Tools::getValue("agentID"), Tools::getValue("cid"))) 
				echo "false";
			else echo "true";
			exit();
		}
		
		if (Tools::getValue("mod")=="hotel" || Tools::getValue("mod")=="agent" || Tools::getValue("mod")=="agent") {
			if (self::$cookie->isLogged()) Tools::redirect("index.php");
		}
		
		$this->member = new Member((int)Tools::getValue("mid"));
		$this->company = new Company($this->member->CompanyID);
		
		if (!self::$cookie->isLogged()) 
			$this->content_only = true;
		else {
			if (Tools::getValue("prev_page") == "adminlist")  {
				$this->brandNavi[] = array("name"=>"Admin List", "url"=>"adminlist.php");
			} else if (Tools::getValue("prev_page") == "agentlist")  {
				if (self::$cookie->RoleID == 3) 
					$this->brandNavi[] = array("name"=>"User Management", "url"=>"agentlist.php");
				else $this->brandNavi[] = array("name"=>"Agent List", "url"=>"agentlist.php");
			} else if (Tools::getValue("prev_page") == "hotellist")  {
				$this->brandNavi[] = array("name"=>"Hotel List", "url"=>"hotellist.php");
			} else if (self::$cookie->RoleID > 1 && Tools::getValue("mod")=="self"){
				$this->brandNavi[] = array("name"=>"My Information", "url"=>"auth.php?mod=self&mid=".Tools::getValue("mid"));
            }else if (self::$cookie->RoleID == 1 && Tools::getValue("mod")=="self"){
            	$this->brandNavi[] = array("name"=>"My Information", "url"=>"auth.php?mod=self&mid=".Tools::getValue("mid"));
            }
		}
		
		$myinfo = false;
		$editCompany = true;
		$editLanguage = true;
		$editRole = false;
		$editDelete = false;
		$editPref	= false;
		$editPayment = false;
		
		if (!self::$cookie->isLogged() && Tools::getValue("mod")!="hotel") $myinfo = true;
		if (Tools::getValue("prev_page") == "adminlist")  {
			$editCompany = false;	
			$editLanguage = false;
			$editRole = true;
			$roleList = array( 4=> "Admin", 5=>"Super Admin");	
		} else if (Tools::getValue("prev_page") == "agentlist" && self::$cookie->RoleID > 3) {
			$editRole = true;
			$roleList = array( 2=>"Normal", 3=> "Admin");
			$editPayment = true;
		} else if (Tools::getValue("prev_page") =="hotellist" || self::$cookie->RoleID==1 || Tools::getValue("mod")=="hotel") {
			$editPref = true;
		}
		
		if (self::$cookie->RoleID == 3 && Tools::getValue("mod")!="self") { 
			$editCompany = false;
			$editDelete = true;
		}
		if (self::$cookie->RoleID == 2 ) {
			$editCompany = false;
		}
		if (self::$cookie->RoleID > 3 && Tools::getValue("prev_page") == "hotellist" && Tools::getValue("mid")) {
			$hotelinfo = HotelDetail::getHotelByUserId(Tools::getValue("mid"));
			$this->member->HotelCode = $hotelinfo['HotelCode'];
			$editHotel = true;
		}
		 
		if (Tools::isSubmit('SubmitRegister'))
		{
			/** Company Create **/ 
			if (Tools::isSubmit("agentID")) $this->company->AgentID = Tools::getValue("agentID");
			$this->company->CompanyName = trim(Tools::getValue('companyName'));
			$this->company->CountryId = trim(Tools::getValue('countryId'));
			$this->company->City = trim(Tools::getValue('city'));
			$this->company->Address = trim(Tools::getValue('address'));
			$this->company->Website = trim(Tools::getValue('website'));
			$this->company->ManagingDirector = trim(Tools::getValue('managingDirector'));
			$this->company->Tel = trim(Tools::getValue('companyTel'));
			$this->company->Fax = trim(Tools::getValue('companyFax'));
            $this->company->ShouShu = trim(Tools::getValue('ShouShu'));
            $this->company->ShouShuType = trim(Tools::getValue('ShouShuType'));
			if ($editPayment) $this->company->PaymentMethod = trim(Tools::getValue("paymentMethod"));
			if ($editPref) {
				$this->company->PrefFax = trim(Tools::getValue("prefFax"))=="on" ? 1 : 0;
				$this->company->PrefEmail = trim(Tools::getValue("prefEmail")) == "on" ? 1: 0;
			}
			if ($editCompany) {
				
				if (empty($this->company->CompanyName))
					$this->errors[] = Tools::displayError('Company Name required');
				if (empty($this->company->CountryId))
					$this->errors[] = Tools::displayError('Country required');
				if (empty($this->company->City))
					$this->errors[] = Tools::displayError('Company City required');
				if (empty($this->company->Website))
					$this->errors[] = Tools::displayError('Company Website required');
				if (empty($this->company->ManagingDirector))
					$this->errors[] = Tools::displayError('Managing Director required');
				if (empty($this->company->Tel))
					$this->errors[] = Tools::displayError('Company TEL required');	
				elseif (!Validate::isPhoneNumber($this->company->Tel))
					$this->errors[] = Tools::displayError('Invalid Compnay TEL number');
			}
							
			/** Member Create **/
			if ($this->member->UserID ==0 )$this->member->LoginUserName = trim(Tools::getValue('loginUserName'));
			$this->member->Name = trim(Tools::getValue('name'));
			$password = trim(Tools::getValue('password'));
			$con_password = trim(Tools::getValue('con_password'));
			$this->member->Email = trim(Tools::getValue('email'));
			$this->member->Tel = trim(Tools::getValue('tel'));
			$this->member->LanguageID = trim(Tools::getValue('languageId'));
			$hotelCode = trim(Tools::getValue('HotelCode'));

			if ($editRole) 
				$this->member->RoleID = trim(Tools::getValue('roleId'));
			else if (self::$cookie->RoleID == 3 && $this->member->UserID == 0) { 
				$this->member->RoleID = 2; $this->member->CompanyID = self::$cookie->CompanyID;
				$this->member->IsActive = 1;
			}  
			if (self::$cookie->RoleID > 3 && $this->member->RoleID > 3 && $this->member->UserID == 0) {
				$this->member->IsActive = 1;
			}
							
			if ($editDelete) $this->member->IsDelete = trim(Tools::getValue('isDelete'));
			
			if ($this->member->UserID ==0 && empty($this->member->LoginUserName))
				$this->errors[] = Tools::displayError('User ID required');
			if (empty($this->member->Name))
				$this->errors[] = Tools::displayError('Your Name is required');
			if ($this->member->UserID == 0 && empty($password))
				$this->errors[] = Tools::displayError('Password is required');
			else if ($con_password != $password)
				$this->errors[] = Tools::displayError('Password confirmation is not mismatch');
			elseif (Tools::strlen($passwd) > 32)
				$this->errors[] = Tools::displayError('Password is too long');
			if (empty($this->member->Email))
				$this->errors[] = Tools::displayError('Your Email is required');
			elseif (!Validate::isEmail($this->member->Email))
				$this->errors[] = Tools::displayError('Invalid Email Address');
				
			if ($editLanguage) {
				if (empty($this->member->Tel))
					$this->errors[] = Tools::displayError('Your TEL is required');
				elseif (!Validate::isPhoneNumber($this->member->Tel))
					$this->errors[] = Tools::displayError('Invalid TEL number');
				if (empty($this->member->LanguageID))
					$this->errors[] = Tools::displayError('Language is required');
			}

			if ($editHotel) {
				if (empty($hotelCode))
					$this->errors[] = Tools::displayError('Your HotelCode is required.');
				$hotelId = Member::checkHotelCodeUseful($hotelCode, $this->member->UserID); 	
				if (!$hotelId) {
					$this->errors[] = Tools::displayError('Invalid HotelCode number.');			
				} else {
					$this->member->HotelId = $hotelId;
				}
			}

			if (!sizeof($this->errors))
			{
				// duplicate check user id
				if ($this->member->UserID == 0 && Member::isExistLoginUserName($this->member->LoginUserName)!=false) {
					$this->errors[] = Tools::displayError('Duplicate Login ID.');
				} else if ($this->member->UserID == 0 && Member::isExistEmail($this->member->Email, 0)!=false) {
					$this->errors[] = Tools::displayError('Duplicate User E-mail.');
				} else {
					
					if ($editCompany) {
						if ($this->company->CompanyId > 0) 
							$regCompany = $this->company->update(); 
						else $regCompany = $this->company->add();
					}
					if (!$editCompany  || ($editCompany && $regCompany)) {
						if ($password!="") {
							$this->member->Password = $password;
						}
						
						if ($this->member->UserID > 0) {
							
							// check if one more agent admin user 
							if (Tools::getValue("prev_page") == "agentlist" && $this->member->RoleID == 3) {
								$this->member->resetCompanyUser();
								/*if ($this->member->isExistAgentAdmin() > 0) {
									$this->errors[] = Tools::displayError("There exist only one agent admin in a company");
								}*/
							}else if (Tools::getValue("prev_page") == "agentlist" && $this->member->RoleID == 2) {
								if ($this->member->isExistAgentAdmin() == 0) {
									$this->errors[] = Tools::displayError("A company has a one agent admin.");
								}
							}
							
							// check if there are any super admin user
							if (Tools::getValue("prev_page") == "adminlist" && $this->member->RoleID == 4) {
								if ($this->member->isExistSuperAdmin() == 0) {
									$this->errors[] = Tools::displayError("There must be existed one more Super Admin.");
								}
							}							
							if (!sizeof($this->errors)) $this->regSuccess = $this->member->update();
							if ($this->member->UserID == self::$cookie->UserID ) {
								self::$cookie->Name = $this->member->Name;
							}
						}else {
							if ($editCompany) $this->member->CompanyID = $this->company->id;
							if (Tools::getValue("mod")=="agent") 
								$this->member->RoleID = 3;
							else if (Tools::getValue("mod")=="hotel") 
								$this->member->RoleID = 1;
							$this->regSuccess = $this->member->add();	
							
							// add hotel detail class
							if ($this->member->RoleID == 1) {
								if($_POST['nohotel'] == 1){
                                    $this->member->HotelId = $_POST['hotelid'];
                                    $this->member->update();
                                } else {
                                    $hotelDetail = new HotelDetail();
                                    $hotelDetail->HotelName = $this->company->CompanyName;
                                    $hotelDetail->HotelCode = "_";
                                    $hotelDetail->HotelClass = 0;
                                    $hotelDetail->HotelCity = 0;
                                    $hotelDetail->HotelArea = 0;
                                    $hotelDetail->add(true, false);
                                    $hotelDetail->HotelCode = "JP" . str_pad($hotelDetail->HotelId, 6, "0", STR_PAD_LEFT);
                                    $hotelDetail->update(false);
                                    $this->member->HotelId = $hotelDetail->HotelId;
                                    $this->member->update();
                                }
							}
						}
						
						if ($this->regSuccess && Tools::getValue("prev_page")) {
							Tools::redirect(Tools::getValue("prev_page").".php");
						}
						
						if ($this->regSuccess && self::$cookie->UserID == 0) { // Send Email To User 
							if ($this->member->LanguageID == 4) {
								$title = "<TAS Agent> ご登録ありがとうございます。";
								$content = $this->member->Name."　様<br/><br/>
								TAS Agentへの登録を頂きましてありがとうございます。<br/>
								審査後、改めてTAS Agent よりご連絡いたします。<br/><br/>
								Tas-agent.com <br/>
								web@tas-agent.com";
							} else {
								$title = "<TAS Agent> Thank you very much for registration";
								$content = "Dear ".$this->member->Name." <br/><br/>
								Thank you very much for registration.<br/>
								We will get back to you soon for your account information. <br/><br/>
								Tas-agent.com <br/>
								web@tas-agent.com";
							}
							//$headers = 'From: web@tas-agent.com'."\r\n";
        					//$headers .= 'MIME-Version: 1.0'."\r\n";
        					//$headers .= 'Content-Type: text/html; charset=utf-8'."\r\n";
							//mail($this->member->Email, $title, $content, $headers);
                            Tools::sendEmail($this->member->Email, $title, $content);
						}
					}else {
						$this->errors[] = Tools::displayError('Error in update company.');
					}
				}
				
				//if (!$authentication OR !$member->UserID)
				//{
					/* Handle brute force attacks */
				/*	sleep(1);
					$this->errors[] = Tools::displayError('Login failed');
				}
				else
				{
					self::$cookie->UserID = (int)($member->UserID);
					self::$cookie->LoginUserName = $member->LoginUserName;
					self::$cookie->logged = 1;
					self::$cookie->Password = $member->Password;
					self::$cookie->Email = $member->Email;
					self::$cookie->LanguageID = $member->LanguageID;
					self::$cookie->RoleID = $member->RoleID;
					Tools::redirect('index.php');
				}*/
			}
		}
		
		
		self::$smarty->assign(array(
			'languages' => Tools::getLanguages(), 
			'sl_lang' => self::$cookie->LanguageID,  
			'countries' => Tools::getCountries(),
			'reg_success' => $this->regSuccess,
			'member' => $this->member,
			'company' => $this->company,
			'mid' => Tools::getValue("mid"), 
			'prev_page' => Tools::getValue("prev_page"), 
			'editCompany' => $editCompany,
			'editLanguage' => $editLanguage,
			'myinfo' => $myinfo, 
			'editRole' => $editRole,
			'roleList' => $roleList,
			'mod' => Tools::getValue("mod"),
			'editDelete' => $editDelete,
			'editPayment' => $editPayment, 
			'editPref' => $editPref,
			'editHotel' => $editHotel
		));
	}

	public function setMedia()
	{
		parent::setMedia();
		global $cookie;
		$iso = Language::getIsoById((int)$cookie->LanguageID);
		Tools::addJS(_THEME_JS_DIR_.'jquery.validate_'.$iso.'.js');
	}

	public function process()
	{
		parent::process();
		
	}

	public function displayContent()
	{
		parent::displayContent();
		if ($this->regSuccess && self::$cookie->UserID == 0)
			self::$smarty->display(_TAS_THEME_DIR_.'register_ok.tpl');
		else self::$smarty->display(_TAS_THEME_DIR_.'register.tpl');
	}
}

