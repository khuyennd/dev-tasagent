<?php /* Smarty version Smarty-3.0.7, created on 2015-09-25 09:14:57
         compiled from "/var/www/html/tas-agent/themes/default/error_redirect.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15310318845605109131fd03-30621947%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd2223f3f5ebf5198b131a30b912db4ca1751d188' => 
    array (
      0 => '/var/www/html/tas-agent/themes/default/error_redirect.tpl',
      1 => 1442369375,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15310318845605109131fd03-30621947',
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