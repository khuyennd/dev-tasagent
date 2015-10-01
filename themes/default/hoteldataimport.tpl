<!-- right content start -->
            <div class="left right_content_outer">
            
            	<!-- show succeed hotels -->
                <div class="orange_color bold">{l s='Import Hotels Backup Data'}</div>
                <div class="all_border" style="padding:10px;">
            	<div class="darkgray">{l s='Please select file'}</div>
            	
            	<form method="POST" action="{$base_dir}hoteldataimport.php?import" enctype="multipart/form-data" name="hotelimportform">
            	<input type="button" onclick="onSelectFile();" value="{l s='Select'}" class="button white medium"/>
            	<input type="text" id="filename" style="width:150px;height:18px;" readonly/>
            	<input type="file" id="hotelexcel" name="hotelexcel" style="display:none" onchange="onSelectedFile();" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
	            <input type="button" value="{l s='import'}" onclick="onImport();" class="button orange medium"/>
            	</form>
            	</div>
            {if $status == 1}
            	<!-- show succeed hotels -->
            	
            	<div class="orange_color bold" style="padding:20px 0px 0px 0px">{l s='Added hotels'}</div>
            	<table class="darkgray" style="margin-top:10px;">
            		<tr>
            			<th class="odd">{l s='No'}</th>
            			<th>{l s='Hotel Code'}</th>
            			<th class="odd">{l s='Hotel Name'}</th>
            		</tr>
            		{foreach from=$result item=item name=item}
					<tr>            		
            			<td class="odd">{$smarty.foreach.item.iteration}</td>
            			<td >{$item.code}</td>
            			<td class="odd">{$item.name}</td>
					</tr>            			
            		{/foreach}
            		{if $cnt == 0}
            			<td colspan='3' align="center"><h5>{l s='No hotel imported'}</h5></td>
            		{/if}
				</table>            		
            {/if}
            
            <br/><br/>
            {include file="$tpl_dir./common/errors.tpl"}
            </div>
            
            <!-- right content end -->
            <div class="clearfix"></div>
            
            <script language="javascript">
            	function onSelectFile(){
					$('#hotelexcel').click();
            	}

            	function onSelectedFile(){
                	$('#filename').val($('#hotelexcel').val());
            	}


            	function onImport(){
					if($('#hotelexcel').val() == ''){
						alert("{l s='Please select file to import.'}");
						return;
					}
					document.hotelimportform.submit();
            	}
            </script>