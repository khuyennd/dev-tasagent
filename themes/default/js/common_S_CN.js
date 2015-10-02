var wait_cnt = 0; 
function setWait(){
    var wait_obj = getById("waiting");
    if(wait_cnt==0){
        if (wait_obj == undefined){

            var win_width=0, win_height=0;
            win_width = document.body.clientWidth;
            win_height = document.body.clientHeight;

            var mwait_div = document.createElement("div");
            mwait_div.style.position = "absolute";
            
            //calculating width, height created by cnh            
            var winW = 630, winH = 460;
            if (document.body && document.body.offsetWidth) {
             winW = document.body.offsetWidth;
             winH = document.body.offsetHeight;
            }
            if (document.compatMode=='CSS1Compat' &&
                document.documentElement &&
                document.documentElement.offsetWidth ) {
             winW = document.documentElement.offsetWidth;
             winH = document.documentElement.offsetHeight;
            }
            if (window.innerWidth && window.innerHeight) {
             winW = window.innerWidth;
             winH = window.innerHeight;
            }
            win_width = winW;
            win_height = winH;
            mwait_div.style.width = winW+"px";//document.body.scrollWidth+"px";
            mwait_div.style.height = getDocHeight()+"px";//winH+"px";
            mwait_div.style.left = 0;
            mwait_div.style.border = 0;
            mwait_div.style.padding = 0;
            mwait_div.style.top = 0;            
            mwait_div.style.display="inline";            
            mwait_div.style.background = "rgb(233, 233, 233)";
            mwait_div.style.opacity = 0.3;
            mwait_div.style.filter='gray() alpha(opacity=25)';
            mwait_div.style.zIndex = "400";
            mwait_div.setAttribute("id","waiting");
            var div = document.createElement("div");
            div.style.position = "absolute";
            div.setAttribute("id","waiting_flash");
            var scrollY = document.documentElement.scrollTop; 
            div.style.left = win_width/2 + "px";
            div.style.top = scrollY + win_height/2 + "px";//win_height/2 + "px"; //document.body.scrollHeight/2 + "px"
            var img = document.createElement("img");
            img.src = img_dir + "refresh.gif";
            img.style.background = "transparent";
            img.style.opacity = 1;
            div.appendChild(img);
            mwait_div.appendChild(div);
            document.body.appendChild(mwait_div);        
        }else{
            $(wait_obj).show();
        }
    }
    wait_cnt++;
}

function unsetWait(){
    wait_cnt--;    
    if(wait_cnt==0){
        var wait_obj = getById("waiting");
        if (wait_obj != undefined){
            $(wait_obj).hide();
        }
    }
}

function getById(id, obj) {
	if (obj == undefined) obj= document;
	return obj.getElementById(id);
}

function getDocHeight() {
	var D = document;
	return Math.max(
	Math.max(D.body.scrollHeight, D.documentElement.scrollHeight),
	Math.max(D.body.offsetHeight, D.documentElement.offsetHeight),
	Math.max(D.body.clientHeight, D.documentElement.clientHeight)
	);
}
function setPage(page) {
	$('#p').val(page);
	searchFrm.submit();
}

function setRowNum() {
	$('#n').val($('#nb_item').val());
	document.searchFrm.submit();
}

//...

function get_todaystr(myformat, today, isZero){
	if (today==undefined) today =new Date();
	if (isZero == undefined) isZero=false;
	myformat=myformat.replace("Y", getYear(today));
	var mon = today.getMonth()+1;  if ((isZero) && (mon<10)) mon ="0"+mon;
	myformat=myformat.replace("m", mon);
	var dat = today.getDate();  if ((isZero) && (dat<10)) dat ="0"+dat;
	myformat=myformat.replace("d", dat);
	return myformat;
}	
function getYear(date){	
	var year = date.getYear();	
	return (year < 1900) ?  year + 1900:year; 
	

}

