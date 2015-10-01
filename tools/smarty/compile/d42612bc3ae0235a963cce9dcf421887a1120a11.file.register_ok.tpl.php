<?php /* Smarty version Smarty-3.0.7, created on 2015-09-07 15:27:35
         compiled from "/var/www/tas/themes/default/register_ok.tpl" */ ?>
<?php /*%%SmartyHeaderCode:207853718355ed4a77cd8de6-41380968%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd42612bc3ae0235a963cce9dcf421887a1120a11' => 
    array (
      0 => '/var/www/tas/themes/default/register_ok.tpl',
      1 => 1441591117,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '207853718355ed4a77cd8de6-41380968',
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
        </div>
        <div class="register_ad_top">
        	
        </div>        
    </div>
  <div class="clearfix"></div>
    <div class="top_line"></div>
    <div class="content_outer">
    <div class="content" style="padding-top:50px;">
<?php if ($_smarty_tpl->getVariable('cookie')->value->LanguageID==4){?>
		<p>ご登録ありがとうございます。<br/>　
		審査後、TAS Agent Teamよりご連絡いたします。</p>
		<br/><br/>
		<a href="index.php">トップページ</a>へ戻る
	
<?php }else{ ?>
    	<p>Thank you very much for registration. <br />
			We will contact you shortly for issuing account.</p>
		<br/><br/>
		Back to <a href="index.php">Top Page</a>
<?php }?>		
    </div>
    </div>
      	