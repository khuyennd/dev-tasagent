<script>
	function checkSubmit() {
		if($("#password").val() == '') {
			$("#password_error").html("{l s="password is required"}");
			$("#password").focus();
			return false;
		} else {
			$("#password_error").html("");
		}

		if($("#confirm").val() == '') {
			$("#confirm_error").html("{l s="confirm password is required"}");
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
    		<a href="{$base_dir}"><img src="{$img_dir}logo.jpg" alt="TAS-AGENT" width="254" /></a>
        	<p style="margin:10px 0px;">{l s='TAS Agent is online booking system to connect agents and Hotel in Japan'}</p>
	    </div>
    </div>
  <div class="clearfix"></div>
    <div class="top_line"></div>
    <div class="content_outer">
    <div class="content">
        <div <div class="pass_form_box" style="height:220px;">
			
        	<div class="title">{l s='Please input your new password'}</div>
            <div class="content">
			<form method="post" action="resetpassword.php" name="resetpasswordFrm" id="resetpasswordFrm" >
			<input type="hidden" name="SubmitResetpassword" value="1" />
			<input type="hidden" name="code" value="{$code}" />
			<!-- your information part start -->
				<div class="input_info">
					<label>{l s='New Password'}:</label>
					<input type="password" name="password" id="password" value="" class="userid_input"/>
					<span class="red">*</span>
					<span id="password_error" class="red"> </span>
				</div>

				<div class="input_info">
					<label>{l s='Confirm Password'}:</label>
					<input type="password" name="confirm" id="confirm" value="" class="userid_input"/>
					<span class="red">*</span>
					<span id="confirm_error" class="red"> </span>
				</div>
                <div class="clearfix"></div>
				{include file="$tpl_dir./common/errors_login.tpl"}
				<div style="margin-top:20px;padding-top:10px;text-align:center;border-top:1px solid #ddd;">
            		<input type="button" class="button orange medium" onClick="checkSubmit()" value="{l s='Change Password'}"/>
				</div>			
			</form>
        </div>
    </div>
    </div>
  	