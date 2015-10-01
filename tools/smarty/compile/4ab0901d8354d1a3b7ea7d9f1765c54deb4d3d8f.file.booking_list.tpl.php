<?php /* Smarty version Smarty-3.0.7, created on 2015-09-16 04:08:49
         compiled from "/var/www/html/tas-agent/themes/default/booking_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3113894555f8eb5140c5e4-41010707%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4ab0901d8354d1a3b7ea7d9f1765c54deb4d3d8f' => 
    array (
      0 => '/var/www/html/tas-agent/themes/default/booking_list.tpl',
      1 => 1442369380,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3113894555f8eb5140c5e4-41010707',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
            <!-- right content start -->
            <div class="left right_content_outer">
            	<!-- booking list search conditon start -->
            	<form name="searchFrm" method="post" action="booking_list.php">    
				<input type="hidden" id="p" name="p" value="<?php echo $_smarty_tpl->getVariable('p')->value;?>
" />
				<input type="hidden" id="n" name="n" value="<?php echo $_smarty_tpl->getVariable('n')->value;?>
" />
				<input type="hidden" name="settle" value="<?php echo $_smarty_tpl->getVariable('settle')->value;?>
" />
                <div class="bklist_srch_con">
                	<table cellpadding="0" cellspacing="0">
                    	<tbody>
                    	
                        	<tr>
                                <td class="bklist_srch_td"><?php echo smartyTranslate(array('s'=>'Booking Number'),$_smarty_tpl);?>
</td>
                                <td><input type="text" name="BookingNo" id="BookingNo" value="<?php if (isset($_POST['BookingNo'])){?><?php echo $_POST['BookingNo'];?>
<?php }?>"/></td>
                                <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID!=1){?>
                                <td class="bklist_srch_td"><?php echo smartyTranslate(array('s'=>'Hotel Name'),$_smarty_tpl);?>
</td>
                                <td>
                                	<input type="text" name="HotelName" id="HotelName" value="<?php if (isset($_POST['HotelName'])){?><?php echo $_POST['HotelName'];?>
<?php }?>" />
                                	&nbsp;&nbsp;<input type="button" class="button white small" alt="reset" value="<?php echo smartyTranslate(array('s'=>'Reset'),$_smarty_tpl);?>
" onclick="return onBookingReset();" style="width:80px;margin-left:10px;" />
                                </td>
                                <?php }?>
                            </tr>
                            <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID!=1){?>
                            <tr>
                            	<td class="bklist_srch_td"><?php echo smartyTranslate(array('s'=>'Check In Date'),$_smarty_tpl);?>
</td>
                                <td>
                                	<input type="text" id="CheckInDate" name="CheckInDate" style="float:left;" value="<?php if (isset($_POST['CheckInDate'])){?><?php echo $_POST['CheckInDate'];?>
<?php }?>" readonly/>
                                	<img class="calendar_icon" width="13" onclick="if(self.gfPop)gfPop.fPopCalendar(getById('CheckInDate'));" alt="" src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
calendar_icon.jpg">
                                </td>
                                <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID==1){?>
                                <td class="bklist_srch_td"><?php echo smartyTranslate(array('s'=>'Check Out Date'),$_smarty_tpl);?>
</td>
                                <td>
                                	<input type="text" name="CheckOutDate" id="CheckOutDate" style="float:left;" value="<?php if (isset($_POST['CheckOutDate'])){?><?php echo $_POST['CheckOutDate'];?>
<?php }?>" readonly/>
                                	<img class="calendar_icon" width="13" onclick="if(self.gfPop)gfPop.fPopCalendar(getById('CheckOutDate'));" alt="" src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
calendar_icon.jpg">
                                </td>
                                <?php }else{ ?>
                                <td class="bklist_srch_td"><?php echo smartyTranslate(array('s'=>'Due Date'),$_smarty_tpl);?>
</td>
                                <td>
                                	<input type="text" name="DueDate" id="DueDate" style="float:left;" value="<?php if (isset($_POST['DueDate'])){?><?php echo $_POST['DueDate'];?>
<?php }?>" readonly/>
                                	<img class="calendar_icon" width="13" onclick="if(self.gfPop)gfPop.fPopCalendar(getById('DueDate'));" alt="" src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
calendar_icon.jpg">
                                </td>
                                <?php }?>
                            </tr>
                            <?php }?>
                            <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>3){?>
                            <tr>
                            	<td class="bklist_srch_td"><?php echo smartyTranslate(array('s'=>'Managing Director'),$_smarty_tpl);?>
</td>
                                <td>
                                	<input type="text" name="ManagingDirector" id="ManagingDirector" value="<?php if (isset($_POST['ManagingDirector'])){?><?php echo $_POST['ManagingDirector'];?>
<?php }?>"/>
                                </td>
                                <td class="bklist_srch_td"><?php echo smartyTranslate(array('s'=>'Company Name'),$_smarty_tpl);?>
</td>
                                <td>
                                	<input type="text" name="CompanyName" id="CompanyName" value="<?php if (isset($_POST['CompanyName'])){?><?php echo $_POST['CompanyName'];?>
<?php }?>"/>
                                </td>
                            </tr>
                            <?php }?>
                            <tr>
								<td class="bklist_srch_td"><?php echo smartyTranslate(array('s'=>'Booking Status'),$_smarty_tpl);?>
</td>
                                <td>
                                	<select name="OrderStatusId" id="OrderStatusId">
                                		<option value=""><?php echo smartyTranslate(array('s'=>'All'),$_smarty_tpl);?>
</option>
                                		<?php  $_smarty_tpl->tpl_vars['status_item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('statusList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['status_item']->key => $_smarty_tpl->tpl_vars['status_item']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['status_item']->key;
?>
										    <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID!=1){?>
											<?php if ($_smarty_tpl->tpl_vars['k']->value!=6&&$_smarty_tpl->tpl_vars['k']->value!=1&&$_smarty_tpl->tpl_vars['k']->value!=10){?>
                                			<option value="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" <?php if ($_POST['OrderStatusId']==$_smarty_tpl->tpl_vars['k']->value){?>selected<?php }?>><?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['status_item']->value),$_smarty_tpl);?>
</option>
											<?php }?>
											<?php }else{ ?>
											<?php if ($_smarty_tpl->tpl_vars['k']->value!=6&&$_smarty_tpl->tpl_vars['k']->value!=1&&$_smarty_tpl->tpl_vars['k']->value!=10&&$_smarty_tpl->tpl_vars['k']->value!=4&&$_smarty_tpl->tpl_vars['k']->value!=6&&$_smarty_tpl->tpl_vars['k']->value!=8&&$_smarty_tpl->tpl_vars['k']->value!=9){?>
                                			<option value="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" <?php if ($_POST['OrderStatusId']==$_smarty_tpl->tpl_vars['k']->value){?>selected<?php }?>><?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['status_item']->value),$_smarty_tpl);?>
</option>
											<?php }?>
											<?php }?>
                                		<?php }} ?>
                                	</select>
                                </td>
                               <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID!=1){?>
                                <td class="bklist_srch_td"><?php echo smartyTranslate(array('s'=>'Payment Status'),$_smarty_tpl);?>
</td>
                                <td>
                                	<select name="PayStatus" id="PayStatus">
                                		<option value=""><?php echo smartyTranslate(array('s'=>'All'),$_smarty_tpl);?>
</option>
                                		<option value="1" <?php if ($_POST['PayStatus']==1){?>selected<?php }?>><?php echo smartyTranslate(array('s'=>'Not Paid'),$_smarty_tpl);?>
</option>
                                		<option value="2" <?php if ($_POST['PayStatus']==2){?>selected<?php }?>><?php echo smartyTranslate(array('s'=>'Paid'),$_smarty_tpl);?>
</option>
                                	</select>
                                </td>

				     	</tr>
                               <tr>
                                   <td class="bklist_srch_td"><?php echo smartyTranslate(array('s'=>'Booking Time'),$_smarty_tpl);?>
</td>
                                   <td colspan="3">
                                       <input type="text" id="OrderStartDate" name="OrderStartDate" style="float:left;"
                                              value="<?php echo $_smarty_tpl->getVariable('orderStartDate')->value;?>
" readonly/>
                                       <img class="calendar_icon" width="13"
                                            onclick="if(self.gfPop)gfPop.fPopCalendar(getById('OrderStartDate'));"
                                            alt="" src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
calendar_icon.jpg">
                                       <span style="float:left">&nbsp;~&nbsp;</span>
                                       <input type="text" id="OrderEndDate" name="OrderEndDate" style="float:left;"
                                              value="<?php echo $_smarty_tpl->getVariable('orderEndDate')->value;?>
" readonly/>
                                       <img class="calendar_icon" width="13"
                                            onclick="if(self.gfPop)gfPop.fPopCalendar(getById('OrderEndDate'));" alt=""
                                            src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
calendar_icon.jpg">
                                   </td>
                               <?php }?>
                            </tr>
                            <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID==1){?>
                            <tr>
                                <td class="bklist_srch_td"><?php echo smartyTranslate(array('s'=>'Check-IN'),$_smarty_tpl);?>
</td>
                                <td colspan="3">
                                    <input type="text" id="CheckInDateFrom" name="CheckInDateFrom" style="float:left;"
                                           value="<?php echo $_smarty_tpl->getVariable('CheckInDateFrom')->value;?>
" readonly/>
                                    <img class="calendar_icon" width="13"
                                         onclick="if(self.gfPop)gfPop.fPopCalendar(getById('CheckInDateFrom'));" alt=""
                                         src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
calendar_icon.jpg">
                                    <span style="float:left">&nbsp;~&nbsp;</span>
                                    <input type="text" id="CheckInDateTo" name="CheckInDateTo" style="float:left;"
                                           value="<?php echo $_smarty_tpl->getVariable('CheckInDateTo')->value;?>
" readonly/>
                                    <img class="calendar_icon" width="13"
                                         onclick="if(self.gfPop)gfPop.fPopCalendar(getById('CheckInDateTo'));" alt=""
                                         src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
calendar_icon.jpg">
                                </td>
                            </tr>
                            <?php }?>

                        </tbody>
                    </table>
                </div>
                
                <div class="right" style="margin-top:5px;">
                    <input type="button" value="<?php echo smartyTranslate(array('s'=>'Search Now'),$_smarty_tpl);?>
" class="button orange medium" onclick="searchFrm.submit(); return false;" />
                </div>
                </form>
                <div class="clearfix"></div>
                
                <!-- booking list search conditon end -->
                   
                <!-- booking list search result start -->
                <div>
                	<form id="wfs" name="wfs" method="post">
                	<table  class="orange">
                    	<thead>
                        	<tr>
                            	<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>3){?>
                            	<th width="10%" class="odd"><?php echo smartyTranslate(array('s'=>'Agent ID'),$_smarty_tpl);?>
</th>
                            	<th width="10%"><?php echo smartyTranslate(array('s'=>'Company Name'),$_smarty_tpl);?>
</th>
                                <th width="10%" class="odd"><?php echo smartyTranslate(array('s'=>'Managing Director'),$_smarty_tpl);?>
</th>
                                <?php }?>
                                <th width="10%"><?php echo smartyTranslate(array('s'=>'Booking NO'),$_smarty_tpl);?>
</th>
                                <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>1){?>
                                <th width="10%" class="odd"><?php echo smartyTranslate(array('s'=>'Hotel Name'),$_smarty_tpl);?>
</th>
                                <?php }?>
                                <th width="7%" class="<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID==1){?>odd<?php }?>"><?php echo smartyTranslate(array('s'=>'Check-IN'),$_smarty_tpl);?>
</th>
                                <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID==1){?>
                                	<th class="" width="7%"><?php echo smartyTranslate(array('s'=>'Check-Out'),$_smarty_tpl);?>
</th>
                                <?php }else{ ?>
                                	<th width="7%" class="odd"><?php echo smartyTranslate(array('s'=>'Payment Due'),$_smarty_tpl);?>
</th>
                                <?php }?>
                                
                                <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID!=1){?><th width="7%" ><?php echo smartyTranslate(array('s'=>'Total Price'),$_smarty_tpl);?>
</th><?php }?>
                                <th class="odd" width="7%"><?php echo smartyTranslate(array('s'=>'Booking Status'),$_smarty_tpl);?>
</th>
                                <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID!=1){?><th width="7%"><?php echo smartyTranslate(array('s'=>'Payment Status'),$_smarty_tpl);?>
</th><?php }?>
                                <th <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID!=1){?>class="odd"<?php }?> width="6%"></th>
                            </tr>
                        </thead>
                    	<tbody>
                    	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listData')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
                        	<tr>
                                <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>3){?>
                                <td class="odd"><?php echo $_smarty_tpl->tpl_vars['item']->value['AgentID'];?>
</td>
                                <td class=""><?php echo $_smarty_tpl->tpl_vars['item']->value['CompanyName'];?>
</td>
                                <td class="odd"><?php echo $_smarty_tpl->tpl_vars['item']->value['ManagingDirector'];?>
</td>
                                <?php }?>
                                <td class=""><?php echo $_smarty_tpl->tpl_vars['item']->value['BookingNo'];?>
</td>
                                <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>1){?>
                                <td class="odd"><?php echo $_smarty_tpl->tpl_vars['item']->value['HotelName'];?>
</td>
                                <?php }?>
                              	<td class="<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID==1){?>odd<?php }?>"><?php echo $_smarty_tpl->tpl_vars['item']->value['CheckInDate'];?>

                              	<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID==1){?>	
                               		<td class=""><?php echo $_smarty_tpl->tpl_vars['item']->value['CheckOutDate'];?>
</td>
                               	<?php }else{ ?>
                               		<td class="odd"><?php echo $_smarty_tpl->tpl_vars['item']->value['DueDate'];?>
</td>
                               	<?php }?>	
                                <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID!=1){?><td ><?php echo displayPriceSmarty(array('s'=>$_smarty_tpl->tpl_vars['item']->value['TotalPrice']),$_smarty_tpl);?>
</td><?php }?>
                                <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>0){?>
                                <td class="odd"> 
                                	<?php if ($_smarty_tpl->tpl_vars['item']->value['OrderStatusId']!=5&&$_smarty_tpl->tpl_vars['item']->value['OrderStatusId']!=7){?>
	                                	<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>3||$_smarty_tpl->getVariable('cookie')->value->RoleID==1){?>
										    <!-- Admin user start -->
										    <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>3){?>
	                                		<?php if ($_smarty_tpl->tpl_vars['item']->value['isCancell']==1){?>
			                                	<select onchange="change_status(<?php echo $_smarty_tpl->tpl_vars['item']->value['OrderId'];?>
, <?php echo $_smarty_tpl->tpl_vars['item']->value['OrderStatusId'];?>
, this)" style="width:80px;">
				                                	<option  value="<?php echo $_smarty_tpl->tpl_vars['item']->value['OrderStatusId'];?>
"><?php echo smartyTranslate(array('s'=>$_smarty_tpl->getVariable('statusList')->value[$_smarty_tpl->tpl_vars['item']->value['OrderStatusId']]),$_smarty_tpl);?>
</option>
				                                	<?php if ($_smarty_tpl->tpl_vars['item']->value['OrderStatusId']==2||$_smarty_tpl->tpl_vars['item']->value['OrderStatusId']==3||$_smarty_tpl->tpl_vars['item']->value['OrderStatusId']==6||$_smarty_tpl->tpl_vars['item']->value['OrderStatusId']==8){?>  
				                                		<?php if ($_smarty_tpl->tpl_vars['item']->value['OrderStatusId']==2||$_smarty_tpl->tpl_vars['item']->value['OrderStatusId']==6){?>
				                                			<option value="3"><?php echo smartyTranslate(array('s'=>$_smarty_tpl->getVariable('statusList')->value[3]),$_smarty_tpl);?>
</option>
				                                			<option value="5"><?php echo smartyTranslate(array('s'=>$_smarty_tpl->getVariable('statusList')->value[5]),$_smarty_tpl);?>
</option>
				                                		<?php }else{ ?>
				                                			<option value="9"><?php echo smartyTranslate(array('s'=>$_smarty_tpl->getVariable('statusList')->value[9]),$_smarty_tpl);?>
</option>
				                                		<?php }?>
				                                	<?php }?>
				                        			<option value="7"><?php echo smartyTranslate(array('s'=>$_smarty_tpl->getVariable('statusList')->value[7]),$_smarty_tpl);?>
</option>
				                            	</select>
			                            	<?php }else{ ?>
			                            		<?php if ($_smarty_tpl->tpl_vars['item']->value['OrderStatusId']==2||$_smarty_tpl->tpl_vars['item']->value['OrderStatusId']==3||$_smarty_tpl->tpl_vars['item']->value['OrderStatusId']==6||$_smarty_tpl->tpl_vars['item']->value['OrderStatusId']==8){?>
			                            		<select onchange="change_status(<?php echo $_smarty_tpl->tpl_vars['item']->value['OrderId'];?>
, <?php echo $_smarty_tpl->tpl_vars['item']->value['OrderStatusId'];?>
, this)" style="width:80px;">
				                                	<option  value="<?php echo $_smarty_tpl->tpl_vars['item']->value['OrderStatusId'];?>
"><?php echo smartyTranslate(array('s'=>$_smarty_tpl->getVariable('statusList')->value[$_smarty_tpl->tpl_vars['item']->value['OrderStatusId']]),$_smarty_tpl);?>
</option>
			                                		<?php if ($_smarty_tpl->tpl_vars['item']->value['OrderStatusId']==2||$_smarty_tpl->tpl_vars['item']->value['OrderStatusId']==6){?>
			                                			<option value="3"><?php echo smartyTranslate(array('s'=>$_smarty_tpl->getVariable('statusList')->value[3]),$_smarty_tpl);?>
</option>
			                                			<option value="5"><?php echo smartyTranslate(array('s'=>$_smarty_tpl->getVariable('statusList')->value[5]),$_smarty_tpl);?>
</option>
			                                		<?php }else{ ?>
			                                			<option value="9"><?php echo smartyTranslate(array('s'=>$_smarty_tpl->getVariable('statusList')->value[9]),$_smarty_tpl);?>
</option>
			                                		<?php }?>
				                            	</select>	
				                            	<?php }else{ ?>
				                            		<?php echo smartyTranslate(array('s'=>$_smarty_tpl->getVariable('statusList')->value[$_smarty_tpl->tpl_vars['item']->value['OrderStatusId']]),$_smarty_tpl);?>

				                            	<?php }?>
			                            	<?php }?>	
											<?php }else{ ?>
											 <!-- Hotel user start -->
											 <!-- Hotel user can only change status equal 2(confirming) -->
											    <?php if ($_smarty_tpl->tpl_vars['item']->value['OrderStatusId']==2){?>
			                                	<select onchange="change_status(<?php echo $_smarty_tpl->tpl_vars['item']->value['OrderId'];?>
, <?php echo $_smarty_tpl->tpl_vars['item']->value['OrderStatusId'];?>
, this)" style="width:80px;">
				                                	<option  value="<?php echo $_smarty_tpl->tpl_vars['item']->value['OrderStatusId'];?>
"><?php echo smartyTranslate(array('s'=>$_smarty_tpl->getVariable('statusList')->value[$_smarty_tpl->tpl_vars['item']->value['OrderStatusId']]),$_smarty_tpl);?>
</option>
				                                	<option value="3"><?php echo smartyTranslate(array('s'=>$_smarty_tpl->getVariable('statusList')->value[3]),$_smarty_tpl);?>
</option>
				                                	<option value="5"><?php echo smartyTranslate(array('s'=>$_smarty_tpl->getVariable('statusList')->value[5]),$_smarty_tpl);?>
</option>
				                            	</select>
												<?php }else{ ?>
												    <?php echo smartyTranslate(array('s'=>$_smarty_tpl->getVariable('statusList')->value[3]),$_smarty_tpl);?>

                                                <?php }?>
											<?php }?>
		                            	<?php }else{ ?>
		                            		<?php if ($_smarty_tpl->tpl_vars['item']->value['isCancell']==1){?>
		                            			<select onchange="change_status(<?php echo $_smarty_tpl->tpl_vars['item']->value['OrderId'];?>
, <?php echo $_smarty_tpl->tpl_vars['item']->value['OrderStatusId'];?>
, this)" style="width:80px;">
													<?php if ($_smarty_tpl->tpl_vars['item']->value['OrderStatusId']==10){?>
														<option  value="<?php echo $_smarty_tpl->tpl_vars['item']->value['OrderStatusId'];?>
"><?php echo smartyTranslate(array('s'=>'Succeeded'),$_smarty_tpl);?>
</option>
													<?php }else{ ?>
														<option  value="<?php echo $_smarty_tpl->tpl_vars['item']->value['OrderStatusId'];?>
"><?php echo smartyTranslate(array('s'=>$_smarty_tpl->getVariable('statusList')->value[$_smarty_tpl->tpl_vars['item']->value['OrderStatusId']]),$_smarty_tpl);?>
</option>
													<?php }?>
		                                			<option value="7"><?php echo smartyTranslate(array('s'=>$_smarty_tpl->getVariable('statusList')->value[7]),$_smarty_tpl);?>
</option>
		                                		</select>
		                            		<?php }else{ ?>
												<?php if ($_smarty_tpl->tpl_vars['item']->value['OrderStatusId']==10){?>
													<?php echo smartyTranslate(array('s'=>'Succeeded'),$_smarty_tpl);?>

												<?php }else{ ?>
													<?php echo smartyTranslate(array('s'=>$_smarty_tpl->getVariable('statusList')->value[$_smarty_tpl->tpl_vars['item']->value['OrderStatusId']]),$_smarty_tpl);?>

												<?php }?>
		                            		<?php }?>
		                            	<?php }?>
	                            	<?php }else{ ?>
	              						<?php echo smartyTranslate(array('s'=>$_smarty_tpl->getVariable('statusList')->value[$_smarty_tpl->tpl_vars['item']->value['OrderStatusId']]),$_smarty_tpl);?>

	                            	<?php }?>
                                </td>
                                <?php }?>
                                <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID!=1){?>
                                <td>
									<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>3&&$_smarty_tpl->tpl_vars['item']->value['PayStatus']==1){?>
                                		<?php if ($_smarty_tpl->tpl_vars['item']->value['OrderStatusId']==3||$_smarty_tpl->tpl_vars['item']->value['OrderStatusId']==9||$_smarty_tpl->tpl_vars['item']->value['OrderStatusId']==8){?>
										<select id="s_paystatus" onchange="return change_paystatus(<?php echo $_smarty_tpl->tpl_vars['item']->value['OrderId'];?>
, 1, this, <?php echo $_smarty_tpl->tpl_vars['item']->value['money'];?>
)" style="width:70px;">
                                			<option value=1><?php echo smartyTranslate(array('s'=>'Not Paid'),$_smarty_tpl);?>
</option>
                                			<option value=2><?php echo smartyTranslate(array('s'=>'Paid'),$_smarty_tpl);?>
</option>
                                		</select>
                                		<?php }else{ ?>
                                			<?php if ($_smarty_tpl->tpl_vars['item']->value['PayStatus']==1){?> <?php echo smartyTranslate(array('s'=>'Not Paid'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'Paid'),$_smarty_tpl);?>
<?php }?>
                                		<?php }?>
                                	<?php }else{ ?>
                                		<?php if ($_smarty_tpl->tpl_vars['item']->value['PayStatus']==1){?> <?php echo smartyTranslate(array('s'=>'Not Paid'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'Paid'),$_smarty_tpl);?>
<?php }?>
                                	<?php }?>
                                </td>
                                <?php }?>
                                <td <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID!=1){?>class="odd"<?php }?> style="text-align:center">
                                	<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>1&&($_smarty_tpl->tpl_vars['item']->value['OrderStatusId']!=7)){?>
                                		<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleId<4&&$_smarty_tpl->tpl_vars['item']->value['isCancell']==1){?>
                                			<input type="button" value="<?php echo smartyTranslate(array('s'=>'Detail'),$_smarty_tpl);?>
" onclick="location.href='booking_order.php?booking=edit&oid=<?php echo $_smarty_tpl->tpl_vars['item']->value['OrderId'];?>
'" class="orange_border_btn detail_btn" style="width:60px;"/>
                                		<?php }else{ ?>
                                			<input type="button" value="<?php echo smartyTranslate(array('s'=>'Detail'),$_smarty_tpl);?>
" onclick="location.href='booking_confirm.php?booking=view&oid=<?php echo $_smarty_tpl->tpl_vars['item']->value['OrderId'];?>
'" class="orange_border_btn detail_btn" style="width:60px;"/>		
                                		<?php }?>
                                	<?php }else{ ?>
                                	<input type="button" value="<?php echo smartyTranslate(array('s'=>'Detail'),$_smarty_tpl);?>
" onclick="location.href='booking_confirm.php?booking=view&oid=<?php echo $_smarty_tpl->tpl_vars['item']->value['OrderId'];?>
'" class="orange_border_btn detail_btn" style="width:60px;"/>
                                	<?php }?>
                                	
                                	<?php if (!$_smarty_tpl->getVariable('settle')->value&&$_smarty_tpl->getVariable('cookie')->value->RoleID>1){?>
                                	<?php if ($_smarty_tpl->tpl_vars['item']->value['PaymentMethod']>0){?> <input type="button" value="<?php echo smartyTranslate(array('s'=>'Invoice'),$_smarty_tpl);?>
" onclick="location.href='booking_confirm.php?booking=view&oid=<?php echo $_smarty_tpl->tpl_vars['item']->value['OrderId'];?>
'" class="orange_border_btn invoice_btn" style="width:60px;"/><?php }?>
                                	<input type="button" value="<?php echo smartyTranslate(array('s'=>'Voucher'),$_smarty_tpl);?>
" onclick="location.href='booking_confirm.php?booking=view&oid=<?php echo $_smarty_tpl->tpl_vars['item']->value['OrderId'];?>
&voucher=1'" class="orange_border_btn voucher_btn" style="width:60px;"/>
                                	<?php }?>
                                	
                                	<?php if (($_smarty_tpl->tpl_vars['item']->value['OrderStatusId']==3||$_smarty_tpl->tpl_vars['item']->value['OrderStatusId']==9)&&!$_smarty_tpl->getVariable('paymentMethod')->value&&$_smarty_tpl->getVariable('cookie')->value->RoleID>1&&$_smarty_tpl->tpl_vars['item']->value['exp']!=1){?>
                                	<input type="button" value="<?php echo smartyTranslate(array('s'=>'Pay'),$_smarty_tpl);?>
" onclick="location.href='booking_confirm.php?booking=view&oid=<?php echo $_smarty_tpl->tpl_vars['item']->value['OrderId'];?>
&payment=1'" class="orange_border_btn invoice_btn" style="width:60px;"/>	
                                	<?php }?>
                                	
                                </td>
                            </tr>
                        <?php }} ?>
                        <?php if ($_smarty_tpl->getVariable('nb_products')->value==0){?> 
                        	<tr><td colspan="<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>3){?>11<?php }else{ ?>7<?php }?>" style="text-align: center"><?php echo smartyTranslate(array('s'=>'There is no data'),$_smarty_tpl);?>
</td></tr> 
                       	<?php }?>
                        </tbody>
                    </table>
                    </form>
                </div>
                <!-- booking list search result end -->
                
                <!-- page control start -->
                <?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./common/pagination.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
                <div class="clearfix"></div>
                <!-- page control end -->
                
                <br /><br />
            </div>
            <!-- right content end -->
            <div class="clearfix"></div>
            
            
	<!--popup_win start -->
	<div class="popup_win_frame" style="display:none;" id="msgNewDiv">
	<div class="popup_win_view"><form name="msgNewFrm" method="post" action="<?php echo $_smarty_tpl->getVariable('request_uri')->value;?>
" >
		<input type="hidden" name ="MsgId" value="0" />
		<input type="hidden" name ="SubmitMsg" value="1" />
		<input type="hidden" id ="UserId" name ="UserId" value="0" />
		<input type="hidden" id ="CompanyId" name ="CompanyId" value="0" />
				
		<div class="title"><div class="close_btn" onclick="closePopup('msgNewDiv');"></div><?php echo smartyTranslate(array('s'=>'Send Notice'),$_smarty_tpl);?>
</div>
		<div class="edit_view">
		<table class="yellow">
	    	<tr>
	        	<th><?php echo smartyTranslate(array('s'=>'Agent ID'),$_smarty_tpl);?>
</th>
	            <td id="CompanyName"></td>
	        </tr>
	        <tr>    
	            <th><?php echo smartyTranslate(array('s'=>'User ID'),$_smarty_tpl);?>
</th>
	            <td id="UserLoginId"></td>            
	        </tr>
		
	        <tr>
	        	<th><?php echo smartyTranslate(array('s'=>'Title'),$_smarty_tpl);?>
</th>
	            <td><input type="text" name="Title" req style="width:80%;" msg="<?php echo smartyTranslate(array('s'=>'Please input Title'),$_smarty_tpl);?>
" /></td>
	        </tr>
	        <tr>
	        	<th style="vertical-align:top"><?php echo smartyTranslate(array('s'=>'Content'),$_smarty_tpl);?>
</th>
	            <td><textarea style="width:100%;height:100px;" req name="Cont" msg="<?php echo smartyTranslate(array('s'=>'Please input Content'),$_smarty_tpl);?>
"></textarea></td>
	        </tr>
	    </table>
	    </div>
	    <div class="popup_control_bar">
	    	<input type="button" class="button orange" value="<?php echo smartyTranslate(array('s'=>'Send'),$_smarty_tpl);?>
" onclick="if(!getFormData(document.msgNewFrm)) return false;  
		    		document.msgNewFrm.submit();"/>
	        <input type="button" class="button white" value="<?php echo smartyTranslate(array('s'=>'Close'),$_smarty_tpl);?>
" onclick="closePopup('msgNewDiv');"/>
	    </div>
	    
	</form></div>
	</div>
	<!--popup_win end -->
	
	            
            
            
            
 <script type="text/javascript">
function change_paystatus(id, defval, obj, money) {
	if (confirm("<?php echo smartyTranslate(array('s'=>'Are you confirm to change?'),$_smarty_tpl);?>
")){
		setWait();
		$.ajax({
			type : "post",
			datatype : "text",
			data : {
				id : id, 
				status: obj.value, 
				money: money
			},
			url : "<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
booking_list.php?change_pay",
			success : function(data, code){
				unsetWait();
				location.href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
booking_list.php";
			}
		}); 
	} else {
		obj.value = defval;
	}
	return false;
}

function change_status(id, defval, obj) {
	if (confirm("<?php echo smartyTranslate(array('s'=>'Are you confirm to change?'),$_smarty_tpl);?>
")){
		setWait();
		$.ajax({
			type : "post",
			datatype : "text",
			data : {
				id : id,
				status: obj.value
			},
			url : "<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
booking_list.php?change_status",
			success : function(data, code){
				unsetWait();
				location.href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
booking_list.php";
			}
		}); 
	} else {
		obj.value = defval;
	}
	return false;
}
 $(function(){
	 // Verify 
	 $("#btnVerify").click(function(){
		// No Selected
		if($(".check:checked").length == 0) return false;
		if(confirm("<?php echo smartyTranslate(array('s'=>'Are you confirm to verify?'),$_smarty_tpl);?>
")){
			setWait();
			$.ajax({
				type : "post",
				datatype : "text",
				data : $("#wfs").serialize(),
				url : "<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
hotellist.php?verify",
				success : function(data, code){
					unsetWait();
					searchFrm.submit();
				}
			}); 
		} 
	 });

	 // Delete
	 $("#btnDelete").click(function(){
		// No Selected
		if($(".check:checked").length == 0) return false;
		if(confirm("<?php echo smartyTranslate(array('s'=>'Are you confirm to delete?'),$_smarty_tpl);?>
")){
			setWait();
			$.ajax({
				type : "post",
				datatype : "text",
				data : $("#wfs").serialize(),
				url : "<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
hotellist.php?delete",
				success : function(data, code){
					unsetWait();
					searchFrm.submit();
				}
			}); 
		} 
	 });

	// Delete Permanent
	 $("#btnDeleteP").click(function(){
		// No Selected
		if($(".check:checked").length == 0) return false;
		if(confirm("<?php echo smartyTranslate(array('s'=>'Are you confirm to delete permanently?'),$_smarty_tpl);?>
")){
			setWait();
			$.ajax({
				type : "post",
				datatype : "text",
				data : $("#wfs").serialize(),
				url : "<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
hotellist.php?del_permanent",
				success : function(data, code){
					unsetWait();
					searchFrm.submit();
				}
			}); 
		} 
	 });

	// UnDelete 
	 $("#btnUnDelete").click(function(){
		// No Selected
		if($(".check:checked").length == 0) return false;
		if(confirm("<?php echo smartyTranslate(array('s'=>'Are you confirm to undo deleting?'),$_smarty_tpl);?>
")){
			setWait();
			$.ajax({
				type : "post",
				datatype : "text",
				data : $("#wfs").serialize(),
				url : "<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
agentlist.php?undel",
				success : function(data, code){
					unsetWait();
					searchFrm.submit();
				}
			}); 
		} 
	 });
 });
 </script>
