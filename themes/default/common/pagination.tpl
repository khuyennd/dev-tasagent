{*
* 2012 TAS 
*}

{if isset($p) AND $p}

	<!-- Pagination -->
	<div class="right page_control_div">
	{if $start!=$stop}
		<p class="left page_num">
		{if $p != 1}
			{assign var='p_previous' value=$p-1}
			<span onclick="setPage({$p_previous}); return false;">&laquo;</span>
		{else}
			<span class="disabled">&laquo;</span>
		{/if}
		{if $start>3}
			<span onclick="setPage(1); return false;" >1</span>
			<span class="truncate">...</span>
		{/if}
		{section name=pagination start=$start loop=$stop+1 step=1}
			{if $p == $smarty.section.pagination.index}
				<span class="num_selected">{$p|escape:'htmlall':'UTF-8'}</span>
			{else}
				<span onclick="setPage({$smarty.section.pagination.index}); return false;">{$smarty.section.pagination.index|escape:'htmlall':'UTF-8'}</span>
			{/if}
		{/section}
		{if $pages_nb>$stop+2}
			<span class="truncate">...</span>
			<span onclick="setPage({$pages_nb}); return false;">{$pages_nb|intval}</span>
		{/if}
		{if $pages_nb > 1 AND $p != $pages_nb}
			{assign var='p_next' value=$p+1}
			<span id="pagination_next" onclick="setPage({$p_next}); return false;">&raquo;</span>
		{else}
			<span class="disabled">&raquo;</span>
		{/if}
		</p>
	{/if}
		
			<p class="left page_num_in">
				<select  id="nb_item">
				{assign var="lastnValue" value="0"}
				{foreach from=$nArray item=nValue}
					{if $lastnValue <= $nb_products}
						<option value="{$nValue|escape:'htmlall':'UTF-8'}" {if $n == $nValue}selected="selected"{/if}>{$nValue|escape:'htmlall':'UTF-8'}</option>
					{/if}
					{assign var="lastnValue" value=$nValue}
				{/foreach}
				</select>
				{if is_array($requestNb)}
					{foreach from=$requestNb item=requestValue key=requestKey}
						{if $requestKey != 'requestUrl'}
							<input type="hidden" name="{$requestKey|escape:'htmlall':'UTF-8'}" value="{$requestValue|escape:'htmlall':'UTF-8'}" />
						{/if}
					{/foreach}
				{/if}
				<!--<input type="button" class="button orange medium" onclick="setRowNum(); return false;" value="{l s='OK'}"/> -->
			</p>
		
	</div>
	<!-- /Pagination -->
{/if}
