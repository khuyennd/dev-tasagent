<?php /* Smarty version Smarty-3.0.7, created on 2015-08-19 11:46:26
         compiled from "/var/www/html/themes/default/hotelpage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10028794155590a806da2a54-80130105%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8a0762ef73941d84980065b1df8058898d2a95d9' => 
    array (
      0 => '/var/www/html/themes/default/hotelpage.tpl',
      1 => 1438824618,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10028794155590a806da2a54-80130105',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include '/var/www/html/tools/smarty/plugins/modifier.date_format.php';
?><style>
	#table_roomplan_list tr.sel_tr{
		background-color: #F4F4F4;
	}
</style>
<script>

	$(function(){
		$('#slides').slides({
			preload: true,
			preloadImage: '<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
loading.gif',
			play: 5000,
			pause: 2500,
			hoverPause: true
		});
	});
	
	$(function (){
		$(".rad_gallery").Slide({
			effect:"scroolLoop",
			autoPlay:false,
			speed:"normal",
			timer:3000,
			steps:1
		});
	});
	
	$(function(){
		var x = 22;
		var y = 20;
		$("a.small_img").hover(function(e){
			//alert(this.width);
 			$("body").append('<p id="bigimage"><img id="showimage" src="'+ this.rel + '"alt="" /></p>');
 			
			
			$(this).find('img').stop().fadeTo('slow',0.6);
			widthJudge(e);
			
			$("#bigimage").fadeTo('slow',1);
		},function(){
			$(this).find('img').stop().fadeTo('slow',1);
			$("#bigimage").remove();
		});
		$("a.small_img").mousemove(function(e){
			widthJudge(e);
		});
		function widthJudge(e){
			var imageWidth = $("#showimage").width();
 			var imageHeight = $("#showimage").height();
			if (imageWidth > 500 || imageHeight > 500) {
				var ratio = 0, w=imageWidth, h=imageHeight;
				if (imageWidth > imageHeight) {
					ratio = imageWidth / 500; 
					w = 500; h = imageHeight/ratio;
				} else {
					ratio = imageHeight / 500;
					w=imageWidth/ratio; h = 500;
				}
				$("#showimage").width(w);
				$("#showimage").height(h);
			} 
			var marginRight = document.documentElement.clientWidth - e.pageX;
			var imageWidth = $("#bigimage").width();
			
			x= e.pageX - imageWidth / 2;
			  
			$("#bigimage").css({ top:(e.pageY + y ) + 'px',left:( x ) + 'px'});
			/*
			if(marginRight < imageWidth)
			{
				x = imageWidth + 22;
				$("#bigimage").css({ top:(e.pageY - y ) + 'px',left:(e.pageX - x ) + 'px'});
			}else{
				x = 22;
				$("#bigimage").css({ top:(e.pageY - y ) + 'px',left:( x ) + 'px'});
			};
			*/
		} 
	});

</script>

           <!-- right content start -->
           <div class="left right_content_outer">
           	<!-- hotel detail info start -->
               <div class="hotel_detail_outer">
               	<div class="left detail_left_img" <?php if ($_smarty_tpl->getVariable('photoCount')->value==0){?> style="display: none"<?php }?>>
                   	<div id="gallery" class="lad_gallery">
                           <div id="slides">
                               <div class="slides_container lad_image_wrapper">
                               		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('photoList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['index']++;
?>
                               			<div class="hotel_photo1"><table style="width:100%;height:100%"><tr><td style="text-align:center">
                             				<a href="#"><img src="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
asset/<?php echo $_smarty_tpl->tpl_vars['item']->value['w1_path'];?>
" title="" alt="" class="image0" style="width:<?php echo $_smarty_tpl->tpl_vars['item']->value['w1'];?>
px;height:<?php echo $_smarty_tpl->tpl_vars['item']->value['h1'];?>
px;"></a>
                                            </td></tr></table>
                             			</div>
                             		<?php }} ?>
                               </div>
                               <div class="ad_controls" style="width:160px;" >
                               	<table cellpadding="0" cellspacing="0" style="margin:auto;"><tr>
                                   <td width="20"><a href="#" class="prev"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
