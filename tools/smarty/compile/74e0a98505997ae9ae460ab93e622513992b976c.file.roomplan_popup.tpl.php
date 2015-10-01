<?php /* Smarty version Smarty-3.0.7, created on 2015-09-07 13:14:20
         compiled from "/var/www/tas/themes/default/./roomplan_popup.tpl" */ ?>
<?php /*%%SmartyHeaderCode:23662913655ed2b3c17e0e7-49086108%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '74e0a98505997ae9ae460ab93e622513992b976c' => 
    array (
      0 => '/var/www/tas/themes/default/./roomplan_popup.tpl',
      1 => 1441591119,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23662913655ed2b3c17e0e7-49086108',
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