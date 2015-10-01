					{foreach from=$popularList item=item name=item}
                       <div class="pophotel_div" style="width:150px;margin-right:0px;margin-left:7px;">
                       {if $item.HotelFilePath!=""}	
                       	   <div style="width:150px;height:150px;background:#f1f1f1 url({$base_dir}asset/{$item.HotelFilePath}) no-repeat center center;background-size:{$item.w5}px {$item.h5}px;cursor: pointer" onclick="location.href='hotelpage.php?mid={$item.HotelId}'"></div>
                       {else}
                       		<div style="width:150px;height:150px;background:#f1f1f1 url({$img_dir}no_image.png) no-repeat center center;background-size:150px 150px;cursor: pointer" onclick="location.href='hotelpage.php?mid={$item.HotelId}'"></div>
                       {/if}
                           <a href="hotelpage.php?mid={$item.HotelId}">{$item.HotelName}</a><br/>
                           <div class="money_tag">{l s="from JPY"}{displayPrice s=Booking::shoushuliaoByHid($item.LowestPrice,$item.HotelId) nomark=1}{l s="temp"}</div>
                       </div>
                    {/foreach} 