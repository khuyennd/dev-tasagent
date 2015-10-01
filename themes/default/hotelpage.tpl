<style>
    #table_roomplan_list tr.sel_tr{
        background-color: #F4F4F4;
    }
    .slide_text {
        background-color: transparent;
        background-color: rgba(0, 0, 0, 0.5);  /* FF3+, Saf3+, Opera 10.10+, Chrome, IE9 */
        bottom: 0;
        color: #fff;
        display: block;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000,endColorstr=#99000000); /* IE6–IE9 */
        left: 0;
        padding: 1em;
        position: absolute;
        width: 94%;
        zoom: 1;
        color: #fff;
        font-size: 20px;
        text-transform: uppercase;
    }
    .slide_byline {
        font-size: 0.8em;
        display: block;
    }
</style>
<!-- right content start -->
<div class="left right_content_outer">
<!-- hotel detail info start -->
<div class="hotel_detail_outer">
   <div class="right bold" style="text-align: right">
        {if $cookie->RoleID > 3 || ($cookie->RoleID == 1 && $cookie->HotelID == $mid)}
            {include file="$tpl_dir./common/sub_menu.tpl"}
        {/if}
    </div>
    <div class="left detail_right_div" style="margin-top: 20px">
        <div class="left hotel_basic_info">
            <p>
                <span  class="bold font18">{$hotel->HotelName}</span>
                {if $number_star == 0}
                    <span style="color:#cc0000;padding-left:20px;">{l s=$hotel->HotelClassName}</span>
                {else}
                    <span class="hotel-icon-star">
                    {for $i=0 to $number_star}
                        <i class="fa fa-star"></i>
                    {/for}
                    </span>
                    {if {$isOnsen} == 1}
                        (Onsen) 
                    {elseif {$isResort} == 1}
                        (Resort)
                    {/if}
                {/if}
            </p>
            <p>{l s='Address'}: {$hotel->HotelAddress}&nbsp;&nbsp;&nbsp;
                <a href="javascript:showMap('{$hotel->HotelName}', '{$hotel->HotelAddress_jp}');" class="blue bold">({l s='show on map'})</a>
            </p>
            <p>{l s='Contact No'}: {$hotel->HotelContactNo}</p>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
</div>


{*slideshow image of hotel*}
{if {$photoCount} > 0}
    <div style="width:100%; margin-bottom: 20px">
        <div class="article-slide-container">
            <div id="article-slider">
                <ul class="slides">
                    {foreach from=$photoList item=item name=item}
                        <li>
                            <center><img class="img-responsive" src="{$base_dir}asset/{$item.w2_opath}"/></center>
                            <a class="fancybox-thumb" rel="article-image" href="{$base_dir}asset/{$item.w2_opath}" title="hotel1.png">
                                <i class="fa fa-search-plus"></i>
                            </a>
                            <div class="slide_text">
                                <div class="slide_byline">{$item.HotelFileName}</div>
                            </div>
                        </li>
                    {/foreach}

                </ul>
            </div>

            <div id="article-carousel">
                <ul class="slides">
                    {foreach from=$photoList item=item name=item}
                        <li>
                            <img class="img-responsive" src="{$base_dir}asset/{$item.w2_opath}" />
                        </li>
                    {/foreach}
                </ul>
            </div>
        </div>
    </div>
{/if}

