<?php /* Smarty version Smarty-3.0.7, created on 2015-09-16 07:42:30
         compiled from "/var/www/html/tas-agent/themes/default/hotellist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:65319493455f91d66b7cb79-42704753%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '20b355d4c776a879467b2b1eba897497a8c3f785' => 
    array (
      0 => '/var/www/html/tas-agent/themes/default/hotellist.tpl',
      1 => 1442369370,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '65319493455f91d66b7cb79-42704753',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
            <!-- right content start -->
            <div class="left right_content_outer"> 
            	<!-- booking list search conditon start -->
            	<form name="searchFrm" method="post" action="hotellist.php">    
				<input type="hidden" id="p" name="p" value="<?php echo $_smarty_tpl->getVariable('p')->value;?>
" />
				<input type="hidden" id="n" name="n" value="<?php echo $_smarty_tpl->getVariable('n')->value;?>
" />
                <div class="bklist_srch_con">
                	<table cellpadding="0" cellspacing="0">
                    	<tbody>
                        	<tr>
                                <td class="bklist_srch_td"><?php echo smartyTranslate(array('s'=>'Hotel Name'),$_smarty_tpl);?>
</td>
                                <td><input type="text" name="HotelName" value="<?php if (isset($_POST['CompanyName'])){?><?php echo $_POST['CompanyName'];?>
<?php }?>"/></td>
                                <td class="bklist_srch_td"><?php echo smartyTranslate(array('s'=>'User ID'),$_smarty_tpl);?>
</td>
                                <td><input type="text" name="LoginUserName" value="<?php if (isset($_POST['LoginUserName'])){?><?php echo $_POST['LoginUserName'];?>
<?php }?>" /></td>
                            </tr>
                            <tr>
                            	<td class="bklist_srch_td"><?php echo smartyTranslate(array('s'=>'Email'),$_smarty_tpl);?>
</td>
                                <td>
                                	<input type="text" name="Email" value="<?php if (isset($_POST['Email'])){?><?php echo $_POST['Email'];?>
<?php }?>"/>
                                </td>
                                <td class="bklist_srch_td"><?php echo smartyTranslate(array('s'=>'Name'),$_smarty_tpl);?>
</td>
                                <td>
                                	<input type="text" name="Name" value="<?php if (isset($_POST['Name'])){?><?php echo $_POST['Name'];?>
<?php }?>"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="bklist_srch_btn">
                    <input type="button"  class="button orange medium" value="<?php echo smartyTranslate(array('s'=>'Search Now'),$_smarty_tpl);?>
" onclick="searchFrm.submit(); return false;" />
                </div>
                </form>
                <div class="clearfix"></div>
                <!-- booking list search conditon end -->
                   
                <!-- booking list search result start -->
                <div class="">
                	<form id="wfs" name="wfs" method="post">
                	<table class="darkgray">
                    	<thead>
                        	<tr>
                        		<th class="odd"></th> 
				<th><?php echo smartyTranslate(array('s'=>'Company Name'),$_smarty_tpl);?>
</th>
                            	<th class="odd"><?php echo smartyTranslate(array('s'=>'Hotel Name'),$_smarty_tpl);?>
</th>
                                <th ><?php echo smartyTranslate(array('s'=>'User ID'),$_smarty_tpl);?>
</th>
                                <th class="odd"><?php echo smartyTranslate(array('s'=>'Name'),$_smarty_tpl);?>
</th>
                                <th ><?php echo smartyTranslate(array('s'=>'Email'),$_smarty_tpl);?>
</th>
                                <th class="odd"><?php echo smartyTranslate(array('s'=>'Status'),$_smarty_tpl);?>
</th>
                                <th ></th>
                            </tr>
                        </thead>
                    	<tbody>
                    	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listData')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
                        	<tr>
                        		<td class="odd<?php if ($_smarty_tpl->tpl_vars['item']->value['IsDelete']){?>_delete<?php }?>"><input type="checkbox" class="check" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['UserID'];?>
" name="idlist[]"/></td>
                                <td class="<?php if ($_smarty_tpl->tpl_vars['item']->value['IsDelete']){?>_delete<?php }?>"><?php echo $_smarty_tpl->tpl_vars['item']->value['CompanyName'];?>
</td>
				<td class="odd<?php if ($_smarty_tpl->tpl_vars['item']->value['IsDelete']){?>_delete<?php }?>"><a href="hotelpage.php?mid=<?php echo $_smarty_tpl->tpl_vars['item']->value['HotelId'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['HotelName'];?>
</a></td>
                                <td class="<?php if ($_smarty_tpl->tpl_vars['item']->value['IsDelete']){?>_delete<?php }?>"><?php echo $_smarty_tpl->tpl_vars['item']->value['LoginUserName'];?>
</td>
                                <td class="odd<?php if ($_smarty_tpl->tpl_vars['item']->value['IsDelete']){?>_delete<?php }?>"><?php echo $_smarty_tpl->tpl_vars['item']->value['Name'];?>
</td>
                                <td class="<?php if ($_smarty_tpl->tpl_vars['item']->value['IsDelete']){?>_delete<?php }?>"><?php echo $_smarty_tpl->tpl_vars['item']->value['Email'];?>
</td>
                                <td class="odd<?php if ($_smarty_tpl->tpl_vars['item']->value['IsDelete']){?>_delete<?php }?>"><?php if ($_smarty_tpl->tpl_vars['item']->value['IsActive']==0){?><?php echo smartyTranslate(array('s'=>'Pending'),$_smarty_tpl);?>
<?php }else{ ?>_<?php }?>
                                </td>
                                <td class="<?php if ($_smarty_tpl->tpl_vars['item']->value['IsDelete']){?>_delete<?php }?>" style="text-align:center">
                                	<input type="button" value="<?php echo smartyTranslate(array('s'=>'Edit'),$_smarty_tpl);?>
" onclick="location.href='auth.php?mid=<?php echo $_smarty_tpl->tpl_vars['item']->value['UserID'];?>
&prev_page=hotellist'" class="button white small" style="margin:3px;"/>
                                	<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>3){?><input type="button" value="<?php echo smartyTranslate(array('s'=>'Msg'),$_smarty_tpl);?>
"
                                		onclick="sendMsg(<?php echo $_smarty_tpl->tpl_vars['item']->value['UserID'];?>
, <?php echo $_smarty_tpl->tpl_vars['item']->value['CompanyID'];?>
, '<?php echo $_smarty_tpl->tpl_vars['item']->value['LoginUserName'];?>
', '<?php echo $_smarty_tpl->tpl_vars['item']->value['Name'];?>
');"  class="button white small"/><?php }?>
                                	<input type="hidden" id="delete_<?php echo $_smarty_tpl->tpl_vars['item']->value['UserID'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['IsDelete'];?>
" />
                                	<input type="hidden" id="active_<?php echo $_smarty_tpl->tpl_vars['item']->value['UserID'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['IsActive'];?>
" />
                                </td>
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
                
                <div>
                <div class="btns_bar">	
                	<input type="button" value="<?php echo smartyTranslate(array('s'=>'Verify'),$_smarty_tpl);?>
" id="btnVerify" class="button orange medium" />
                	<input type="button" value="<?php echo smartyTranslate(array('s'=>'New'),$_smarty_tpl);?>
" onclick="location.href='auth.php?prev_page=hotellist'"  class="button orange medium"/>
                	<input type="button" value="<?php echo smartyTranslate(array('s'=>'Delete'),$_smarty_tpl);?>
" id="btnDelete" class="button white medium"/>
                	<input type="button" value="<?php echo smartyTranslate(array('s'=>'Undo Delete'),$_smarty_tpl);?>
" id="btnUnDelete" class="button orange medium"/>
                	<input type="button" value="<?php echo smartyTranslate(array('s'=>'Delete Permanent'),$_smarty_tpl);?>
" id="btnDeleteP" class="button white medium"/>                    
                </div>
                </div>
                
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
	            <th><?php echo smartyTranslate(array('s'=>'User ID'),$_smarty_tpl);?>
</th>
	            <td id="UserLoginId"></td>            
	        </tr>
		<tr>
	        	<th><?php echo smartyTranslate(array('s'=>'Name'),$_smarty_tpl);?>
</th>
	            <td id="Name"></td>
	        </tr>
	        <tr>
	        	<th><?php echo smartyTranslate(array('s'=>'Title'),$_smarty_tpl);?>
</th>
	            <td><input type="text" name="Title" style="width:80%;" req msg="<?php echo smartyTranslate(array('s'=>'Please input Title'),$_smarty_tpl);?>
" /></td>
	        </tr>
	        <tr>
	        	<th style="vertical-align:top"><?php echo smartyTranslate(array('s'=>'Content'),$_smarty_tpl);?>
</th>
	            <td><textarea style="width:100%;height:100px;" name="Cont" req msg="<?php echo smartyTranslate(array('s'=>'Please input Content'),$_smarty_tpl);?>
"></textarea></td>
	        </tr>
	    </table>
	    </div>
	    <div class="popup_control_bar">
	    	<input type="button" class="button orange medium" value="<?php echo smartyTranslate(array('s'=>'Send'),$_smarty_tpl);?>
" onclick="if(!getFormData(document.msgNewFrm)) return false; 
		    	document.msgNewFrm.submit();"/>
	        <input type="button" class="button white medium" value="<?php echo smartyTranslate(array('s'=>'Close'),$_smarty_tpl);?>
" onclick="closePopup('msgNewDiv');"/>
	    </div>
	    
	</form></div>
	</div>
	<!--popup_win end -->
	
	            
            
            
            
 <script type="text/javascript">
	function sendMsg(uId, cId, uLogin, cName){
		$("#UserId").val(uId);				$("#CompanyId").val(cId);
		$("#UserLoginId").html(uLogin);		$("#Name").html(cName);	
		openPopup('msgNewDiv');
	}


$(function(){
	 // Verify 
	 $("#btnVerify").click(function(){
		// No Selected
		if($(".check:checked").length == 0) return false;
		var isRun = true;
		$(".check:checked").each(function() {
			if ($('#active_'+$(this).val()).val() == 1) {
				isRun = false;
			}
		});
		if(isRun && confirm("<?php echo smartyTranslate(array('s'=>'Are you confirm to verify?'),$_smarty_tpl);?>
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
		var isRun = true;
		$(".check:checked").each(function() {
			if ($('#delete_'+$(this).val()).val() == 1) {
				isRun = false;
			}
		});
		if(isRun && confirm("<?php echo smartyTranslate(array('s'=>'Are you confirm to delete?'),$_smarty_tpl);?>
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
		var isRun = true;
		$(".check:checked").each(function() {
			if ($('#delete_'+$(this).val()).val() == 0) {
				isRun = false;
			}
		});
		if(isRun && confirm("<?php echo smartyTranslate(array('s'=>'Are you confirm to undo deleting?'),$_smarty_tpl);?>
")){
			setWait();
			$.ajax({
				type : "post",
				datatype : "text",
				data : $("#wfs").serialize(),
				url : "<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
hotellist.php?undel",
				success : function(data, code){
					unsetWait();
					searchFrm.submit();
				}
			}); 
		} 
	 });
 });
 </script>