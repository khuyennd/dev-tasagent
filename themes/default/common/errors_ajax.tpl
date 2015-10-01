{if isset($errors) && $errors}
		{foreach from=$errors key=k item=error}
			{l s=$error}
		{/foreach}
{/if}