img_prev.png" alt="Arrow Prev"></a></td>
                                   <td style="padding-left:25px;padding-right:25px;"></td>
                                   <td width="20"><a href="#" class="next"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
img_next.png" alt="Arrow Next"></a></td>
								</tr></table>
                               </div>
                           </div>                            
                       </div>
                   </div>
                <div class="right bold" style="text-align: right">
                        <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>3||($_smarty_tpl->getVariable('cookie')->value->RoleID==1&&$_smarty_tpl->getVariable('cookie')->value->HotelID==$_smarty_tpl->getVariable('mid')->value)){?>
                            <a href="hotelpage.php?mid=<?php echo $_smarty_tpl->getVariable('mid')->value;?>
"><?php echo smartyTranslate(array('s'=>'Hotel Home'),$_smarty_tpl);?>
</a>/
                            <a href="hoteldetail.php?mid=<?php echo $_smarty_tpl->getVariable('mid')->value;?>
"><?php echo smartyTranslate(array('s'=>'Hotel Detail Edit'),$_smarty_tpl);?>
</a>/
                            <a href="roomplanedit.php?hid=<?php echo $_smarty_tpl->getVariable('mid')->value;?>
"><?php echo smartyTranslate(array('s'=>'Room Plan Edit'),$_smarty_tpl);?>
</a>/
                            <a href="room_stock.php?hid=<?php echo $_smarty_tpl->getVariable('mid')->value;?>
"><?php echo smartyTranslate(array('s'=>'Room Stock Management'),$_smarty_tpl);?>
</a>
                        <?php }?>
                </div>
                 <div class="left detail_right_div">
                   	<div class="left hotel_basic_info" style="margin-left:20px;">
                           <p><span  class="bold font18"><?php echo $_smarty_tpl->getVariable('hotel')->value->HotelName;?>
</span><span style="color:#cc0000;padding-left:20px;"><?php echo smartyTranslate(array('s'=>$_smarty_tpl->getVariable('hotel')->value->HotelClassName),$_smarty_tpl);?>
</span></p>
                           <p><?php echo smartyTranslate(array('s'=>'Hotel Number'),$_smarty_tpl);?>
: <?php echo $_smarty_tpl->getVariable('hotel')->value->HotelCode;?>
</p>
                           <p ><?php echo smartyTranslate(array('s'=>'City'),$_smarty_tpl);?>
: <?php echo $_smarty_tpl->getVariable('hotel')->value->HotelCityName;?>
</p>
                           <p><?php echo smartyTranslate(array('s'=>'Address'),$_smarty_tpl);?>
: <?php echo $_smarty_tpl->getVariable('hotel')->value->HotelAddress;?>
&nbsp;&nbsp;&nbsp;
								<a href="javascript:showMap('<?php echo $_smarty_tpl->getVariable('hotel')->value->HotelName;?>
', '<?php echo $_smarty_tpl->getVariable('hotel')->value->HotelAddress_jp;?>
');" class="blue bold">(<?php echo smartyTranslate(array('s'=>'show on map'),$_smarty_tpl);?>
)</a>
							</p>                            
                           <p><?php echo smartyTranslate(array('s'=>'Contact No'),$_smarty_tpl);?>
: <?php echo $_smarty_tpl->getVariable('hotel')->value->HotelContactNo;?>
</p>
                    </div>                   
					<div class="clearfix"></div>
                       
					<div class="rad_gallery"  <?php if ($_smarty_tpl->getVariable('photoCount')->value==0){?> style="display: none"<?php }?>>
						<div class="rad_gallery_nav">
                            <a href="javascript:void(0)" class="rad_prev"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
