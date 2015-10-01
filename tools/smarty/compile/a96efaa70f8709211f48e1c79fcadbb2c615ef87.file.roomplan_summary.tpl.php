<?php /* Smarty version Smarty-3.0.7, created on 2015-08-19 11:46:43
         compiled from "/var/www/html/themes/default/roomplan_summary.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13134521053b3ca51a7da95-23340565%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a96efaa70f8709211f48e1c79fcadbb2c615ef87' => 
    array (
      0 => '/var/www/html/themes/default/roomplan_summary.tpl',
      1 => 1438824618,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13134521053b3ca51a7da95-23340565',
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