function openPopup(id, left, top){
    $('#my_maskLayer').show();
    if (left == undefined) left = $('#'+id).children('div:first-child').width();
    if (top == undefined) top = $('#'+id).height();

	if (left != undefined){
        $('#'+id).attr("style","position:fixed; top: 40%; left: 45%; margin-left:-"+left/2+"px;margin-top:-"+top/2+"px;");
	}
	//var orgZIndex = $('#my_maskLayer').css("z-index");	
	$('#'+id).css("z-index", 301 );
	$('#'+id).show();	
}

function closePopup(id){
	$('#'+id).hide();
	$('#'+id).css("z-index",0);
	$('#my_maskLayer').hide();
}

function encodeUri(url){
//	alert(url);
	var pos = url.indexOf("?");
	if (pos != -1){
		var paras = url.substring(pos+1).split("&");
		
		url = url.substring(0, pos)+"?";
		for (i=0; i<paras.length; i++){
			var vals = paras[i].split('=');
			url += "&"+vals[0]+"=";
			if (vals.length>1){
				url += encodeURIComponent(vals[1]); 
			}
		}		
//		alert(url);
	}
	return url;
}

function ajaxLoad(divId, url, successJsCode, waitflag){
	url = encodeUri(url);
	if (waitflag==undefined) setWait();
	$("#"+divId).load(url,  function(){	if (waitflag==undefined)  unsetWait();
		if (successJsCode != undefined)
			eval(successJsCode);
	});
}

function time_cmp(staDate,staTime,endDate,endTime, alertMsg)
{
	if (trim(staDate) == "" || trim(endDate)=="") return true;
	var _lstDate = staDate.split("-");
	var _y = _lstDate[0];
	var _m = _lstDate[1];
	var _d = _lstDate[2];
	var stadate = new Date(_y+"/"+_m+"/"+_d+" " + staTime);
	
	_lstDate = endDate.split("-");
	_y = _lstDate[0];
	_m = _lstDate[1];
	_d = _lstDate[2];
	var enddate = new Date(_y+"/"+_m+"/"+_d+" " + endTime);
	
	if(stadate <= enddate)
		return true;
	else{
		if (alertMsg != undefined){
			if (alertMsg==0) alertMsg = "结束时间必须大于开始时间。";
			alert(alertMsg);
		}
		return false;
	}
}
function trim(str){
	return str.replace(/^\s+|\s+$/g,"");
}

function getFormData(formObj, isNotZero){
	if (isNotZero == undefined) isNotZero=false;
	var child = formObj.elements;
	var data = new Array();
	
	for(i = 0; i < child.length;i++) {

		//
		if(child[i].tagName != "INPUT" && child[i].tagName != "TEXTAREA" && child[i].tagName != "SELECT") continue;
		//button ignore
		if(child[i].type == "submit" || child[i].type == "button" || child[i].type == "reset") continue;
		//CHECK, RADIO 
		if((child[i].type == "radio" || child[i].type == "checkbox") && !child[i].checked) continue;
		
		if(child[i].name.charAt(0) == "_")  continue;
		
		
		if(child[i].type != "hidden" && $(child[i]).is(":visible")==false ) continue;
		
		if(child[i].getAttributeNode("req") && (!child[i].value || (isNotZero && (child[i].value==0))) ) {
			child[i].style.backgroundColor = "#FF9";
			child[i].style.color = "#000";
			if(child[i].type!='hidden')	child[i].focus();
			alertMsg = (child[i].getAttributeNode("msg")) ? child[i].getAttributeNode("msg").value : "这个字段必须输入。"; 
			alert(alertMsg);
			return false;
		}else if(child[i].getAttributeNode("vali")){
			checkVal = child[i].getAttributeNode("vali").value;			
			if (objvalid_check(child[i], "", checkVal)== false) return false;
		} 
		
		var res = child[i].value;
		if(child[i].getAttributeNode("encuri"))
			res = encodeURIComponent(res);
		
	   	data.push ( child[i].name+"="+res);
	}
	return data.join("&");
}

