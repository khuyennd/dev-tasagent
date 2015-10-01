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
		{*if isset($smarty.server.HTTP_REFERER) && !strstr($request_uri, 'login')}
			<p class="align_right"><a href="{$smarty.server.HTTP_REFERER|escape:'htmlall':'UTF-8'|secureReferrer}" class="button_small" title="{l s='Back'}">&laquo; {l s='Back'}</a></p>
		{/if*}
	</div>
{/if}