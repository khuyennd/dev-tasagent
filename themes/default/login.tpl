<body>
<div class="content_outer" style="padding-bottom:50px;">

    <div class="login_form_box">
    <form method="post" action="login.php" name="loginFrm" id="loginFrm">
    	<input type="hidden" name="SubmitLogin" value="1" />
		<input type="hidden" name="back" value="{$back}" />

        <div class="left login_logo">
        	<img src="{$img_dir}logo.jpg" width="263px" alt="" />
            <p style="margin-top:10px;width:420px;">{l s='TAS Agent is online booking system to connect agents and Hotel in Japan'}</p>
        </div>
        <div class="left" style="padding-left:50px;">
            <div class="login_form_outer">
                <div class="right" >
                    <select name="languageId" onChange="changeLanguage(); return false;" id="languageId">
                        <option value="0">{l s='Language'}</option>
						{foreach from=$languages key=k item=lang_name}
                            <option value="{$k|escape:'htmlall':'UTF-8'}" style="width:130px;" {if ($sl_lang == $k)} selected="selected" {/if}>{l s=$lang_name}&nbsp;</option>
                        {/foreach}
                    </select>
                </div>
                <div class="clearfix"></div>
                
                <div class="userid" style="margin-top:15px;">
                    <span style="width:60px;display:-moz-inline-box;display:inline-block;">{l s='Login ID'}</span>
                    <input type="text" name="username" id="username" value="" tabindex="2"  class="userid_input" style="width:200px;"/>
                    
                </div>
                <div class="clearfix"></div>
                <div class="psw">
                    <span style="width:60px;display:-moz-inline-box;display:inline-block;">{l s='Password'}</span>
                    <input type="password" name="passwd" id="passwd" value="" style="display:none;width:200px;" class="userid_input"/>
                    <input type="text" id="passwdf" value="" class="userid_input" tabindex="2" style="width:200px;"/>
                </div>             
                {include file="$tpl_dir./common/errors_login.tpl"}
            </div>
            <div style="margin-top:5px;">
            	<div class="left" style="margin-right:20px;">
	            	<input type="submit" class="button orange medium" value="{l s='Login'}" style="margin-right:20px;" />                    
                </div>
                <div class="left">
                <input type="checkbox" id="chk_remember" name="remember" value="1" /><label for="chk_remember" style="padding-left:10px;">{l s='Keep me logged in'}</label><br/>
                <a href="{$base_dir}forgotpassword.php" class="blue underline">{l s='Forgot your password?'}</a>
				</div>
                <div class="clearfix"></div>
                <div style="margin-top:30px;">
                	<p style="margin-bottom:5px;"><a href="{$base_dir}auth.php?mod=agent" class="blue" >►{l s='Sign up for travel agent'}</a></p>
                	<a href="{$base_dir}auth.php?mod=hotel" class="blue" >►{l s='Sign up for hotel in Japan'}</a>
                </div>
            </div>
            </div>
    </form>
    </div>
    </div>
     
    <script>
    <!--
    	$(document).ready(function(){
    		//$("#username").focus();
    	});
		function changeLanguage() {
			location.href="login.php?clang&languageId=" + $('#languageId').val();
			return false;
		}
    //-->
    </script>
</body>