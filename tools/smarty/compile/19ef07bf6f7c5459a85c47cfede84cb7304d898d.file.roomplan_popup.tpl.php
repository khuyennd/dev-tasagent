<?php /* Smarty version Smarty-3.0.7, created on 2015-09-16 04:45:10
         compiled from "/var/www/html/tas-agent/themes/default/./roomplan_popup.tpl" */ ?>
<?php /*%%SmartyHeaderCode:193420386055f8f3d6b02ec3-09242981%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '19ef07bf6f7c5459a85c47cfede84cb7304d898d' => 
    array (
      0 => '/var/www/html/tas-agent/themes/default/./roomplan_popup.tpl',
      1 => 1442369369,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '193420386055f8f3d6b02ec3-09242981',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!--popup_win start -->
	<div class="popup_win_frame" style="display:none;height: 240px" id="popup_roomplan">
		<div class="popup_win_view">
			<div class="title">
				<div class="close_btn" onclick="closePopup('popup_roomplan');"></div><?php echo smartyTranslate(array('s'=>'View Room plan'),$_smarty_tpl);?>

			</div>
			<div class="edit_view" id="popup_content_roomplan">
		
			</div>
		</div>
	</div>
	<div class="popup_win_frame" style="display:none;height: 140px;" id="popup_sale">
		<div class="popup_win_view">
			<div class="title">
				<div class="close_btn" onclick="closePopup('popup_sale');"></div><?php echo smartyTranslate(array('s'=>'View Sales'),$_smarty_tpl);?>

			</div>
			<div class="edit_view" id="popup_content_sale">
		
			</div>
		</div>
	</div>
	<!--popup_win end -->