img_left.png" title="prev" alt="" /></a>
                        </div>
                        <div class="left rad_image_wrapper<?php if ($_smarty_tpl->getVariable('photoCount')->value>6){?>_w<?php }?>">
                            <ul class="rad_thumb_list<?php if ($_smarty_tpl->getVariable('photoCount')->value<=6){?>_l<?php }?>" >
                                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('photoList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['index']++;
?>
                                <?php $_smarty_tpl->tpl_vars["len"] = new Smarty_variable(strlen($_smarty_tpl->tpl_vars['item']->value['HotelFilePath']), null, null);?>
                                    <li>
                                    <a href="#" class="small_img" rel="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
asset/<?php echo $_smarty_tpl->tpl_vars['item']->value['w2_opath'];?>
" >
                                    <div  style="background:url(<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
asset/<?php echo $_smarty_tpl->tpl_vars['item']->value['w2_path'];?>
) no-repeat center center;background-size:<?php echo $_smarty_tpl->tpl_vars['item']->value['w2'];?>
px <?php echo $_smarty_tpl->tpl_vars['item']->value['h2'];?>
px;width:80px;height:60px;overflow:hidden;"></div>
                                    </a></li>
                                <?php }} ?>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="rad_gallery_nav">
                            <a href="javascript:void(0)" class="rad_next"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
