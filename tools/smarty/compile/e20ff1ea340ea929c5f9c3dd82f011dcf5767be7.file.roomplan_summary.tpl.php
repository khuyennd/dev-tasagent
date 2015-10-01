<?php /* Smarty version Smarty-3.0.7, created on 2015-09-09 14:36:18
         compiled from "/var/www/tas/themes/default/roomplan_summary.tpl" */ ?>
<?php /*%%SmartyHeaderCode:41298532355efe172c17c67-60080678%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e20ff1ea340ea929c5f9c3dd82f011dcf5767be7' => 
    array (
      0 => '/var/www/tas/themes/default/roomplan_summary.tpl',
      1 => 1441591114,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '41298532355efe172c17c67-60080678',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<body style="background-color:#EBEBEB;">
	<table class="yellow" style="margin-top:0px;">
    	<tr>
        	<th><?php echo smartyTranslate(array('s'=>'Room name'),$_smarty_tpl);?>
</th>
            <td><?php echo $_smarty_tpl->getVariable('roomplan_summary')->value['RoomPlanName'];?>
</td>
        </tr>
        <tr>
        	<th><?php echo smartyTranslate(array('s'=>'photos'),$_smarty_tpl);?>
</th>
            <td>
            	<!--<?php echo count($_smarty_tpl->getVariable('roomplan_summary')->value['RelImages']);?>
-->
                <?php  $_smarty_tpl->tpl_vars['relimage'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('roomplan_summary')->value['RelImages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['relimage']->key => $_smarty_tpl->tpl_vars['relimage']->value){
?>
                	 <div style="background:url(<?php echo $_smarty_tpl->tpl_vars['relimage']->value['img_path'];?>
) no-repeat center center;width:100px;height:75px;overflow:hidden;background-size:<?php echo $_smarty_tpl->tpl_vars['relimage']->value['img_width'];?>
px <?php echo $_smarty_tpl->tpl_vars['relimage']->value['img_height'];?>
px;margin-right:10px;float:left"></div> 
                <?php }} ?>
            </td>
        </tr>
        <?php if ($_smarty_tpl->getVariable('price')->value>0){?>
        <tr>
            <th><?php echo smartyTranslate(array('s'=>'Room Price'),$_smarty_tpl);?>
</th>
            <td>￥<?php echo number_format($_smarty_tpl->getVariable('price')->value,0,".",", ");?>
</td>
        </tr>
        <?php }?>
        <tr>
        	<th><?php echo smartyTranslate(array('s'=>'Room size'),$_smarty_tpl);?>
</th>
            <td><?php echo $_smarty_tpl->getVariable('roomplan_summary')->value['RoomSize'];?>
</td>
        </tr>
        <tr>
        	<th><?php echo smartyTranslate(array('s'=>'Descriptions'),$_smarty_tpl);?>
</th>
            <td><?php echo $_smarty_tpl->getVariable('roomplan_summary')->value['RoomPlanDescription'];?>
</td>
        </tr>
    </table>
</body>