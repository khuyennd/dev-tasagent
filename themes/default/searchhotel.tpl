<!-- right content start -->
            <div class="left right_content_outer">
            	<form method="post" action="searchhotel.php" name="searchFrm" id="searchFrm" onsubmit="return onsubmit_search_hotelplan_frm()">
            	<input type="hidden" name="search" value="1" />
            	<input type="hidden" id="p" name="p" value="{$p}" />
				<input type="hidden" id="n" name="n" value="{$n}" />
				<input type="hidden" id="SortBy" name="SortBy" value="{$search_form.SortBy}" />
				<input type="hidden" id="SortOrder" name="SortOrder" value="{$search_form.SortOrder}" />
                <input type="hidden" id="HideRQ" name="HideRQ" value="{$search_form.HideRQ}" />
                <!-- search conditon start -->
                <div class="srch_condition_div">
                    <div class="srch_con">
                        <label>{l s='Area/City'}</label>
                        <select class="select_class" onchange="return OnSelectArea();" id="selarea" name="AreaId">
                            <option value="0">{l s='Area Select'}</option>
                            {foreach from=$areaList item=item name=item}
                        	<option value="{$item.AreaId}" {if $search_form.AreaId == $item.AreaId}selected="selected"{/if}>{$item.AreaName}({$item.HotelNum})</option>
                            {/foreach}
                        </select>
                        <select class="select_class" name="CityId" id="selcity">
                            <option value="0">{l s='City Select'}</option>
                        </select>
                        <input type="button"  class="button white small" value="{l s='Reset'}" alt="reset" onclick="return onAreaReset();" />
                    </div>
                    <div class="clearfix"></div>
                    
                    <div class="srch_con">
                        <label>{l s='Checkin'}/{l s='Checkout'}</label>
                        <input type="text" value="{$search_form.CheckIn}" readonly="readonly" style="float:left;" name="CheckIn" id="CheckIn"  />
                        <img src="{$img_dir}calendar_icon.jpg" alt="" width="13" class="calendar_icon" onclick="if(self.gfPop)gfPop.fPopCalendar(getById('CheckIn'), 'OnChangeStartDate(\'CheckIn\',\'CheckOut\', \'Nights\', {if (($cookie->RoleID == 2 || $cookie->RoleID == 3) && $cookie->OldLoginUserName == NULL)}1{else}0{/if})');" />
                        <select style="float:left; margin-left:5px;" name="Nights" id="Nights" onchange="javascript:OnChangeStartDate('CheckIn','CheckOut', 'Nights',{if (($cookie->RoleID == 2 || $cookie->RoleID == 3) && $cookie->OldLoginUserName == NULL)}1{else}0{/if});return false;">
                        	<!--<option value='0'>-</option>-->
                        	{for $i = 1 to 31}
                        		<option value={$i} {if $i == $search_form.Nights}selected="selected"{/if}>{$i}</option>
                        	{/for}
                        </select>
                        <span style="display:block; float:left; margin:3px 10px 0 5px;">{l s='Nights'}</span>
                        <input type="text" value="{$search_form.CheckOut}" readonly="readonly" style="float:left;" name="CheckOut" id="CheckOut" />
                        <img src="{$img_dir}calendar_icon.jpg" alt="" width="13" class="calendar_icon"  onclick="if(self.gfPop)gfPop.fPopCalendar(getById('CheckOut'), 'OnChangeEndDate(\'CheckIn\',\'CheckOut\', \'Nights\', {if (($cookie->RoleID == 2 || $cookie->RoleID == 3) && $cookie->OldLoginUserName == NULL)}1{else}0{/if})');"  />
                    </div>
                    <div class="clearfix"></div>
                    
                    <div class="srch_con" id="div_room_type">
                        <label>{l s='Room Type'}</label>
                        {foreach from=$roomTypeList item=roomType name=roomType}
                        	<select class="select_type" name="RoomType_{$roomType.RoomTypeId}">
                        		<option value="0">{l s=$roomType.RoomTypeName}</option>
                        		{for $i=1 to 10}
                        		<option value={$i} {if $i == $search_form.RoomTypeVals[$roomType.RoomTypeId]}selected="selected"{/if}>{$i}</option>
                        		{/for}
	                     	</select>
                        {/foreach}
                    </div>
                    <div class="clearfix"></div>
                    
                    <div class="left srch_con">
                        <label>{l s='Hotel Category'}</label>
                        <select class="select_class" name="HotelClassId" id="HotelClassId">
                            <option value="0">{l s='Show All'}</option>
                            {foreach from=$classList item=item name=item}
                            	<option value="{$item.HotelClassId}" {if $item.HotelClassId == $search_form.HotelClassId}selected="selected"{/if}>{l s=$item.HotelClassName}</option>
                            {/foreach}
                        </select>
                    </div>
                    
                    <div class="left srch_con">
                        <label>{l s='Hotel name'}</label>
                        <input type="text" value="{$search_form.HotelName}" name="HotelName" />
                    </div>
                    <div class="clearfix"></div>
                    
                    <div class="srch_btn">
                        <input type="submit" name="search" value="{l s='Search Now'}"   class="button orange medium" alt="{l s='search now'}"/>
                    </div>
                </div>
                <!-- search conditon end -->
                </form>
                <!-- Information start -->
                <div class="all_border srch_result_div">
                	<!-- search result —— tips start -->
                	<p class="srch_p"><span class="bold">{$search_area_name} / {$search_city_name}</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">{$search_form.CheckIn}</span>&nbsp;&nbsp;<span class="red">{l s='DAY'}</span>&nbsp;<span class="red">/</span>&nbsp;<span class="red">{$search_form.Nights}</span>&nbsp;<span class="red">{l s='Nights'} </span>&nbsp;&nbsp;&nbsp;&nbsp;{l s='Search Result'}&nbsp;&nbsp;<span class="red">{$hotel_roomplan_count}</span>&nbsp;&nbsp;{l s='Hotels'}</p>
                    <div class="srch_tips_outer">
                    	<div class="srch_tips_title">
                            {if ($cookie->RoleID == 2 || $cookie->RoleID == 3)}
                        	<div class="left rank_type_div">
                                <span>{l s='Price'}</span>{if $search_form.SortBy == 'price' and $search_form.SortOrder == 'asc'}
                                <img src="{$img_dir}top_rank_icon_on.png" alt="" width="17" />
                                {else}
                                <img src="{$img_dir}top_rank_icon.png" alt="" width="17" onclick="return setSortValue('price', 'asc');" />
                                {/if}
                                {if $search_form.SortBy == 'price' and $search_form.SortOrder == 'desc'}
                                <img src="{$img_dir}bottom_rank_icon_on.png" alt="" width="17" />
                                {else}
                                <img src="{$img_dir}bottom_rank_icon.png" alt="" width="17" onclick="return setSortValue('price', 'desc');" />
                                {/if}
                            </div>
                            {/if}
                            <div class="left rank_type_div">
                                <span>{l s='Class'}</span>
                                {if $search_form.SortBy == 'class' and $search_form.SortOrder == 'asc'}
                                <img src="{$img_dir}top_rank_icon_on.png" alt="" width="17" />
                                {else}
                                <img src="{$img_dir}top_rank_icon.png" alt="" width="17" onclick="return setSortValue('class', 'asc');" />
                                {/if}
                                {if $search_form.SortBy == 'class' and $search_form.SortOrder == 'desc'}
                                <img src="{$img_dir}bottom_rank_icon_on.png" alt="" width="17" />
                                {else}
                                <img src="{$img_dir}bottom_rank_icon.png" alt="" width="17"  onclick="return setSortValue('class', 'desc');" />
                                {/if}
                            </div>
                            <div class="left rank_type_div">
                                <span>{l s='Hotel Name'}</span>
                                {if $search_form.SortBy == 'name' and $search_form.SortOrder == 'asc'}
                                <img src="{$img_dir}top_rank_icon_on.png" alt="" width="17" />
                                {else}
                                <img src="{$img_dir}top_rank_icon.png" alt="" width="17" onclick="return setSortValue('name', 'asc');" />
                                {/if}
                                {if $search_form.SortBy == 'name' and $search_form.SortOrder == 'desc'}
                                <img src="{$img_dir}bottom_rank_icon_on.png" alt="" width="17" />
                                {else}
                                <img src="{$img_dir}bottom_rank_icon.png" alt="" width="17" onclick="return setSortValue('name', 'desc');" />
                                {/if}
                            </div>
                            {if ($cookie->RoleID == 2 || $cookie->RoleID == 3)}
                            <div class="left only_booking">
                                <input type="checkbox" onclick="javascript:onclick_show_rq(this);" {if $search_form.HideRQ == 1}checked="checked"{/if} id="chk_HideRQ" />
                                <label for="chk_HideRQ">{l s='See only hotels instant booking available'}</label>
                            </div>
                            {/if}
                        </div>
                        <div class="srch_tips_content">
                        	<p>{l s='Below price includes service charge and tax which are charged in the local country'}</p>
                            <div><input type="button" class="ok_btn" value='{l s="OK"}' width="30" />&nbsp;{l s='Instant booking available'}&nbsp;
                            <input type="button" class="rq_btn" value='{l s="RQ"}' width="30" />&nbsp;{l s='Request basic booking:callback in an hour'}</div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!-- search result —— tips end -->
                    
                    <!-- search result —— hotel list start -->
                    {foreach from=$hotel_roomplan_list item=hotel name=hotel}
                    <div class="hotellist_outer">
                    	<div class="left hotellist_left">
                        	<div style="width:200px;height:200px;background:#f1f1f1 url({$base_dir}asset/{$hotel.w5_path}) no-repeat center center;background-size:{$hotel.w5}px {$hotel.h5}px;"></div>                            <!-- 
                            <div class="hotellist_btn">
                            	<p class="left"><a href="hotelpage.php?mid={$hotel.HotelId}">Preview</a></p>
                            	<p class="right"><a href="javascript:showMap('{$hotel.HotelName}', '{$hotel.HotelAddress}, {$hotel.CityName}, {$hotel.AreaName}, Japan'); ">Location</a></p>
                            </div>
                            -->
                        </div>
                        <form action="booking_order.php" method="post" id="frm_{$hotel.HotelId}" onsubmit="return onsubmit_booking_room('frm_{$hotel.HotelId}')">
                        <input type="hidden" name="checkin" value="{$search_form.CheckIn}" />
                        <input type="hidden" name="checkout" value="{$search_form.CheckOut}" />
                        <input type="hidden" name="hotel_id" value="{$hotel.HotelId}" />
                        <input type="hidden" name="booking" value="order" />
                        <div class="right hotellist_right">
                        	<h3><a href="hotelpage.php?mid={$hotel.HotelId}&CheckIn={$search_form.CheckIn}&CheckOut={$search_form.CheckOut}&Nights={$search_form.Nights}{foreach from=$roomTypeList item=roomType name=roomType}&RoomType_{$roomType.RoomTypeId}={$search_form.RoomTypeVals[$roomType.RoomTypeId]}{/foreach}">{$hotel.HotelName}</a></h3>
                            <p><span class="left">{$hotel.AreaName} / {$hotel.CityName}</span><span class="left orange_color bold">&nbsp;&nbsp;{l s=$hotel.HotelClassName}</span></p>
                            <div class="clearfix"></div>
                            <div class="hotel_illustration">
                            	{$hotel.HotelDescription}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="ok_rq_type">
                            <table cellpadding="0" cellspacing="0">
                                <tbody>
                                	{foreach from=$hotel.RoomPlanList item=roomplan name="roomplan"}
                                        {$roomplan.MinPrice=Booking::shoushuliao($roomplan.MinPrice,$roomplan.RoomPlanId)}
                                    <tr >
                                        <td width="50">{if ($cookie->RoleID >= 4)}{$smarty.foreach.roomplan.index + 1}{else}<input type="checkbox" onchange="javascript:oncheck_changed('{$hotel.HotelId}')" {if $roomplan.PreSelect > 0}checked="checked"{/if} name="plan_id_amount[]" value="{$roomplan.RoomPlanId}_{$search_form.RoomTypeVals[$roomplan.RoomTypeId]}" minprice="{$roomplan.MinPrice}" ordercount="{$search_form.RoomTypeVals[$roomplan.RoomTypeId]}"  />{/if}</td>
                                        <td width="32">
												{if (($roomplan.MinAmount > 0) && ($roomplan.MinAmount >= $search_form.RoomTypeVals[$roomplan.RoomTypeId])) || ($search_form.CheckIn == '')}
													<input type="button" class="ok_btn" value='{l s="OK"}' width="30" />
												{else}
													<input type="button" class="rq_btn" value='{l s="RQ"}' width="30" />
												{/if} 
										</td>
                                        {if ($cookie->RoleID == 2 || $cookie->RoleID == 3)}
                                            <td><a href="javascript;" onclick="onclick_roomplan_view_with_price({$roomplan.RoomPlanId}, {$roomplan.MinPrice});return false">{$roomplan.RoomPlanName}</a> {if $roomplan.UseCon == 1}<a href="javascript;" onclick="onclick_roomplan_sales({$roomplan.RoomPlanId});return false;"><img src="{$img_dir}sale_icon.png"/></a>{/if}</td>
                                            <td class="ok_rq_money">￥{$roomplan.MinPrice|number_format:0:".":","}~</td>
                                        {else}
                                            <td><a href="javascript;" onclick="onclick_roomplan_view({$roomplan.RoomPlanId});return false">{$roomplan.RoomPlanName}</a> {if $roomplan.UseCon == 1}<a href="javascript;" onclick="onclick_roomplan_sales({$roomplan.RoomPlanId});return false;"><img src="{$img_dir}sale_icon.png"/></a>{/if}</td>
                                        {/if}
                                        <td class="ok_rq_txt">{l s="BF"}:{if $roomplan.Breakfast == 1}{l s='Yes'}{else}{l s='None'}{/if}
                                            {l s="DN"}:{if $roomplan.Dinner == 1}{l s='Yes'}{else}{l s='None'}{/if}</td>
                                    </tr>
                                    {/foreach}
                                </tbody>
                            </table>
                        </div>
                            {if ($cookie->RoleID == 2 || $cookie->RoleID == 3)}
                            <div class="booking_div">
                                <p class="right booking_btn">
   									<input type="submit" name="search" value="{l s='Booking'}" class="button orange" alt="{l s='Booking'}"/>
   								</p>
                                 	<p class="right">1 {l s='Night Total'}:<span class="bold" id="price_{$hotel.HotelId}"> ￥ {Booking::shoushuliaoByHid($hotel.BookingPrice,$hotel.HotelId)|number_format:0:".":","}</span></p>
                            </div>
                            {/if}
                        </form>
                    </div>
                    {/foreach}
                    <!-- search result —— hotel list end -->
                    
                    
                    <!-- page control start -->
                    {include file="$tpl_dir./common/pagination.tpl"}
                    <div class="clearfix"></div>
                    <!-- page control end -->
                    
                    <br /><br />
                </div>
                <!-- Information end -->
            </div>
            <!-- right content end -->
            <div class="clearfix"></div>
            
            {include file="$tpl_dir./roomplan_popup.tpl"}
            
            <script>
            <!--
            	$(document).ready(function(){
            		
            		OnSelectArea({$search_form.CityId});
            		
            		// $("#tr_roomplan_32").draggable();
            	});
            	
            	function setSortValue(sortBy, sortOrder)
            	{
            		$("#SortBy").val(sortBy);
            		$("#SortOrder").val(sortOrder);
            		
            		if (onsubmit_search_hotelplan_frm())
            			$("#searchFrm").submit();
            	}
            	
            	function onsubmit_search_hotelplan_frm()
            	{
            		/*if ($("#selarea option:selected").val() == 0)
            		{
            			alert('{l s='Please select area!'}');
            			$("#selarea").focus();
            			return false; 
            		}
            		if ($("#selcity option:selected").val() == 0)
            		{
            			alert('{l s='Please select city!'}');
            			$("#selcity").focus();
            			return false;
            		}*/
            		{if ($cookie->RoleID == 2 || $cookie->RoleID == 3)}
                        if ($("#CheckIn").val() == '')
                        {
                            alert('{l s='Please select check in date!'}');
                            $("#CheckIn").focus();
                            return false;
                        }

                        if ($("#CheckOut").val() == '')
                        {
                            alert('{l s='Please select check out date!'}');
                            $("#CheckIn").focus();
                            return false;
                        }

                        var roomTypeSelected = false;
                        $('#div_room_type select.select_type option:selected').each(function (i, obj){
                            if (0 != $(obj).val())
                            {
                                roomTypeSelected = true;
                            }
                        });

                        if (!roomTypeSelected)
                        {
                            alert('{l s='Please select room type!'}');
                            return false;
                        }
                    {else}
                        var roomTypeSelected = false;
                        $('#div_room_type select.select_type option:selected').each(function (i, obj){
                            if (0 != $(obj).val())
                            {
                                roomTypeSelected = true;
                            }
                        });

                        if ($("#CheckIn").val() != '' && $("#CheckOut").val() != '')
                        {
                            if (!roomTypeSelected)
                            {
                                alert('{l s='Please select room type!'}');
                                return false;
                            }
                        }

                        if (roomTypeSelected)
                        {
                            if ($("#CheckIn").val() == '' || $("#CheckOut").val() == '')
                            {
                                alert('{l s='Please select CheckIn/CheckOut day!'}');
                                return false;
                            }
                        }

                    {/if}
            		return true;
            	}
            	
            	function onsubmit_booking_room(frmId)
            	{
            		if ($('#' + frmId + ' input:checked').length == 0)
            		{
            			alert('{l s='Please select room!'}');
            			return false;
            		}
            	}
            	
            	function oncheck_changed(hotelId)
            	{
            		var total_price = 0;
            		$('#frm_' + hotelId + ' input:checked').each(function(i, obj){
            			var minprice = $(obj).attr('minprice');
            			var ordercount = $(obj).attr('ordercount');
            			total_price += minprice * ordercount; 
            		});
            		
            		$('#price_' + hotelId).html(formatDollar(total_price));
            	}

                function onclick_show_rq(chk)
                {
                    // alert($(chk).is(":checked"));
                    if ($(chk).is(":checked")) {
                        $("#HideRQ").val(1);
                    } else {
                        $("#HideRQ").val(0);
                    }
                    if (onsubmit_search_hotelplan_frm())
                        $("#searchFrm").submit();
                }
            // -->
            </script>
            
            
<!--popup_win start -->
<div class="popup_win_frame" id="map_popup" style="display:none" >
<div class="popup_win_view" style="width:550px;height:400px;">
	<div class="title">
    	<div class="close_btn"  onclick="closePopup('map_popup'); return false;"></div>
        {l s='Map View'}
    </div>
    <div class="edit_view">
		<div id="map_canvas" class="map rounded" style="width:530px;height:360px;"></div>
	</div>
</div>
</div>
<!--popup_win end -->   
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
            
