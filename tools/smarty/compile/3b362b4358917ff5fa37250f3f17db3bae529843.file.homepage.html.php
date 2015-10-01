<?php /* Smarty version Smarty-3.0.7, created on 2015-09-16 04:03:42
         compiled from "/var/www/html/tas-agent/themes/default/homepage.html" */ ?>
<?php /*%%SmartyHeaderCode:98156810255f8ea1e0bf3f8-42170215%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3b362b4358917ff5fa37250f3f17db3bae529843' => 
    array (
      0 => '/var/www/html/tas-agent/themes/default/homepage.html',
      1 => 1442369378,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '98156810255f8ea1e0bf3f8-42170215',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
	<!-- right content start -->
            <div class="left right_content_outer">
            	<form method="post" action="searchhotel.php" name="searchFrm" id="searchFrm" onsubmit="return onsubmit_search_hotelplan_frm()">
            	<input type="hidden" name="search" value="1" />
				<input type="hidden" id="SortBy" name="SortBy" value="<?php echo $_smarty_tpl->getVariable('searchForm')->value['SortBy'];?>
" />
				<input type="hidden" id="SortOrder" name="SortOrder" value="<?php echo $_smarty_tpl->getVariable('searchForm')->value['SortOrder'];?>
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
                        <input type="button" class="button white small" alt="reset" value="<?php echo smartyTranslate(array('s'=>'Reset'),$_smarty_tpl);?>
" onclick="return onAreaReset();" />
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
                        <select style="float:left; margin-left:5px;" name="Nights" id="Nights" onchange="javascript:OnChangeStartDate('CheckIn','CheckOut', 'Nights' ,<?php if ((($_smarty_tpl->getVariable('cookie')->value->RoleID==2||$_smarty_tpl->getVariable('cookie')->value->RoleID==3)&&$_smarty_tpl->getVariable('cookie')->value->OldLoginUserName==null)){?>1<?php }else{ ?>0<?php }?>);return false;">
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
" class="button orange medium" alt="search now"/>
                    </div>
                </div>
                <!-- search conditon end -->
                </form>
                </form>
                <!-- Information start -->
                <div class="home_info_div">
                    <div class="left gray_common_border_box" style="width:49%;min-height:200px;">
                        <div class="title_bar">
                            <span class="orange_color"><?php echo smartyTranslate(array('s'=>'Promotion'),$_smarty_tpl);?>
 <?php echo smartyTranslate(array('s'=>'Information'),$_smarty_tpl);?>
</span>
                            <div class="right">
                             <a href="promotionlist.php?type=0"><input type="button" class="more_btn" value="<?php echo smartyTranslate(array('s'=>'more'),$_smarty_tpl);?>
"/></a>
                            </div>
                        </div>
                        <div class="content_box">
                        <ul>
						<?php  $_smarty_tpl->tpl_vars['pro'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('homePromotionList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['pro']->key => $_smarty_tpl->tpl_vars['pro']->value){
?>
							<li><a class="news_title_li" href="promotiondetail.php?PromotionId=<?php echo $_smarty_tpl->tpl_vars['pro']->value['PromotionId'];?>
" ><span class="darkgray">[<?php echo $_smarty_tpl->tpl_vars['pro']->value['CreateDate'];?>
]</span>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['pro']->value['Title'];?>
</a></li>
						<?php }} ?>
						</ul>
						<div class="clearfix"></div>
                        </div>
                    </div>
                    
                    <div class="right gray_common_border_box" style="width:49%;min-height:200px;">
                    	<div class="title_bar">
                        	<span class="orange_color"><?php echo smartyTranslate(array('s'=>'News'),$_smarty_tpl);?>
/<?php echo smartyTranslate(array('s'=>'Events'),$_smarty_tpl);?>
</span>
                            <div class="right">
                             <a href="promotionlist.php?type=1"><input type="button" class="more_btn" value="<?php echo smartyTranslate(array('s'=>'more'),$_smarty_tpl);?>
"/></a>
                            </div>
                        </div>
                        <div class="content_box">
                        <ul>
						<?php  $_smarty_tpl->tpl_vars['evt'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('homeEventList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['evt']->key => $_smarty_tpl->tpl_vars['evt']->value){
?>
							<li><a class="news_title_li" href="promotiondetail.php?PromotionId=<?php echo $_smarty_tpl->tpl_vars['evt']->value['PromotionId'];?>
"><span class="darkgray">[<?php echo $_smarty_tpl->tpl_vars['evt']->value['UpdateDate'];?>
]</span>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['evt']->value['Title'];?>
</a></li>
						<?php }} ?>
						</ul>
						<div class="clearfix"></div>
                        </div>						
                    </div>
                    <div class="clearfix"></div>
                    
                    <div class="gray_common_border_box">
                    	<div class="gray_tabs" id = "popular_area_list_div">
                        	<div class="title_bar">
                            	<span class="orange_color"><?php echo smartyTranslate(array('s'=>'Popular'),$_smarty_tpl);?>
<?php echo smartyTranslate(array('s'=>'Hotel'),$_smarty_tpl);?>
</span>
                            </div>
                            <ul>
                            	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('homeAreaList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>                        			
                        	 		<?php if ($_smarty_tpl->tpl_vars['item']->value['AreaId']==3){?>
									<li class="on" id="popular_li_<?php echo $_smarty_tpl->tpl_vars['item']->value['AreaId'];?>
"><a href="javascript:reloadPopHotel(<?php echo $_smarty_tpl->tpl_vars['item']->value['AreaId'];?>
, this); "><?php echo $_smarty_tpl->tpl_vars['item']->value['AreaName'];?>
</a></li>	
									<?php }else{ ?>
									<li class="" id="popular_li_<?php echo $_smarty_tpl->tpl_vars['item']->value['AreaId'];?>
"><a href="javascript:reloadPopHotel(<?php echo $_smarty_tpl->tpl_vars['item']->value['AreaId'];?>
, this); "><?php echo $_smarty_tpl->tpl_vars['item']->value['AreaName'];?>
</a></li>	
									<?php }?>
                    			<?php }} ?>
                            </ul>
                       </div>
                        <p class="home_news_title"> </p>
                        <div style="float:right; margin-top:-25px;">
                       
                    	</div>
                        
                        <div class="pophotel_outer" id="pophotel_div">
                            <?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./homepage_popitem.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('popularList',$_smarty_tpl->getVariable('popularList')->value); echo $_template->getRenderedTemplate();?><?php unset($_template);?>
                        </div>
                        <div class="clearfix"></div>
                    </div> 
                </div>
                <!-- Information end -->
            </div>
            <!-- right content end -->
            <div class="clearfix"></div>
            <script>
            <!--
            	$(document).ready(function(){
            		
            		OnSelectArea(<?php echo $_smarty_tpl->getVariable('search_form')->value['CityId'];?>
);
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
            	
            	function reloadPopHotel(areaid) {
            		$('#pophotel_div').load("index.php?getPopHotel&areaid=" + areaid);
            		// $(alink_obj).parents().pa
            		$('#popular_area_list_div li').attr('class', '');
            		$('#popular_li_' + areaid).attr('class', 'on');
            		//$(alink_obj).closest('li').attr('class', 'on');
            	}
            // -->
            </script>