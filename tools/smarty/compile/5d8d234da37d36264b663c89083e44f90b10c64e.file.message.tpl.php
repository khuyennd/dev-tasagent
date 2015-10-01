<?php /* Smarty version Smarty-3.0.7, created on 2015-09-07 16:20:17
         compiled from "/var/www/tas/themes/default/message.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28445264355ed56d1256be7-07868181%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d8d234da37d36264b663c89083e44f90b10c64e' => 
    array (
      0 => '/var/www/tas/themes/default/message.tpl',
      1 => 1441591117,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28445264355ed56d1256be7-07868181',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include '/var/www/tas/tools/smarty/plugins/modifier.date_format.php';
?>            <!-- right content start -->
            <div class="left right_content_outer">
			  <form name="searchFrm" method="post" action="message.php">    
				<input type="hidden" id="p" name="p" value="<?php echo $_smarty_tpl->getVariable('p')->value;?>
" />
				<input type="hidden" id="n" name="n" value="<?php echo $_smarty_tpl->getVariable('n')->value;?>
" />
            
              <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>=4){?>           
            	<div class="search_bar">
                	<?php echo smartyTranslate(array('s'=>"Keyword"),$_smarty_tpl);?>

                    <input type="text" style="width:120px;" id="schKey" value="<?php echo $_GET['schKey'];?>
"/>
                    <input type="button" class="button orange medium" value="<?php echo smartyTranslate(array('s'=>'Search Now'),$_smarty_tpl);?>
" onclick="location.href='/message.php?schKey='+$('#schKey').val();"  />
                </div> 	               
              <?php }?>
              </form> 
                <!-- booking list search result start -->
                <div><form id="wfs" name="wfs" method="post">
                	<table cellpadding="0" cellspacing="0" class="darkgray">
                    	<thead>
                        	<tr> 
                        	  <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>=4){?>       
                            	<th class="odd"></th>
                            	<th><?php echo smartyTranslate(array('s'=>'Login ID'),$_smarty_tpl);?>
</th>
                                <th class="odd"><?php echo smartyTranslate(array('s'=>'Name'),$_smarty_tpl);?>
</th>
                                <th><?php echo smartyTranslate(array('s'=>'User Type'),$_smarty_tpl);?>
</th>
                                <th class="odd"><?php echo smartyTranslate(array('s'=>'Title'),$_smarty_tpl);?>
</th>
                                <th><?php echo smartyTranslate(array('s'=>'Last Update'),$_smarty_tpl);?>
</th>
                              <?php }else{ ?>
                              	<th class="odd" width="5%"><?php echo smartyTranslate(array('s'=>'No'),$_smarty_tpl);?>
</th>
                              	<th width="15%"><?php echo smartyTranslate(array('s'=>'Time'),$_smarty_tpl);?>
</th>
                              	<th class="odd"><?php echo smartyTranslate(array('s'=>'Title'),$_smarty_tpl);?>
</th>
                              <?php }?>
                            </tr>
                        </thead>
                    	<tbody>
                    	  <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['item']['index']++;
?>
                        	<tr id="tr_<?php echo $_smarty_tpl->tpl_vars['item']->value['MsgId'];?>
">
                        	  <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID>=4){?>
                            	<td class="odd" <?php if ($_smarty_tpl->tpl_vars['item']->value['isRead']==0){?>style="background-color:#cdcdcd"<?php }?>><input type="checkbox" class="check" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['MsgId'];?>
" name="idlist[]"/></td>
                                <td <?php if ($_smarty_tpl->tpl_vars['item']->value['isRead']==0){?>style="background-color:#cdcdcd"<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['LoginUserName'];?>
</td>
                                <td class="odd" <?php if ($_smarty_tpl->tpl_vars['item']->value['isRead']==0){?>style="background-color:#cdcdcd"<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['Name'];?>
</td>
                                <td <?php if ($_smarty_tpl->tpl_vars['item']->value['isRead']==0){?>style="background-color:#cdcdcd"<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['RoleName'];?>
</td>
                                <td class="odd" <?php if ($_smarty_tpl->tpl_vars['item']->value['isRead']==0){?>style="background-color:#cdcdcd"<?php }?> ><a href="#" id="<?php echo $_smarty_tpl->tpl_vars['item']->value['MsgId'];?>
" onclick="msgEdit(<?php echo $_smarty_tpl->tpl_vars['item']->value['MsgId'];?>
, '<?php echo $_smarty_tpl->tpl_vars['item']->value['Title'];?>
'); return false;"><?php if ($_smarty_tpl->tpl_vars['item']->value['isRead']==0){?><strong><?php echo $_smarty_tpl->tpl_vars['item']->value['Title'];?>
</strong><?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['item']->value['Title'];?>
<?php }?></a></td>
                                <td <?php if ($_smarty_tpl->tpl_vars['item']->value['isRead']==0){?>style="background-color:#cdcdcd"<?php }?>><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value['lastDate'],"%Y-%m-%d");?>
</td>
                              <?php }else{ ?>
                                <td class="odd" <?php if ($_smarty_tpl->tpl_vars['item']->value['isRead']==0){?>style="background-color:#cdcdcd"<?php }?>><?php echo ($_smarty_tpl->getVariable('p')->value-1)*$_smarty_tpl->getVariable('n')->value+$_smarty_tpl->getVariable('smarty')->value['foreach']['item']['index']+1;?>
</td>
                                <td <?php if ($_smarty_tpl->tpl_vars['item']->value['isRead']==0){?>style="background-color:#cdcdcd"<?php }?>><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value['lastDate'],"%Y-%m-%d");?>
</td>
                                <td class="odd" <?php if ($_smarty_tpl->tpl_vars['item']->value['isRead']==0){?>style="background-color:#cdcdcd"<?php }?>><a href="#" id="<?php echo $_smarty_tpl->tpl_vars['item']->value['MsgId'];?>
" onclick="msgEdit(<?php echo $_smarty_tpl->tpl_vars['item']->value['MsgId'];?>
, '<?php echo $_smarty_tpl->tpl_vars['item']->value['Title'];?>
'); return false;"><?php if ($_smarty_tpl->tpl_vars['item']->value['isRead']==0){?><strong><?php echo $_smarty_tpl->tpl_vars['item']->value['Title'];?>
</strong><?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['item']->value['Title'];?>
<?php }?></a></td>
                              <?php }?>  
                            </tr>
                          <?php }} ?>                            
                        </tbody>
                    </table>
                </form></div>
                <!-- booking list search result end -->
                
                <!-- page control start -->
                <?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./common/pagination.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
                <div class="clearfix"></div>
                <!-- page control end -->
                
                <div class="control_bar">
                  <?php if ($_smarty_tpl->getVariable('cookie')->value->RoleID<4){?>
                	<input type="button" class="button orange medium" value="<?php echo smartyTranslate(array('s'=>'Message To Admin'),$_smarty_tpl);?>
" onclick="openPopup('msgNewDiv');"/>
                  <?php }else{ ?>
                	<!-- <input type="button" class="button orange" value="詳細"/> -->
                    <input type="button" class="button white medium" value="<?php echo smartyTranslate(array('s'=>'Delete'),$_smarty_tpl);?>
" id="btnDelete"/>
                  <?php }?>
                    
                </div>
            </div>
            <!-- right content end -->
            <div class="clearfix"></div>
            
	<script>
		function msgEdit(msgId, msgTitle){
			<?php if ($_smarty_tpl->getVariable('cookie')->value->UserID!=$_smarty_tpl->getVariable('item')->value['UserId']){?>
				$("#tr_"+msgId).children().css('background-color', '');
				$("#"+msgId).html(msgTitle);
			<?php }?>
			ajaxLoad("msgEditDiv", "message.php?ajaxType=edit&msgId="+msgId, "openPopup('msgEditDiv');");
		}
		 // Delete
		 $("#btnDelete").click(function(){
			// No Selected
			if($(".check:checked").length == 0){
				alert("<?php echo smartyTranslate(array('s'=>'Please select any Notice'),$_smarty_tpl);?>
");
				 return false;
			}
			if(confirm("<?php echo smartyTranslate(array('s'=>'Are you confirm to delete?'),$_smarty_tpl);?>
")){
				setWait();
				$.ajax({
					type : "post",
					datatype : "text",
					data : $("#wfs").serialize(),
					url : "<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
message.php?delete",
					success : function(data, code){
						unsetWait();
						searchFrm.submit();
					}
				}); 
			} 
		 });
		function onMsgSubmit() {

			if ($('#title').val() == "") {
				alert("<?php echo smartyTranslate(array('s'=>'Please input title'),$_smarty_tpl);?>
");
				return false;
			}
			if ($('#cont').val() == "") {
				alert("<?php echo smartyTranslate(array('s'=>'Please input content'),$_smarty_tpl);?>
");
				return false;
			}
			document.msgNewFrm.submit();
		}
	</script>
	
	
	<form name="msgEditFrm" method="post" action="<?php echo $_smarty_tpl->getVariable('request_uri')->value;?>
" >
		<input type="hidden" name="SubmitMsg" value="1" />
		<div class="popup_win_frame" style="display:none;" id="msgEditDiv">
			
			
		</div>
	</form>		

	<!--popup_win start -->
	<div class="popup_win_frame" style="display:none;" id="msgNewDiv">
	<div class="popup_win_view"><form name="msgNewFrm" method="post" action="<?php echo $_smarty_tpl->getVariable('request_uri')->value;?>
" >
		<input type="hidden" name ="MsgId" value="0" />
		<input type="hidden" name ="SubmitMsg" value="1" />
				
		<div class="title"><div class="close_btn" onclick="closePopup('msgNewDiv');"></div><?php echo smartyTranslate(array('s'=>'Message To Admin'),$_smarty_tpl);?>
</div>
		<div class="edit_view">
		<table class="yellow">
	        <tr>
	        	<th><?php echo smartyTranslate(array('s'=>'Title'),$_smarty_tpl);?>
</th>
	            <td><input type="text" name="Title" id="title" style="width:80%;" /></td>
	        </tr>
	        <tr>
	        	<th style="vertical-align:top"><?php echo smartyTranslate(array('s'=>'Content'),$_smarty_tpl);?>
</th>
	            <td><textarea style="width:100%;height:100px;" name="Cont" id="cont"></textarea></td>
	        </tr>
	    </table>
	    </div>
	    <div class="popup_control_bar">
	    	<input type="button" class="button orange medium" value="<?php echo smartyTranslate(array('s'=>'Send'),$_smarty_tpl);?>
" onclick="onMsgSubmit(); return false;"/>
	        <input type="button" class="button white medium" value="<?php echo smartyTranslate(array('s'=>'Close'),$_smarty_tpl);?>
" onclick="closePopup('msgNewDiv');"/>
	    </div>
	    
	</form></div>
	</div>
	<!--popup_win end --> 