<?php /* Smarty version Smarty-3.0.7, created on 2015-09-09 14:09:04
         compiled from "/var/www/tas/themes/default/roomplanedit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:116692142955efdb104972a1-53786751%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '802999c5f02c9ab82b8d14e2e3cf5202c79c6429' => 
    array (
      0 => '/var/www/tas/themes/default/roomplanedit.tpl',
      1 => 1441591112,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '116692142955efdb104972a1-53786751',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/tas/tools/smarty/plugins/modifier.escape.php';
if (!is_callable('smarty_modifier_regex_replace')) include '/var/www/tas/tools/smarty/plugins/modifier.regex_replace.php';
if (!is_callable('smarty_modifier_date_format')) include '/var/www/tas/tools/smarty/plugins/modifier.date_format.php';
?>
            <!-- right content start -->
            <div class="left right_content_outer" id="right_content">
            	<!-- hotel detail info start -->
               <p class="orange_color bold font14" style="width:200px;float:left"><?php echo smartyTranslate(array('s'=>'Room Info'),$_smarty_tpl);?>
</p>
               <div style="float:right;font-weight:bold;">
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
               <div class="clearfix"></div>
               <div style="background:#f6f6f6;margin-top:10px;padding:10px;">
               <table width="100%" class="roomplan_header_comment">
               		<tr>
                    	<td width="10%"><?php echo smartyTranslate(array('s'=>'Room Type'),$_smarty_tpl);?>
</td>
                        <td width="15%"><?php echo smartyTranslate(array('s'=>'Room Plan Name'),$_smarty_tpl);?>
</td>
                        <td width="10%"  style="letter-spacing:-1px;"><?php echo smartyTranslate(array('s'=>'Max'),$_smarty_tpl);?>
</td>
                        <?php if ($_smarty_tpl->getVariable('isHotel')->value!=1){?>
                        <td width="5%"><?php echo smartyTranslate(array('s'=>'stocklinkage'),$_smarty_tpl);?>
</td>
                        <td width="5%"><?php echo smartyTranslate(array('s'=>'pricelinkage'),$_smarty_tpl);?>
</td><?php }?>
                        <td width="5%"><?php echo smartyTranslate(array('s'=>'Breakfast'),$_smarty_tpl);?>
</td>
                        <td width="5%"><?php echo smartyTranslate(array('s'=>'Dinner'),$_smarty_tpl);?>
</td>
                        <td width="15%"><?php echo smartyTranslate(array('s'=>'Room size(sq.m)'),$_smarty_tpl);?>
</td>
                        <td width="10%"><?php echo smartyTranslate(array('s'=>'Consecutive nights'),$_smarty_tpl);?>
</td>
                    </tr>
                </table>
                </div>
                <form action="roomplanedit.php?action=save" method="post" onsubmit="return true;/*onsubmit_roomplan_save()*/" id="frm_roomplan"> 
                <input type="hidden" id="hid" name="hid" value="<?php echo $_smarty_tpl->getVariable('hid')->value;?>
" />
                <input type="hidden" id="roomPlanMaxId" name="roomPlanMaxId" value="0" />
                <input type="hidden" id="roomPlanListCount" name="roomPlanListCount" value="0" />
                <input type="hidden" id="delRpidList" name="delRpidList" value="0" />
              	<div id="roomPlanArea">
             	</div>
	            <div style="margin-top:20px;">
	            	<a href="#" id="add_btn"><input type="button" class="button orange medium" value="<?php echo smartyTranslate(array('s'=>'New'),$_smarty_tpl);?>
"/></a>
	           	</div>
	            <div class="control_bar">
	            	<input type="button" class="button orange medium" alt="save" value="<?php echo smartyTranslate(array('s'=>'Save'),$_smarty_tpl);?>
" onclick="if (onsubmit_roomplan_save()) $('#frm_roomplan').submit() " />&nbsp;&nbsp;
	                <input type="button" class="button white medium" value="<?php echo smartyTranslate(array('s'=>'Cancel'),$_smarty_tpl);?>
