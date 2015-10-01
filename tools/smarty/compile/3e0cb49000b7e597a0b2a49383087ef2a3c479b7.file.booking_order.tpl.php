<?php /* Smarty version Smarty-3.0.7, created on 2015-08-19 15:23:30
         compiled from "/var/www/html/themes/default/booking_order.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1021628395410154e3051f6-71970647%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3e0cb49000b7e597a0b2a49383087ef2a3c479b7' => 
    array (
      0 => '/var/www/html/themes/default/booking_order.tpl',
      1 => 1438824618,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1021628395410154e3051f6-71970647',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/html/tools/smarty/plugins/modifier.escape.php';
?><!-- right content start -->
<div class="left right_content_outer">     
	<input type="hidden" id="nights" value="<?php echo $_smarty_tpl->getVariable('booking_info')->value['nights'];?>
" />
	
	<form method="post" action="booking_confirm.php" onsubmit="return onsubmit_booking_confirm()">
	<input type="hidden" name="hotel_id" value="<?php echo $_smarty_tpl->getVariable('booking_info')->value['hotel_info']['HotelId'];?>
" />
	<input type="hidden" name="order_id" value="<?php echo $_smarty_tpl->getVariable('booking_info')->value['order_id'];?>
" />

	<?php if ($_smarty_tpl->getVariable('method')->value=='order'){?>
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
            <span class="font18 bold">3:<?php echo smartyTranslate(array('s'=>'Reservation'),$_smarty_tpl);?>
</span>
        </div>
        <div class="booking_step step_bg_arrow" style="margin-top:11px;">
            <span class="font18 bold gray">4:<?php echo smartyTranslate(array('s'=>'Check'),$_smarty_tpl);?>
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
            <div class="orange_color bold font18 name_title_bg" style="width:100%"><?php echo $_smarty_tpl->getVariable('booking_info')->value['hotel_info']['HotelName'];?>
</div>
            <div class="darkgray">
                <p style="margin-top: 2px;"><?php echo smartyTranslate(array('s'=>"Address"),$_smarty_tpl);?>
: <?php echo $_smarty_tpl->getVariable('booking_info')->value['hotel_info']['HotelAddress'];?>
</p>
                <p style="margin-top: 2px;"><?php echo smartyTranslate(array('s'=>"Region"),$_smarty_tpl);?>
: <?php echo $_smarty_tpl->getVariable('booking_info')->value['hotel_info']['CityName'];?>
,<?php echo $_smarty_tpl->getVariable('booking_info')->value['hotel_info']['AreaName'];?>
</p>
                <p style="margin-top: 2px;"><span class="left"><?php echo smartyTranslate(array('s'=>"class"),$_smarty_tpl);?>
:</span><span class="left"><?php echo smartyTranslate(array('s'=>$_smarty_tpl->getVariable('booking_info')->value['hotel_info']['HotelClassName']),$_smarty_tpl);?>
</span></p>
                <div class="clearfix"></div>     
            </div>                      
        </div>
    
    </div>
    <!-- booking hotel info end -->
    
    <!-- booking detail start -->
    <div class="booking_detail">
        <?php if ($_smarty_tpl->getVariable('method')->value=='order'){?>
		<p class="orange_color bold" style="font-size: 15px;">01. <?php echo smartyTranslate(array('s'=>'Check-In / Check-Out / Room Info / Guest Info'),$_smarty_tpl);?>
</p>
        <p class="darkgray" style="line-height:18px; margin:5px 0;">* <?php echo smartyTranslate(array('s'=>'Please Note: For “OK” (instant booking) will be hold Next 30 mins'),$_smarty_tpl);?>
.<br />
        &nbsp;&nbsp;  <?php echo smartyTranslate(array('s'=>'After this 30mins, room will be released and you will need to once again initiate a search for the room'),$_smarty_tpl);?>
.</p>
        <?php }?>
		<div class="date_choose_outer">
            <span class="left bold font14" style="margin:11px 0 0;"><?php echo smartyTranslate(array('s'=>"Date"),$_smarty_tpl);?>
</span>
            <div class="srch_con">
               	<label><?php echo smartyTranslate(array('s'=>'Checkin_order'),$_smarty_tpl);?>
 : </label>
                <input type="text" value="<?php echo $_smarty_tpl->getVariable('booking_info')->value['checkin'];?>
" readonly="readonly" style="float:left;" name="checkin" id="CheckIn"  />
                <img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
calendar_icon.jpg" alt="" width="13" class="calendar_icon" <?php if ($_smarty_tpl->getVariable('method')->value=='edit'){?> onclick="if(self.gfPop)gfPop.fPopCalendar(getById('CheckIn'), 'OnChangeStartDate(\'CheckIn\',\'CheckOut\', \'Nights\', <?php if (($_smarty_tpl->getVariable('cookie')->value->RoleID==2||$_smarty_tpl->getVariable('cookie')->value->RoleID==3)){?>1<?php }else{ ?>0<?php }?>)');" <?php }?> />
                <?php if ($_smarty_tpl->getVariable('method')->value=='edit'){?>
				<select style="float:left; margin-left:5px;" name="nights" id="Nights" onchange="javascript:OnChangeStartDate('CheckIn','CheckOut', 'Nights',<?php if (($_smarty_tpl->getVariable('cookie')->value->RoleID==2||$_smarty_tpl->getVariable('cookie')->value->RoleID==3)){?>1<?php }else{ ?>0<?php }?>);return false;">
                	<!--<option value='0'>-</option>-->
                	<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 31+1 - (1) : 1-(31)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                		<option value=<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
 <?php if ($_smarty_tpl->tpl_vars['i']->value==$_smarty_tpl->getVariable('booking_info')->value['nights']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</option>
                	<?php }} ?>
                </select>
                    <span style="display:block; float:left; margin:3px 10px 0 5px;"><?php echo smartyTranslate(array('s'=>'Nights'),$_smarty_tpl);?>
</span>
                <?php }else{ ?>
                <span style="display:block; float:left; margin:3px 10px 0 5px;"><?php echo $_smarty_tpl->getVariable('booking_info')->value['nights'];?>
<?php echo smartyTranslate(array('s'=>'Nights'),$_smarty_tpl);?>
</span>
                <?php }?>

				<label><?php echo smartyTranslate(array('s'=>'Checkout_order'),$_smarty_tpl);?>
 :</label>                
                <input type="text" value="<?php echo $_smarty_tpl->getVariable('booking_info')->value['checkout'];?>
" readonly="readonly" style="float:left;" name="checkout" id="CheckOut" />
                <img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
calendar_icon.jpg" alt="" width="13" class="calendar_icon" <?php if ($_smarty_tpl->getVariable('method')->value=='edit'){?>  onclick="if(self.gfPop)gfPop.fPopCalendar(getById('CheckOut'), 'OnChangeEndDate(\'CheckIn\',\'CheckOut\', \'Nights\', <?php if (($_smarty_tpl->getVariable('cookie')->value->RoleID==2||$_smarty_tpl->getVariable('cookie')->value->RoleID==3)){?>1<?php }else{ ?>0<?php }?>)');" <?php }?>  />
				
				<?php if ($_smarty_tpl->getVariable('method')->value=='edit'){?>
                <input id="calculation" style="margin-left:20px ;" name="calculation" onclick="calculate()" type="submit" value="<?php echo smartyTranslate(array('s'=>'Calculation'),$_smarty_tpl);?>
" class="button orange medium"/>
                <?php }?>
			</div>
            
            <div class="clearfix"></div>
        </div>
    </div>                    
    <!-- booking detail end -->
    
    <?php  $_smarty_tpl->tpl_vars['roomplan'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('booking_info')->value['booked_roomplan_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["roomplan"]['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['roomplan']->key => $_smarty_tpl->tpl_vars['roomplan']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["roomplan"]['index']++;
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
    <input type="hidden" id="roomplan_minprice_<?php echo $_smarty_tpl->getVariable('id')->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['MinPrice'];?>
" />
    <input type="hidden" id="roomplan_typename_<?php echo $_smarty_tpl->getVariable('id')->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomTypeName'];?>
" />
    <!-- booking plan start -->
    <p style="margin-top:10px; font-size:14px;" class="bold"><?php echo $_smarty_tpl->getVariable('id')->value+1;?>
. <?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomPlanName'];?>
</p>
    <div class="all_border room_plan_div"> 
    	
        <div class="room_plan_detail bold">
       	  	<div class="left roomtype">
                <label style="text-align: left;"><?php echo smartyTranslate(array('s'=>'Room type'),$_smarty_tpl);?>
</label>
                <select class="select_class" disabled="disabled" >
                    <option><?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['roomplan']->value['RoomTypeName']),$_smarty_tpl);?>
</option>
                </select>
            </div>
            <div class="left paxstay bold">
                <label><?php echo smartyTranslate(array('s'=>'no of pax stay at room'),$_smarty_tpl);?>
</label>
                <input type="hidden"  id="roomcount_<?php echo $_smarty_tpl->getVariable('id')->value;?>
" name="roomplan_counts_<?php echo $_smarty_tpl->getVariable('id')->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['OrderCount'];?>
" />
                <select class="select_class" name="roomplan_persons_<?php echo $_smarty_tpl->getVariable('id')->value;?>
" onchange="return onchange_select_roomcount(<?php echo $_smarty_tpl->getVariable('id')->value;?>
, this.value)">
                	<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['roomplan']->value['RoomMaxPersons']+1 - (1) : 1-($_smarty_tpl->tpl_vars['roomplan']->value['RoomMaxPersons'])+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['roomplan']->value['RoomMaxPersons']==$_smarty_tpl->tpl_vars['i']->value){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</option>
                    <?php }} ?>
                </select>
            </div>
            <div class="clearfix"></div>
        </div>                    
        
        <div id="roomplan_booking_customer_<?php echo $_smarty_tpl->getVariable('id')->value;?>
">
        <?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./booking_sub_customer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('id',$_smarty_tpl->getVariable('id')->value);$_template->assign('count',$_smarty_tpl->tpl_vars['roomplan']->value['RoomMaxPersons']);$_template->assign('countries',$_smarty_tpl->getVariable('countries')->value);$_template->assign('customers',$_smarty_tpl->tpl_vars['roomplan']->value['customer_info_list']); echo $_template->getRenderedTemplate();?><?php unset($_template);?>
        </div>
        
        <div class="room_plan_detail bold"  style="margin-top: 5px;">
            <div class="left plan_dinner"><label><?php echo smartyTranslate(array('s'=>'Breakfast'),$_smarty_tpl);?>
:<?php if ($_smarty_tpl->tpl_vars['roomplan']->value['Breakfast']==1){?><?php echo smartyTranslate(array('s'=>'Yes'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'None'),$_smarty_tpl);?>
(<?php echo smartyTranslate(array('s'=>'Addition Possible'),$_smarty_tpl);?>
)<?php }?></label></div>
            <div class="left plan_dinner"><label><?php echo smartyTranslate(array('s'=>'Dinner'),$_smarty_tpl);?>
:<?php if ($_smarty_tpl->tpl_vars['roomplan']->value['Dinner']==1){?><?php echo smartyTranslate(array('s'=>'Yes'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'None'),$_smarty_tpl);?>
(<?php echo smartyTranslate(array('s'=>'Addition Possible'),$_smarty_tpl);?>
)<?php }?></label></div>
            <div class="clearfix"></div>
        </div>                    
        
		<div class="sepecial_request_outer">
			<div class="sepecial_title" onclick="showapp('special_tit_<?php echo $_smarty_tpl->getVariable('id')->value;?>
','special_detail_<?php echo $_smarty_tpl->getVariable('id')->value;?>
')">
				<p class="fold" id="special_tit_<?php echo $_smarty_tpl->getVariable('id')->value;?>
"><?php echo smartyTranslate(array('s'=>'Special Request'),$_smarty_tpl);?>
</p>
			</div>
			<div class="hidden sepecial_content" id="special_detail_<?php echo $_smarty_tpl->getVariable('id')->value;?>
">
            	<div class="left smoking_type"><input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['roomplan']->value['req_nonsmoking']==1){?>checked="checked"<?php }?> name="req_nonsmoking_<?php echo $_smarty_tpl->getVariable('id')->value;?>
" id="req_nonsmoking_<?php echo $_smarty_tpl->getVariable('id')->value;?>
" value="1" /><label for="req_nonsmoking_<?php echo $_smarty_tpl->getVariable('id')->value;?>
"><?php echo smartyTranslate(array('s'=>'Non Smoking'),$_smarty_tpl);?>
</label></div>
                <div class="left smoking_type"><input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['roomplan']->value['req_smoking']==1){?>checked="checked"<?php }?> name="req_smoking_<?php echo $_smarty_tpl->getVariable('id')->value;?>
" id="req_smoking_<?php echo $_smarty_tpl->getVariable('id')->value;?>
" value="1" /><label for="req_smoking_<?php echo $_smarty_tpl->getVariable('id')->value;?>
"><?php echo smartyTranslate(array('s'=>'Smoking'),$_smarty_tpl);?>
</label></div>
                <div class="left smoking_type"><input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['roomplan']->value['req_adjoin']==1){?>checked="checked"<?php }?> name="req_adjoin_<?php echo $_smarty_tpl->getVariable('id')->value;?>
" id="req_adjoin_<?php echo $_smarty_tpl->getVariable('id')->value;?>
" value="1" /><label for="req_adjoin_<?php echo $_smarty_tpl->getVariable('id')->value;?>
"><?php echo smartyTranslate(array('s'=>'Adjoin room'),$_smarty_tpl);?>
</label></div>
                <div class="clearfix"></div>
              	<div class="sepecial_remark">
                    <label><?php echo smartyTranslate(array('s'=>'Remark'),$_smarty_tpl);?>
</label>
                    <textarea style="width:675px; height:48px;" name="req_remark_<?php echo $_smarty_tpl->getVariable('id')->value;?>
"><?php echo $_smarty_tpl->tpl_vars['roomplan']->value['req_remark'];?>
</textarea>
                </div>
                <p class="gray">※ <?php echo smartyTranslate(array('s'=>'All Special request are subjects to availability'),$_smarty_tpl);?>
</p>
            </div>
            
            <p class="orange_clor bold" id="roomprice_<?php echo $_smarty_tpl->getVariable('id')->value;?>
" style="margin-top: 5px;"><?php echo smartyTranslate(array('s'=>'Room Price'),$_smarty_tpl);?>
 : <?php echo $_smarty_tpl->tpl_vars['roomplan']->value['PriceString'];?>
  <!--: 【単価】 X 【宿泊日数】 = 【部屋別の総額】    ※貨幣はJPY(日本円）のみで大丈夫です。</p> -->
        </div>
        <div class="clearfix"></div>                    
    </div>
    <!--
    <div class="right hotel_booking_btn"><input type="button" class="button orange" alt="booking" value="Add Room"/></div>
    <div class="clearfix"></div>
    -->
	<!-- booking plan end -->    
    <?php }} ?>
    <!-- total price start -->
    <div class="total_price_div">
    	<table widt="300px">
		<tr>
			<td width="100px"><p class="bold"><?php echo smartyTranslate(array('s'=>'Total Price'),$_smarty_tpl);?>
</p></td>
			<?php if ($_smarty_tpl->getVariable('booking_info')->value['otherPrice']!=0){?>
			<td width="100px"><p class="bold"><?php echo smartyTranslate(array('s'=>'Paid In'),$_smarty_tpl);?>
</p></td>
			<td width="100px"><p class="bold"><?php echo smartyTranslate(array('s'=>'Unpaid'),$_smarty_tpl);?>
</p></td>
			<?php }?>
		</tr>
		<tr>
			<td><p class="orange_color" id="div_total_price"><?php echo $_smarty_tpl->getVariable('booking_info')->value['TotalPriceString'];?>
</p></td>
			<?php if ($_smarty_tpl->getVariable('booking_info')->value['otherPrice']!=0){?>
			<td><p class="orange_color" id="div_paidin_price"><?php echo $_smarty_tpl->getVariable('booking_info')->value['PaidIn'];?>
</p></td>
			<td><p class="orange_color" id="div_unpaid_price"><?php echo $_smarty_tpl->getVariable('booking_info')->value['UnPaid'];?>
</p></td>
			<?php }?>
		</tr>
		</table>
    </div>
    <!-- total price end -->
    
    <!-- customer information start -->
    <p class="orange_color bold" style="font-size: 15px;">02. <?php echo smartyTranslate(array('s'=>'Customer Information'),$_smarty_tpl);?>
</p>
    <div class="cus_info_div">
    	<div class="left cus_info_blank">
            <span class="red">*</span><label><?php echo smartyTranslate(array('s'=>'Name'),$_smarty_tpl);?>
</label>
            <input type="text" name="contact_name" id="contact_name" value="<?php echo $_smarty_tpl->getVariable('booking_info')->value['contact_name'];?>
" />
        </div>
        <div class="left cus_info_blank">
            <span class="red">*</span><label><?php echo smartyTranslate(array('s'=>'Email'),$_smarty_tpl);?>
</label>
            <input type="text" name="contact_email" id="contact_email" value="<?php echo $_smarty_tpl->getVariable('booking_info')->value['contact_email'];?>
"  />
        </div>
        <div class="clearfix"></div>
        <div class="left cus_info_blank">
            <span class="red">*</span><label><?php echo smartyTranslate(array('s'=>'TEL'),$_smarty_tpl);?>
</label>
            <input type="text" name="contact_tel" id="contact_tel" value="<?php echo $_smarty_tpl->getVariable('booking_info')->value['contact_tel'];?>
"  />
        </div>
        <div class="left cus_info_blank">
            <span class="white_color">*</span><label><?php echo smartyTranslate(array('s'=>'HP'),$_smarty_tpl);?>
</label>
            <input type="text" name="contact_hp" id="contact_hp" value="<?php echo $_smarty_tpl->getVariable('booking_info')->value['contact_hp'];?>
"  />
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- customer information start -->
    <?php if ($_smarty_tpl->getVariable('method')->value=='order'){?>
    <div class="booking_info_btn">
        <input name="booking" value="confirm" type="hidden" />
    	<div class="left booking_next"><input type="submit" class="button orange" value="<?php echo smartyTranslate(array('s'=>'next'),$_smarty_tpl);?>
" alt="next" title="next"/></div>
        <div class="left booking_back"><input type="button" class="button white" alt="back" value="<?php echo smartyTranslate(array('s'=>'Back'),$_smarty_tpl);?>
" onclick="javascript:history.go(-1);" /></div>
        <div class="clearfix"></div>
    </div>
    <?php }else{ ?>
    <div class="booking_info_btn">
        <input name="booking" value="save" type="hidden" />
    	<div class="left booking_next"><input type=submit value="<?php echo smartyTranslate(array('s'=>'Save'),$_smarty_tpl);?>
" class="button orange medium"/></div>
        <div class="left booking_back"><input type="button" class="button white medium" alt="back" value="<?php echo smartyTranslate(array('s'=>'Back'),$_smarty_tpl);?>
" onclick="javascript:location.href='booking_list.php'" /></div>
        <div class="clearfix"></div>
    </div>
    <?php }?>
    </form>
    <br /><br />
</div>
<!-- right content end -->
<div class="clearfix"></div>

<script>
<!--
	$(document).ready(function(){
		// recalc_money();
	});
	
	function calculate() {
		$("input[name='booking']").val("calculate");	
	}

	function onchange_select_roomcount(id, count)
	{
		$('#roomplan_booking_customer_' + id).load('booking_order.php?action=customer&count=' + count + '&id=' + id);
		
		// recalc_money();
	}

//  @deleted
	function recalc_money()
	{
        // never called
		var nights = parseInt($("#nights").val());
		var ids_obj = $('input[name="ids[]"]');
		var total_price = 0;
		var total_div_contents = '';
		for(i = 0; i < ids_obj.length; i++)
		{
			var id = $(ids_obj[i]).val();
			var min_price = parseInt($('#roomplan_minprice_' + id).val());
			var roomcount = parseInt($('#roomcount_' + id).val());
			var roomplan_typename = $('#roomplan_typename_' + id).val();
			var room_price = nights * min_price * roomcount;
			var tmp_price_contents = '';

			$('#roomprice_' + id).html("Room Price : 【" + formatDollar(min_price) + "】 X 【" + nights + "】X 【" + roomcount + '】 = 【' + formatDollar(room_price) + '】    ※貨幣はJPY(日本円）のみで大丈夫です。');
			
			if (total_div_contents != '')
				total_div_contents +=" + ";
			
			// ############################################################
			// tmp_price_contents = "(3X( Semi Double X 6,200 X 1 N ))";
			// ############################################################
			tmp_price_contents = "(";
			if (roomcount > 1)
				tmp_price_contents += roomcount + "X( ";
			
			tmp_price_contents += roomplan_typename;
			tmp_price_contents += " X ";
			tmp_price_contents += formatDollar(min_price);
			tmp_price_contents += " X ";
			tmp_price_contents += nights;
			tmp_price_contents += " N";
				
			if (roomcount > 1)
				tmp_price_contents += " )";
			tmp_price_contents += ")";
			
			// ############################################################
			
			
			
			total_div_contents += tmp_price_contents;
			
			total_price += room_price;
		}
		
		$('#div_total_price').html(total_div_contents + '= <span class="bold font16">' + formatDollar(total_price) + '</span>');
	}
	
	function check_input_fields(names, message)
	{
		var input_objs = $('input[name="' + names +'"]');
			
		for (var j = 0; j < input_objs.length; j++)
		{
			if ($(input_objs[j]).val() == '')
			{
				alert('<?php echo smartyTranslate(array('s'=>'please input family names'),$_smarty_tpl);?>
');
				$(input_objs[j]).focus();
				return false;
			}
		}
		
		return true;
	}
	
	function onsubmit_booking_confirm()
	{
		var ids_obj = $('input[name="ids[]"]');

        // changed validation input customer info
        // at least we need one's info information, not all info

		for(i = 0; i < ids_obj.length; i++)
		{
			var id = $(ids_obj[i]).val();

            var input_fnames_objs = $('input[name="customer_fnames_' + id +'[]"]');
            var input_gnames_objs = $('input[name="customer_gnames_' + id +'[]"]');

            var isAllEmpty = true;
            for (var j = 0; j < input_fnames_objs.length; j++)
            {
                if ($(input_fnames_objs[j]).val() != '' &&
                        $(input_gnames_objs[j]).val() != ''  )
                {
                    isAllEmpty = false;
                    break;
                }
            }

            if (isAllEmpty == true)
            {
                alert("<?php echo smartyTranslate(array('s'=>'At least you must input one customer info'),$_smarty_tpl);?>
");

                return false;
            }
            /*
            if (false == check_input_fields('customer_fnames_' + id + '[]', "<?php echo smartyTranslate(array('s'=>'please input family names'),$_smarty_tpl);?>
"))
            {
                return false;
            }

            if (false == check_input_fields('customer_gnames_' + id + '[]', "<?php echo smartyTranslate(array('s'=>'please input given names'),$_smarty_tpl);?>
"))
            {
                return false;
            }
            */
		}

		
		if ($("#contact_name").val() == '')
		{
			alert("<?php echo smartyTranslate(array('s'=>'please input contact name'),$_smarty_tpl);?>
");
			$("#contact_name").focus();
			return false;
		}
		
		if ($("#contact_email").val() == '')
		{
			alert("<?php echo smartyTranslate(array('s'=>'please input contact email address'),$_smarty_tpl);?>
");
			$("#contact_email").focus();
			return false;
		}

        if (false == validate_email($("#contact_email").val()))
        {
            alert("<?php echo smartyTranslate(array('s'=>'please input correct contact email address'),$_smarty_tpl);?>
");
            $("#contact_email").focus();
            return false;
        }
		
		if ($("#contact_tel").val() == '')
		{
			alert("<?php echo smartyTranslate(array('s'=>'please input contact telephone number'),$_smarty_tpl);?>
");
			$("#contact_tel").focus();
			return false;
		}

        if (false == validate_tel($("#contact_tel").val()))
        {
            alert("<?php echo smartyTranslate(array('s'=>'please input correct telephone number'),$_smarty_tpl);?>
");
            $("#contact_tel").focus();
            return false;
        }
		
		
		return true;
	}
//-->
</script>