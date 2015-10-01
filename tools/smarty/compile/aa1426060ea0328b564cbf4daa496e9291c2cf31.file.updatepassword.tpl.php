<?php /* Smarty version Smarty-3.0.7, created on 2015-09-28 04:15:32
         compiled from "/var/www/html/tas-agent/themes/default/updatepassword.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3956740355608bee4753514-99751352%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aa1426060ea0328b564cbf4daa496e9291c2cf31' => 
    array (
      0 => '/var/www/html/tas-agent/themes/default/updatepassword.tpl',
      1 => 1442369376,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3956740355608bee4753514-99751352',
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

		if($("#npassword").val() == '') {
			$("#npassword_error").html("<?php echo smartyTranslate(array('s'=>"new password is required"),$_smarty_tpl);?>
");
			$("#npassword").focus();
			return false;
		} else {
			$("#npassword_error").html("");
		}

		if($("#confirm").val() == '') {
			$("#confirm_error").html("<?php echo smartyTranslate(array('s'=>"confirm password is required"),$_smarty_tpl);?>
");
			$("#confirm").focus();
			return false;
		} else {
			$("#confirm_error").html("");
		}

		$("#updatepasswordFrm").submit();
		alert("<?php echo smartyTranslate(array('s'=>"Updated!"),$_smarty_tpl);?>
");
		return false;
	}
    $(document).ready(function () {
    $('.content_outer').attr("style","min-height:500px;");

    });
</script>

	<div class="left right_content_outer">
        <div class="pass_form_box">
			<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./common/errors.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
        	<div class="title"><?php echo smartyTranslate(array('s'=>'Please input your new password'),$_smarty_tpl);?>
</div>
            <div class="content">
			<form method="post" action="updatepassword.php" name="updatepasswordFrm" id="updatepasswordFrm" >
			<input type="hidden" name="SubmitUpdatepassword" value="1" />
			<input type="hidden" name="email" value="<?php echo $_smarty_tpl->getVariable('email')->value;?>
" />
			<!-- your information part start -->
            

				<div class="input_info">
					<label><?php echo smartyTranslate(array('s'=>'Old Password'),$_smarty_tpl);?>
:</label>
					<input type="password" name="password" id="password" value="" class="userid_input"/>
					<span class="red">*</span>
					<div style="padding-left:125px;padding-top:10px" id="password_error" class="red"> </div>
				</div>

				<div class="input_info">
					<label><?php echo smartyTranslate(array('s'=>'New Password'),$_smarty_tpl);?>
:</label>
					<input type="password" name="npassword" id="npassword" value="" class="userid_input"/>
					<span class="red">*</span>
					<div style="padding-left:125px;padding-top:10px" id="npassword_error" class="red"> </div>
				</div>

				<div class="input_info">
					<label><?php echo smartyTranslate(array('s'=>'Confirm Password'),$_smarty_tpl);?>
:</label>
					<input type="password" name="confirm" id="confirm" value="" class="userid_input"/>
					<span class="red">*</span>
					<div style="padding-left:125px;padding-top:10px" id="confirm_error" class="red"> </div>
				</div>

				<div style="margin-top:10px;border-top:1px solid #ddd;padding-top:10px;text-align:center">
            		<input type="button" class="button orange medium" onclick="checkSubmit()" value="<?php echo smartyTranslate(array('s'=>'Save'),$_smarty_tpl);?>
"/>
				</div>
			<div class="clearfix"></div>
			</form>
            </div>
        </div>
  	</div>