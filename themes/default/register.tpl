<script>
jQuery.validator.addMethod("phone", function(phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, ""); 
	return this.optional(element) || phone_number.length > 1 &&
		phone_number.match(/^[+0-9. ()-]*$/);
}, "{l s='Please specify a valid phone number'}");

jQuery.validator.addMethod("fax", function(fax_number, element) {
    fax_number = fax_number.replace(/\s+/g, "");
	return this.optional(element) || fax_number.length > 1 &&
            fax_number.match(/^[+0-9. ()-]*$/);
}, "{l s='Please specify a valid fax number'}");

	function checkAgree() {
		{if $content_only}		
		if ($('#agreeCheck').attr("checked") == undefined) {
			alert('{l s='Please check the Membership Agreement.'}');
			return false;
		} else {
			$('#agreeCheck').attr("value", 1);
			if ($("#registerFrm").validate()){
				registerFrm.submit();
				alert('{l s='Updated!'}');
			}
			return true;
		}
		{else} 
			registerFrm.submit();
			alert('{l s='Updated!'}');
			return true;
		{/if}
	}

$(document).ready(function() {
	  $("#registerFrm").validate({
	    rules: {
{if $editCompany}
{if $cookie->RoleID > 3}
			agentID : {
				maxlength: 100,
				remote: {
				    url: "auth.php?agentid",
				    type: "post",
				    data: {
					    cid: {if $company->CompanyId!=""}{$company->CompanyId}{else}0{/if}
				    }
			    }
			}, 
{/if}
	    	companyName: {
		    	required: true, 
		    	maxlength: 100
	     	},
	     	city: {
			     required: true, 
			     maxlength: 100
		    },
		    address: {
			     maxlength: 100
		    },
		    website: {
			     required: true, 
			     url: true
		    },
		    managingDirector: {
			     required: true, 
			     maxlength: 100
		    },
		    companyTel: {
			     required: true, 
			     maxlength: 100,
			     phone: true
		    },
		    companyFax: {
			     maxlength: 100,
                fax: true
		    },
{/if}
{if $member->UserID == 0}
		    loginUserName: {
		    	required: true, 
			    maxlength: 100,
			    remote: "auth.php?checkid"
		    },
{/if}
		    name: {
		    	required: true, 
			    maxlength: 100
		    }, 
		    password: {
				{if $member->UserID == 0}
		    	required: true,
		    	{/if}
			    maxlength: 100
		    }, 
		    con_password: {
		    	{if $member->UserID == 0}
		    	required: true, 
		    	{/if}
			    maxlength: 100, 
			    equalTo: password
		    },
		    email: {
		    	required: true, 
			    email: true,
			    remote: {
				    url: "auth.php?checkemail",
				    type: "post",
				    data: {
					    mid: {if $mid!=""}{$mid}{else}0{/if}
				    }
			    }
		    }, 
{if $editLanguage} 
		    tel: {
		    	required: true, 
			    maxlength: 100,
			    phone: true
		    },
{/if}
	    },
	    messages: {
	    	agentID : {
		    	remote: "{l s='Already used that agent ID.'}"
	    	}, 
		    loginUserName: {
			    remote: "{l s='Someone already has that ID. Try another?'}"
		    }, 
	     	email: { 
		     	remote:  "{l s='Someone already used that Email.'}"
			 }
	    },
	    submitHandler: function(form) {

	    	{if $content_only}		
			if ($('#agreeCheck').attr("checked") == undefined) {
				alert('{l s='Please check the Membership Agreement.'}');
			} else {
				$('#agreeCheck').attr("value", 1);
				alert('{l s='Updated!'}');
				form.submit();
			}
			{else} 
				alert('{l s='Updated!'}');
				form.submit();
			{/if}
	      }
	  });
	});

	function changeLanguage() {
		$("#langFrm").submit();
		return false;
	}
</script>
{if $content_only}
<body style="background-color:#FFF;">
<div class="content_outer">
	<div class="layerout">
		<div class="header">
	    	<div class="logo">
	    		<a href="{$base_dir}"><img src="{$img_dir}logo.jpg" alt="TAS-AGENT" width="254" /></a>
                <p style="margin:10px 0px;">{l s='TAS Agent is online booking system to connect agents and Hotel in Japan'}</p>
	        </div>
            <div class="right" style="margin-top:20px;">
            	<form method="post" action="" id="langFrm">
				<input type="hidden" name="clang" value="1" />
				<select name="languageId" style="width:150px;" onchange="changeLanguage(); return false;" id="languageId" >
                    {foreach from=$languages key=k item=lang_name}
                        <option value="{$k|escape:'htmlall':'UTF-8'}" {if ($sl_lang == $k)} selected="selected"{/if}>{l s=$lang_name}&nbsp;</option>
                    {/foreach}
                </select>
				</form>
            </div>
	        <div class="register_ad_top">
	        	<img src="{$img_dir}Register_r2_c7.jpg" alt="" width="300" style="display:none;"/>
	        </div>        
            
    	</div>
  		<div class="clearfix"></div>
    	<div class="top_line"></div>
    
    
    <div class="content">
    	
        <div class="font14 bold black">
        {if $mod=="hotel"}
        	{l s='Hotel Account registration'}
        {else}	
        	{l s='Travel Agent Registration'}
        {/if} 
        </div>
        <div class="register_com_info">
        	{l s='Please fill out followings to register.We will contact you shortly after registration.'}
{/if}		
{if !$content_only}
		<div class="left right_content_outer">
			