img_right.png" title="next" alt="" /></a>
                        </div>                       	  	
                    </div>
                       
                       
                   </div>
                   <div class="clearfix"></div>
               </div>
               <?php if ((($_smarty_tpl->getVariable('cookie')->value->RoleID==1&&$_smarty_tpl->getVariable('cookie')->value->HotelID==$_smarty_tpl->getVariable('mid')->value)||($_smarty_tpl->getVariable('cookie')->value->RoleID==4||$_smarty_tpl->getVariable('cookie')->value->RoleID==5))){?>
               <!-- hotel user -->
               <div style="width:200px;float:left;"><p class="orange_color font14 bold"><?php echo smartyTranslate(array('s'=>'Room Plan'),$_smarty_tpl);?>
</p></div>

               <div style="clear: both" > </div>
               <div class="all_border available_room_div" style="padding-bottom:20px;">                	
               	<table cellpadding="0" cellspacing="0" id="table_roomplan_list">
                   	<thead>
                       	<tr>
                           	<th></th>
                               <th></th>
                               <th><?php echo smartyTranslate(array('s'=>'Room Plan Name'),$_smarty_tpl);?>
</th>
                               <th><?php echo smartyTranslate(array('s'=>'Room Type'),$_smarty_tpl);?>
</th>
                               <th><?php echo smartyTranslate(array('s'=>'Max'),$_smarty_tpl);?>
</th>
                               <th><?php echo smartyTranslate(array('s'=>'Meal'),$_smarty_tpl);?>
</th>
                               <?php if ((($_smarty_tpl->getVariable('cookie')->value->RoleID==1&&$_smarty_tpl->getVariable('cookie')->value->HotelID==$_smarty_tpl->getVariable('mid')->value)||($_smarty_tpl->getVariable('cookie')->value->RoleID==4||$_smarty_tpl->getVariable('cookie')->value->RoleID==5))){?>
                               <?php }else{ ?>
                               <th><?php echo smartyTranslate(array('s'=>'Price'),$_smarty_tpl);?>
</th>
                               <?php }?>
                           </tr>
                       </thead>
                       <tbody>
                       		<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./hotelpage_roomplan_list.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('hotel_roomplan_list',$_smarty_tpl->getVariable('hotel_roomplan_list')->value); echo $_template->getRenderedTemplate();?><?php unset($_template);?>
                       </tbody>
                   </table>
                   <!--
                   <div class="right hotel_booking_btn"><input type="button" class="button orange" alt="booking" value="booking"/></div>
                   <div class="clearfix"></div>
                   -->
               </div>
               <?php }else{ ?>
               <!-- agent or admin user -->
               <!-- hotel detail info end -->
               <form method="post" action="hotelpage.php?mid=<?php echo $_smarty_tpl->getVariable('mid')->value;?>
" name="searchFrm" id="searchFrm" onsubmit="return onsubmit_search_hotelplan_frm()">
            	<input type="hidden" name="search" value="1" />
            	<input type="hidden" id="p" name="p" value="<?php echo $_smarty_tpl->getVariable('p')->value;?>
" />
				<input type="hidden" id="n" name="n" value="<?php echo $_smarty_tpl->getVariable('n')->value;?>
" />
				<input type="hidden" id="SortBy" name="SortBy" value="<?php echo $_smarty_tpl->getVariable('searchForm')->value['SortBy'];?>
" />
				<input type="hidden" id="SortOrder" name="SortOrder" value="<?php echo $_smarty_tpl->getVariable('searchForm')->value['SortOrder'];?>
" />
               <!-- search conditon start -->
               <div class="srch_condition_div">                    
                   <div class="srch_con">
                        <label><?php echo smartyTranslate(array('s'=>'Checkin'),$_smarty_tpl);?>
/<?php echo smartyTranslate(array('s'=>'Checkout'),$_smarty_tpl);?>
</label>
                        <input type="text" value="<?php echo $_smarty_tpl->getVariable('search_form')->value['CheckIn'];?>
" readonly="readonly" style="float:left;" name="CheckIn" id="CheckIn"  />
                        <img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
calendar_icon.jpg" alt="" width="13" class="calendar_icon" onclick="if(self.gfPop)gfPop.fPopCalendar(getById('CheckIn'), 'OnChangeStartDate(\'CheckIn\',\'CheckOut\', \'Nights\',<?php if ((($_smarty_tpl->getVariable('cookie')->value->RoleID==2||$_smarty_tpl->getVariable('cookie')->value->RoleID==3)&&$_smarty_tpl->getVariable('cookie')->value->OldLoginUserName==null)){?>1<?php }else{ ?>0<?php }?>)');" />
                        <select style="float:left; margin-left:5px;" name="Nights" id="Nights" onchange="javascript:OnChangeStartDate('CheckIn','CheckOut', 'Nights', <?php if ((($_smarty_tpl->getVariable('cookie')->value->RoleID==2||$_smarty_tpl->getVariable('cookie')->value->RoleID==3)&&$_smarty_tpl->getVariable('cookie')->value->OldLoginUserName==null)){?>1<?php }else{ ?>0<?php }?>);return false;">
                        	<option value='0'>-</option>
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
                   
                   <div class="srch_btn">
					<input type="submit" name="search" value="<?php echo smartyTranslate(array('s'=>'Search Now'),$_smarty_tpl);?>
"   class="button orange" alt="<?php echo smartyTranslate(array('s'=>'search now'),$_smarty_tpl);?>
"/>
                   </div>
               </div>
               <!-- search conditon end -->
               </form>
               <!-- Information start -->
                <form action="booking_order.php" method="post" id="frm_<?php echo $_smarty_tpl->getVariable('mid')->value;?>
" onsubmit="return onsubmit_booking_room('frm_<?php echo $_smarty_tpl->getVariable('mid')->value;?>
')">
                <input type="hidden" name="checkin" value="<?php echo $_smarty_tpl->getVariable('search_form')->value['CheckIn'];?>
" />
                <input type="hidden" name="checkout" value="<?php echo $_smarty_tpl->getVariable('search_form')->value['CheckOut'];?>
" />
                <input type="hidden" name="hotel_id" value="<?php echo $_smarty_tpl->getVariable('mid')->value;?>
" >
                    <input type="hidden" name="booking" value="order" />
               <p class="orange_color font14 bold" style="margin-top:20px;"><?php echo smartyTranslate(array('s'=>'Available booking plan'),$_smarty_tpl);?>
<span class="darkgray">  <?php echo smartyTranslate(array('s'=>'for'),$_smarty_tpl);?>
: <?php echo smartyTranslate(array('s'=>'Checkin'),$_smarty_tpl);?>
 <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('search_form')->value['CheckIn'],"%-Y-%m-%d");?>
 - <?php echo smartyTranslate(array('s'=>'Checkout'),$_smarty_tpl);?>
 <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('search_form')->value['CheckOut'],"%-Y-%m-%d");?>
 (<?php echo $_smarty_tpl->getVariable('search_form')->value['Nights'];?>
 <?php echo smartyTranslate(array('s'=>'night(s)'),$_smarty_tpl);?>
)</span></p>
               <!-- search result —— available_room start -->
               <?php  $_smarty_tpl->tpl_vars['hotel_item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('hotel_roomplan_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['hotel_item']->key => $_smarty_tpl->tpl_vars['hotel_item']->value){
?>
              <div class="all_border available_room_div">                	
               	<table cellpadding="0" cellspacing="0">
                   	<thead>
                       	<tr>
                           	<th></th>
                               <th></th>
                               <th><?php echo smartyTranslate(array('s'=>'Room Name'),$_smarty_tpl);?>
</th>
                               <th><?php echo smartyTranslate(array('s'=>'Room Type'),$_smarty_tpl);?>
</th>
                               <th><?php echo smartyTranslate(array('s'=>'Max'),$_smarty_tpl);?>
</th>
                               <th><?php echo smartyTranslate(array('s'=>'Meal'),$_smarty_tpl);?>
</th>
                               <th><?php echo smartyTranslate(array('s'=>'Price'),$_smarty_tpl);?>
</th>
                           </tr>
                       </thead>
                       <tbody>
                       		<?php  $_smarty_tpl->tpl_vars['roomplan'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['hotel_item']->value['RoomPlanList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["roomplan"]['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['roomplan']->key => $_smarty_tpl->tpl_vars['roomplan']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["roomplan"]['index']++;
?>
                       		<tr>
                           		<td class="td_checkbox"><?php if (($_smarty_tpl->getVariable('cookie')->value->RoleID>=4)){?><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['roomplan']['index']+1;?>
<?php }else{ ?><input type="checkbox" name="plan_id_amount[]" value="<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomPlanId'];?>
_<?php echo $_smarty_tpl->getVariable('search_form')->value['RoomTypeVals'][$_smarty_tpl->tpl_vars['roomplan']->value['RoomTypeId']];?>
" /><?php }?></td>
                               <td class="td_room_img"><img src="roomfile.php?rpid=<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomPlanId'];?>
" alt="" width="100" /></td>
                               <td style="text-align: left; padding-left: 50px">
									<?php if ($_smarty_tpl->tpl_vars['roomplan']->value['MinAmount']>=$_smarty_tpl->getVariable('search_form')->value['RoomTypeVals'][$_smarty_tpl->tpl_vars['roomplan']->value['RoomTypeId']]){?>
										<input type="button" class="ok_btn" value='<?php echo smartyTranslate(array('s'=>"OK"),$_smarty_tpl);?>
' width="30" />
									<?php }else{ ?>
										<input type="button" class="rq_btn" value='<?php echo smartyTranslate(array('s'=>"RQ"),$_smarty_tpl);?>
' width="30" />
									<?php }?>
									<a href="javascript;" onclick="onclick_roomplan_view(<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomPlanId'];?>
);return false"><?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomPlanName'];?>
</a> <?php if ($_smarty_tpl->tpl_vars['roomplan']->value['UseCon']==1){?><a href="javascript;" onclick="onclick_roomplan_sales(<?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomPlanId'];?>
);return false;"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
sale_icon.png"/></a><?php }?></td>
                               <td><?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['roomplan']->value['RoomTypeName']),$_smarty_tpl);?>
</td>
                               <td><?php echo $_smarty_tpl->tpl_vars['roomplan']->value['RoomMaxPersons'];?>
<?php echo smartyTranslate(array('s'=>'Pax'),$_smarty_tpl);?>
</td>
                               <td>B: <?php if ($_smarty_tpl->tpl_vars['roomplan']->value['Breakfast']==1){?><?php echo smartyTranslate(array('s'=>'Include'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'None'),$_smarty_tpl);?>
<?php }?><br />D: <?php if ($_smarty_tpl->tpl_vars['roomplan']->value['Dinner']==1){?><?php echo smartyTranslate(array('s'=>'Include'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'None'),$_smarty_tpl);?>
<?php }?></td>
                               <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID==1){?>
                                <td>￥ <?php echo number_format($_smarty_tpl->tpl_vars['roomplan']->value['MinPrice'],0,".",", ");?>
</td>
                                <?php }else{ ?>
                                <td>￥ <?php echo number_format(Booking::shoushuliao($_smarty_tpl->tpl_vars['roomplan']->value['MinPrice'],$_smarty_tpl->tpl_vars['roomplan']->value['RoomPlanId']),0,".",", ");?>
</td>
                                <?php }?>
                           </tr>
                           <?php }} ?>
                           <!--
                           <tr>
                           		<td><input type="checkbox" /></td>
                               <td><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
