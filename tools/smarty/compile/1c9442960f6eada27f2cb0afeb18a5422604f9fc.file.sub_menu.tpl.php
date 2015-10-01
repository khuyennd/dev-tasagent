<?php /* Smarty version Smarty-3.0.7, created on 2015-10-01 03:18:06
         compiled from "/var/www/html/tas-agent/themes/default/./common/sub_menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:695753767560ca5ee4b3ce3-07766809%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c9442960f6eada27f2cb0afeb18a5422604f9fc' => 
    array (
      0 => '/var/www/html/tas-agent/themes/default/./common/sub_menu.tpl',
      1 => 1443668962,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '695753767560ca5ee4b3ce3-07766809',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_smarty_tpl->tpl_vars['hotel_id'] = new Smarty_variable($_GET['mid'], null, null);?>
<?php $_smarty_tpl->tpl_vars["request_uri"] = new Smarty_variable(($_SERVER['REQUEST_URI']), null, null);?>
<?php if ((strstr($_smarty_tpl->getVariable('request_uri')->value,"room_stock"))&&$_GET['hid']&&$_GET['hid']!=0){?>
    <?php $_smarty_tpl->tpl_vars['hotel_id'] = new Smarty_variable($_GET['hid'], null, null);?>
<?php }?>
<?php if ((strstr($_smarty_tpl->getVariable('request_uri')->value,"roomplanedit"))&&$_GET['hid']&&$_GET['hid']!=0){?>
    <?php $_smarty_tpl->tpl_vars['hotel_id'] = new Smarty_variable($_GET['hid'], null, null);?>
<?php }?>
<?php if ((strstr($_smarty_tpl->getVariable('request_uri')->value,"auth"))&&$_GET['mid']&&$_GET['mid']!=0){?>
    <?php $_smarty_tpl->tpl_vars['hotel'] = new Smarty_variable(HotelDetail::getHotelByUserId($_GET['mid']), null, null);?>
    <?php $_smarty_tpl->tpl_vars['hotel_id'] = new Smarty_variable($_smarty_tpl->getVariable('hotel')->value['HotelId'], null, null);?>
<?php }?>

<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID==1){?>
    <?php $_smarty_tpl->tpl_vars["linkuser"] = new Smarty_variable("auth.php?mid=".($_smarty_tpl->getVariable('cookie')->value->UserID)."&mod=self", null, null);?>
<?php }elseif($_smarty_tpl->getVariable('cookie')->value->RoleID>3){?>
    <?php if ((strstr($_smarty_tpl->getVariable('request_uri')->value,"auth"))&&$_GET['mid']&&$_GET['mid']!=0){?>
        <?php $_smarty_tpl->tpl_vars["linkuser"] = new Smarty_variable("auth.php?mid=".($_GET['mid'])."&prev_page=hotellist", null, null);?>
    <?php }else{ ?>
        <?php $_smarty_tpl->tpl_vars['user_info'] = new Smarty_variable(Member::getUserInfoByHotelId($_smarty_tpl->getVariable('hotel_id')->value), null, null);?>
        <?php if (isset($_smarty_tpl->getVariable('user_info',null,true,false)->value['UserID'])){?>
            <?php $_smarty_tpl->tpl_vars["linkuser"] = new Smarty_variable("auth.php?mid=".($_smarty_tpl->getVariable('user_info')->value['UserID'])."&prev_page=hotellist", null, null);?>
        <?php }else{ ?>
            <?php $_smarty_tpl->tpl_vars["linkuser"] = new Smarty_variable("auth.php?nohotel=1&hid=".($_smarty_tpl->getVariable('hotel_id')->value)."&prev_page=hotellist", null, null);?>
        <?php }?>
    <?php }?>
<?php }?>

<?php if ((strstr($_smarty_tpl->getVariable('request_uri')->value,"hoteldetail"))&&$_smarty_tpl->getVariable('cookie')->value->RoleID>3&&$_GET['mid']==0){?>
<?php }else{ ?>
<a href="hotelpage.php?mid=<?php echo $_smarty_tpl->getVariable('hotel_id')->value;?>
"><?php echo smartyTranslate(array('s'=>'Hotel Home'),$_smarty_tpl);?>
</a>/
<a href="hoteldetail.php?mid=<?php echo $_smarty_tpl->getVariable('hotel_id')->value;?>
"><?php echo smartyTranslate(array('s'=>'Hotel Detail Edit'),$_smarty_tpl);?>
</a>/
<a href="roomplanedit.php?hid=<?php echo $_smarty_tpl->getVariable('hotel_id')->value;?>
"><?php echo smartyTranslate(array('s'=>'Room Plan Edit'),$_smarty_tpl);?>
</a>/
<a href="room_stock.php?hid=<?php echo $_smarty_tpl->getVariable('hotel_id')->value;?>
"><?php echo smartyTranslate(array('s'=>'Room Stock Management'),$_smarty_tpl);?>
</a>/
<a href="<?php echo $_smarty_tpl->getVariable('linkuser')->value;?>
"><?php echo smartyTranslate(array('s'=>'Submenu User Information'),$_smarty_tpl);?>
</a>
<?php }?>
