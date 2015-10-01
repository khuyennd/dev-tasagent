<div class="popup_win_view">
	<input type="hidden" name="MsgId" value="{$list[0].MsgId}" />
	<div class="title"><div class="close_btn" onclick="closePopup('msgEditDiv');"></div> </div>
	
	<div class="edit_view">
    	<div class="edit_title"><input type="text" value="{$info.Title}" readonly class="input_title"/></div>
        <div class="content">
          {foreach from=$list item=item name=item}
        	<div class="memo_list_item">
                {$item.Cont}
                <div class="" style="margin-top:10px;padding:0px;">
                <span class="darkgray">
                	{if $cookie->RoleID < 4 && $item.RoleID >=4} Admin {else} {$item.LoginUserName} {/if} 
                </span>&nbsp;
                <span class="red">{$item.regDate|date_format:"%Y-%m-%d"}</span>
                </div>	            
            </div>
          {/foreach}   
            
            <textarea name="Cont" req msg="{l s='Please input Content'}" 
            	style="width:100%;height:200px;border:1px solid #ccc;"></textarea>  
        </div>	
    </div>
    <div class="popup_control_bar">
    	<input type="button" class="button orange medium" value="{l s='Send'}" onclick="if(!getFormData(document.msgEditFrm)) return false; 
        		document.msgEditFrm.submit();"/>
        <input type="button" class="button white medium" value="{l s='Close'}" onclick="closePopup('msgEditDiv');"/>
    </div>    
</div>