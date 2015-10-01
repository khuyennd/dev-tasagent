<!-- right content start -->
<div class="left right_content_outer">     
	<input type="hidden" id="nights" value="{$booking_info.nights}" />
	
	<form method="post" action="booking_confirm.php" onsubmit="return onsubmit_booking_confirm()">
	<input type="hidden" name="hotel_id" value="{$booking_info.hotel_info.HotelId}" />
	<input type="hidden" name="order_id" value="{$booking_info.order_id}" />

	{if $method=='order'}
    <!-- booking step start -->
    <div class="booking_step_outer">
        <div class="booking_step step_bg_arrow" style="margin-top:11px;">
            <span class="font18 bold gray">1:{l s='Search'}</span>
        </div>
        <div class="booking_step step_bg_arrow" style="margin-top:11px;">
            <span class="font18 bold gray">2:{l s='Result'}</span>
        </div>
        <div class="booking_step step_bg_arrow" style="margin-top:11px;">
            <span class="font18 bold">3:{l s='Reservation'}</span>
        </div>
        <div class="booking_step step_bg_arrow" style="margin-top:11px;">
            <span class="font18 bold gray">4:{l s='Check'}</span>
        </div>
        <div class="booking_step" style="margin-top:11px;">
            <span class="font18 bold gray">5:{l s='End'}</span>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- booking step end -->
    {/if}
    <!-- booking hotel info start -->
    <div class="orange_border_box">
    
        <div class="content_box">
            <div class="orange_color bold font18 name_title_bg" style="width:100%">{$booking_info.hotel_info.HotelName}</div>
            <div class="darkgray">
                <p style="margin-top: 2px;">{l s="Address"}: {$booking_info.hotel_info.HotelAddress}</p>
                <p style="margin-top: 2px;">{l s="Region"}: {$booking_info.hotel_info.CityName},{$booking_info.hotel_info.AreaName}</p>
                <p style="margin-top: 2px;"><span class="left">{l s="class"}:</span><span class="left">{l s=$booking_info.hotel_info.HotelClassName}</span></p>
                <div class="clearfix"></div>     
            </div>                      
        </div>
    
    </div>
    <!-- booking hotel info end -->
    
    <!-- booking detail start -->
    <div class="booking_detail">
        {if $method=='order'}
		<p class="orange_color bold" style="font-size: 15px;">01. {l s='Check-In / Check-Out / Room Info / Guest Info'}</p>
        <p class="darkgray" style="line-height:18px; margin:5px 0;">* {l s='Please Note: For “OK” (instant booking) will be hold Next 30 mins'}.<br />
        &nbsp;&nbsp;  {l s='After this 30mins, room will be released and you will need to once again initiate a search for the room'}.</p>
        {/if}
		<div class="date_choose_outer">
            <span class="left bold font14" style="margin:11px 0 0;">{l s="Date"}</span>
            <div class="srch_con">
               	<label>{l s='Checkin_order'} : </label>
                <input type="text" value="{$booking_info.checkin}" readonly="readonly" style="float:left;" name="checkin" id="CheckIn"  />
                <img src="{$img_dir}calendar_icon.jpg" alt="" width="13" class="calendar_icon" {if $method == 'edit'} onclick="if(self.gfPop)gfPop.fPopCalendar(getById('CheckIn'), 'OnChangeStartDate(\'CheckIn\',\'CheckOut\', \'Nights\', {if ($cookie->RoleID == 2 || $cookie->RoleID == 3)}1{else}0{/if})');" {/if} />
                {if $method == 'edit'}
				<select style="float:left; margin-left:5px;" name="nights" id="Nights" onchange="javascript:OnChangeStartDate('CheckIn','CheckOut', 'Nights',{if ($cookie->RoleID == 2 || $cookie->RoleID == 3)}1{else}0{/if});return false;">
                	<!--<option value='0'>-</option>-->
                	{for $i = 1 to 31}
                		<option value={$i} {if $i == $booking_info.nights}selected="selected"{/if}>{$i}</option>
                	{/for}
                </select>
                    <span style="display:block; float:left; margin:3px 10px 0 5px;">{l s='Nights'}</span>
                {else}
                <span style="display:block; float:left; margin:3px 10px 0 5px;">{$booking_info.nights}{l s='Nights'}</span>
                {/if}

				<label>{l s='Checkout_order'} :</label>                
                <input type="text" value="{$booking_info.checkout}" readonly="readonly" style="float:left;" name="checkout" id="CheckOut" />
                <img src="{$img_dir}calendar_icon.jpg" alt="" width="13" class="calendar_icon" {if $method == 'edit'}  onclick="if(self.gfPop)gfPop.fPopCalendar(getById('CheckOut'), 'OnChangeEndDate(\'CheckIn\',\'CheckOut\', \'Nights\', {if ($cookie->RoleID == 2 || $cookie->RoleID == 3)}1{else}0{/if})');" {/if}  />
				
				{if $method == 'edit'}
                <input id="calculation" style="margin-left:20px ;" name="calculation" onclick="calculate()" type="submit" value="{l s='Calculation'}" class="button orange medium"/>
                {/if}
			</div>
            
            <div class="clearfix"></div>
        </div>
    </div>                    
    <!-- booking detail end -->
    
    {foreach from=$booking_info.booked_roomplan_list item=roomplan name="roomplan"}
    {assign var="id" value=$smarty.foreach.roomplan.index}
    <input type="hidden" name="ids[]" value="{$id}" />
    <input type="hidden" name="or_ids_{$id}" value="{$roomplan.OrderRoomId}" />
    <input type="hidden" name="roomplan_ids_{$id}" value="{$roomplan.RoomPlanId}" />
    <input type="hidden" id="roomplan_minprice_{$id}" value="{$roomplan.MinPrice}" />
    <input type="hidden" id="roomplan_typename_{$id}" value="{$roomplan.RoomTypeName}" />
    <!-- booking plan start -->
    <p style="margin-top:10px; font-size:14px;" class="bold">{$id + 1}. {$roomplan.RoomPlanName}</p>
    <div class="all_border room_plan_div"> 
    	
        <div class="room_plan_detail bold">
       	  	<div class="left roomtype">
                <label style="text-align: left;">{l s='Room type'}</label>
                <select class="select_class" disabled="disabled" >
                    <option>{l s=$roomplan.RoomTypeName}</option>
                </select>
            </div>
            <div class="left paxstay bold">
                <label>{l s='no of pax stay at room'}</label>
                <input type="hidden"  id="roomcount_{$id}" name="roomplan_counts_{$id}" value="{$roomplan.OrderCount}" />
                <select class="select_class" name="roomplan_persons_{$id}" onchange="return onchange_select_roomcount({$id}, this.value)">
                	{for $i = 1 to $roomplan.RoomMaxPersons}
                    <option value="{$i}" {if $roomplan.RoomMaxPersons == $i}selected="selected"{/if}>{$i}</option>
                    {/for}
                </select>
            </div>
            <div class="clearfix"></div>
        </div>                    
        
        <div id="roomplan_booking_customer_{$id}">
        {include file="$tpl_dir./booking_sub_customer.tpl" id=$id count=$roomplan.RoomMaxPersons countries=$countries customers=$roomplan.customer_info_list}
        </div>
        
        <div class="room_plan_detail bold"  style="margin-top: 5px;">
            <div class="left plan_dinner"><label>{l s='Breakfast'}:{if $roomplan.Breakfast == 1}{l s='Yes'}{else}{l s='None'}({l s='Addition Possible'}){/if}</label></div>
            <div class="left plan_dinner"><label>{l s='Dinner'}:{if $roomplan.Dinner == 1}{l s='Yes'}{else}{l s='None'}({l s='Addition Possible'}){/if}</label></div>
            <div class="clearfix"></div>
        </div>                    
        
		<div class="sepecial_request_outer">
			<div class="sepecial_title" onclick="showapp('special_tit_{$id}','special_detail_{$id}')">
				<p class="fold" id="special_tit_{$id}">{l s='Special Request'}</p>
			</div>
			<div class="hidden sepecial_content" id="special_detail_{$id}">
            	<div class="left smoking_type"><input type="checkbox" {if $roomplan.req_nonsmoking == 1}checked="checked"{/if} name="req_nonsmoking_{$id}" id="req_nonsmoking_{$id}" value="1" /><label for="req_nonsmoking_{$id}">{l s='Non Smoking'}</label></div>
                <div class="left smoking_type"><input type="checkbox" {if $roomplan.req_smoking == 1}checked="checked"{/if} name="req_smoking_{$id}" id="req_smoking_{$id}" value="1" /><label for="req_smoking_{$id}">{l s='Smoking'}</label></div>
                <div class="left smoking_type"><input type="checkbox" {if $roomplan.req_adjoin == 1}checked="checked"{/if} name="req_adjoin_{$id}" id="req_adjoin_{$id}" value="1" /><label for="req_adjoin_{$id}">{l s='Adjoin room'}</label></div>
                <div class="clearfix"></div>
              	<div class="sepecial_remark">
                    <label>{l s='Remark'}</label>
                    <textarea style="width:675px; height:48px;" name="req_remark_{$id}">{$roomplan.req_remark}</textarea>
                </div>
                <p class="gray">※ {l s='All Special request are subjects to availability'}</p>
            </div>
            
            <p class="orange_clor bold" id="roomprice_{$id}" style="margin-top: 5px;">{l s='Room Price'} : {$roomplan.PriceString}  <!--: 【単価】 X 【宿泊日数】 = 【部屋別の総額】    ※貨幣はJPY(日本円）のみで大丈夫です。</p> -->
        </div>
        <div class="clearfix"></div>                    
    </div>
    <!--
    <div class="right hotel_booking_btn"><input type="button" class="button orange" alt="booking" value="Add Room"/></div>
    <div class="clearfix"></div>
    -->
	<!-- booking plan end -->    
    {/foreach}
    <!-- total price start -->
    <div class="total_price_div">
    	<table widt="300px">
		<tr>
			<td width="100px"><p class="bold">{l s='Total Price'}</p></td>
			{if $booking_info.otherPrice != 0}
			<td width="100px"><p class="bold">{l s='Paid In'}</p></td>
			<td width="100px"><p class="bold">{l s='Unpaid'}</p></td>
			{/if}
		</tr>
		<tr>
			<td><p class="orange_color" id="div_total_price">{$booking_info.TotalPriceString}</p></td>
			{if $booking_info.otherPrice != 0}
			<td><p class="orange_color" id="div_paidin_price">{$booking_info.PaidIn}</p></td>
			<td><p class="orange_color" id="div_unpaid_price">{$booking_info.UnPaid}</p></td>
			{/if}
		</tr>
		</table>
    </div>
    <!-- total price end -->
    
    <!-- customer information start -->
    <p class="orange_color bold" style="font-size: 15px;">02. {l s='Customer Information'}</p>
    <div class="cus_info_div">
    	<div class="left cus_info_blank">
            <span class="red">*</span><label>{l s='Name'}</label>
            <input type="text" name="contact_name" id="contact_name" value="{$booking_info.contact_name}" />
        </div>
        <div class="left cus_info_blank">
            <span class="red">*</span><label>{l s='Email'}</label>
            <input type="text" name="contact_email" id="contact_email" value="{$booking_info.contact_email}"  />
        </div>
        <div class="clearfix"></div>
        <div class="left cus_info_blank">
            <span class="red">*</span><label>{l s='TEL'}</label>
            <input type="text" name="contact_tel" id="contact_tel" value="{$booking_info.contact_tel}"  />
        </div>
        <div class="left cus_info_blank">
            <span class="white_color">*</span><label>{l s='HP'}</label>
            <input type="text" name="contact_hp" id="contact_hp" value="{$booking_info.contact_hp}"  />
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- customer information start -->
    {if $method=='order'}
    <div class="booking_info_btn">
        <input name="booking" value="confirm" type="hidden" />
    	<div class="left booking_next"><input type="submit" class="button orange" value="{l s='next'}" alt="next" title="next"/></div>
        <div class="left booking_back"><input type="button" class="button white" alt="back" value="{l s='Back'}" onclick="javascript:history.go(-1);" /></div>
        <div class="clearfix"></div>
    </div>
    {else}
    <div class="booking_info_btn">
        <input name="booking" value="save" type="hidden" />
    	<div class="left booking_next"><input type=submit value="{l s='Save'}" class="button orange medium"/></div>
        <div class="left booking_back"><input type="button" class="button white medium" alt="back" value="{l s='Back'}" onclick="javascript:location.href='booking_list.php'" /></div>
        <div class="clearfix"></div>
    </div>
    {/if}
    </form>
    <br /><br />
</div>
<!-- right content end -->
<div class="clearfix"></div>

<script>
    $(document).ready(function () {
        // recalc_money();

    });
	function calculate() {
		$("input[name='booking']").val("calculate");	
	}

	function onchange_select_roomcount(id, count)
	{
		$('#roomplan_booking_customer_' + id).load('booking_order.php?action=customer&count=' + count + '&id=' + id);
		
		// recalc_money();
	}

//  @deleted
	function recalc_money()
	{
        // never called
		var nights = parseInt($("#nights").val());
		var ids_obj = $('input[name="ids[]"]');
		var total_price = 0;
		var total_div_contents = '';
		for(i = 0; i < ids_obj.length; i++)
		{
			var id = $(ids_obj[i]).val();
			var min_price = parseInt($('#roomplan_minprice_' + id).val());
			var roomcount = parseInt($('#roomcount_' + id).val());
			var roomplan_typename = $('#roomplan_typename_' + id).val();
			var room_price = nights * min_price * roomcount;
			var tmp_price_contents = '';

			$('#roomprice_' + id).html("Room Price : 【" + formatDollar(min_price) + "】 X 【" + nights + "】X 【" + roomcount + '】 = 【' + formatDollar(room_price) + '】    ※貨幣はJPY(日本円）のみで大丈夫です。');
			
			if (total_div_contents != '')
				total_div_contents +=" + ";
			
			// ############################################################
			// tmp_price_contents = "(3X( Semi Double X 6,200 X 1 N ))";
			// ############################################################
			tmp_price_contents = "(";
			if (roomcount > 1)
				tmp_price_contents += roomcount + "X( ";
			
			tmp_price_contents += roomplan_typename;
			tmp_price_contents += " X ";
			tmp_price_contents += formatDollar(min_price);
			tmp_price_contents += " X ";
			tmp_price_contents += nights;
			tmp_price_contents += " N";
				
			if (roomcount > 1)
				tmp_price_contents += " )";
			tmp_price_contents += ")";
			
			// ############################################################
			
			
			
			total_div_contents += tmp_price_contents;
			
			total_price += room_price;
		}
		
		$('#div_total_price').html(total_div_contents + '= <span class="bold font16">' + formatDollar(total_price) + '</span>');
	}
	
	function check_input_fields(names, message)
	{
		var input_objs = $('input[name="' + names +'"]');
			
		for (var j = 0; j < input_objs.length; j++)
		{
			if ($(input_objs[j]).val() == '')
			{
				alert('{l s='please input family names'}');
				$(input_objs[j]).focus();
				return false;
			}
		}
		
		return true;
	}
	
	function onsubmit_booking_confirm()
	{
		var ids_obj = $('input[name="ids[]"]');

        // changed validation input customer info
        // at least we need one's info information, not all info

		for(i = 0; i < ids_obj.length; i++)
		{
			var id = $(ids_obj[i]).val();

            var input_fnames_objs = $('input[name="customer_fnames_' + id +'[]"]');
            var input_gnames_objs = $('input[name="customer_gnames_' + id +'[]"]');
            var isAllEmpty = true;
            for (var j = 0; j < input_fnames_objs.length; j++)
            {
                var fname=$(input_fnames_objs[j]).val();
                var gname=$(input_gnames_objs[j]).val();
                if (fname != '' &&
                        gname != ''  )
                {
                    isAllEmpty = false;
                    break;
                }
                if(check_text(fname,"{l s='We can accept only alphabet characters'}")==false){
                    return false;
                }
                if(check_text(gname,"{l s='We can accept only alphabet characters'}")==false){
                    return false;
                }
            }

            if (isAllEmpty == true)
            {
                alert("{l s='At least you must input one customer info'}");

                return false;
            }
            /*
            if (false == check_input_fields('customer_fnames_' + id + '[]', "{l s='please input family names'}"))
            {
                return false;
            }

            if (false == check_input_fields('customer_gnames_' + id + '[]', "{l s='please input given names'}"))
            {
                return false;
            }
            */
		}

		
		if ($("#contact_name").val() == '')
		{
			alert("{l s='please input contact name'}");
			$("#contact_name").focus();
			return false;
		}

        /*if(check_text($("#contact_name").val(),"{l s='We can accept only alphabet characters'}")==false){
            return false;
        }*/
		if ($("#contact_email").val() == '')
		{
			alert("{l s='please input contact email address'}");
			$("#contact_email").focus();
			return false;
		}

        if (false == validate_email($("#contact_email").val()))
        {
            alert("{l s='please input correct contact email address'}");
            $("#contact_email").focus();
            return false;
        }
		
		if ($("#contact_tel").val() == '')
		{
			alert("{l s='please input contact telephone number'}");
			$("#contact_tel").focus();
			return false;
		}

        if (false == validate_tel($("#contact_tel").val()))
        {
            alert("{l s='please input correct telephone number'}");
            $("#contact_tel").focus();
            return false;
        }

		return true;
	}
    {literal}
    function check_text(field, alerttxt) {
        var usern = /^[a-zA-Z0-9_@]{1,}$/;
        if (field != '') {
            if (!field.match(usern)) {
                alert(alerttxt);
                return false;
            }
        }
        return true;
    }
    {/literal}
//-->
</script>
