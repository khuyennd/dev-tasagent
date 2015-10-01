            <!-- right content start -->
            <div class="left right_content_outer">
            	<!-- booking list search conditon start -->
            	<form name="searchFrm" method="post" action="adminlist.php">    
				<input type="hidden" id="p" name="p" value="{$p}" />
				<input type="hidden" id="n" name="n" value="{$n}" />
                <div class="bklist_srch_con">
                	<table cellpadding="0" cellspacing="0">
                    	<tbody>
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
                    <input type="button"  class="button orange medium" alt="search now" value="{l s='Search Now'}" onclick="searchFrm.submit(); return false;" />
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
                                <th>{l s='Admin ID'}</th>
                                <th class="odd">{l s='Name'}</th>
                                <th>{l s='Email'}</th>
                                <th class="odd">{l s='User Type'}</th>
                                <th>{l s='Record Date'}</th>
                                <th class="odd"></th>
                            </tr>
                        </thead>
                    	<tbody>
                    	{foreach from=$listData item=item name=item}
                        	<tr>
                        		<td class="odd{if $item.IsDelete}_delete{/if}"><input type="checkbox" class="check" value="{$item.UserID}" name="idlist[]"/></td>
                                <td class="{if $item.IsDelete}_delete{/if}">{$item.LoginUserName}</td>
                                <td class="odd{if $item.IsDelete}_delete{/if}">{$item.Name}</td>
                                <td class="{if $item.IsDelete}_delete{/if}">{$item.Email}</td>
                                <td class="odd{if $item.IsDelete}_delete{/if}">{if $item.RoleID == 5}{l s='Super Admin'}{else}{l s='Admin'}{/if}</td>
                                <td class="{if $item.IsDelete}_delete{/if}">{$item.CreateDate}</td>
                                <td class="odd{if $item.IsDelete}_delete{/if}" style="text-align:center">
                                	<input type="button" value="{l s='Edit'}" onclick="location.href='auth.php?mid={$item.UserID}&prev_page=adminlist'" class="button white small"/>
                                	<input type="hidden" id="delete_{$item.UserID}" value="{$item.IsDelete}" />
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
                	<input type="button" value="{l s='New'}" onclick="location.href='auth.php?prev_page=adminlist'" class="button orange medium"/>
                	{if $cookie->RoleID > 3}<input type="button" value="{l s='Delete'}" id="btnDelete" class="button white medium" />
                	<input type="button" value="{l s='Undo Delete'}" id="btnUnDelete" class="button orange medium" />
                	<input type="button" value="{l s='Delete Permanent'}" id="btnDeleteP" class="button white medium"/>{/if}
                </div>
                </div>
            </div>
            <!-- right content end -->
            <div class="clearfix"></div>
 <script type="text/javascript">
 $(function(){

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
				url : "{$base_dir}adminlist.php?delete",
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
				url : "{$base_dir}adminlist.php?del_permanent",
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
				url : "{$base_dir}adminlist.php?undel",
				success : function(data, code){
					unsetWait();
					searchFrm.submit();
				}
			}); 
		} 
	 });
 });
 </script>