bookinglist_img.jpg" alt="" /></td>
                               <td class="tb_rq_icon">Single Room</td>
                               <td>Single Room</td>
                               <td>1Pax</td>
                               <td>B: Include<br />D: None</td>
                               <td>JPY  4,200</td>
                           </tr>
                           <tr>
                           	<td><input type="checkbox" /></td>
                               <td><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
bookinglist_img.jpg" alt="" /></td>
                               <td class="tb_rq_icon">Single Room</td>
                               <td>Single Room</td>
                               <td>1Pax</td>
                               <td>B: <?php if ($_smarty_tpl->getVariable('roomplan')->value['Breakfast']==1){?><?php echo smartyTranslate(array('s'=>'Include'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'None'),$_smarty_tpl);?>
<?php }?><br />D: <?php if ($_smarty_tpl->getVariable('roomplan')->value['Dinner']==1){?><?php echo smartyTranslate(array('s'=>'Include'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'None'),$_smarty_tpl);?>
<?php }?></td>
                               <td>JPY  4,200</td>
                           </tr>
                           -->
                       </tbody>
                   </table>
                   <?php if (($_smarty_tpl->getVariable('cookie')->value->RoleID==2||$_smarty_tpl->getVariable('cookie')->value->RoleID==3)){?>
                   <div class="right hotel_booking_btn"><input type="submit" name="search" value="<?php echo smartyTranslate(array('s'=>'Booking'),$_smarty_tpl);?>
" class="button orange" alt="<?php echo smartyTranslate(array('s'=>'Booking'),$_smarty_tpl);?>
"/></div>
                   <?php }?>
                   <div class="clearfix"></div>
               </div>
               <?php }} ?>
               <!-- search result —— available_room end -->
                </form>
               <?php }?>
               <!-- recommend hotel list start -->
               <p class="orange_color font14 bold" style="margin-top:20px;"><?php echo smartyTranslate(array('s'=>'Photos of the Hotel'),$_smarty_tpl);?>
