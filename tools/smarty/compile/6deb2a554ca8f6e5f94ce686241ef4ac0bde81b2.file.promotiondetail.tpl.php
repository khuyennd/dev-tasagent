<?php /* Smarty version Smarty-3.0.7, created on 2015-04-17 13:59:38
         compiled from "/var/www/html/themes/default/promotiondetail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12023894455530933a1f9f19-41076616%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6deb2a554ca8f6e5f94ce686241ef4ac0bde81b2' => 
    array (
      0 => '/var/www/html/themes/default/promotiondetail.tpl',
      1 => 1429176803,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12023894455530933a1f9f19-41076616',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- right content start -->
            <div class="left right_content_outer">
            	<p class="orange_color"><?php if ($_smarty_tpl->getVariable('data')->value['Type']==0){?>
                    <?php echo smartyTranslate(array('s'=>'Promotion'),$_smarty_tpl);?>

            		<?php }else{ ?>
                    <?php echo smartyTranslate(array('s'=>'Event'),$_smarty_tpl);?>

            		<?php }?>
            	</p>
            	<br/>
	<table class="darkgray" style="margin-top:10px;">
		<tr>
			<th style="text-align:left;"><?php echo $_smarty_tpl->getVariable('data')->value['Title'];?>
</th>
		</tr>
        <tr>
        	<td style="color:#999;text-align:left;">
            	<?php echo smartyTranslate(array('s'=>'Hotel name'),$_smarty_tpl);?>
:<?php echo $_smarty_tpl->getVariable('data')->value['HotelName'];?>
<br/>
                <?php echo smartyTranslate(array('s'=>'Area'),$_smarty_tpl);?>
:<?php echo $_smarty_tpl->getVariable('data')->value['AreaName'];?>
</br>
                <?php echo smartyTranslate(array('s'=>'Period'),$_smarty_tpl);?>
:<?php echo $_smarty_tpl->getVariable('data')->value['StaDate'];?>
 ~ <?php echo $_smarty_tpl->getVariable('data')->value['EndDate'];?>

            </td>
        </tr>
		<tr>
			<td><?php echo $_smarty_tpl->getVariable('data')->value['Content'];?>
</td>
		</tr>
        <tr>
        	<td style="background:#f7f7f7;text-align:right;"><?php echo smartyTranslate(array('s'=>"Writer"),$_smarty_tpl);?>
 : <?php echo $_smarty_tpl->getVariable('data')->value['UserName'];?>
</td>
        </tr>
	</table>
    <div class="btns_bar">
    	<input type="button" value="<?php echo smartyTranslate(array('s'=>'List'),$_smarty_tpl);?>
" onclick="location.href='<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
promotionlist.php?type=<?php echo $_smarty_tpl->getVariable('data')->value['Type'];?>
';" class="button orange medium"/>
    </div>
    </div>
            <!-- right content end -->
            <div class="clearfix"></div>
