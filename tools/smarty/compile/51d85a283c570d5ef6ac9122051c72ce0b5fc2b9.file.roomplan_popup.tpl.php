<?php /* Smarty version Smarty-3.0.7, created on 2015-08-19 11:46:26
         compiled from "/var/www/html/themes/default/./roomplan_popup.tpl" */ ?>
<?php /*%%SmartyHeaderCode:117344059552d626432855a7-25794960%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '51d85a283c570d5ef6ac9122051c72ce0b5fc2b9' => 
    array (
      0 => '/var/www/html/themes/default/./roomplan_popup.tpl',
      1 => 1438824618,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '117344059552d626432855a7-25794960',
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