</p>
               <div class="all_border hotel_photo_list">
               	
                       	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('photoList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['index']++;
?>
                        <?php $_smarty_tpl->tpl_vars["len"] = new Smarty_variable(strlen($_smarty_tpl->tpl_vars['item']->value['HotelFilePath']), null, null);?>
                        	<div style="width:30%;text-align:center;float:left;padding:10px;">
                        		<div class="hotel_photo" style="background:#f1f1f1 url(<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
asset/<?php echo $_smarty_tpl->tpl_vars['item']->value['w5_path'];?>
) no-repeat center center;background-size:<?php echo $_smarty_tpl->tpl_vars['item']->value['w5'];?>
px <?php echo $_smarty_tpl->tpl_vars['item']->value['h5'];?>
px;"></div>
                        		<div style="text-align:center;"><?php echo $_smarty_tpl->tpl_vars['item']->value['HotelFileName'];?>
</div>
                        	</div>
                        	<?php if (($_smarty_tpl->getVariable('smarty')->value['foreach']['item']['index']+1)%3==0){?> <div class="clearfix"></div><?php }?>
                        <?php }} ?>
                        <div class="clearfix"></div>
				
               </div>                     
               <!-- recommend hotel list end -->
               
               <!-- Hotel Features list start -->
               <p class="orange_color font14 bold" style="margin-top:20px;float:left;"><?php echo smartyTranslate(array('s'=>'Hotel Features'),$_smarty_tpl);?>
