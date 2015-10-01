<script>
	function checkSubmit() {
		if($("#email").val() == '') {
			$("#email_error").html("{l s="email is required"}");
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
    		<a href="{$base_dir}"><img src="{$img_dir}logo.jpg" alt="TAS-AGENT" width="254" /></a>
       		<p style="margin:10px 0px;">{l s='TAS Agent is online booking system to connect agents and Hotel in Japan'}</p>
        </div>

		<div class="right" style="width:200px">
			<div class="top_language">
				<form method="post" action="" id="langFrm">
				<input type="hidden" name="clang" value="1" />
				<select name="languageId" style="width:150px;margin-top:15px" onChange="changeLanguage(); return false;" id="languageId">
					{foreach from=$languages key=k item=lang_name}
						<option value="{$k|escape:'htmlall':'UTF-8'}" {if ($sl_lang == $k)} selected="selected" {/if}>{l s=$lang_name}&nbsp;</option>
					{/foreach}
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
			
        	<div class="title">{l s='Forgot your password?'}<br/>{l s='Please input email address below to reset password'}</div>
            <div class="content">
			<form method="post" action="forgotpassword.php" name="forgotpasswordFrm" id="forgotpasswordFrm" >
			<input type="hidden" name="SubmitForgotpassword" value="1" />
			
			<!-- your information part start -->
				
				<div class="input_info" style="padding-left:10px;">
					<label style="width:80px;">{l s='E-Mail'}:</label>
					<input type="text" name="email" id="email" value="" class="userid_input"/>
					<span class="red">*</span>
					<div style="padding-left:85px;padding-top:10px" id="email_error" class="red">
						{foreach from=$errors key=k item=error}
                           {l s=$error}
						{/foreach}
					</div>
				</div>
				<div class="clearfix"></div>
				<div style="margin-top:20px;padding-top:10px;text-align:center;border-top:1px solid #ddd;">
					<input type="button" class="button orange medium" onClick="checkSubmit()" value="{l s='Reset Password'}"/>
				</div>
			
			</form>
            </div>
        </div>
    </div>
    </div>
  	