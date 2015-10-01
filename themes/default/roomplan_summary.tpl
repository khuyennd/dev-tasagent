<body style="background-color:#EBEBEB;">
	<table class="yellow" style="margin-top:0px;">
    	<tr>
        	<th>{l s='Room name'}</th>
            <td>{$roomplan_summary['RoomPlanName']}</td>
        </tr>
        <tr>
        	<th>{l s='photos'}</th>
            <td>
            	<!--{count($roomplan_summary['RelImages'])}-->
                {foreach from=$roomplan_summary['RelImages'] item=relimage}
                	 <div style="background:url({$relimage.img_path}) no-repeat center center;width:100px;height:75px;overflow:hidden;background-size:{$relimage.img_width}px {$relimage.img_height}px;margin-right:10px;float:left"></div> 
                {/foreach}
            </td>
        </tr>
        {if $price > 0}
        <tr>
            <th>{l s='Room Price'}</th>
            <td>￥{$price|number_format:0:".":", "}</td>
        </tr>
        {/if}
        <tr>
        	<th>{l s='Room size'}</th>
            <td>{$roomplan_summary['RoomSize']}</td>
        </tr>
        <tr>
        	<th>{l s='Descriptions'}</th>
            <td>{$roomplan_summary['RoomPlanDescription']}</td>
        </tr>
    </table>
</body>
