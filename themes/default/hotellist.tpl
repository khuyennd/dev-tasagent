            <!-- right content start -->
            <div class="left right_content_outer"> 
            	<!-- booking list search conditon start -->
            	<form name="searchFrm" method="post" action="hotellist.php">    
				<input type="hidden" id="p" name="p" value="{$p}" />
				<input type="hidden" id="n" name="n" value="{$n}" />
                <div class="bklist_srch_con">
                	<table cellpadding="0" cellspacing="0">
                    	<tbody>
                        	<tr>
                                <td class="bklist_srch_td">{l s='Hotel Name'}</td>
                                <td><input type="text" name="HotelName" value="{if isset($smarty.post.CompanyName)}{$smarty.post.CompanyName}{/if}"/></td>
                                <td class="bklist_srch_td">{l s='User ID'}</td>
                                <td><input type="text" name="LoginUserName" value="{if isset($smarty.post.LoginUserName)}{$smarty.post.LoginUserName}{/if}" /></td>
                            </tr>
                            <tr>
                            	<td class="bklist_srch_td">{l s='Email'}</td>
                                <td>
                                	<input type="text" name="Email" value="{if isset($smarty.post.Email)}{$smarty.post.Email}{/if}"/>
                                </td>
                                <td class="bklist_srch_td">{l s='Name'}</td>
                                <td>
                                	<input type="text" name="Name" value="{if isset($smarty.post.Name)}{$smarty.post.Name}{/if}"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="bklist_srch_btn">
                    <input type="button"  class="button orange medium" value="{l s='Search Now'}" onclick="searchFrm.submit(); return false;" />
                </div>
                </form>
                <div class="clearfix"></div>
                <!-- booking list search conditon end -->
                   
                <!-- booking list search result start -->
                <div class="">
                	<form id="wfs" name="wfs" method="post">
                	<table class="darkgray">
                    	<thead>
                        	<tr>
                        		<th class="odd"></th> 
				<th>{l s='Company Name'}</th>
                            	<th class="odd">{l s='Hotel Name'}</th>
                                <th >{l s='User ID'}</th>
                                <th class="odd">{l s='Name'}</th>
                                <th >{l s='Email'}</th>
                                <th class="odd">{l s='Status'}</th>
                                <th ></th>
                            </tr>
                        </thead>
                    	<tbody>
                    	{foreach from=$listData item=item name=item}
                        	<tr>
                        		<td class="odd{if $item.IsDelete}_delete{/if}"><input type="checkbox" class="check" value="{$item.UserID}" name="idlist[]"/></td>
                                <td class="{if $item.IsDelete}_delete{/if}">{$item.CompanyName}</td>
				<td class="odd{if $item.IsDelete}_delete{/if}"><a href="hotelpage.php?mid={$item.HotelId}">{$item.HotelName}</a></td>
                                <td class="{if $item.IsDelete}_delete{/if}">{$item.LoginUserName}</td>
                                <td class="odd{if $item.IsDelete}_delete{/if}">{$item.Name}</td>
                                <td class="{if $item.IsDelete}_delete{/if}">{$item.Email}</td>
                                <td class="odd{if $item.IsDelete}_delete{/if}">{if $item.IsActive==0}{l s='Pending'}{else}_{/if}
                                </td>
                                <td class="{if $item.IsDelete}_delete{/if}" style="text-align:center">
                                	<input type="button" value="{l s='Edit'}" onclick="location.href='auth.php?mid={$item.UserID}&prev_page=hotellist'" class="button white small" style="margin:3px;"/>
                                	{if $cookie->RoleID > 3}<input type="button" value="{l s='Msg'}"
                                		onclick="sendMsg({$item.UserID}, {$item.CompanyID}, '{$item.LoginUserName}', '{$item.Name}');"  class="button white small"/>{/if}
                                	<input type="hidden" id="delete_{$item.UserID}" value="{$item.IsDelete}" />
                                	<input type="hidden" id="active_{$item.UserID}" value="{$item.IsActive}" />
                                </td>
                            </tr>
                        {/foreach}
                        {if $nb_products==0} 
                        	<tr><td colspan="7" style="text-align: center">{l s='There is no data'}</td></tr> 
                       	{/if}
                        </tbody>
                    </table>
                    </form>
                </div>
                <!-- booking list search result end -->
                
                <!-- page control start -->
                {include file="$tpl_dir./common/pagination.tpl"}
                <div class="clearfix"></div>
                <!-- page control end -->
                
                <div>
                <div class="btns_bar">	
                	<input type="button" value="{l s='Verify'}" id="btnVerify" class="button orange medium" />
                	<input type="button" value="{l s='New'}" onclick="location.href='auth.php?prev_page=hotellist'"  class="button orange medium"/>
                	<input type="button" value="{l s='Delete'}" id="btnDelete" class="button white medium"/>
                	<input type="button" value="{l s='Undo Delete'}" id="btnUnDelete" class="button orange medium"/>
                	<input type="button" value="{l s='Delete Permanent'}" id="btnDeleteP" class="button white medium"/>                    
                </div>
                </div>
                
                <br /><br />
            </div>
            <!-- right content end -->
            <div class="clearfix"></div>
            
	<!--popup_win start -->
	<div class="popup_win_frame" style="display:none;" id="msgNewDiv">
	<div class="popup_win_view"><form name="msgNewFrm" method="post" action="{$request_uri}" >
		<input type="hidden" name ="MsgId" value="0" />
		<input type="hidden" name ="SubmitMsg" value="1" />
		<input type="hidden" id ="UserId" name ="UserId" value="0" />
		<input type="hidden" id ="CompanyId" name ="CompanyId" value="0" />
				
		<div class="title"><div class="close_btn" onclick="closePopup('msgNewDiv');"></div>{l s='Send Notice'}</div>
		<div class="edit_view">
		<table class="yellow">
	    	
	        <tr>    
	            <th>{l s='User ID'}</th>
	            <td id="UserLoginId"></td>            
	        </tr>
		<tr>
	        	<th>{l s='Name'}</th>
	            <td id="Name"></td>
	        </tr>
	        <tr>
	        	<th>{l s='Title'}</th>
	            <td><input type="text" name="Title" style="width:80%;" req msg="{l s='Please input Title'}" /></td>
	        </tr>
	        <tr>
	        	<th style="vertical-align:top">{l s='Content'}</th>
	            <td><textarea style="width:100%;height:100px;" name="Cont" req msg="{l s='Please input Content'}"></textarea></td>
	        </tr>
	    </table>
	    </div>
	    <div class="popup_control_bar">
	    	<input type="button" class="button orange medium" value="{l s='Send'}" onclick="if(!getFormData(document.msgNewFrm)) return false; 
		    	document.msgNewFrm.submit();"/>
	        <input type="button" class="button white medium" value="{l s='Close'}" onclick="closePopup('msgNewDiv');"/>
	    </div>
	    
	</form></div>
	</div>
	<!--popup_win end -->
	
	            
            
            
            
 <script type="text/javascript">
	function sendMsg(uId, cId, uLogin, cName){
		$("#UserId").val(uId);				$("#CompanyId").val(cId);
		$("#UserLoginId").html(uLogin);		$("#Name").html(cName);	
		openPopup('msgNewDiv');
	}


