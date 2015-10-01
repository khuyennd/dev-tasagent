<!-- right content start -->
            <div class="left right_content_outer">
            	<!-- booking list search conditon start -->
            	<form name="searchFrm" method="post" action="promotionlist.php">    
				<input type="hidden" id="p" name="p" value="{$p}" />
				<input type="hidden" id="n" name="n" value="{$n}" />
				<input type="hidden" id="type" name="type" value="{$smarty.request.type}" />
                
                </form>
                <div class="clearfix"></div>
                <!-- booking list search conditon end -->
                   
                <!-- booking list search result start -->
                <div class="bklist_srch_result">
                	<form id="wfs" name="wfs" method="post">
                	<table class="darkgray">
                    	<thead>
                        	<tr>
                        		{if $cookie->RoleID > 3}
                        			<th class="odd txtcenter"></th>
                        		{else}
                        			<th class="odd txtcenter">{l s='No'}</th>
                        		{/if}
                                <th>{l s='Hotel Name'}</th>
                                <th class="odd">{l s='Area'}</th>
                                <th>{l s='Title'}</th>
                                <th class="odd">{l s='Effective Period'}</th>
								<th class="odd">{l s='Create Date'}</th>
                                {if $cookie->RoleID > 3}
                                	<th></th>
                                {/if}
                            </tr>
                        </thead>
                    	<tbody>
                    	{foreach from=$listData item=item name=item}
                        	<tr>
                        		{if $cookie->RoleID > 3}
                        			<td class="odd txtcenter"><input type="checkbox" class="check" value="{$item.PromotionId}" name="idlist[]"/></td>
                        		{else}
                        			<td class="odd txtcenter">{($p-1)*$n+$item@index + 1}</td>
                        		{/if}
                                <td class="">{$item.HotelName}</td>
                                <td class="odd">{$item.AreaName}</td>
                                <td class=""><a href="{$base_dir}promotiondetail.php?PromotionId={$item.PromotionId}">{$item.Title}</a></td>
                                <td class="odd">{$item.StaDate} ~ {$item.EndDate}</td>
                                <td class="">{$item.CreateDate}</td>
                                {if $cookie->RoleID >3}
	                                <td class="odd" style="text-align:center">
	                                	<input type="button" value="{l s='Edit'}" onclick="onEditPromotion({$item.PromotionId});" class="button white small">
	                                </td>
                                {/if}
                            </tr>
                        {/foreach}
                        
                        {if $nb_products==0} 
                        	<tr><td colspan="7" style="text-align: center">{l s='There is no data'}</td></tr> 
                       	{/if}
                       	
                        </tbody>
                    </table>
                    </form>
                </div>
                <!-- booking list search result end -->
                
                <!-- page control start -->
                {include file="$tpl_dir./common/pagination.tpl"}
                <div class="clearfix"></div>
                <!-- page control end -->
                
                <div class="control_bar">
                	{if $cookie->RoleID > 3}
                		<input type="button" value="{l s='New'}" onclick="onNewPromotion();" class="button orange medium"/>
                		<input type="button" value="{l s='Delete'}" id="btnDelete" class="button white medium"/>
                	{/if}
                </div>
                <br /><br />
            </div>
            <!-- right content end -->
            <div class="clearfix"></div>
            
            <!-- promotion edit popup -->
            <!--popup_win start -->
            {if $cookie->RoleID > 3}
						<div class="popup_win_frame" style="display:none" id="promotionedit_popup">
						<div class="popup_win_view" style="width: 700px;">
							<div class="title">
						    	<div class="close_btn" onclick="closePopup('promotionedit_popup');"></div>
						    	{if $smarty.request.type==0}
						        	{l s='Promotion Detail'}
						        {else}
						        	{l s='Event Detail'}
						        {/if}
						    </div>
							<div class="edit_view">
							<form name="regForm" id="regForm">
								<input type="hidden" name="Type" value="{$smarty.request.type}"/>
								<input type="hidden" name="PromotionId" value="0"/>
								<table class="yellow">
							    	<tr>
							        	<th>{l s='Hotel Name'}</th>
							            <td><input type="text" style="width:80%;" name="HotelName"/></td>
							        </tr>
							        <tr>    
							            <th>{l s='Area'}</th>
							            <td>
							            	<select style="width:80%" name="AreaId" id="AreaId">
							            	{foreach $areaList as $area}
							                	<option value='{$area.AreaId}'>{$area.AreaName}</option>
							                {/foreach}
							                </select>
							            </td>            
							        </tr>
							        <tr>
							        	<th>{l s='Effective Period'}</th>
							            <td>
							            	<input type="text" value="" name="StaDate" id="StaDate" class="calendar_text"/>
							                <img src="{$img_dir}calendar_icon.jpg" class="calendar_icon2" onclick="if(self.gfPop)gfPop.fPopCalendar(getById('StaDate'));"/> ~
											<input type="text" value="" name="EndDate" id="EndDate" class="calendar_text"/>
							                <img src="{$img_dir}calendar_icon.jpg" class="calendar_icon2" onclick="if(self.gfPop)gfPop.fPopCalendar(getById('EndDate'));"/>
							            </td>
							        </tr>
							        <tr>
							        	<th>{l s='Title'}</th>
							            <td><input type="text" style="width:80%;" name="Title"/></td>
							        </tr>
							        
							        <tr>
							        	<th>{l s='Content'}</th>
							            <td><div id='Content' name='Content' style="width:100%;height:100px;"></div></td>
							        </tr>
							    </table>
						    </form>
						    
						    </div>
						    <div class="popup_control_bar">
						    	<input type="button" class="button orange medium" value="{l s='Save'}" onclick="savePromotion();"/>
						        <input type="button" class="button white medium" value="{l s='Close'}" onclick="closePopup('promotionedit_popup')"/>
						    </div>
						</div>
						</div>
						
						<!--popup_win end -->
			{/if}

 <script type="text/javascript">
 $(function(){
	 // Delete
	 $("#btnDelete").click(function(){
		// No Selected
		if($(".check:checked").length == 0) return false;
		
		if(confirm("{l s='Are you confirm to delete?'}")){
			setWait();
			$.ajax({
				type : "post",
				datatype : "text",
				data : $("#wfs").serialize(),
				url : "{$base_dir}promotionlist.php?delete",
				success : function(data, code){
					unsetWait();
					searchFrm.submit();
				}
			}); 
		} 
	 });
 });

 //load CKEditor
 
 var ckeditor = CKEDITOR.replace('Content',
		 {literal}{{/literal}
			      resize_enabled:false,
	 	  toolbar:[['Format'],['FontSize'], 
	 		 	  ['Bold','Italic','Underline','Strike', 'File', 'Image','-','Subscript','Superscript'], 
	 		 	  ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl']],
	 	  filebrowserImageUploadUrl : "{$base_dir}promotionlist.php?uploadimage"
	 	 {literal}}{/literal});
 //
 function onNewPromotion(){
	clearRegPromotionForm();
	openPopup('promotionedit_popup');
 }

 function onEditPromotion(PromotionId){
	 	setWait();
	 	$.ajax({
				type:'post',
				datatype :'text',
				data : "PromotionId="+PromotionId,
				url : "{$base_dir}promotionlist.php?getdetail",
				success: function(data,code){
					unsetWait();
					//alert(data);
					var obj = $.parseJSON(data);
					$.each(obj, function(key, val) {
						if(key!='Content' && key!='AreaId')
					    	$("#regForm input[name=" + key + "]").val(val);
					});
					
					//AreaId , Content set
					CKEDITOR.instances.Content.setData(decodeURIComponent(obj.Content));
					$("#AreaId").val(obj.AreaId);
					
					openPopup('promotionedit_popup');
				}
 		   });
 }
 
 function savePromotion(){
	setWait();
	var frm = document.regForm;

	var cont = encodeURIComponent(CKEDITOR.instances.Content.getData());
	$.ajax({
		type : "post",
		datatype : "text",
		{literal}
		data: {
			   Type : frm.Type.value,
			   PromotionId:frm.PromotionId.value,
			   HotelName:frm.HotelName.value, 
			   AreaId:frm.AreaId.value,
			   Title:frm.Title.value,
			   StaDate:frm.StaDate.value,
			   EndDate:frm.EndDate.value,
			   Content:cont
			   },
	    {/literal}
	   success : function(data, code){
		   unsetWait();
		   data = data.replace(/^\s+|\s+$/g,'')
		   if(data == 'true'){
		   	 	alert("{l s='Operation succeed!'}");
		   	    closePopup('promotionedit_popup');
		   	 	document.searchFrm.submit();
		   }
		   else
			   alert(data);
	   },
	   url : "{$base_dir}promotionlist.php?add"
	});
 }
 
 function clearRegPromotionForm(){
	document.regForm.PromotionId.value = '0';
	document.regForm.HotelName.value = '';
	document.regForm.Title.value = '';
	CKEDITOR.instances.Content.setData('');
 }

 </script>
