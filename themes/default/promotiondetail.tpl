<!-- right content start -->
            <div class="left right_content_outer">
            	<p class="orange_color">{if $data.Type == 0}
                    {l s='Promotion'}
            		{else}
                    {l s='Event'}
            		{/if}
            	</p>
            	<br/>
	<table class="darkgray" style="margin-top:10px;">
		<tr>
			<th style="text-align:left;">{$data.Title}</th>
		</tr>
        <tr>
        	<td style="color:#999;text-align:left;">
            	{l s='Hotel name'}:{$data.HotelName}<br/>
                {l s='Area'}:{$data.AreaName}</br>
                {l s='Period'}:{$data.StaDate} ~ {$data.EndDate}
            </td>
        </tr>
		<tr>
			<td>{$data.Content}</td>
		</tr>
        <tr>
        	<td style="background:#f7f7f7;text-align:right;">{l s="Writer"} : {$data.UserName}</td>
        </tr>
	</table>
    <div class="btns_bar">
    	<input type="button" value="{l s='List'}" onclick="location.href='{$base_dir}promotionlist.php?type={$data.Type}';" class="button orange medium"/>
    </div>
    </div>
            <!-- right content end -->
            <div class="clearfix"></div>
