            <!-- right content start -->
            <div class="left right_content_outer">
			  <form name="searchFrm" method="post" action="message.php">    
				<input type="hidden" id="p" name="p" value="{$p}" />
				<input type="hidden" id="n" name="n" value="{$n}" />
            
              {if $cookie->RoleID >= 4}           
            	<div class="search_bar">
                	{l s="Keyword"}
                    <input type="text" style="width:120px;" id="schKey" value="{$smarty.get.schKey}"/>
                    <input type="button" class="button orange medium" value="{l s='Search Now'}" onclick="location.href='/message.php?schKey='+$('#schKey').val();"  />
                </div> 	               
              {/if}
              </form> 
                <!-- booking list search result start -->
                <div><form id="wfs" name="wfs" method="post">
                	<table cellpadding="0" cellspacing="0" class="darkgray">
                    	<thead>
                        	<tr> 
                        	  {if $cookie->RoleID >= 4}       
                            	<th class="odd"></th>
                            	<th>{l s='Login ID'}</th>
                                <th class="odd">{l s='Name'}</th>
                                <th>{l s='User Type'}</th>
                                <th class="odd">{l s='Title'}</th>
                                <th>{l s='Last Update'}</th>
                              {else}
                              	<th class="odd" width="5%">{l s='No'}</th>
                              	<th width="15%">{l s='Time'}</th>
                              	<th class="odd">{l s='Title'}</th>
                              {/if}
                            </tr>
                        </thead>
                    	<tbody>
                    	  {foreach from=$list item=item name=item}
                        	<tr id="tr_{$item.MsgId}">
                        	  {if $cookie->RoleID >= 4}
                            	<td class="odd" {if $item.isRead ==0}style="background-color:#cdcdcd"{/if}><input type="checkbox" class="check" value="{$item.MsgId}" name="idlist[]"/></td>
                                <td {if $item.isRead ==0}style="background-color:#cdcdcd"{/if}>{$item.LoginUserName}</td>
                                <td class="odd" {if $item.isRead ==0}style="background-color:#cdcdcd"{/if}>{$item.Name}</td>
                                <td {if $item.isRead ==0}style="background-color:#cdcdcd"{/if}>{$item.RoleName}</td>
                                <td class="odd" {if $item.isRead ==0}style="background-color:#cdcdcd"{/if} ><a href="#" id="{$item.MsgId}" onclick="msgEdit({$item.MsgId}, '{$item.Title}'); return false;">{if $item.isRead == 0}<strong>{$item.Title}</strong>{else}{$item.Title}{/if}</a></td>
                                <td {if $item.isRead ==0}style="background-color:#cdcdcd"{/if}>{$item.lastDate|date_format:"%Y-%m-%d"}</td>
                              {else}
                                <td class="odd" {if $item.isRead ==0}style="background-color:#cdcdcd"{/if}>{($p-1)*$n+$smarty.foreach.item.index+1}</td>
                                <td {if $item.isRead ==0}style="background-color:#cdcdcd"{/if}>{$item.lastDate|date_format:"%Y-%m-%d"}</td>
                                <td class="odd" {if $item.isRead ==0}style="background-color:#cdcdcd"{/if}><a href="#" id="{$item.MsgId}" onclick="msgEdit({$item.MsgId}, '{$item.Title}'); return false;">{if $item.isRead == 0}<strong>{$item.Title}</strong>{else}{$item.Title}{/if}</a></td>
                              {/if}  
                            </tr>
                          {/foreach}                            
                        </tbody>
                    </table>
                </form></div>
                <!-- booking list search result end -->
                
                <!-- page control start -->
                {include file="$tpl_dir./common/pagination.tpl"}
                <div class="clearfix"></div>
                <!-- page control end -->
                
                <div class="control_bar">
                  {if $cookie->RoleID < 4}
                	<input type="button" class="button orange medium" value="{l s='Message To Admin'}" onclick="openPopup('msgNewDiv');"/>
                  {else}
                	<!-- <input type="button" class="button orange" value="詳細"/> -->
                    <input type="button" class="button white medium" value="{l s='Delete'}" id="btnDelete"/>
                  {/if}
                    
                </div>
            </div>
            <!-- right content end -->
            <div class="clearfix"></div>
            
	<script>
		function msgEdit(msgId, msgTitle){
			{if $cookie->UserID !=$item.UserId}
				$("#tr_"+msgId).children().css('background-color', '');
				$("#"+msgId).html(msgTitle);
			{/if}
			ajaxLoad("msgEditDiv", "message.php?ajaxType=edit&msgId="+msgId, "openPopup('msgEditDiv');");
		}
		 // Delete
		 $("#btnDelete").click(function(){
			// No Selected
			if($(".check:checked").length == 0){
				alert("{l s='Please select any Notice'}");
				 return false;
			}
			if(confirm("{l s='Are you confirm to delete?'}")){
				setWait();
				$.ajax({
					type : "post",
					datatype : "text",
					data : $("#wfs").serialize(),
					url : "{$base_dir}message.php?delete",
					success : function(data, code){
						unsetWait();
						searchFrm.submit();
					}
				}); 
			} 
		 });
		function onMsgSubmit() {

			if ($('#title').val() == "") {
				alert("{l s='Please input title'}");
				return false;
			}
			if ($('#cont').val() == "") {
				alert("{l s='Please input content'}");
				return false;
			}
			document.msgNewFrm.submit();
		}
	</script>
	
	
	<form name="msgEditFrm" method="post" action="{$request_uri}" >
		<input type="hidden" name="SubmitMsg" value="1" />
		<div class="popup_win_frame" style="display:none;" id="msgEditDiv">
			
			
		</div>
	</form>		

	<!--popup_win start -->
	<div class="popup_win_frame" style="display:none;" id="msgNewDiv">
	<div class="popup_win_view"><form name="msgNewFrm" method="post" action="{$request_uri}" >
		<input type="hidden" name ="MsgId" value="0" />
		<input type="hidden" name ="SubmitMsg" value="1" />
				
		<div class="title"><div class="close_btn" onclick="closePopup('msgNewDiv');"></div>{l s='Message To Admin'}</div>
		<div class="edit_view">
		<table class="yellow">
	        <tr>
	        	<th>{l s='Title'}</th>
	            <td><input type="text" name="Title" id="title" style="width:80%;" /></td>
	        </tr>
	        <tr>
	        	<th style="vertical-align:top">{l s='Content'}</th>
	            <td><textarea style="width:100%;height:100px;" name="Cont" id="cont"></textarea></td>
	        </tr>
	    </table>
	    </div>
	    <div class="popup_control_bar">
	    	<input type="button" class="button orange medium" value="{l s='Send'}" onclick="onMsgSubmit(); return false;"/>
	        <input type="button" class="button white medium" value="{l s='Close'}" onclick="closePopup('msgNewDiv');"/>
	    </div>
	    
	</form></div>
	</div>
	<!--popup_win end --> 