{/if}

{assign var="roleid" value="{$cookie->RoleID}"}
{if $smarty.get.mid > 0 && ($roleid > 3 || $roleid == 1)}
    {$hotel = HotelDetail::getHotelByUserId($smarty.get.mid)}
    <div style="float:right;font-weight:bold;">
        {include file="$tpl_dir./common/sub_menu.tpl"}
    </div>
{/if} 
			<form method="post" action="auth.php" name="registerFrm" id="registerFrm" >
            <input type="hidden" name="nohotel" value="{$smarty.get.nohotel}" />
            <input type="hidden" name="hotelid" value="{$smarty.get.hid}" />
			<input type="hidden" name="SubmitRegister" value="1" />
			<input type="hidden" name="mid" value="{$mid}" />
			<input type="hidden" name="prev_page" value="{$prev_page}" />
			<input type="hidden" name="mod" value={$mod} />
            <br />
            {include file="$tpl_dir./common/errors.tpl"}
{if $editCompany}
            <!-- company information part start -->
            <div class="font14">01. {l s='Company Information'}</div>
            <div class=" com_info_box">
            	{if $mod!=hotel && $prev_page!="hotellist" && $cookie->RoleID > 2}
            	<div class="input_info">
                    <label>{l s='Agent ID'}</label>
                    {if $cookie->RoleID > 3}
                    	<input type="text" name="agentID" value="{$company->AgentID}"/>
                    {else}
                    	{$company->AgentID} &nbsp;
                    {/if}
                </div>
            	{/if}
            	<div class="input_info">
                    <label>{l s='Company Name'}</label>
                    <input type="text" name="companyName" value="{$company->CompanyName}"/>
                    <span class="red">*</span>
                </div>
                <div class="input_info">
                    <label>{l s='Country'}</label>
                    <select name="countryId" >
                        {foreach from=$countries key=k item=name}
                        	<option value="{$k|escape:'htmlall':'UTF-8'}" {if ($company->CountryId == $k)} selected="selected"{else if ($mod=='hotel' && $k==109 &&$company->CountryId=="")} selected="selected"{else if ($prev_page=="hotellist" && $cookie->RoleID > 3 && $k==109 &&$company->CountryId=="")} selected="selected"{/if}>{$name}&nbsp;</option>
                        {/foreach}
                    </select>
                    <span class="red">*</span>
                </div>
                <div class="input_info">
                    <label>{l s='City'}</label>
                    <input type="text" name="city" value="{$company->City}"/>
                    <span class="red">*</span>
                    <span class="error"> </span>
                </div>
                <div class="input_info">
                    <label>{l s='Address'}</label>
                    <input type="text" name="address" value="{$company->Address}"/>
                </div>
                <div class="input_info">
                    <label>{l s='Website'}</label>
                    <input type="text" name="website" value="{$company->Website}" />
                    <span class="red">*</span>
                </div>
                <div class="input_info">
                    <label>{l s='Managing Director'}</label>
                    <input type="text" name="managingDirector" value="{$company->ManagingDirector}"/>
                    <span class="red">*</span>
                </div>
                <div class="input_info">
                    <label>{l s="TEL"}</label>
                    <input type="text" name="companyTel" value="{$company->Tel}"/>
                    <span class="red">*</span>
                </div>
                <div class="input_info">
                    <label>{l s="FAX"}</label>
                    <input type="text" name="companyFax" value="{$company->Fax}"/>
				<br/>
                    <label>&nbsp;</label><span class="red">
					{l s="Please input Fax number with Country code + Fax number."}<br/>
                    <label>&nbsp;</label>{l s="if your number start with \"0\" please take out \"0\". "}<br/>
                    <label>&nbsp;</label>{l s="eg: if your fax number is 03-1234-5678, please input 81312345678."}<br/></span>
                </div>
                <div class="input_info" {if $cookie->RoleID >=4&&Tools::is_Hotel($company->CompanyId)}style=""{else}style="display: none"{/if}>
                    <label>{l s='ShouShu'}</label>
                    <input type="text" name="ShouShu" value="{$company->ShouShu}"/>
                    <select name="ShouShuType" style="width: 55px;">
                        <option value="1" {if ($company->ShouShuType == 1)} selected="selected"{/if}>%</option>
                        <option value="2" {if ($company->ShouShuType == 2)} selected="selected"{/if}>￥</option>
                    </select>
                    <span class="red">*</span>
                </div>
{if $editPayment}
				<div class="input_info">
                    <label>{l s='Payment'}</label>
                    <select name="paymentMethod">
	                    <option value="0" {if ($company->PaymentMethod == 0)} selected="selected"{/if}>{l s='PrePay'}&nbsp;</option>
	                    <option value="1" {if ($company->PaymentMethod == 1)} selected="selected"{/if}>{l s='AfterPay'}&nbsp;</option>
                    </select>
                </div>
{/if}

            </div>
            <!-- company information part end -->
{/if}
            <br />
            <!-- your information part start -->
            <div class="font14">
            	{if $editCompany}02.{/if} 
            	{if $myinfo}{l s='Your Information'}{else if $mod=='self' && $cookie->RoleID==3}{l s='Admin User'}{else}{l s='User Information'}{/if}
            </div>
            <div class="your_info_box" style="border-top:2px solid #999;width:400px;">
            	<div class="input_info">
                    <label>{l s='Login ID'}</label>
                    {if $member->UserID > 0}
                    	 &nbsp;{$member->LoginUserName} &nbsp;&nbsp;&nbsp;<span class="red">※{l s='Can not change'}</span>
                    {else}
	                    <input type="text" name="loginUserName" id="loginUserName" value="{$member->LoginUserName}"/>
	                    <span class="red">*</span>
                    {/if}
                </div>
                <div class="input_info">
                    <label>{l s='Name'}</label>
                    <input type="text" name="name" id="name" value="{$member->Name}"/>
                    <span class="red">*</span>
                </div>
                <div class="input_info">
                    <label>{l s='Password'}</label>
                    <input type="password" name="password" id="password" value="{$member->Password}" />
                    <span class="red">*</span>
                </div>
                <div class="input_info">
                    <label>{l s='Re Enter Password'}</label>
                    <input type="password" name="con_password" value="{$member->Password}"/>
                    <span class="red">*</span>
                </div>
                <div class="input_info">
                    <label>{l s="E-mail"}</label>
                    <input type="text" name="email" value="{$member->Email}" />
                    <span class="red">*</span>
                </div>
{if $editLanguage}                
                <div class="input_info">
                    <label>{l s="TEL"}</label>
                    <input type="text" name="tel" value="{$member->Tel}"/>
                    <span class="red">*</span>
                </div>
                <div class="input_info">
                    <label>{l s='Language'}</label>
                    <select name="languageId">
                        {foreach from=$languages key=k item=lang_name}
	                    	<option value="{$k|escape:'htmlall':'UTF-8'}" {if ($member->LanguageID == $k)} selected="selected"{/if}>{l s="$lang_name"}&nbsp;</option>
	                    {/foreach}
                    </select>
                    <span class="red">*</span>
                </div>
{/if}
{if $editHotel}
				<div class="input_info">
                    <label>{l s="HotelCode"}</label>
                    <input type="text" name="HotelCode" value="{$member->HotelCode}"/>
                    <span class="red">*</span>
                </div>
{/if}
{if $editRole}
				<div class="input_info">
                    <label>{l s='User Type'}</label>
                    <select name="roleId">
                        {foreach from=$roleList key=k item=role_name}
	                    	<option value="{$k|escape:'htmlall':'UTF-8'}" {if ($member->RoleID == $k)} selected="selected"{/if}>{l s="$role_name"}&nbsp;</option>
	                    {/foreach}
                    </select>
                    <span class="red">*</span>
                </div>
{/if}
{if $editDelete}
	 			<div class="input_info">
                    <label>{l s='ID Use'}</label>
                    <select name="isDelete">
	                    <option value="1" {if ($member->IsDelete == 1)} selected="selected"{/if}>{l s='n'}&nbsp;</option>
	                    <option value="0" {if ($member->IsDelete == 0)} selected="selected"{/if}>{l s='y'}&nbsp;</option>
                    </select>
                    <span class="red">*</span>
                </div>
{/if}
            </div>
{if $content_only}	
            <div style="margin-top:20px;padding-left:120px;">
            	<input type="checkbox" style="float:left; margin-top:5px;" id="agreeCheck" name="agreeCheck" {if isset($smarty.post.agreeCheck) && $smarty.post.agreeCheck == '1'}checked="checked"{/if}/>
            	{if $sl_lang != 4}
            	<label style="margin-left:10px;">{l s='I agree with'}</label>
            	<a href="#" class="blue underline">{l s='Terms and Policies'}</a>
            	{else}
            	<a href="#" class="blue underline" style="margin-left:10px;">{l s='Terms and Policies'}</a>
            	<label >{l s='I agree with'}</label>
            	{/if}
            </div>
{/if}
            <!-- your information part end -->
            
            <div style="margin-top:20px;padding-left:120px;">
            	<div class="left register_apply"><input type="submit" class="button orange" value="{l s='Apply'}"/></div>
                <div class="left register_cancel"><a href="{if $prev_page!=''}{$prev_page}.php{else}index.php{/if}"><input type="button" class="button white" value="{l s='Cancel'}"/></a></div>
            </div>
            <div class="clearfix"></div>
            </form>
        </div>

        
{if !$content_only}  
    <div class="clearfix"></div>
{/if}
{if $content_only}
	</div>      	
    
</div>

</body>
{/if}

