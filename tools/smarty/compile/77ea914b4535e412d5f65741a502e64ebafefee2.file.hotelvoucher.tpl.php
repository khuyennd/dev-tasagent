<?php /* Smarty version Smarty-3.0.7, created on 2015-10-01 02:36:59
         compiled from "/var/www/html/tas-agent/themes/default/hotelvoucher.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2130994853560c9c4b1d95b9-40695136%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '77ea914b4535e412d5f65741a502e64ebafefee2' => 
    array (
      0 => '/var/www/html/tas-agent/themes/default/hotelvoucher.tpl',
      1 => 1443667018,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2130994853560c9c4b1d95b9-40695136',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hotel Voucher</title>
<link href="/tas-agent/themes/default/css/voucher.css" rel="stylesheet" type="text/css" />
</head>
<body style="width: 800px;">
<div id="header_wrap">
  <div id="header">
    	<div class="logo_text">Hotel <span class="orange_color">Voucher</span></div>
        <div class="logo_img"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
/logo.png"/></div>
        <div class="logo_comment">Please present either an electronic or paper copy of your hotel voucher upon check-in</div>
  </div>
</div>
<div id="main_content">
	<div class="main_info">    	
       	<?php echo smartyTranslate(array('s'=>'Hotel'),$_smarty_tpl);?>
: <?php echo $_smarty_tpl->getVariable('booking_info')->value['hotel_info']['HotelName'];?>
<br/>       
        <?php echo smartyTranslate(array('s'=>'Address'),$_smarty_tpl);?>
: <?php echo $_smarty_tpl->getVariable('booking_info')->value['hotel_info']['HotelAddress'];?>
<br/> 
        <?php echo smartyTranslate(array('s'=>'Hotel Contact No'),$_smarty_tpl);?>
: <?php echo $_smarty_tpl->getVariable('booking_info')->value['hotel_info']['HotelContactNo'];?>

    </div>
    <div class="title_bar">1. <?php echo smartyTranslate(array('s'=>'Customer Information'),$_smarty_tpl);?>
</div>
    <div class="gray_box">
    	<table width="100%"><tr>
        	<td width="30%"><span class="gray_color"><?php echo smartyTranslate(array('s'=>'Booking ID'),$_smarty_tpl);?>
:</span>&nbsp;<?php echo $_smarty_tpl->getVariable('booking_info')->value['BookingNo'];?>
</td>
        	<td><span class="gray_color"><?php echo smartyTranslate(array('s'=>'Guest Name'),$_smarty_tpl);?>
:</span>&nbsp;<?php echo $_smarty_tpl->getVariable('booking_info')->value['contact_name'];?>
</td></tr><tr>
			<td><span class="gray_color"><?php echo smartyTranslate(array('s'=>"E-mail"),$_smarty_tpl);?>
:</span>&nbsp;<?php echo $_smarty_tpl->getVariable('booking_info')->value['contact_email'];?>
</td>
            <td><span class="gray_color"><?php echo smartyTranslate(array('s'=>'Tel'),$_smarty_tpl);?>
:</span>&nbsp;<?php echo $_smarty_tpl->getVariable('booking_info')->value['contact_tel'];?>
</td></tr></table>
    </div>
    <div class=" title_bar">2. <?php echo smartyTranslate(array('s'=>'Booking Information'),$_smarty_tpl);?>
</div>
    <div class="gray_box">
    	<table width="100%"><tr>
        	<td width="30%"><span class="gray_color"><?php echo smartyTranslate(array('s'=>'Check In'),$_smarty_tpl);?>
:</span>&nbsp;<?php echo $_smarty_tpl->getVariable('booking_info')->value['checkin'];?>
</td>
            <td><span class="gray_color"><?php echo smartyTranslate(array('s'=>'Check Out'),$_smarty_tpl);?>
:</span>&nbsp;<?php echo $_smarty_tpl->getVariable('booking_info')->value['checkout'];?>
</td></tr><tr>
         	<td colspan="2"><span class="gray_color">Total No or rooms:</span>&nbsp;<?php echo $_smarty_tpl->getVariable('booking_info')->value['roomString'];?>
</td></tr></table>
        <div class="bold title_bar">Rooming Details</div>
        <?php  $_smarty_tpl->tpl_vars['roomplan'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('booking_info')->value['booked_roomplan_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['roomplan']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['roomplan']->key => $_smarty_tpl->tpl_vars['roomplan']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['roomplan']['index']++;
?>
        <?php $_smarty_tpl->tpl_vars["id"] = new Smarty_variable($_smarty_tpl->getVariable('smarty')->value['foreach']['roomplan']['index'], null, null);?>
        <div class="title_bar">- Room <?php echo $_smarty_tpl->getVariable('id')->value+1;?>
</div>
        	<table width="100%"><tr>
        	<td colspan="2"><span class="gray_color"><?php echo smartyTranslate(array('s'=>'Room Plan'),$_smarty_tpl);?>
:</span>&nbsp;<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomPlanName'];?>
</td></tr><tr>
            <td width="30%"><span class="gray_color"><?php echo smartyTranslate(array('s'=>'Room Type'),$_smarty_tpl);?>
:</span>&nbsp;<?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['roomplan']->value['RoomTypeName']),$_smarty_tpl);?>
</td>
  			<td><span class="gray_color"><?php echo smartyTranslate(array('s'=>'no of pax stay at room'),$_smarty_tpl);?>
:</span>&nbsp;<?php echo count($_smarty_tpl->tpl_vars['roomplan']->value['customer_info_list']);?>
</td></tr><tr>
            <td valign="top" colspan="2">
            	<table><tr>
                	<td style="padding:0;vertical-align: top;"><span class="gray_color"><?php echo smartyTranslate(array('s'=>'Guest Name'),$_smarty_tpl);?>
:</span></td>
                	<td style="padding:0;padding-left:5px;">
                	<?php  $_smarty_tpl->tpl_vars['customer'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['roomplan']->value['customer_info_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['customer']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['customer']->key => $_smarty_tpl->tpl_vars['customer']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['customer']['index']++;
?>
                	<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['customer']['index']==0){?>
                		<?php if ($_smarty_tpl->tpl_vars['customer']->value['customer_sex']==1){?>Mr<?php }else{ ?>Mrs<?php }?>&nbsp;<?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_fnames'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_gnames'];?>
&nbsp;(<?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_country_name'];?>
) 
                	<?php }else{ ?>
                		&nbsp;,&nbsp;&nbsp;  <?php if ($_smarty_tpl->tpl_vars['customer']->value['customer_sex']==1){?>Mr<?php }else{ ?>Mrs<?php }?>&nbsp;<?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_fnames'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_gnames'];?>
&nbsp;(<?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_country_name'];?>
)
                	<?php }?>
                	<?php }} ?></td></tr></table>
            </td></tr><tr>
            <td><span class="gray_color"><?php echo smartyTranslate(array('s'=>'Breakfast'),$_smarty_tpl);?>
:</span>&nbsp;
            	<?php if ($_smarty_tpl->tpl_vars['roomplan']->value['Breakfast']==1){?><?php echo smartyTranslate(array('s'=>'Included'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'None'),$_smarty_tpl);?>
<?php }?></td>
            <td><span class="gray_color"><?php echo smartyTranslate(array('s'=>'Dinner'),$_smarty_tpl);?>
:</span>&nbsp;
                <?php if ($_smarty_tpl->tpl_vars['roomplan']->value['Dinner']==1){?><?php echo smartyTranslate(array('s'=>'Included'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'None'),$_smarty_tpl);?>
<?php }?></td></tr><tr>
            <td colspan="2"><span class="gray_color"><?php echo smartyTranslate(array('s'=>'Special Request'),$_smarty_tpl);?>
:</span>&nbsp;
            	<?php if ($_smarty_tpl->tpl_vars['roomplan']->value['req_nonsmoking']==1){?><?php echo smartyTranslate(array('s'=>'Non Smoking'),$_smarty_tpl);?>
,&nbsp;<?php }?>
            	<?php if ($_smarty_tpl->tpl_vars['roomplan']->value['req_smoking']==1){?><?php echo smartyTranslate(array('s'=>'Smoking'),$_smarty_tpl);?>
,&nbsp;<?php }?>
            	<?php if ($_smarty_tpl->tpl_vars['roomplan']->value['req_adjoin']==1){?><?php echo smartyTranslate(array('s'=>'Adjoin room'),$_smarty_tpl);?>
,&nbsp;<?php }?>
            	<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['req_remark'];?>

            
            </td></tr></table>
        
        <div class="gray_color">※ All Special request are subjects to availability</div>
        <?php }} ?>
        
    </div>
    <div class=" title_bar">3. Agent Information</div>
    <div class="gray_box">
    	<table width="100%"><tr>
        	<td colspan="2"><span class="gray_color">Name:</span>&nbsp;<?php echo $_smarty_tpl->getVariable('booking_info')->value['agent_info']->Name;?>
</td></tr><tr>
        	<td width="30%"><span class="gray_color">Phone no:</span>&nbsp;<?php echo $_smarty_tpl->getVariable('booking_info')->value['agent_info']->Tel;?>
</td>
            <td><span class="gray_color">Email:</span>&nbsp;<?php echo $_smarty_tpl->getVariable('booking_info')->value['agent_info']->Email;?>
</td></tr></table>
        <div class="black_color title_bar">Note:</div>
        <div class="gray_color">
        	
-This voucher must be presented during check in. Failure to　do so may result in the reservation not being honored. <br/>
-Hotel has right a right to request credit card or deposit upon arrival to cover and guaranteed any incidental cost that maybe incurred during the stay.<br/>
-If you expect to arrive after 21:00, please inform the hotel your arrival time to avoid being released. In the event of No show or Early check-out, the hotel reserves right to charge a full cancellation fee. <br/>
-In case where Breakfast is included with the room rate, please note that certain hotels may charge extra for children travelling with their parents. If applicable, the hotel will bill you directly. Upon arrival, if you have any question, please verify with hotel.<br/>

        </div>
    </div>

</div>
<div id="footer_wrap">
	<div id="footer">
    	<div class="footer_logo_img"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
bottom_logo.jpg"/></div>
        <div class="footer_text">
        	TAS Agent / TAS Co.,Ltd<br/>
            TEL +81-3-5565-5850
        </div>
        <div class="footer_comment">
        	※TAS Agent はTAS Co.,Ltdが運営しております。　上記予約の内容については直接TASまでご連絡ください。
        </div>
  </div>
</div>
</body>
</html>
<script>
	function printPage() { print(); }
</script>
