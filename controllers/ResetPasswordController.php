<?php
/*
* 2012 TAS
*/
if (!defined('IN_TAS')) {
    exit('Access Denied');
}

class ResetPasswordController extends FrontController
{
    public function __construct()
    {
        $this->php_self = "resetpassword.php";
        $this->auth = false;
        $this->content_only = true;
        parent::__construct();
    }

    public function process()
    {
        parent::process();
        self::$smarty->assign("code", Tools::getValue("code"));
        $code = Tools::getValue("code");
        $code = explode('#_#', base64_decode($code));
        if (time() > $code[0]) {
            $this->expired = true;
        }
        if (Tools::isSubmit('SubmitResetpassword')) {
            $password = Tools::getValue("password");
            $confirm = Tools::getValue("confirm");
            $code = Tools::getValue("code");

            if (!$password) $this->errors[] = Tools::displayError('password is required');
            else if (!$confirm) $this->errors[] = Tools::displayError('confirm password is required');
            else if (!$code) $this->errors[] = Tools::displayError('Invalid Access!!');
            else {
                if ($password != $confirm) {
                    $this->errors[] = Tools::displayError('Password confirmation is not mismatch');
                } else {
                    $code = explode('#_#', base64_decode($code));

                    if (time() > $code[0]) {
                        $this->errors[] = Tools::displayError('Check code has expired!');
                        $this->expired = true;
                    } else {
                        $result = Member::checkReset($code[1]);
                        if ($result) {
                            if (Member::resetPassword($code[1], $password)) {
                                self::$smarty->assign("LanguageID", $result['LanguageID']);
                                $this->success = true;
                            } else
                                $this->errors[] = Tools::displayError('Invalid Access!!');
                        } else {
                            $this->errors[] = Tools::displayError('Invalid check code!!');
                        }
                    }
                }
            }
        }
    }

    public function displayContent()
    {
        parent::displayContent();
        if ($this->success) self::$smarty->display(_TAS_THEME_DIR_ . 'resetsuccess.tpl');
        elseif ($this->expired) self::$smarty->display(_TAS_THEME_DIR_ . 'passwordexpired.tpl');
        else self::$smarty->display(_TAS_THEME_DIR_ . 'resetpassword.tpl');
    }

    public function setMedia()
    {
        parent::setMedia();
        Tools::addJS(_THEME_JS_DIR_ . 'jquery.validate.js');
    }
}
