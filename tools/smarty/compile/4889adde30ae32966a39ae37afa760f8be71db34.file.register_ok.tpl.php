<?php /* Smarty version Smarty-3.0.7, created on 2015-04-20 11:40:30
         compiled from "/var/www/html/themes/default/register_ok.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2112005799541124e9db73f2-16853636%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4889adde30ae32966a39ae37afa760f8be71db34' => 
    array (
      0 => '/var/www/html/themes/default/register_ok.tpl',
      1 => 1429176803,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2112005799541124e9db73f2-16853636',
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
      	