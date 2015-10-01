<?php /* Smarty version Smarty-3.0.7, created on 2015-09-07 15:26:40
         compiled from "/var/www/tas/themes/default/./common/errors.tpl" */ ?>
<?php /*%%SmartyHeaderCode:102733694655ed4a40b59928-40081396%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3d3d064eccf757dc9c8c9372614c348e2c8959b0' => 
    array (
      0 => '/var/www/tas/themes/default/./common/errors.tpl',
      1 => 1441591125,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '102733694655ed4a40b59928-40081396',
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