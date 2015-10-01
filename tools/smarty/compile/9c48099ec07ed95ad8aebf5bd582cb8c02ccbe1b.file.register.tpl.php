<?php /* Smarty version Smarty-3.0.7, created on 2015-09-07 15:26:40
         compiled from "/var/www/tas/themes/default/register.tpl" */ ?>
<?php /*%%SmartyHeaderCode:57140567255ed4a408bcd01-68158560%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9c48099ec07ed95ad8aebf5bd582cb8c02ccbe1b' => 
    array (
      0 => '/var/www/tas/themes/default/register.tpl',
      1 => 1441591110,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '57140567255ed4a408bcd01-68158560',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/tas/tools/smarty/plugins/modifier.escape.php';
?><script>
jQuery.validator.addMethod("phone", function(phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, ""); 
	return this.optional(element) || phone_number.length > 1 &&
		phone_number.match(/^[+0-9. ()-]*$/);
}, "<?php echo smartyTranslate(array('s'=>'Please specify a valid phone number'),$_smarty_tpl);?>
");

jQuery.validator.addMethod("fax", function(fax_number, element) {
    fax_number = fax_number.replace(/\s+/g, "");
	return this.optional(element) || fax_number.length > 1 &&
            fax_number.match(/^[+0-9. ()-]*$/);
}, "<?php echo smartyTranslate(array('s'=>'Please specify a valid fax number'),$_smarty_tpl);?>
");

	function checkAgree() {
		<?php if ($_smarty_tpl->getVariable('content_only')->value){?>		
		if ($('#agreeCheck').attr("checked") == undefined) {
			alert('<?php echo smartyTranslate(array('s'=>'Please check the Membership Agreement.'),$_smarty_tpl);?>
');
			return false;
		} else {
			$('#agreeCheck').attr("value", 1);
			if ($("#registerFrm").validate()){
				registerFrm.submit();
				alert('<?php echo smartyTranslate(array('s'=>'Updated!'),$_smarty_tpl);?>
');
			}
			return true;
		}
		<?php }else{ ?> 
			registerFrm.submit();
			alert('<?php echo smartyTranslate(array('s'=>'Updated!'),$_smarty_tpl);?>
');
			return true;
		<?php }?>
	}

$(document).ready(function() {
	  $("#registerFrm").validate({
	    rules: {
<?php if ($_smarty_tpl->getVariable('editCompany')->value){?>
<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>3){?>
			agentID : {
				maxlength: 100,
				remote: {
				    url: "auth.php?agentid",
				    type: "post",
				    data: {
					    cid: <?php if ($_smarty_tpl->getVariable('company')->value->CompanyId!=''){?><?php echo $_smarty_tpl->getVariable('company')->value->CompanyId;?>
<?php }else{ ?>0<?php }?>
				    }
			    }
			}, 
<?php }?>
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
<?php }?>
<?php if ($_smarty_tpl->getVariable('member')->value->UserID==0){?>
		    loginUserName: {
		    	required: true, 
			    maxlength: 100,
			    remote: "auth.php?checkid"
		    },
<?php }?>
		    name: {
		    	required: true, 
			    maxlength: 100
		    }, 
		    password: {
				<?php if ($_smarty_tpl->getVariable('member')->value->UserID==0){?>
		    	required: true,
		    	<?php }?>
			    maxlength: 100
		    }, 
		    con_password: {
		    	<?php if ($_smarty_tpl->getVariable('member')->value->UserID==0){?>
		    	required: true, 
		    	<?php }?>
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
					    mid: <?php if ($_smarty_tpl->getVariable('mid')->value!=''){?><?php echo $_smarty_tpl->getVariable('mid')->value;?>
<?php }else{ ?>0<?php }?>
				    }
			    }
		    }, 
<?php if ($_smarty_tpl->getVariable('editLanguage')->value){?> 
		    tel: {
		    	required: true, 
			    maxlength: 100,
			    phone: true
		    },
<?php }?>
	    },
	    messages: {
	    	agentID : {
		    	remote: "<?php echo smartyTranslate(array('s'=>'Already used that agent ID.'),$_smarty_tpl);?>
"
	    	}, 
		    loginUserName: {
			    remote: "<?php echo smartyTranslate(array('s'=>'Someone already has that ID. Try another?'),$_smarty_tpl);?>
"
		    }, 
	     	email: { 
		     	remote:  "<?php echo smartyTranslate(array('s'=>'Someone already used that Email.'),$_smarty_tpl);?>
"
			 }
	    },
	    submitHandler: function(form) {

	    	<?php if ($_smarty_tpl->getVariable('content_only')->value){?>		
			if ($('#agreeCheck').attr("checked") == undefined) {
				alert('<?php echo smartyTranslate(array('s'=>'Please check the Membership Agreement.'),$_smarty_tpl);?>
');
			} else {
				$('#agreeCheck').attr("value", 1);
				alert('<?php echo smartyTranslate(array('s'=>'Updated!'),$_smarty_tpl);?>
');
				form.submit();
			}
			<?php }else{ ?> 
				alert('<?php echo smartyTranslate(array('s'=>'Updated!'),$_smarty_tpl);?>
');
				form.submit();
			<?php }?>
	      }
	  });
	});

	function changeLanguage() {
		$("#langFrm").submit();
		return false;
	}
</script>
<?php if ($_smarty_tpl->getVariable('content_only')->value){?>
<body style="background-color:#FFF;">
<div class="content_outer">
	<div class="layerout">
		<div class="header">
	    	<div class="logo">
	    		<a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
logo.jpg" alt="TAS-AGENT" width="254" /></a>
                <p style="margin:10px 0px;"><?php echo smartyTranslate(array('s'=>'TAS Agent is online booking system to connect agents and Hotel in Japan'),$_smarty_tpl);?>
</p>
	        </div>
            <div class="right" style="margin-top:20px;">
            	<form method="post" action="" id="langFrm">
				<input type="hidden" name="clang" value="1" />
				<select name="languageId" style="width:150px;" onchange="changeLanguage(); return false;" id="languageId" >
                    <?php  $_smarty_tpl->tpl_vars['lang_name'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('languages')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['lang_name']->key => $_smarty_tpl->tpl_vars['lang_name']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['lang_name']->key;
?>
                        <option value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['k']->value,'htmlall','UTF-8');?>
" <?php if (($_smarty_tpl->getVariable('sl_lang')->value==$_smarty_tpl->tpl_vars['k']->value)){?> selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['lang_name']->value),$_smarty_tpl);?>
&nbsp;</option>
                    <?php }} ?>
                </select>
				</form>
            </div>
	        <div class="register_ad_top">
	        	<img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
Register_r2_c7.jpg" alt="" width="300" style="display:none;"/>
	        </div>        
            
    	</div>
  		<div class="clearfix"></div>
    	<div class="top_line"></div>
    
    
    <div class="content">
    	
        <div class="font14 bold black">
        <?php if ($_smarty_tpl->getVariable('mod')->value=="hotel"){?>
        	<?php echo smartyTranslate(array('s'=>'Hotel Account registration'),$_smarty_tpl);?>

        <?php }else{ ?>	
        	<?php echo smartyTranslate(array('s'=>'Travel Agent Registration'),$_smarty_tpl);?>

        <?php }?> 
        </div>
        <div class="register_com_info">
        	<?php echo smartyTranslate(array('s'=>'Please fill out followings to register.We will contact you shortly after registration.'),$_smarty_tpl);?>

<?php }?>		
<?php if (!$_smarty_tpl->getVariable('content_only')->value){?>
		<div class="left right_content_outer">
			
<?php }?>
			<form method="post" action="auth.php" name="registerFrm" id="registerFrm" >
			<input type="hidden" name="SubmitRegister" value="1" />
			<input type="hidden" name="mid" value="<?php echo $_smarty_tpl->getVariable('mid')->value;?>
" />
			<input type="hidden" name="prev_page" value="<?php echo $_smarty_tpl->getVariable('prev_page')->value;?>
" />
			<input type="hidden" name="mod" value=<?php echo $_smarty_tpl->getVariable('mod')->value;?>
 />
            <br />
            <?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./common/errors.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<?php if ($_smarty_tpl->getVariable('editCompany')->value){?>
            <!-- company information part start -->
            <div class="font14">01. <?php echo smartyTranslate(array('s'=>'Company Information'),$_smarty_tpl);?>
</div>
            <div class=" com_info_box">
            	<?php if ($_smarty_tpl->getVariable('mod')->value!='hotel'&&$_smarty_tpl->getVariable('prev_page')->value!="hotellist"&&$_smarty_tpl->getVariable('cookie')->value->RoleID>2){?>
            	<div class="input_info">
                    <label><?php echo smartyTranslate(array('s'=>'Agent ID'),$_smarty_tpl);?>
</label>
                    <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>3){?>
                    	<input type="text" name="agentID" value="<?php echo $_smarty_tpl->getVariable('company')->value->AgentID;?>
"/>
                    <?php }else{ ?>
                    	<?php echo $_smarty_tpl->getVariable('company')->value->AgentID;?>
 &nbsp;
                    <?php }?>
                </div>
            	<?php }?>
            	<div class="input_info">
                    <label><?php echo smartyTranslate(array('s'=>'Company Name'),$_smarty_tpl);?>
</label>
                    <input type="text" name="companyName" value="<?php echo $_smarty_tpl->getVariable('company')->value->CompanyName;?>
"/>
                    <span class="red">*</span>
                </div>
                <div class="input_info">
                    <label><?php echo smartyTranslate(array('s'=>'Country'),$_smarty_tpl);?>
</label>
                    <select name="countryId" >
                        <?php  $_smarty_tpl->tpl_vars['name'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('countries')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['name']->key => $_smarty_tpl->tpl_vars['name']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['name']->key;
?>
                        	<option value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['k']->value,'htmlall','UTF-8');?>
" <?php if (($_smarty_tpl->getVariable('company')->value->CountryId==$_smarty_tpl->tpl_vars['k']->value)){?> selected="selected"<?php }elseif(($_smarty_tpl->getVariable('mod')->value=='hotel'&&$_smarty_tpl->tpl_vars['k']->value==109&&$_smarty_tpl->getVariable('company')->value->CountryId=='')){?> selected="selected"<?php }elseif(($_smarty_tpl->getVariable('prev_page')->value=="hotellist"&&$_smarty_tpl->getVariable('cookie')->value->RoleID>3&&$_smarty_tpl->tpl_vars['k']->value==109&&$_smarty_tpl->getVariable('company')->value->CountryId=='')){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
&nbsp;</option>
                        <?php }} ?>
                    </select>
                    <span class="red">*</span>
                </div>
                <div class="input_info">
                    <label><?php echo smartyTranslate(array('s'=>'City'),$_smarty_tpl);?>
</label>
                    <input type="text" name="city" value="<?php echo $_smarty_tpl->getVariable('company')->value->City;?>
"/>
                    <span class="red">*</span>
                    <span class="error"> </span>
                </div>
                <div class="input_info">
                    <label><?php echo smartyTranslate(array('s'=>'Address'),$_smarty_tpl);?>
</label>
                    <input type="text" name="address" value="<?php echo $_smarty_tpl->getVariable('company')->value->Address;?>
"/>
                </div>
                <div class="input_info">
                    <label><?php echo smartyTranslate(array('s'=>'Website'),$_smarty_tpl);?>
</label>
                    <input type="text" name="website" value="<?php echo $_smarty_tpl->getVariable('company')->value->Website;?>
" />
                    <span class="red">*</span>
                </div>
                <div class="input_info">
                    <label><?php echo smartyTranslate(array('s'=>'Managing Director'),$_smarty_tpl);?>
</label>
                    <input type="text" name="managingDirector" value="<?php echo $_smarty_tpl->getVariable('company')->value->ManagingDirector;?>
"/>
                    <span class="red">*</span>
                </div>
                <div class="input_info">
                    <label><?php echo smartyTranslate(array('s'=>"TEL"),$_smarty_tpl);?>
</label>
                    <input type="text" name="companyTel" value="<?php echo $_smarty_tpl->getVariable('company')->value->Tel;?>
"/>
                    <span class="red">*</span>
                </div>
                <div class="input_info">
                    <label><?php echo smartyTranslate(array('s'=>"FAX"),$_smarty_tpl);?>
</label>
                    <input type="text" name="companyFax" value="<?php echo $_smarty_tpl->getVariable('company')->value->Fax;?>
"/>
				<br/>
                    <label>&nbsp;</label><span class="red">
					<?php echo smartyTranslate(array('s'=>"Please input Fax number with Country code + Fax number."),$_smarty_tpl);?>
<br/>
                    <label>&nbsp;</label><?php echo smartyTranslate(array('s'=>"if your number start with \"0\" please take out \"0\". "),$_smarty_tpl);?>
<br/>
                    <label>&nbsp;</label><?php echo smartyTranslate(array('s'=>"eg: if your fax number is 03-1234-5678, please input 81312345678."),$_smarty_tpl);?>
<br/></span>
                </div>
                <div class="input_info" <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>=4&&Tools::is_Hotel($_smarty_tpl->getVariable('company')->value->CompanyId)){?>style=""<?php }else{ ?>style="display: none"<?php }?>>
                    <label><?php echo smartyTranslate(array('s'=>'ShouShu'),$_smarty_tpl);?>
</label>
                    <input type="text" name="ShouShu" value="<?php echo $_smarty_tpl->getVariable('company')->value->ShouShu;?>
"/>
                    <select name="ShouShuType" style="width: 55px;">
                        <option value="1" <?php if (($_smarty_tpl->getVariable('company')->value->ShouShuType==1)){?> selected="selected"<?php }?>>%</option>
                        <option value="2" <?php if (($_smarty_tpl->getVariable('company')->value->ShouShuType==2)){?> selected="selected"<?php }?>>￥</option>
                    </select>
                    <span class="red">*</span>
                </div>
<?php if ($_smarty_tpl->getVariable('editPayment')->value){?>
				<div class="input_info">
                    <label><?php echo smartyTranslate(array('s'=>'Payment'),$_smarty_tpl);?>
</label>
                    <select name="paymentMethod">
	                    <option value="0" <?php if (($_smarty_tpl->getVariable('company')->value->PaymentMethod==0)){?> selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'PrePay'),$_smarty_tpl);?>
&nbsp;</option>
	                    <option value="1" <?php if (($_smarty_tpl->getVariable('company')->value->PaymentMethod==1)){?> selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'AfterPay'),$_smarty_tpl);?>
&nbsp;</option>
                    </select>
                </div>
<?php }?>

            </div>
            <!-- company information part end -->
<?php }?>
            <br />
            <!-- your information part start -->
            <div class="font14">
            	<?php if ($_smarty_tpl->getVariable('editCompany')->value){?>02.<?php }?> 
            	<?php if ($_smarty_tpl->getVariable('myinfo')->value){?><?php echo smartyTranslate(array('s'=>'Your Information'),$_smarty_tpl);?>
<?php }elseif($_smarty_tpl->getVariable('mod')->value=='self'&&$_smarty_tpl->getVariable('cookie')->value->RoleID==3){?><?php echo smartyTranslate(array('s'=>'Admin User'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'User Information'),$_smarty_tpl);?>
<?php }?>
            </div>
            <div class="your_info_box" style="border-top:2px solid #999;width:400px;">
            	<div class="input_info">
                    <label><?php echo smartyTranslate(array('s'=>'Login ID'),$_smarty_tpl);?>
</label>
                    <?php if ($_smarty_tpl->getVariable('member')->value->UserID>0){?>
                    	 &nbsp;<?php echo $_smarty_tpl->getVariable('member')->value->LoginUserName;?>
 &nbsp;&nbsp;&nbsp;<span class="red">※<?php echo smartyTranslate(array('s'=>'Can not change'),$_smarty_tpl);?>
</span>
                    <?php }else{ ?>
	                    <input type="text" name="loginUserName" id="loginUserName" value="<?php echo $_smarty_tpl->getVariable('member')->value->LoginUserName;?>
"/>
	                    <span class="red">*</span>
                    <?php }?>
                </div>
                <div class="input_info">
                    <label><?php echo smartyTranslate(array('s'=>'Name'),$_smarty_tpl);?>
</label>
                    <input type="text" name="name" id="name" value="<?php echo $_smarty_tpl->getVariable('member')->value->Name;?>
"/>
                    <span class="red">*</span>
                </div>
                <div class="input_info">
                    <label><?php echo smartyTranslate(array('s'=>'Password'),$_smarty_tpl);?>
</label>
                    <input type="password" name="password" id="password" value="<?php echo $_smarty_tpl->getVariable('member')->value->Password;?>
" />
                    <span class="red">*</span>
                </div>
                <div class="input_info">
                    <label><?php echo smartyTranslate(array('s'=>'Re Enter Password'),$_smarty_tpl);?>
</label>
                    <input type="password" name="con_password" value="<?php echo $_smarty_tpl->getVariable('member')->value->Password;?>
"/>
                    <span class="red">*</span>
                </div>
                <div class="input_info">
                    <label><?php echo smartyTranslate(array('s'=>"E-mail"),$_smarty_tpl);?>
</label>
                    <input type="text" name="email" value="<?php echo $_smarty_tpl->getVariable('member')->value->Email;?>
" />
                    <span class="red">*</span>
                </div>
<?php if ($_smarty_tpl->getVariable('editLanguage')->value){?>                
                <div class="input_info">
                    <label><?php echo smartyTranslate(array('s'=>"TEL"),$_smarty_tpl);?>
</label>
                    <input type="text" name="tel" value="<?php echo $_smarty_tpl->getVariable('member')->value->Tel;?>
"/>
                    <span class="red">*</span>
                </div>
                <div class="input_info">
                    <label><?php echo smartyTranslate(array('s'=>'Language'),$_smarty_tpl);?>
</label>
                    <select name="languageId">
                        <?php  $_smarty_tpl->tpl_vars['lang_name'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('languages')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['lang_name']->key => $_smarty_tpl->tpl_vars['lang_name']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['lang_name']->key;
?>
	                    	<option value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['k']->value,'htmlall','UTF-8');?>
" <?php if (($_smarty_tpl->getVariable('member')->value->LanguageID==$_smarty_tpl->tpl_vars['k']->value)){?> selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>($_smarty_tpl->tpl_vars['lang_name']->value)),$_smarty_tpl);?>
&nbsp;</option>
	                    <?php }} ?>
                    </select>
                    <span class="red">*</span>
                </div>
<?php }?>
<?php if ($_smarty_tpl->getVariable('editHotel')->value){?>
				<div class="input_info">
                    <label><?php echo smartyTranslate(array('s'=>"HotelCode"),$_smarty_tpl);?>
</label>
                    <input type="text" name="HotelCode" value="<?php echo $_smarty_tpl->getVariable('member')->value->HotelCode;?>
"/>
                    <span class="red">*</span>
                </div>
<?php }?>
<?php if ($_smarty_tpl->getVariable('editRole')->value){?>
				<div class="input_info">
                    <label><?php echo smartyTranslate(array('s'=>'User Type'),$_smarty_tpl);?>
</label>
                    <select name="roleId">
                        <?php  $_smarty_tpl->tpl_vars['role_name'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('roleList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['role_name']->key => $_smarty_tpl->tpl_vars['role_name']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['role_name']->key;
?>
	                    	<option value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['k']->value,'htmlall','UTF-8');?>
" <?php if (($_smarty_tpl->getVariable('member')->value->RoleID==$_smarty_tpl->tpl_vars['k']->value)){?> selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>($_smarty_tpl->tpl_vars['role_name']->value)),$_smarty_tpl);?>
&nbsp;</option>
	                    <?php }} ?>
                    </select>
                    <span class="red">*</span>
                </div>
<?php }?>
<?php if ($_smarty_tpl->getVariable('editDelete')->value){?>
	 			<div class="input_info">
                    <label><?php echo smartyTranslate(array('s'=>'ID Use'),$_smarty_tpl);?>
</label>
                    <select name="isDelete">
	                    <option value="1" <?php if (($_smarty_tpl->getVariable('member')->value->IsDelete==1)){?> selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'n'),$_smarty_tpl);?>
&nbsp;</option>
	                    <option value="0" <?php if (($_smarty_tpl->getVariable('member')->value->IsDelete==0)){?> selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'y'),$_smarty_tpl);?>
&nbsp;</option>
                    </select>
                    <span class="red">*</span>
                </div>
<?php }?>
            </div>
<?php if ($_smarty_tpl->getVariable('content_only')->value){?>	
            <div style="margin-top:20px;padding-left:120px;">
            	<input type="checkbox" style="float:left; margin-top:5px;" id="agreeCheck" name="agreeCheck" <?php if (isset($_POST['agreeCheck'])&&$_POST['agreeCheck']=='1'){?>checked="checked"<?php }?>/>
            	<?php if ($_smarty_tpl->getVariable('sl_lang')->value!=4){?>
            	<label style="margin-left:10px;"><?php echo smartyTranslate(array('s'=>'I agree with'),$_smarty_tpl);?>
</label>
            	<a href="#" class="blue underline"><?php echo smartyTranslate(array('s'=>'Terms and Policies'),$_smarty_tpl);?>
</a>
            	<?php }else{ ?>
            	<a href="#" class="blue underline" style="margin-left:10px;"><?php echo smartyTranslate(array('s'=>'Terms and Policies'),$_smarty_tpl);?>
</a>
            	<label ><?php echo smartyTranslate(array('s'=>'I agree with'),$_smarty_tpl);?>
</label>
            	<?php }?>
            </div>
<?php }?>
            <!-- your information part end -->
            
            <div style="margin-top:20px;padding-left:120px;">
            	<div class="left register_apply"><input type="submit" class="button orange" value="<?php echo smartyTranslate(array('s'=>'Apply'),$_smarty_tpl);?>
"/></div>
                <div class="left register_cancel"><a href="<?php if ($_smarty_tpl->getVariable('prev_page')->value!=''){?><?php echo $_smarty_tpl->getVariable('prev_page')->value;?>
.php<?php }else{ ?>index.php<?php }?>"><input type="button" class="button white" value="<?php echo smartyTranslate(array('s'=>'Cancel'),$_smarty_tpl);?>
"/></a></div>
            </div>
            <div class="clearfix"></div>
            </form>
        </div>

        
<?php if (!$_smarty_tpl->getVariable('content_only')->value){?>  
    <div class="clearfix"></div>
<?php }?>
<?php if ($_smarty_tpl->getVariable('content_only')->value){?>
	</div>      	
    
</div>

</body>
<?php }?>

