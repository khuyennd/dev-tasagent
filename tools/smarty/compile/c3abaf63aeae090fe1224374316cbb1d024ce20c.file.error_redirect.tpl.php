<?php /* Smarty version Smarty-3.0.7, created on 2015-04-16 19:59:14
         compiled from "/var/www/html/themes/default/error_redirect.tpl" */ ?>
<?php /*%%SmartyHeaderCode:190917217953b3d1e52b3069-60521555%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c3abaf63aeae090fe1224374316cbb1d024ce20c' => 
    array (
      0 => '/var/www/html/themes/default/error_redirect.tpl',
      1 => 1429176803,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '190917217953b3d1e52b3069-60521555',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<html><body><script>
	<!--
		alert("<?php echo smartyTranslate(array('s'=>$_smarty_tpl->getVariable('error')->value['message']),$_smarty_tpl);?>
");
		history.go(-1);
	// -->
</script></body></html>