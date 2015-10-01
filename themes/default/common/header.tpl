{*
* 2012 TAS 
*}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$lang_iso}">
	<head>
		<title>{$meta_title|escape:'htmlall':'UTF-8'}</title>
{if isset($meta_description) AND $meta_description}
		<meta name="description" content="{$meta_description|escape:html:'UTF-8'}" />
{/if}
{if isset($meta_keywords) AND $meta_keywords}
		<meta name="keywords" content="{$meta_keywords|escape:html:'UTF-8'}" />
{/if}
		<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
		<meta name="generator" content="TAS" />
		<meta name="robots" content="{if isset($nobots)}no{/if}index,follow" />
		<link type="image/vnd.microsoft.icon" href="/favicon.ico" rel="icon">
		<link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
		<script type="text/javascript">
			var img_dir = '{$img_dir}';
			var static_token = '{$static_token}';
			var token = '{$token}';
		</script>
{if isset($css_files)}
	{foreach from=$css_files key=css_uri item=media}
	<link href="{$css_uri}" rel="stylesheet" type="text/css" media="{$media}" />
	{/foreach}
{/if}
{if isset($js_files)}
	{foreach from=$js_files item=js_uri}
	<script type="text/javascript" src="{$js_uri}?tm=1214"></script>
	{/foreach}
{/if}
	<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="{$js_dir}cal/ipopeng.htm" 
			scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
	 <script>
    <!--
    $(document).ready(function () {
        $('.brand_navi a:last').addClass("bold");
        $("li a").each(function () {
            if ($(this).html() == $('.brand_navi a:last').html()) {
                $(this).addClass("bold");
            }
        })
    });
		function changeLanguage() {
			$("#langFrm").submit();
			return false;
		}
    //-->
    </script>
	</head>
	
	{if !$content_only}
	<body {if $page_name}id="{$page_name|escape:'htmlall':'UTF-8'}"{/if} style="background-color:#FFF;">
	<div class="layerout">
		
		<div class="header">
	    	<div class="logo">
	    		<a href="{$base_dir}"><img src="{$img_dir}logo.jpg" alt="TAS-AGENT" width="254" /></a>				
	        </div>
            <div class="logo_text">{l s='TAS Agent is online booking system to connect agents and Hotel in Japan'}</div>			
            <div class="top_language">
                
				{if $language != "order"}
				<form method="post" action="" id="langFrm">
                <input type="hidden" name="clang" value="1" />
                <select name="languageId" style="width:150px;" onchange="changeLanguage(); return false;" id="languageId">
                    {foreach from=$languages key=k item=lang_name}
                        <option value="{$k|escape:'htmlall':'UTF-8'}" {if ($sl_lang == $k)} selected="selected" {/if}>{l s="$lang_name"}&nbsp;</option>
                    {/foreach}
                </select>
                </form>
				{/if}

            </div>
            <div class="top_menu">
                {if $cookie->LanguageID ==4} 
                    {l s='Hi,'}{$cookie->Name}{l s='name_suffix'}
                {else}
                     {l s='Hi,'}{$cookie->Name}
                {/if}
                &nbsp;|&nbsp;
                <a href="/tas-agent/index.php">{l s='Top Page'}</a><span>&nbsp;|&nbsp;</span>
                <a href="/tas-agent/index.php?mylogout">{l s='Sign Out'}</a>
				{if $cookie->OldLoginUserName != NULL}
				&nbsp;|&nbsp;
                <a href="/tas-agent/login.php?changeback=1">{l s='Change Back'}</a>
                {/if}
            </div>  
    	</div>
  		<div class="clearfix"></div>
    	<div class="top_line"></div>
    
		<div class="content_outer">
        	<div class="content">
        	
        	{include file="$tpl_dir./common/left_menu.tpl"}
	{/if}
	