$(function(){
	 // Verify 
	 $("#btnVerify").click(function(){
		// No Selected
		if($(".check:checked").length == 0) return false;
		var isRun = true;
		$(".check:checked").each(function() {
			if ($('#active_'+$(this).val()).val() == 1) {
				isRun = false;
			}
		});
		if(isRun && confirm("{l s='Are you confirm to verify?'}")){
			setWait();
			$.ajax({
				type : "post",
				datatype : "text",
				data : $("#wfs").serialize(),
				url : "{$base_dir}hotellist.php?verify",
				success : function(data, code){
					unsetWait();
					searchFrm.submit();
				}
			}); 
		} 
	 });

	 // Delete
	 $("#btnDelete").click(function(){
		// No Selected
		if($(".check:checked").length == 0) return false;
		var isRun = true;
		$(".check:checked").each(function() {
			if ($('#delete_'+$(this).val()).val() == 1) {
				isRun = false;
			}
		});
		if(isRun && confirm("{l s='Are you confirm to delete?'}")){
			setWait();
			$.ajax({
				type : "post",
				datatype : "text",
				data : $("#wfs").serialize(),
				url : "{$base_dir}hotellist.php?delete",
				success : function(data, code){
					unsetWait();
					searchFrm.submit();
				}
			}); 
		} 
	 });

	// Delete Permanent
	 $("#btnDeleteP").click(function(){
		// No Selected
		if($(".check:checked").length == 0) return false;
		if(confirm("{l s='Are you confirm to delete permanently?'}")){
			setWait();
			$.ajax({
				type : "post",
				datatype : "text",
				data : $("#wfs").serialize(),
				url : "{$base_dir}hotellist.php?del_permanent",
				success : function(data, code){
					unsetWait();
					searchFrm.submit();
				}
			}); 
		} 
	 });

	// UnDelete 
	 $("#btnUnDelete").click(function(){
		// No Selected
		if($(".check:checked").length == 0) return false;
		var isRun = true;
		$(".check:checked").each(function() {
			if ($('#delete_'+$(this).val()).val() == 0) {
				isRun = false;
			}
		});
		if(isRun && confirm("{l s='Are you confirm to undo deleting?'}")){
			setWait();
			$.ajax({
				type : "post",
				datatype : "text",
				data : $("#wfs").serialize(),
				url : "{$base_dir}hotellist.php?undel",
				success : function(data, code){
					unsetWait();
					searchFrm.submit();
				}
			}); 
		} 
	 });
 });
 </script>