
<body style="background-color:#FFF;">
<div class="layerout">
    <div class="header">
    	<div class="logo">
    		<a href="{$base_dir}"><img src="{$img_dir}logo.jpg" alt="TAS-AGENT" width="254" /></a>
        </div>
        <div class="register_ad_top">
        	
        </div>        
    </div>
  <div class="clearfix"></div>
    <div class="top_line"></div>
    <div class="content_outer">
    <div class="content" style="padding-top:50px;">
{if $cookie->LanguageID == 4}
		<p>ご登録ありがとうございます。<br/>　
		審査後、TAS Agent Teamよりご連絡いたします。</p>
		<br/><br/>
		<a href="index.php">トップページ</a>へ戻る
	
{else}
    	<p>Thank you very much for registration. <br />
			We will contact you shortly for issuing account.</p>
		<br/><br/>
		Back to <a href="index.php">Top Page</a>
{/if}		
    </div>
    </div>
      	