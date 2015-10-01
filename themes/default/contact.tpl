<script>
	function checkSubmit() {
		if($("#name").val() == '') {
			$("#name_error").html("{l s="name is required"}");
			$("#name").focus();
			return false;
		} else {
			$("#name_error").html("");
		}

		if($("#email").val() == '') {
			$("#email_error").html("{l s="email is required"}");
			$("#email").focus();
			return false;
		} else {
			$("#email_error").html("");
		}

		if($("#tel").val() == '') {
			$("#tel_error").html("{l s="telephone is required"}");
			$("#tel").focus();
			return false;
		} else {
			$("#tel_error").html("");
		}

		if($("#content").val() == '') {
			$("#content_error").html("{l s="content is required"}");
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
    		<a href="{$base_dir}"><img src="{$img_dir}logo.jpg" alt="TAS-AGENT" width="254" /></a>
			<p style="margin:10px 0px;">{l s='TAS Agent is online booking system to connect agents and Hotel in Japan'}</p>
        </div>

		<div class="right" style="width:200px">
			<div class="top_language">
				<form method="post" action="" id="langFrm">
				<input type="hidden" name="clang" value="1" />
				<select name="languageId" style="width:150px;margin-top:15px" onchange="changeLanguage(); return false;" id="languageId">
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
        <div class="about_txt_part" style="height:438px;">
			{include file="$tpl_dir./common/errors.tpl"}
        	<h2>{l s='Please fill out followings to contact'}</h2>
			<form method="post" action="contact.php" name="contactFrm" id="contactFrm" >
			<input type="hidden" name="SubmitContact" value="1" />
			<br />
			<!-- your information part start -->
				<div class="input_info">
					<label>{l s='Name'}:</label>
					<input type="text" name="name" id="name" value=""/>
					<span class="red">*</span>
					<span id="name_error" class="red"> </span>
				</div>

				<div class="input_info">
					<label>{l s='E-mail'}:</label>
					<input type="text" name="email" id="email" value=""/>
					<span class="red">*</span>
					<span id="email_error" class="red"> </span>
				</div>

				<div class="input_info">
					<label>{l s='TEL'}:</label>
					<input type="text" name="tel" id="tel" value=""/>
					<span class="red">*</span>
					<span id="tel_error" class="red"> </span>
				</div>

				<div class="input_info">
					<label>{l s='Message'}:</label>
					<textarea name="content" id="content" rows="15" cols="55"></textarea>
					<span class="red">*</span>
					<span id="content_error" class="red"> </span>
				</div>


			<div style="margin-top:20px;padding-left:120px;">
            	<div class="left register_apply"><input type="button" class="button orange" onclick="checkSubmit()" value="{l s='Send'}"/></div>
            </div>
			<div class="clearfix"></div>
			</form>
        </div>
    </div>
    </div>
  	