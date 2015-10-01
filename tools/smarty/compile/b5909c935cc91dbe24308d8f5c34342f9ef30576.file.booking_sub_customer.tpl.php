<?php /* Smarty version Smarty-3.0.7, created on 2015-09-24 03:40:33
         compiled from "/var/www/html/tas-agent/themes/default/booking_sub_customer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:728901271560370b1606263-88351502%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b5909c935cc91dbe24308d8f5c34342f9ef30576' => 
    array (
      0 => '/var/www/html/tas-agent/themes/default/booking_sub_customer.tpl',
      1 => 1442369379,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '728901271560370b1606263-88351502',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/html/tas-agent/tools/smarty/plugins/modifier.escape.php';
?><?php  $_smarty_tpl->tpl_vars['customer'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('customers')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['customer']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['customer']->key => $_smarty_tpl->tpl_vars['customer']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['customer']['index']++;
?>
<div class="room_plan_detail">
        	
	<div class="left sextype">
        <label style="text-align: left;font-weight:bold;width: 85px;"><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['customer']['index']==0){?><?php echo smartyTranslate(array('s'=>"Customer Info"),$_smarty_tpl);?>
<?php }else{ ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php }?></label>
        <div class="left gender"><input type="radio" <?php if ($_smarty_tpl->tpl_vars['customer']->value['customer_sex']==1){?>checked="checked"<?php }?> style="width:20px;" name="customer_sex_<?php echo $_smarty_tpl->getVariable('id')->value;?>
_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['customer']['index'];?>
"  value="1" /><?php echo smartyTranslate(array('s'=>'Mr'),$_smarty_tpl);?>
</div>
        <div class="left gender"><input type="radio" <?php if ($_smarty_tpl->tpl_vars['customer']->value['customer_sex']==0){?>checked="checked"<?php }?> style="width:20px;" name="customer_sex_<?php echo $_smarty_tpl->getVariable('id')->value;?>
_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['customer']['index'];?>
"  value="0"  /><?php echo smartyTranslate(array('s'=>'Mrs'),$_smarty_tpl);?>
</div>
        <div class="clearfix"></div>
    </div>
    <div class="left familyname">
        <label><?php echo smartyTranslate(array('s'=>'Family Name'),$_smarty_tpl);?>
</label>
        <input type="text" name="customer_fnames_<?php echo $_smarty_tpl->getVariable('id')->value;?>
[]" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_fnames'];?>
" />
    </div>
    <div class="left givenname">
        <label><?php echo smartyTranslate(array('s'=>'Given Name'),$_smarty_tpl);?>
</label>
        <input type="text" name="customer_gnames_<?php echo $_smarty_tpl->getVariable('id')->value;?>
[]" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_gnames'];?>
" />
    </div>
    <div class="left plan_county">
        <label><?php echo smartyTranslate(array('s'=>'County'),$_smarty_tpl);?>
</label>
        <select name="customer_country_<?php echo $_smarty_tpl->getVariable('id')->value;?>
[]">
        	<?php  $_smarty_tpl->tpl_vars['name'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('countries')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['name']->key => $_smarty_tpl->tpl_vars['name']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['name']->key;
?>
                	<option value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['k']->value,'htmlall','UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['customer']->value['customer_country']==$_smarty_tpl->tpl_vars['k']->value){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
&nbsp;</option>
            <?php }} ?>
        </select>
    </div>
    <div class="clearfix"></div>
</div>
<?php }} ?>
