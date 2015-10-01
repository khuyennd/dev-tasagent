<!-- right content start -->
<div class="left right_content_outer">
    <!-- booking step start -->
    <div class="booking_step_outer">
        <div class="booking_step step_bg_arrow" style="margin-top:11px;">
            <span class="font18 bold gray">1:{l s='Search'}</span>
        </div>
        <div class="booking_step step_bg_arrow" style="margin-top:11px;">
            <span class="font18 bold gray">2:{l s='Result'}</span>
        </div>
        <div class="booking_step step_bg_arrow" style="margin-top:11px;">
            <span class="font18 bold gray">3:{l s='Reservation'}</span>
        </div>
        <div class="booking_step step_bg_arrow" style="margin-top:11px;">
            <span class="font18 bold gray">4:{l s='Check'}</span>
        </div>
        <div class="booking_step" style="margin-top:11px;">
            <span class="font18 bold">5:{l s='End'}</span>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- booking step end -->
    <div class="font18" style="margin-top:1px;">
	{l s='Thank You for booking!'}
    </div>
    <!-- booking hotel info start -->
    <!-- booking hotel info start -->
    <div class="orange_border_box" style="margin-top:5px;">
        <div class="content_box">
            <div class="orange_color bold font18 name_title_bg">{$booking_info.hotel_info.HotelName}</div>
            <div class="darkgray" style="padding:10px 0px">
                <p>{l s='Address'}: {$booking_info.hotel_info.HotelAddress}</p>
                <p>{l s='Region'}: {$booking_info.hotel_info.CityName},{$booking_info.hotel_info.AreaName}, {$booking_info.hotel_info.HotelCode}</p>
                <p><span class="left">{l s="class"}:</span><span class="left">{l s=$booking_info.hotel_info.HotelClassName}</span></p>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- booking hotel info end -->

    <!-- booking detail start -->
    <div class="booking_detail">
    {if $method != 'view'}
        <p class="orange_color bold">01. {l s='Checkin'} / {l s='Checkout'} / {l s='Room Info'} / {l s='Guest Info'}</p>
        <p class="darkgray" style="line-height:18px; margin:5px 0;">* {l s='Please Note: For “OK” (instant booking) will be hold Next 30 mins'}.<br />
            &nbsp;&nbsp;  {l s='After this 30mins, room will be released and you will need to once again initiate a search for the room'}.</p>
    {/if}
        <p style="line-height:18px; margin:5px 0;"> {l s='Checkin'} / {l s='Checkout'} : {$booking_info.checkin}-{$booking_info.checkout} ({$booking_info.nights})</p>

        <div class="gray_box">
            <div class="content_box">

                <!-- Room Plan Info 1 start -->
            {foreach from=$booking_info.booked_roomplan_list item=roomplan name=roomplan}
                {assign var="id" value=$smarty.foreach.roomplan.index}
                <input type="hidden" name="ids[]" value="{$id}" />
                <input type="hidden" name="or_ids_{$id}" value="{$roomplan.OrderRoomId}" />
                <input type="hidden" name="roomplan_ids_{$id}" value="{$roomplan.RoomPlanId}" />
                <input type="hidden" name="req_nonsmoking_{$id}" value="{$roomplan.req_nonsmoking}" />
                <input type="hidden" name="req_smoking_{$id}" value="{$roomplan.req_smoking}" />
                <input type="hidden" name="req_adjoin_{$id}" value="{$roomplan.req_adjoin}" />
                <input type="hidden" name="req_remark_{$id}" value="{$roomplan.req_remark}" />
                <div class="left" style="width:100%">
                    <div class="title_bar">Room Type-{$roomplan.RoomPlanName}</div>
                    <table class="yellow" style="margin-top:0px;">
                        <tr>
                            <th valign="top" style="width: 40%">{l s='Room Type'}</th>
                            <td>{l s=$roomplan.RoomTypeName}</td>
                        </tr>
                        {foreach from=$roomplan.customer_info_list item=customer name=customer}

                            <input type="hidden" name="customer_fnames_{$id}[]" value="{$customer.customer_fnames}" />
                            <input type="hidden" name="customer_gnames_{$id}[]" value="{$customer.customer_gnames}" />
                            <input type="hidden" name="customer_sex_{$id}_{$smarty.foreach.customer.index}" value="{$customer.customer_sex}" />
                            <input type="hidden" name="customer_country_{$id}[]" value="{$customer.customer_country}" />

                            {if $smarty.foreach.customer.index == 0}
                                <tr>
                                    <th rowspan="{$roomplan.customer_info_list|@count}" valign="top">{l s='Lodging Info'}</th>
                                    <td>{$customer.customer_country_name} {if $customer.customer_sex == 1}Mr.{else}Ms.{/if}  {$customer.customer_fnames}. {$customer.customer_gnames}</td>
                                </tr>
                                {else}
                                <tr>
                                    <td colspan="2">{$customer.customer_country_name} {if $customer.customer_sex == 1}Mr.{else}Ms.{/if}{$customer.customer_fnames}. {$customer.customer_gnames}</td>
                                </tr>
                            {/if}
                        {/foreach}
                        <tr>
                            <th valign="top">{l s='Breakfast'}</th>
                            <td>{if $roomplan.Breakfast == 1}{l s='Yes'}{else}{l s='None'}{/if}</td>
                        </tr>
                        <tr>
                            <th valign="top">{l s='Price'}</th>
                            <td>{$roomplan.PriceString}</td>
                        </tr><!-- Room Plan Info 1 end -->
                    </table>
                </div>
            {/foreach}
                <div class="left" style="margin-right:5%;width:95%">
                    <div class="title_bar">{l s='Total Price'}</div>
                {$booking_info.TotalPriceString}
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- booking detail end -->

    <div class="booking_detail">
        <div class="orange_color bold" style=" margin-bottom:5px;">02. {l s='Customer Information'}</div>
        <div class="gray_box"><div class="content_box">
            <table class="yellow" style="margin-top:0px;">
            {if $booking_info.BookingNo != ''}
                <tr>
                    <th style="width: 40%">{l s='My Booking No'}</th>
                    <td>{$booking_info.BookingNo}</td>
                </tr>
            {/if}
                <tr>
                    <th style="width: 40%">{l s='Name'}</th>
                    <td>{$booking_info.contact_name}</td>
                </tr>
                <tr>
                    <th>E-mail</th>
                    <td>{$booking_info.contact_email}</td>
                </tr>
                <tr>
                    <th>{l s='Tel'}</th>
                    <td>{$booking_info.contact_tel}</td>
                </tr>
                <tr>
                    <th>{l s='Homepage(optional)'}</th>
                    <td>{$booking_info.contact_hp}</td>
                </tr>
            </table>
        </div></div>
    </div>

</div>
<!-- right content end -->
<div class="clearfix"></div>
