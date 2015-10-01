<?php /* Smarty version Smarty-3.0.7, created on 2015-08-06 10:38:38
         compiled from "/var/www/html/themes/default/./common/errors_login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:163092933152b27b1e3168d1-17972332%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36ca03555afe30ca68b42d243baf589e057206ce' => 
    array (
      0 => '/var/www/html/themes/default/./common/errors_login.tpl',
      1 => 1438824618,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '163092933152b27b1e3168d1-17972332',
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