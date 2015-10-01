<?php
	error_reporting(0);

	date_default_timezone_set('Asia/Tokyo');	
	$current = date('H');
	//if($current > 1) exit ;
	
	$text = date('Y-m-d H:i:s')." update order status\n";
	$log = 'cron.log';
			
	
	if(!file_exists($log)) {
		$handle = @fopen($log, 'x');	
		fwrite($handle, $text);
	} else {
		$tlog = filemtime($log);
		//if(time() - $tlog < 60 * 60) exit;
		
		$handle = fopen($log, 'a');	
		fwrite($handle, $text);
	}
	$db_info = array();
	$db_info['host']     = 'localhost';
	$db_info['name']     = 'hotel';
	$db_info['user']     = 'dev';
	$db_info['password'] = '1qaz2wsx';
	
	$link = @mysql_connect($db_info['host'], $db_info['user'], $db_info['password']);
	mysql_query("set charset utf8", $link);

	if(!$link) {
		$log = "can't open database\n";
		fwrite($handle, $log);
		exit ;
	} else {
		$log = "already open database\n";
		fwrite($handle, $log);
	}
	
	mysql_select_db($db_info['name'], $link);
	
	$date = date('Y-m-d 00:10:00');
	
	//发送Fully Booking 邮件
	$where = "where OrderStatusId=2 and PayStatus=1 and DATE_SUB(CheckInDate,INTERVAL 3 DAY) <= '$date'";
	mailto ( 5, $where, $link );

	$sql = "update HT_Order set OrderStatusId=5, Last_time=now() where OrderStatusId=2 and PayStatus=1 and DATE_SUB(CheckInDate,INTERVAL 3 DAY) <= '$date'";
	mysql_query($sql, $link);
	fwrite($handle, $sql."\n");
	
	//发送Expire邮件
	$where = "where OrderStatusId=9 and paymentMethod=0 and DATE_ADD(Last_time, INTERVAL 1 DAY) <= '$date'";
	mailto ( 8, $where, $link );

	$sql = "update HT_Order set OrderStatusId=8, Last_time=now() where OrderStatusId=9 and paymentMethod=0 and DATE_ADD(Last_time, INTERVAL 1 DAY) <= '$date'";
	mysql_query($sql, $link);
	fwrite($handle, $sql."\n");
	
	//发送Expire邮件
	$where = "where OrderStatusId=3 and PayStatus=1 and DATE_SUB(CheckInDate,INTERVAL 3 DAY) <= '$date'";
	mailto ( 8, $where, $link );
	
	$sql = "update HT_Order set OrderStatusId=8, Last_time=now() where OrderStatusId=3 and PayStatus=1 and DATE_SUB(CheckInDate,INTERVAL 3 DAY) <= '$date'";
	mysql_query($sql, $link);
	fwrite($handle, $sql."\n");
	
	//发送取消邮件
	$where = "where OrderStatusId=8 and DATE_ADD(Last_time, INTERVAL 1 DAY) <= '$date'";
	mailto ( 7, $where, $link );
	emailHotel ( 7, $where, $link );
		
	$sql = "update HT_Order set OrderStatusId=7, Last_time=now() where OrderStatusId=8 and DATE_ADD(Last_time, INTERVAL 1 DAY) <= '$date'";
	mysql_query($sql, $link);
	fwrite($handle, $sql."\n");
	
	fwrite($handle, "end \n");
	
	mysql_close($link);
	fclose($handle);

