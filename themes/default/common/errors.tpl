{*
* 2012 TAS 
*}

{if isset($errors) && $errors}
	<div class="error">
		<ol>
		{foreach from=$errors key=k item=error}
			<li>{l s=$error}</li>
		{/foreach}
		</ol>
	</div>
{/if}