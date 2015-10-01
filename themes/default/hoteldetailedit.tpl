<script>
    jQuery.validator.addMethod("fax", function (fax_number, element) {
        fax_number = fax_number.replace(/\s+/g, "");
        return this.optional(element) || fax_number.length > 1 &&
                fax_number.match(/^[+0-9. ()-]*$/);
    }, "{l s='Please specify a valid fax number'}");

    $(document).ready(function() {
	$.validator.addMethod("valueNotEquals", function(value, element, arg){
		  return arg != value;
		 }, "{l s='Area/Ciry must  be selected.'}");
			
	$("#inputFrm").validate({
	    rules: {
	     	HotelName: {
		    	required: true, 
		    	maxlength: 100
	     	},
	     	HotelAddress: {
		    	required: true, 
		    	maxlength: 100
	     	},
	     	HotelCity : {
				valueNotEquals: "" 
	     	},
            HotelFax:{
                maxlength:100,
                fax:true
            },
            HotelEmail:{
                email:true
            }

        },
	    messages: {
	    },
        submitHandler:function (form) {

        }

    });
});
</script>
            <!-- right content start -->
            <div class="left right_content_outer">
            	<!-- hotel detail info start -->
            	<form name="inputFrm" method="post" action="hoteldetail.php" id="inputFrm" >
                {if $cookie->RoleID > 3 && $smarty.get.mid == 0}
                    {assign var="admin_add_hotel" value="1"}
                {else}
                    {assign var="admin_add_hotel" value="0"}
                {/if}
                <input type="hidden" name="admin_add_hotel" value="{$admin_add_hotel}" />
            	<input type="hidden" name="Submit" value="1" />
            	<input type="hidden" name="mid" value="{$mid}" />
                <div class="bold" style="text-align:right;float:right">
                    {include file="$tpl_dir./common/sub_menu.tpl"}
                </div>
               <p class="orange_color bold font14" style="margin-bottom:5px;">{l s='Base Info'}</p>               
               {include file="$tpl_dir./common/errors.tpl"}
                <div class="all_border base_info">
                	<div class="input_info">
					    <label>&nbsp;</label>
                        <span class="red">{l s="*If you would like to edit with other Language version, "}</span><br/>
                    {if $sl_lang==1}<!-- 20130228 #1173 -->
                    <label>&nbsp;</label><span class="red">{l s="please change language with language bar locating at up right and edit."}</span><br/>
					{/if}
					</div> 
                	<div class="input_info">
                    	<label>{l s='Hotel Code'}</label>
                        &nbsp;&nbsp;{$hotel->HotelCode}
                    </div>    
                    <div class="input_info">
                    	<label>{l s='Hotel Name'}</label>
                        <input type="text" value="{$hotel->HotelName}" class="bold font18" name="HotelName" id="HotelName" />
                    </div>    
                    <div class="input_info">
                    	<label>{l s='Area/City'}</label>
                        <select class="" onchange="AreaSelect(); return false;" id="selarea" name="HotelArea" style="width:200px;">
                            <option value="">{l s='Area Select'}</option>
                            {foreach from=$areaList item=item name=item}
                            	<option value="{$item.AreaId}" {if $item.AreaId==$hotel->HotelArea}selected{/if}>{$item.AreaName}</option>
                            {/foreach}
                        </select>
                        <select class="" name="HotelCity" id="selcity" style="width:200px;margin-left:10px;">
                            <option value="">{l s='City Select'}</option>
                            {foreach from=$cityList item=item name=item}
                            	<option value="{$item.CityId}" {if $item.CityId==$hotel->HotelCity}selected{/if}>{$item.CityName}</option>
                            {/foreach}
                        </select>
                    </div>    
                    <div class="input_info">
                    	<label>{l s='Address'}</label>
                        <input type="text" value="{$hotel->HotelAddress}" name="HotelAddress" />
                    </div>    
                    <div class="input_info">
                    	<label>{l s='Hotel Category'}</label>
                        <select name="HotelClass" style="width:200px;">
                            {foreach from=$classList item=item name=item}
                            	<option value="{$item.HotelClassId}" {if $item.HotelClassId==$hotel->HotelClass}selected{/if}>{l s=$item.HotelClassName}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="input_info">
                    	<label>{l s='Contact No'}</label>
                        <input type="text" value="{$hotel->HotelContactNo}" name="HotelContactNo" style="width:200px;" />
                    </div>
                    <div class="input_info">
                        <label>{l s="FAX"}</label>
                        <input type="text" name="HotelFax" value="{$hotel->HotelFax}"/>
                    <br/>
                    <label>&nbsp;</label>
                        <span class="red">{l s="Please input Fax number with Country code + Fax number."}</span><br/>
                    <label>&nbsp;</label><span class="red">{l s="if your number start with \"0\" please take out \"0\". "}</span><br/>
                    {if $sl_lang==1}<!-- 20130228 #1173 -->
                    <label>&nbsp;</label><span class="red">{l s="eg: if your fax number is 03-1234-5678, please input 81312345678."}</span><br/>
					{/if}
                    </div>
                    <div class="input_info">
                        <label>{l s="E-mail"}</label>
                        <input type="text" name="HotelEmail" value="{$hotel->HotelEmail}"/>
                        <span class="red"></span>
                    </div>
                    <div class="input_info">
                        <label>{l s='Receive Booking'}</label>
                        <input type="radio" value="prefFax" name="prefCon" style="width:auto;margin-right: 10px;"{if $hotel->PrefFax==1&&$hotel->PrefEmail==0} checked="checked"{/if} />ＦＡＸで送る
                        <input type="radio" value="prefEmail" name="prefCon" style="width:auto;margin-right: 10px;margin-left: 15px;"{if $hotel->PrefFax==0&&$hotel->PrefEmail==1} checked="checked"{/if} />メールで送る
                        <input type="radio" value="prefAll" name="prefCon" style="width:auto;margin-right: 10px;margin-left: 15px;"{if $hotel->PrefFax==1&&$hotel->PrefEmail==1} checked="checked"{/if} />メールとＦＡＸ両方で送る
                        <input type="radio" value="prefNone" name="prefCon" style="width:auto;margin-right: 10px;margin-left: 15px;"{if $hotel->PrefFax==0&&$hotel->PrefEmail==0} checked="checked"{/if} />送らない
                    </div>
                </div>
               
                <!-- hotel detail info end -->
                
                <!-- Information start -->
                <!-- Hotel Features list start -->
                <p style="float:left;  margin-top:20px;" class="orange_color bold font14" >{l s='Hotel Features'}</p>
                <p style="float:right; margin-top:20px;"><span class="orange_color bold" style="font-family:Tahoma">√</span> {l s='Available'}   <span style="color:#666;font-family:Tahoma">● {l s='Not available'}</span></p>
                <div class="clearfix"></div>
                <div class="all_border hotel_features_list">
                	<table cellpadding="0" cellspacing="0">
                    	<tbody>
                    		
                        	<tr>
                        		{foreach from=$featureList item=item name=item}
                            	<td><input type="checkbox" name="fids[]" value="{$item.FeatureId}" {if $item.LinkId > 0}checked{/if}/>&nbsp;{$item.FeatureName}</td>
                            	{if ($smarty.foreach.item.index + 1) % 4 == 0} </tr><tr>{/if}
                            	{/foreach}
                            </tr>
                            
                        </tbody>
                    </table>
                </div>   
                <!-- Hotel Features list end -->
                 
                <!-- Hotel Detail Information start -->
                <div class="hotel_deinfo_div">
                	<div class="hotel_description">
                    	<div class="hotel_deinfo_title" onclick="showapp('hoteldes','hoteldes_detail')" ><h4 class="unfold" id="hoteldes">{l s='Hotel Description'}</h4></div>
                        <div class="show detail_info" id="hoteldes_detail" style="padding:0px;margin:0px;">
                        	<textarea style="width:96%;height:100px;padding:2%;border:none;" name="HotelDescription">{$hotel->HotelDescription}</textarea>
						</div>
                    </div>
                    
                    <div class="hotel_policy">
                    	<div class="hotel_deinfo_title" onclick="showapp('hotelpol','hotelpol_detail')" ><h4 class="unfold" id="hotelpol">{l s='Hotel Policies'}</h4></div>
                        <div class="show detail_info" id="hotelpol_detail" style="padding:0px;margin:0px;">
                        	<textarea style="width:96%;height:100px;padding:2%;border:none;" name="HotelPolicies">{$hotel->HotelPolicies}</textarea>
						</div>
                    </div>
                   
                    <div class="hotel_useinfo">
                    	<div class="hotel_deinfo_title" onclick="showapp('usefulinfo','usefulinfo_detail')"><h4 class="unfold" id="usefulinfo">{l s='Useful Information'}</h4></div>
                      <div class="show detail_info" id="usefulinfo_detail" style="border-bottom:1px solid #CCC;padding:0px;margin:0px;">
                        	<textarea style="width:96%;height:100px;padding:2%;border:none;" name="UsefulInformation">{$hotel->UsefulInformation}</textarea>
                       	 </div>
                    </div>
                    
                </div>   
                
                <!-- Hotel Detail Information end -->
                
                <!-- uploadphoto start -->
          		{if !$isie}
                <p style="margin-top:20px;"><a href="#"><input type="button" class="button orange medium" value="{l s='Upload Photo'}" onclick="return onupload_photo(); "/></a></p>
				{/if}
			    {if $isie} 
                
                <!--<form action="hoteldetail.php?action=upload" method="post" enctype="multipart/form-data" id="img_form_ie" name="img_upload_ie">
                    <input type="file" name="myfile[]"  multiple="multiple" onchange="return onsubmit_img_form()" />
                    <input type="hidden" name="mid" value="{$mid}" />
                    <input type="hidden" class="button orange medium" value="{l s='Upload File to Server'}" form="img_form_ie" id="img_form_ie_but" />
                </form>-->
                <form action="hoteldetail.php?action=upload" method="post" enctype="multipart/form-data" id="img_form_ie" name="img_upload_ie" style="display:none;" >
				<input type="hidden" name="myfile[]"  multiple="multiple" />
				<input type="hidden" name="mid" value="{$mid}" />
				<input type="hidden" class="button orange medium" value="{l s='Upload File to Server'}" form="img_form_ie" id="img_form_ie_but" />
			</form>
                    
			<form action="hoteldetail.php?action=upload" method="post" enctype="multipart/form-data" id="img_form" >
			        <input type="file" name="myfile[]"  multiple=""  id="img_upload_btn"  accept="image/jpeg,image/png" onchange="return onsubmit_img_form()" />
			        <input type="hidden" name="mid" value="{$mid}" />
			        <input type="hidden" value="Upload File to Server" class="button orange medium"/>
			</form>
				   
				{/if}   
                
                <div class="left all_border home_hotel_div">                        
                    <div class="pophotel_outer" id="hotelphotos"> 
                    	<!-- <div class="left">Uploaded Photo</div> -->
                    	{foreach from=$photoList item=item name=item}
                        <div class="pophotel_div" id="hotel_photo_{$item.HotelFileId}" style="width:140px;margin-right:0px;">
                            <div class="photo_frame"><img src="{$base_dir}asset/{$item.HotelFilePath}" alt="" width="140" height="100px" />
	                            <div class="deletephoto_btn" onclick="javascript:return deleteImageFromHotel({$item.HotelFileId})"></div>
                            </div>                            
                            <input name="hotelFileName[]"  value="{$item.HotelFileName}" style="width:137px;overflow:hidden;"/>
                            <input type="hidden" name="hotelFileId[]" value="{$item.HotelFileId}" />
                        </div>
                       {/foreach}
                       
                    </div>
