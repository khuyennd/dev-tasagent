{foreach from=$hotel_roomplan_list item=hotel name=hotel}
{foreach from=$hotel.RoomPlanList item=roomplan name=roomplan}
<tr id="{$roomplan.RoomPlanId}">
		<td>{$smarty.foreach.roomplan.index + 1}</td>
		<td class="td_room_img">
        	<div style="background:url({$roomplan.img_path}) no-repeat center center;width:100px;height:75px;overflow:hidden;background-size:{$roomplan.img_width}px {$roomplan.img_height}px"></div>
        </td>
   <td><a href="javascript;" onclick="onclick_roomplan_view({$roomplan.RoomPlanId});return false">{$roomplan.RoomPlanName}</a> {if $roomplan.UseCon == 1}<a href="javascript;" onclick="onclick_roomplan_sales({$roomplan.RoomPlanId});return false;"><img src="{$img_dir}sale_icon.png"/></a>{/if}{if (($cookie->RoleID == 1 && $cookie->HotelID == $mid) || ($cookie->RoleID == 4 || $cookie->RoleID == 5))}<br /><a href="room_stock.php?pno={$roomplan.RoomPlanId}&&hid={$mid}">{l s='Price/Stock Management'}</a>{/if}</td>
   <td>{l s=$roomplan.RoomTypeName}</td>
   <td>{$roomplan.RoomMaxPersons}{l s='Pax'}</td>
   <td>B: {if $roomplan.Breakfast == 1}{l s='Include'}{else}{l s='None'}{/if}<br />D: {if $roomplan.Dinner == 1}{l s='Include'}{else}{l s='None'}{/if}</td>
    {if (($cookie->RoleID == 1 && $cookie->HotelID == $mid) || ($cookie->RoleID == 4 || $cookie->RoleID == 5))}
    {else}
   <td>￥{$roomplan.MinPrice|number_format:0:".":","} ~</td>
    {/if}
</tr>
{/foreach}
{/foreach}