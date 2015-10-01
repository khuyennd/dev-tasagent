{foreach from=$customers item=customer name=customer}
<div class="room_plan_detail">
        	
	<div class="left sextype">
        <label style="text-align: left;font-weight:bold;width: 85px;">{if $smarty.foreach.customer.index == 0}{l s="Customer Info"}{else}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{/if}</label>
        <div class="left gender"><input type="radio" {if $customer.customer_sex == 1}checked="checked"{/if} style="width:20px;" name="customer_sex_{$id}_{$smarty.foreach.customer.index}"  value="1" />{l s='Mr'}</div>
        <div class="left gender"><input type="radio" {if $customer.customer_sex == 0}checked="checked"{/if} style="width:20px;" name="customer_sex_{$id}_{$smarty.foreach.customer.index}"  value="0"  />{l s='Mrs'}</div>
        <div class="clearfix"></div>
    </div>
    <div class="left familyname">
        <label>{l s='Family Name'}</label>
        <input type="text" name="customer_fnames_{$id}[]" value="{$customer.customer_fnames}" />
    </div>
    <div class="left givenname">
        <label>{l s='Given Name'}</label>
        <input type="text" name="customer_gnames_{$id}[]" value="{$customer.customer_gnames}" />
    </div>
    <div class="left plan_county">
        <label>{l s='County'}</label>
        <select name="customer_country_{$id}[]">
        	{foreach from=$countries key=k item=name}
                	<option value="{$k|escape:'htmlall':'UTF-8'}" {if $customer.customer_country == $k}selected="selected"{/if}>{$name}&nbsp;</option>
            {/foreach}
        </select>
    </div>
    <div class="clearfix"></div>
</div>
{/foreach}