function emailHotel($orderstatus, $where, $link) {
	
	$sql = "select OrderId, BookingNo, OrderUserId, HotelId, 
				ContactName, ContactPhoneNumber, ContactEmail, 
				CheckInDate, CheckOutDate, paymentMethod from HT_Order ";
	$sql .= $where;
	
	$results = mysql_query ( $sql, $link );
	while ( $bookingInfo = mysql_fetch_assoc ( $results ) ) {
	   	//1.获取订单信息
	   	$orderid = $bookingInfo['OrderId'];
		$BookingNo = $bookingInfo['BookingNo'];	//订单编号
		
		$ContactName = $bookingInfo['ContactName'];	//1.Customer Information
		$ContactEmail = $bookingInfo['ContactEmail'];
		$ContactTel = $bookingInfo['ContactPhoneNumber'];
	   	$CheckIn = $bookingInfo['CheckInDate'];
	   	$CheckOut = $bookingInfo['CheckOutDate'];
	   	
	   	//2.获取下订单的用户信息
	   	$userid = $bookingInfo['OrderUserId'];
	   	//获取User信息
		$sql = "select U.`Name`, U.`Email`, U.`Tel`, U.`CompanyID`, U.`LanguageID`, L.`LanguageShortName`, U.`RoleID`, C.`CompanyName`  
						from `HT_User` as U, HT_Company as C, HT_Language as L  
						where U.`CompanyID` = C.`CompanyId` 
						and U.`LanguageID` = L.`LanguageId` 
						and U.`UserID` = '$userid'";
		$res = mysql_query ( $sql, $link );
		$userinfo = mysql_fetch_assoc ( $res );
	   	
	   	$AgentName = $userinfo['Name'];
	   	$AgentPhoneNo = $userinfo['Tel'];
	   	$AgentEmail = $userinfo['Email'];
	   	
	   	//3.获取酒店用户信息
	   	$hotelid = $bookingInfo['HotelId'];
	   	$sql = "select U.`Name`, U.`Email`, U.`Tel`, U.`LanguageID`, L.`LanguageShortName`, U.`RoleID`
					from `HT_User` as U, HT_Language as L 
					where U.`LanguageID` = L.`LanguageId` 
					and U.`HotelId` = '$hotelid'";
		$res = mysql_query ( $sql, $link );
		$hoteluserinfo = mysql_fetch_assoc ( $res );
		
	   	$UserName = $hoteluserinfo['Name'];
	   	$to = $hoteluserinfo['Email'];
	   	
		$languageid = $hoteluserinfo['LanguageID'];   
		$iso = $hoteluserinfo['LanguageShortName'];
		
		//4.获取酒店信息
		$sql = "select HotelName_{$iso} as HotelName, HotelAddress, HotelContactNo from HT_Hotel where HotelId = '{$hotelid}'";
		$res = mysql_query ( $sql, $link );
		$hotelinfo = mysql_fetch_assoc ( $res );
		
		$HotelName = $hotelinfo['HotelName'];
		$HotelAddress = $hotelinfo['HotelAddress'];
		$HotelContactNo = $hotelinfo['HotelContactNo'];
		
		
		//5.获取OrderRoom信息
		$sql = "select O.`OrderRoomId`, O.`OrderId`,  
					O.`RoomPlanId`, R.`RoomPlanName_".$iso."` as RoomPlanName, 
					R.`RoomTypeId`, T.`RoomTypeName`,  
					R.`Breakfast`, R.`Dinner`,  
					O.`SpecialRequestNoSmoking`, O.`SpecialRequestSmoking`, O.`SpecialRequestAdjoin`, O.`SpecialRequestRemark` 
				from HT_OrderRoom as O, HT_RoomPlan as R, HT_RoomType as T 
				where O.`RoomPlanId` = R.`RoomPlanId` 
				and R.`RoomTypeId` = T.`RoomTypeId`  
				and O.`OrderId` = '{$orderid}'";
		$result = mysql_query ( $sql, $link );

		$RoomList = '';
		$id = 1;
		while($roomplan = mysql_fetch_assoc($result)) {
			$roomplanid = $roomplan['OrderRoomId'];
			$sql = "select C.OrderRoomId, C.CustomerSex, 
						C.CustomerFamilyName as CustomerFName, C.CustomerGivenName as CustomerGName, 
						C.CustomerCountryId, CT.CountryName_".$iso." as CountryName  
				from HT_OrderCustomer as C, HT_Country as CT 
				where OrderRoomId = '{$roomplanid}'";
			$res = mysql_query ( $sql, $link );
			
			$CustomerName = '';
			while ($cus = mysql_fetch_assoc($res)) {
				if ($cus['CustomerSex'] == 1) {
					$CustomerName .= 'Mr '.$cus['CustomerFName'].' '.$cus['CustomerGName'].' '.$cus['CountryName'].'   ';
				} else {
					$CustomerName .= 'Mrs '.$cus['CustomerFName'].' '.$cus['CustomerGName'].' '.$cus['CountryName'].'   ';
				}					
			}
			
			$Breakfast = $roomplan['Breakfast'] ? "Include" : "None";
			$Dinner = $roomplan['Dinner'] ? "Include" : "None";   
			$Special .= $roomplan['SpecialRequestNoSmoking'] ? "Non Smoking  " : "";
			$Special .= $roomplan['SpecialRequestSmoking'] ? "Smoking  " : "";
			$Special .= $roomplan['SpecialRequestAdjoin'] ? "Adjoin room  " : "";
			$Special .= $roomplan['SpecialRequestRemark'] ? $roomplan['SpecialRequestRemark']." " : "";
			
			$RoomList .= "<table  width='100%' cellspacing='10' style='font-size:12px;'>
				<tr>
					<td colspan=2><span style='color:#000000;font-weight:bold;font-zie:14px;'>- Room ".$id."</span></td>
				</tr>
				<tr>
					<td colspan=2><span>Room Plan(宿泊プラン):</span> ".$roomplan['RoomPlanName']." </td>
				</tr>
				<tr>
					<td colspan=2><span>Room Type(ルームタイプ):</span> ".$roomplan['RoomTypeName']." </td>				
				</tr> 
				<tr>
					<td colspan=2><span>Guest Name(宿泊者名):</span> ".$CustomerName."</td>
				</tr>
				<tr>
					<td width='30%'><span>Breakfast(朝食):</span> ".$Breakfast."</td>			
					<td><span>Dinner(夕食):</span> ".$Dinner."</td>
				</tr>
				<tr>
					<td colspan=2><span>Special Request(特別リクエスト):</span> ".$Special." </td>
				</tr>
				<tr>
					<td colspan=2><span>* All Special request are subjects to availability </span></td>
				</tr>
			</table>";
			$id++;
		}
		
		$sql = "select O.`OrderRoomId`, O.`OrderId`, R.`RoomPlanName_".$iso."` as RoomPlanName,   
					O.`RoomPlanId`,  R.`RoomTypeId`, T.`RoomTypeName`, count(O.`RoomPlanId`) as RoomTypeNo 
				from HT_OrderRoom as O, HT_RoomPlan as R, HT_RoomType as T 
				where O.`RoomPlanId` = R.`RoomPlanId` 
				and R.`RoomTypeId` = T.`RoomTypeId`  
				and O.`OrderId` = '{$orderid}' 
				group by R.`RoomPlanId`";
				
		$result = mysql_query ( $sql, $link );
		
		$RoomString = '';
		while($roomplan = mysql_fetch_assoc($result)) {
			$RoomString .= $roomplan['RoomTypeNo']." ".$roomplan['RoomPlanName']."&";			
		}
		$RoomString = substr($RoomString, 0, -1);
		
	   	$message = array ();
		$subject = array ();
		$from = "booking@tas-agent.com";

	$message[10][5][1] = "<body style='font-family: MS PGothic;'>
<div style='font-size:14px'>
{#HotelName}<br/>{#UserName}<br/><br/>
Please check this booking from TAS-Agent.com。<br/><br/>
</div>

<div style='font-size:14px;'>
	<div style='color:#000000;font-weight:bold;font-zie:14px;'> 1.Customer Information(お客様情報) </div>
	<table width='100%' cellspacing='10' style='font-size:12px;'>
		<tr>
			<td width='30%'><span>Booking ID(予約番号):</span> {#BookingNo}</td>				
			<td><span>Guest Name(お客様　氏名):</span> {#ContactName}</td>
		</tr>
		<tr>
			<td width='30%'><span>E-mail:</span> {#ContactEmail}</td>				
			<td><span>Tel:</span> {#ContactTel}</td>
		</tr>
	</table>
	
	<div style='color:#000000;font-weight:bold;font-zie:14px;'> 2.Booking Information(予約情報) </div>
	<table width='100%' cellspacing='10' style='font-size:12px;'>
		<tr>
			<td width='30%'><span>Check In :</span> {#CheckIn}</td>				
			<td><span>Check Out :</span> {#CheckOut}</td>
		</tr>
		<tr>
			<td colspan=2><span>Total No or rooms:</span>  {#RoomString}</td>
		</tr>
	</table>
	
	<div style='color:#000000;font-weight:bold;font-zie:14px;'> Rooming Details(宿泊情報) </div>
	{#RoomList}
	
	<div style='color:#000000;font-weight:bold;font-zie:14px;'> 3.Agent Information(旅行会社情報) </div>
	<table width='100%' cellspacing='10' style='font-size:12px;'>
		<tr><td colspan='2'><span>Name:</span> {#AgentName} </td></tr>
		<tr>
			<td width='30%'><span>Phone no:</span> {#AgentPhoneNo} </td>
			<td><span>Email:</span> {#AgentEmail} </td>
		</tr>
	</table>
</div>

<div style='border-bottom:1px dashed #000000;width=450;'></div>
<p><img width='154' style='margin-top:20;' alt='TAS-AGENT' src='http://tas-agent.com/themes/default/img/logo.jpg'/></p>
<div style='font-size:12px'>
TAS-Agent.com (株式会社ティ･エ･エス)<br/>東京都中央区銀座 8-15-2 Wave Ginza 8F<br/>電話：81-3-5565-5850<br/>ファックス：81-3-5565-5855<br/>メール: booking@tas-agent.com<br/><br/>
<div style='border-bottom:1px dashed #000000;width=450;'></div>
<p>* Please consider the environment before printing this e-mail.</p>
</div>
</body>";

	$message[10][5][2] = "<body style='font-family: MS PGothic;'>
<div style='font-size:14px'>
{#HotelName}<br/>{#UserName} 您好<br/><br/>
感谢您使用TAS-Agent.com。<br/>以下是向贵酒店下的订单。<br/><br/>
</div>

<div style='font-size:14px;'>
	<div style='color:#000000;font-weight:bold;font-zie:14px;'> 1.客户信息(お客様情報) </div>
	<table width='100%' cellspacing='10' style='font-size:12px;'>
		<tr>
			<td width='30%'><span>订单编号(予約番号):</span> {#BookingNo}</td>				
			<td><span>客户姓名(お客様　氏名):</span> {#ContactName}</td>
		</tr>
		<tr>
			<td width='30%'><span>电子邮件:</span> {#ContactEmail}</td>				
			<td><span>电话号码:</span> {#ContactTel}</td>
		</tr>
	</table>
	
	<div style='color:#000000;font-weight:bold;font-zie:14px;'> 2.预定信息(予約情報) </div>
	<table width='100%' cellspacing='10' style='font-size:12px;'>
		<tr>
			<td width='30%'><span>入住日期 :</span> {#CheckIn}</td>				
			<td><span>退房日期 :</span> {#CheckOut}</td>
		</tr>
		<tr><td colspan=2><span>房间及数量:</span>  {#RoomString}</td></tr>
	</table>
	
	<div style='color:#000000;font-weight:bold;font-zie:14px;'> 房间详细信息(宿泊情報) </div>
	{#RoomList}
	
	<div style='color:#000000;font-weight:bold;font-zie:14px;'> 3.旅行社信息(旅行会社情報) </div>
	<table width='100%' cellspacing='10' style='font-size:12px;'>
		<tr><td colspan='2'><span>旅行社名:</span> {#AgentName} </td></tr>
		<tr>
			<td width='30%'><span>电话号码:</span> {#AgentPhoneNo} </td>
			<td><span>电子邮件:</span> {#AgentEmail} </td>
		</tr>
	</table>
</div>

<div style='border-bottom:1px dashed #000000;width=450;'></div>
<p><img width='154' style='margin-top:20;' alt='TAS-AGENT' src='http://tas-agent.com/themes/default/img/logo.jpg'/></p>
<div style='font-size:12px'>
TAS-Agent.com (株式会社ティ･エ･エス)<br/>東京都中央区銀座 8-15-2 Wave Ginza 8F<br/>電話：81-3-5565-5850<br/>ファックス：81-3-5565-5855<br/>メール: booking@tas-agent.com<br/><br/>
<div style='border-bottom:1px dashed #000000;width=450;'></div>
<p>* Please consider the environment before printing this e-mail.</p>
</div>
</body>";

	$message[10][5][3] = "<body style='font-family: MS PGothic;'>
<div style='font-size:14px'>
{#HotelName}<br/>{#UserName} 您好<br/><br/>
感謝您使用TAS-Agent.com。<br/>　以下是向貴酒店下的訂單。<br/><br/>
</div>
<div style='font-size:14px;'>
	<div style='color:#000000;font-weight:bold;font-zie:14px;'> 1.客戶信息(お客様情報) </div>
	<table width='100%' cellspacing='10' style='font-size:12px;'>
		<tr>
			<td width='30%'><span>訂單編號(予約番号):</span> {#BookingNo}</td>				
			<td><span>客戶姓名(お客様　氏名):</span> {#ContactName}</td>
		</tr>
		<tr>
			<td width='30%'><span>電子郵件:</span> {#ContactEmail}</td>				
			<td><span>電話號碼:</span> {#ContactTel}</td>
		</tr>
	</table>
	
	<div style='color:#000000;font-weight:bold;font-zie:14px;'> 2.訂單信息(予約情報) </div>
	<table width='100%' cellspacing='10' style='font-size:12px;'>
		<tr>
			<td width='30%'><span>入住日期 :</span> {#CheckIn}</td>				
			<td><span>退房日期 :</span> {#CheckOut}</td>
		</tr>
		<tr><td colspan=2><span>房間及數量:</span>  {#RoomString}</td></tr>
	</table>
	
	<div style='color:#000000;font-weight:bold;font-zie:14px;'> 房間詳細信息(宿泊情報) </div>
	{#RoomList}
	
	<div style='color:#000000;font-weight:bold;font-zie:14px;'> 3.旅行社信息(旅行会社情報) </div>
	<table width='100%' cellspacing='10' style='font-size:12px;'>
		<tr><td colspan='2'><span>旅行社名:</span> {#AgentName} </td></tr>
		<tr>
			<td width='30%'><span>電話號碼:</span> {#AgentPhoneNo} </td>
			<td><span>電子郵件:</span> {#AgentEmail} </td>
		</tr>
	</table>
</div>

<div style='border-bottom:1px dashed #000000;width=450;'></div>
<p><img width='154' style='margin-top:20;' alt='TAS-AGENT' src='http://tas-agent.com/themes/default/img/logo.jpg'/></p>
<div style='font-size:12px'>
TAS-Agent.com (株式会社ティ･エ･エス)<br/>東京都中央区銀座 8-15-2 Wave Ginza 8F<br/>電話：81-3-5565-5850<br/>ファックス：81-3-5565-5855<br/>メール: booking@tas-agent.com<br/><br/>
<div style='border-bottom:1px dashed #000000;width=450;'></div>
<p>* Please consider the environment before printing this e-mail.</p>
</div>
</body>";


	$message[10][5][4] = "<body style='font-family: MS PGothic;'>
<div style='font-size:14px'>
{#HotelName}<br/>{#UserName} 様<br/><br/>
いつもお世話になっております。<br/>TAS-Agent.comです。<br/>下記の予約をお願いいたします。<br/><br/>
</div>

<div style='font-size:14px;'>
	<div style='color:#000000;font-weight:bold;font-zie:14px;'> 1.Customer Information(お客様情報) </div>
	<table width='100%' cellspacing='10' style='font-size:12px;'>
		<tr>
			<td width='30%'><span>Booking ID(予約番号):</span> {#BookingNo}</td>				
			<td><span>Guest Name(お客様　氏名):</span> {#ContactName}</td>
		</tr>
		<tr>
			<td width='30%'><span>E-mail:</span> {#ContactEmail}</td>				
			<td><span>Tel:</span> {#ContactTel}</td>
		</tr>
	</table>
	
	<div style='color:#000000;font-weight:bold;font-zie:14px;'> 2.Booking Information(予約情報) </div>
	<table width='100%' cellspacing='10' style='font-size:12px;'>
		<tr>
			<td width='30%'><span>Check In :</span> {#CheckIn}</td>				
			<td><span>Check Out :</span> {#CheckOut}</td>
		</tr>
		<tr><td colspan=2><span>Total No or rooms:</span>  {#RoomString}</td></tr>
	</table>
	
	<div style='color:#000000;font-weight:bold;font-zie:14px;'> Rooming Details(宿泊情報) </div>
	{#RoomList}
	
	<div style='color:#000000;font-weight:bold;font-zie:14px;'> 3.Agent Information(旅行会社情報) </div>
	<table width='100%' cellspacing='10' style='font-size:12px;'>
		<tr><td colspan='2'><span>Name:</span> {#AgentName} </td></tr>
		<tr>
			<td width='30%'><span>Phone no:</span> {#AgentPhoneNo} </td>
			<td><span>Email:</span> {#AgentEmail} </td>
		</tr>
	</table>
</div>

<div style='border-bottom:1px dashed #000000;width=450;'></div>
<p><img width='154' style='margin-top:20;' alt='TAS-AGENT' src='http://tas-agent.com/themes/default/img/logo.jpg'/></p>
<div style='font-size:12px'>
TAS-Agent.com (株式会社ティ･エ･エス)<br/>東京都中央区銀座 8-15-2 Wave Ginza 8F<br/>電話：81-3-5565-5850<br/>ファックス：81-3-5565-5855<br/>メール: booking@tas-agent.com<br/><br/>
<div style='border-bottom:1px dashed #000000;width=450;'></div>
<p>* Please consider the environment before printing this e-mail.</p>
</div>
</body>";


	$subject[12][5][1] = "<TAS-Agent.com> キャンセル申し込み: Booking ID(予約番号): {#BookingNo} ";
	$subject[12][5][2] = "<TAS-Agent.com> キャンセル申し込み: Booking ID(予約番号): {#BookingNo} ";
	$subject[12][5][3] = "<TAS-Agent.com> キャンセル申し込み: Booking ID(予約番号): {#BookingNo} ";
	$subject[12][5][4] = "<TAS-Agent.com> キャンセル申し込み: Booking ID(予約番号): {#BookingNo} ";	
	
		$headers = "From: {$from}" . "\r\n";
		$headers .= 'MIME-Version: 1.0'."\r\n";
		$headers .= 'Content-Type: text/html; charset=utf-8'."\r\n";
		
		$search = array('{#BookingNo}', 
			'{#HotelName}', '{#UserName}',
			'{#HotelAddress}', '{HotelContactNo}', 
			'{#ContactName}', '{#ContactEmail}', '{#ContactTel}', 
			'{#CheckIn}', '{#CheckOut}',
			'{#RoomString}', '{#RoomList}', 
			'{#AgentName}', '{#AgentPhoneNo}', '{#AgentEmail}');
		$replace = array($BookingNo,
			$HotelName, $UserName, 
			$HotelAddress, $HotelContactNo,
			$ContactName, $ContactEmail, $ContactTel,
			$CheckIn, $CheckOut,
			$RoomString, $RoomList,
			$AgentName, $AgentPhoneNo, $AgentEmail);
		
		$msg = str_replace($search, $replace, $message[10][5][$languageid]);
		$sub = str_replace('{#BookingNo}', $BookingNo, $subject[$orderstatus][5][$languageid]);
		if ($orderstatus == 7) {
			$msg = str_replace('下記の予約をお願いいたします', '下記の予約のキャンセルをお願いいたします', $msg);
		}
	 	if ($sub != '' && $msg != '') {
	 		//@mail($to, $sub, $msg, $headers);
            sendEmail($to,$sub,$msg);
	 		$msg = htmlentities($msg);
			$sql = 'insert into `HT_Mail`(MailTo, MailFrom, SubjectName, Body) value("'.$to.'", "'.$from.'", "'.$sub.'", "'.$msg.'")';
			Db::getInstance ()->ExecuteS ( $sql );
	 	}
	}
}


function mailto($orderStatusId, $where, $link) {
	//发送的邮件的时间信息
	$year = date ( 'Y' );
	$month = date ( 'm' );
	$day = date ( 'd' );
	$hour = date ( 'H' );
	$minute = date ( 'i' );
	$second = date ( 's' );
	$apm = date ( 'A' );
	
	//邮件格式数组
	$message = array ();
	$subject = array ();
	$from = "booking@tas-agent.com";
	$toemail = "likang@osbay.com";//todo: 管理员邮箱，记得修改！！
	
	$message [7] [3] [1] = "<p>Dear {#AgentName}</p><p>your below booking is canceld because of payment.</p><hr style='color:orange'/><p>Booking no: {#BookingNo}</p><p>Hotel: {#HotelName}</p><p>Guest Name: {#GuestName}</p><p>Check In: {#CheckIn}　　　Check Out: {#CheckOut}</p><p>Room Type: {#RoomType}</p><p><a href='{#Url}'>more detail</a></p><hr style='color:orange'/><p>Thank you very much for using our service.</p><br/><p>Best Regards<br/>TAS-AGENT.COM Team</p>";
	$message [7] [3] [2] = "<p>Dear {#AgentName}</p><p>your below booking is canceld because of payment.</p><hr style='color:orange'/><p>Booking no: {#BookingNo}</p><p>Hotel: {#HotelName}</p><p>Guest Name: {#GuestName}</p><p>Check In: {#CheckIn}　　　Check Out: {#CheckOut}</p><p>Room Type: {#RoomType}</p><p><a href='{#Url}'>more detail</a></p><hr style='color:orange'/><p>Thank you very much for using our service.</p><br/><p>Best Regards<br/>TAS-AGENT.COM Team</p>";
	$message [7] [3] [3] = "<p>Dear {#AgentName}</p><p>your below booking is canceld because of payment.</p><hr style='color:orange'/><p>Booking no: {#BookingNo}</p><p>Hotel: {#HotelName}</p><p>Guest Name: {#GuestName}</p><p>Check In: {#CheckIn}　　　Check Out: {#CheckOut}</p><p>Room Type: {#RoomType}</p><p><a href='{#Url}'>more detail</a></p><hr style='color:orange'/><p>Thank you very much for using our service.</p><br/><p>Best Regards<br/>TAS-AGENT.COM Team</p>";
	$message [7] [3] [4] = "<p>Dear {#AgentName}</p><p>your below booking is canceld because of payment.</p><hr style='color:orange'/><p>Booking no: {#BookingNo}</p><p>Hotel: {#HotelName}</p><p>Guest Name: {#GuestName}</p><p>Check In: {#CheckIn}　　　Check Out: {#CheckOut}</p><p>Room Type: {#RoomType}</p><p><a href='{#Url}'>more detail</a></p><hr style='color:orange'/><p>Thank you very much for using our service.</p><br/><p>Best Regards<br/>TAS-AGENT.COM Team</p>";
	
	$message [7] [4] [4] = "<p>下記予約は未入金の為キャンセルされました。</p><hr style='color:orange'/><p>Agent: {#AgentName}</p><p>Booking no: {#BookingNo}</p><p>Hotel: {#HotelName}</p><p>Guest Name: {#GuestName}</p><p>Check In: {#CheckIn}　　　Check Out: {#CheckOut}</p><p>Room Type: {#RoomType}</p><p><a href='{#Url}'>more detail</a></p><hr style='color:orange'/>";
	
	$message [5] [3] [1] = "<p>Dear {#AgentName}</p><p>I am very sorry we are not able to proceed below booking because of room availability. Please kindly check other hotels.</p><hr style='color:orange'/><p>Booking no: {#BookingNo}</p><p>Hotel: {#HotelName}</p><p>Guest Name: {#GuestName}</p><p>Check In: {#CheckIn}　　　Check Out: {#CheckOut}</p><p>Room Type: {#RoomType}</p><p><a href='{#Url}'>more detail</a></p><hr style='color:orange'/><p> If you need any further help, please kindly contact our team. you very much for payment!</p><p>Best Regards<br/>TAS-AGENT.COM Team</p>";
	$message [5] [3] [2] = "<p>Dear {#AgentName}</p><p>I am very sorry we are not able to proceed below booking because of room availability. Please kindly check other hotels.</p><hr style='color:orange'/><p>Booking no: {#BookingNo}</p><p>Hotel: {#HotelName}</p><p>Guest Name: {#GuestName}</p><p>Check In: {#CheckIn}　　　Check Out: {#CheckOut}</p><p>Room Type: {#RoomType}</p><p><a href='{#Url}'>more detail</a></p><hr style='color:orange'/><p> If you need any further help, please kindly contact our team. you very much for payment!</p><p>Best Regards<br/>TAS-AGENT.COM Team</p>";
	$message [5] [3] [3] = "<p>Dear {#AgentName}</p><p>I am very sorry we are not able to proceed below booking because of room availability. Please kindly check other hotels.</p><hr style='color:orange'/><p>Booking no: {#BookingNo}</p><p>Hotel: {#HotelName}</p><p>Guest Name: {#GuestName}</p><p>Check In: {#CheckIn}　　　Check Out: {#CheckOut}</p><p>Room Type: {#RoomType}</p><p><a href='{#Url}'>more detail</a></p><hr style='color:orange'/><p> If you need any further help, please kindly contact our team. you very much for payment!</p><p>Best Regards<br/>TAS-AGENT.COM Team</p>";
	$message [5] [3] [4] = "<p>Dear {#AgentName}</p><p>I am very sorry we are not able to proceed below booking because of room availability. Please kindly check other hotels.</p><hr style='color:orange'/><p>Booking no: {#BookingNo}</p><p>Hotel: {#HotelName}</p><p>Guest Name: {#GuestName}</p><p>Check In: {#CheckIn}　　　Check Out: {#CheckOut}</p><p>Room Type: {#RoomType}</p><p><a href='{#Url}'>more detail</a></p><hr style='color:orange'/><p> If you need any further help, please kindly contact our team. you very much for payment!</p><p>Best Regards<br/>TAS-AGENT.COM Team</p>";
	
	$message [5] [4] [4] = "<p>下記予約不可の旨、エージェントに連絡済です、</p><hr style='color:orange'/><p>Booking no: {#BookingNo}</p><p>Hotel: {#HotelName}</p><p>Guest Name: {#GuestName}</p><p>Check In: {#CheckIn}　　　Check Out: {#CheckOut}</p><p>Room Type: {#RoomType}</p><p><a href='{#Url}'>more detail</a></p><hr style='color:orange'/>";
	
	$message [8] [3] [1] = "<p>Dear {#AgentName}</p><p>Your payment due for below booking is already passed.</p><hr style='color:orange'/><p>Booking no: {#BookingNo}</p><p>Hotel: {#HotelName}</p><p>Guest Name: {#GuestName}</p><p>Check In: {#CheckIn}　　　Check Out: {#CheckOut}</p><p>Room Type: {#RoomType}</p><p><a href='{#Url}'>more detail</a></p><hr style='color:orange'/><p>Booking will be automatically cancelled very soon.</p><p>If you would like to keep this booking, please contact our team ASAP</p><p>Best Regards<br/>TAS-AGENT.COM Team</p>";
	$message [8] [3] [2] = "<p>Dear {#AgentName}</p><p>Your payment due for below booking is already passed.</p><hr style='color:orange'/><p>Booking no: {#BookingNo}</p><p>Hotel: {#HotelName}</p><p>Guest Name: {#GuestName}</p><p>Check In: {#CheckIn}　　　Check Out: {#CheckOut}</p><p>Room Type: {#RoomType}</p><p><a href='{#Url}'>more detail</a></p><hr style='color:orange'/><p>Booking will be automatically cancelled very soon.</p><p>If you would like to keep this booking, please contact our team ASAP</p><p>Best Regards<br/>TAS-AGENT.COM Team</p>";
	$message [8] [3] [3] = "<p>Dear {#AgentName}</p><p>Your payment due for below booking is already passed.</p><hr style='color:orange'/><p>Booking no: {#BookingNo}</p><p>Hotel: {#HotelName}</p><p>Guest Name: {#GuestName}</p><p>Check In: {#CheckIn}　　　Check Out: {#CheckOut}</p><p>Room Type: {#RoomType}</p><p><a href='{#Url}'>more detail</a></p><hr style='color:orange'/><p>Booking will be automatically cancelled very soon.</p><p>If you would like to keep this booking, please contact our team ASAP</p><p>Best Regards<br/>TAS-AGENT.COM Team</p>";
	$message [8] [3] [4] = "<p>Dear {#AgentName}</p><p>Your payment due for below booking is already passed.</p><hr style='color:orange'/><p>Booking no: {#BookingNo}</p><p>Hotel: {#HotelName}</p><p>Guest Name: {#GuestName}</p><p>Check In: {#CheckIn}　　　Check Out: {#CheckOut}</p><p>Room Type: {#RoomType}</p><p><a href='{#Url}'>more detail</a></p><hr style='color:orange'/><p>Booking will be automatically cancelled very soon.</p><p>If you would like to keep this booking, please contact our team ASAP</p><p>Best Regards<br/>TAS-AGENT.COM Team</p>";
	
	$message [8] [4] [4] = "<p>{#year}年{#month}月{#day}日　　{#hour}:{#minute}:{#second} {#apm}に下記予約を自動キャンセルします。</p><hr style='color:orange'/><p>Agent: {#AgentName}</p><p>Booking no: {#BookingNo}</p><p>Hotel: {#HotelName}</p><p>Guest Name: {#GuestName}</p><p>Check In: {#CheckIn}　　　Check Out: {#CheckOut}</p><p>Room Type: {#RoomType}</p><p><a href='{#Url}'>more detail</a></p><hr style='color:orange'/>";
	
	$subject [7] [3] [1] = "Your booking has been cancelled by payment failure";
	$subject [7] [3] [4] = "Your booking has been cancelled by payment failure";
	$subject [7] [3] [2] = "Your booking has been cancelled by payment failure";
	$subject [7] [3] [3] = "Your booking has been cancelled by payment failure";
	
	$subject [7] [4] [4] = "Booking no: {#BookingNo} は未入金の為キャンセルされました。";
	
	$subject [5] [3] [1] = "Your booking for Booking no: {#BookingNo} has been fully booked";
	$subject [5] [3] [4] = "Your booking for Booking no: {#BookingNo} has been fully booked";
	$subject [5] [3] [2] = "Your booking for Booking no: {#BookingNo} has been fully booked";
	$subject [5] [3] [3] = "Your booking for Booking no: {#BookingNo} has been fully booked";
	
	$subject [5] [4] [4] = "Booking No.{#BookingNo} 派満室の為、予約不可。";
	
	$subject [8] [3] [1] = "Your booking has expired";
	$subject [8] [3] [4] = "Your booking has expired";
	$subject [8] [3] [2] = "Your booking has expired";
	$subject [8] [3] [3] = "Your booking has expired";
	
	$subject [8] [4] [4] = "Booking No.{#BookingNo} is expired";
	
	$search = array ('{#year}', '{#month}', '{#day}', '{#hour}', '{#minute}', '{#second}', '{#apm}', '{#Url}', 
		'{#AgentName}', '{#BookingNo}', '{#HotelName}', '{#GuestName}', '{#CheckIn}', '{#CheckOut}', '{#RoomType}' );
	
	$sql = "select OrderId, BookingNo, OrderUserId, HotelId, CheckInDate, CheckOutDate, paymentMethod from HT_Order ";
	$sql .= $where;
	
	$results = mysql_query ( $sql, $link );
	while ( $row = mysql_fetch_assoc ( $results ) ) {
		$BookingNo = $row ['BookingNo']; //获取BookingNo
		$CheckIn = $row ['CheckInDate']; //获取CheckIn
		$CheckOut = $row ['CheckOutDate']; //获取CheckOut
		

		$orderid = $row ['OrderId'];
		$userid = $row ['OrderUserId'];
		$hotelid = $row ['HotelId'];
		
		//获取RoomType信息
		$sql = "select O.OrderId, O.RoomPlanId, R.RoomTypeId, T.RoomTypeName  
					from HT_OrderRoom as O, HT_RoomPlan as R, HT_RoomType as T 
					where O.RoomPlanId = R.RoomPlanId and R.RoomTypeId = T.RoomTypeId 
					and O.OrderId = '$orderid' 
					group by RoomTypeName";
		$res = mysql_query ( $sql, $link );
		$RoomType = '';
		foreach ( $res as $row ) {
			$RoomType .= $row ['RoomTypeName'] . ',';
		}
		$RoomType = substr ( $RoomType, 0, - 1 );
		
		//获取User信息
		$sql = "select U.`Name`, U.`Email`, U.`CompanyID`, U.`LanguageID`, L.`LanguageShortName`, U.`RoleID`, C.`CompanyName`  
						from `HT_User` as U, HT_Company as C, HT_Language as L  
						where U.`CompanyID` = C.`CompanyId` 
						and U.`LanguageID` = L.`LanguageId` 
						and U.`UserID` = '$userid'";
		$res = mysql_query ( $sql, $link );
		$userinfo = mysql_fetch_assoc ( $res );
		$GuestName = $userinfo ['Name']; //获取GuestName信息
		

		$to = $userinfo ['Email']; //获取Email To 信息
		$languageid = $userinfo ['LanguageID'];
		$roleId = $userinfo ['RoleID'];
		$iso = $userinfo ['LanguageShortName'];
		
		$sql = "select HotelName_{$iso} as HotelName from HT_Hotel where HotelId = '{$hotelid}'";
		$res = mysql_query ( $sql, $link );
		$hotelinfo = mysql_fetch_assoc ( $res );
		$HotelName = $hotelinfo ['HotelName']; //获取HotelName

		//获取AgentName信息 
		if ($roleId == 2 || $roleId == 3) {
			$AgentName = $userinfo ['CompanyName'];
		}
		
		$Url = "http://tas-agent.com/booking_order.php?booking=edit&oid=".$orderid;

		$replace = array ($year, $month, $day, $hour, $minute, $second, $apm, $Url, 
			$AgentName, $BookingNo, $HotelName, $GuestName, $CheckIn, $CheckOut, $RoomType );
		
		$headers = "From: {$from}" . "\r\n";
		$headers .= 'MIME-Version: 1.0'."\r\n";
		$headers .= 'Content-Type: text/html; charset=utf-8'."\r\n";
		
		$msg = str_replace ( $search, $replace, $message [$orderStatusId] [3] [$languageid] );
		$sub = str_replace ( '{#BookingNo}', $BookingNo, $subject [$orderStatusId] [3] [$languageid] );
		if ($sub != '' && $msg != '') {
			//@mail ( $to, $sub, $msg, $headers );
            sendEmail($to,$sub,$msg);
			$msg = htmlentities($msg);
			$sql = 'insert into `HT_Mail`(MailTo, MailFrom, SubjectName, Body) value("'.$to.'", "'.$from.'", "'.$sub.'", "'.$msg.'")';
			mysql_query($sql);
		}
		
		$msg = str_replace ( $search, $replace, $message [$orderStatusId] [4] [$languageid] );
		$sub = str_replace ( '{#BookingNo}', $BookingNo, $subject [$orderStatusId] [4] [4] );
		if ($sub != '' && $msg != '') {
			//@mail ( $toemail, $sub, $msg, $headers );
            sendEmail($toemail,$sub,$msg);
			$msg = htmlentities($msg);
			$sql = 'insert into `HT_Mail`(MailTo, MailFrom, SubjectName, Body) value("'.$toemail.'", "'.$from.'", "'.$sub.'", "'.$msg.'")';
			mysql_query($sql);
		}
	}
}
define('_TOOL_DIR_',            '/var/www/html/tools/');
require_once(_TOOL_DIR_ . "/PHPMailer/class.phpmailer.php");
function sendEmail($to, $Subject, $emailBody,$name='tas-agent',$from='noreply@tas-japan.net') {
     $mail = new PHPMailer();
     $mail->IsSMTP(); // telling the class to use SMTP
     $mail->CharSet='utf-8';
     $mail->SMTPAuth = true; // enable SMTP authentication
     $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
     $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
     $mail->Port = 465; // set the SMTP port for the GMAIL server
     $mail->Username = "noreply@tas-japan.net"; // GMAIL username
     $mail->Password = "tas1980?5514"; // GMAIL password
     $mail->SetFrom($from,$name);
    // $mail->AddReplyTo("fax-send@tas-japan.net", "fax");
     $mail->Subject = $Subject;
     $mail->MsgHTML($emailBody);
    // $toemail=$Fax."@efaxsend.com";
     $mail->AddAddress($to);
    // $mail->AddAttachment($attachment_file); // attachment
     $mail->Send();//发邮件
}


?>
