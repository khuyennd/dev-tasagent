<?php /* Smarty version Smarty-3.0.7, created on 2013-12-19 13:55:46
         compiled from "/var/www/html/themes/default/passwordexpired.tpl" */ ?>
<?php /*%%SmartyHeaderCode:147081117252b27c521a21b0-54386719%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '156a0772643cb8bfc16ed7e89f2c1655b3753144' => 
    array (
      0 => '/var/www/html/themes/default/passwordexpired.tpl',
      1 => 1387426903,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '147081117252b27c521a21b0-54386719',
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
		<p style="font-weight:bold;font-size:10pt"><?php echo smartyTranslate(array('s'=>'Check code has expired!'),$_smarty_tpl);?>
<br/></p>
     	<p>&nbsp;</p>
		<p style="font-weight:bold;font-size:10pt"><a href="login.php"><?php echo smartyTranslate(array('s'=>'Back to Top Page'),$_smarty_tpl);?>
</a></p>
    </div>
    </div>