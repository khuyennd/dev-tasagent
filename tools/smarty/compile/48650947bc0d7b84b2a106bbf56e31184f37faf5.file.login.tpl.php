<?php /* Smarty version Smarty-3.0.7, created on 2015-09-16 04:00:04
         compiled from "/var/www/html/tas-agent/themes/default/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:148447331655f8e944aad098-39968607%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '48650947bc0d7b84b2a106bbf56e31184f37faf5' => 
    array (
      0 => '/var/www/html/tas-agent/themes/default/login.tpl',
      1 => 1442369377,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '148447331655f8e944aad098-39968607',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/html/tas-agent/tools/smarty/plugins/modifier.escape.php';
?>﻿<body>
<div class="content_outer" style="padding-bottom:50px;">

    <div class="login_form_box">
    <form method="post" action="login.php" name="loginFrm" id="loginFrm">
    	<input type="hidden" name="SubmitLogin" value="1" />
		<input type="hidden" name="back" value="<?php echo $_smarty_tpl->getVariable('back')->value;?>
" />

        <div class="left login_logo">
        	<img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
logo.jpg" width="263px" alt="" />
            <p style="margin-top:10px;width:420px;"><?php echo smartyTranslate(array('s'=>'TAS Agent is online booking system to connect agents and Hotel in Japan'),$_smarty_tpl);?>
</p>
        </div>
        <div class="left" style="padding-left:50px;">
            <div class="login_form_outer">
                <div class="right" >
                    <select name="languageId" onChange="changeLanguage(); return false;" id="languageId">
                        <option value="0"><?php echo smartyTranslate(array('s'=>'Language'),$_smarty_tpl);?>
</option>
						<?php  $_smarty_tpl->tpl_vars['lang_name'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('languages')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['lang_name']->key => $_smarty_tpl->tpl_vars['lang_name']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['lang_name']->key;
?>
                            <option value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['k']->value,'htmlall','UTF-8');?>
" style="width:130px;" <?php if (($_smarty_tpl->getVariable('sl_lang')->value==$_smarty_tpl->tpl_vars['k']->value)){?> selected="selected" <?php }?>><?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['lang_name']->value),$_smarty_tpl);?>
&nbsp;</option>
                        <?php }} ?>
                    </select>
                </div>
                <div class="clearfix"></div>
                
                <div class="userid" style="margin-top:15px;">
                    <span style="width:60px;display:-moz-inline-box;display:inline-block;"><?php echo smartyTranslate(array('s'=>'Login ID'),$_smarty_tpl);?>
</span>
                    <input type="text" name="username" id="username" value="" tabindex="2"  class="userid_input" style="width:200px;"/>
                    
                </div>
                <div class="clearfix"></div>
                <div class="psw">
                    <span style="width:60px;display:-moz-inline-box;display:inline-block;"><?php echo smartyTranslate(array('s'=>'Password'),$_smarty_tpl);?>
</span>
                    <input type="password" name="passwd" id="passwd" value="" style="display:none;width:200px;" class="userid_input"/>
                    <input type="text" id="passwdf" value="" class="userid_input" tabindex="2" style="width:200px;"/>
                </div>             
                <?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./common/errors_login.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
            </div>
            <div style="margin-top:5px;">
            	<div class="left" style="margin-right:20px;">
	            	<input type="submit" class="button orange medium" value="<?php echo smartyTranslate(array('s'=>'Login'),$_smarty_tpl);?>
" style="margin-right:20px;" />                    
                </div>
                <div class="left">
                <input type="checkbox" id="chk_remember" name="remember" value="1" /><label for="chk_remember" style="padding-left:10px;"><?php echo smartyTranslate(array('s'=>'Keep me logged in'),$_smarty_tpl);?>
</label><br/>
                <a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
forgotpassword.php" class="blue underline"><?php echo smartyTranslate(array('s'=>'Forgot your password?'),$_smarty_tpl);?>
</a>
				</div>
                <div class="clearfix"></div>
                <div style="margin-top:30px;">
                	<p style="margin-bottom:5px;"><a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
auth.php?mod=agent" class="blue" >►<?php echo smartyTranslate(array('s'=>'Sign up for travel agent'),$_smarty_tpl);?>
</a></p>
                	<a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
auth.php?mod=hotel" class="blue" >►<?php echo smartyTranslate(array('s'=>'Sign up for hotel in Japan'),$_smarty_tpl);?>
</a>
                </div>
            </div>
            </div>
    </form>
    </div>
    </div>
     
    <script>
    <!--
    	$(document).ready(function(){
    		//$("#username").focus();
    	});
		function changeLanguage() {
			location.href="login.php?clang&languageId=" + $('#languageId').val();
			return false;
		}
    //-->
    </script>
</body>