//... 
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.blur() ;	
		limitField.value = limitField.value.substring(0, limitNum);
		limitField.focus() ;
		
		alert("超过了可以输入的最大字数。");
	} else {
		$(limitCount).html(limitField.value.length); /*limitNum -*/
	}
}
///... 
function objvalid_check(obj, msg, checkVal, maxLen, isallowempty){
			
	var val = obj.value;
	val = val.replace(/^\s+|\s+$/g,"");
	///...
	if (isallowempty == undefined) isallowempty = true;
	if (isallowempty == true)
		if (val=="") return true;


	if (checkVal == "0"){
		if ( CheckNumber(val) == false){
			ctr_style(obj);
			alert("请输入数字。"); return false;
		}
	}
//	if (checkVal != '0') 				
	if ( (val=="") || (val == checkVal) ){
		ctr_style(obj); alert(msg); return false;
	}
	switch(checkVal){
		case "num":
			if (CheckNumber(val)==false) {ctr_style(obj);alert("请输入数字。"); return false;}
			break;
		case "email":
			if (checkEMail(val)==false) {ctr_style(obj);alert("请输入正确的邮件地址。"); return false;}
			break;
		case "url":
			if (checkUrl(val)==false) {ctr_style(obj);alert("请输入正确的网站地址。"); return false;}
			if (val.indexOf("://")==-1) obj.value = "http://" + val;
			break;
		case "phone":
			if (CheckNumber(val, "phone")==false) {ctr_style(obj);alert("请输入正确的电话号码。"); return false;}
			break;
		case "date":
			if (CheckNumber(val, "phone")==false) {ctr_style(obj);alert("请输入正确的日期类型。"); return false;}
			break;
		case "double":
			if (CheckNumber(val, "double")==false) {ctr_style(obj);alert("Please Input Double Type."); return false;}
			break;
		default:
			break;
	}	
	if ( maxLen != 0 && val.length > maxLen ){
		var alertMsg = /*((msg==undefined)||(msg=="") )? */"最大字数是"+maxLen+"。";
//			:	msg;
		obj.focus();alert(alertMsg); return false;
	}  	
	return true;
}
	   	
	   	
function ctr_style (obj, noclear) {
	/// ??? ?? ????? ???.
	var balid_color = "#E2F5FC";
	if (noclear == undefined || noclear!=true )
			obj.value = '';
	if (obj.type != "hidden"){
		obj.focus();
		obj.style.background = balid_color;
	}
/*
	obj.style.borderBottom="1px solid white";
	obj.style.borderLeft="1px solid black";
	obj.style.borderTop="1px solid black";
	obj.style.borderright="1px solid white";
*/
}

function CheckChar(str) { 
	  var error_c=0, i, val; 
	  for(i=0; i <str.length; i++){
	  	val = str.charAt(i); 
	    if(!((val>=0 && val<=9) || (val>='a' && val<='z') || (val>='A' && val<='Z'))) return false; 
	  } 
	  return true; 
}

function CheckCharEng(str) { 
	  var error_c=0, i, val; 
	  for(i=0; i <str.length; i++){
	  	val = str.charAt(i); 
	    if(!((val>=0 && val<=9) || (val>='a' && val<='z') || (val>='A' && val<='Z'))) return false; 
	  } 
	  return true; 
}
function CheckCharKor(str) { 
	  var error_c=0, i, val; 
	  for(i=0; i <str.length; i++){
	  	val = str.charAt(i); 
	    if(!((val>=0 && val<=9) || !((val>='a' && val<='z') || (val>='A' && val<='Z')))) return false; 
	  } 
	  return true; 
}

function CheckNumber(str, otherType, isallowempty) {
	if (isallowempty == 1 && str=="") return false;
	
	var cmpCha = '0'; var cmpCha1='';
	//if (str == cmpCha) return false;
	if (otherType != undefined){
		if (otherType == "phone"){ cmpCha="-"; cmpCha1 = "+"; }
		if (otherType == "double") {cmpCha="."; cmpCha1 = ","; }
		if (otherType == "minus") {cmpCha="."; cmpCha1="-";}
	}
	
	  var error_c=0, i, val; 
	  for(i=0; i <str.length; i++){
		  	val = str.charAt(i);
		    if( val != cmpCha1 && val != cmpCha && (val < '0' || val>'9')) {
		    	return false; 
		    }
	  } 
	  return true; 
}
//???????
function checkEMail (data)
{
	data = data.replace ( " ", "" );

	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

	if (filter.test(data)) {
		return true;
	} else {
		return false;
	}
}

