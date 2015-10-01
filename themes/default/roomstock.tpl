<script>
	function moveListMonth(pos){
		var curDay = new Date('{$dateYm}-01');
		curDay.setMonth(curDay.getMonth()+pos);
		var nowDay = new Date();	
		
		if (curDay.getYear() < nowDay.getYear() || (curDay.getYear() == nowDay.getYear() && curDay.getMonth() < nowDay.getMonth())) return; 
		dateYm = get_todaystr("Y-m", curDay, true);
		location.href="room_stock.php?hid={$hid}&pno={$pno}&dateYm="+dateYm;
	}
	function changeYM() {
		dateYm = $('#ymselect').val();
		location.href="room_stock.php?hid={$hid}&pno={$pno}&dateYm="+dateYm;
	}
	function calFrmSubmit(){
		var frm = document.calFrm;
		if (getFormData(frm)==false)	return false;
		var isOk=true;
		$("input[name='adate[]']").each(function(){
			var tdObj = $(this).parent();
			var date = $(this).val();
			
			var amount = trim(tdObj.find("input[name='amount[]']").val()); 	if (amount=="") amount=0;
			var price = trim(tdObj.find("input[name='price[]']").val()); 	if (price=="") price=0;
			var asia = trim(tdObj.find("input[name='asia[]']").val()); 	if (asia=="") asia=0;
			var euro = trim(tdObj.find("input[name='euro[]']").val()); 	if (euro=="") euro=0;
			if (amount!=0 || price!=0 || asia!=0 ||  euro!=0){
				if(amount == 0){
					// alert(date+"{l s='`s Amount must be inputed'}"); isOk=false; return false;
				}
				if(price == 0){
					if (asia == 0 && euro == 0){
						alert(date+"{l s='`s Asia or Euro must be inputed'}");	isOk=false; return false;}
				}/*else{
					if (asia != 0 || euro != 0){  
						alert(date+"{l s='`s All price is inputed, you can`t input Asia and Euro'}"); isOk=false; return false;}
				}
				*/
				
			} 
			
		});
		if (!isOk) return false;
		document.calFrm.submit();
		alert('{l s='Updated!'}');
	}
	
	function batchFrmSubmit(){
		var frm = document.batchFrm;
		var staDate = trim(frm.staDate.value);
		if (staDate == "") {
			alert("{l s='Please Input Start Time!'}"); return false;
		}
		var endDate = trim(frm.endDate.value);
		if (endDate == "") {
			alert("{l s='Please Input End Time!'}"); return false;
		}
		if(time_cmp(staDate, "00:00:00", endDate, "00:00:00") == false)	{
			alert("{l s='End Time Must be greater than Start Time.'}");	return false;
		}
		if(time_cmp("{$prow.staDate}", "00:00:00", staDate, "00:00:00") == false || 
				time_cmp(endDate , "00:00:00", "{$prow.endDate}", "00:00:00") == false )	{
			
			alert("{l s='Selected Duration Must be contained in Room Plan Duration.'}");	return false;
		}
		if (getFormData(frm)==false)	return false;

		var price = trim(frm.Price.value); 	if (price=="") price=0;
		var asia = trim(frm.Asia.value); 	if (asia=="") asia=0;
		var euro = trim(frm.Euro.value); 	if (euro=="") euro=0;

		/*
		if(price == 0){
			if (asia == 0 || euro == 0){
				alert("{l s='Please Input both of Asia and Euro'}"); 
				return false;}
		}else{
			if (asia != 0 || euro != 0){
				alert("{l s='If you input All price, you can`t input others'}"); 
				return false;}
		}
		*/
		if (price == 0 && asia == 0 && euro == 0)
		{
			alert("{l s='Please input price'}"); 
			$(frm.Price).focus();
			return false;
		}
		
		document.batchFrm.submit();
		alert('{l s='Updated!'}');
	}