<div class="clearfix"></div>
                </div>    
                <div class="clearfix"></div>
                
                <!-- uploadphoto end -->                                    
                <!-- Information end -->
             
            
            <div class="control_bar">
            	<input type="button" value="{l s='Save'}" class="button orange medium" onclick="inputFrm_Save(); return false;" />
                <input type="button" value="{l s='Cancel'}" class="button white medium" onclick="location.href='index.php'"/>
            </div>       
			</form>
			
			<form action="hoteldetail.php?action=upload" method="post" enctype="multipart/form-data" id="img_form" style="visibility:hidden;">
			         <input type="file" name="myfile[]"  multiple=""  id="img_upload_btn_check"  accept="image/jpeg,image/png" onchange="return onsubmit_img_form()" />
			        <input type="hidden" name="mid" value="{$mid}" />
			        <input type="submit" value="Upload File to Server" class="button orange medium"/>
			</form>
           </div>
            <!-- right content end -->
            <div class="clearfix"></div>
<script>
function inputFrm_Save() {
    var flag=true;
    if ($('input[name=prefCon]:checked').val() == undefined || $('input[name=prefCon]:checked').val() == '') {
        alert('{l s='Please select the Receive Booking'}');
        flag= false;
    }

    if (($('input[name=prefCon]:checked').val()=='prefFax' ||$('input[name=prefCon]:checked').val()=='prefAll' )&& $('input[name=HotelFax]').val() == '') {
        alert('{l s='Please input the Fax Number'}');
        flag= false;
    }
    if (($('input[name=prefCon]:checked').val()=='prefEmail'||$('input[name=prefCon]:checked').val()=='prefAll') && $('input[name=HotelEmail]').val() == '') {
        alert('{l s='Please input the Email'}');
        flag= false;
    }

	if($("#inputFrm").valid()&&flag==true)
	{
		inputFrm.submit(); 
		alert('{l s='Updated! \rIf you would like to edit with other Language version, please change language with language bar locating at up right and edit'}');
	}

	else $("#HotelName").focus();
}
function AreaSelect() {
	setWait();
	$.ajax({
		type : "post",
		datatype : "text",
		data : {
			cityid : $('#selarea').val()
		}, 
		url : "{$base_dir}hoteldetail.php?getcity",
		success : function(data, code){
			unsetWait();
			document.getElementById('selcity').options.length = 0;
			var cityList = data.split("|");
			for (i=0; i<cityList.length;i++) {
				var city = cityList[i].split(",");
				$('#selcity').append("<option value='" + city[0] + "'>" + city[1] + "</option>");
			}
		}
	}); 
}

