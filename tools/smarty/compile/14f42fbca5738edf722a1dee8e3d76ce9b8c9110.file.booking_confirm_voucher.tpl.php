<?php /* Smarty version Smarty-3.0.7, created on 2015-10-01 01:58:48
         compiled from "/var/www/html/tas-agent/themes/default/booking_confirm_voucher.tpl" */ ?>
<?php /*%%SmartyHeaderCode:803611523560c9358e68189-80932423%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '14f42fbca5738edf722a1dee8e3d76ce9b8c9110' => 
    array (
      0 => '/var/www/html/tas-agent/themes/default/booking_confirm_voucher.tpl',
      1 => 1443664726,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '803611523560c9358e68189-80932423',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<!-- right content start -->
<div class="left right_content_outer">

    <div style="width: 100%; overflow: hidden;"> 
		<iframe id="voucherDiv" src="booking_confirm.php?booking=view&oid=<?php echo $_smarty_tpl->getVariable('booking_info')->value['order_id'];?>
&vouch_info=1&ajaxType=1" scrolling="no"
			width="980px" frameborder=0>
		</iframe>
	</div>
	<div class="booking_info_btn" style="width:300px">
        	<input type="button" class="button white medium" alt="<?php echo smartyTranslate(array('s'=>'back'),$_smarty_tpl);?>
" value="<?php echo smartyTranslate(array('s'=>'Back'),$_smarty_tpl);?>
" onclick="javascript:history.go(-1);" />
        	<input type="button" onclick='printIframe("voucherDiv");' value="<?php echo smartyTranslate(array('s'=>'Print'),$_smarty_tpl);?>
" class="button orange medium">
        	<!-- <input type="button" onclick="$('#voucherDiv').contentWindow.print();" 
        		value="<?php echo smartyTranslate(array('s'=>'print'),$_smarty_tpl);?>
" class="button orange"> -->
    
        	<input type="button" onclick="window.open('booking_confirm.php?booking=view&oid=<?php echo $_smarty_tpl->getVariable('booking_info')->value['order_id'];?>
&savepdf=1&ajaxType=1');" value="<?php echo smartyTranslate(array('s'=>'Save'),$_smarty_tpl);?>
" class="button orange medium">
	</div>
</div>
<!-- right content end -->
<div class="clearfix"></div>
<script>
function printIframe(id)
{
    var iframe = document.frames ? document.frames[id] : document.getElementById(id);
    var ifWin = iframe.contentWindow || iframe;
    iframe.focus();
    ifWin.printPage();
    return false;
}


$(document).ready(function()
		{
			// Set specific variable to represent all iframe tags.
			var iFrames = document.getElementsByTagName('iframe');

			// Resize heights.
			function iResize()
			{
				// Iterate through all iframes in the page.
				for (var i = 0, j = iFrames.length; i < j; i++)
				{
					// Set inline style to equal the body height of the iframed content.
					iFrames[i].style.height = iFrames[i].contentWindow.document.body.offsetHeight + 'px';
				}
			}

			// Check if browser is Safari or Opera.
			if ($.browser.safari || $.browser.opera)
			{
				// Start timer when loaded.
				$('iframe').load(function()
					{
						setTimeout(iResize, 0);
					}
				);

				// Safari and Opera need a kick-start.
				for (var i = 0, j = iFrames.length; i < j; i++)
				{
					var iSource = iFrames[i].src;
					iFrames[i].src = '';
					iFrames[i].src = iSource;
				}
			}
			else
			{
				// For other good browsers.
				$('iframe').load(function()
					{
						// Set inline style to equal the body height of the iframed content.
						this.style.height = this.contentWindow.document.body.offsetHeight + 'px';
					}
				);
			}
		}
	);
</script>
