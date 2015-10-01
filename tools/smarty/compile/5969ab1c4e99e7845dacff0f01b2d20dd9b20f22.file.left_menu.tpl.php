<?php /* Smarty version Smarty-3.0.7, created on 2015-09-07 13:12:23
         compiled from "/var/www/tas/themes/default/./common/left_menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:161158653455ed2ac7840655-06382455%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5969ab1c4e99e7845dacff0f01b2d20dd9b20f22' => 
    array (
      0 => '/var/www/tas/themes/default/./common/left_menu.tpl',
      1 => 1441591125,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '161158653455ed2ac7840655-06382455',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

            <div class="brand_navi">
                <a href="<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID==1){?>hotelpage.php?mid=<?php echo $_smarty_tpl->getVariable('cookie')->value->HotelID;?>
<?php }else{ ?>index.php<?php }?>"><?php echo smartyTranslate(array('s'=>'HOME'),$_smarty_tpl);?>
</a>
                <?php  $_smarty_tpl->tpl_vars['brand'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('brandNavi')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['brand']->key => $_smarty_tpl->tpl_vars['brand']->value){
?>
                	<span class="gray">&nbsp;&nbsp;&gt;&nbsp;</span>
                	<a href="<?php echo $_smarty_tpl->tpl_vars['brand']->value['url'];?>
"><?php if (!$_smarty_tpl->tpl_vars['brand']->value['nolang']){?><?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['brand']->value['name']),$_smarty_tpl);?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['brand']->value['name'];?>
<?php }?></a>
                <?php }} ?>
            </div>
            <!-- left navigation start -->
            <div class="left left_navi">
                <div class="sub_navi_outer orange_border">
                    <p class="navi_title"><?php echo smartyTranslate(array('s'=>'My Page'),$_smarty_tpl);?>
</p>
                    <ul>
                    	<li ><a href="<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID==1){?>hotelpage.php?mid=<?php echo $_smarty_tpl->getVariable('cookie')->value->HotelID;?>
<?php }else{ ?>index.php<?php }?>"><?php echo smartyTranslate(array('s'=>'HOME'),$_smarty_tpl);?>
</a></li>
                    	<?php if (Tools::HasFunction('booking_list')){?> 
                    	<li><a href="booking_list.php"><?php echo smartyTranslate(array('s'=>'Booking List'),$_smarty_tpl);?>
</a></li>
                    	<?php }?>
                    	<?php if (Tools::HasFunction('settle_list')){?> 
                    	<li><a href="booking_list.php?settle=1"><?php echo smartyTranslate(array('s'=>'Settlement'),$_smarty_tpl);?>
</a></li>
                    	<?php }?>
                    	<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID==1&&Tools::hasFunction('hotel_detail_edit')){?>
                    		<li><a href="hoteldetail.php?mid=<?php echo $_smarty_tpl->getVariable('cookie')->value->HotelID;?>
"><?php echo smartyTranslate(array('s'=>'Hotel Detail Edit'),$_smarty_tpl);?>
</a></li>
                    	<?php }?>
                    	<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID==1&&Tools::hasFunction('room_plan_edit')){?>
                    		<li><a href="roomplanedit.php?hid=<?php echo $_smarty_tpl->getVariable('cookie')->value->HotelID;?>
"><?php echo smartyTranslate(array('s'=>'Room Plan Edit'),$_smarty_tpl);?>
</a></li>
                    	<?php }?>
                    	<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID==1&&Tools::hasFunction('room_stock')){?>
                    		<li><a href="room_stock.php"><?php echo smartyTranslate(array('s'=>'Room Stock Management'),$_smarty_tpl);?>
</a></li>
                    	<?php }?>
                    	<?php if (Tools::hasFunction('company_info')){?>
                    		<li><a href="auth.php?mid=<?php echo $_smarty_tpl->getVariable('cookie')->value->UserID;?>
&mod=self"><?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID==3){?><?php echo smartyTranslate(array('s'=>'Company Information'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'My Information'),$_smarty_tpl);?>
<?php }?></a></li>
                    	<?php }?>
                    	<?php if (Tools::hasFunction('hotel_data_import')){?>
                    		<li><a href="hoteldataimport.php"><?php echo smartyTranslate(array('s'=>'Hotel Data Import'),$_smarty_tpl);?>
</a></li>
                    	<?php }?>
                    	<?php if (Tools::hasFunction('agent_list')){?>
                    		<li><a href="agentlist.php"><?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>3){?><?php echo smartyTranslate(array('s'=>'Agent List'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'User Management'),$_smarty_tpl);?>
<?php }?></a></li>
                    	<?php }?>
                    	<?php if (Tools::hasFunction('hotel_list')){?>
                    		<li><a href="hotellist.php"><?php echo smartyTranslate(array('s'=>'Hotel List'),$_smarty_tpl);?>
</a></li>
                    	<?php }?>
                    	<?php if (Tools::hasFunction('admin_list')){?>
                    		<li><a href="adminlist.php"><?php echo smartyTranslate(array('s'=>'Admin List'),$_smarty_tpl);?>
</a></li>
                    	<?php }?>
						<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>3){?>
                    		<li><a href="hoteldetail.php?mid=0"><?php echo smartyTranslate(array('s'=>'Add Hotel'),$_smarty_tpl);?>
</a></li>
                    	<?php }?>
                    	<?php if (Tools::hasFunction('promotion_list')){?>
                    	<li><a href="promotionlist.php?type=0"><?php echo smartyTranslate(array('s'=>'Promotion List'),$_smarty_tpl);?>
</a></li>
                    	<?php }?>
                    	<?php if (Tools::hasFunction('event_list')){?>
                    	<li><a href="promotionlist.php?type=1"><?php echo smartyTranslate(array('s'=>'Event List'),$_smarty_tpl);?>
</a></li>
                    	<?php }?>
                        <?php if (Tools::hasFunction('message')){?>
                        <li><a href="message.php"><?php echo smartyTranslate(array('s'=>'Notices'),$_smarty_tpl);?>
</a></li>
                        <?php }?>
                        <?php if (Tools::hasFunction('popular_area')){?>
                    		<li><a href="poparea.php"><?php echo smartyTranslate(array('s'=>'Popular Area Edit'),$_smarty_tpl);?>
</a></li>
                    	<?php }?>
						<?php if (Tools::hasFunction('feature_manage')){?>
                    		<li><a href="featuremanage.php"><?php echo smartyTranslate(array('s'=>'Hotel Features Edit'),$_smarty_tpl);?>
</a></li>
                    	<?php }?>
						<?php if (Tools::hasFunction('updatePassword')){?>
                    		<li><a href="updatepassword.php"><?php echo smartyTranslate(array('s'=>'Update Password'),$_smarty_tpl);?>
</a></li>
                    	<?php }?>
                    </ul>
                </div>
                <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>1){?>
                <div class="sub_navi_outer">
                    <p class="navi_title"><?php echo smartyTranslate(array('s'=>'Popular Area'),$_smarty_tpl);?>
</p>
                    <ul>
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('popAreaList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
                        <li><a href="searchhotel.php?search=1&SortBy=&SortOrder=&AreaId=<?php echo $_smarty_tpl->tpl_vars['item']->value['AreaId'];?>
&CityId=0&CheckIn=<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID<3){?><?php echo $_smarty_tpl->getVariable('CheckInDay')->value;?>
<?php }?>&Nights=1&CheckOut=<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID<3){?><?php echo $_smarty_tpl->getVariable('CheckOutDay')->value;?>
<?php }?>&RoomType_1=0&RoomType_2=0&RoomType_3=0&RoomType_4=<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>3){?>0<?php }else{ ?>1<?php }?>&RoomType_5=0&RoomType_6=0&HotelClassId=0&HotelName=&search=%E6%A4%9C%E7%B4%A2"><?php echo $_smarty_tpl->tpl_vars['item']->value['AreaName'];?>
</a></li>
                    <?php }} ?>
                    </ul>
                </div>
                <?php }?>
                <!-- 
                <div class="sub_navi_outer">
                    <p class="navi_title">Hotline</p>
                    <ul>
                        <li>Shinjyuku</li>
                        <li>Sibuya</li>
                        <li>Company information</li>
                        <li>Yokohama</li>
                        <li>Kyoto</li>
                    </ul>
                </div>
                 -->
            </div>
            <!-- left navigation end -->
            
                