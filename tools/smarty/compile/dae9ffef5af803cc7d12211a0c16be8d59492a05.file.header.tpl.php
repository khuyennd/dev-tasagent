<?php /* Smarty version Smarty-3.0.7, created on 2015-08-06 10:38:38
         compiled from "/var/www/html/themes/default/common/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:62852257652b27b1e05a357-36380855%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dae9ffef5af803cc7d12211a0c16be8d59492a05' => 
    array (
      0 => '/var/www/html/themes/default/common/header.tpl',
      1 => 1438824618,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '62852257652b27b1e05a357-36380855',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/html/tools/smarty/plugins/modifier.escape.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $_smarty_tpl->getVariable('lang_iso')->value;?>
">
	<head>
		<title><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('meta_title')->value,'htmlall','UTF-8');?>
</title>
<?php if (isset($_smarty_tpl->getVariable('meta_description',null,true,false)->value)&&$_smarty_tpl->getVariable('meta_description')->value){?>
		<meta name="description" content="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('meta_description')->value,'html','UTF-8');?>
" />
<?php }?>
<?php if (isset($_smarty_tpl->getVariable('meta_keywords',null,true,false)->value)&&$_smarty_tpl->getVariable('meta_keywords')->value){?>
		<meta name="keywords" content="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('meta_keywords')->value,'html','UTF-8');?>
" />
<?php }?>
		<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
		<meta name="generator" content="TAS" />
		<meta name="robots" content="<?php if (isset($_smarty_tpl->getVariable('nobots',null,true,false)->value)){?>no<?php }?>index,follow" />
		<link type="image/vnd.microsoft.icon" href="/favicon.ico" rel="icon">
		<link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
		<script type="text/javascript">
			var img_dir = '<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
';
			var static_token = '<?php echo $_smarty_tpl->getVariable('static_token')->value;?>
';
			var token = '<?php echo $_smarty_tpl->getVariable('token')->value;?>
';
		</script>
<?php if (isset($_smarty_tpl->getVariable('css_files',null,true,false)->value)){?>
	<?php  $_smarty_tpl->tpl_vars['media'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['css_uri'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('css_files')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['media']->key => $_smarty_tpl->tpl_vars['media']->value){
 $_smarty_tpl->tpl_vars['css_uri']->value = $_smarty_tpl->tpl_vars['media']->key;
?>
	<link href="<?php echo $_smarty_tpl->tpl_vars['css_uri']->value;?>
" rel="stylesheet" type="text/css" media="<?php echo $_smarty_tpl->tpl_vars['media']->value;?>
" />
	<?php }} ?>
<?php }?>
<?php if (isset($_smarty_tpl->getVariable('js_files',null,true,false)->value)){?>
	<?php  $_smarty_tpl->tpl_vars['js_uri'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('js_files')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['js_uri']->key => $_smarty_tpl->tpl_vars['js_uri']->value){
?>
	<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['js_uri']->value;?>
?tm=1214"></script>
	<?php }} ?>
<?php }?>
	<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo $_smarty_tpl->getVariable('js_dir')->value;?>
cal/ipopeng.htm" 
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
	
	<?php if (!$_smarty_tpl->getVariable('content_only')->value){?>
	<body <?php if ($_smarty_tpl->getVariable('page_name')->value){?>id="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('page_name')->value,'htmlall','UTF-8');?>
"<?php }?> style="background-color:#FFF;">
	<div class="layerout">
		
		<div class="header">
	    	<div class="logo">
	    		<a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
logo.jpg" alt="TAS-AGENT" width="254" /></a>				
	        </div>
            <div class="logo_text"><?php echo smartyTranslate(array('s'=>'TAS Agent is online booking system to connect agents and Hotel in Japan'),$_smarty_tpl);?>
</div>			
            <div class="top_language">
                
				<?php if ($_smarty_tpl->getVariable('language')->value!="order"){?>
				<form method="post" action="" id="langFrm">
                <input type="hidden" name="clang" value="1" />
                <select name="languageId" style="width:150px;" onchange="changeLanguage(); return false;" id="languageId">
                    <?php  $_smarty_tpl->tpl_vars['lang_name'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('languages')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['lang_name']->key => $_smarty_tpl->tpl_vars['lang_name']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['lang_name']->key;
?>
                        <option value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['k']->value,'htmlall','UTF-8');?>
" <?php if (($_smarty_tpl->getVariable('sl_lang')->value==$_smarty_tpl->tpl_vars['k']->value)){?> selected="selected" <?php }?>><?php echo smartyTranslate(array('s'=>($_smarty_tpl->tpl_vars['lang_name']->value)),$_smarty_tpl);?>
&nbsp;</option>
                    <?php }} ?>
                </select>
                </form>
				<?php }?>

            </div>
            <div class="top_menu">
                <?php if ($_smarty_tpl->getVariable('cookie')->value->LanguageID==4){?> 
                    <?php echo smartyTranslate(array('s'=>'Hi,'),$_smarty_tpl);?>
<?php echo $_smarty_tpl->getVariable('cookie')->value->Name;?>
<?php echo smartyTranslate(array('s'=>'name_suffix'),$_smarty_tpl);?>

                <?php }else{ ?>
                     <?php echo smartyTranslate(array('s'=>'Hi,'),$_smarty_tpl);?>
<?php echo $_smarty_tpl->getVariable('cookie')->value->Name;?>

                <?php }?>
                &nbsp;|&nbsp;
                <a href="/index.php"><?php echo smartyTranslate(array('s'=>'Top Page'),$_smarty_tpl);?>
</a><span>&nbsp;|&nbsp;</span>
                <a href="/index.php?mylogout"><?php echo smartyTranslate(array('s'=>'Sign Out'),$_smarty_tpl);?>
</a>
				<?php if ($_smarty_tpl->getVariable('cookie')->value->OldLoginUserName!=null){?>
				&nbsp;|&nbsp;
                <a href="/login.php?changeback=1"><?php echo smartyTranslate(array('s'=>'Change Back'),$_smarty_tpl);?>
</a>
                <?php }?>
            </div>  
    	</div>
  		<div class="clearfix"></div>
    	<div class="top_line"></div>
    
		<div class="content_outer">
        	<div class="content">
        	
        	<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./common/left_menu.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
	<?php }?>
	