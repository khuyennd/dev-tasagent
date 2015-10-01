            <!-- right content start -->
            <div class="left right_content_outer">
            	<!-- booking list search conditon start -->
            	<form name="searchFrm" method="post" action="featuremanage.php">    
				<input type="hidden" id="p" name="p" value="{$p}" />
				<input type="hidden" id="n" name="n" value="{$n}" />
                <div class="bklist_srch_con">
                	<table cellpadding="0" cellspacing="0">
                    	<tbody>
                            <tr>
                            	<td class="bklist_srch_td">{l s='Keyword'}</td>
                                <td>
                                	<input type="text" name="FeatureName" value="{if isset($smarty.post.FeatureName)}{$smarty.post.FeatureName}{/if}"/>
                                </td>
                                <td class="bklist_srch_td">{l s='Type'}</td>
                                <td>
                                	<select name="FeatureType" >
                                		<option value="">{l s='All'}</option>
				               		{foreach from=$featureList key=k item=feature}
				                		<option value="{$k}" {if isset($smarty.post.FeatureType) && $smarty.post.FeatureType == $k}selected{/if}>{l s="$feature"}</option>
				                	{/foreach}    
				                	</select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="bklist_srch_btn">
                    <input type="button"  class="button orange medium" alt="search now" value="{l s='Search Now'}" onclick="searchFrm.submit(); return false;" />
                </div>
                </form>
                <div class="clearfix"></div>
                <!-- booking list search conditon end -->
                   
                <!-- booking list search result start -->
                <div class="">
                	<form id="wfs" name="wfs" method="post">
                	<table class="darkgray">
                    	<thead>
                        	<tr>
                        		<th class="odd"></th> 
                                <th>{l s='Type'}</th>
                                <th class="odd">{l s='Features'}</th>
                                <th>{l s='Record Date'}</th>
                                <th class="odd"></th>
                            </tr>
                        </thead>
                    	<tbody>
                    	{foreach from=$listData item=item name=item}
                        	<tr>
                        		<td class="odd"><input type="checkbox" class="check" value="{$item.FeatureId}" name="idlist[]"/></td>
                                <td class="">{l s="{$featureList[$item.FeatureType]}"}</td>
                                <td class="odd">{$item.FeatureName}</td>
                                <td>{$item.CreateDate}</td>
                                <td class="odd" style="text-align:center">
                                	<input type="button" value="{l s='Edit'}" onclick="EditPopup('{$item.FeatureId}', '{$item.FeatureType}', '{$item.FeatureName}'); return false;" class="button white small"/>
                                </td>
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
                
                <div>
                <div class="btns_bar">
                	<input type="button" value="{l s='New'}" onclick="NewPopup(); return false;" class="button orange medium"/>
                	<input type="button" value="{l s='Delete'}" id="btnDelete" class="button white medium" />
                </div>
                </div>
                
                <br /><br />
            </div>
            <!-- right content end -->
            <div class="clearfix"></div>
   
<!--popup_win start -->
<div class="popup_win_frame" id="meminfo_popup" style="display:none; ">
<div class="popup_win_view" style="width:300px;">
	<div class="title">
    	<div class="close_btn"  onclick="closePopup('meminfo_popup'); return false;"></div>
        {l s='Features Information Edit'}
    </div>
	<div class="edit_view" style="border-bottom:1px solid #f2f2f2;" >
	<table class="no_border" style="margin:0" >
    	<tr>
                <th style="text-align:right;">{l s='Type'}: </th>
                <td>
               		<select id="mem_type">
               		{foreach from=$featureList key=k item=feature}
                		<option value="{$k}">{l s="$feature"}</option>
                	{/foreach}    
                	</select>
                </td>
            </tr>
            <tr>
            	<th style="text-align:right;">{l s='Features'}: </th>
                <td>
                	<input id="mem_name"></input>
                </td>
            </tr>
    </table>
    
    </div>
    <div class="popup_control_bar">
	<input type="hidden" id="mem_idx" />
    	<input type="button" class="button orange" value="{l s='Save'}" onclick="saveMember(); return false;"/>
        <input type="button" class="button white" value="{l s='Cancel'}" onclick="closePopup('meminfo_popup'); return false;"/>
    </div>
</div>
</div>
<!--popup_win end -->    
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
				url : "{$base_dir}featuremanage.php?delete",
				success : function(data, code){
					unsetWait();
					searchFrm.submit();
				}
			}); 
		} 
	 });
 });
 
 function EditPopup(idx, type, name) {
	 $("#mem_idx").val(idx);
	 $("#mem_name").val(name);
	 $("#mem_type").val(type);
	 openPopup('meminfo_popup');
 }
 function NewPopup() {
	 $("#mem_idx").val(0);
	 $("#mem_name").val("");
	 $("#mem_type").val("");
	 openPopup('meminfo_popup'); 
 }
 function saveMember() {
     
     if ($("#mem_name").val() == ""){
         alert("{l s='Please input the features'}");
         $("#mem_username").focus();
         return false;
     }
     setWait();
     $.ajax({
         type : 'post',
         datatype : 'text',
         data : { 
             	 idx : $("#mem_idx").val(),
                 name : $("#mem_name").val(),
                 type : $("#mem_type").val(),
                 },
         url : "{$base_dir}featuremanage.php?submit",
         success : function(data, code){
             unsetWait();
             if (data == 'success'){
                 closePopup('meminfo_popup');
                 searchFrm.submit();
             }else{
                 alert(data);
             }
             return false;
         }
     });
     return false;
 }
 </script>