{$hotel_id = $smarty.get.mid}
{assign var="request_uri" value="{$smarty.server.REQUEST_URI}"}
{if ($request_uri|strstr:"room_stock") && $smarty.get.hid && $smarty.get.hid != 0}
    {$hotel_id = $smarty.get.hid}
{/if}
{if ($request_uri|strstr:"roomplanedit") && $smarty.get.hid && $smarty.get.hid != 0}
    {$hotel_id = $smarty.get.hid}
{/if}
{if ($request_uri|strstr:"auth") && $smarty.get.mid && $smarty.get.mid != 0}
    {$hotel = HotelDetail::getHotelByUserId($smarty.get.mid)}
    {$hotel_id = $hotel['HotelId']}
{/if}

{if $cookie->RoleID == 1}
    {assign var="linkuser" value="auth.php?mid={$cookie->UserID}&mod=self"}
{elseif $cookie->RoleID >3}
    {if ($request_uri|strstr:"auth") && $smarty.get.mid && $smarty.get.mid != 0}
        {assign var="linkuser" value="auth.php?mid={$smarty.get.mid}&prev_page=hotellist"}
    {else}
        {$user_info = Member::getUserInfoByHotelId($hotel_id)}
        {if isset($user_info['UserID'])}
            {assign var="linkuser" value="auth.php?mid={$user_info['UserID']}&prev_page=hotellist"}
        {else}
            {assign var="linkuser" value="auth.php?nohotel=1&hid={$hotel_id}&prev_page=hotellist"}
        {/if}
    {/if}
{/if}

{if ($request_uri|strstr:"hoteldetail") && $cookie->RoleID > 3 && $smarty.get.mid == 0}
{else}
<a href="hotelpage.php?mid={$hotel_id}">{l s='Hotel Home'}</a>/
<a href="hoteldetail.php?mid={$hotel_id}">{l s='Hotel Detail Edit'}</a>/
<a href="roomplanedit.php?hid={$hotel_id}">{l s='Room Plan Edit'}</a>/
<a href="room_stock.php?hid={$hotel_id}">{l s='Room Stock Management'}</a>/
<a href="{$linkuser}">{l s='Submenu User Information'}</a>
{/if}