{if (($cookie->RoleID == 1 && $cookie->HotelID == $mid) || ($cookie->RoleID == 4 || $cookie->RoleID == 5))}
    <!-- hotel user -->
    <div style="width:200px;float:left;"><p class="orange_color font14 bold">{l s='Room Plan'}</p></div>

    <div style="clear: both" > </div>
    <div class="all_border available_room_div" style="padding-bottom:20px;">
        <table cellpadding="0" cellspacing="0" id="table_roomplan_list">
            <thead>
            <tr>
                <th></th>
                <th></th>
                <th>{l s='Room Plan Name'}</th>
                <th>{l s='Room Type'}</th>
                <th>{l s='Max'}</th>
                <th>{l s='Meal'}</th>
                {if (($cookie->RoleID == 1 && $cookie->HotelID == $mid) || ($cookie->RoleID == 4 || $cookie->RoleID == 5))}
                {else}
                    <th>{l s='Price'}</th>
                {/if}
            </tr>
            </thead>
            <tbody>
            {include file="{$tpl_dir}./hotelpage_roomplan_list.tpl" hotel_roomplan_list=$hotel_roomplan_list}
            </tbody>
        </table>
        <!--
        <div class="right hotel_booking_btn"><input type="button" class="button orange" alt="booking" value="booking"/></div>
        <div class="clearfix"></div>
        -->
    </div>
{else}
    <!-- agent or admin user -->
    <!-- hotel detail info end -->
    <form method="post" action="hotelpage.php?mid={$mid}" name="searchFrm" id="searchFrm" onsubmit="return onsubmit_search_hotelplan_frm()">
        <input type="hidden" name="search" value="1" />
        <input type="hidden" id="p" name="p" value="{$p}" />
        <input type="hidden" id="n" name="n" value="{$n}" />
        <input type="hidden" id="SortBy" name="SortBy" value="{$searchForm.SortBy}" />
        <input type="hidden" id="SortOrder" name="SortOrder" value="{$searchForm.SortOrder}" />
        <!-- search conditon start -->
        <div class="srch_condition_div">
            <div class="srch_con">
                <label>{l s='Checkin'}/{l s='Checkout'}</label>
                <input type="text" value="{$search_form.CheckIn}" readonly="readonly" style="float:left;" name="CheckIn" id="CheckIn"  />
                <img src="{$img_dir}calendar_icon.jpg" alt="" width="13" class="calendar_icon" onclick="if(self.gfPop)gfPop.fPopCalendar(getById('CheckIn'), 'OnChangeStartDate(\'CheckIn\',\'CheckOut\', \'Nights\',{if (($cookie->RoleID == 2 || $cookie->RoleID == 3) && $cookie->OldLoginUserName == NULL)}1{else}0{/if})');" />
                <select style="float:left; margin-left:5px;" name="Nights" id="Nights" onchange="javascript:OnChangeStartDate('CheckIn','CheckOut', 'Nights', {if (($cookie->RoleID == 2 || $cookie->RoleID == 3) && $cookie->OldLoginUserName == NULL)}1{else}0{/if});return false;">
                    <option value='0'>-</option>
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

            <div class="srch_btn">
                <input type="submit" name="search" value="{l s='Search Now'}"   class="button orange" alt="{l s='search now'}"/>
            </div>
        </div>
        <!-- search conditon end -->
    </form>
    <!-- Information start -->
    <form action="booking_order.php" method="post" id="frm_{$mid}" onsubmit="return onsubmit_booking_room('frm_{$mid}')">
        <input type="hidden" name="checkin" value="{$search_form.CheckIn}" />
        <input type="hidden" name="checkout" value="{$search_form.CheckOut}" />
        <input type="hidden" name="hotel_id" value="{$mid}" >
        <input type="hidden" name="booking" value="order" />
        <p class="orange_color font14 bold" style="margin-top:20px;">{l s='Available booking plan'}<span class="darkgray">  {l s='for'}: {l s='Checkin'} {$search_form.CheckIn|date_format:"%-Y-%m-%d"} - {l s='Checkout'} {$search_form.CheckOut|date_format:"%-Y-%m-%d"} ({$search_form.Nights} {l s='night(s)'})</span></p>
        <!-- search result —— available_room start -->
        {foreach from=$hotel_roomplan_list item=hotel_item name=hotel_item}
            <div class="all_border available_room_div">
                <table cellpadding="0" cellspacing="0">
                    <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>{l s='Room Name'}</th>
                        <th>{l s='Room Type'}</th>
                        <th>{l s='Max'}</th>
                        <th>{l s='Meal'}</th>
                        <th>{l s='Price'}</th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach from=$hotel_item.RoomPlanList item=roomplan name="roomplan"}
                        <tr>
                            <td class="td_checkbox">{if ($cookie->RoleID >= 4)}{$smarty.foreach.roomplan.index + 1}{else}<input type="checkbox" name="plan_id_amount[]" value="{$roomplan.RoomPlanId}_{$search_form.RoomTypeVals[$roomplan.RoomTypeId]}" />{/if}</td>
                            <td class="td_room_img"><img src="roomfile.php?rpid={$roomplan.RoomPlanId}" alt="" width="100" /></td>
                            <td style="text-align: left; padding-left: 50px">
                                {if $roomplan.MinAmount >= $search_form.RoomTypeVals[$roomplan.RoomTypeId]}
                                    <input type="button" class="ok_btn" value='{l s="OK"}' width="30" />
                                {else}
                                    <input type="button" class="rq_btn" value='{l s="RQ"}' width="30" />
                                {/if}
                                <a href="javascript;" onclick="onclick_roomplan_view({$roomplan.RoomPlanId});return false">{$roomplan.RoomPlanName}</a> {if $roomplan.UseCon == 1}<a href="javascript;" onclick="onclick_roomplan_sales({$roomplan.RoomPlanId});return false;"><img src="{$img_dir}sale_icon.png"/></a>{/if}</td>
                            <td>{l s=$roomplan.RoomTypeName}</td>
                            <td>{$roomplan.RoomMaxPersons}{l s='Pax'}</td>
                            <td>B: {if $roomplan.Breakfast == 1}{l s='Include'}{else}{l s='None'}{/if}<br />D: {if $roomplan.Dinner == 1}{l s='Include'}{else}{l s='None'}{/if}</td>
                            {if $cookie->RoleID == 1}
                                <td>￥ {$roomplan.MinPrice|number_format:0:".":","}</td>
                            {else}
                                <td>￥ {Booking::shoushuliao($roomplan.MinPrice,$roomplan.RoomPlanId)|number_format:0:".":","}</td>
                            {/if}
                        </tr>
                    {/foreach}
                    <!--
                           <tr>
                                <td><input type="checkbox" /></td>
                               <td><img src="{$img_dir}bookinglist_img.jpg" alt="" /></td>
                               <td class="tb_rq_icon">Single Room</td>
                               <td>Single Room</td>
                               <td>1Pax</td>
                               <td>B: Include<br />D: None</td>
                               <td>JPY  4,200</td>
                           </tr>
                           <tr>
                            <td><input type="checkbox" /></td>
                               <td><img src="{$img_dir}bookinglist_img.jpg" alt="" /></td>
                               <td class="tb_rq_icon">Single Room</td>
                               <td>Single Room</td>
                               <td>1Pax</td>
                               <td>B: {if $roomplan.Breakfast == 1}{l s='Include'}{else}{l s='None'}{/if}<br />D: {if $roomplan.Dinner == 1}{l s='Include'}{else}{l s='None'}{/if}</td>
                               <td>JPY  4,200</td>
                           </tr>
                           -->
                    </tbody>
                </table>
                {if ($cookie->RoleID == 2 || $cookie->RoleID == 3)}
                    <div class="right hotel_booking_btn"><input type="submit" name="search" value="{l s='Booking'}" class="button orange" alt="{l s='Booking'}"/></div>
                {/if}
                <div class="clearfix"></div>
            </div>
        {/foreach}
        <!-- search result —— available_room end -->
    </form>
{/if}