" alt="cancel" onclick="javascript:history.go(-1);"/>
	            </div>
	            </form>
                <form action="roomplanedit.php?action=upload&hid=<?php echo $_smarty_tpl->getVariable('hid')->value;?>
" method="post" enctype="multipart/form-data" id="img_form" style="visibility:hidden;">
			        <input type="file" name="myfile[]" multiple="" id="img_upload_btn" accept="image/jpeg,image/png" onchange="return onsubmit_img_form()" />
			        <input type="submit" value="Upload File to Server" class="button orange medium"/>
			    </form>
                
           </div>
           
            <!-- right content end -->
            <div class="clearfix"></div>
            <script>
            <!--

            // store selected id for ajax image upload
            var curr_sel_id = 0;
            
            function getCurrentDateString()
            {
                var currentDate = new Date();
                // return currentDate.format("yyyy-mm-dd");
                
                var day = currentDate.getDate();
                var month = currentDate.getMonth() + 1;
                var year = currentDate.getFullYear();
                return year + "-" + month + "-" + day;
                
            }

            //
            function delRoomPlan(id)
            {
                // get room plan id
                var rpid = $("#room_plan_id_" + id).val();
                // console.log('deleting room_plan_id = ' + rpid);

                if (rpid != 0) // delete for already existing item
                {
                    if (!confirm('<?php echo smartyTranslate(array('s'=>'Are you sure you want to delete?'),$_smarty_tpl);?>
'))
                    {
                        // console.log('user cancelled');
                        return;
                    }

                    $("#delRpidList").val($("#delRpidList").val() + ',' + rpid);
                    // console.log("delete rpid list value = " + $("#delRpidList").val());
                }
                
                var div_id = "#div_roomplan_" + id;
                $(div_id).remove();
                
                // reset number
                $("div.roomplan_class > div:first-child").each(function(i, elem){
                    $(elem).html(i + 1);
                });

                var block_count = $("div.roomplan_class").size();
                // console.log('block count = ' + block_count);
                $("#roomPlanListCount").val(block_count);
            }

            
            
            // add a new room plan
        	function addRoomPlan(id, type, name, maxRooms, zaiku, liaojin, roomSize, planDescription, breakfast, dinner, useCon,
        			conFromTime, conToTime, nights, priceAll, priceAsia,priceEuro)
        	{
        		// console.log("addRoomPlan function id = " + id);
        		
        		// ============================================================
        		// 1. max id and no recalculation
        		// ============================================================
        		// get max id 
        		var maxId = parseInt($("#roomPlanMaxId").val(), 10);
        		var newId = 0;
        		// console.log("max id = " + maxId);

        		if (id == 0)
        		{
        			maxId++;
        			newId = maxId;
        		}
        		else 
        		{
        			newId = id;
        			
        			if (maxId < id)
        				maxId = id;
        		}

        		// get max no for display
        		// added new element number for display
        		var newNo = parseInt($("#roomPlanListCount").val(), 10) + 1;

        		var newRoomPlan = $("<div class='roomplan_class' id='div_roomplan_" + newId +"'></div>");

        		// ============================================================
        		// 2. add element
        		// ============================================================
        		
        		// 2.1 add header            		 
        		$(newRoomPlan).append('<div class="orange_color bold left" style="margin:10px 0px 5px 0px;" id="div_roomplan_no_' + newId  + '">' + newNo +'</div>');
        		$(newRoomPlan).append('<div class="right" style="margin-top:5px;cursor: pointer" onclick="' + "javascript:return delRoomPlan(" + newId +")"  + '"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
deletephoto_btn.jpg"/></div>');
        		$(newRoomPlan).append('<div class="clearfix"></div>');

        		// if (id == 0)
//            		id = 'empty';
        		$(newRoomPlan).append('<input type="hidden" name="RoomPlanId[]" id="room_plan_id_' + newId +'" value="' + id +'" />');
        		$(newRoomPlan).append('<input type="hidden" name="RoomPlanClientId[]" value="' + newId +'" />');

        		// 2.2 add content
        		var roomPlanDesc = $('<div class="all_border" style="padding:10px;" />');
        		// $(newRoomPlan).append('<div class="all_border" style="padding:10px;">test</div>');
        		// 2.2.1 add main desc
        		var mainTable = '';
        		mainTable = '<table width="100%" class="roomplan_header">';
        		mainTable += '<tr>';
        		mainTable += '	<td width="10%" class="txtcenter">';
        		mainTable += '    	<select style="width:90%;" name="RoomTypeId[]">';
        		<?php  $_smarty_tpl->tpl_vars['roomType'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('roomTypeList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['roomType']->key => $_smarty_tpl->tpl_vars['roomType']->value){
?>
        		mainTable += '    		<option value="<?php echo $_smarty_tpl->tpl_vars['roomType']->value['RoomTypeId'];?>
" ';
        		if (<?php echo $_smarty_tpl->tpl_vars['roomType']->value['RoomTypeId'];?>
 == type)
        			mainTable += 'selected="selected" ';
        		mainTable += '    		><?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['roomType']->value['RoomTypeName']),$_smarty_tpl);?>
</option>';
        		<?php }} ?>
        		mainTable += '		</select>';
        		mainTable += '    </td>';
        		mainTable += '    <td width="15%" class="txtcenter">';
        		mainTable += '    <input type="text" value="' + name + '" style="width:90%;" name="RoomPlanName[]" value="' + name + '"/>';
        		mainTable += '    </td>';
        		mainTable += '    <td width="10%" class="txtcenter">';
        		mainTable += '		<input type="text" style="width:90%;text-align: right" value="' + maxRooms + '" name="RoomMaxPersons[]" />    ';
        		mainTable += '    </td>';

                mainTable += '    <td  width="5%" class="txtcenter" <?php if ($_smarty_tpl->getVariable('isHotel')->value==1){?>style="display: none"<?php }?>>';
                mainTable += '		<input type="checkbox" value="1" name="zaiku_' + newId + '" ';
                if (zaiku == 1)
                    mainTable += 'checked="checked"';
                mainTable += ' />    ';
                mainTable += '    </td>';
                mainTable += '    <td width="5%" class="txtcenter" <?php if ($_smarty_tpl->getVariable('isHotel')->value==1){?>style="display: none"<?php }?>>';
                mainTable += '    	<input type="checkbox" value="1" name="liaojin_' + newId + '" ';
                if (liaojin == 1)
                    mainTable += 'checked="checked"';
                mainTable += ' />    ';

        		mainTable += '    <td  width="5%" class="txtcenter">';
        		mainTable += '		<input type="checkbox" value="1" name="Breakfast_' + newId + '" ';
        		if (breakfast == 1)
        			mainTable += 'checked="checked"'; 
        		mainTable += ' />    ';
        		mainTable += '    </td>';
        		mainTable += '    <td width="5%" class="txtcenter">';
        		mainTable += '    	<input type="checkbox" value="1" name="Dinner_' + newId + '" ';
        		if (dinner == 1)
        			mainTable += 'checked="checked"'; 
        		mainTable += ' />    ';
        		
        		mainTable += '    </td>';
        		mainTable += '    <td width="15%" class="txtcenter">';
        		mainTable += '		<input type="text" value="' + roomSize + '" name="RoomSize[]" style="width:90%;"/>    	';
        		mainTable += '    </td>';
        		mainTable += '    <td width="10%" class="txtcenter">';
        		
        		mainTable += '      <input type="radio" name="UseCon_' + newId +'[]" value="1" onclick="return onclick_show_con_area('+ newId + ')" ';
        		if (useCon == 1)
        			mainTable += 'checked="checked"';
        		mainTable += ' 			/>';
				mainTable += '    	<label>';
        		mainTable += '      <?php echo smartyTranslate(array('s'=>'Yes'),$_smarty_tpl);?>
</label>                       ';
        		
        		mainTable += '      <input type="radio" name="UseCon_' + newId +'[]" value="0"  onclick="return onclick_hide_con_area('+ newId + ')" ';
        		if (useCon == 0)
        			mainTable += 'checked="checked"';
        		mainTable += ' 			/>';
				mainTable += '    <label>';
        		mainTable += '      <?php echo smartyTranslate(array('s'=>'n1'),$_smarty_tpl);?>
</label>';
        		mainTable += '    </td>';
        		mainTable += '</tr>';
        		mainTable += '</table>';

        		$(roomPlanDesc).append($(mainTable));
        		// 2.2.2 add add consecutive info
        		var hide_style = "";

        		if (useCon == 0)
        			hide_style = "display: none;";
        			
        			
        		var consecutiveDesc = '';

        		consecutiveDesc += '<div style="padding-left:10px;' + hide_style + '" id="div_con_' + newId +'">';
        		consecutiveDesc += '    <?php echo smartyTranslate(array('s'=>'Consecutive nights'),$_smarty_tpl);?>
 <?php echo smartyTranslate(array('s'=>'From'),$_smarty_tpl);?>
 ';
        		consecutiveDesc += '    <input type="text" name="ConFromTime[]" readonly="readonly" value="' + conFromTime + '" style="width:70px;" id="ConStartTime_' + newId + '" />';
        		consecutiveDesc += '        <img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
calendar_icon.jpg" alt="" width="13" onclick="if(self.gfPop)gfPop.fPopCalendar(getById(\'ConStartTime_' + newId + '\'), \'OnChangeConDate(' + newId + ')\');"   />    ';
        		consecutiveDesc += '    <?php echo smartyTranslate(array('s'=>'To'),$_smarty_tpl);?>
';
        		consecutiveDesc += '    <input type="text" name="ConToTime[]" readonly="readonly" value="' + conToTime + '" style="width:70px;" id="ConEndTime_' + newId + '" />';
        		consecutiveDesc += '        <img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
calendar_icon.jpg" alt="" width="13" onclick="if(self.gfPop)gfPop.fPopCalendar(getById(\'ConEndTime_' + newId + '\'), \'OnChangeConDate(' + newId + ')\');"   />    ';
        		consecutiveDesc += '    &nbsp;&nbsp;';
        		consecutiveDesc += '    <?php echo smartyTranslate(array('s'=>'Nights'),$_smarty_tpl);?>
';
        		consecutiveDesc += '    <select  name="Nights[]" id="nights_' + newId + '" onchange="OnChangeNight(' + newId + ')">';
        		for (var i=1;i<=15;i++)
        		{
        		if (i == nights)
        			consecutiveDesc += '        <option selected="selected" value=' + i + '>' + i + '</option>';
        		else	
        			consecutiveDesc += '        <option value=' + i + '>' + i + '</option>';
        		}
        		
        		consecutiveDesc += '    </select>';
        		consecutiveDesc += '    &nbsp;&nbsp;';
        		consecutiveDesc += '    <?php echo smartyTranslate(array('s'=>'Total Price All'),$_smarty_tpl);?>
';
        		consecutiveDesc += '    <input type="text" style="width:40px;text-align: right" name="PriceAll[]" value="' + priceAll +'" />';
        		consecutiveDesc += '    ';
                consecutiveDesc += '    <?php echo smartyTranslate(array('s'=>'Asia'),$_smarty_tpl);?>
';
        		consecutiveDesc += '    <input type="text" style="width:40px;text-align: right" name="PriceAsia[]" value="' + priceAsia +'" />';
        		consecutiveDesc += '    <?php echo smartyTranslate(array('s'=>'Euro'),$_smarty_tpl);?>
';
        		consecutiveDesc += '    <input type="text" style="width:40px;text-align: right" name="PriceEuro[]" value="' + priceEuro +'"/>';
        		consecutiveDesc += '</div>';
        		$(roomPlanDesc).append($(consecutiveDesc));
        		// 2.2.3 add room desc and picture
        		var descAndPic = $('<div class="hotel_deinfo_div" />');

        		// 2.2.3.1 room desc
        		var desc = '';
        		desc += '<div class="hotel_description">';
        		desc += '	<div class="hotel_deinfo_title" onclick="' + "showapp('hoteldes_" + newId + "','hoteldes_detail_" + newId + "')" + '">';
        		desc += '		<h4 class="unfold" id="hoteldes_' + newId + '"><?php echo smartyTranslate(array('s'=>'Room Description'),$_smarty_tpl);?>
</h4>';
        		desc += '	</div>';
        		desc += '	<div class="show detail_info" id="hoteldes_detail_' + newId + '" style="padding:0px;margin:0px;">';
        		desc +=	'		<textarea style="width:96%;height:100px;padding:2%;border:none;" name="RoomPlanDesc[]">' + planDescription +'</textarea>';
        			desc += '	</div>';
        			desc +=	'</div>';
        		
        		descAndPic.append($(desc));
        		// 2.2.3.2 photo
        		var photo = '';
        		
        		photo += '<div class="hotel_policy">';
        		photo += '	<div class="hotel_deinfo_title" onclick="showapp(' + "'hotelpol_" + newId + "','hotelpol_detail_" +  newId + "'" + ')"><h4 class="fold" id="hotelpol_' + newId + '"><?php echo smartyTranslate(array('s'=>'Room Picture'),$_smarty_tpl);?>
</h4></div>';
        		photo += '	<div class="hidden detail_info" id="hotelpol_detail_' + newId + '" style="border-bottom:1px solid #ccc;">';
        		if (!checkIE())
	        		photo += '		<p><a href="#"><input type="button" class="button orange medium" value="<?php echo smartyTranslate(array('s'=>'Upload Photo'),$_smarty_tpl);?>
" onclick="return onupload_photo(' + newId + ')" /></a></p>';
	        	else 
	        	{
					photo += '<p>';
										
					
					photo += '<form action="roomplanedit.php?action=upload&hid=<?php echo $_smarty_tpl->getVariable('hid')->value;?>
" method="post" enctype="multipart/form-data" id="img_form" >';
			        photo += '<input type="file" name="myfile[]" multiple="" id="img_upload_btn" accept="image/jpeg,image/png" onchange="javascript:if (!check_upload_limit('+ newId + ')) return false;curr_sel_id = ' + newId + ';return onsubmit_img_form()" />';
					photo += '<input type="hidden" value="Upload File to Server" class="button orange medium" />';
			        photo += '</form>';
					
					
			    	photo += '</p>';
			    
	        	}
        		photo += '		<div class="home_hotel_div">';                        
        		photo += '			<div class="pophotel_outer" id="roomplan_photos_' + newId + '">';
        		/*
        		photo += '		    	<div class="pophotel_div">';
        		photo += '					<img src="hotelfile.php" alt="" width="140" />';
        		photo += '					<div class="right" style="margin-top:3px;"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
deletephoto_btn.jpg"/></div>';
        		photo += '					<a class="red">[Shinjuku]</a>';
        		photo += '	        	</div>';
        		photo += '		    	<div class="pophotel_div">';
        		photo += '					<img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
homepage_adimg.jpg" alt="" width="140" />';
        		photo += '					<div class="right" style="margin-top:3px;"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
deletephoto_btn.jpg"/></div>';
        		photo += '					<a class="red">[Shinjuku]</a>';
        		photo += '	        	</div>';
        		*/        		
        		photo += '			</div>';
        		photo += '		</div>';    
        		photo += '  	<div class="clearfix"></div>';
        		photo += '	</div>';
        		photo += '</div>';
        		
        		
        		descAndPic.append($(photo));

        		$(roomPlanDesc).append(descAndPic);
        		// add content to element
        		$(newRoomPlan).append(roomPlanDesc);

        		// At last, add element to body object
        		$("#roomPlanArea").append(newRoomPlan);

        		// $('#frm_image_upload_' + newId).ajaxForm(upload_callback);
        		// ============================================================
        		// set max id
        		$("#roomPlanMaxId").val(maxId);
        		$("#roomPlanListCount").val(newNo);
        		// console.log("new max id = " + maxId);
        		// console.log("new id = " + newId);
        		// console.log("new no = " + newNo);
        	}

        	function deleteImageFromRoomPlan(rpid, fid)
        	{
        		// console.log("delete image (rpid , fid ) :" + rpid + "," + fid);
                if (confirm('<?php echo smartyTranslate(array('s'=>"Do you want to delete the photo?"),$_smarty_tpl);?>
')) {
                    $('#rp_photo_' + rpid + '_' + fid ).remove();
                }
        		return false;

        	}

            // add 
        	function addImageToRoomPlan(rpid, fid, text)
        	{
            	var photo = '';
        		photo += '<div class="pophotel_div" id="rp_photo_' + rpid + '_' + fid + '">';
				photo += '<div class="right" style="position:absolute;right:2px;top:-3px;cursor:pointer;z-index:10;"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
deletephoto_btn.jpg" onclick="javascript:return deleteImageFromRoomPlan('+ rpid + ',' + fid + ')"  style="height: 18px;border:none;" /></div>';
        		photo += '<img src="roomfile.php?fid=' + fid + '" alt="" width="130"/>';        		
        		photo += '	<input type="text" name="rp_fname_' + rpid + '[]" value="' + text + '" style="width:130px" />';
        		photo += '	<input type="hidden" name="rp_fid_' + rpid + '[]" value=' + fid + ' />';
        		photo += '</div>';
        		$('#roomplan_photos_' + rpid).append($(photo));
        		$('#roomplan_photos_' + rpid).sortable();
        		//$('#roomplan_photos_' + rpid).disableSelection();
        	}
        	
        	function upload_callback(strFileIds) {
            		
        		closeWaiting();
				
            	if (strFileIds == '') // upload error
            	{
            	} else { // success
            	
                	// insert img element
                	// var strFileIds = parseInt(html, 10);
                	// console.log("image upload returns : " + strFileIds);
                	
                	// file id array return string implode with comma
                	var fileIds = strFileIds.split(",");
                	
					
                	for(i = 0; i < fileIds.length; i++)
                	{
                		var fileId = fileIds[i];
                        if (!check_upload_limit(curr_sel_id))
                            return false;
                    	addImageToRoomPlan(curr_sel_id, fileId, '');
                    }
            	}
            }
       
        	$(document).ready(function(){
        		<?php  $_smarty_tpl->tpl_vars['roomPlan'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('roomPlanList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['roomPlan']->key => $_smarty_tpl->tpl_vars['roomPlan']->value){
?>
        		addRoomPlan("<?php echo $_smarty_tpl->tpl_vars['roomPlan']->value['RoomPlanId'];?>
", "<?php echo $_smarty_tpl->tpl_vars['roomPlan']->value['RoomTypeId'];?>
", "<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['roomPlan']->value['RoomPlanName'],"javascript");?>
", 
						"<?php echo $_smarty_tpl->tpl_vars['roomPlan']->value['RoomMaxPersons'];?>
", "<?php echo $_smarty_tpl->tpl_vars['roomPlan']->value['zaiku'];?>
",
                        "<?php echo $_smarty_tpl->tpl_vars['roomPlan']->value['liaojin'];?>
", "<?php echo $_smarty_tpl->tpl_vars['roomPlan']->value['RoomSize'];?>
",
						"<?php echo smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['roomPlan']->value['RoomPlanDescription'],"/\r\n/",'\\n');?>
", "<?php echo $_smarty_tpl->tpl_vars['roomPlan']->value['Breakfast'];?>
", 
						"<?php echo $_smarty_tpl->tpl_vars['roomPlan']->value['Dinner'];?>
", "<?php echo $_smarty_tpl->tpl_vars['roomPlan']->value['UseCon'];?>
", "<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['roomPlan']->value['ConFromTime'],"%Y-%m-%d");?>
", 
						"<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['roomPlan']->value['ConToTime'],"%Y-%m-%d");?>
", "<?php echo $_smarty_tpl->tpl_vars['roomPlan']->value['Nights'];?>
", "<?php echo $_smarty_tpl->tpl_vars['roomPlan']->value['PriceAll'];?>
", 
						"<?php echo $_smarty_tpl->tpl_vars['roomPlan']->value['PriceAsia'];?>
", "<?php echo $_smarty_tpl->tpl_vars['roomPlan']->value['PriceEuro'];?>
");
        		
        			<?php  $_smarty_tpl->tpl_vars['rpImage'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['roomPlan']->value['FileIdList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['rpImage']->key => $_smarty_tpl->tpl_vars['rpImage']->value){
?>
        				addImageToRoomPlan("<?php echo $_smarty_tpl->tpl_vars['roomPlan']->value['RoomPlanId'];?>
", "<?php echo $_smarty_tpl->tpl_vars['rpImage']->value['RoomFileId'];?>
", "<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['rpImage']->value['RoomFileName']);?>
");
        			<?php }} ?>
        		<?php }} ?>


        		// image upload form process
            	$('#img_form').ajaxForm(upload_callback);
            	$('form.image_upload_frm').ajaxForm(upload_callback);
        	});

            function check_upload_limit(rpid)
            {
                if ($('#roomplan_photos_' + rpid + ' > div.pophotel_div').length >= 3)
                {
                    alert('<?php echo smartyTranslate(array('s'=>'Maximum upload photo count is 3.'),$_smarty_tpl);?>
');
                    return false;
                }
                return true;
            }

        	// upload image button click callback
        	// open select file dialog
        	function onupload_photo(id)
            {
                if (!check_upload_limit(id))
                  return false;
                curr_sel_id = id;
                $("#img_upload_btn").click();
                return false;
            }

            // input[type=image] onchange callback function.
            // auto submit
            function onsubmit_img_form()
            {
				
            	$('#img_form').submit();
				
            	showWaiting();

            	return false;
            }

        	// add an empty room plan
        	$("#add_btn").click(function(){
        		addRoomPlan(0, 1, '', 1, '<?php echo $_smarty_tpl->getVariable('today')->value;?>
', '<?php echo $_smarty_tpl->getVariable('tomorrow')->value;?>
', 30, '', 1, 1, 0, '<?php echo $_smarty_tpl->getVariable('today')->value;?>
', '<?php echo $_smarty_tpl->getVariable('tomorrow')->value;?>
', 1, 0, 0, 0);
        		
        		$('form.image_upload_frm').ajaxForm(upload_callback);
        		return false;
        	});
        	
        	function onsubmit_roomplan_save()
        	{
        		var roomPlanNames = $('input[name="RoomPlanName[]"]');
        		var RoomMaxPersons = $('input[name="RoomMaxPersons[]"]');
        		var RoomPlanStartTime = $('input[name="RoomPlanStartTime[]"]');
        		var RoomPlanEndTime = $('input[name="RoomPlanEndTime[]"]');
        		var RoomSize = $('input[name="RoomSize[]"]');
        		
        		for(i = 0; i < roomPlanNames.length; i++)
        		{
	        		if ($(roomPlanNames[i]).val() == '')
	        		{
						alert('<?php echo smartyTranslate(array('s'=>'Please input Room Plan Name'),$_smarty_tpl);?>
');
						$(roomPlanNames[i]).focus();
						return false;
					}
	        		if ($(RoomMaxPersons[i]).val() == '')
	        		{
						alert('<?php echo smartyTranslate(array('s'=>'Please input Max Room Pax value'),$_smarty_tpl);?>
');
						$(RoomMaxPersons[i]).focus();
						return false;
					}
					if ($(RoomPlanStartTime[i]).val() == '')
	        		{
						alert('<?php echo smartyTranslate(array('s'=>'Please input plan start time'),$_smarty_tpl);?>
');
						$(RoomPlanStartTime[i]).focus();
						return false;
					}
					if ($(RoomPlanEndTime[i]).val() == '')
	        		{
						alert('<?php echo smartyTranslate(array('s'=>'Please input plan end time'),$_smarty_tpl);?>
');
						$(RoomPlanEndTime[i]).focus();
						return false;
					}
					if ($(RoomSize[i]).val() == '')
	        		{
						alert('<?php echo smartyTranslate(array('s'=>'Please input room size'),$_smarty_tpl);?>
');
						$(RoomSize[i]).focus();
						return false;
					}
        		}
				alert('<?php echo smartyTranslate(array('s'=>'Updated! \rIf you would like to edit with other Language version, please change language with language bar locating at up right and edit'),$_smarty_tpl);?>
');
        		return true;
        	}
        	
        	function onclick_show_con_area(id)
        	{
        		$('#div_con_' + id).show();
                OnChangeConDate(id);
        	}
        	function onclick_hide_con_area(id)
        	{
        		$('#div_con_' + id).hide();
        	}
        	
        	function OnChangeStartDate2(id)
        	{
        		// check start to to date
        		// alert('ok');
        		var startDateInput = '#StartTime_' + id;
        		var endDateInput = '#EndTime_' + id;
        		
        		if ($(startDateInput).val() >= $(endDateInput).val())
        		{
        			alert('<?php echo smartyTranslate(array('s'=>'From time must be earlier than end time.'),$_smarty_tpl);?>
');
        			
        			$(endDateInput).val(dateAddDays($(startDateInput).val(), 1));
        			
        		}

                // alert($("input[name='UseCon_" + id + "[]']:checked").val());
                if ($("input[name='UseCon_" + id + "[]']:checked").val() == 1)
                    OnChangeConDate(id);
        	}
        	
        	function OnChangeConDate(id)
        	{
        		// check start to to date
        		// alert('ok');
        		var startDateInput = '#StartTime_' + id;
        		var endDateInput = '#EndTime_' + id;
        		var conStartDateInput = '#ConStartTime_' + id;
        		var conEndDateInput = '#ConEndTime_' + id;
        		
        		if ($(conStartDateInput).val() < $(startDateInput).val())
        		{
        			alert('<?php echo smartyTranslate(array('s'=>'Consecutive beginning time must be later than room plan beginning time.'),$_smarty_tpl);?>
');
        			$(conStartDateInput).val($(startDateInput).val());
        			// return;
        		}
        		
        		if ($(conStartDateInput).val() > $(endDateInput).val())
        		{
        			alert('<?php echo smartyTranslate(array('s'=>'Consecutive beginning time must be earlier than room plan end time.'),$_smarty_tpl);?>
');
        			$(conStartDateInput).val($(startDateInput).val());
        			// return;
        		}
        		
        		if ($(conEndDateInput).val() < $(startDateInput).val())
        		{
        			alert('<?php echo smartyTranslate(array('s'=>'Consecutive end time must be later than room plan beginning time.'),$_smarty_tpl);?>
');
        			$(conEndDateInput).val($(endDateInput).val());
        			// return;
        		}
        		
        		if ($(conEndDateInput).val() > $(endDateInput).val())
        		{
        			alert('<?php echo smartyTranslate(array('s'=>'Consecutive end time must be earlier than room plan end time.'),$_smarty_tpl);?>
');
        			$(conEndDateInput).val($(endDateInput).val());
        			// return;
        		}
        		
        		if ($(conStartDateInput).val() >= $(conEndDateInput).val())
        		{
        			alert('<?php echo smartyTranslate(array('s'=>'Consecutive beginning time must be earlier than end time.'),$_smarty_tpl);?>
');
        			
        			$(conEndDateInput).val(dateAddDays($(conStartDateInput).val(), 1));
        			// return;
        		}
        		
        		var startDate = new Date($(conStartDateInput).val());
				var endDate = new Date($(conEndDateInput).val());
				var diff_date = (endDate.getTime() - startDate.getTime()) / (24 * 60 * 60 * 1000);
				
				// $('#nights_' + id).val(diff_date);
        	}
        	
        	function OnChangeNight(id)
        	{
        		var conStartDateInput = '#ConStartTime_' + id;
        		var conEndDateInput = '#ConEndTime_' + id;
        		// var durationInput = '#nights_' + id;
        		var startDate = new Date($(conStartDateInput).val());
				var endDate = new Date($(conEndDateInput).val());
				var diff_date = (endDate.getTime() - startDate.getTime()) / (24 * 60 * 60 * 1000);
				
				
				if ($('#nights_' + id).val() > diff_date)
				{
					alert('<?php echo smartyTranslate(array('s'=>'Please select correct consecutive night.'),$_smarty_tpl);?>
');
					$('#nights_' + id).val(diff_date);
				}
        		
        		// $(conEndDateInput).val(dateAddDays($(conStartDateInput).val(), 1));
        		
        		// OnChangeConDate(id);
        	}
            // -->
            </script>