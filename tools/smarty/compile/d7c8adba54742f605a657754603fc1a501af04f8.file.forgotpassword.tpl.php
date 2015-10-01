<?php /* Smarty version Smarty-3.0.7, created on 2015-09-07 14:05:24
         compiled from "/var/www/tas/themes/default/forgotpassword.tpl" */ ?>
<?php /*%%SmartyHeaderCode:187595643655ed37349512d1-85874078%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd7c8adba54742f605a657754603fc1a501af04f8' => 
    array (
      0 => '/var/www/tas/themes/default/forgotpassword.tpl',
      1 => 1441591111,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '187595643655ed37349512d1-85874078',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/tas/tools/smarty/plugins/modifier.escape.php';
?><script>
	function checkSubmit() {
		if($("#email").val() == '') {
			$("#email_error").html("<?php echo smartyTranslate(array('s'=>"email is required"),$_smarty_tpl);?>
");
			$("#email").focus();
			return false;
		} else {
			$("#email_error").html("");
		}

		$("#forgotpasswordFrm").submit();
		return false;
	}

	function changeLanguage() {
		$("#langFrm").submit();
		return false;
	}
</script>

<body style="background-color:#FFF;">
<div class="layerout">
    <div class="header">
    	<div class="logo">
    		<a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
logo.jpg" alt="TAS-AGENT" width="254" /></a>
       		<p style="margin:10px 0px;"><?php echo smartyTranslate(array('s'=>'TAS Agent is online booking system to connect agents and Hotel in Japan'),$_smarty_tpl);?>
</p>
        </div>

		<div class="right" style="width:200px">
			<div class="top_language">
				<form method="post" action="" id="langFrm">
				<input type="hidden" name="clang" value="1" />
				<select name="languageId" style="width:150px;margin-top:15px" onChange="changeLanguage(); return false;" id="languageId">
					<?php  $_smarty_tpl->tpl_vars['lang_name'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('languages')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['lang_name']->key => $_smarty_tpl->tpl_vars['lang_name']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['lang_name']->key;
?>
						<option value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['k']->value,'htmlall','UTF-8');?>
" <?php if (($_smarty_tpl->getVariable('sl_lang')->value==$_smarty_tpl->tpl_vars['k']->value)){?> selected="selected" <?php }?>><?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['lang_name']->value),$_smarty_tpl);?>
&nbsp;</option>
					<?php }} ?>
				</select>
				</form>
			</div>
		</div>
    </div>
  <div class="clearfix"></div>
    <div class="top_line"></div>
    <div class="content_outer">
    <div class="content">
        <div <div class="pass_form_box" style="height:190px;width:450px">
			
        	<div class="title"><?php echo smartyTranslate(array('s'=>'Forgot your password?'),$_smarty_tpl);?>
<br/><?php echo smartyTranslate(array('s'=>'Please input email address below to reset password'),$_smarty_tpl);?>
</div>
            <div class="content">
			<form method="post" action="forgotpassword.php" name="forgotpasswordFrm" id="forgotpasswordFrm" >
			<input type="hidden" name="SubmitForgotpassword" value="1" />
			
			<!-- your information part start -->
				
				<div class="input_info" style="padding-left:10px;">
					<label style="width:80px;"><?php echo smartyTranslate(array('s'=>'E-Mail'),$_smarty_tpl);?>
:</label>
					<input type="text" name="email" id="email" value="" class="userid_input"/>
					<span class="red">*</span>
					<div style="padding-left:85px;padding-top:10px" id="email_error" class="red">
						<?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('errors')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['error']->key;
?>
                           <?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['error']->value),$_smarty_tpl);?>

						<?php }} ?>
					</div>
				</div>
				<div class="clearfix"></div>
				<div style="margin-top:20px;padding-top:10px;text-align:center;border-top:1px solid #ddd;">
					<input type="button" class="button orange medium" onClick="checkSubmit()" value="<?php echo smartyTranslate(array('s'=>'Reset Password'),$_smarty_tpl);?>
"/>
				</div>
			
			</form>
            </div>
        </div>
    </div>
    </div>
  	