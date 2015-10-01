<?php /* Smarty version Smarty-3.0.7, created on 2015-09-09 14:43:21
         compiled from "/var/www/tas/themes/default/adminlist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:96218678555efe319326757-18385429%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '06ce16604ac08ba3040a9fc82b731650caa0cff0' => 
    array (
      0 => '/var/www/tas/themes/default/adminlist.tpl',
      1 => 1441591115,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '96218678555efe319326757-18385429',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
            <!-- right content start -->
            <div class="left right_content_outer">
            	<!-- booking list search conditon start -->
            	<form name="searchFrm" method="post" action="adminlist.php">    
				<input type="hidden" id="p" name="p" value="<?php echo $_smarty_tpl->getVariable('p')->value;?>
" />
				<input type="hidden" id="n" name="n" value="<?php echo $_smarty_tpl->getVariable('n')->value;?>
" />
                <div class="bklist_srch_con">
                	<table cellpadding="0" cellspacing="0">
                    	<tbody>
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
                    <input type="button"  class="button orange medium" alt="search now" value="<?php echo smartyTranslate(array('s'=>'Search Now'),$_smarty_tpl);?>
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
                                <th><?php echo smartyTranslate(array('s'=>'Admin ID'),$_smarty_tpl);?>
</th>
                                <th class="odd"><?php echo smartyTranslate(array('s'=>'Name'),$_smarty_tpl);?>
</th>
                                <th><?php echo smartyTranslate(array('s'=>'Email'),$_smarty_tpl);?>
</th>
                                <th class="odd"><?php echo smartyTranslate(array('s'=>'User Type'),$_smarty_tpl);?>
</th>
                                <th><?php echo smartyTranslate(array('s'=>'Record Date'),$_smarty_tpl);?>
</th>
                                <th class="odd"></th>
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
                                <td class="<?php if ($_smarty_tpl->tpl_vars['item']->value['IsDelete']){?>_delete<?php }?>"><?php echo $_smarty_tpl->tpl_vars['item']->value['LoginUserName'];?>
</td>
                                <td class="odd<?php if ($_smarty_tpl->tpl_vars['item']->value['IsDelete']){?>_delete<?php }?>"><?php echo $_smarty_tpl->tpl_vars['item']->value['Name'];?>
</td>
                                <td class="<?php if ($_smarty_tpl->tpl_vars['item']->value['IsDelete']){?>_delete<?php }?>"><?php echo $_smarty_tpl->tpl_vars['item']->value['Email'];?>
</td>
                                <td class="odd<?php if ($_smarty_tpl->tpl_vars['item']->value['IsDelete']){?>_delete<?php }?>"><?php if ($_smarty_tpl->tpl_vars['item']->value['RoleID']==5){?><?php echo smartyTranslate(array('s'=>'Super Admin'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'Admin'),$_smarty_tpl);?>
<?php }?></td>
                                <td class="<?php if ($_smarty_tpl->tpl_vars['item']->value['IsDelete']){?>_delete<?php }?>"><?php echo $_smarty_tpl->tpl_vars['item']->value['CreateDate'];?>
</td>
                                <td class="odd<?php if ($_smarty_tpl->tpl_vars['item']->value['IsDelete']){?>_delete<?php }?>" style="text-align:center">
                                	<input type="button" value="<?php echo smartyTranslate(array('s'=>'Edit'),$_smarty_tpl);?>
" onclick="location.href='auth.php?mid=<?php echo $_smarty_tpl->tpl_vars['item']->value['UserID'];?>
&prev_page=adminlist'" class="button white small"/>
                                	<input type="hidden" id="delete_<?php echo $_smarty_tpl->tpl_vars['item']->value['UserID'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['IsDelete'];?>
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
                	<input type="button" value="<?php echo smartyTranslate(array('s'=>'New'),$_smarty_tpl);?>
" onclick="location.href='auth.php?prev_page=adminlist'" class="button orange medium"/>
                	<?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>3){?><input type="button" value="<?php echo smartyTranslate(array('s'=>'Delete'),$_smarty_tpl);?>
" id="btnDelete" class="button white medium" />
                	<input type="button" value="<?php echo smartyTranslate(array('s'=>'Undo Delete'),$_smarty_tpl);?>
" id="btnUnDelete" class="button orange medium" />
                	<input type="button" value="<?php echo smartyTranslate(array('s'=>'Delete Permanent'),$_smarty_tpl);?>
" id="btnDeleteP" class="button white medium"/><?php }?>
                </div>
                </div>
            </div>
            <!-- right content end -->
            <div class="clearfix"></div>
 <script type="text/javascript">
 $(function(){

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
adminlist.php?delete",
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
adminlist.php?del_permanent",
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
adminlist.php?undel",
				success : function(data, code){
					unsetWait();
					searchFrm.submit();
				}
			}); 
		} 
	 });
 });
 </script>