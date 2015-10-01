<?php /* Smarty version Smarty-3.0.7, created on 2015-09-16 05:19:24
         compiled from "/var/www/html/tas-agent/themes/default/poparea.tpl" */ ?>
<?php /*%%SmartyHeaderCode:60703950755f8fbdc077976-95921496%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eb385cfebc2726096471c86d4d9c18e3f89a74a2' => 
    array (
      0 => '/var/www/html/tas-agent/themes/default/poparea.tpl',
      1 => 1442369370,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '60703950755f8fbdc077976-95921496',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
            <!-- right content start -->
            <div class="left right_content_outer">
            	<!-- hotel detail info start -->
            	<form name="inputFrm" method="post" action="poparea.php" >
            	<input type="hidden" name="Submit" value="1" />

               <p class="orange_color bold font14"><?php echo smartyTranslate(array('s'=>'Popular Area Edit'),$_smarty_tpl);?>
</p>

                <!-- Information start -->
                <!-- Hotel Features list start -->
                <p style="float:left; color:#666; margin-top:20px; font-size:14px;"><?php echo smartyTranslate(array('s'=>'Area List'),$_smarty_tpl);?>
</p>
                <div class="clearfix"></div>
                <div class="all_border hotel_features_list">
                	<table cellpadding="0" cellspacing="0">
                    	<tbody>

                        	<tr>
                        		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('areaList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['index']++;
?>
                            	<td><input type="checkbox" name="fids[]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['AreaId'];?>
" <?php if ($_smarty_tpl->tpl_vars['item']->value['IsPopular']>0){?>checked<?php }?>/>&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['AreaName'];?>
</td>
                            	<?php if (($_smarty_tpl->getVariable('smarty')->value['foreach']['item']['index']+1)%4==0){?> </tr><tr><?php }?>
                            	<?php }} ?>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <!-- Hotel Features list end -->


            <div class="control_bar">
            	<input type="button" class="button orange medium" alt="save" value="<?php echo smartyTranslate(array('s'=>'Save'),$_smarty_tpl);?>
" onclick="inputFrm.submit(); return false;" />&nbsp;&nbsp;
                <input type="button" class="button white medium" value="<?php echo smartyTranslate(array('s'=>'Cancel'),$_smarty_tpl);?>
" alt="cancel" onclick="location.href='index.php'" />
            </div>
			</form>

           </div>
            <!-- right content end -->
            <div class="clearfix"></div>
 