</p>
               <p style="float:right; color:#666; margin-top:20px;"><span class="orange_color bold" style="font-family:Tahoma">√</span> <?php echo smartyTranslate(array('s'=>'Available'),$_smarty_tpl);?>
   <span style="color:#666;font-family:Tahoma">● <?php echo smartyTranslate(array('s'=>'Not available'),$_smarty_tpl);?>
</span></p>
               <div class="clearfix"></div>
               <div class="all_border hotel_features_list">
               	<table cellpadding="0" cellspacing="0">
                   	<tbody>
                       	<tr>
                       		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('featureList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['index']++;
?>
                            	<td><?php if ($_smarty_tpl->tpl_vars['item']->value['LinkId']>0){?><span class="orange_color bold" style="font-family:Tahoma">√</span><b style="font-family:Tahoma"> <?php echo $_smarty_tpl->tpl_vars['item']->value['FeatureName'];?>
</b><?php }else{ ?><span style="color:#666;font-family:Tahoma;">● <?php echo $_smarty_tpl->tpl_vars['item']->value['FeatureName'];?>
</span><?php }?></td>
                            	<?php if (($_smarty_tpl->getVariable('smarty')->value['foreach']['item']['index']+1)%4==0){?> </tr><tr><?php }?>
                            <?php }} ?>
                       </tbody>
                   </table>
               </div>   
               <!-- Hotel Features list end -->
               
               <!-- Hotel Detail Information start -->
               <div class="hotel_deinfo_div">
               	<div class="hotel_description">
                   	<div class="hotel_deinfo_title" onclick="showapp('hoteldes','hoteldes_detail')"><h4 class="unfold" id="hoteldes"><?php echo smartyTranslate(array('s'=>'Hotel Description'),$_smarty_tpl);?>
</h4></div>
                        <div class="show detail_info" id="hoteldes_detail">
                        	<textarea style="width:96%;height:100px;padding:2%;border:none;" name="HotelDescription"><?php echo $_smarty_tpl->getVariable('hotel')->value->HotelDescription;?>
</textarea>
						</div>
                    </div>
                    
                    <div class="hotel_policy">
                    	<div class="hotel_deinfo_title" onclick="showapp('hotelpol','hotelpol_detail')"><h4 class="fold" id="hotelpol"><?php echo smartyTranslate(array('s'=>'Hotel Policies'),$_smarty_tpl);?>
</h4></div>
                        <div class="hidden detail_info" id="hotelpol_detail">
                        	<textarea style="width:96%;height:100px;padding:2%;border:none;" name="hotel_policy"><?php echo $_smarty_tpl->getVariable('hotel')->value->HotelPolicies;?>
</textarea>
						</div>
                    </div>
                    
                    <div class="hotel_useinfo">
                    	<div class="hotel_deinfo_title" onclick="showapp('usefulinfo','usefulinfo_detail')"><h4 class="fold" id="usefulinfo"><?php echo smartyTranslate(array('s'=>'Useful Information'),$_smarty_tpl);?>
</h4></div>
                       <div class="hidden detail_info" id="usefulinfo_detail" style="border-bottom:1px solid #CCC;">
                        	<textarea style="width:96%;height:100px;padding:2%;border:none;" name="hotel_useinfo"><?php echo $_smarty_tpl->getVariable('hotel')->value->UsefulInformation;?>
