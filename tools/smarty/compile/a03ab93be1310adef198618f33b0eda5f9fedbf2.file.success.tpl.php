<?php /* Smarty version Smarty-3.0.7, created on 2015-04-20 14:29:42
         compiled from "/var/www/html/themes/default/success.tpl" */ ?>
<?php /*%%SmartyHeaderCode:213629668652b2c1c5c6cdb0-04486888%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a03ab93be1310adef198618f33b0eda5f9fedbf2' => 
    array (
      0 => '/var/www/html/themes/default/success.tpl',
      1 => 1429176803,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '213629668652b2c1c5c6cdb0-04486888',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<body style="background-color:#FFF;">
<div class="layerout">
    <div class="header">
    	<div class="logo">
    		<a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
logo.jpg" alt="TAS-AGENT" width="254" /></a>
        	<p style="margin:10px 0px;"><?php echo smartyTranslate(array('s'=>'TAS Agent is online booking system to connect agents and Hotel in Japan'),$_smarty_tpl);?>
</p>
        </div>


    </div>
  <div class="clearfix"></div>
    <div class="top_line"></div>
    <div class="content_outer">
    <div class="content" style="padding-top:50px;">
		<p style="font-weight:bold;font-size:10pt"><?php echo smartyTranslate(array('s'=>'Password reset email sent successfully'),$_smarty_tpl);?>
<br/><?php echo smartyTranslate(array('s'=>'Please check email within 24 hours and change your password.'),$_smarty_tpl);?>
<br /></p>
     	<p>&nbsp;</p>
		<p style="font-weight:bold;font-size:10pt"><a href="login.php"><?php echo smartyTranslate(array('s'=>'Back to Top Page'),$_smarty_tpl);?>
</a></p>
    </div>
    </div>