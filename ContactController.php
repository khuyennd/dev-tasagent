<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class ContactController extends FrontController
{
	public function __construct()
	{
		$this->php_self = "contact.php";
		$this->auth = false;
		$this->content_only = true; 
		parent::__construct();
	}
	
	public function process()
	{
		parent::process();

		if (Tools::isSubmit('SubmitContact')) {
			$name = Tools::getValue("name");
			$email = Tools::getValue("email");
			$tel = Tools::getValue("tel");
			$content = Tools::getValue("content");
			
			if(!$name)	$this->errors[] = Tools::displayError('name is required');
			else if(!$email)	$this->errors[] = Tools::displayError('email is required');
			else if(!$tel)	$this->errors[] = Tools::displayError('telephone is required');
			else if(!$content)	$this->errors[] = Tools::displayError('content is required');
			else {
				$to      = 'web@tas-agent.com';
				$subject = 'Message from ' . $name . ' via TAS AGENT Contact';
				$message = 'Name: ' . $name . "\n";
				$message .= 'E-mail: ' . $email . "\n";
				$message .= 'TEL: ' . $tel . "\n";
				$message .= 'Message: ' . $content . "\n";
				//$headers = 'From: contact@tas-agent.com' . "\r\n";
                Tools::sendEmail($to, $subject, $message);
				//@mail($to, $subject, $message, $headers);
				$this->success = true;
			}
		}

	}
	
	public function displayContent()
	{
		parent::displayContent();
		if($this->success) self::$smarty->display(_TAS_THEME_DIR_.'success.tpl');
		else self::$smarty->display(_TAS_THEME_DIR_.'contact.tpl');
	}

	public function setMedia()
	{
		parent::setMedia();
		Tools::addJS(_THEME_JS_DIR_.'jquery.validate.js');
	}
}
