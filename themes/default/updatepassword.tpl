<script>
	function checkSubmit() {
		
		if($("#password").val() == '') {
			$("#password_error").html("{l s="password is required"}");
			$("#password").focus();
			return false;
		} else {
			$("#password_error").html("");
		}

		if($("#npassword").val() == '') {
			$("#npassword_error").html("{l s="new password is required"}");
			$("#npassword").focus();
			return false;
		} else {
			$("#npassword_error").html("");
		}

		if($("#confirm").val() == '') {
			$("#confirm_error").html("{l s="confirm password is required"}");
			$("#confirm").focus();
			return false;
		} else {
			$("#confirm_error").html("");
		}

		$("#updatepasswordFrm").submit();
		alert("{l s="Updated!"}");
		return false;
	}
    $(document).ready(function () {
    $('.content_outer').attr("style","min-height:500px;");

    });
</script>

	<div class="left right_content_outer">
        <div class="pass_form_box">
			{include file="$tpl_dir./common/errors.tpl"}
        	<div class="title">{l s='Please input your new password'}</div>
            <div class="content">
			<form method="post" action="updatepassword.php" name="updatepasswordFrm" id="updatepasswordFrm" >
			<input type="hidden" name="SubmitUpdatepassword" value="1" />
			<input type="hidden" name="email" value="{$email}" />
			<!-- your information part start -->
            

				<div class="input_info">
					<label>{l s='Old Password'}:</label>
					<input type="password" name="password" id="password" value="" class="userid_input"/>
					<span class="red">*</span>
					<div style="padding-left:125px;padding-top:10px" id="password_error" class="red"> </div>
				</div>

				<div class="input_info">
					<label>{l s='New Password'}:</label>
					<input type="password" name="npassword" id="npassword" value="" class="userid_input"/>
					<span class="red">*</span>
					<div style="padding-left:125px;padding-top:10px" id="npassword_error" class="red"> </div>
				</div>

				<div class="input_info">
					<label>{l s='Confirm Password'}:</label>
					<input type="password" name="confirm" id="confirm" value="" class="userid_input"/>
					<span class="red">*</span>
					<div style="padding-left:125px;padding-top:10px" id="confirm_error" class="red"> </div>
				</div>

				<div style="margin-top:10px;border-top:1px solid #ddd;padding-top:10px;text-align:center">
            		<input type="button" class="button orange medium" onclick="checkSubmit()" value="{l s='Save'}"/>
				</div>
			<div class="clearfix"></div>
			</form>
            </div>
        </div>
  	</div>