<!-- Hotel Features list start -->
<p class="orange_color font14 bold" style="margin-top:20px;float:left;">{l s='Hotel Features'}</p>
<div class="clearfix"></div>
<div class="all_border hotel_features_list">
    {foreach from=$featureList item=item name=item}
        {if $item.LinkId > 0}
            <span class="hotelpage-features">{$item.FeatureName}</span>
        {/if}
    {/foreach}
</div>
<!-- Hotel Features list end -->

<!-- Hotel Detail Information start -->
<div class="hotel_deinfo_div">
    <div class="hotel_description">
        <div class="hotel_deinfo_title" onclick="showapp('hoteldes','hoteldes_detail')"><h4 class="unfold" id="hoteldes">{l s='Hotel Description'}</h4></div>
        <div class="show detail_info" id="hoteldes_detail">
            <textarea style="width:96%;height:100px;padding:2%;border:none;" name="HotelDescription">{$hotel->HotelDescription}</textarea>
        </div>
    </div>

    <div class="hotel_policy">
        <div class="hotel_deinfo_title" onclick="showapp('hotelpol','hotelpol_detail')"><h4 class="fold" id="hotelpol">{l s='Hotel Policies'}</h4></div>
        <div class="hidden detail_info" id="hotelpol_detail">
            <textarea style="width:96%;height:100px;padding:2%;border:none;" name="hotel_policy">{$hotel->HotelPolicies}</textarea>
        </div>
    </div>

    <div class="hotel_useinfo">
        <div class="hotel_deinfo_title" onclick="showapp('usefulinfo','usefulinfo_detail')"><h4 class="fold" id="usefulinfo">{l s='Useful Information'}</h4></div>
        <div class="hidden detail_info" id="usefulinfo_detail" style="border-bottom:1px solid #CCC;">
            <textarea style="width:96%;height:100px;padding:2%;border:none;" name="hotel_useinfo">{$hotel->UsefulInformation}</textarea>
        </div>
    </div>

