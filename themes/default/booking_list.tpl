            <!-- right content start -->
            <div class="left right_content_outer">
            	<!-- booking list search conditon start -->
            	<form name="searchFrm" method="post" action="booking_list.php">    
				<input type="hidden" id="p" name="p" value="{$p}" />
				<input type="hidden" id="n" name="n" value="{$n}" />
				<input type="hidden" name="settle" value="{$settle}" />
                <div class="bklist_srch_con">
                	<table cellpadding="0" cellspacing="0">
                    	<tbody>
                    	
                        	<tr>
                                <td class="bklist_srch_td">{l s='Booking Number'}</td>
                                <td><input type="text" name="BookingNo" id="BookingNo" value="{if isset($smarty.post.BookingNo)}{$smarty.post.BookingNo}{/if}"/></td>
                                {if $cookie->RoleID != 1}
                                <td class="bklist_srch_td">{l s='Hotel Name'}</td>
                                <td>
                                	<input type="text" name="HotelName" id="HotelName" value="{if isset($smarty.post.HotelName)}{$smarty.post.HotelName}{/if}" />
                                	&nbsp;&nbsp;<input type="button" class="button white small" alt="reset" value="{l s='Reset'}" onclick="return onBookingReset();" style="width:80px;margin-left:10px;" />
                                </td>
                                {/if}
                            </tr>
                            {if $cookie->RoleID != 1}
                            <tr>
                            	<td class="bklist_srch_td">{l s='Check In Date'}</td>
                                <td>
                                	<input type="text" id="CheckInDate" name="CheckInDate" style="float:left;" value="{if isset($smarty.post.CheckInDate)}{$smarty.post.CheckInDate}{/if}" readonly/>
                                	<img class="calendar_icon" width="13" onclick="if(self.gfPop)gfPop.fPopCalendar(getById('CheckInDate'));" alt="" src="{$img_dir}calendar_icon.jpg">
                                </td>
                                {if $cookie->RoleID == 1}
                                <td class="bklist_srch_td">{l s='Check Out Date'}</td>
                                <td>
                                	<input type="text" name="CheckOutDate" id="CheckOutDate" style="float:left;" value="{if isset($smarty.post.CheckOutDate)}{$smarty.post.CheckOutDate}{/if}" readonly/>
                                	<img class="calendar_icon" width="13" onclick="if(self.gfPop)gfPop.fPopCalendar(getById('CheckOutDate'));" alt="" src="{$img_dir}calendar_icon.jpg">
                                </td>
                                {else}
                                <td class="bklist_srch_td">{l s='Due Date'}</td>
                                <td>
                                	<input type="text" name="DueDate" id="DueDate" style="float:left;" value="{if isset($smarty.post.DueDate)}{$smarty.post.DueDate}{/if}" readonly/>
                                	<img class="calendar_icon" width="13" onclick="if(self.gfPop)gfPop.fPopCalendar(getById('DueDate'));" alt="" src="{$img_dir}calendar_icon.jpg">
                                </td>
                                {/if}
                            </tr>
                            {/if}
                            {if $cookie->RoleID > 3}
                            <tr>
                            	<td class="bklist_srch_td">{l s='Managing Director'}</td>
                                <td>
                                	<input type="text" name="ManagingDirector" id="ManagingDirector" value="{if isset($smarty.post.ManagingDirector)}{$smarty.post.ManagingDirector}{/if}"/>
                                </td>
                                <td class="bklist_srch_td">{l s='Company Name'}</td>
                                <td>
                                	<input type="text" name="CompanyName" id="CompanyName" value="{if isset($smarty.post.CompanyName)}{$smarty.post.CompanyName}{/if}"/>
                                </td>
                            </tr>
                            {/if}
                            <tr>
								<td class="bklist_srch_td">{l s='Booking Status'}</td>
                                <td>
                                	<select name="OrderStatusId" id="OrderStatusId">
                                		<option value="">{l s='All'}</option>
                                		{foreach $statusList key=k item=status_item}
										    {if $cookie->RoleID != 1}
											{if $k != 6 && $k != 1 && $k != 10}
                                			<option value="{$k}" {if $smarty.post.OrderStatusId == $k}selected{/if}>{l s=$status_item}</option>
											{/if}
											{else}
											{if $k != 6 && $k != 1 && $k != 10 && $k != 4 && $k != 6 && $k != 8 && $k != 9}
                                			<option value="{$k}" {if $smarty.post.OrderStatusId == $k}selected{/if}>{l s=$status_item}</option>
											{/if}
											{/if}
                                		{/foreach}
                                	</select>
                                </td>
                               {if $cookie->RoleID != 1}
                                <td class="bklist_srch_td">{l s='Payment Status'}</td>
                                <td>
                                	<select name="PayStatus" id="PayStatus">
                                		<option value="">{l s='All'}</option>
                                		<option value="1" {if $smarty.post.PayStatus == 1}selected{/if}>{l s='Not Paid'}</option>
                                		<option value="2" {if $smarty.post.PayStatus == 2}selected{/if}>{l s='Paid'}</option>
                                	</select>
                                </td>

				     	</tr>
                               <tr>
                                   <td class="bklist_srch_td">{l s='Booking Time'}</td>
                                   <td colspan="3">
                                       <input type="text" id="OrderStartDate" name="OrderStartDate" style="float:left;"
                                              value="{$orderStartDate}" readonly/>
                                       <img class="calendar_icon" width="13"
                                            onclick="if(self.gfPop)gfPop.fPopCalendar(getById('OrderStartDate'));"
                                            alt="" src="{$img_dir}calendar_icon.jpg">
                                       <span style="float:left">&nbsp;~&nbsp;</span>
                                       <input type="text" id="OrderEndDate" name="OrderEndDate" style="float:left;"
                                              value="{$orderEndDate}" readonly/>
                                       <img class="calendar_icon" width="13"
                                            onclick="if(self.gfPop)gfPop.fPopCalendar(getById('OrderEndDate'));" alt=""
                                            src="{$img_dir}calendar_icon.jpg">
                                   </td>
                               {/if}
                            </tr>
                            {if $cookie->RoleID == 1}
                            <tr>
                                <td class="bklist_srch_td">{l s='Check-IN'}</td>
                                <td colspan="3">
                                    <input type="text" id="CheckInDateFrom" name="CheckInDateFrom" style="float:left;"
                                           value="{$CheckInDateFrom}" readonly/>
                                    <img class="calendar_icon" width="13"
                                         onclick="if(self.gfPop)gfPop.fPopCalendar(getById('CheckInDateFrom'));" alt=""
                                         src="{$img_dir}calendar_icon.jpg">
                                    <span style="float:left">&nbsp;~&nbsp;</span>
                                    <input type="text" id="CheckInDateTo" name="CheckInDateTo" style="float:left;"
                                           value="{$CheckInDateTo}" readonly/>
                                    <img class="calendar_icon" width="13"
                                         onclick="if(self.gfPop)gfPop.fPopCalendar(getById('CheckInDateTo'));" alt=""
                                         src="{$img_dir}calendar_icon.jpg">
                                </td>
                            </tr>
                            {/if}

                        </tbody>
                    </table>
                </div>
                
                <div class="right" style="margin-top:5px;">
                    <input type="button" value="{l s='Search Now'}" class="button orange medium" onclick="searchFrm.submit(); return false;" />
                </div>
                </form>
                <div class="clearfix"></div>
                
                <!-- booking list search conditon end -->
                   
                <!-- booking list search result start -->
                <div>
                	<form id="wfs" name="wfs" method="post">
                	<table  class="orange">
                    	<thead>
                        	<tr>
                            	{if $cookie->RoleID>3}
                            	<th width="10%" class="odd">{l s='Agent ID'}</th>
                            	<th width="10%">{l s='Company Name'}</th>
                                <th width="10%" class="odd">{l s='Managing Director'}</th>
                                {/if}
                                <th width="10%">{l s='Booking NO'}</th>
                                {if $cookie->RoleID>1}
                                <th width="10%" class="odd">{l s='Hotel Name'}</th>
                                {/if}
                                <th width="7%" class="{if $cookie->RoleID==1}odd{/if}">{l s='Check-IN'}</th>
                                {if $cookie->RoleID ==1}
                                	<th class="" width="7%">{l s='Check-Out'}</th>
                                {else}
                                	<th width="7%" class="odd">{l s='Payment Due'}</th>
                                {/if}
                                
                                {if $cookie->RoleID!=1}<th width="7%" >{l s='Total Price'}</th>{/if}
                                <th class="odd" width="7%">{l s='Booking Status'}</th>
                                {if $cookie->RoleID!=1}<th width="7%">{l s='Payment Status'}</th>{/if}
                                <th {if $cookie->RoleID!=1}class="odd"{/if} width="6%"></th>
                            </tr>
                        </thead>
                    	<tbody>
                    	{foreach from=$listData item=item name=item}
                        	<tr>
                                {if $cookie->RoleID>3}
                                <td class="odd">{$item.AgentID}</td>
                                <td class="">{$item.CompanyName}</td>
                                <td class="odd">{$item.ManagingDirector}</td>
                                {/if}
                                <td class="">{$item.BookingNo}</td>
                                {if $cookie->RoleID>1}
                                <td class="odd">{$item.HotelName}</td>
                                {/if}
                              	<td class="{if $cookie->RoleID==1}odd{/if}">{$item.CheckInDate}
                              	{if $cookie->RoleID ==1}	
                               		<td class="">{$item.CheckOutDate}</td>
                               	{else}
                               		<td class="odd">{$item.DueDate}</td>
                               	{/if}	
                                {if $cookie->RoleID!=1}<td >{displayPrice s=$item.TotalPrice}</td>{/if}
                                {if $cookie->RoleID>0}
                                <td class="odd"> 
                                	{if $item.OrderStatusId != 5 and $item.OrderStatusId != 7}
	                                	{if $cookie->RoleID > 3 or $cookie->RoleID == 1}
										    <!-- Admin user start -->
										    {if $cookie->RoleID > 3}
	                                		{if $item.isCancell == 1}
			                                	<select onchange="change_status({$item.OrderId}, {$item.OrderStatusId}, this)" style="width:80px;">
				                                	<option  value="{$item.OrderStatusId}">{l s=$statusList[$item.OrderStatusId]}</option>
				                                	{if $item.OrderStatusId == 2 or $item.OrderStatusId == 3 or $item.OrderStatusId == 6 or $item.OrderStatusId==8}  
				                                		{if $item.OrderStatusId == 2 or $item.OrderStatusId == 6}
				                                			<option value="3">{l s=$statusList[3]}</option>
				                                			<option value="5">{l s=$statusList[5]}</option>
				                                		{else}
				                                			<option value="9">{l s=$statusList[9]}</option>
				                                		{/if}
				                                	{/if}
				                        			<option value="7">{l s=$statusList[7]}</option>
				                            	</select>
			                            	{else}
			                            		{if $item.OrderStatusId == 2 or $item.OrderStatusId == 3 or $item.OrderStatusId == 6 or $item.OrderStatusId==8}
			                            		<select onchange="change_status({$item.OrderId}, {$item.OrderStatusId}, this)" style="width:80px;">
				                                	<option  value="{$item.OrderStatusId}">{l s=$statusList[$item.OrderStatusId]}</option>
			                                		{if $item.OrderStatusId == 2 or $item.OrderStatusId == 6}
			                                			<option value="3">{l s=$statusList[3]}</option>
			                                			<option value="5">{l s=$statusList[5]}</option>
			                                		{else}
			                                			<option value="9">{l s=$statusList[9]}</option>
			                                		{/if}
				                            	</select>	
				                            	{else}
				                            		{l s=$statusList[$item.OrderStatusId]}
				                            	{/if}
			                            	{/if}	
											{else}
											 <!-- Hotel user start -->
											 <!-- Hotel user can only change status equal 2(confirming) -->
											    {if $item.OrderStatusId == 2}
			                                	<select onchange="change_status({$item.OrderId}, {$item.OrderStatusId}, this)" style="width:80px;">
				                                	<option  value="{$item.OrderStatusId}">{l s=$statusList[$item.OrderStatusId]}</option>
				                                	<option value="3">{l s=$statusList[3]}</option>
				                                	<option value="5">{l s=$statusList[5]}</option>
				                            	</select>
												{else}
												    {l s=$statusList[3]}
                                                {/if}
											{/if}
		                            	{else}
		                            		{if $item.isCancell == 1}
		                            			<select onchange="change_status({$item.OrderId}, {$item.OrderStatusId}, this)" style="width:80px;">
													{if $item.OrderStatusId == 10}
														<option  value="{$item.OrderStatusId}">{l s='Succeeded'}</option>
													{else}
														<option  value="{$item.OrderStatusId}">{l s=$statusList[$item.OrderStatusId]}</option>
													{/if}
		                                			<option value="7">{l s=$statusList[7]}</option>
		                                		</select>
		                            		{else}
												{if $item.OrderStatusId == 10}
													{l s='Succeeded'}
												{else}
													{l s=$statusList[$item.OrderStatusId]}
												{/if}
		                            		{/if}
		                            	{/if}
	                            	{else}
	              						{l s=$statusList[$item.OrderStatusId]}
	                            	{/if}
                                </td>
                                {/if}
                                {if $cookie->RoleID != 1}
                                <td>
									{if $cookie->RoleID > 3 and $item.PayStatus == 1}
                                		{if $item.OrderStatusId == 3 or $item.OrderStatusId == 9 or $item.OrderStatusId == 8}
										<select id="s_paystatus" onchange="return change_paystatus({$item.OrderId}, 1, this, {$item.money})" style="width:70px;">
                                			<option value=1>{l s='Not Paid'}</option>
                                			<option value=2>{l s='Paid'}</option>
                                		</select>
                                		{else}
                                			{if $item.PayStatus == 1} {l s='Not Paid'}{else}{l s='Paid'}{/if}
                                		{/if}
                                	{else}
                                		{if $item.PayStatus == 1} {l s='Not Paid'}{else}{l s='Paid'}{/if}
                                	{/if}
                                </td>
                                {/if}
                                <td {if $cookie->RoleID!=1}class="odd"{/if} style="text-align:center">
                                	{if $cookie->RoleID > 1 && ($item.OrderStatusId != 7)}
                                		{if $cookie->RoleId < 4 && $item.isCancell == 1}
                                			<input type="button" value="{l s='Detail'}" onclick="location.href='booking_order.php?booking=edit&oid={$item.OrderId}'" class="orange_border_btn detail_btn" style="width:60px;"/>
                                		{else}
                                			<input type="button" value="{l s='Detail'}" onclick="location.href='booking_confirm.php?booking=view&oid={$item.OrderId}'" class="orange_border_btn detail_btn" style="width:60px;"/>		
                                		{/if}
                                	{else}
                                	<input type="button" value="{l s='Detail'}" onclick="location.href='booking_confirm.php?booking=view&oid={$item.OrderId}'" class="orange_border_btn detail_btn" style="width:60px;"/>
                                	{/if}
                                	
                                	{if !$settle && $cookie->RoleID>1}
                                	{if $item.PaymentMethod > 0} <input type="button" value="{l s='Invoice'}" onclick="location.href='booking_confirm.php?booking=view&oid={$item.OrderId}'" class="orange_border_btn invoice_btn" style="width:60px;"/>{/if}
                                	<input type="button" value="{l s='Voucher'}" onclick="location.href='booking_confirm.php?booking=view&oid={$item.OrderId}&voucher=1'" class="orange_border_btn voucher_btn" style="width:60px;"/>
                                	{/if}
                                	
                                	{if ($item.OrderStatusId == 3 || $item.OrderStatusId == 9) && !$paymentMethod && $cookie->RoleID>1&&$item.exp!=1}
                                	<input type="button" value="{l s='Pay'}" onclick="location.href='booking_confirm.php?booking=view&oid={$item.OrderId}&payment=1'" class="orange_border_btn invoice_btn" style="width:60px;"/>	
                                	{/if}
                                	
                                </td>
                            </tr>
                        {/foreach}
                        {if $nb_products==0} 
                        	<tr><td colspan="{if $cookie->RoleID > 3}11{else}7{/if}" style="text-align: center">{l s='There is no data'}</td></tr> 
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
	        	<th>{l s='Agent ID'}</th>
	            <td id="CompanyName"></td>
	        </tr>
	        <tr>    
	            <th>{l s='User ID'}</th>
	            <td id="UserLoginId"></td>            
	        </tr>
		
	        <tr>
	        	<th>{l s='Title'}</th>
	            <td><input type="text" name="Title" req style="width:80%;" msg="{l s='Please input Title'}" /></td>
	        </tr>
	        <tr>
	        	<th style="vertical-align:top">{l s='Content'}</th>
	            <td><textarea style="width:100%;height:100px;" req name="Cont" msg="{l s='Please input Content'}"></textarea></td>
	        </tr>
	    </table>
	    </div>
	    <div class="popup_control_bar">
	    	<input type="button" class="button orange" value="{l s='Send'}" onclick="if(!getFormData(document.msgNewFrm)) return false;  
		    		document.msgNewFrm.submit();"/>
	        <input type="button" class="button white" value="{l s='Close'}" onclick="closePopup('msgNewDiv');"/>
	    </div>
	    
	</form></div>
	</div>
	<!--popup_win end -->
	
	            
            
            
            
 <script type="text/javascript">