function onupload_photo()
{
    $("#img_upload_btn_check").click();
    return false;
}

function onsubmit_img_form()
{
	setWait();
    var checkImage = 1;
    var fileUpload = document.getElementById("img_upload_btn_check");

    //Initiate the FileReader object.
    var reader = new FileReader();
    //Read the contents of Image File.
    reader.readAsDataURL(fileUpload.files[0]);
    reader.onload = function (e) {
        //Initiate the JavaScript Image object.
        var image = new Image();

        //Set the Base64 string return from FileReader as source.
        image.src = e.target.result;

        //Validate the File Height and Width.
        image.onload = function () {

            var height = this.height;
            var width = this.width;
            if (height < 600 || width < 800) {
                checkImage = 0;
                alert("Height is min 600px and width is min 800px");
                unsetWait();
                return false;
            }
        };

    }
    setTimeout(function()
    {
        if(checkImage == 1) {
            $('#img_form').submit();
        }
    }, 100);

    return false;
}
function upload_callback(html) {

	if (html == '0') // upload error
	{
	} else {
		unsetWait();
    	// insert img element
    	var file_list = html.split("*");
    	for ( i =0; i<file_list.length-1;i++) {
        	var files = file_list[i].split("|||");
    		addImageToHotel(files[0], files[1], files[2]);
    	}
    	
	}
}
$(document).ready(function(){
	$('#img_form').ajaxForm(upload_callback);
	$('#img_form_ie').ajaxForm(upload_callback);
});