</div>
<!-- Hotel Detail Information end -->
{if $cookie->RoleID == 3 || $cookie->RoleID == 2}
    <!-- Pop Hotel Recommend start -->
    <p class="orange_color font14 bold" style="margin-top:20px;">{l s='Similar Hotel'}</p>
    <a  style="float:right; text-decoration: underline; color: #C00; margin-top:10px; font-size:14px;"></a>
    <div class="left all_border home_hotel_div">
        <div class="pophotel_outer">
            {foreach from=$similarList item=item name=item}
                <div class="pophotel_div" style="width:145px;margin-right:0px;margin-left:6px;">
                    {if $item.HotelFilePath!=""}
                        <div style="width:145px;height:145px;background:#f1f1f1 url({$base_dir}asset/{$item.HotelFilePath}) no-repeat center center;background-size:{$item.w5}px {$item.h5}px;cursor: pointer" onclick="location.href='hotelpage.php?mid={$item.HotelId}'"></div>
                    {else}
                        <div style="width:145px;height:145px;background:#f1f1f1 url({$img_dir}no_image.png) no-repeat center center;background-size:145px 145px;cursor: pointer" onclick="location.href='hotelpage.php?mid={$item.HotelId}'" ></div>
                    {/if}
                    <span class="darkred bold">[{$item.AreaName}]</span>
                    <p style="padding-left:0px;"><a href="hotelpage.php?mid={$item.HotelId}">{$item.HotelName}</a></p>
                    <p class="money_tag">{displayPrice s=$item.LowestPrice nomark=1}</p>
                </div>
            {/foreach}
        </div>
    </div>
{/if}
<div class="clearfix"></div>
<!-- Pop Hotel Recommend end -->

<!-- Information end -->
</div>
<!-- right content end -->
<div class="clearfix"></div>


<!--Article Gallery with Thumbs Modal View Adding-->
<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox-thumb").fancybox({
            prevEffect  : 'fade',
            nextEffect  : 'fade',
            margin: 5,
            padding: [40,15,15,15],

            helpers : {
                title : null,
                overlay: {
                    locked: true
                },
                thumbs  : {
                    width : 100,
                    height  : 55
                }
            }
        });
    });
</script>

<!--Modal Report Opening-->
<script type="text/javascript">
    $(document).ready(function() {
        $("#modal-s-link").fancybox({
            parent: ".black-lightbox",
            helpers: {
                title : {
                    type : 'float'
                },
                overlay : {
                    locked : false // try changing to true and scrolling around the page
                }
            },
            autoCenter : true
        });
    });
</script>
<!--Article Slider and Carousel-->
<script>
    $(window).load(function() {
        $('#article-carousel').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 100,
            itemMargin: 10,
            asNavFor: '#article-slider'
        });

        $('#article-slider').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            useCSS : false,
            sync: "#article-carousel"
        });
    });
</script>

{include file="$tpl_dir./roomplan_popup.tpl"}
<script src="themes/default/js/jquery.tablednd.0.7.min.js"></script>
<script>
    <!--

    function onsubmit_search_hotelplan_frm()
    {
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

        return true;
    }
    function onsubmit_booking_room(frmId)
    {
        if ($('#' + frmId + ' input:checked').length == 0)
        {
            alert('{l s='Please select room'}!');
            return false;
        }
    }

    function set_roomplan_dragdrop()
    {

        $("#table_roomplan_list").tableDnD({
            onDrop: function(table, row) {
                // console.log(row.id);
                // console.log($(row).html());
                var rows = table.tBodies[0].rows;
                var id_order = '';
                for(var i = 0; i < rows.length; i++)
                {
                    id_order += rows[i].id + ",";
                }

                console.log('new order :' + id_order);

                $('#table_roomplan_list tbody').load('hotelpage.php?mid={$mid}&setOrder=1', { 'orderList': id_order }, function(){
                    set_roomplan_dragdrop();
                });
            },
            onDragStart: function(table, row){
                // console.log(row.id);
            },
            onDragClass: "sel_tr"
        });
    }

    $(document).ready(function() {
        set_roomplan_dragdrop();
    });
    // -->
</script>

<!--popup_win start -->
<div class="popup_win_frame" id="map_popup" style="display:none" >
    <div class="popup_win_view" style="width:650px;height:550px;">
        <div class="title">
            <div class="close_btn"  onclick="closePopup('map_popup'); return false;"></div>
            {l s='Map View'}
        </div>
        <div class="edit_view" style="margin:0px;">
            <div id="map_canvas" class="map rounded" style="width:630px;height:510px;"></div>
        </div>
    </div>
</div>
<!--popup_win end -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
