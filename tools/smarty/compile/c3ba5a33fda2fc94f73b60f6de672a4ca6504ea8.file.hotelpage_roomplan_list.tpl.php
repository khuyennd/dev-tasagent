<?php /* Smarty version Smarty-3.0.7, created on 2015-09-16 04:45:10
         compiled from "/var/www/html/tas-agent/themes/default/./hotelpage_roomplan_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:139490104655f8f3d6a949a8-88482390%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c3ba5a33fda2fc94f73b60f6de672a4ca6504ea8' => 
    array (
      0 => '/var/www/html/tas-agent/themes/default/./hotelpage_roomplan_list.tpl',
      1 => 1442369378,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '139490104655f8f3d6a949a8-88482390',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php  $_smarty_tpl->tpl_vars['hotel'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('hotel_roomplan_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['hotel']->key => $_smarty_tpl->tpl_vars['hotel']->value){
?>
<?php  $_smarty_tpl->tpl_vars['roomplan'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['hotel']->value['RoomPlanList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['roomplan']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['roomplan']->key => $_smarty_tpl->tpl_vars['roomplan']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['roomplan']['index']++;
?>
<tr id="<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomPlanId'];?>
">
		<td><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['roomplan']['index']+1;?>
</td>
		<td class="td_room_img">
        	<div style="background:url(<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['img_path'];?>
) no-repeat center center;width:100px;height:75px;overflow:hidden;background-size:<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['img_width'];?>
px <?php echo $_smarty_tpl->tpl_vars['roomplan']->value['img_height'];?>
px"></div>
        </td>
   <td><a href="javascript;" onclick="onclick_roomplan_view(<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomPlanId'];?>
);return false"><?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomPlanName'];?>
</a> <?php if ($_smarty_tpl->tpl_vars['roomplan']->value['UseCon']==1){?><a href="javascript;" onclick="onclick_roomplan_sales(<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomPlanId'];?>
);return false;"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
sale_icon.png"/></a><?php }?><?php if ((($_smarty_tpl->getVariable('cookie')->value->RoleID==1&&$_smarty_tpl->getVariable('cookie')->value->HotelID==$_smarty_tpl->getVariable('mid')->value)||($_smarty_tpl->getVariable('cookie')->value->RoleID==4||$_smarty_tpl->getVariable('cookie')->value->RoleID==5))){?><br /><a href="room_stock.php?pno=<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomPlanId'];?>
&&hid=<?php echo $_smarty_tpl->getVariable('mid')->value;?>
"><?php echo smartyTranslate(array('s'=>'Price/Stock Management'),$_smarty_tpl);?>
</a><?php }?></td>
   <td><?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['roomplan']->value['RoomTypeName']),$_smarty_tpl);?>
</td>
   <td><?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomMaxPersons'];?>
<?php echo smartyTranslate(array('s'=>'Pax'),$_smarty_tpl);?>
</td>
   <td>B: <?php if ($_smarty_tpl->tpl_vars['roomplan']->value['Breakfast']==1){?><?php echo smartyTranslate(array('s'=>'Include'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'None'),$_smarty_tpl);?>
<?php }?><br />D: <?php if ($_smarty_tpl->tpl_vars['roomplan']->value['Dinner']==1){?><?php echo smartyTranslate(array('s'=>'Include'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'None'),$_smarty_tpl);?>
<?php }?></td>
    <?php if ((($_smarty_tpl->getVariable('cookie')->value->RoleID==1&&$_smarty_tpl->getVariable('cookie')->value->HotelID==$_smarty_tpl->getVariable('mid')->value)||($_smarty_tpl->getVariable('cookie')->value->RoleID==4||$_smarty_tpl->getVariable('cookie')->value->RoleID==5))){?>
    <?php }else{ ?>
   <td>￥<?php echo number_format($_smarty_tpl->tpl_vars['roomplan']->value['MinPrice'],0,".",",");?>
 ~</td>
    <?php }?>
</tr>
<?php }} ?>
<?php }} ?>