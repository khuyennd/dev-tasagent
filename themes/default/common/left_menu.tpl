
            <div class="brand_navi">
                <a href="{if $cookie->RoleID == 1}hotelpage.php?mid={$cookie->HotelID}{else}index.php{/if}">{l s='HOME'}</a>
                {foreach from=$brandNavi item=brand}
                	<span class="gray">&nbsp;&nbsp;&gt;&nbsp;</span>
                	<a href="{$brand.url}">{if !$brand.nolang}{l s=$brand.name}{else}{$brand.name}{/if}</a>
                {/foreach}
            </div>
            <!-- left navigation start -->
            <div class="left left_navi">
                <div class="sub_navi_outer orange_border">
                    <p class="navi_title">{l s='My Page'}</p>
                    <ul>
                    	<li ><a href="{if $cookie->RoleID == 1}hotelpage.php?mid={$cookie->HotelID}{else}index.php{/if}">{l s='HOME'}</a></li>
                    	{if Tools::HasFunction('booking_list')} 
                    	<li><a href="booking_list.php">{l s='Booking List'}</a></li>
                    	{/if}
                    	{if Tools::HasFunction('settle_list')} 
                    	<li><a href="booking_list.php?settle=1">{l s='Settlement'}</a></li>
                    	{/if}
                    	{if $cookie->RoleID == 1 && Tools::hasFunction('hotel_detail_edit')}
                    		<li><a href="hoteldetail.php?mid={$cookie->HotelID}">{l s='Hotel Detail Edit'}</a></li>
                    	{/if}
                    	{if $cookie->RoleID == 1 && Tools::hasFunction('room_plan_edit')}
                    		<li><a href="roomplanedit.php?hid={$cookie->HotelID}">{l s='Room Plan Edit'}</a></li>
                    	{/if}
                    	{if $cookie->RoleID == 1 && Tools::hasFunction('room_stock')}
                    		<li><a href="room_stock.php">{l s='Room Stock Management'}</a></li>
                    	{/if}
                    	{if Tools::hasFunction('company_info')}
                    		<li><a href="auth.php?mid={$cookie->UserID}&mod=self">{if $cookie->RoleID == 3}{l s='Company Information'}{else}{l s='My Information'}{/if}</a></li>
                    	{/if}
                    	{if Tools::hasFunction('hotel_data_import')}
                    		<li><a href="hoteldataimport.php">{l s='Hotel Data Import'}</a></li>
                    	{/if}
                    	{if Tools::hasFunction('agent_list')}
                    		<li><a href="agentlist.php">{if $cookie->RoleID > 3}{l s='Agent List'}{else}{l s='User Management'}{/if}</a></li>
                    	{/if}
                    	{if Tools::hasFunction('hotel_list')}
                    		<li><a href="hotellist.php">{l s='Hotel List'}</a></li>
                    	{/if}
                    	{if Tools::hasFunction('admin_list')}
                    		<li><a href="adminlist.php">{l s='Admin List'}</a></li>
                    	{/if}
						{if $cookie->RoleID > 3}
                    		<li><a href="hoteldetail.php?mid=0">{l s='Add Hotel'}</a></li>
                    	{/if}
                    	{if Tools::hasFunction('promotion_list')}
                    	<li><a href="promotionlist.php?type=0">{l s='Promotion List'}</a></li>
                    	{/if}
                    	{if Tools::hasFunction('event_list')}
                    	<li><a href="promotionlist.php?type=1">{l s='Event List'}</a></li>
                    	{/if}
                        {if Tools::hasFunction('message')}
                        <li><a href="message.php">{l s='Notices'}</a></li>
                        {/if}
                        {if Tools::hasFunction('popular_area')}
                    		<li><a href="poparea.php">{l s='Popular Area Edit'}</a></li>
                    	{/if}
						{if Tools::hasFunction('feature_manage')}
                    		<li><a href="featuremanage.php">{l s='Hotel Features Edit'}</a></li>
                    	{/if}
						{if Tools::hasFunction('updatePassword')}
                    		<li><a href="updatepassword.php">{l s='Update Password'}</a></li>
                    	{/if}
                    </ul>
                </div>
                {if $cookie->RoleID >1}
                <div class="sub_navi_outer">
                    <p class="navi_title">{l s='Popular Area'}</p>
                    <ul>
                    {foreach from=$popAreaList item=item}
                        <li><a href="searchhotel.php?search=1&SortBy=&SortOrder=&AreaId={$item.AreaId}&CityId=0&CheckIn={if $cookie->RoleID <3}{$CheckInDay}{/if}&Nights=1&CheckOut={if $cookie->RoleID <3}{$CheckOutDay}{/if}&RoomType_1=0&RoomType_2=0&RoomType_3=0&RoomType_4={if $cookie->RoleID >3}0{else}1{/if}&RoomType_5=0&RoomType_6=0&HotelClassId=0&HotelName=&search=%E6%A4%9C%E7%B4%A2">{$item.AreaName}</a></li>
                    {/foreach}
                    </ul>
                </div>
                {/if}
                <!-- 
                <div class="sub_navi_outer">
                    <p class="navi_title">Hotline</p>
                    <ul>
                        <li>Shinjyuku</li>
                        <li>Sibuya</li>
                        <li>Company information</li>
                        <li>Yokohama</li>
                        <li>Kyoto</li>
                    </ul>
                </div>
                 -->

                <div id="weather"></div>
            </div>
            <!-- left navigation end -->


<!-- Author: quyennd
Description: display weather -->
{assign var="request_uri" value="{$smarty.server.REQUEST_URI}"}
{if $request_uri|strstr:"hoteldetail" || $request_uri|strstr:"hotelpage"}
    {assign var="mid" value="{$smarty.get.mid}"}
    {$hotel = HotelDetail::getHotelDescription($mid)}
    {$cityName = HotelDetail::getCityName($hotel['HotelCity'])}
{else}
    {$cityName = 'Tokyo'}
{/if}
<!-- left navigation end -->

<!-- include flatWeatherPlugin.js -->
<script src="themes/default/js/jquery.flatWeatherPlugin.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var example3 = $("#weather").flatWeatherPlugin({
            location: " {$cityName}",
            country: "Japan",
            api: "yahoo",
            displayCityNameOnly : false,
            view : "today",
            units: "metric"
        });
    });
</script>
<!-- end display weather -->


            
                