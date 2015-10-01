<?php /* Smarty version Smarty-3.0.7, created on 2015-09-09 14:33:40
         compiled from "/var/www/tas/themes/default/promotionlist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:84873615755efe0d4149a64-15846427%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9fd40fdd97fdfa01331a5504ea4edff904dd5485' => 
    array (
      0 => '/var/www/tas/themes/default/promotionlist.tpl',
      1 => 1441591117,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '84873615755efe0d4149a64-15846427',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- right content start -->
            <div class="left right_content_outer">
            	<!-- booking list search conditon start -->
            	<form name="searchFrm" method="post" action="promotionlist.php">    
				<input type="hidden" id="p" name="p" value="<?php echo $_smarty_tpl->getVariable('p')->value;?>
" />
				<input type="hidden" id="n" name="n" value="<?php echo $_smarty_tpl->getVariable('n')->value;?>
" />
				<input type="hidden" id="type" name="type" value="<?php echo $_REQUEST['type'];?>
" />
                
                </form>
                <div class="clearfix"></div>
                <!-- booking list search conditon end -->
                   
                <!-- booking list search result start -->
                <div class="bklist_srch_result">
                	<form id="wfs" name="wfs" method="post">
                	<table class="darkgray">
                    	<thead>
                        	<tr>
                        		<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>3){?>
                        			<th class="odd txtcenter"></th>
                        		<?php }else{ ?>
                        			<th class="odd txtcenter"><?php echo smartyTranslate(array('s'=>'No'),$_smarty_tpl);?>
</th>
                        		<?php }?>
                                <th><?php echo smartyTranslate(array('s'=>'Hotel Name'),$_smarty_tpl);?>
</th>
                                <th class="odd"><?php echo smartyTranslate(array('s'=>'Area'),$_smarty_tpl);?>
</th>
                                <th><?php echo smartyTranslate(array('s'=>'Title'),$_smarty_tpl);?>
</th>
                                <th class="odd"><?php echo smartyTranslate(array('s'=>'Effective Period'),$_smarty_tpl);?>
</th>
								<th class="odd"><?php echo smartyTranslate(array('s'=>'Create Date'),$_smarty_tpl);?>
</th>
                                <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>3){?>
                                	<th></th>
                                <?php }?>
                            </tr>
                        </thead>
                    	<tbody>
                    	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listData')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['item']->index++;
?>
                        	<tr>
                        		<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>3){?>
                        			<td class="odd txtcenter"><input type="checkbox" class="check" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['PromotionId'];?>
" name="idlist[]"/></td>
                        		<?php }else{ ?>
                        			<td class="odd txtcenter"><?php echo ($_smarty_tpl->getVariable('p')->value-1)*$_smarty_tpl->getVariable('n')->value+$_smarty_tpl->tpl_vars['item']->index+1;?>
</td>
                        		<?php }?>
                                <td class=""><?php echo $_smarty_tpl->tpl_vars['item']->value['HotelName'];?>
</td>
                                <td class="odd"><?php echo $_smarty_tpl->tpl_vars['item']->value['AreaName'];?>
</td>
                                <td class=""><a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
promotiondetail.php?PromotionId=<?php echo $_smarty_tpl->tpl_vars['item']->value['PromotionId'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['Title'];?>
</a></td>
                                <td class="odd"><?php echo $_smarty_tpl->tpl_vars['item']->value['StaDate'];?>
 ~ <?php echo $_smarty_tpl->tpl_vars['item']->value['EndDate'];?>
</td>
                                <td class=""><?php echo $_smarty_tpl->tpl_vars['item']->value['CreateDate'];?>
</td>
                                <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>3){?>
	                                <td class="odd" style="text-align:center">
	                                	<input type="button" value="<?php echo smartyTranslate(array('s'=>'Edit'),$_smarty_tpl);?>
" onclick="onEditPromotion(<?php echo $_smarty_tpl->tpl_vars['item']->value['PromotionId'];?>
);" class="button white small">
	                                </td>
                                <?php }?>
                            </tr>
                        <?php }} ?>
                        
                        <?php if ($_smarty_tpl->getVariable('nb_products')->value==0){?> 
                        	<tr><td colspan="7" style="text-align: center"><?php echo smartyTranslate(array('s'=>'There is no data'),$_smarty_tpl);?>
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
                
                <div class="control_bar">
                	<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>3){?>
                		<input type="button" value="<?php echo smartyTranslate(array('s'=>'New'),$_smarty_tpl);?>
" onclick="onNewPromotion();" class="button orange medium"/>
                		<input type="button" value="<?php echo smartyTranslate(array('s'=>'Delete'),$_smarty_tpl);?>
" id="btnDelete" class="button white medium"/>
                	<?php }?>
                </div>
                <br /><br />
            </div>
            <!-- right content end -->
            <div class="clearfix"></div>
            
            <!-- promotion edit popup -->
            <!--popup_win start -->
            <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>3){?>
						<div class="popup_win_frame" style="display:none" id="promotionedit_popup">
						<div class="popup_win_view" style="width: 700px;">
							<div class="title">
						    	<div class="close_btn" onclick="closePopup('promotionedit_popup');"></div>
						    	<?php if ($_REQUEST['type']==0){?>
						        	<?php echo smartyTranslate(array('s'=>'Promotion Detail'),$_smarty_tpl);?>

						        <?php }else{ ?>
						        	<?php echo smartyTranslate(array('s'=>'Event Detail'),$_smarty_tpl);?>

						        <?php }?>
						    </div>
							<div class="edit_view">
							<form name="regForm" id="regForm">
								<input type="hidden" name="Type" value="<?php echo $_REQUEST['type'];?>
"/>
								<input type="hidden" name="PromotionId" value="0"/>
								<table class="yellow">
							    	<tr>
							        	<th><?php echo smartyTranslate(array('s'=>'Hotel Name'),$_smarty_tpl);?>
</th>
							            <td><input type="text" style="width:80%;" name="HotelName"/></td>
							        </tr>
							        <tr>    
							            <th><?php echo smartyTranslate(array('s'=>'Area'),$_smarty_tpl);?>
</th>
							            <td>
							            	<select style="width:80%" name="AreaId" id="AreaId">
							            	<?php  $_smarty_tpl->tpl_vars['area'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('areaList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['area']->key => $_smarty_tpl->tpl_vars['area']->value){
?>
							                	<option value='<?php echo $_smarty_tpl->tpl_vars['area']->value['AreaId'];?>
'><?php echo $_smarty_tpl->tpl_vars['area']->value['AreaName'];?>
</option>
							                <?php }} ?>
							                </select>
							            </td>            
							        </tr>
							        <tr>
							        	<th><?php echo smartyTranslate(array('s'=>'Effective Period'),$_smarty_tpl);?>
</th>
							            <td>
							            	<input type="text" value="" name="StaDate" id="StaDate" class="calendar_text"/>
							                <img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
calendar_icon.jpg" class="calendar_icon2" onclick="if(self.gfPop)gfPop.fPopCalendar(getById('StaDate'));"/> ~
											<input type="text" value="" name="EndDate" id="EndDate" class="calendar_text"/>
							                <img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
calendar_icon.jpg" class="calendar_icon2" onclick="if(self.gfPop)gfPop.fPopCalendar(getById('EndDate'));"/>
							            </td>
							        </tr>
							        <tr>
							        	<th><?php echo smartyTranslate(array('s'=>'Title'),$_smarty_tpl);?>
</th>
							            <td><input type="text" style="width:80%;" name="Title"/></td>
							        </tr>
							        
							        <tr>
							        	<th><?php echo smartyTranslate(array('s'=>'Content'),$_smarty_tpl);?>
</th>
							            <td><div id='Content' name='Content' style="width:100%;height:100px;"></div></td>
							        </tr>
							    </table>
						    </form>
						    
						    </div>
						    <div class="popup_control_bar">
						    	<input type="button" class="button orange medium" value="<?php echo smartyTranslate(array('s'=>'Save'),$_smarty_tpl);?>
" onclick="savePromotion();"/>
						        <input type="button" class="button white medium" value="<?php echo smartyTranslate(array('s'=>'Close'),$_smarty_tpl);?>
" onclick="closePopup('promotionedit_popup')"/>
						    </div>
						</div>
						</div>
						
						<!--popup_win end -->
			<?php }?>

 <script type="text/javascript">
 $(function(){
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
promotionlist.php?delete",
				success : function(data, code){
					unsetWait();
					searchFrm.submit();
				}
			}); 
		} 
	 });
 });

 //load CKEditor
 
 var ckeditor = CKEDITOR.replace('Content',
		 {
			      resize_enabled:false,
	 	  toolbar:[['Format'],['FontSize'], 
	 		 	  ['Bold','Italic','Underline','Strike', 'File', 'Image','-','Subscript','Superscript'], 
	 		 	  ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl']],
	 	  filebrowserImageUploadUrl : "<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
promotionlist.php?uploadimage"
	 	 });
 //
 function onNewPromotion(){
	clearRegPromotionForm();
	openPopup('promotionedit_popup');
 }

 function onEditPromotion(PromotionId){
	 	setWait();
	 	$.ajax({
				type:'post',
				datatype :'text',
				data : "PromotionId="+PromotionId,
				url : "<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
promotionlist.php?getdetail",
				success: function(data,code){
					unsetWait();
					//alert(data);
					var obj = $.parseJSON(data);
					$.each(obj, function(key, val) {
						if(key!='Content' && key!='AreaId')
					    	$("#regForm input[name=" + key + "]").val(val);
					});
					
					//AreaId , Content set
					CKEDITOR.instances.Content.setData(decodeURIComponent(obj.Content));
					$("#AreaId").val(obj.AreaId);
					
					openPopup('promotionedit_popup');
				}
 		   });
 }
 
 function savePromotion(){
	setWait();
	var frm = document.regForm;

	var cont = encodeURIComponent(CKEDITOR.instances.Content.getData());
	$.ajax({
		type : "post",
		datatype : "text",
		
		data: {
			   Type : frm.Type.value,
			   PromotionId:frm.PromotionId.value,
			   HotelName:frm.HotelName.value, 
			   AreaId:frm.AreaId.value,
			   Title:frm.Title.value,
			   StaDate:frm.StaDate.value,
			   EndDate:frm.EndDate.value,
			   Content:cont
			   },
	    
	   success : function(data, code){
		   unsetWait();
		   data = data.replace(/^\s+|\s+$/g,'')
		   if(data == 'true'){
		   	 	alert("<?php echo smartyTranslate(array('s'=>'Operation succeed!'),$_smarty_tpl);?>
");
		   	    closePopup('promotionedit_popup');
		   	 	document.searchFrm.submit();
		   }
		   else
			   alert(data);
	   },
	   url : "<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
promotionlist.php?add"
	});
 }
 
 function clearRegPromotionForm(){
	document.regForm.PromotionId.value = '0';
	document.regForm.HotelName.value = '';
	document.regForm.Title.value = '';
	CKEDITOR.instances.Content.setData('');
 }

 </script>
