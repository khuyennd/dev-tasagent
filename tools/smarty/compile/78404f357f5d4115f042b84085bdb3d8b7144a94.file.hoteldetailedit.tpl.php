<?php /* Smarty version Smarty-3.0.7, created on 2015-09-30 09:03:31
         compiled from "/var/www/html/tas-agent/themes/default/hoteldetailedit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:705851002560ba563950e87-32272370%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '78404f357f5d4115f042b84085bdb3d8b7144a94' => 
    array (
      0 => '/var/www/html/tas-agent/themes/default/hoteldetailedit.tpl',
      1 => 1443603782,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '705851002560ba563950e87-32272370',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<script>
    jQuery.validator.addMethod("fax", function (fax_number, element) {
        fax_number = fax_number.replace(/\s+/g, "");
        return this.optional(element) || fax_number.length > 1 &&
                fax_number.match(/^[+0-9. ()-]*$/);
    }, "<?php echo smartyTranslate(array('s'=>'Please specify a valid fax number'),$_smarty_tpl);?>
");

    $(document).ready(function() {
	$.validator.addMethod("valueNotEquals", function(value, element, arg){
		  return arg != value;
		 }, "<?php echo smartyTranslate(array('s'=>'Area/Ciry must  be selected.'),$_smarty_tpl);?>
");
			
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
                <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>3&&$_GET['mid']==0){?>
                    <?php $_smarty_tpl->tpl_vars["admin_add_hotel"] = new Smarty_variable("1", null, null);?>
                <?php }else{ ?>
                    <?php $_smarty_tpl->tpl_vars["admin_add_hotel"] = new Smarty_variable("0", null, null);?>
                <?php }?>
                <input type="hidden" name="admin_add_hotel" value="<?php echo $_smarty_tpl->getVariable('admin_add_hotel')->value;?>
" />
            	<input type="hidden" name="Submit" value="1" />
            	<input type="hidden" name="mid" value="<?php echo $_smarty_tpl->getVariable('mid')->value;?>
" />
                <div class="bold" style="text-align:right;float:right">
                    <?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./common/sub_menu.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
                </div>
               <p class="orange_color bold font14" style="margin-bottom:5px;"><?php echo smartyTranslate(array('s'=>'Base Info'),$_smarty_tpl);?>
</p>               
               <?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./common/errors.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
                <div class="all_border base_info">
                	<div class="input_info">
					    <label>&nbsp;</label>
                        <span class="red"><?php echo smartyTranslate(array('s'=>"*If you would like to edit with other Language version, "),$_smarty_tpl);?>
</span><br/>
                    <?php if ($_smarty_tpl->getVariable('sl_lang')->value==1){?><!-- 20130228 #1173 -->
                    <label>&nbsp;</label><span class="red"><?php echo smartyTranslate(array('s'=>"please change language with language bar locating at up right and edit."),$_smarty_tpl);?>
</span><br/>
					<?php }?>
					</div> 
                	<div class="input_info">
                    	<label><?php echo smartyTranslate(array('s'=>'Hotel Code'),$_smarty_tpl);?>
</label>
                        &nbsp;&nbsp;<?php echo $_smarty_tpl->getVariable('hotel')->value->HotelCode;?>

                    </div>    
                    <div class="input_info">
                    	<label><?php echo smartyTranslate(array('s'=>'Hotel Name'),$_smarty_tpl);?>
</label>
                        <input type="text" value="<?php echo $_smarty_tpl->getVariable('hotel')->value->HotelName;?>
" class="bold font18" name="HotelName" id="HotelName" />
                    </div>    
                    <div class="input_info">
                    	<label><?php echo smartyTranslate(array('s'=>'Area/City'),$_smarty_tpl);?>
</label>
                        <select class="" onchange="AreaSelect(); return false;" id="selarea" name="HotelArea" style="width:200px;">
                            <option value=""><?php echo smartyTranslate(array('s'=>'Area Select'),$_smarty_tpl);?>
</option>
                            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('areaList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['index']++;
?>
                            	<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['AreaId'];?>
" <?php if ($_smarty_tpl->tpl_vars['item']->value['AreaId']==$_smarty_tpl->getVariable('hotel')->value->HotelArea){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['AreaName'];?>
</option>
                            <?php }} ?>
                        </select>
                        <select class="" name="HotelCity" id="selcity" style="width:200px;margin-left:10px;">
                            <option value=""><?php echo smartyTranslate(array('s'=>'City Select'),$_smarty_tpl);?>
</option>
                            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cityList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['index']++;
?>
                            	<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['CityId'];?>
" <?php if ($_smarty_tpl->tpl_vars['item']->value['CityId']==$_smarty_tpl->getVariable('hotel')->value->HotelCity){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['CityName'];?>
</option>
                            <?php }} ?>
                        </select>
                    </div>    
                    <div class="input_info">
                    	<label><?php echo smartyTranslate(array('s'=>'Address'),$_smarty_tpl);?>
</label>
                        <input type="text" value="<?php echo $_smarty_tpl->getVariable('hotel')->value->HotelAddress;?>
" name="HotelAddress" />
                    </div>    
                    <div class="input_info">
                    	<label><?php echo smartyTranslate(array('s'=>'Hotel Category'),$_smarty_tpl);?>
</label>
                        <select name="HotelClass" style="width:200px;">
                            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('classList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['index']++;
?>
                            	<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['HotelClassId'];?>
" <?php if ($_smarty_tpl->tpl_vars['item']->value['HotelClassId']==$_smarty_tpl->getVariable('hotel')->value->HotelClass){?>selected<?php }?>><?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['item']->value['HotelClassName']),$_smarty_tpl);?>
</option>
                            <?php }} ?>
                        </select>
                    </div>
                    <div class="input_info">
                    	<label><?php echo smartyTranslate(array('s'=>'Contact No'),$_smarty_tpl);?>
</label>
                        <input type="text" value="<?php echo $_smarty_tpl->getVariable('hotel')->value->HotelContactNo;?>
" name="HotelContactNo" style="width:200px;" />
                    </div>
                    <div class="input_info">
                        <label><?php echo smartyTranslate(array('s'=>"FAX"),$_smarty_tpl);?>
</label>
                        <input type="text" name="HotelFax" value="<?php echo $_smarty_tpl->getVariable('hotel')->value->HotelFax;?>
"/>
                    <br/>
                    <label>&nbsp;</label>
                        <span class="red"><?php echo smartyTranslate(array('s'=>"Please input Fax number with Country code + Fax number."),$_smarty_tpl);?>
</span><br/>
                    <label>&nbsp;</label><span class="red"><?php echo smartyTranslate(array('s'=>"if your number start with \"0\" please take out \"0\". "),$_smarty_tpl);?>
</span><br/>
                    <?php if ($_smarty_tpl->getVariable('sl_lang')->value==1){?><!-- 20130228 #1173 -->
                    <label>&nbsp;</label><span class="red"><?php echo smartyTranslate(array('s'=>"eg: if your fax number is 03-1234-5678, please input 81312345678."),$_smarty_tpl);?>
</span><br/>
					<?php }?>
                    </div>
                    <div class="input_info">
                        <label><?php echo smartyTranslate(array('s'=>"E-mail"),$_smarty_tpl);?>
</label>
                        <input type="text" name="HotelEmail" value="<?php echo $_smarty_tpl->getVariable('hotel')->value->HotelEmail;?>
"/>
                        <span class="red"></span>
                    </div>
                    <div class="input_info">
                        <label><?php echo smartyTranslate(array('s'=>'Receive Booking'),$_smarty_tpl);?>
</label>
                        <input type="radio" value="prefFax" name="prefCon" style="width:auto;margin-right: 10px;"<?php if ($_smarty_tpl->getVariable('hotel')->value->PrefFax==1&&$_smarty_tpl->getVariable('hotel')->value->PrefEmail==0){?> checked="checked"<?php }?> />ＦＡＸで送る
                        <input type="radio" value="prefEmail" name="prefCon" style="width:auto;margin-right: 10px;margin-left: 15px;"<?php if ($_smarty_tpl->getVariable('hotel')->value->PrefFax==0&&$_smarty_tpl->getVariable('hotel')->value->PrefEmail==1){?> checked="checked"<?php }?> />メールで送る
                        <input type="radio" value="prefAll" name="prefCon" style="width:auto;margin-right: 10px;margin-left: 15px;"<?php if ($_smarty_tpl->getVariable('hotel')->value->PrefFax==1&&$_smarty_tpl->getVariable('hotel')->value->PrefEmail==1){?> checked="checked"<?php }?> />メールとＦＡＸ両方で送る
                        <input type="radio" value="prefNone" name="prefCon" style="width:auto;margin-right: 10px;margin-left: 15px;"<?php if ($_smarty_tpl->getVariable('hotel')->value->PrefFax==0&&$_smarty_tpl->getVariable('hotel')->value->PrefEmail==0){?> checked="checked"<?php }?> />送らない
                    </div>
                </div>
               
                <!-- hotel detail info end -->
                
                <!-- Information start -->
                <!-- Hotel Features list start -->
                <p style="float:left;  margin-top:20px;" class="orange_color bold font14" ><?php echo smartyTranslate(array('s'=>'Hotel Features'),$_smarty_tpl);?>
</p>
                <p style="float:right; margin-top:20px;"><span class="orange_color bold" style="font-family:Tahoma">√</span> <?php echo smartyTranslate(array('s'=>'Available'),$_smarty_tpl);?>
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
                            	<td><input type="checkbox" name="fids[]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['FeatureId'];?>
" <?php if ($_smarty_tpl->tpl_vars['item']->value['LinkId']>0){?>checked<?php }?>/>&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['FeatureName'];?>
</td>
                            	<?php if (($_smarty_tpl->getVariable('smarty')->value['foreach']['item']['index']+1)%4==0){?> </tr><tr><?php }?>
                            	<?php }} ?>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>   
                <!-- Hotel Features list end -->
                 
                <!-- Hotel Detail Information start -->
                <div class="hotel_deinfo_div">
                	<div class="hotel_description">
                    	<div class="hotel_deinfo_title" onclick="showapp('hoteldes','hoteldes_detail')" ><h4 class="unfold" id="hoteldes"><?php echo smartyTranslate(array('s'=>'Hotel Description'),$_smarty_tpl);?>
</h4></div>
                        <div class="show detail_info" id="hoteldes_detail" style="padding:0px;margin:0px;">
                        	<textarea style="width:96%;height:100px;padding:2%;border:none;" name="HotelDescription"><?php echo $_smarty_tpl->getVariable('hotel')->value->HotelDescription;?>
</textarea>
						</div>
                    </div>
                    
                    <div class="hotel_policy">
                    	<div class="hotel_deinfo_title" onclick="showapp('hotelpol','hotelpol_detail')" ><h4 class="unfold" id="hotelpol"><?php echo smartyTranslate(array('s'=>'Hotel Policies'),$_smarty_tpl);?>
</h4></div>
                        <div class="show detail_info" id="hotelpol_detail" style="padding:0px;margin:0px;">
                        	<textarea style="width:96%;height:100px;padding:2%;border:none;" name="HotelPolicies"><?php echo $_smarty_tpl->getVariable('hotel')->value->HotelPolicies;?>
</textarea>
						</div>
                    </div>
                   
                    <div class="hotel_useinfo">
                    	<div class="hotel_deinfo_title" onclick="showapp('usefulinfo','usefulinfo_detail')"><h4 class="unfold" id="usefulinfo"><?php echo smartyTranslate(array('s'=>'Useful Information'),$_smarty_tpl);?>
</h4></div>
                      <div class="show detail_info" id="usefulinfo_detail" style="border-bottom:1px solid #CCC;padding:0px;margin:0px;">
                        	<textarea style="width:96%;height:100px;padding:2%;border:none;" name="UsefulInformation"><?php echo $_smarty_tpl->getVariable('hotel')->value->UsefulInformation;?>
</textarea>
                       	 </div>
                    </div>
                    
                </div>   
                
                <!-- Hotel Detail Information end -->
                
                <!-- uploadphoto start -->
          		<?php if (!$_smarty_tpl->getVariable('isie')->value){?>
                <p style="margin-top:20px;"><a href="#"><input type="button" class="button orange medium" value="<?php echo smartyTranslate(array('s'=>'Upload Photo'),$_smarty_tpl);?>
" onclick="return onupload_photo(); "/></a></p>
				<?php }?>
			    <?php if ($_smarty_tpl->getVariable('isie')->value){?> 
                
                <!--<form action="hoteldetail.php?action=upload" method="post" enctype="multipart/form-data" id="img_form_ie" name="img_upload_ie">
                    <input type="file" name="myfile[]"  multiple="multiple" onchange="return onsubmit_img_form()" />
                    <input type="hidden" name="mid" value="<?php echo $_smarty_tpl->getVariable('mid')->value;?>
" />
                    <input type="hidden" class="button orange medium" value="<?php echo smartyTranslate(array('s'=>'Upload File to Server'),$_smarty_tpl);?>
" form="img_form_ie" id="img_form_ie_but" />
                </form>-->
                <form action="hoteldetail.php?action=upload" method="post" enctype="multipart/form-data" id="img_form_ie" name="img_upload_ie" style="display:none;" >
				<input type="hidden" name="myfile[]"  multiple="multiple" />
				<input type="hidden" name="mid" value="<?php echo $_smarty_tpl->getVariable('mid')->value;?>
" />
				<input type="hidden" class="button orange medium" value="<?php echo smartyTranslate(array('s'=>'Upload File to Server'),$_smarty_tpl);?>
" form="img_form_ie" id="img_form_ie_but" />
			</form>
                    
			<form action="hoteldetail.php?action=upload" method="post" enctype="multipart/form-data" id="img_form" >
			        <input type="file" name="myfile[]"  multiple=""  id="img_upload_btn"  accept="image/jpeg,image/png" onchange="return onsubmit_img_form()" />
			        <input type="hidden" name="mid" value="<?php echo $_smarty_tpl->getVariable('mid')->value;?>
" />
			        <input type="hidden" value="Upload File to Server" class="button orange medium"/>
			</form>
				   
				<?php }?>   
                
                <div class="left all_border home_hotel_div">                        
                    <div class="pophotel_outer" id="hotelphotos"> 
                    	<!-- <div class="left">Uploaded Photo</div> -->
                    	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('photoList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['index']++;
?>
                        <div class="pophotel_div" id="hotel_photo_<?php echo $_smarty_tpl->tpl_vars['item']->value['HotelFileId'];?>
" style="width:140px;margin-right:0px;">
                            <div class="photo_frame"><img src="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
asset/<?php echo $_smarty_tpl->tpl_vars['item']->value['HotelFilePath'];?>
" alt="" width="140" height="100px" />
	                            <div class="deletephoto_btn" onclick="javascript:return deleteImageFromHotel(<?php echo $_smarty_tpl->tpl_vars['item']->value['HotelFileId'];?>
)"></div>
                            </div>                            
                            <input name="hotelFileName[]"  value="<?php echo $_smarty_tpl->tpl_vars['item']->value['HotelFileName'];?>
" style="width:137px;overflow:hidden;"/>
                            <input type="hidden" name="hotelFileId[]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['HotelFileId'];?>
" />
                        </div>
                       <?php }} ?>
                       
                    </div>
<div class="clearfix"></div>
                </div>    
                <div class="clearfix"></div>
                
                <!-- uploadphoto end -->                                    
                <!-- Information end -->
             
            
            <div class="control_bar">
            	<input type="button" value="<?php echo smartyTranslate(array('s'=>'Save'),$_smarty_tpl);?>
" class="button orange medium" onclick="inputFrm_Save(); return false;" />
                <input type="button" value="<?php echo smartyTranslate(array('s'=>'Cancel'),$_smarty_tpl);?>
" class="button white medium" onclick="location.href='index.php'"/>
            </div>       
			</form>
			
			<form action="hoteldetail.php?action=upload" method="post" enctype="multipart/form-data" id="img_form" style="visibility:hidden;">
			         <input type="file" name="myfile[]"  multiple=""  id="img_upload_btn_check"  accept="image/jpeg,image/png" onchange="return onsubmit_img_form()" />
			        <input type="hidden" name="mid" value="<?php echo $_smarty_tpl->getVariable('mid')->value;?>
" />
			        <input type="submit" value="Upload File to Server" class="button orange medium"/>
			</form>
           </div>
            <!-- right content end -->
            <div class="clearfix"></div>
<script>
function inputFrm_Save() {
    var flag=true;
    if ($('input[name=prefCon]:checked').val() == undefined || $('input[name=prefCon]:checked').val() == '') {
        alert('<?php echo smartyTranslate(array('s'=>'Please select the Receive Booking'),$_smarty_tpl);?>
');
        flag= false;
    }

    if (($('input[name=prefCon]:checked').val()=='prefFax' ||$('input[name=prefCon]:checked').val()=='prefAll' )&& $('input[name=HotelFax]').val() == '') {
        alert('<?php echo smartyTranslate(array('s'=>'Please input the Fax Number'),$_smarty_tpl);?>
');
        flag= false;
    }
    if (($('input[name=prefCon]:checked').val()=='prefEmail'||$('input[name=prefCon]:checked').val()=='prefAll') && $('input[name=HotelEmail]').val() == '') {
        alert('<?php echo smartyTranslate(array('s'=>'Please input the Email'),$_smarty_tpl);?>
');
        flag= false;
    }

	if($("#inputFrm").valid()&&flag==true)
	{
		inputFrm.submit(); 
		alert('<?php echo smartyTranslate(array('s'=>'Updated! \rIf you would like to edit with other Language version, please change language with language bar locating at up right and edit'),$_smarty_tpl);?>
');
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
		url : "<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
hoteldetail.php?getcity",
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
	photo += '	<img src="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
asset/' + fpath + '" alt="" width="140" height="100px" />';
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
	if (confirm("<?php echo smartyTranslate(array('s'=>'Are you confirm to delete?'),$_smarty_tpl);?>
")) {
	setWait();
	$.ajax({
		type : "post",
		datatype : "text",
		data : {
			fid : fid
		}, 
		url : "<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
hoteldetail.php?delimage",
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
