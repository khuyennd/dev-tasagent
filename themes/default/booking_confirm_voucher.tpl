

<!-- right content start -->
<div class="left right_content_outer">

    <div style="width: 100%; overflow: hidden;"> 
		<iframe id="voucherDiv" src="booking_confirm.php?booking=view&oid={$booking_info['order_id']}&vouch_info=1&ajaxType=1" scrolling="no"
			width="980px" frameborder=0>
		</iframe>
	</div>
	<div class="booking_info_btn" style="width:300px">
        	<input type="button" class="button white medium" alt="{l s='back'}" value="{l s='Back'}" onclick="javascript:history.go(-1);" />
        	<input type="button" onclick='printIframe("voucherDiv");' value="{l s='Print'}" class="button orange medium">
        	<!-- <input type="button" onclick="$('#voucherDiv').contentWindow.print();" 
        		value="{l s='print'}" class="button orange"> -->
    
        	<input type="button" onclick="window.open('booking_confirm.php?booking=view&oid={$booking_info['order_id']}&savepdf=1&ajaxType=1');" value="{l s='Save'}" class="button orange medium">
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