function change_paystatus(id, defval, obj, money) {
	if (confirm("{l s='Are you confirm to change?'}")){
		setWait();
		$.ajax({
			type : "post",
			datatype : "text",
			data : {
				id : id, 
				status: obj.value, 
				money: money
			},
			url : "{$base_dir}booking_list.php?change_pay",
			success : function(data, code){
				unsetWait();
				location.href="{$base_dir}booking_list.php";
			}
		}); 
	} else {
		obj.value = defval;
	}
	return false;
}

function change_status(id, defval, obj) {
	if (confirm("{l s='Are you confirm to change?'}")){
		setWait();
		$.ajax({
			type : "post",
			datatype : "text",
			data : {
				id : id,
				status: obj.value
			},
			url : "{$base_dir}booking_list.php?change_status",
			success : function(data, code){
				unsetWait();
				location.href="{$base_dir}booking_list.php";
			}
		}); 
	} else {
		obj.value = defval;
	}
	return false;
}
 $(function(){
	 // Verify 
	 $("#btnVerify").click(function(){
		// No Selected
		if($(".check:checked").length == 0) return false;
		if(confirm("{l s='Are you confirm to verify?'}")){
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
		if(confirm("{l s='Are you confirm to delete?'}")){
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
		if(confirm("{l s='Are you confirm to undo deleting?'}")){
			setWait();
			$.ajax({
				type : "post",
				datatype : "text",
				data : $("#wfs").serialize(),
				url : "{$base_dir}agentlist.php?undel",
				success : function(data, code){
					unsetWait();
					searchFrm.submit();
				}
			}); 
		} 
	 });
 });
 </script>
