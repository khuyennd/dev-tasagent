<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class ForgotPasswordController extends FrontController
{
	public function __construct()
	{
		$this->php_self = "forgotpassword.php";
		$this->auth = false;
		$this->content_only = true; 
		parent::__construct();
	}
	
	public function process()
	{
		parent::process();

		if (Tools::isSubmit('SubmitForgotpassword')) {
			$email = Tools::getValue("email");
			
			if(!$email)	$this->errors[] = Tools::displayError('email is required');
			else {
				$result = Member::checkReset($email);
				if($result)	{
					$to = $email;
					$headers = 'From: web@tas-agent.com'."\r\n";
					$headers .= 'MIME-Version: 1.0'."\r\n";
					$headers .= 'Content-Type: text/html; charset=utf-8'."\r\n";
					
					$url = 'http://'.$_SERVER['HTTP_HOST'].'/resetpassword.php?code='.base64_encode($result['Password'].'#_#'.$email);
					if($result['LanguageID'] == 1) {	
						$subject = 'TAS-Agent - Password reset';
						$message = 'Dear '.$result['Name'].":<br/><br/>";
						$message .= 'Please click below to reset your password of TAS Agent as requested.'."<br/>";
						$message .= '<a href="'.$url.'">'.$url."</a><br/>";
						$message .= 'Thank you for using TAS-Agent'."<br/><br/>";
						$message .= 'TAS Agent Team';
					} else if($result['LanguageID'] == 2) {
						$subject = 'TAS-Agent - 重置密码';
						$message = '您好：'.$result['Name']."<br/><br/>";
						$message .= '请点击如下链接重置您的TAS Agent账户信息。'."<br/>";
						$message .= '<a href="'.$url.'">'.$url."</a><br/>";
						$message .= '感谢您使用TAS-Agent'."<br/><br/>";
						$message .= 'TAS Agent 团队';
					} else if($result['LanguageID'] == 3) {
						$subject = 'TAS-Agent - 重置密碼';
						$message = '您好 '.$result['Name']."<br/><br/>";
						$message .= '請點擊如下鏈接重置您的TAS Agent帳戶信息。'."<br/>";
						$message .= '感謝您使用TAS-Agent'."<br/><br/>";
						$message .= 'TAS Agent 團隊';
					} else {
						$subject = 'TAS-Agent - パスワードリセット';
						$message = $result['Name']." 様<br/><br/>";
						$message .= '下記リンクをクリックしTAS Agentのパスワードを再設定してください。'."<br/>";
						$message .= '<a href="'.$url.'">'.$url."</a><br/><br/>";
						$message .= 'TAS-Agentのご利用ありがとうございます。'."<br/><br/>";
						$message .= 'TAS Agent Team';
					}
                    Tools::sendEmail($to, $subject, $message);
					//@mail($to, $subject, $message, $headers);
					self::$smarty->assign("LanguageID", $result['LanguageID']);
					$this->success = true;
				} else {
					$this->errors[] = Tools::displayError('Your email address is not registered.');
				}
			}
		}
	}
	
	public function displayContent()
	{
		parent::displayContent();
		if($this->success) self::$smarty->display(_TAS_THEME_DIR_.'success.tpl');
		else self::$smarty->display(_TAS_THEME_DIR_.'forgotpassword.tpl');
	}

	public function setMedia()
	{
		parent::setMedia();
		Tools::addJS(_THEME_JS_DIR_.'jquery.validate.js');
	}
}
