<?php /* Smarty version Smarty-3.0.7, created on 2015-09-09 14:35:37
         compiled from "/var/www/tas/themes/default/searchhotel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:187869834655efe149d897c4-91929370%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '33cae7121899d7820ca3d68362b0607e631e1b7e' => 
    array (
      0 => '/var/www/tas/themes/default/searchhotel.tpl',
      1 => 1441591118,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '187869834655efe149d897c4-91929370',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- right content start -->
            <div class="left right_content_outer">
            	<form method="post" action="searchhotel.php" name="searchFrm" id="searchFrm" onsubmit="return onsubmit_search_hotelplan_frm()">
            	<input type="hidden" name="search" value="1" />
            	<input type="hidden" id="p" name="p" value="<?php echo $_smarty_tpl->getVariable('p')->value;?>
" />
				<input type="hidden" id="n" name="n" value="<?php echo $_smarty_tpl->getVariable('n')->value;?>
" />
				<input type="hidden" id="SortBy" name="SortBy" value="<?php echo $_smarty_tpl->getVariable('search_form')->value['SortBy'];?>
" />
				<input type="hidden" id="SortOrder" name="SortOrder" value="<?php echo $_smarty_tpl->getVariable('search_form')->value['SortOrder'];?>
" />
                <input type="hidden" id="HideRQ" name="HideRQ" value="<?php echo $_smarty_tpl->getVariable('search_form')->value['HideRQ'];?>
" />
                <!-- search conditon start -->
                <div class="srch_condition_div">
                    <div class="srch_con">
                        <label><?php echo smartyTranslate(array('s'=>'Area/City'),$_smarty_tpl);?>
</label>
                        <select class="select_class" onchange="return OnSelectArea();" id="selarea" name="AreaId">
                            <option value="0"><?php echo smartyTranslate(array('s'=>'Area Select'),$_smarty_tpl);?>
</option>
                            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('areaList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
                        	<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['AreaId'];?>
" <?php if ($_smarty_tpl->getVariable('search_form')->value['AreaId']==$_smarty_tpl->tpl_vars['item']->value['AreaId']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['AreaName'];?>
(<?php echo $_smarty_tpl->tpl_vars['item']->value['HotelNum'];?>
)</option>
                            <?php }} ?>
                        </select>
                        <select class="select_class" name="CityId" id="selcity">
                            <option value="0"><?php echo smartyTranslate(array('s'=>'City Select'),$_smarty_tpl);?>
</option>
                        </select>
                        <input type="button"  class="button white small" value="<?php echo smartyTranslate(array('s'=>'Reset'),$_smarty_tpl);?>
" alt="reset" onclick="return onAreaReset();" />
                    </div>
                    <div class="clearfix"></div>
                    
                    <div class="srch_con">
                        <label><?php echo smartyTranslate(array('s'=>'Checkin'),$_smarty_tpl);?>
/<?php echo smartyTranslate(array('s'=>'Checkout'),$_smarty_tpl);?>
</label>
                        <input type="text" value="<?php echo $_smarty_tpl->getVariable('search_form')->value['CheckIn'];?>
" readonly="readonly" style="float:left;" name="CheckIn" id="CheckIn"  />
                        <img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
calendar_icon.jpg" alt="" width="13" class="calendar_icon" onclick="if(self.gfPop)gfPop.fPopCalendar(getById('CheckIn'), 'OnChangeStartDate(\'CheckIn\',\'CheckOut\', \'Nights\', <?php if ((($_smarty_tpl->getVariable('cookie')->value->RoleID==2||$_smarty_tpl->getVariable('cookie')->value->RoleID==3)&&$_smarty_tpl->getVariable('cookie')->value->OldLoginUserName==null)){?>1<?php }else{ ?>0<?php }?>)');" />
                        <select style="float:left; margin-left:5px;" name="Nights" id="Nights" onchange="javascript:OnChangeStartDate('CheckIn','CheckOut', 'Nights',<?php if ((($_smarty_tpl->getVariable('cookie')->value->RoleID==2||$_smarty_tpl->getVariable('cookie')->value->RoleID==3)&&$_smarty_tpl->getVariable('cookie')->value->OldLoginUserName==null)){?>1<?php }else{ ?>0<?php }?>);return false;">
                        	<!--<option value='0'>-</option>-->
                        	<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 31+1 - (1) : 1-(31)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                        		<option value=<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
 <?php if ($_smarty_tpl->tpl_vars['i']->value==$_smarty_tpl->getVariable('search_form')->value['Nights']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</option>
                        	<?php }} ?>
                        </select>
                        <span style="display:block; float:left; margin:3px 10px 0 5px;"><?php echo smartyTranslate(array('s'=>'Nights'),$_smarty_tpl);?>
</span>
                        <input type="text" value="<?php echo $_smarty_tpl->getVariable('search_form')->value['CheckOut'];?>
" readonly="readonly" style="float:left;" name="CheckOut" id="CheckOut" />
                        <img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
calendar_icon.jpg" alt="" width="13" class="calendar_icon"  onclick="if(self.gfPop)gfPop.fPopCalendar(getById('CheckOut'), 'OnChangeEndDate(\'CheckIn\',\'CheckOut\', \'Nights\', <?php if ((($_smarty_tpl->getVariable('cookie')->value->RoleID==2||$_smarty_tpl->getVariable('cookie')->value->RoleID==3)&&$_smarty_tpl->getVariable('cookie')->value->OldLoginUserName==null)){?>1<?php }else{ ?>0<?php }?>)');"  />
                    </div>
                    <div class="clearfix"></div>
                    
                    <div class="srch_con" id="div_room_type">
                        <label><?php echo smartyTranslate(array('s'=>'Room Type'),$_smarty_tpl);?>
</label>
                        <?php  $_smarty_tpl->tpl_vars['roomType'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('roomTypeList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['roomType']->key => $_smarty_tpl->tpl_vars['roomType']->value){
?>
                        	<select class="select_type" name="RoomType_<?php echo $_smarty_tpl->tpl_vars['roomType']->value['RoomTypeId'];?>
">
                        		<option value="0"><?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['roomType']->value['RoomTypeName']),$_smarty_tpl);?>
</option>
                        		<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 10+1 - (1) : 1-(10)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                        		<option value=<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
 <?php if ($_smarty_tpl->tpl_vars['i']->value==$_smarty_tpl->getVariable('search_form')->value['RoomTypeVals'][$_smarty_tpl->tpl_vars['roomType']->value['RoomTypeId']]){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</option>
                        		<?php }} ?>
	                     	</select>
                        <?php }} ?>
                    </div>
                    <div class="clearfix"></div>
                    
                    <div class="left srch_con">
                        <label><?php echo smartyTranslate(array('s'=>'Hotel Category'),$_smarty_tpl);?>
</label>
                        <select class="select_class" name="HotelClassId" id="HotelClassId">
                            <option value="0"><?php echo smartyTranslate(array('s'=>'Show All'),$_smarty_tpl);?>
</option>
                            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('classList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
                            	<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['HotelClassId'];?>
" <?php if ($_smarty_tpl->tpl_vars['item']->value['HotelClassId']==$_smarty_tpl->getVariable('search_form')->value['HotelClassId']){?>selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['item']->value['HotelClassName']),$_smarty_tpl);?>
</option>
                            <?php }} ?>
                        </select>
                    </div>
                    
                    <div class="left srch_con">
                        <label><?php echo smartyTranslate(array('s'=>'Hotel name'),$_smarty_tpl);?>
</label>
                        <input type="text" value="<?php echo $_smarty_tpl->getVariable('search_form')->value['HotelName'];?>
" name="HotelName" />
                    </div>
                    <div class="clearfix"></div>
                    
                    <div class="srch_btn">
                        <input type="submit" name="search" value="<?php echo smartyTranslate(array('s'=>'Search Now'),$_smarty_tpl);?>
"   class="button orange medium" alt="<?php echo smartyTranslate(array('s'=>'search now'),$_smarty_tpl);?>
"/>
                    </div>
                </div>
                <!-- search conditon end -->
                </form>
                <!-- Information start -->
                <div class="all_border srch_result_div">
                	<!-- search result —— tips start -->
                	<p class="srch_p"><span class="bold"><?php echo $_smarty_tpl->getVariable('search_area_name')->value;?>
 / <?php echo $_smarty_tpl->getVariable('search_city_name')->value;?>
</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red"><?php echo $_smarty_tpl->getVariable('search_form')->value['CheckIn'];?>
</span>&nbsp;&nbsp;<span class="red"><?php echo smartyTranslate(array('s'=>'DAY'),$_smarty_tpl);?>
</span>&nbsp;<span class="red">/</span>&nbsp;<span class="red"><?php echo $_smarty_tpl->getVariable('search_form')->value['Nights'];?>
</span>&nbsp;<span class="red"><?php echo smartyTranslate(array('s'=>'Nights'),$_smarty_tpl);?>
 </span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo smartyTranslate(array('s'=>'Search Result'),$_smarty_tpl);?>
&nbsp;&nbsp;<span class="red"><?php echo $_smarty_tpl->getVariable('hotel_roomplan_count')->value;?>
</span>&nbsp;&nbsp;<?php echo smartyTranslate(array('s'=>'Hotels'),$_smarty_tpl);?>
</p>
                    <div class="srch_tips_outer">
                    	<div class="srch_tips_title">
                            <?php if (($_smarty_tpl->getVariable('cookie')->value->RoleID==2||$_smarty_tpl->getVariable('cookie')->value->RoleID==3)){?>
                        	<div class="left rank_type_div">
                                <span><?php echo smartyTranslate(array('s'=>'Price'),$_smarty_tpl);?>
</span><?php if ($_smarty_tpl->getVariable('search_form')->value['SortBy']=='price'&&$_smarty_tpl->getVariable('search_form')->value['SortOrder']=='asc'){?>
                                <img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
top_rank_icon_on.png" alt="" width="17" />
                                <?php }else{ ?>
                                <img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
top_rank_icon.png" alt="" width="17" onclick="return setSortValue('price', 'asc');" />
                                <?php }?>
                                <?php if ($_smarty_tpl->getVariable('search_form')->value['SortBy']=='price'&&$_smarty_tpl->getVariable('search_form')->value['SortOrder']=='desc'){?>
                                <img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
bottom_rank_icon_on.png" alt="" width="17" />
                                <?php }else{ ?>
                                <img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
bottom_rank_icon.png" alt="" width="17" onclick="return setSortValue('price', 'desc');" />
                                <?php }?>
                            </div>
                            <?php }?>
                            <div class="left rank_type_div">
                                <span><?php echo smartyTranslate(array('s'=>'Class'),$_smarty_tpl);?>
</span>
                                <?php if ($_smarty_tpl->getVariable('search_form')->value['SortBy']=='class'&&$_smarty_tpl->getVariable('search_form')->value['SortOrder']=='asc'){?>
                                <img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
top_rank_icon_on.png" alt="" width="17" />
                                <?php }else{ ?>
                                <img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
top_rank_icon.png" alt="" width="17" onclick="return setSortValue('class', 'asc');" />
                                <?php }?>
                                <?php if ($_smarty_tpl->getVariable('search_form')->value['SortBy']=='class'&&$_smarty_tpl->getVariable('search_form')->value['SortOrder']=='desc'){?>
                                <img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
bottom_rank_icon_on.png" alt="" width="17" />
                                <?php }else{ ?>
                                <img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
bottom_rank_icon.png" alt="" width="17"  onclick="return setSortValue('class', 'desc');" />
                                <?php }?>
                            </div>
                            <div class="left rank_type_div">
                                <span><?php echo smartyTranslate(array('s'=>'Hotel Name'),$_smarty_tpl);?>
</span>
                                <?php if ($_smarty_tpl->getVariable('search_form')->value['SortBy']=='name'&&$_smarty_tpl->getVariable('search_form')->value['SortOrder']=='asc'){?>
                                <img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
top_rank_icon_on.png" alt="" width="17" />
                                <?php }else{ ?>
                                <img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
top_rank_icon.png" alt="" width="17" onclick="return setSortValue('name', 'asc');" />
                                <?php }?>
                                <?php if ($_smarty_tpl->getVariable('search_form')->value['SortBy']=='name'&&$_smarty_tpl->getVariable('search_form')->value['SortOrder']=='desc'){?>
                                <img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
bottom_rank_icon_on.png" alt="" width="17" />
                                <?php }else{ ?>
                                <img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
bottom_rank_icon.png" alt="" width="17" onclick="return setSortValue('name', 'desc');" />
                                <?php }?>
                            </div>
                            <?php if (($_smarty_tpl->getVariable('cookie')->value->RoleID==2||$_smarty_tpl->getVariable('cookie')->value->RoleID==3)){?>
                            <div class="left only_booking">
                                <input type="checkbox" onclick="javascript:onclick_show_rq(this);" <?php if ($_smarty_tpl->getVariable('search_form')->value['HideRQ']==1){?>checked="checked"<?php }?> id="chk_HideRQ" />
                                <label for="chk_HideRQ"><?php echo smartyTranslate(array('s'=>'See only hotels instant booking available'),$_smarty_tpl);?>
</label>
                            </div>
                            <?php }?>
                        </div>
                        <div class="srch_tips_content">
                        	<p><?php echo smartyTranslate(array('s'=>'Below price includes service charge and tax which are charged in the local country'),$_smarty_tpl);?>
</p>
                            <div><input type="button" class="ok_btn" value='<?php echo smartyTranslate(array('s'=>"OK"),$_smarty_tpl);?>
' width="30" />&nbsp;<?php echo smartyTranslate(array('s'=>'Instant booking available'),$_smarty_tpl);?>
&nbsp;
                            <input type="button" class="rq_btn" value='<?php echo smartyTranslate(array('s'=>"RQ"),$_smarty_tpl);?>
' width="30" />&nbsp;<?php echo smartyTranslate(array('s'=>'Request basic booking:callback in an hour'),$_smarty_tpl);?>
</div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!-- search result —— tips end -->
                    
                    <!-- search result —— hotel list start -->
                    <?php  $_smarty_tpl->tpl_vars['hotel'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('hotel_roomplan_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['hotel']->key => $_smarty_tpl->tpl_vars['hotel']->value){
?>
                    <div class="hotellist_outer">
                    	<div class="left hotellist_left">
                        	<div style="width:200px;height:200px;background:#f1f1f1 url(<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
asset/<?php echo $_smarty_tpl->tpl_vars['hotel']->value['w5_path'];?>
) no-repeat center center;background-size:<?php echo $_smarty_tpl->tpl_vars['hotel']->value['w5'];?>
px <?php echo $_smarty_tpl->tpl_vars['hotel']->value['h5'];?>
px;"></div>                            <!-- 
                            <div class="hotellist_btn">
                            	<p class="left"><a href="hotelpage.php?mid=<?php echo $_smarty_tpl->tpl_vars['hotel']->value['HotelId'];?>
">Preview</a></p>
                            	<p class="right"><a href="javascript:showMap('<?php echo $_smarty_tpl->tpl_vars['hotel']->value['HotelName'];?>
', '<?php echo $_smarty_tpl->tpl_vars['hotel']->value['HotelAddress'];?>
, <?php echo $_smarty_tpl->tpl_vars['hotel']->value['CityName'];?>
, <?php echo $_smarty_tpl->tpl_vars['hotel']->value['AreaName'];?>
, Japan'); ">Location</a></p>
                            </div>
                            -->
                        </div>
                        <form action="booking_order.php" method="post" id="frm_<?php echo $_smarty_tpl->tpl_vars['hotel']->value['HotelId'];?>
" onsubmit="return onsubmit_booking_room('frm_<?php echo $_smarty_tpl->tpl_vars['hotel']->value['HotelId'];?>
')">
                        <input type="hidden" name="checkin" value="<?php echo $_smarty_tpl->getVariable('search_form')->value['CheckIn'];?>
" />
                        <input type="hidden" name="checkout" value="<?php echo $_smarty_tpl->getVariable('search_form')->value['CheckOut'];?>
" />
                        <input type="hidden" name="hotel_id" value="<?php echo $_smarty_tpl->tpl_vars['hotel']->value['HotelId'];?>
" />
                        <input type="hidden" name="booking" value="order" />
                        <div class="right hotellist_right">
                        	<h3><a href="hotelpage.php?mid=<?php echo $_smarty_tpl->tpl_vars['hotel']->value['HotelId'];?>
&CheckIn=<?php echo $_smarty_tpl->getVariable('search_form')->value['CheckIn'];?>
&CheckOut=<?php echo $_smarty_tpl->getVariable('search_form')->value['CheckOut'];?>
&Nights=<?php echo $_smarty_tpl->getVariable('search_form')->value['Nights'];?>
<?php  $_smarty_tpl->tpl_vars['roomType'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('roomTypeList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['roomType']->key => $_smarty_tpl->tpl_vars['roomType']->value){
?>&RoomType_<?php echo $_smarty_tpl->tpl_vars['roomType']->value['RoomTypeId'];?>
=<?php echo $_smarty_tpl->getVariable('search_form')->value['RoomTypeVals'][$_smarty_tpl->tpl_vars['roomType']->value['RoomTypeId']];?>
<?php }} ?>"><?php echo $_smarty_tpl->tpl_vars['hotel']->value['HotelName'];?>
</a></h3>
                            <p><span class="left"><?php echo $_smarty_tpl->tpl_vars['hotel']->value['AreaName'];?>
 / <?php echo $_smarty_tpl->tpl_vars['hotel']->value['CityName'];?>
</span><span class="left orange_color bold">&nbsp;&nbsp;<?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['hotel']->value['HotelClassName']),$_smarty_tpl);?>
</span></p>
                            <div class="clearfix"></div>
                            <div class="hotel_illustration">
                            	<?php echo $_smarty_tpl->tpl_vars['hotel']->value['HotelDescription'];?>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="ok_rq_type">
                            <table cellpadding="0" cellspacing="0">
                                <tbody>
                                	<?php  $_smarty_tpl->tpl_vars['roomplan'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['hotel']->value['RoomPlanList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["roomplan"]['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['roomplan']->key => $_smarty_tpl->tpl_vars['roomplan']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["roomplan"]['index']++;
?>
                                        <?php if (!isset($_smarty_tpl->tpl_vars['roomplan']) || !is_array($_smarty_tpl->tpl_vars['roomplan']->value)) $_smarty_tpl->createLocalArrayVariable('roomplan', null, null);
$_smarty_tpl->tpl_vars['roomplan']->value['MinPrice'] = Booking::shoushuliao($_smarty_tpl->tpl_vars['roomplan']->value['MinPrice'],$_smarty_tpl->tpl_vars['roomplan']->value['RoomPlanId']);?>
                                    <tr >
                                        <td width="50"><?php if (($_smarty_tpl->getVariable('cookie')->value->RoleID>=4)){?><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['roomplan']['index']+1;?>
<?php }else{ ?><input type="checkbox" onchange="javascript:oncheck_changed('<?php echo $_smarty_tpl->tpl_vars['hotel']->value['HotelId'];?>
')" <?php if ($_smarty_tpl->tpl_vars['roomplan']->value['PreSelect']>0){?>checked="checked"<?php }?> name="plan_id_amount[]" value="<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomPlanId'];?>
_<?php echo $_smarty_tpl->getVariable('search_form')->value['RoomTypeVals'][$_smarty_tpl->tpl_vars['roomplan']->value['RoomTypeId']];?>
" minprice="<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['MinPrice'];?>
" ordercount="<?php echo $_smarty_tpl->getVariable('search_form')->value['RoomTypeVals'][$_smarty_tpl->tpl_vars['roomplan']->value['RoomTypeId']];?>
"  /><?php }?></td>
                                        <td width="32">
												<?php if ((($_smarty_tpl->tpl_vars['roomplan']->value['MinAmount']>0)&&($_smarty_tpl->tpl_vars['roomplan']->value['MinAmount']>=$_smarty_tpl->getVariable('search_form')->value['RoomTypeVals'][$_smarty_tpl->tpl_vars['roomplan']->value['RoomTypeId']]))||($_smarty_tpl->getVariable('search_form')->value['CheckIn']=='')){?>
													<input type="button" class="ok_btn" value='<?php echo smartyTranslate(array('s'=>"OK"),$_smarty_tpl);?>
' width="30" />
												<?php }else{ ?>
													<input type="button" class="rq_btn" value='<?php echo smartyTranslate(array('s'=>"RQ"),$_smarty_tpl);?>
' width="30" />
												<?php }?> 
										</td>
                                        <?php if (($_smarty_tpl->getVariable('cookie')->value->RoleID==2||$_smarty_tpl->getVariable('cookie')->value->RoleID==3)){?>
                                            <td><a href="javascript;" onclick="onclick_roomplan_view_with_price(<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomPlanId'];?>
, <?php echo $_smarty_tpl->tpl_vars['roomplan']->value['MinPrice'];?>
);return false"><?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomPlanName'];?>
</a> <?php if ($_smarty_tpl->tpl_vars['roomplan']->value['UseCon']==1){?><a href="javascript;" onclick="onclick_roomplan_sales(<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomPlanId'];?>
);return false;"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
sale_icon.png"/></a><?php }?></td>
                                            <td class="ok_rq_money">￥<?php echo number_format($_smarty_tpl->tpl_vars['roomplan']->value['MinPrice'],0,".",", ");?>
 ~</td>
                                        <?php }else{ ?>
                                            <td><a href="javascript;" onclick="onclick_roomplan_view(<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomPlanId'];?>
);return false"><?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomPlanName'];?>
</a> <?php if ($_smarty_tpl->tpl_vars['roomplan']->value['UseCon']==1){?><a href="javascript;" onclick="onclick_roomplan_sales(<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomPlanId'];?>
);return false;"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
sale_icon.png"/></a><?php }?></td>
                                        <?php }?>
                                        <td class="ok_rq_txt"><?php echo smartyTranslate(array('s'=>"BF"),$_smarty_tpl);?>
:<?php if ($_smarty_tpl->tpl_vars['roomplan']->value['Breakfast']==1){?><?php echo smartyTranslate(array('s'=>'Yes'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'None'),$_smarty_tpl);?>
<?php }?>
                                            <?php echo smartyTranslate(array('s'=>"DN"),$_smarty_tpl);?>
:<?php if ($_smarty_tpl->tpl_vars['roomplan']->value['Dinner']==1){?><?php echo smartyTranslate(array('s'=>'Yes'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'None'),$_smarty_tpl);?>
<?php }?></td>
                                    </tr>
                                    <?php }} ?>
                                </tbody>
                            </table>
                        </div>
                            <?php if (($_smarty_tpl->getVariable('cookie')->value->RoleID==2||$_smarty_tpl->getVariable('cookie')->value->RoleID==3)){?>
                            <div class="booking_div">
                                <p class="right booking_btn">
   									<input type="submit" name="search" value="<?php echo smartyTranslate(array('s'=>'Booking'),$_smarty_tpl);?>
" class="button orange" alt="<?php echo smartyTranslate(array('s'=>'Booking'),$_smarty_tpl);?>
"/>
   								</p>
                                 	<p class="right">1 <?php echo smartyTranslate(array('s'=>'Night Total'),$_smarty_tpl);?>
:<span class="bold" id="price_<?php echo $_smarty_tpl->tpl_vars['hotel']->value['HotelId'];?>
"> ￥ <?php echo number_format(Booking::shoushuliaoByHid($_smarty_tpl->tpl_vars['hotel']->value['BookingPrice'],$_smarty_tpl->tpl_vars['hotel']->value['HotelId']),0,".",", ");?>
</span></p>
                            </div>
                            <?php }?>
                        </form>
                    </div>
                    <?php }} ?>
                    <!-- search result —— hotel list end -->
                    
                    
                    <!-- page control start -->
                    <?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./common/pagination.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
                    <div class="clearfix"></div>
                    <!-- page control end -->
                    
                    <br /><br />
                </div>
                <!-- Information end -->
            </div>
            <!-- right content end -->
            <div class="clearfix"></div>
            
            <?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./roomplan_popup.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
            
            <script>
            <!--
            	$(document).ready(function(){
            		
            		OnSelectArea(<?php echo $_smarty_tpl->getVariable('search_form')->value['CityId'];?>
);
            		
            		// $("#tr_roomplan_32").draggable();
            	});
            	
            	function setSortValue(sortBy, sortOrder)
            	{
            		$("#SortBy").val(sortBy);
            		$("#SortOrder").val(sortOrder);
            		
            		if (onsubmit_search_hotelplan_frm())
            			$("#searchFrm").submit();
            	}
            	
            	function onsubmit_search_hotelplan_frm()
            	{
            		/*if ($("#selarea option:selected").val() == 0)
            		{
            			alert('<?php echo smartyTranslate(array('s'=>'Please select area!'),$_smarty_tpl);?>
');
            			$("#selarea").focus();
            			return false; 
            		}
            		if ($("#selcity option:selected").val() == 0)
            		{
            			alert('<?php echo smartyTranslate(array('s'=>'Please select city!'),$_smarty_tpl);?>
');
            			$("#selcity").focus();
            			return false;
            		}*/
            		<?php if (($_smarty_tpl->getVariable('cookie')->value->RoleID==2||$_smarty_tpl->getVariable('cookie')->value->RoleID==3)){?>
                        if ($("#CheckIn").val() == '')
                        {
                            alert('<?php echo smartyTranslate(array('s'=>'Please select check in date!'),$_smarty_tpl);?>
');
                            $("#CheckIn").focus();
                            return false;
                        }

                        if ($("#CheckOut").val() == '')
                        {
                            alert('<?php echo smartyTranslate(array('s'=>'Please select check out date!'),$_smarty_tpl);?>
');
                            $("#CheckIn").focus();
                            return false;
                        }

                        var roomTypeSelected = false;
                        $('#div_room_type select.select_type option:selected').each(function (i, obj){
                            if (0 != $(obj).val())
                            {
                                roomTypeSelected = true;
                            }
                        });

                        if (!roomTypeSelected)
                        {
                            alert('<?php echo smartyTranslate(array('s'=>'Please select room type!'),$_smarty_tpl);?>
');
                            return false;
                        }
                    <?php }else{ ?>
                        var roomTypeSelected = false;
                        $('#div_room_type select.select_type option:selected').each(function (i, obj){
                            if (0 != $(obj).val())
                            {
                                roomTypeSelected = true;
                            }
                        });

                        if ($("#CheckIn").val() != '' && $("#CheckOut").val() != '')
                        {
                            if (!roomTypeSelected)
                            {
                                alert('<?php echo smartyTranslate(array('s'=>'Please select room type!'),$_smarty_tpl);?>
');
                                return false;
                            }
                        }

                        if (roomTypeSelected)
                        {
                            if ($("#CheckIn").val() == '' || $("#CheckOut").val() == '')
                            {
                                alert('<?php echo smartyTranslate(array('s'=>'Please select CheckIn/CheckOut day!'),$_smarty_tpl);?>
');
                                return false;
                            }
                        }

                    <?php }?>
            		return true;
            	}
            	
            	function onsubmit_booking_room(frmId)
            	{
            		if ($('#' + frmId + ' input:checked').length == 0)
            		{
            			alert('<?php echo smartyTranslate(array('s'=>'Please select room!'),$_smarty_tpl);?>
');
            			return false;
            		}
            	}
            	
            	function oncheck_changed(hotelId)
            	{
            		var total_price = 0;
            		$('#frm_' + hotelId + ' input:checked').each(function(i, obj){
            			var minprice = $(obj).attr('minprice');
            			var ordercount = $(obj).attr('ordercount');
            			total_price += minprice * ordercount; 
            		});
            		
            		$('#price_' + hotelId).html(formatDollar(total_price));
            	}

                function onclick_show_rq(chk)
                {
                    // alert($(chk).is(":checked"));
                    if ($(chk).is(":checked")) {
                        $("#HideRQ").val(1);
                    } else {
                        $("#HideRQ").val(0);
                    }
                    if (onsubmit_search_hotelplan_frm())
                        $("#searchFrm").submit();
                }
            // -->
            </script>
            
            
<!--popup_win start -->
<div class="popup_win_frame" id="map_popup" style="display:none" >
<div class="popup_win_view" style="width:550px;height:400px;">
	<div class="title">
    	<div class="close_btn"  onclick="closePopup('map_popup'); return false;"></div>
        <?php echo smartyTranslate(array('s'=>'Map View'),$_smarty_tpl);?>

    </div>
    <div class="edit_view">
		<div id="map_canvas" class="map rounded" style="width:530px;height:360px;"></div>
	</div>
</div>
</div>
<!--popup_win end -->   
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
            