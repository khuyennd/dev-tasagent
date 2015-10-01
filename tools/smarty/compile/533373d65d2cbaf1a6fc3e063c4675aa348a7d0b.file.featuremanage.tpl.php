<?php /* Smarty version Smarty-3.0.7, created on 2015-09-18 01:52:07
         compiled from "/var/www/html/tas-agent/themes/default/featuremanage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:133579471155fb6e47322e66-53674166%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '533373d65d2cbaf1a6fc3e063c4675aa348a7d0b' => 
    array (
      0 => '/var/www/html/tas-agent/themes/default/featuremanage.tpl',
      1 => 1442369374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '133579471155fb6e47322e66-53674166',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
            <!-- right content start -->
            <div class="left right_content_outer">
            	<!-- booking list search conditon start -->
            	<form name="searchFrm" method="post" action="featuremanage.php">    
				<input type="hidden" id="p" name="p" value="<?php echo $_smarty_tpl->getVariable('p')->value;?>
" />
				<input type="hidden" id="n" name="n" value="<?php echo $_smarty_tpl->getVariable('n')->value;?>
" />
                <div class="bklist_srch_con">
                	<table cellpadding="0" cellspacing="0">
                    	<tbody>
                            <tr>
                            	<td class="bklist_srch_td"><?php echo smartyTranslate(array('s'=>'Keyword'),$_smarty_tpl);?>
</td>
                                <td>
                                	<input type="text" name="FeatureName" value="<?php if (isset($_POST['FeatureName'])){?><?php echo $_POST['FeatureName'];?>
<?php }?>"/>
                                </td>
                                <td class="bklist_srch_td"><?php echo smartyTranslate(array('s'=>'Type'),$_smarty_tpl);?>
</td>
                                <td>
                                	<select name="FeatureType" >
                                		<option value=""><?php echo smartyTranslate(array('s'=>'All'),$_smarty_tpl);?>
</option>
				               		<?php  $_smarty_tpl->tpl_vars['feature'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('featureList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['feature']->key => $_smarty_tpl->tpl_vars['feature']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['feature']->key;
?>
				                		<option value="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" <?php if (isset($_POST['FeatureType'])&&$_POST['FeatureType']==$_smarty_tpl->tpl_vars['k']->value){?>selected<?php }?>><?php echo smartyTranslate(array('s'=>($_smarty_tpl->tpl_vars['feature']->value)),$_smarty_tpl);?>
</option>
				                	<?php }} ?>    
				                	</select>
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
                                <th><?php echo smartyTranslate(array('s'=>'Type'),$_smarty_tpl);?>
</th>
                                <th class="odd"><?php echo smartyTranslate(array('s'=>'Features'),$_smarty_tpl);?>
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
                        		<td class="odd"><input type="checkbox" class="check" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['FeatureId'];?>
" name="idlist[]"/></td>
                                <td class=""><?php echo smartyTranslate(array('s'=>($_smarty_tpl->getVariable('featureList')->value[$_smarty_tpl->tpl_vars['item']->value['FeatureType']])),$_smarty_tpl);?>
</td>
                                <td class="odd"><?php echo $_smarty_tpl->tpl_vars['item']->value['FeatureName'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['CreateDate'];?>
</td>
                                <td class="odd" style="text-align:center">
                                	<input type="button" value="<?php echo smartyTranslate(array('s'=>'Edit'),$_smarty_tpl);?>
" onclick="EditPopup('<?php echo $_smarty_tpl->tpl_vars['item']->value['FeatureId'];?>
', '<?php echo $_smarty_tpl->tpl_vars['item']->value['FeatureType'];?>
', '<?php echo $_smarty_tpl->tpl_vars['item']->value['FeatureName'];?>
'); return false;" class="button white small"/>
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
" onclick="NewPopup(); return false;" class="button orange medium"/>
                	<input type="button" value="<?php echo smartyTranslate(array('s'=>'Delete'),$_smarty_tpl);?>
" id="btnDelete" class="button white medium" />
                </div>
                </div>
                
                <br /><br />
            </div>
            <!-- right content end -->
            <div class="clearfix"></div>
   
<!--popup_win start -->
<div class="popup_win_frame" id="meminfo_popup" style="display:none; ">
<div class="popup_win_view" style="width:300px;">
	<div class="title">
    	<div class="close_btn"  onclick="closePopup('meminfo_popup'); return false;"></div>
        <?php echo smartyTranslate(array('s'=>'Features Information Edit'),$_smarty_tpl);?>

    </div>
	<div class="edit_view" style="border-bottom:1px solid #f2f2f2;" >
	<table class="no_border" style="margin:0" >
    	<tr>
                <th style="text-align:right;"><?php echo smartyTranslate(array('s'=>'Type'),$_smarty_tpl);?>
: </th>
                <td>
               		<select id="mem_type">
               		<?php  $_smarty_tpl->tpl_vars['feature'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('featureList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['feature']->key => $_smarty_tpl->tpl_vars['feature']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['feature']->key;
?>
                		<option value="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
"><?php echo smartyTranslate(array('s'=>($_smarty_tpl->tpl_vars['feature']->value)),$_smarty_tpl);?>
</option>
                	<?php }} ?>    
                	</select>
                </td>
            </tr>
            <tr>
            	<th style="text-align:right;"><?php echo smartyTranslate(array('s'=>'Features'),$_smarty_tpl);?>
: </th>
                <td>
                	<input id="mem_name"></input>
                </td>
            </tr>
    </table>
    
    </div>
    <div class="popup_control_bar">
	<input type="hidden" id="mem_idx" />
    	<input type="button" class="button orange" value="<?php echo smartyTranslate(array('s'=>'Save'),$_smarty_tpl);?>
" onclick="saveMember(); return false;"/>
        <input type="button" class="button white" value="<?php echo smartyTranslate(array('s'=>'Cancel'),$_smarty_tpl);?>
" onclick="closePopup('meminfo_popup'); return false;"/>
    </div>
</div>
</div>
<!--popup_win end -->    
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
featuremanage.php?delete",
				success : function(data, code){
					unsetWait();
					searchFrm.submit();
				}
			}); 
		} 
	 });
 });
 
 function EditPopup(idx, type, name) {
	 $("#mem_idx").val(idx);
	 $("#mem_name").val(name);
	 $("#mem_type").val(type);
	 openPopup('meminfo_popup');
 }
 function NewPopup() {
	 $("#mem_idx").val(0);
	 $("#mem_name").val("");
	 $("#mem_type").val("");
	 openPopup('meminfo_popup'); 
 }
 function saveMember() {
     
     if ($("#mem_name").val() == ""){
         alert("<?php echo smartyTranslate(array('s'=>'Please input the features'),$_smarty_tpl);?>
");
         $("#mem_username").focus();
         return false;
     }
     setWait();
     $.ajax({
         type : 'post',
         datatype : 'text',
         data : { 
             	 idx : $("#mem_idx").val(),
                 name : $("#mem_name").val(),
                 type : $("#mem_type").val(),
                 },
         url : "<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
featuremanage.php?submit",
         success : function(data, code){
             unsetWait();
             if (data == 'success'){
                 closePopup('meminfo_popup');
                 searchFrm.submit();
             }else{
                 alert(data);
             }
             return false;
         }
     });
     return false;
 }
 </script>