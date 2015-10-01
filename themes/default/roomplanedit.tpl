
            <!-- right content start -->
            <div class="left right_content_outer" id="right_content">
            	<!-- hotel detail info start -->
               <p class="orange_color bold font14" style="width:200px;float:left">{l s='Room Info'}</p>
               <div style="float:right;font-weight:bold;">
                    {include file="$tpl_dir./common/sub_menu.tpl"}
                </div>
               <div class="clearfix"></div>
               <div style="background:#f6f6f6;margin-top:10px;padding:10px;">
               <table width="100%" class="roomplan_header_comment">
               		<tr>
                    	<td width="10%">{l s='Room Type'}</td>
                        <td width="15%">{l s='Room Plan Name'}</td>
                        <td width="10%"  style="letter-spacing:-1px;">{l s='Max'}</td>
                        {*<td width="15%">{l s='From'}</td>*}
                        {*<td width="15%">{l s='To'}</td>*}{if $isHotel!=1}
                        <td width="5%">{l s='stocklinkage'}</td>
                        <td width="5%">{l s='pricelinkage'}</td>{/if}
                        <td width="5%">{l s='Breakfast'}</td>
                        <td width="5%">{l s='Dinner'}</td>
                        <td width="15%">{l s='Room size(sq.m)'}</td>
                        {if $isHotel!=1}
                            <td width="10%">{l s='Consecutive nights'}</td>
                        {/if}
                    </tr>
                </table>
                </div>
                <form action="roomplanedit.php?action=save" method="post" onsubmit="return true;/*onsubmit_roomplan_save()*/" id="frm_roomplan"> 
                <input type="hidden" id="hid" name="hid" value="{$hid}" />
                <input type="hidden" id="roomPlanMaxId" name="roomPlanMaxId" value="0" />
                <input type="hidden" id="roomPlanListCount" name="roomPlanListCount" value="0" />
                <input type="hidden" id="delRpidList" name="delRpidList" value="0" />
              	<div id="roomPlanArea">
             	</div>
	            <div style="margin-top:20px;">
	            	<a href="#" id="add_btn"><input type="button" class="button orange medium" value="{l s='New'}"/></a>
	           	</div>
	            <div class="control_bar">
	            	<input type="button" class="button orange medium" alt="save" value="{l s='Save'}" onclick="if (onsubmit_roomplan_save()) $('#frm_roomplan').submit() " />&nbsp;&nbsp;
	                <input type="button" class="button white medium" value="{l s='Cancel'}" alt="cancel" onclick="javascript:history.go(-1);"/>
	            </div>
	            </form>
                <form action="roomplanedit.php?action=upload&hid={$hid}" method="post" enctype="multipart/form-data" id="img_form" style="visibility:hidden;">
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
                    if (!confirm('{l s='Are you sure you want to delete?'}'))
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
        		$(newRoomPlan).append('<div class="right" style="margin-top:5px;cursor: pointer" onclick="' + "javascript:return delRoomPlan(" + newId +")"  + '"><img src="{$img_dir}deletephoto_btn.jpg"/></div>');
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
        		{foreach from=$roomTypeList item=roomType name=roomType}
        		mainTable += '    		<option value="{$roomType.RoomTypeId}" ';
        		if ({$roomType.RoomTypeId} == type)
        			mainTable += 'selected="selected" ';
        		mainTable += '    		>{l s=$roomType.RoomTypeName}</option>';
        		{/foreach}
        		mainTable += '		</select>';
        		mainTable += '    </td>';
        		mainTable += '    <td width="15%" class="txtcenter">';
        		mainTable += '    <input type="text" value="' + name + '" style="width:90%;" name="RoomPlanName[]" value="' + name + '"/>';
        		mainTable += '    </td>';
        		mainTable += '    <td width="10%" class="txtcenter">';
        		mainTable += '		<input type="text" style="width:90%;text-align: right" value="' + maxRooms + '" name="RoomMaxPersons[]" />    ';
        		mainTable += '    </td>';
        		{*mainTable += '    <td width="15%" class="txtcenter">';*}
        		{*mainTable += '		<input type="text" value="' + startTime + '" readonly="readonly" name="RoomPlanStartTime[]" style="width:70px;" id="StartTime_' + newId +'" />';*}
        		{*mainTable += '        <img src="{$img_dir}calendar_icon.jpg" alt="" onclick="if(self.gfPop)gfPop.fPopCalendar(getById(\'StartTime_' + newId + '\'), \'OnChangeStartDate2(' + newId + ')\');" width="13"/><span style="font-family:tahoma"> ~</span> ';*}
        		{*mainTable += '    </td>';*}
        		{*mainTable += '     <td width="15%" class="txtcenter">';*}
        		{*mainTable += '        <input type="text" value="' + endTime + '" readonly="readonly"  name="RoomPlanEndTime[]" id="EndTime_' + newId +'" style="width:70px;" />';*}
        		{*mainTable += '        <img src="{$img_dir}calendar_icon.jpg" alt="" width="13" onclick="if(self.gfPop)gfPop.fPopCalendar(getById(\'EndTime_' + newId + '\'), \'OnChangeStartDate2(' + newId + ')\');"   />    ';*}
        		{*mainTable += '    </td>';*}

                mainTable += '    <td  width="5%" class="txtcenter" {if $isHotel==1}style="display: none"{/if}>';
                mainTable += '		<input type="checkbox" value="1" name="zaiku_' + newId + '" ';
                if (zaiku == 1)
                    mainTable += 'checked="checked"';
                mainTable += ' />    ';
                mainTable += '    </td>';
                mainTable += '    <td width="5%" class="txtcenter" {if $isHotel==1}style="display: none"{/if}>';
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

                if ({$isHotel} == 0) {
                    mainTable += '    <td width="10%" class="txtcenter">';
            		mainTable += '      <input type="radio" name="UseCon_' + newId +'[]" value="1" onclick="return onclick_show_con_area('+ newId + ')" ';
            		if (useCon == 1)
            			mainTable += 'checked="checked"';
            		mainTable += ' 			/>';
    				mainTable += '    	<label>';
            		mainTable += '      {l s='Yes'}</label>                       ';
            		
            		mainTable += '      <input type="radio" name="UseCon_' + newId +'[]" value="0"  onclick="return onclick_hide_con_area('+ newId + ')" ';
            		if (useCon == 0)
            			mainTable += 'checked="checked"';
            		mainTable += ' 			/>';
    				mainTable += '    <label>';
            		mainTable += '      {l s='n1'}</label>';
            		mainTable += '    </td>';
                }
        		mainTable += '</tr>';
        		mainTable += '</table>';

        		$(roomPlanDesc).append($(mainTable));
        		// 2.2.2 add add consecutive info
        		var hide_style = "";

        		if (useCon == 0)
        			hide_style = "display: none;";
        			
        			
        		var consecutiveDesc = '';

        		consecutiveDesc += '<div style="padding-left:10px;' + hide_style + '" id="div_con_' + newId +'">';
        		consecutiveDesc += '    {l s='Consecutive nights'} {l s='From'} ';
        		consecutiveDesc += '    <input type="text" name="ConFromTime[]" readonly="readonly" value="' + conFromTime + '" style="width:70px;" id="ConStartTime_' + newId + '" />';
        		consecutiveDesc += '        <img src="{$img_dir}calendar_icon.jpg" alt="" width="13" onclick="if(self.gfPop)gfPop.fPopCalendar(getById(\'ConStartTime_' + newId + '\'), \'OnChangeConDate(' + newId + ')\');"   />    ';
        		consecutiveDesc += '    {l s='To'}';
        		consecutiveDesc += '    <input type="text" name="ConToTime[]" readonly="readonly" value="' + conToTime + '" style="width:70px;" id="ConEndTime_' + newId + '" />';
        		consecutiveDesc += '        <img src="{$img_dir}calendar_icon.jpg" alt="" width="13" onclick="if(self.gfPop)gfPop.fPopCalendar(getById(\'ConEndTime_' + newId + '\'), \'OnChangeConDate(' + newId + ')\');"   />    ';
        		consecutiveDesc += '    &nbsp;&nbsp;';
        		consecutiveDesc += '    {l s='Nights'}';
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
        		consecutiveDesc += '    {l s='Total Price All'}';
        		consecutiveDesc += '    <input type="text" style="width:40px;text-align: right" name="PriceAll[]" value="' + priceAll +'" />';
        		consecutiveDesc += '    ';
                consecutiveDesc += '    {l s='Asia'}';
        		consecutiveDesc += '    <input type="text" style="width:40px;text-align: right" name="PriceAsia[]" value="' + priceAsia +'" />';
        		consecutiveDesc += '    {l s='Euro'}';
        		consecutiveDesc += '    <input type="text" style="width:40px;text-align: right" name="PriceEuro[]" value="' + priceEuro +'"/>';
        		consecutiveDesc += '</div>';
        		$(roomPlanDesc).append($(consecutiveDesc));
        		// 2.2.3 add room desc and picture
        		var descAndPic = $('<div class="hotel_deinfo_div" />');

        		// 2.2.3.1 room desc
        		var desc = '';
        		desc += '<div class="hotel_description">';
        		desc += '	<div class="hotel_deinfo_title" onclick="' + "showapp('hoteldes_" + newId + "','hoteldes_detail_" + newId + "')" + '">';
        		desc += '		<h4 class="unfold" id="hoteldes_' + newId + '">{l s='Room Description'}</h4>';
        		desc += '	</div>';
        		desc += '	<div class="show detail_info" id="hoteldes_detail_' + newId + '" style="padding:0px;margin:0px;">';
        		desc +=	'		<textarea style="width:96%;height:100px;padding:2%;border:none;" name="RoomPlanDesc[]">' + planDescription +'</textarea>';
        			desc += '	</div>';
        			desc +=	'</div>';
        		
        		descAndPic.append($(desc));
        		// 2.2.3.2 photo
        		var photo = '';
        		
        		photo += '<div class="hotel_policy">';
        		photo += '	<div class="hotel_deinfo_title" onclick="showapp(' + "'hotelpol_" + newId + "','hotelpol_detail_" +  newId + "'" + ')"><h4 class="fold" id="hotelpol_' + newId + '">{l s='Room Picture'}</h4></div>';
        		photo += '	<div class="hidden detail_info" id="hotelpol_detail_' + newId + '" style="border-bottom:1px solid #ccc;">';
        		if (!checkIE())
	        		photo += '		<p><a href="#"><input type="button" class="button orange medium" value="{l s='Upload Photo'}" onclick="return onupload_photo(' + newId + ')" /></a></p>';
	        	else 
	        	{
					photo += '<p>';
										
					
					photo += '<form action="roomplanedit.php?action=upload&hid={$hid}" method="post" enctype="multipart/form-data" id="img_form" >';
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
        		photo += '					<div class="right" style="margin-top:3px;"><img src="{$img_dir}deletephoto_btn.jpg"/></div>';
        		photo += '					<a class="red">[Shinjuku]</a>';
        		photo += '	        	</div>';
        		photo += '		    	<div class="pophotel_div">';
        		photo += '					<img src="{$img_dir}homepage_adimg.jpg" alt="" width="140" />';
        		photo += '					<div class="right" style="margin-top:3px;"><img src="{$img_dir}deletephoto_btn.jpg"/></div>';
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
                if (confirm('{l s="Do you want to delete the photo?"}')) {
                    $('#rp_photo_' + rpid + '_' + fid ).remove();
                }
        		return false;

        	}

            // add 
        	function addImageToRoomPlan(rpid, fid, text)
        	{
            	var photo = '';
        		photo += '<div class="pophotel_div" id="rp_photo_' + rpid + '_' + fid + '">';
				photo += '<div class="right" style="position:absolute;right:2px;top:-3px;cursor:pointer;z-index:10;"><img src="{$img_dir}deletephoto_btn.jpg" onclick="javascript:return deleteImageFromRoomPlan('+ rpid + ',' + fid + ')"  style="height: 18px;border:none;" /></div>';
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
        		{foreach from=$roomPlanList item=roomPlan name=roomPlan}
        		addRoomPlan("{$roomPlan.RoomPlanId}", "{$roomPlan.RoomTypeId}", "{$roomPlan.RoomPlanName|escape:"javascript"}", 
						"{$roomPlan.RoomMaxPersons}", "{$roomPlan.zaiku}",
                        "{$roomPlan.liaojin}", "{$roomPlan.RoomSize}",
						"{$roomPlan.RoomPlanDescription|regex_replace:"/\r\n/":'\\n'}", "{$roomPlan.Breakfast}", 
						"{$roomPlan.Dinner}", "{$roomPlan.UseCon}", "{$roomPlan.ConFromTime|date_format:"%Y-%m-%d"}", 
						"{$roomPlan.ConToTime|date_format:"%Y-%m-%d"}", "{$roomPlan.Nights}", "{$roomPlan.PriceAll}", 
						"{$roomPlan.PriceAsia}", "{$roomPlan.PriceEuro}");
        		
        			{foreach from=$roomPlan['FileIdList'] item=rpImage name=rpImage}
        				addImageToRoomPlan("{$roomPlan.RoomPlanId}", "{$rpImage['RoomFileId']}", "{$rpImage['RoomFileName']|escape}");
        			{/foreach}
        		{/foreach}


        		// image upload form process
            	$('#img_form').ajaxForm(upload_callback);
            	$('form.image_upload_frm').ajaxForm(upload_callback);
        	});

            function check_upload_limit(rpid)
            {
                if ($('#roomplan_photos_' + rpid + ' > div.pophotel_div').length >= 3)
                {
                    alert('{l s='Maximum upload photo count is 3.'}');
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
        		addRoomPlan(0, 1, '', 1, 1, 1, 30, '', 1, 1, 0, '{$today}', '{$tomorrow}', 1, 0, 0, 0);
        		
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
						alert('{l s='Please input Room Plan Name'}');
						$(roomPlanNames[i]).focus();
						return false;
					}
	        		if ($(RoomMaxPersons[i]).val() == '')
	        		{
						alert('{l s='Please input Max Room Pax value'}');
						$(RoomMaxPersons[i]).focus();
						return false;
					}
					if ($(RoomPlanStartTime[i]).val() == '')
	        		{
						alert('{l s='Please input plan start time'}');
						$(RoomPlanStartTime[i]).focus();
						return false;
					}
					if ($(RoomPlanEndTime[i]).val() == '')
	        		{
						alert('{l s='Please input plan end time'}');
						$(RoomPlanEndTime[i]).focus();
						return false;
					}
					if ($(RoomSize[i]).val() == '')
	        		{
						alert('{l s='Please input room size'}');
						$(RoomSize[i]).focus();
						return false;
					}
        		}
				alert('{l s='Updated! \rIf you would like to edit with other Language version, please change language with language bar locating at up right and edit'}');
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
        			alert('{l s='From time must be earlier than end time.'}');
        			
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
        			alert('{l s='Consecutive beginning time must be later than room plan beginning time.'}');
        			$(conStartDateInput).val($(startDateInput).val());
        			// return;
        		}
        		
        		if ($(conStartDateInput).val() > $(endDateInput).val())
        		{
        			alert('{l s='Consecutive beginning time must be earlier than room plan end time.'}');
        			$(conStartDateInput).val($(startDateInput).val());
        			// return;
        		}
        		
        		if ($(conEndDateInput).val() < $(startDateInput).val())
        		{
        			alert('{l s='Consecutive end time must be later than room plan beginning time.'}');
        			$(conEndDateInput).val($(endDateInput).val());
        			// return;
        		}
        		
        		if ($(conEndDateInput).val() > $(endDateInput).val())
        		{
        			alert('{l s='Consecutive end time must be earlier than room plan end time.'}');
        			$(conEndDateInput).val($(endDateInput).val());
        			// return;
        		}
        		
        		if ($(conStartDateInput).val() >= $(conEndDateInput).val())
        		{
        			alert('{l s='Consecutive beginning time must be earlier than end time.'}');
        			
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
					alert('{l s='Please select correct consecutive night.'}');
					$('#nights_' + id).val(diff_date);
				}
        		
        		// $(conEndDateInput).val(dateAddDays($(conStartDateInput).val(), 1));
        		
        		// OnChangeConDate(id);
        	}
            // -->
            </script>
