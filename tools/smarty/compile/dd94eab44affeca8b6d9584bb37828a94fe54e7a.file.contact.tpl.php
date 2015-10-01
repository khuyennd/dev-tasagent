<?php /* Smarty version Smarty-3.0.7, created on 2015-09-23 06:55:52
         compiled from "/var/www/html/tas-agent/themes/default/contact.tpl" */ ?>
<?php /*%%SmartyHeaderCode:88355351156024cf8697094-72448992%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dd94eab44affeca8b6d9584bb37828a94fe54e7a' => 
    array (
      0 => '/var/www/html/tas-agent/themes/default/contact.tpl',
      1 => 1442369373,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '88355351156024cf8697094-72448992',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/html/tas-agent/tools/smarty/plugins/modifier.escape.php';
?><script>
	function checkSubmit() {
		if($("#name").val() == '') {
			$("#name_error").html("<?php echo smartyTranslate(array('s'=>"name is required"),$_smarty_tpl);?>
");
			$("#name").focus();
			return false;
		} else {
			$("#name_error").html("");
		}

		if($("#email").val() == '') {
			$("#email_error").html("<?php echo smartyTranslate(array('s'=>"email is required"),$_smarty_tpl);?>
");
			$("#email").focus();
			return false;
		} else {
			$("#email_error").html("");
		}

		if($("#tel").val() == '') {
			$("#tel_error").html("<?php echo smartyTranslate(array('s'=>"telephone is required"),$_smarty_tpl);?>
");
			$("#tel").focus();
			return false;
		} else {
			$("#tel_error").html("");
		}

		if($("#content").val() == '') {
			$("#content_error").html("<?php echo smartyTranslate(array('s'=>"content is required"),$_smarty_tpl);?>
");
			$("#content").focus();
			return false;
		} else {
			$("#content_error").html("");
		}

		$("#contactFrm").submit();
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
				<select name="languageId" style="width:150px;margin-top:15px" onchange="changeLanguage(); return false;" id="languageId">
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
        <div class="about_txt_part" style="height:438px;">
			<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./common/errors.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
        	<h2><?php echo smartyTranslate(array('s'=>'Please fill out followings to contact'),$_smarty_tpl);?>
</h2>
			<form method="post" action="contact.php" name="contactFrm" id="contactFrm" >
			<input type="hidden" name="SubmitContact" value="1" />
			<br />
			<!-- your information part start -->
				<div class="input_info">
					<label><?php echo smartyTranslate(array('s'=>'Name'),$_smarty_tpl);?>
:</label>
					<input type="text" name="name" id="name" value=""/>
					<span class="red">*</span>
					<span id="name_error" class="red"> </span>
				</div>

				<div class="input_info">
					<label><?php echo smartyTranslate(array('s'=>'E-mail'),$_smarty_tpl);?>
:</label>
					<input type="text" name="email" id="email" value=""/>
					<span class="red">*</span>
					<span id="email_error" class="red"> </span>
				</div>

				<div class="input_info">
					<label><?php echo smartyTranslate(array('s'=>'TEL'),$_smarty_tpl);?>
:</label>
					<input type="text" name="tel" id="tel" value=""/>
					<span class="red">*</span>
					<span id="tel_error" class="red"> </span>
				</div>

				<div class="input_info">
					<label><?php echo smartyTranslate(array('s'=>'Message'),$_smarty_tpl);?>
:</label>
					<textarea name="content" id="content" rows="15" cols="55"></textarea>
					<span class="red">*</span>
					<span id="content_error" class="red"> </span>
				</div>


			<div style="margin-top:20px;padding-left:120px;">
            	<div class="left register_apply"><input type="button" class="button orange" onclick="checkSubmit()" value="<?php echo smartyTranslate(array('s'=>'Send'),$_smarty_tpl);?>
"/></div>
            </div>
			<div class="clearfix"></div>
			</form>
        </div>
    </div>
    </div>
  	