</textarea>
						</div>
                    </div>
                    
                </div>   
                <!-- Hotel Detail Information end -->
               <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID==3||$_smarty_tpl->getVariable('cookie')->value->RoleID==2){?>
               <!-- Pop Hotel Recommend start -->
               <p class="orange_color font14 bold" style="margin-top:20px;"><?php echo smartyTranslate(array('s'=>'Similar Hotel'),$_smarty_tpl);?>
</p>
               <a  style="float:right; text-decoration: underline; color: #C00; margin-top:10px; font-size:14px;"></a>
               <div class="left all_border home_hotel_div">                        
                   <div class="pophotel_outer">
                   	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('similarList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['index']++;
?>
                       <div class="pophotel_div" style="width:145px;margin-right:0px;margin-left:6px;">
                       	  <?php if ($_smarty_tpl->tpl_vars['item']->value['HotelFilePath']!=''){?>	
                       	   <div style="width:145px;height:145px;background:#f1f1f1 url(<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
asset/<?php echo $_smarty_tpl->tpl_vars['item']->value['HotelFilePath'];?>
) no-repeat center center;background-size:<?php echo $_smarty_tpl->tpl_vars['item']->value['w5'];?>
px <?php echo $_smarty_tpl->tpl_vars['item']->value['h5'];?>
px;cursor: pointer" onclick="location.href='hotelpage.php?mid=<?php echo $_smarty_tpl->tpl_vars['item']->value['HotelId'];?>
'"></div>
                       <?php }else{ ?>
                       		<div style="width:145px;height:145px;background:#f1f1f1 url(<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
no_image.png) no-repeat center center;background-size:145px 145px;cursor: pointer" onclick="location.href='hotelpage.php?mid=<?php echo $_smarty_tpl->tpl_vars['item']->value['HotelId'];?>
'" ></div>
                       <?php }?>
                           <span class="darkred bold">[<?php echo $_smarty_tpl->tpl_vars['item']->value['AreaName'];?>
]</span>
                           <p style="padding-left:0px;"><a href="hotelpage.php?mid=<?php echo $_smarty_tpl->tpl_vars['item']->value['HotelId'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['HotelName'];?>
</a></p>
                           <p class="money_tag"><?php echo displayPriceSmarty(array('s'=>$_smarty_tpl->tpl_vars['item']->value['LowestPrice'],'nomark'=>1),$_smarty_tpl);?>
</p>
                       </div>
                    <?php }} ?>   
                   </div>
               </div>               
               <?php }?> 
               <div class="clearfix"></div>                   
               <!-- Pop Hotel Recommend end -->
                                   
               <!-- Information end -->
           </div>
           <!-- right content end -->
            <div class="clearfix"></div>       
            <?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./roomplan_popup.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
            <script>
            <!--
            	
        	function onsubmit_search_hotelplan_frm()
        	{
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
        		
        		return true;
        	}
        	function onsubmit_booking_room(frmId)
        	{
        		if ($('#' + frmId + ' input:checked').length == 0)
        		{
        			alert('<?php echo smartyTranslate(array('s'=>'Please select room'),$_smarty_tpl);?>
!');
        			return false;
        		}
        	}
        	
        	function set_roomplan_dragdrop()
        	{
        	
        		$("#table_roomplan_list").tableDnD({
        			onDrop: function(table, row) {
        				// console.log(row.id);
        				// console.log($(row).html());
        				var rows = table.tBodies[0].rows;
        				var id_order = '';
        				for(var i = 0; i < rows.length; i++)
        				{
        					id_order += rows[i].id + ",";
        				}
        				
        				console.log('new order :' + id_order);
        				
        				$('#table_roomplan_list tbody').load('hotelpage.php?mid=<?php echo $_smarty_tpl->getVariable('mid')->value;?>
&setOrder=1', { 'orderList': id_order }, function(){
        					set_roomplan_dragdrop();
        				});
        			},
        			onDragStart: function(table, row){
        				// console.log(row.id);
        			},
        			onDragClass: "sel_tr"
        		});
        	}
        	
        	$(document).ready(function() {
        		set_roomplan_dragdrop();
        		
        	});
            	// -->
            </script>
            
<!--popup_win start -->
<div class="popup_win_frame" id="map_popup" style="display:none" >
<div class="popup_win_view" style="width:650px;height:550px;">
	<div class="title">
    	<div class="close_btn"  onclick="closePopup('map_popup'); return false;"></div>
        <?php echo smartyTranslate(array('s'=>'Map View'),$_smarty_tpl);?>

    </div>
    <div class="edit_view" style="margin:0px;">
		<div id="map_canvas" class="map rounded" style="width:630px;height:510px;"></div>
	</div>
</div>
</div>
<!--popup_win end -->   
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
