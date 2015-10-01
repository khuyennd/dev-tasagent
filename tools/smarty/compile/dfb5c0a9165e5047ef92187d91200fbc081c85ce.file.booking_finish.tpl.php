<?php /* Smarty version Smarty-3.0.7, created on 2015-04-17 19:36:50
         compiled from "/var/www/html/themes/default/booking_finish.tpl" */ ?>
<?php /*%%SmartyHeaderCode:179663861954f504d2e9b317-09202247%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dfb5c0a9165e5047ef92187d91200fbc081c85ce' => 
    array (
      0 => '/var/www/html/themes/default/booking_finish.tpl',
      1 => 1429176804,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '179663861954f504d2e9b317-09202247',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- right content start -->
<div class="left right_content_outer">
    <!-- booking step start -->
    <div class="booking_step_outer">
        <div class="booking_step step_bg_arrow" style="margin-top:11px;">
            <span class="font18 bold gray">1:<?php echo smartyTranslate(array('s'=>'Search'),$_smarty_tpl);?>
</span>
        </div>
        <div class="booking_step step_bg_arrow" style="margin-top:11px;">
            <span class="font18 bold gray">2:<?php echo smartyTranslate(array('s'=>'Result'),$_smarty_tpl);?>
</span>
        </div>
        <div class="booking_step step_bg_arrow" style="margin-top:11px;">
            <span class="font18 bold gray">3:<?php echo smartyTranslate(array('s'=>'Reservation'),$_smarty_tpl);?>
</span>
        </div>
        <div class="booking_step step_bg_arrow" style="margin-top:11px;">
            <span class="font18 bold gray">4:<?php echo smartyTranslate(array('s'=>'Check'),$_smarty_tpl);?>
</span>
        </div>
        <div class="booking_step" style="margin-top:11px;">
            <span class="font18 bold">5:<?php echo smartyTranslate(array('s'=>'End'),$_smarty_tpl);?>
</span>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- booking step end -->
    <div class="font18" style="margin-top:1px;">
	<?php echo smartyTranslate(array('s'=>'Thank You for booking!'),$_smarty_tpl);?>

    </div>
    <!-- booking hotel info start -->
    <!-- booking hotel info start -->
    <div class="orange_border_box" style="margin-top:5px;">
        <div class="content_box">
            <div class="orange_color bold font18 name_title_bg"><?php echo $_smarty_tpl->getVariable('booking_info')->value['hotel_info']['HotelName'];?>
</div>
            <div class="darkgray" style="padding:10px 0px">
                <p><?php echo smartyTranslate(array('s'=>'Address'),$_smarty_tpl);?>
: <?php echo $_smarty_tpl->getVariable('booking_info')->value['hotel_info']['HotelAddress'];?>
</p>
                <p><?php echo smartyTranslate(array('s'=>'Region'),$_smarty_tpl);?>
: <?php echo $_smarty_tpl->getVariable('booking_info')->value['hotel_info']['CityName'];?>
,<?php echo $_smarty_tpl->getVariable('booking_info')->value['hotel_info']['AreaName'];?>
, <?php echo $_smarty_tpl->getVariable('booking_info')->value['hotel_info']['HotelCode'];?>
</p>
                <p><span class="left"><?php echo smartyTranslate(array('s'=>"class"),$_smarty_tpl);?>
:</span><span class="left"><?php echo smartyTranslate(array('s'=>$_smarty_tpl->getVariable('booking_info')->value['hotel_info']['HotelClassName']),$_smarty_tpl);?>
</span></p>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- booking hotel info end -->

    <!-- booking detail start -->
    <div class="booking_detail">
    <?php if ($_smarty_tpl->getVariable('method')->value!='view'){?>
        <p class="orange_color bold">01. <?php echo smartyTranslate(array('s'=>'Checkin'),$_smarty_tpl);?>
 / <?php echo smartyTranslate(array('s'=>'Checkout'),$_smarty_tpl);?>
 / <?php echo smartyTranslate(array('s'=>'Room Info'),$_smarty_tpl);?>
 / <?php echo smartyTranslate(array('s'=>'Guest Info'),$_smarty_tpl);?>
</p>
        <p class="darkgray" style="line-height:18px; margin:5px 0;">* <?php echo smartyTranslate(array('s'=>'Please Note: For “OK” (instant booking) will be hold Next 30 mins'),$_smarty_tpl);?>
.<br />
            &nbsp;&nbsp;  <?php echo smartyTranslate(array('s'=>'After this 30mins, room will be released and you will need to once again initiate a search for the room'),$_smarty_tpl);?>
.</p>
    <?php }?>
        <p style="line-height:18px; margin:5px 0;"> <?php echo smartyTranslate(array('s'=>'Checkin'),$_smarty_tpl);?>
 / <?php echo smartyTranslate(array('s'=>'Checkout'),$_smarty_tpl);?>
 : <?php echo $_smarty_tpl->getVariable('booking_info')->value['checkin'];?>
-<?php echo $_smarty_tpl->getVariable('booking_info')->value['checkout'];?>
 (<?php echo $_smarty_tpl->getVariable('booking_info')->value['nights'];?>
)</p>

        <div class="gray_box">
            <div class="content_box">

                <!-- Room Plan Info 1 start -->
            <?php  $_smarty_tpl->tpl_vars['roomplan'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('booking_info')->value['booked_roomplan_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['roomplan']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['roomplan']->key => $_smarty_tpl->tpl_vars['roomplan']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['roomplan']['index']++;
?>
                <?php $_smarty_tpl->tpl_vars["id"] = new Smarty_variable($_smarty_tpl->getVariable('smarty')->value['foreach']['roomplan']['index'], null, null);?>
                <input type="hidden" name="ids[]" value="<?php echo $_smarty_tpl->getVariable('id')->value;?>
" />
                <input type="hidden" name="or_ids_<?php echo $_smarty_tpl->getVariable('id')->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['OrderRoomId'];?>
" />
                <input type="hidden" name="roomplan_ids_<?php echo $_smarty_tpl->getVariable('id')->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomPlanId'];?>
" />
                <input type="hidden" name="req_nonsmoking_<?php echo $_smarty_tpl->getVariable('id')->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['req_nonsmoking'];?>
" />
                <input type="hidden" name="req_smoking_<?php echo $_smarty_tpl->getVariable('id')->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['req_smoking'];?>
" />
                <input type="hidden" name="req_adjoin_<?php echo $_smarty_tpl->getVariable('id')->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['req_adjoin'];?>
" />
                <input type="hidden" name="req_remark_<?php echo $_smarty_tpl->getVariable('id')->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['req_remark'];?>
" />
                <div class="left" style="width:100%">
                    <div class="title_bar">Room Type-<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomPlanName'];?>
</div>
                    <table class="yellow" style="margin-top:0px;">
                        <tr>
                            <th valign="top" style="width: 40%"><?php echo smartyTranslate(array('s'=>'Room Type'),$_smarty_tpl);?>
</th>
                            <td><?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['roomplan']->value['RoomTypeName']),$_smarty_tpl);?>
</td>
                        </tr>
                        <?php  $_smarty_tpl->tpl_vars['customer'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['roomplan']->value['customer_info_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['customer']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['customer']->key => $_smarty_tpl->tpl_vars['customer']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['customer']['index']++;
?>

                            <input type="hidden" name="customer_fnames_<?php echo $_smarty_tpl->getVariable('id')->value;?>
[]" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_fnames'];?>
" />
                            <input type="hidden" name="customer_gnames_<?php echo $_smarty_tpl->getVariable('id')->value;?>
[]" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_gnames'];?>
" />
                            <input type="hidden" name="customer_sex_<?php echo $_smarty_tpl->getVariable('id')->value;?>
_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['customer']['index'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_sex'];?>
" />
                            <input type="hidden" name="customer_country_<?php echo $_smarty_tpl->getVariable('id')->value;?>
[]" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_country'];?>
" />

                            <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['customer']['index']==0){?>
                                <tr>
                                    <th rowspan="<?php echo count($_smarty_tpl->tpl_vars['roomplan']->value['customer_info_list']);?>
" valign="top"><?php echo smartyTranslate(array('s'=>'Lodging Info'),$_smarty_tpl);?>
</th>
                                    <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_country_name'];?>
 <?php if ($_smarty_tpl->tpl_vars['customer']->value['customer_sex']==1){?>Mr.<?php }else{ ?>Ms.<?php }?>  <?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_fnames'];?>
. <?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_gnames'];?>
</td>
                                </tr>
                                <?php }else{ ?>
                                <tr>
                                    <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_country_name'];?>
 <?php if ($_smarty_tpl->tpl_vars['customer']->value['customer_sex']==1){?>Mr.<?php }else{ ?>Ms.<?php }?><?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_fnames'];?>
. <?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_gnames'];?>
</td>
                                </tr>
                            <?php }?>
                        <?php }} ?>
                        <tr>
                            <th valign="top"><?php echo smartyTranslate(array('s'=>'Breakfast'),$_smarty_tpl);?>
</th>
                            <td><?php if ($_smarty_tpl->tpl_vars['roomplan']->value['Breakfast']==1){?><?php echo smartyTranslate(array('s'=>'Yes'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'None'),$_smarty_tpl);?>
<?php }?></td>
                        </tr>
                        <tr>
                            <th valign="top"><?php echo smartyTranslate(array('s'=>'Price'),$_smarty_tpl);?>
</th>
                            <td><?php echo $_smarty_tpl->tpl_vars['roomplan']->value['PriceString'];?>
</td>
                        </tr><!-- Room Plan Info 1 end -->
                    </table>
                </div>
            <?php }} ?>
                <div class="left" style="margin-right:5%;width:95%">
                    <div class="title_bar"><?php echo smartyTranslate(array('s'=>'Total Price'),$_smarty_tpl);?>
</div>
                <?php echo $_smarty_tpl->getVariable('booking_info')->value['TotalPriceString'];?>

                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- booking detail end -->

    <div class="booking_detail">
        <div class="orange_color bold" style=" margin-bottom:5px;">02. <?php echo smartyTranslate(array('s'=>'Customer Information'),$_smarty_tpl);?>
</div>
        <div class="gray_box"><div class="content_box">
            <table class="yellow" style="margin-top:0px;">
            <?php if ($_smarty_tpl->getVariable('booking_info')->value['BookingNo']!=''){?>
                <tr>
                    <th style="width: 40%"><?php echo smartyTranslate(array('s'=>'My Booking No'),$_smarty_tpl);?>
</th>
                    <td><?php echo $_smarty_tpl->getVariable('booking_info')->value['BookingNo'];?>
</td>
                </tr>
            <?php }?>
                <tr>
                    <th style="width: 40%"><?php echo smartyTranslate(array('s'=>'Name'),$_smarty_tpl);?>
</th>
                    <td><?php echo $_smarty_tpl->getVariable('booking_info')->value['contact_name'];?>
</td>
                </tr>
                <tr>
                    <th>E-mail</th>
                    <td><?php echo $_smarty_tpl->getVariable('booking_info')->value['contact_email'];?>
</td>
                </tr>
                <tr>
                    <th><?php echo smartyTranslate(array('s'=>'Tel'),$_smarty_tpl);?>
</th>
                    <td><?php echo $_smarty_tpl->getVariable('booking_info')->value['contact_tel'];?>
</td>
                </tr>
                <tr>
                    <th><?php echo smartyTranslate(array('s'=>'Homepage(optional)'),$_smarty_tpl);?>
</th>
                    <td><?php echo $_smarty_tpl->getVariable('booking_info')->value['contact_hp'];?>
</td>
                </tr>
            </table>
        </div></div>
    </div>

</div>
<!-- right content end -->
<div class="clearfix"></div>
