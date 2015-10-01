            <!-- right content start -->
            <div class="left right_content_outer">
            	<!-- hotel detail info start -->
            	<form name="inputFrm" method="post" action="poparea.php" >
            	<input type="hidden" name="Submit" value="1" />

               <p class="orange_color bold font14">{l s='Popular Area Edit'}</p>

                <!-- Information start -->
                <!-- Hotel Features list start -->
                <p style="float:left; color:#666; margin-top:20px; font-size:14px;">{l s='Area List'}</p>
                <div class="clearfix"></div>
                <div class="all_border hotel_features_list">
                	<table cellpadding="0" cellspacing="0">
                    	<tbody>

                        	<tr>
                        		{foreach from=$areaList item=item name=item}
                            	<td><input type="checkbox" name="fids[]" value="{$item.AreaId}" {if $item.IsPopular > 0}checked{/if}/>&nbsp;{$item.AreaName}</td>
                            	{if ($smarty.foreach.item.index + 1) % 4 == 0} </tr><tr>{/if}
                            	{/foreach}
                            </tr>

                        </tbody>
                    </table>
                </div>
                <!-- Hotel Features list end -->


            <div class="control_bar">
            	<input type="button" class="button orange medium" alt="save" value="{l s='Save'}" onclick="inputFrm.submit(); return false;" />&nbsp;&nbsp;
                <input type="button" class="button white medium" value="{l s='Cancel'}" alt="cancel" onclick="location.href='index.php'" />
            </div>
			</form>

           </div>
            <!-- right content end -->
            <div class="clearfix"></div>
 