//add 
function addImageToHotel(fid, fname, fpath){
	var photo = '';
	photo += '<div class="pophotel_div" id="hotel_photo_' + fid + '" style="width:140px;margin-right:0px;">';
	photo += '  <div class="photo_frame"> ';
	photo += '	<img src="{$base_dir}asset/' + fpath + '" alt="" width="140" height="100px" />';
	photo += '	<div class="deletephoto_btn" onclick="javascript:return deleteImageFromHotel(' + fid + ')" />';
	photo += '  </div> ';
	photo += '	<input name="hotelFileName[]" value="' + fname + '" style="width:137px;overflow:hidden;" />';
	photo += '	<input type="hidden" name="hotelFileId[]" value="' + fid + '" />';
	photo += '</div>';
	$('#hotelphotos').append($(photo));

	$('#hotelphotos').sortable();
	//$('#hotel_photos').disableSelection();
}
function deleteImageFromHotel(fid) {
	if (confirm("{l s='Are you confirm to delete?'}")) {
	setWait();
	$.ajax({
		type : "post",
		datatype : "text",
		data : {
			fid : fid
		}, 
		url : "{$base_dir}hoteldetail.php?delimage",
		success : function(data, code){
			unsetWait();
			$('#hotel_photo_' + fid ).remove();
		}
	}); 
	}
	return false;
}

$(document).ready(function(){
	$('#hotelphotos').sortable({ disable: true });
	//$('#hotelphotos').disableSelection();
});


</script>        
