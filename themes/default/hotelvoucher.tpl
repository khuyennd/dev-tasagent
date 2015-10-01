<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hotel Voucher</title>
<link href="/tas-agent/themes/default/css/voucher.css" rel="stylesheet" type="text/css" />
</head>
<body style="width: 800px;">
<div id="header_wrap">
  <div id="header">
    	<div class="logo_text">Hotel <span class="orange_color">Voucher</span></div>
        <div class="logo_img"><img src="{$img_dir}/logo.png"/></div>
        <div class="logo_comment">Please present either an electronic or paper copy of your hotel voucher upon check-in</div>
  </div>
</div>
<div id="main_content">
	<div class="main_info">    	
       	{l s='Hotel'}: {$booking_info.hotel_info.HotelName}<br/>       
        {l s='Address'}: {$booking_info.hotel_info.HotelAddress}<br/> 
        {l s='Hotel Contact No'}: {$booking_info.hotel_info.HotelContactNo}
    </div>
    <div class="title_bar">1. {l s='Customer Information'}</div>
    <div class="gray_box">
    	<table width="100%"><tr>
        	<td width="30%"><span class="gray_color">{l s='Booking ID'}:</span>&nbsp;{$booking_info.BookingNo}</td>
        	<td><span class="gray_color">{l s='Guest Name'}:</span>&nbsp;{$booking_info.contact_name}</td></tr><tr>
			<td><span class="gray_color">{l s="E-mail"}:</span>&nbsp;{$booking_info.contact_email}</td>
            <td><span class="gray_color">{l s='Tel'}:</span>&nbsp;{$booking_info.contact_tel}</td></tr></table>
    </div>
    <div class=" title_bar">2. {l s='Booking Information'}</div>
    <div class="gray_box">
    	<table width="100%"><tr>
        	<td width="30%"><span class="gray_color">{l s='Check In'}:</span>&nbsp;{$booking_info.checkin}</td>
            <td><span class="gray_color">{l s='Check Out'}:</span>&nbsp;{$booking_info.checkout}</td></tr><tr>
         	<td colspan="2"><span class="gray_color">Total No or rooms:</span>&nbsp;{$booking_info.roomString}</td></tr></table>
        <div class="bold title_bar">Rooming Details</div>
        {foreach from=$booking_info.booked_roomplan_list item=roomplan name=roomplan}
        {assign var="id" value=$smarty.foreach.roomplan.index}
        <div class="title_bar">- Room {$id+1}</div>
        	<table width="100%"><tr>
        	<td colspan="2"><span class="gray_color">{l s='Room Plan'}:</span>&nbsp;{$roomplan.RoomPlanName}</td></tr><tr>
            <td width="30%"><span class="gray_color">{l s='Room Type'}:</span>&nbsp;{l s=$roomplan.RoomTypeName}</td>
  			<td><span class="gray_color">{l s='no of pax stay at room'}:</span>&nbsp;{$roomplan.customer_info_list|@count}</td></tr><tr>
            <td valign="top" colspan="2">
            	<table><tr>
                	<td style="padding:0;vertical-align: top;"><span class="gray_color">{l s='Guest Name'}:</span></td>
                	<td style="padding:0;padding-left:5px;">
                	{foreach from=$roomplan.customer_info_list item=customer name=customer}
                	{if $smarty.foreach.customer.index == 0}
                		{if $customer.customer_sex == 1}Mr{else}Mrs{/if}&nbsp;{$customer.customer_fnames}&nbsp;{$customer.customer_gnames}&nbsp;({$customer.customer_country_name}) 
                	{else}
                		&nbsp;,&nbsp;&nbsp;  {if $customer.customer_sex == 1}Mr{else}Mrs{/if}&nbsp;{$customer.customer_fnames}&nbsp;{$customer.customer_gnames}&nbsp;({$customer.customer_country_name})
                	{/if}
                	{/foreach}</td></tr></table>
            </td></tr><tr>
            <td><span class="gray_color">{l s='Breakfast'}:</span>&nbsp;
            	{if $roomplan.Breakfast == 1}{l s='Included'}{else}{l s='None'}{/if}</td>
            <td><span class="gray_color">{l s='Dinner'}:</span>&nbsp;
                {if $roomplan.Dinner == 1}{l s='Included'}{else}{l s='None'}{/if}</td></tr><tr>
            <td colspan="2"><span class="gray_color">{l s='Special Request'}:</span>&nbsp;
            	{if $roomplan.req_nonsmoking == 1}{l s='Non Smoking'},&nbsp;{/if}
            	{if $roomplan.req_smoking == 1}{l s='Smoking'},&nbsp;{/if}
            	{if $roomplan.req_adjoin == 1}{l s='Adjoin room'},&nbsp;{/if}
            	{$roomplan.req_remark}
            
            </td></tr></table>
        
        <div class="gray_color">※ All Special request are subjects to availability</div>
        {/foreach}
        
    </div>
    <div class=" title_bar">3. Agent Information</div>
    <div class="gray_box">
    	<table width="100%"><tr>
        	<td colspan="2"><span class="gray_color">Name:</span>&nbsp;{$booking_info.agent_info->Name}</td></tr><tr>
        	<td width="30%"><span class="gray_color">Phone no:</span>&nbsp;{$booking_info.agent_info->Tel}</td>
            <td><span class="gray_color">Email:</span>&nbsp;{$booking_info.agent_info->Email}</td></tr></table>
        <div class="black_color title_bar">Note:</div>
        <div class="gray_color">
        	
-This voucher must be presented during check in. Failure to　do so may result in the reservation not being honored. <br/>
-Hotel has right a right to request credit card or deposit upon arrival to cover and guaranteed any incidental cost that maybe incurred during the stay.<br/>
-If you expect to arrive after 21:00, please inform the hotel your arrival time to avoid being released. In the event of No show or Early check-out, the hotel reserves right to charge a full cancellation fee. <br/>
-In case where Breakfast is included with the room rate, please note that certain hotels may charge extra for children travelling with their parents. If applicable, the hotel will bill you directly. Upon arrival, if you have any question, please verify with hotel.<br/>

        </div>
    </div>

</div>
<div id="footer_wrap">
	<div id="footer">
    	<div class="footer_logo_img"><img src="{$img_dir}bottom_logo.jpg"/></div>
        <div class="footer_text">
        	TAS Agent / TAS Co.,Ltd<br/>
            TEL +81-3-5565-5850
        </div>
        <div class="footer_comment">
        	※TAS Agent はTAS Co.,Ltdが運営しております。　上記予約の内容については直接TASまでご連絡ください。
        </div>
  </div>
</div>
</body>
</html>
<script>
	function printPage() { print(); }
</script>
