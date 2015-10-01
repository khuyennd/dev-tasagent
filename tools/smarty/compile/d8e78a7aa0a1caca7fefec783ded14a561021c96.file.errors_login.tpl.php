<?php /* Smarty version Smarty-3.0.7, created on 2015-09-16 04:00:04
         compiled from "/var/www/html/tas-agent/themes/default/./common/errors_login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:150119200155f8e944afe611-86845540%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd8e78a7aa0a1caca7fefec783ded14a561021c96' => 
    array (
      0 => '/var/www/html/tas-agent/themes/default/./common/errors_login.tpl',
      1 => 1442369420,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150119200155f8e944afe611-86845540',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<?php if (isset($_smarty_tpl->getVariable('errors',null,true,false)->value)&&$_smarty_tpl->getVariable('errors')->value){?>
	<div class="error">
		<ol>
		<?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('errors')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['error']->key;
?>
			<li><?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['error']->value),$_smarty_tpl);?>
</li>
		<?php }} ?>
		</ol>
	</div>
<?php }?>