function checkUrl(url, isHTTP){
	if (isEmpty(isHTTP))	isHTTP=false;
    var RegExp = /^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/;
    if(RegExp.test(url)){
        return true;
    }else{
        return false;
    }
}
/* AreaSelect function
 *
 * @param cityId default select cityId
 *
 * @author kgh
 * @created
 * @modified 2012-11-07 add param cityId for default select city id. @zotiger
 *
 */
function OnSelectArea(cityId) {
	setWait();
	$.ajax({
		type : "post",
		datatype : "text",
		data : {
			cityid : $('#selarea').val()
		}, 
		url : "hoteldetail.php?getcity",
		success : function(data, code){
			unsetWait();
			document.getElementById('selcity').options.length = 1;
			
			if (data == '')
				return;
			
			var cityList = data.split("|");
			for (i=0; i<cityList.length;i++) {
				var city = cityList[i].split(",");
				var optionStr = "<option value='" + city[0] + "'>" + city[1] + "</option>";
				$('#selcity').append("<option value='" + city[0] + "'>" + city[1] + "(" + city[2] + ")</option>");
			}
			
			$('#selcity option[value='+ cityId + ']').prop('selected', true);
		}
	}); 
	return false;
}


/* zero padding function
 *
 * padding one zero for 10 based string format.
 *
 * 	zeroPad(9, 10) returns 09
 * 	zeroPad(100, 10) returns 100 (same val)
 *
 * @author zotiger
 */
function zeroPad(val, base)
{
	if (val < base)
		return '0' + val;
	else
		return val;
}
/* dateAddDays function
 * 
 * add day to date string and return that date string value.
 * for example, dateAddDays('2012-11-07', 1) returns '2012-11-08' string value
 *
 * @author zotiger
 * @created 2012-11-07
 */
function dateAddDays(dateStr, nDays)
{
	var dateTmp = dateStr/*.split('-').reverse().join('/')*/, newDate = new Date(dateTmp);
	newDate = new Date(newDate.getTime() + nDays * 24 * 60 * 60 * 1000);
//	newDate.setDate(newDate.getDate() + nDays || 1);
	return [newDate.getFullYear(), zeroPad(newDate.getMonth() + 1, 10), zeroPad(newDate.getDate(), 10)].join('-');
}

/* OnChangeStartDate function
 *
 * in search by term(start date to end date), user can select duration.
 * then end date value will be changed automatically.
 *
 * @param string startDateInput start date input id value
 * @param string endDateInput end date input control id value
 * @param string durationInput duration select control id value
 * @param int isDiff the start date option. start day will be 5 + today day if this value is 1, otherwise start day will be today
 *
 * @author zotiger
 * @created 2012-11-07
 * @modified 2012-11-18 issue #1124
 */
function OnChangeStartDate(startDateInput, endDateInput, durationInput, isDiff)
{
    var startDelta = 0;
    if (isDiff == 1)
    {
        startDelta = 5;
    }

    if ($('#' + startDateInput).val() == '')
        return;
	var startDate = new Date($('#' + startDateInput).val());
    
	if ((startDate.getTime() - new Date().getTime()) < (startDelta - 1) * (24 * 60 * 60 * 1000))
	{
        if (isDiff == 1)
        {
            alert('请选择五天后的日期。');
        }
        else
        {
            alert('请选择正确的日期。');
        }
	
		newDate = new Date();
        var nowDateStr = [newDate.getFullYear(), zeroPad(newDate.getMonth() + 1, 10), zeroPad(newDate.getDate(), 10)].join('-');
		$('#' + startDateInput).val(dateAddDays(nowDateStr, startDelta));
		
//		return false;
	}
	
	$('#' + endDateInput).val(dateAddDays($('#' + startDateInput).val(), $('#' + durationInput + ' option:selected').val()));
}

