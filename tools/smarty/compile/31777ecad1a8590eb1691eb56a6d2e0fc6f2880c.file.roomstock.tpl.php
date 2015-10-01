<?php /* Smarty version Smarty-3.0.7, created on 2015-08-19 11:46:49
         compiled from "/var/www/html/themes/default/roomstock.tpl" */ ?>
<?php /*%%SmartyHeaderCode:207890273252d6264acca8c4-05122373%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '31777ecad1a8590eb1691eb56a6d2e0fc6f2880c' => 
    array (
      0 => '/var/www/html/themes/default/roomstock.tpl',
      1 => 1438824618,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '207890273252d6264acca8c4-05122373',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<script>
	function moveListMonth(pos){
		var curDay = new Date('<?php echo $_smarty_tpl->getVariable('dateYm')->value;?>
-01');
		curDay.setMonth(curDay.getMonth()+pos);
		var nowDay = new Date();	
		
		if (curDay.getYear() < nowDay.getYear() || (curDay.getYear() == nowDay.getYear() && curDay.getMonth() < nowDay.getMonth())) return; 
		dateYm = get_todaystr("Y-m", curDay, true);
		location.href="room_stock.php?hid=<?php echo $_smarty_tpl->getVariable('hid')->value;?>
&pno=<?php echo $_smarty_tpl->getVariable('pno')->value;?>
&dateYm="+dateYm;
	}
	function changeYM() {
		dateYm = $('#ymselect').val();
		location.href="room_stock.php?hid=<?php echo $_smarty_tpl->getVariable('hid')->value;?>
&pno=<?php echo $_smarty_tpl->getVariable('pno')->value;?>
&dateYm="+dateYm;
	}
	function calFrmSubmit(){
		var frm = document.calFrm;
		if (getFormData(frm)==false)	return false;
		var isOk=true;
		$("input[name='adate[]']").each(function(){
			var tdObj = $(this).parent();
			var date = $(this).val();
			
			var amount = trim(tdObj.find("input[name='amount[]']").val()); 	if (amount=="") amount=0;
			var price = trim(tdObj.find("input[name='price[]']").val()); 	if (price=="") price=0;
			var asia = trim(tdObj.find("input[name='asia[]']").val()); 	if (asia=="") asia=0;
			var euro = trim(tdObj.find("input[name='euro[]']").val()); 	if (euro=="") euro=0;
			if (amount!=0 || price!=0 || asia!=0 ||  euro!=0){
				if(amount == 0){
					// alert(date+"<?php echo smartyTranslate(array('s'=>'`s Amount must be inputed'),$_smarty_tpl);?>
"); isOk=false; return false;
				}
				if(price == 0){
					if (asia == 0 && euro == 0){
						alert(date+"<?php echo smartyTranslate(array('s'=>'`s Asia or Euro must be inputed'),$_smarty_tpl);?>
");	isOk=false; return false;}
				}/*else{
					if (asia != 0 || euro != 0){  
						alert(date+"<?php echo smartyTranslate(array('s'=>'`s All price is inputed, you can`t input Asia and Euro'),$_smarty_tpl);?>
"); isOk=false; return false;}
				}
				*/
				
			} 
			
		});
		if (!isOk) return false;
		document.calFrm.submit();
		alert('<?php echo smartyTranslate(array('s'=>'Updated!'),$_smarty_tpl);?>
');
	}
	
	function batchFrmSubmit(){
		var frm = document.batchFrm;
		var staDate = trim(frm.staDate.value);
		if (staDate == "") {
			alert("<?php echo smartyTranslate(array('s'=>'Please Input Start Time!'),$_smarty_tpl);?>
"); return false;
		}
		var endDate = trim(frm.endDate.value);
		if (endDate == "") {
			alert("<?php echo smartyTranslate(array('s'=>'Please Input End Time!'),$_smarty_tpl);?>
"); return false;
		}
		if(time_cmp(staDate, "00:00:00", endDate, "00:00:00") == false)	{
			alert("<?php echo smartyTranslate(array('s'=>'End Time Must be greater than Start Time.'),$_smarty_tpl);?>
");	return false;
		}
		if(time_cmp("<?php echo $_smarty_tpl->getVariable('prow')->value['staDate'];?>
", "00:00:00", staDate, "00:00:00") == false || 
				time_cmp(endDate , "00:00:00", "<?php echo $_smarty_tpl->getVariable('prow')->value['endDate'];?>
", "00:00:00") == false )	{
			
			alert("<?php echo smartyTranslate(array('s'=>'Selected Duration Must be contained in Room Plan Duration.'),$_smarty_tpl);?>
");	return false;
		}
		if (getFormData(frm)==false)	return false;

		var price = trim(frm.Price.value); 	if (price=="") price=0;
		var asia = trim(frm.Asia.value); 	if (asia=="") asia=0;
		var euro = trim(frm.Euro.value); 	if (euro=="") euro=0;

		/*
		if(price == 0){
			if (asia == 0 || euro == 0){
				alert("<?php echo smartyTranslate(array('s'=>'Please Input both of Asia and Euro'),$_smarty_tpl);?>
"); 
				return false;}
		}else{
			if (asia != 0 || euro != 0){
				alert("<?php echo smartyTranslate(array('s'=>'If you input All price, you can`t input others'),$_smarty_tpl);?>
"); 
				return false;}
		}
		*/
		if (price == 0 && asia == 0 && euro == 0)
		{
			alert("<?php echo smartyTranslate(array('s'=>'Please input price'),$_smarty_tpl);?>
"); 
			$(frm.Price).focus();
			return false;
		}
		
		document.batchFrm.submit();
		alert('<?php echo smartyTranslate(array('s'=>'Updated!'),$_smarty_tpl);?>
');
	}
</script>

            <!-- right content start -->
            <div class="left right_content_outer">
            	<!-- hotel detail info start -->

                <div style="float:left"> <?php echo smartyTranslate(array('s'=>'Room Plan'),$_smarty_tpl);?>
 : <select style="width:120px"
                                                                     onchange="location.href='room_stock.php?hid=<?php echo $_smarty_tpl->getVariable('hid')->value;?>
&pno='+this.value;">
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('planList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['RoomPlanId'];?>
"
                            <?php if ($_smarty_tpl->tpl_vars['item']->value['RoomPlanId']==$_smarty_tpl->getVariable('pno')->value){?>selected<?php }?> ><?php echo $_smarty_tpl->tpl_vars['item']->value['RoomPlanName'];?>
</option>
                <?php }} ?>
                </select></div>
                <div style="float:right;font-weight:bold;"><a
                    <a href="hotelpage.php?mid=<?php echo $_smarty_tpl->getVariable('hid')->value;?>
"><?php echo smartyTranslate(array('s'=>'Hotel Home'),$_smarty_tpl);?>
</a>/
                    <a href="hoteldetail.php?mid=<?php echo $_smarty_tpl->getVariable('hid')->value;?>
"><?php echo smartyTranslate(array('s'=>'Hotel Detail Edit'),$_smarty_tpl);?>
</a>/
                    <a href="roomplanedit.php?hid=<?php echo $_smarty_tpl->getVariable('hid')->value;?>
"><?php echo smartyTranslate(array('s'=>'Room Plan Edit'),$_smarty_tpl);?>
</a>/
                    <a href="room_stock.php?hid=<?php echo $_smarty_tpl->getVariable('hid')->value;?>
"><?php echo smartyTranslate(array('s'=>'Room Stock Management'),$_smarty_tpl);?>
</a>
                </div>

                <p style="color:#666; margin-top:35px; font-size:14px;margin-bottom:10px;font-weight:bold;">1. <?php echo smartyTranslate(array('s'=>'Batch'),$_smarty_tpl);?>
</p>
              <div class="all_border"><form name="batchFrm" action="room_stock.php?pno=<?php echo $_smarty_tpl->getVariable('pno')->value;?>
" method="post">
              	<input type="hidden" name="SubmitBatch" value="1" />
              	<input type="hidden" name="RoomPlanId" value="<?php echo $_smarty_tpl->getVariable('pno')->value;?>
" />
              	<input type="hidden" name="hid" value=<?php echo $_smarty_tpl->getVariable('hid')->value;?>
 />
                <div style="padding:3px;">
                    <div style="float:right;">
						<input type="button" class="button orange medium" value="<?php echo smartyTranslate(array('s'=>'Save'),$_smarty_tpl);?>
" onclick="batchFrmSubmit();"/>
                    </div>
                
                    <label><?php echo smartyTranslate(array('s'=>'Time'),$_smarty_tpl);?>
</label>
                  <input type="text" class="calendar_text" readonly id="staDate" name="staDate" value="<?php echo $_smarty_tpl->getVariable('prow')->value['staDate1'];?>
"/>
                    <img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
calendar_icon.jpg" alt="" width="13" class="calendar_icon2" onclick="if(self.gfPop)gfPop.fPopCalendar(getById('staDate'));"/>
                    <span style="font-family:Tahoma, Geneva, sans-serif">~</span> 
                  <input type="text"  class="calendar_text" readonly id="endDate" name="endDate" value="<?php echo $_smarty_tpl->getVariable('prow')->value['endDate1'];?>
"/>
                    <img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
calendar_icon.jpg" alt="" width="13" class="calendar_icon2"/ onclick="if(self.gfPop)gfPop.fPopCalendar(getById('endDate'));"/>
                    &nbsp;
                    <?php echo smartyTranslate(array('s'=>'stock'),$_smarty_tpl);?>

                  <input type="text" style="width:25px;" name="Amount" req vali="num" msg="<?php echo smartyTranslate(array('s'=>'Please Input Integer Type'),$_smarty_tpl);?>
"/>
                    &nbsp;&nbsp;
                    <?php echo smartyTranslate(array('s'=>'Price'),$_smarty_tpl);?>
:&nbsp;&nbsp;
                    <?php echo smartyTranslate(array('s'=>'All'),$_smarty_tpl);?>
&nbsp;<?php echo smartyTranslate(array('s'=>'JPY'),$_smarty_tpl);?>
<input type="text" style="width:40px;" name="Price" vali="double" msg="<?php echo smartyTranslate(array('s'=>'Please Input Double Type'),$_smarty_tpl);?>
"/>
                    &nbsp;&nbsp;&nbsp;<?php echo smartyTranslate(array('s'=>'Asia'),$_smarty_tpl);?>
&nbsp;<?php echo smartyTranslate(array('s'=>'JPY'),$_smarty_tpl);?>
<input type="text" style="width:40px;" name="Asia" vali="double" msg="<?php echo smartyTranslate(array('s'=>'Please Input Double Type'),$_smarty_tpl);?>
"/>
                    &nbsp;&nbsp;&nbsp;<?php echo smartyTranslate(array('s'=>'Euro'),$_smarty_tpl);?>
&nbsp;<?php echo smartyTranslate(array('s'=>'JPY'),$_smarty_tpl);?>
<input type="text" style="width:40px;" name="Euro" vali="double" msg="<?php echo smartyTranslate(array('s'=>'Please Input Double Type'),$_smarty_tpl);?>
"/>         
                </div>
            </form></div>    
            <span style="color:#ff0000;font-size:11px;">	
            	<?php echo smartyTranslate(array('s'=>'※for price, “All” apply to All Nationality, Asia Apply to Asian Nationality, Euro Apply to All nationality except Asian.'),$_smarty_tpl);?>
 <br/>
				<?php echo smartyTranslate(array('s'=>'If All of price was filled,'),$_smarty_tpl);?>
 <br/>
                <?php echo smartyTranslate(array('s'=>'“Asian” and “Euro” will be applied.'),$_smarty_tpl);?>

            </span>
            <p style="color:#666; margin-top:20px; font-size:14px;margin-bottom:10px;font-weight:bold;">2. <?php echo smartyTranslate(array('s'=>'Calendar'),$_smarty_tpl);?>
</p>
              <div class="all_border"><form name="calFrm" action="room_stock.php?hid=<?php echo $_smarty_tpl->getVariable('hid')->value;?>
" method="post">
              	<input type="hidden" name="SubmitCal" value="1" />
              	<input type="hidden" name="RoomPlanId" value="<?php echo $_smarty_tpl->getVariable('pno')->value;?>
" />
                <div style="padding:5px;padding-top:20px;">
                	<div style="float:left;margin-left:40px;">
                	<input type="button" class="button white medium" value="<?php echo smartyTranslate(array('s'=>'Back'),$_smarty_tpl);?>
" onclick="moveListMonth(-1);"/>
                    </div>
                    <div style="float:right">
                	<input type="button" class="button orange medium" value="<?php echo smartyTranslate(array('s'=>'Next'),$_smarty_tpl);?>
" onclick="moveListMonth(1);"/>
                    </div>
                    <div style="margin:0px auto;text-align:center;">
                    <select style="width:120px;" onchange="changeYM(); return false;" id="ymselect">
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('dateList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
                            <option <?php if ($_smarty_tpl->tpl_vars['item']->value==$_smarty_tpl->getVariable('dateYm')->value){?>selected="selected"<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
                        <?php }} ?>
                    </select>
                    </div>
                    <div class="clearfix" style="height:8px;"></div>
                   <!-- <div class="right">&nbsp;<?php echo smartyTranslate(array('s'=>'Price'),$_smarty_tpl);?>
(<?php echo smartyTranslate(array('s'=>'Euro'),$_smarty_tpl);?>
)</div><div class="map_green icon_box right"></div>
                    <div class="right">&nbsp;<?php echo smartyTranslate(array('s'=>'Price'),$_smarty_tpl);?>
(<?php echo smartyTranslate(array('s'=>'Asia'),$_smarty_tpl);?>
)&nbsp;&nbsp;&nbsp;</div><div class="map_yellow icon_box right"></div>
                    <div class="right">&nbsp;<?php echo smartyTranslate(array('s'=>'Price'),$_smarty_tpl);?>
(<?php echo smartyTranslate(array('s'=>'All'),$_smarty_tpl);?>
)&nbsp;&nbsp;&nbsp;</div><div class="map_red icon_box right"></div>
                    <div class="right">&nbsp;<?php echo smartyTranslate(array('s'=>'stock'),$_smarty_tpl);?>
&nbsp;&nbsp;&nbsp;</div><div class="map_blue icon_box right"></div>
                  <div class="clearfix"></div>-->
                  <div class="calendar_box_lavel"> 
                  	<br/>   <div style="height:4px;"></div>
					<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 5+1 - (0) : 0-(5)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                  	<br/> <?php echo smartyTranslate(array('s'=>'stock'),$_smarty_tpl);?>
<br /><?php echo smartyTranslate(array('s'=>'All'),$_smarty_tpl);?>
<br/><?php echo smartyTranslate(array('s'=>'Asia'),$_smarty_tpl);?>
<br/><?php echo smartyTranslate(array('s'=>'Euro'),$_smarty_tpl);?>
<br/><div style="height:1px;"></div>
					<?php }} ?>
                  </div>
                  <div class="calendar_box" style="float:right;width:735px;">
                    	<table width="100%">
                        	<tr>
                            	<th class="red"><?php echo smartyTranslate(array('s'=>'Sun'),$_smarty_tpl);?>
</th>
                                <th><?php echo smartyTranslate(array('s'=>'Mon'),$_smarty_tpl);?>
</th>
                                <th><?php echo smartyTranslate(array('s'=>'Tue'),$_smarty_tpl);?>
</th>
                                <th><?php echo smartyTranslate(array('s'=>'Wed'),$_smarty_tpl);?>
</th>
                                <th><?php echo smartyTranslate(array('s'=>'Thu'),$_smarty_tpl);?>
</th>
                                <th><?php echo smartyTranslate(array('s'=>'Fri'),$_smarty_tpl);?>
</th>
                                <th class="blue" style="border-right:none;"><?php echo smartyTranslate(array('s'=>'Sat'),$_smarty_tpl);?>
</th>                             
                            </tr>
						  <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 5+1 - (0) : 0-(5)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
							<tr>
							  <?php $_smarty_tpl->tpl_vars['j'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['j']->step = 1;$_smarty_tpl->tpl_vars['j']->total = (int)ceil(($_smarty_tpl->tpl_vars['j']->step > 0 ? 6+1 - (0) : 0-(6)+1)/abs($_smarty_tpl->tpl_vars['j']->step));
if ($_smarty_tpl->tpl_vars['j']->total > 0){
for ($_smarty_tpl->tpl_vars['j']->value = 0, $_smarty_tpl->tpl_vars['j']->iteration = 1;$_smarty_tpl->tpl_vars['j']->iteration <= $_smarty_tpl->tpl_vars['j']->total;$_smarty_tpl->tpl_vars['j']->value += $_smarty_tpl->tpl_vars['j']->step, $_smarty_tpl->tpl_vars['j']->iteration++){
$_smarty_tpl->tpl_vars['j']->first = $_smarty_tpl->tpl_vars['j']->iteration == 1;$_smarty_tpl->tpl_vars['j']->last = $_smarty_tpl->tpl_vars['j']->iteration == $_smarty_tpl->tpl_vars['j']->total;?>
                            	<td style="text-align: left"> 
                            		<?php if ($_smarty_tpl->getVariable('list')->value[$_smarty_tpl->tpl_vars['i']->value*7+$_smarty_tpl->tpl_vars['j']->value]['isout']==''){?> <input type="hidden" name="adate[]" value="<?php echo $_smarty_tpl->getVariable('list')->value[$_smarty_tpl->tpl_vars['i']->value*7+$_smarty_tpl->tpl_vars['j']->value]['ApplyDate'];?>
" /> <?php }?>
                                	<div class="<?php if ($_smarty_tpl->tpl_vars['j']->value==0){?> red <?php }elseif($_smarty_tpl->tpl_vars['j']->value==6){?> blue <?php }?> 
                                			txtcenter bold" ><?php echo substr($_smarty_tpl->getVariable('list')->value[$_smarty_tpl->tpl_vars['i']->value*7+$_smarty_tpl->tpl_vars['j']->value]['ApplyDate'],8);?>
</div>
                                    <input type="text" name="amount[]" class="price_item map_blue"  style="border:none;width:55px;"
                                    	vali="num" msg="<?php echo smartyTranslate(array('s'=>'Please Input Integer Type'),$_smarty_tpl);?>
" 
                                    	<?php if ($_smarty_tpl->getVariable('list')->value[$_smarty_tpl->tpl_vars['i']->value*7+$_smarty_tpl->tpl_vars['j']->value]['isout']=='true'){?> disabled <?php }else{ ?> value="<?php echo displayPriceSmarty(array('s'=>$_smarty_tpl->getVariable('list')->value[$_smarty_tpl->tpl_vars['i']->value*7+$_smarty_tpl->tpl_vars['j']->value]['Amount'],'nomark'=>1),$_smarty_tpl);?>
" <?php }?> /><?php echo smartyTranslate(array('s'=>'rooms'),$_smarty_tpl);?>

                                    <br/><input type="text" class="price_item map_red" readonly  value="<?php if ($_smarty_tpl->getVariable('list')->value[$_smarty_tpl->tpl_vars['i']->value*7+$_smarty_tpl->tpl_vars['j']->value]['isout']=='true'){?><?php }else{ ?><?php echo smartyTranslate(array('s'=>'JPY'),$_smarty_tpl);?>
<?php }?>" style="border:none;width:21px;"/><input type="text" name="price[]" class="price_item map_red"  style="border:none;width:55px;"
                                    	vali="double" msg="<?php echo smartyTranslate(array('s'=>'Please Input Double Type'),$_smarty_tpl);?>
"
                                    	<?php if ($_smarty_tpl->getVariable('list')->value[$_smarty_tpl->tpl_vars['i']->value*7+$_smarty_tpl->tpl_vars['j']->value]['isout']=='true'){?> disabled <?php }else{ ?> value="<?php if ($_smarty_tpl->getVariable('list')->value[$_smarty_tpl->tpl_vars['i']->value*7+$_smarty_tpl->tpl_vars['j']->value]['Asia']>0&&$_smarty_tpl->getVariable('list')->value[$_smarty_tpl->tpl_vars['i']->value*7+$_smarty_tpl->tpl_vars['j']->value]['Euro']>0){?><?php }else{ ?><?php echo displayPriceSmarty(array('s'=>$_smarty_tpl->getVariable('list')->value[$_smarty_tpl->tpl_vars['i']->value*7+$_smarty_tpl->tpl_vars['j']->value]['Price'],'nomark'=>1),$_smarty_tpl);?>
<?php }?>" <?php }?> />
                                    <br/><input type="text" class="price_item map_yellow" readonly  value="<?php if ($_smarty_tpl->getVariable('list')->value[$_smarty_tpl->tpl_vars['i']->value*7+$_smarty_tpl->tpl_vars['j']->value]['isout']=='true'){?><?php }else{ ?><?php echo smartyTranslate(array('s'=>'JPY'),$_smarty_tpl);?>
<?php }?>" style="border:none;width:21px;"/><input type="text" name="asia[]" class="price_item map_yellow" style="border:none;width:55px;"
                                    	vali="double" msg="<?php echo smartyTranslate(array('s'=>'Please Input Double Type'),$_smarty_tpl);?>
"
                                    	<?php if ($_smarty_tpl->getVariable('list')->value[$_smarty_tpl->tpl_vars['i']->value*7+$_smarty_tpl->tpl_vars['j']->value]['isout']=='true'){?> disabled <?php }else{ ?> value="<?php echo displayPriceSmarty(array('s'=>$_smarty_tpl->getVariable('list')->value[$_smarty_tpl->tpl_vars['i']->value*7+$_smarty_tpl->tpl_vars['j']->value]['Asia'],'nomark'=>1),$_smarty_tpl);?>
" <?php }?> />
                                    <br/><input type="text" class="price_item map_green" readonly  value="<?php if ($_smarty_tpl->getVariable('list')->value[$_smarty_tpl->tpl_vars['i']->value*7+$_smarty_tpl->tpl_vars['j']->value]['isout']=='true'){?><?php }else{ ?><?php echo smartyTranslate(array('s'=>'JPY'),$_smarty_tpl);?>
<?php }?>" style="border:none;width:21px;"/><input type="text" name="euro[]" class="price_item map_green" style="border:none;width:55px;"
                                    	vali="double" msg="<?php echo smartyTranslate(array('s'=>'Please Input Double Type'),$_smarty_tpl);?>
"
                                    	<?php if ($_smarty_tpl->getVariable('list')->value[$_smarty_tpl->tpl_vars['i']->value*7+$_smarty_tpl->tpl_vars['j']->value]['isout']=='true'){?> disabled <?php }else{ ?> value="<?php echo displayPriceSmarty(array('s'=>$_smarty_tpl->getVariable('list')->value[$_smarty_tpl->tpl_vars['i']->value*7+$_smarty_tpl->tpl_vars['j']->value]['Euro'],'nomark'=>1),$_smarty_tpl);?>
" <?php }?> />
                                </td>
							  <?php }} ?>
							</tr>
						  <?php }} ?> 
                        </table>
                    </div>
                    <div class="clearfix"></div>
                    <div class="right" style="margin:20px 0px"><input type="button" class="button orange medium" value="<?php echo smartyTranslate(array('s'=>'Save'),$_smarty_tpl);?>
" onclick="calFrmSubmit();"/></div>
                    <div class="clearfix"></div>
                </div>
            </form></div>    
                                   
           </div>
            <!-- right content end -->
            <div class="clearfix"></div>
