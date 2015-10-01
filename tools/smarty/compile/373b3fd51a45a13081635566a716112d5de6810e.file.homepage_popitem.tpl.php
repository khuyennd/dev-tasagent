<?php /* Smarty version Smarty-3.0.7, created on 2015-09-07 13:14:13
         compiled from "/var/www/tas/themes/default/homepage_popitem.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8501550955ed2b358268c7-02734148%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '373b3fd51a45a13081635566a716112d5de6810e' => 
    array (
      0 => '/var/www/tas/themes/default/homepage_popitem.tpl',
      1 => 1441591119,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8501550955ed2b358268c7-02734148',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('popularList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
                       <div class="pophotel_div" style="width:150px;margin-right:0px;margin-left:7px;">
                       <?php if ($_smarty_tpl->tpl_vars['item']->value['HotelFilePath']!=''){?>	
                       	   <div style="width:150px;height:150px;background:#f1f1f1 url(<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
asset/<?php echo $_smarty_tpl->tpl_vars['item']->value['HotelFilePath'];?>
) no-repeat center center;background-size:<?php echo $_smarty_tpl->tpl_vars['item']->value['w5'];?>
px <?php echo $_smarty_tpl->tpl_vars['item']->value['h5'];?>
px;cursor: pointer" onclick="location.href='hotelpage.php?mid=<?php echo $_smarty_tpl->tpl_vars['item']->value['HotelId'];?>
'"></div>
                       <?php }else{ ?>
                       		<div style="width:150px;height:150px;background:#f1f1f1 url(<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
no_image.png) no-repeat center center;background-size:150px 150px;cursor: pointer" onclick="location.href='hotelpage.php?mid=<?php echo $_smarty_tpl->tpl_vars['item']->value['HotelId'];?>
'"></div>
                       <?php }?>
                           <a href="hotelpage.php?mid=<?php echo $_smarty_tpl->tpl_vars['item']->value['HotelId'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['HotelName'];?>
</a><br/>
                           <div class="money_tag"><?php echo smartyTranslate(array('s'=>"from JPY"),$_smarty_tpl);?>
<?php echo displayPriceSmarty(array('s'=>Booking::shoushuliaoByHid($_smarty_tpl->tpl_vars['item']->value['LowestPrice'],$_smarty_tpl->tpl_vars['item']->value['HotelId']),'nomark'=>1),$_smarty_tpl);?>
<?php echo smartyTranslate(array('s'=>"temp"),$_smarty_tpl);?>
</div>
                       </div>
                    <?php }} ?> 