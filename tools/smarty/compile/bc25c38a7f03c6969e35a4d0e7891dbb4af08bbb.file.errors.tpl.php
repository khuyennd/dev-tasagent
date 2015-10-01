<?php /* Smarty version Smarty-3.0.7, created on 2015-09-16 04:08:46
         compiled from "/var/www/html/tas-agent/themes/default/./common/errors.tpl" */ ?>
<?php /*%%SmartyHeaderCode:115829691555f8eb4eefeeb0-29975254%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bc25c38a7f03c6969e35a4d0e7891dbb4af08bbb' => 
    array (
      0 => '/var/www/html/tas-agent/themes/default/./common/errors.tpl',
      1 => 1442369419,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '115829691555f8eb4eefeeb0-29975254',
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