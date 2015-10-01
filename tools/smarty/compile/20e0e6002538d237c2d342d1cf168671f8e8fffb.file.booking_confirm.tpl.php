<?php /* Smarty version Smarty-3.0.7, created on 2015-08-19 15:26:34
         compiled from "/var/www/html/themes/default/booking_confirm.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9736591085591fd8e59f628-34555007%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '20e0e6002538d237c2d342d1cf168671f8e8fffb' => 
    array (
      0 => '/var/www/html/themes/default/booking_confirm.tpl',
      1 => 1438824618,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9736591085591fd8e59f628-34555007',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- right content start -->
<div class="left right_content_outer">
<?php if (!$_smarty_tpl->getVariable('payment')->value){?>
	<form method="post" action="booking_confirm.php">
	<input type="hidden" name="order_id" value="<?php echo $_smarty_tpl->getVariable('booking_info')->value['order_id'];?>
" />
	<input type="hidden" name="hotel_id" value="<?php echo $_smarty_tpl->getVariable('booking_info')->value['hotel_id'];?>
" />
    <input type="hidden" name="checkin" value="<?php echo $_smarty_tpl->getVariable('booking_info')->value['checkin'];?>
" />
    <input type="hidden" name="checkout" value="<?php echo $_smarty_tpl->getVariable('booking_info')->value['checkout'];?>
" />
    <input type="hidden" name="contact_name" value="<?php echo $_smarty_tpl->getVariable('booking_info')->value['contact_name'];?>
" />
    <input type="hidden" name="contact_email" value="<?php echo $_smarty_tpl->getVariable('booking_info')->value['contact_email'];?>
" />
    <input type="hidden" name="contact_tel" value="<?php echo $_smarty_tpl->getVariable('booking_info')->value['contact_tel'];?>
" />
    <input type="hidden" name="contact_hp" value="<?php echo $_smarty_tpl->getVariable('booking_info')->value['contact_hp'];?>
" />
 <?php }?>
	<?php if ($_smarty_tpl->getVariable('method')->value!='view'){?>
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
            <span class="font18 bold">4:<?php echo smartyTranslate(array('s'=>'Check'),$_smarty_tpl);?>
</span>
        </div>
        <div class="booking_step" style="margin-top:11px;">
            <span class="font18 bold gray">5:<?php echo smartyTranslate(array('s'=>'End'),$_smarty_tpl);?>
</span>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- booking step end -->
    <?php }?>

    <!-- booking hotel info start -->
    <div class="orange_border_box">
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
                        <td><?php if ($_smarty_tpl->tpl_vars['customer']->value['customer_sex']==1){?>Mr.<?php }else{ ?>Ms.<?php }?>  <?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_fnames'];?>
. <?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_gnames'];?>
 <br /><?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_country_name'];?>
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
                        <?php if ($_smarty_tpl->getVariable('voucher')->value){?>
                            <tr>
                                <th valign="top"><?php echo smartyTranslate(array('s'=>'Dinner'),$_smarty_tpl);?>
</th>
                                <td><?php if ($_smarty_tpl->tpl_vars['roomplan']->value['Dinner']==1){?><?php echo smartyTranslate(array('s'=>'Yes'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'None'),$_smarty_tpl);?>
<?php }?></td>
                            </tr>
                            <tr>
                                <th valign="top"><?php echo smartyTranslate(array('s'=>'nonsmoking'),$_smarty_tpl);?>
</th>
                                <td><?php if ($_smarty_tpl->tpl_vars['roomplan']->value['req_nonsmoking']==1){?><?php echo smartyTranslate(array('s'=>'Yes'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'None'),$_smarty_tpl);?>
<?php }?></td>
                            </tr>
                            <tr>
                                <th valign="top"><?php echo smartyTranslate(array('s'=>'smoking'),$_smarty_tpl);?>
</th>
                                <td><?php if ($_smarty_tpl->tpl_vars['roomplan']->value['req_smoking']==1){?><?php echo smartyTranslate(array('s'=>'Yes'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'None'),$_smarty_tpl);?>
<?php }?></td>
                            </tr>
                            <tr>
                                <th valign="top"><?php echo smartyTranslate(array('s'=>'adjoin'),$_smarty_tpl);?>
</th>
                                <td><?php if ($_smarty_tpl->tpl_vars['roomplan']->value['req_adjoin']==1){?><?php echo smartyTranslate(array('s'=>'Yes'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'None'),$_smarty_tpl);?>
<?php }?></td>
                            </tr>
                            <tr>
                                <th valign="top"><?php echo smartyTranslate(array('s'=>'remark'),$_smarty_tpl);?>
</th>
                                <td><?php echo $_smarty_tpl->tpl_vars['roomplan']->value['req_remark'];?>
</td>
                            </tr>
                        <?php }?>
                        <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID!=1){?>
                        <tr>
                        <th valign="top"><?php echo smartyTranslate(array('s'=>'Price'),$_smarty_tpl);?>
</th>
                        <td><?php echo $_smarty_tpl->tpl_vars['roomplan']->value['PriceString'];?>
</td>
                        </tr>
                        <?php }?>
                        <!-- Room Plan Info 1 end -->
                    </table>
                </div>
            	<?php }} ?>
                <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID!=1){?>
                <div class="left" style="margin-right:5%;width:95%;margin-top:5px">
                    <table widt="300px">
					<tr>
						<td width="100px"><p class="bold font14"><?php echo smartyTranslate(array('s'=>'Total Price'),$_smarty_tpl);?>
</p></td>
						
						<?php if ($_smarty_tpl->getVariable('booking_info')->value['otherPrice']!=0){?>
						<td width="100px"><p class="bold font14"><?php echo smartyTranslate(array('s'=>'Paid In'),$_smarty_tpl);?>
</p></td>
						<td width="100px"><p class="bold font14"><?php echo smartyTranslate(array('s'=>'Unpaid'),$_smarty_tpl);?>
</p></td>
						<?php }?>
					</tr>
					<tr>
						<td><p class="orange_color font14" id="div_total_price"><?php echo $_smarty_tpl->getVariable('booking_info')->value['TotalPriceString'];?>
</p></td>
						<?php if ($_smarty_tpl->getVariable('booking_info')->value['otherPrice']!=0){?>
						<td><p class="orange_color font14" id="div_paidin_price"><?php echo $_smarty_tpl->getVariable('booking_info')->value['PaidIn'];?>
</p></td>
						<td><p class="orange_color font14" id="div_unpaid_price"><?php echo $_smarty_tpl->getVariable('booking_info')->value['UnPaid'];?>
</p></td>
						<?php }?>
					</tr>
					</table>
                </div>
                <?php }?>
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
	            	<th><?php echo smartyTranslate(array('s'=>"E-mail"),$_smarty_tpl);?>
</th>
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
    <?php if ($_smarty_tpl->getVariable('method')->value!='view'){?>
        <script >
function disableButton(){
    //alert('aaa');
    $('#bo').hide();
    $('#bo2').show();
}
        </script>
    <div class="booking_info_btn">
        <input type="hidden" name="booking" value="finish" />
    	<div class="left booking_next"><input type="submit" class="button orange" value="<?php echo smartyTranslate(array('s'=>'next'),$_smarty_tpl);?>
" alt="<?php echo smartyTranslate(array('s'=>'next'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'next'),$_smarty_tpl);?>
" id="bo" onclick="disableButton()"/></div>
        <div class="left booking_next"><input type="button" class="button orange" value="<?php echo smartyTranslate(array('s'=>'waiting'),$_smarty_tpl);?>
" alt="<?php echo smartyTranslate(array('s'=>'waiting'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'waiting'),$_smarty_tpl);?>
" id="bo2" style="display: none" "/></div>
        <div class="left booking_back"><input type="button" class="button white" alt="<?php echo smartyTranslate(array('s'=>'back'),$_smarty_tpl);?>
" value="<?php echo smartyTranslate(array('s'=>'back'),$_smarty_tpl);?>
" onclick="javascript:history.go(-1);" /></div>
        <div class="clearfix"></div>
    </div>
    <?php }else{ ?>
    <div class="booking_info_btn">
    	<?php if ($_smarty_tpl->getVariable('payment')->value){?>
    		<input type="hidden" name="booking" value="payment" />
			<input type="hidden" name="money" value="<?php echo $_smarty_tpl->getVariable('booking_info')->value['money'];?>
">

            <form action="https://www.<?php echo $_smarty_tpl->getVariable('env')->value;?>
.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="business" value="<?php echo $_smarty_tpl->getVariable('mail_address')->value;?>
">
                <input type="hidden" name="item_name" value="<?php echo $_smarty_tpl->getVariable('booking_info')->value['BookingNo'];?>
">
                <input type="hidden" name="amount" value="<?php echo $_smarty_tpl->getVariable('booking_info')->value['money'];?>
">
                <input type="hidden" name="currency_code" value="<?php echo $_smarty_tpl->getVariable('payment_currency')->value;?>
">
                <input type="hidden" name="return" value="<?php echo $_smarty_tpl->getVariable('return_url')->value;?>
">
                <input type="hidden" name="notify_url" value="<?php echo $_smarty_tpl->getVariable('notify_url')->value;?>
">
                <div class="left booking_next"><input type="submit" class="button orange medium" value="<?php echo smartyTranslate(array('s'=>'Pay'),$_smarty_tpl);?>
"/></div>
            </form>

    	<?php }?>
        <div class="left booking_back"><input type="button" class="button white medium" alt="<?php echo smartyTranslate(array('s'=>'back'),$_smarty_tpl);?>
" value="<?php echo smartyTranslate(array('s'=>'back'),$_smarty_tpl);?>
" onclick="javascript:history.go(-1);" /></div>
        <?php if ($_smarty_tpl->getVariable('voucher')->value){?>
            <input type="button" onclick="javascript:window.print();" value="<?php echo smartyTranslate(array('s'=>'print'),$_smarty_tpl);?>
" class="button orange medium">
       	<?php }?>
        <div class="clearfix"></div>
    </div>
    <?php }?>
    <?php if (!$_smarty_tpl->getVariable('payment')->value){?>
	</form>
    <?php }?>
</div>
<!-- right content end -->
<div class="clearfix"></div>
