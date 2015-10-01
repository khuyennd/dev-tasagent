<?php /* Smarty version Smarty-3.0.7, created on 2013-12-19 13:50:38
         compiled from "/var/www/html/themes/default/resetpassword.tpl" */ ?>
<?php /*%%SmartyHeaderCode:203304074652b27b1e286735-57525867%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dc49e4557d1020308ddca4389f9d32e1690406b8' => 
    array (
      0 => '/var/www/html/themes/default/resetpassword.tpl',
      1 => 1387425939,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '203304074652b27b1e286735-57525867',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<script>
	function checkSubmit() {
		if($("#password").val() == '') {
			$("#password_error").html("<?php echo smartyTranslate(array('s'=>"password is required"),$_smarty_tpl);?>
");
			$("#password").focus();
			return false;
		} else {
			$("#password_error").html("");
		}

		if($("#confirm").val() == '') {
			$("#confirm_error").html("<?php echo smartyTranslate(array('s'=>"confirm password is required"),$_smarty_tpl);?>
");
			$("#confirm").focus();
			return false;
		} else {
			$("#confirm_error").html("");
		}

		$("#resetpasswordFrm").submit();
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
    </div>
  <div class="clearfix"></div>
    <div class="top_line"></div>
    <div class="content_outer">
    <div class="content">
        <div <div class="pass_form_box" style="height:220px;">
			
        	<div class="title"><?php echo smartyTranslate(array('s'=>'Please input your new password'),$_smarty_tpl);?>
</div>
            <div class="content">
			<form method="post" action="resetpassword.php" name="resetpasswordFrm" id="resetpasswordFrm" >
			<input type="hidden" name="SubmitResetpassword" value="1" />
			<input type="hidden" name="code" value="<?php echo $_smarty_tpl->getVariable('code')->value;?>
" />
			<!-- your information part start -->
				<div class="input_info">
					<label><?php echo smartyTranslate(array('s'=>'New Password'),$_smarty_tpl);?>
:</label>
					<input type="password" name="password" id="password" value="" class="userid_input"/>
					<span class="red">*</span>
					<span id="password_error" class="red"> </span>
				</div>

				<div class="input_info">
					<label><?php echo smartyTranslate(array('s'=>'Confirm Password'),$_smarty_tpl);?>
:</label>
					<input type="password" name="confirm" id="confirm" value="" class="userid_input"/>
					<span class="red">*</span>
					<span id="confirm_error" class="red"> </span>
				</div>
                <div class="clearfix"></div>
				<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./common/errors_login.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
				<div style="margin-top:20px;padding-top:10px;text-align:center;border-top:1px solid #ddd;">
            		<input type="button" class="button orange medium" onClick="checkSubmit()" value="<?php echo smartyTranslate(array('s'=>'Change Password'),$_smarty_tpl);?>
"/>
				</div>			
			</form>
        </div>
    </div>
    </div>
  	