</script>
            <!-- right content start -->
            <div class="left right_content_outer">
            	<!-- hotel detail info start -->

                <div style="float:left"> {l s='Room Plan'} : <select style="width:120px"
                                                                     onchange="location.href='room_stock.php?hid={$hid}&pno='+this.value;">
                {foreach from=$planList item=item name=item}
                    <option value="{$item.RoomPlanId}"
                            {if $item.RoomPlanId==$pno}selected{/if} >{$item.RoomPlanName}</option>
                {/foreach}
                </select></div>
                <div style="float:right;font-weight:bold;">
                    {include file="$tpl_dir./common/sub_menu.tpl"}
                </div>

                <p style="color:#666; margin-top:35px; font-size:14px;margin-bottom:10px;font-weight:bold;">1. {l s='Batch'}</p>
              <div class="all_border"><form name="batchFrm" action="room_stock.php?pno={$pno}" method="post">
              	<input type="hidden" name="SubmitBatch" value="1" />
              	<input type="hidden" name="RoomPlanId" value="{$pno}" />
              	<input type="hidden" name="hid" value={$hid} />
                <div style="padding:3px;">
                    <div style="float:right;">
						<input type="button" class="button orange medium" value="{l s='Save'}" onclick="batchFrmSubmit();"/>
                    </div>
                
                    <label>{l s='Time'}</label>
                  <input type="text" class="calendar_text" readonly id="staDate" name="staDate" value="{$prow.staDate1}"/>
                    <img src="{$img_dir}calendar_icon.jpg" alt="" width="13" class="calendar_icon2" onclick="if(self.gfPop)gfPop.fPopCalendar(getById('staDate'));"/>
                    <span style="font-family:Tahoma, Geneva, sans-serif">~</span> 
                  <input type="text"  class="calendar_text" readonly id="endDate" name="endDate" value="{$prow.endDate1}"/>
                    <img src="{$img_dir}calendar_icon.jpg" alt="" width="13" class="calendar_icon2"/ onclick="if(self.gfPop)gfPop.fPopCalendar(getById('endDate'));"/>
                    &nbsp;
                    {l s='stock'}
                  <input type="text" style="width:25px;" name="Amount" req vali="num" msg="{l s='Please Input Integer Type'}"/>
                    &nbsp;&nbsp;
                    {l s='Price'}:&nbsp;&nbsp;
                    {l s='All'}&nbsp;{l s='JPY'}<input type="text" style="width:40px;" name="Price" vali="double" msg="{l s='Please Input Double Type'}"/>
                    &nbsp;&nbsp;&nbsp;{l s='Asia'}&nbsp;{l s='JPY'}<input type="text" style="width:40px;" name="Asia" vali="double" msg="{l s='Please Input Double Type'}"/>
                    &nbsp;&nbsp;&nbsp;{l s='Euro'}&nbsp;{l s='JPY'}<input type="text" style="width:40px;" name="Euro" vali="double" msg="{l s='Please Input Double Type'}"/>         
                </div>
            </form></div>    
            <span style="color:#ff0000;font-size:11px;">	
            	{l s='※for price, “All” apply to All Nationality, Asia Apply to Asian Nationality, Euro Apply to All nationality except Asian.'} <br/>
				{l s='If All of price was filled,'} <br/>
                {l s='“Asian” and “Euro” will be applied.'}
            </span>
            <p style="color:#666; margin-top:20px; font-size:14px;margin-bottom:10px;font-weight:bold;">2. {l s='Calendar'}</p>
              <div class="all_border"><form name="calFrm" action="room_stock.php?hid={$hid}" method="post">
              	<input type="hidden" name="SubmitCal" value="1" />
              	<input type="hidden" name="RoomPlanId" value="{$pno}" />
                <div style="padding:5px;padding-top:20px;">
                	<div style="float:left;margin-left:40px;">
                	<input type="button" class="button white medium" value="{l s='Back'}" onclick="moveListMonth(-1);"/>
                    </div>
                    <div style="float:right">
                	<input type="button" class="button orange medium" value="{l s='Next'}" onclick="moveListMonth(1);"/>
                    </div>
                    <div style="margin:0px auto;text-align:center;">
                    <select style="width:120px;" onchange="changeYM(); return false;" id="ymselect">
                        {foreach from=$dateList item=item name=repin}
                            <option {if $item==$dateYm}selected="selected"{/if} value="{$item}">{$item}</option>
                        {/foreach}
                    </select>
                    </div>
                    <div class="clearfix" style="height:8px;"></div>
                   <!-- <div class="right">&nbsp;{l s='Price'}({l s='Euro'})</div><div class="map_green icon_box right"></div>
                    <div class="right">&nbsp;{l s='Price'}({l s='Asia'})&nbsp;&nbsp;&nbsp;</div><div class="map_yellow icon_box right"></div>
                    <div class="right">&nbsp;{l s='Price'}({l s='All'})&nbsp;&nbsp;&nbsp;</div><div class="map_red icon_box right"></div>
                    <div class="right">&nbsp;{l s='stock'}&nbsp;&nbsp;&nbsp;</div><div class="map_blue icon_box right"></div>
                  <div class="clearfix"></div>-->
                  <div class="calendar_box_lavel"> 
                  	<br/>   <div style="height:4px;"></div>
					{for $i=0 to 5}
                  	<br/> {l s='stock'}<br />{l s='All'}<br/>{l s='Asia'}<br/>{l s='Euro'}<br/><div style="height:1px;"></div>
					{/for}
                  </div>
                  <div class="calendar_box" style="float:right;width:735px;">
                    	<table width="100%">
                        	<tr>
                            	<th class="red">{l s='Sun'}</th>
                                <th>{l s='Mon'}</th>
                                <th>{l s='Tue'}</th>
                                <th>{l s='Wed'}</th>
                                <th>{l s='Thu'}</th>
                                <th>{l s='Fri'}</th>
                                <th class="blue" style="border-right:none;">{l s='Sat'}</th>                             
                            </tr>
						  {for $i=0 to 5}
							<tr>
							  {for $j=0 to 6}
                            	<td style="text-align: left"> 
                            		{if $list[$i*7+$j].isout==''} <input type="hidden" name="adate[]" value="{$list[$i*7+$j].ApplyDate}" /> {/if}
                                	<div class="{if $j==0} red {elseif $j==6} blue {/if} 
                                			txtcenter bold" >{$list[$i*7+$j].ApplyDate|substr:8}</div>
                                    <input type="text" name="amount[]" class="price_item map_blue"  style="border:none;width:55px;"
                                    	vali="num" msg="{l s='Please Input Integer Type'}" 
                                    	{if $list[$i*7+$j].isout=='true'} disabled {else} value="{displayPrice s=$list[$i*7+$j].Amount nomark=1}" {/if} />{l s='rooms'}
                                    <br/><input type="text" class="price_item map_red" readonly  value="{if $list[$i*7+$j].isout=='true'}{else}{l s='JPY'}{/if}" style="border:none;width:21px;"/><input type="text" name="price[]" class="price_item map_red"  style="border:none;width:55px;"
                                    	vali="double" msg="{l s='Please Input Double Type'}"
                                    	{if $list[$i*7+$j].isout=='true'} disabled {else} value="{if $list[$i*7+$j].Asia> 0 && $list[$i*7+$j].Euro>0}{else}{displayPrice s=$list[$i*7+$j].Price nomark=1}{/if}" {/if} />
                                    <br/><input type="text" class="price_item map_yellow" readonly  value="{if $list[$i*7+$j].isout=='true'}{else}{l s='JPY'}{/if}" style="border:none;width:21px;"/><input type="text" name="asia[]" class="price_item map_yellow" style="border:none;width:55px;"
                                    	vali="double" msg="{l s='Please Input Double Type'}"
                                    	{if $list[$i*7+$j].isout=='true'} disabled {else} value="{displayPrice s=$list[$i*7+$j].Asia nomark=1}" {/if} />
                                    <br/><input type="text" class="price_item map_green" readonly  value="{if $list[$i*7+$j].isout=='true'}{else}{l s='JPY'}{/if}" style="border:none;width:21px;"/><input type="text" name="euro[]" class="price_item map_green" style="border:none;width:55px;"
                                    	vali="double" msg="{l s='Please Input Double Type'}"
                                    	{if $list[$i*7+$j].isout=='true'} disabled {else} value="{displayPrice s=$list[$i*7+$j].Euro nomark=1}" {/if} />
                                </td>
							  {/for}
							</tr>
						  {/for} 
                        </table>
                    </div>
                    <div class="clearfix"></div>
                    <div class="right" style="margin:20px 0px"><input type="button" class="button orange medium" value="{l s='Save'}" onclick="calFrmSubmit();"/></div>
                    <div class="clearfix"></div>
                </div>
            </form></div>    
                                   
           </div>
            <!-- right content end -->
            <div class="clearfix"></div>
