<?php /* Smarty version Smarty-3.0.7, created on 2015-09-07 15:48:42
         compiled from "/var/www/tas/themes/default/hoteldataimport.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32031560155ed4f6a34e739-43310038%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd27af9b09276a33b47ce271e2de04ae42f9b6a08' => 
    array (
      0 => '/var/www/tas/themes/default/hoteldataimport.tpl',
      1 => 1441591116,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32031560155ed4f6a34e739-43310038',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- right content start -->
            <div class="left right_content_outer">
            
            	<!-- show succeed hotels -->
                <div class="orange_color bold"><?php echo smartyTranslate(array('s'=>'Import Hotels Backup Data'),$_smarty_tpl);?>
</div>
                <div class="all_border" style="padding:10px;">
            	<div class="darkgray"><?php echo smartyTranslate(array('s'=>'Please select file'),$_smarty_tpl);?>
</div>
            	
            	<form method="POST" action="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
hoteldataimport.php?import" enctype="multipart/form-data" name="hotelimportform">
            	<input type="button" onclick="onSelectFile();" value="<?php echo smartyTranslate(array('s'=>'Select'),$_smarty_tpl);?>
" class="button white medium"/>
            	<input type="text" id="filename" style="width:150px;height:18px;" readonly/>
            	<input type="file" id="hotelexcel" name="hotelexcel" style="display:none" onchange="onSelectedFile();" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
	            <input type="button" value="<?php echo smartyTranslate(array('s'=>'import'),$_smarty_tpl);?>
" onclick="onImport();" class="button orange medium"/>
            	</form>
            	</div>
            <?php if ($_smarty_tpl->getVariable('status')->value==1){?>
            	<!-- show succeed hotels -->
            	
            	<div class="orange_color bold" style="padding:20px 0px 0px 0px"><?php echo smartyTranslate(array('s'=>'Added hotels'),$_smarty_tpl);?>
</div>
            	<table class="darkgray" style="margin-top:10px;">
            		<tr>
            			<th class="odd"><?php echo smartyTranslate(array('s'=>'No'),$_smarty_tpl);?>
</th>
            			<th><?php echo smartyTranslate(array('s'=>'Hotel Code'),$_smarty_tpl);?>
</th>
            			<th class="odd"><?php echo smartyTranslate(array('s'=>'Hotel Name'),$_smarty_tpl);?>
</th>
            		</tr>
            		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('result')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['iteration']=0;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['iteration']++;
?>
					<tr>            		
            			<td class="odd"><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['item']['iteration'];?>
</td>
            			<td ><?php echo $_smarty_tpl->tpl_vars['item']->value['code'];?>
</td>
            			<td class="odd"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
					</tr>            			
            		<?php }} ?>
            		<?php if ($_smarty_tpl->getVariable('cnt')->value==0){?>
            			<td colspan='3' align="center"><h5><?php echo smartyTranslate(array('s'=>'No hotel imported'),$_smarty_tpl);?>
</h5></td>
            		<?php }?>
				</table>            		
            <?php }?>
            
            <br/><br/>
            <?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./common/errors.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
            </div>
            
            <!-- right content end -->
            <div class="clearfix"></div>
            
            <script language="javascript">
            	function onSelectFile(){
					$('#hotelexcel').click();
            	}

            	function onSelectedFile(){
                	$('#filename').val($('#hotelexcel').val());
            	}


            	function onImport(){
					if($('#hotelexcel').val() == ''){
						alert("<?php echo smartyTranslate(array('s'=>'Please select file to import.'),$_smarty_tpl);?>
");
						return;
					}
					document.hotelimportform.submit();
            	}
            </script>