function OnChangeEndDate(startDateInput, endDateInput, durationInput, isDiff)
{
	var startDate = new Date($('#' + startDateInput).val());
	var endDate = new Date($('#' + endDateInput).val());
	var diff_date = (endDate.getTime() - startDate.getTime()) / (24 * 60 * 60 * 1000);
	if (diff_date <= 0)
	{
		alert('请确认入住日。');
		// restore value
		OnChangeStartDate(startDateInput, endDateInput, durationInput);
		return false;
	}
	
	if (diff_date > 30)
	{
		alert('退房日请选择在30天以内。');
		// restore value
		OnChangeStartDate(startDateInput, endDateInput, durationInput);
		return false;
	}
	
	$('#' + durationInput).val(diff_date).prop('selected', true);
	// $('#' + endDateInput).val(dateAddDays($('#' + startDateInput).val(), $('#' + durationInput + ' option:selected').val()));
}

// from url: http://stackoverflow.com/questions/149055/how-can-i-format-numbers-as-money-in-javascript
function formatDollar(num) {
    var p = num.toFixed(2).split(".");
    return "￥ " + p[0].split("").reverse().reduce(function(acc, num, i, orig) {
        return  num + (i && !(i % 3) ? "," : "") + acc;
    }, "") /*+ "." + p[1]*/;
}

// from url: http://stackoverflow.com/questions/4068373/center-a-popup-window-on-screen
function popupwindow(url, title, w, h) {
  var left = (screen.width/2)-(w/2);
  var top = (screen.height/2)-(h/2);
  return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
} 


function onclick_roomplan_view(rpid)
{
	$("#popup_content_roomplan").load('roomplan_summary.php?rpid=' + rpid);
	openPopup('popup_roomplan', 500, 170);
	
	return false;
}

function onclick_roomplan_view_with_price(rpid, price)
{
    $("#popup_content_roomplan").load('roomplan_summary.php?rpid=' + rpid + '&price=' + price);
    openPopup('popup_roomplan', 500, 170);

    return false;
}

function onclick_roomplan_sales(rpid)
{
	// alert('roomplan sales ' + rpid);
	$("#popup_content_sale").load('roomplan_sales.php?rpid=' + rpid);
	openPopup('popup_sale', 500, 170);
	return false;
}

function showWaiting()
{

	$.blockUI({ css: { 
        border: 'none', 
        padding: '15px', 
        backgroundColor: '#000', 
        '-webkit-border-radius': '10px', 
        '-moz-border-radius': '10px', 
        opacity: .9, 
        color: '#fff' 
    } }); 
}
function closeWaiting()
{
	$.unblockUI();
}

// http://stackoverflow.com/questions/4169160/javascript-ie-detection-why-not-use-simple-conditional-comments
function checkIE()
{
	var isIE = /*@cc_on!@*/false;
	return isIE;
}

function onAreaReset()
{
	// alert('reset');
	document.getElementById('selcity').options.length = 1;
	$('#selarea').val(0);
	$('#selcity').val(0);
	$('#CheckIn').val('');
	$('#CheckOut').val('');
    $('#div_room_type select').val(0);
    $('#HotelClassId').val(0);
	return false;
}

function onBookingReset() 
{
	$('#BookingNo').val('');
	$('#HotelName').val('');
	$('#CheckInDate').val('');
	if ($('#CheckOutDate')) $('#CheckOutDate').val('');
	if ($('#DueDate')) $('#DueDate').val('');
	if ($('#ManagingDirector')) $('#ManagingDirector').val('');
	if ($('#CompanyName')) $('#CompanyName').val('');
	$('#PayStatus').val('');
}
// from http://stackoverflow.com/questions/46155/validate-email-address-in-javascript
function validate_email(email)
{
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function validate_tel(tel)
{
    var re = /^[\+]*[0-9\-]+$/;
    return re.test(tel);
    // return CheckNumber(tel);
}

function validate_url(url){
    return checkUrl(url);
}