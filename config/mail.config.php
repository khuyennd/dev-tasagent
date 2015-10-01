<?php
	global $from, $message, $subject, $toemail, $faxTail, $emailTail, $faxHead;
	
	$from = "booking@tas-agent.com";
	
	//$toemail = "likang@osbay.com";
$toemail = "wy_lzm@yahoo.co.jp";
	$message = array();
	
	$message[2][3][1] = "<p>Dear {#AgentName}</p>
						<p>Thank you for booking with TAS-Agent.  Now our team is checking below requested room availability.</p>
						<hr style='color:orange'/>
						<p>Booking no: {#BookingNo}</p>
						<p>Hotel: {#HotelName}</p>
						<p>Guest Name: {#GuestName}</p>
						<p>Check In: {#CheckIn}　　　Check Out: {#CheckOut}</p>
						<p>Room Type: {#RoomType}</p>
						<p><a href='{#Url}'>more detail</a></p>
						<hr style='color:orange'/>
						<p>We will update booking status in next 24 hrs. </p>
						<p>Thank you very much!</p>
						<p>Best Regards<br/>TAS-AGENT.COM Team</p>";
	$message[2][3][4] = "<p>{#AgentName}様</p>
						<p>TAS-Agentをご利用頂きありがとうございます。ご予約したルームの入居可否を確認しています。</p>
						<hr style='color:orange'/>
						<p>予約番号: {#BookingNo}</p>
						<p>ホテル名: {#HotelName}</p>
						<p>ゲスト名: {#GuestName}</p>
						<p>チェックイン: {#CheckIn}　　　チェックアウト: {#CheckOut}</p>
						<p>ルームタイプ: {#RoomType}</p>
						<p><a href='{#Url}'>詳細情報</a></p>
						<hr style='color:orange'/>
						<p>予約ステータスは24時間以内に更新させて頂きます。</p>
						<p>ありがとうございます。</p>
						<p>よろしくお願いします。<br/>TAS-AGENT.COM チーム</p>";
	$message[2][3][2] = "<p>{#AgentName} 您好</p>
						<p>感谢您使用TAS-Agent进行预订。我们正在确认您所预订的房间是否可以入住。</p>
						<hr style='color:orange'/>
						<p>订单编号: {#BookingNo}</p>
						<p>酒店名称: {#HotelName}</p>
						<p>用户姓名: {#GuestName}</p>
						<p>入住日期: {#CheckIn}　　　退房日期: {#CheckOut}</p>
						<p>房间类型: {#RoomType}</p>
						<p><a href='{#Url}'>查看详细信息</a></p>
						<hr style='color:orange'/>
						<p>我们会在24小时以内确认并更新订单状态。 </p>
						<p>非常感谢。</p>
						<p>欢迎继续使用我们提供的服务。<br/>TAS-AGENT.COM 团队</p>";
	$message[2][3][3] = "<p>{#AgentName} 您好</p>
						<p>感謝您使用TAS-Agent進行預訂。我們正在確認您所預訂的房間是否可以入住。</p>
						<hr style='color:orange'/>
						<p>訂單編號: {#BookingNo}</p>
						<p>酒店名稱: {#HotelName}</p>
						<p>用戶姓名: {#GuestName}</p>
						<p>入住日期: {#CheckIn}　　　退房日期: {#CheckOut}</p>
						<p>房間類型: {#RoomType}</p>
						<p><a href='{#Url}'>查看詳細信息</a></p>
						<hr style='color:orange'/>
						<p>我們會在24小時內確認并更新訂單狀態。 </p>
						<p>非常感謝。</p>
						<p>歡迎繼續使用我們提供的服務。<br/>TAS-AGENT.COM 團隊</p>";
	
	$message[2][4][4] = "<p>予約日： {#year}年{#month}月{#day}日　　{#hour}:{#minute}:{#second} {#apm}</p>
						<p>エージェント名: {#AgentName}</p>
						<p>ホテル名: {#HotelName}</p>
						<p>チェックイン: {#CheckIn}　　　チェックアウト: {#CheckOut}</p>
						<p>ルームタイプ: {#RoomType}</p>
						<br/><br/>
						<p style='color:red'>返信期日：　{#year}年{#month}月{#day}日　　{#hour}:{#minute}:{#second} {#apm}</p>";

	$message[3][3][1] = "<p>Dear {#AgentName}</p>
						<p>Thank you for booking with TAS-Agent.</p>
						<p>Your below booking is confirmed now. Please kindly <a href='http://tas-agent.com/booking_list.php'>Booking list</a> page to make a payment.</p>
						<hr style='color:orange'/>
						<p>Booking no: {#BookingNo}</p>
						<p>Hotel: {#HotelName}</p>
						<p>Customer Name: {#CustomerName}</p>
						<p>Check In: {#CheckIn}　　　Check Out: {#CheckOut}</p>
						<p>Room Type: {#RoomType}</p>
						<p><a href='{#Url}'>more detail</a></p>
						<hr style='color:orange'/>
						<p>Thank you very much!</p>
						<p>Best Regards<br/>TAS-AGENT.COM Team</p>";
	$message[3][3][2] = "<p>{#AgentName} 您好</p>
						<p>感谢您使用TAS-Agent进行预订。</p>
						<p>您所预订的房间可以入住。请到 <a href='http://tas-agent.com/booking_list.php'>订单一览</a> 页面进行支付。</p>
						<hr style='color:orange'/>
						<p>订单编号: {#BookingNo}</p>
						<p>酒店名称: {#HotelName}</p>
						<p>客户姓名: {#GuestName}</p>
						<p>入住日期: {#CheckIn}　　　退房日期: {#CheckOut}</p>
						<p>房间类型: {#RoomType}</p>
						<p><a href='{#Url}'>查看详细信息</a></p>
						<hr style='color:orange'/>
						<p>非常感谢。</p>
						<p>欢迎继续使用我们提供的服务。<br/>TAS-AGENT.COM 团队</p>";
	$message[3][3][3] = "<p>{#AgentName} 您好</p>
						<p>感謝您使用TAS-Agent進行預訂。</p>
						<p>您所預訂的房間可以入住。請到 <a href='http://tas-agent.com/booking_list.php'>訂單一覽</a> 頁面進行支付。</p>
						<hr style='color:orange'/>
						<p>訂單編號: {#BookingNo}</p>
						<p>酒店名稱: {#HotelName}</p>
						<p>客戶姓名: {#GuestName}</p>
						<p>入住日期: {#CheckIn}　　　退房日期: {#CheckOut}</p>
						<p>房間類型: {#RoomType}</p>
						<p><a href='{#Url}'>查看詳細信息</a></p>
						<hr style='color:orange'/>
						<p>非常感謝。</p>
						<p>歡迎繼續使用我們提供的服務。<br/>TAS-AGENT.COM 團隊</p>";
	$message[3][3][4] = "<p>{#AgentName}　様</p>
						<p>TAS-Agentをご利用頂きありがとうございます。</p>
						<p>下記の予約が確定いたしました。<a href='http://tas-agent.com/booking_list.php'>予約一覧</a>ページで決済をお願いします。</p>
						<hr style='color:orange'/>
						<p>予約番号: {#BookingNo}</p>
						<p>ホテル名: {#HotelName}</p>
						<p>宿泊者名: {#GuestName}</p>
						<p>チェックイン: {#CheckIn}　　　チェックアウト: {#CheckOut}</p>
						<p>ルームタイプ: {#RoomType}</p>
						<p><a href='{#Url}'>詳細情報</a></p>
						<hr style='color:orange'/>
						<p>ありがとうございます。</p>
						<p>宜しくお願いいたします。<br/>TAS-AGENT.COM チーム</p>";
	$message[3][4][1] = "<p>Dear {#AgentName}</p>
										<p>Thank you for booking with TAS-Agent.</p>
										<p>Your booking is confirmed now. Please kindly check Booking list page for Hotel <a href=''>Voucher & Invoce</a>.</p>";
    $message[3][4][2] = "<p>Dear {#AgentName}</p>
										<p>感谢您使用TAS-Agent进行预订</p>
										<p>您的订单已经得到确认。请到订单一览页查看<a href=''>Voucher & Invoce</a>.</p>";
	$message[3][4][3] = "<p>Dear {#AgentName}</p>
										<p>感謝您使用TAS-Agent進行預訂</p>
										<p>您的訂單已經得到確認，請到訂單一覽頁查看<a href=''>Voucher & Invoce</a>.</p>";

	$message[3][4][4] = "<p>{#AgentName} 様</p>
										<p>TAS-Agentをご利用頂きありがとうございます。</p>
										<p>ご予約したルームが入居可能です。予約一覧で <a href=''>Voucher & Invoce</a>を確認してください。</p>";
	$message[4][3][1] = "<p>Dear {#AgentName}</p>
					     <p>Thank you very much for payment for below!</p>
						 <hr style='color:orange'/>
						 <p>Booking no: {#BookingNo}</p>
						 <p>Hotel: {#HotelName}</p>
						 <p>Guest Name: {#GuestName}</p>
						 <p>Check In: {#CheckIn}　　　Check Out: {#CheckOut}</p>
						 <p>Room Type: {#RoomType}</p>
						 <p><a href='{#Url}'>more detail</a></p>
						 <hr style='color:orange'/>
						 <p>Best Regards<br/>TAS-AGENT.COM Team</p>";
	$message[4][3][2] = "<p>{#AgentName} 您好</p>
						<p>非常感谢您及时付款！</p>
						<hr style='color:orange'/>
						<p>订单编号: {#BookingNo}</p>
						<p>酒店名称: {#HotelName}</p>
						<p>客户姓名: {#GuestName}</p>
						<p>入住日期: {#CheckIn}　　　退房日期: {#CheckOut}</p>
						<p>房间类型: {#RoomType}</p>
						<p><a href='{#Url}'>更多详细信息</a></p>
						<hr style='color:orange'/>
						<p>非常感谢。<br/>TAS-AGENT.COM 团队</p>";
	$message[4][3][3] = "<p>{#AgentName} 您好</p>
						 <p>非常感謝您及時付款！</p>
						<hr style='color:orange'/>
						<p>訂單編號: {#BookingNo}</p>
						<p>酒店名稱: {#HotelName}</p>
						<p>客戶姓名: {#GuestName}</p>
						<p>入住日期: {#CheckIn}　　　退房日期: {#CheckOut}</p>
						<p>房間類型: {#RoomType}</p>
						<p><a href='{#Url}'>更多詳細信息</a></p>
						<hr style='color:orange'/>
						<p>非常感謝。<br/>TAS-AGENT.COM 團隊</p>";
	$message[4][3][4] = "<p>{#AgentName}　様</p>
						<p>ご入金頂きありがとうございます。</p>
						<hr style='color:orange'/>
						<p>予約番号: {#BookingNo}</p>
						<p>ホテル名: {#HotelName}</p>
						<p>ゲスト名: {#GuestName}</p>
						<p>チェックイン: {#CheckIn}　　　チェックアウト: {#CheckOut}</p>
						<p>ルームタイプ: {#RoomType}</p>
						<p><a href='{#Url}'>詳細情報</a></p>
						<hr style='color:orange'/>
						<p>宜しくお願い致します。
						<br/>TAS-AGENT.COM チーム</p>";
	$message[4][4][4] = "<hr style='color:orange'/>
						<p>予約番号: {#BookingNo}</p>
						<p>ホテル名: {#HotelName}</p>
						<p>ゲスト名: {#GuestName}</p>
						<p>チェックイン: {#CheckIn}　　　チェックアウト: {#CheckOut}</p>
						<p>ルームタイプ: {#RoomType}</p>
						<p><a href='{#Url}'>詳細情報</a></p>
						<hr style='color:orange'/>";
	
	$message[5][3][1] = "<p>Dear {#AgentName}</p>
						<p>I am very sorry we are not able to proceed below booking because of room availability. Please kindly check other hotels.</p>
						<hr style='color:orange'/>
						<p>Booking no: {#BookingNo}</p>
						<p>Hotel: {#HotelName}</p>
						<p>Guest Name: {#GuestName}</p>
						<p>Check In: {#CheckIn}　　　Check Out: {#CheckOut}</p>
						<p>Room Type: {#RoomType}</p>
						<p><a href='{#Url}'>more detail</a></p>
						<hr style='color:orange'/>
						<p>If you need any further help, please kindly contact our team. </p>
						<p>Best Regards<br/>TAS-AGENT.COM Team</p>";
	
	$message[5][3][2] = "<p>{#AgentName} 您好</p>
						<p>很抱歉，由于没有空房，所以无法完成预定。请预订其他酒店。</p>
						<hr style='color:orange'/>
										<p>订单编号: {#BookingNo}</p>
										<p>酒店名称: {#HotelName}</p>
										<p>客户姓名: {#GuestName}</p>
										<p>入住日期: {#CheckIn}　　　退房日期: {#CheckOut}</p>
										<p>房间类型: {#RoomType}</p>
										<p><a href='{#Url}'>更多详细信息</a></p>
										<hr style='color:orange'/>
										<p>如果您需要任何进一步的帮助，请致电我们。</p>
										<p>非常感谢。<br/>TAS-AGENT.COM Team</p>";
	$message[5][3][3] = "				
	                                        <p>{#AgentName} 您好</p>
											<p>很抱歉，由於沒有空房，所以無法完成預定。請預訂其他酒店。</p>
											<hr style='color:orange'/>
											<p>訂單編號: {#BookingNo}</p>
											<p>酒店名稱：{#HotelName}</p>
											<p>客戶姓名: {#GuestName}</p>
											<p>入住日期: {#CheckIn}　　　退房日期: {#CheckOut}</p>
											<p>房間類型: {#RoomType}</p>
											<p><a href='{#Url}'>更多詳細信息</a></p>
											<hr style='color:orange'/>
											<p>如果您需要任何進一步的幫助，請致電我們。</p>
											<p>非常感謝<br/>TAS-AGENT.COM 團隊</p>";
	$message[5][3][4] = "				
	                                        <p>{#AgentName} 様</p>
											<p>大変申し訳ございませんですが、満室のため、ご予約は成立できませんです。他のホテルを検索してみてください。</p>
											<hr style='color:orange'/>
											<p>予約番号: {#BookingNo}</p>
											<p>ホテル名: {#HotelName}</p>
											<p>ゲスト名: {#GuestName}</p>
											<p>チェックイン: {#CheckIn}　　　チェックアウト: {#CheckOut}</p>
											<p>ルームタイプ: {#RoomType}</p>
											<p><a href='{#Url}'>詳細情報</a></p>
											<hr style='color:orange'/>
											<p>他のヘルプが必要な場合は弊社に連絡してください。</p>
											<p>宜しくお願い致します。<br/>TAS-AGENT.COM チーム</p>";
	$message[5][4][4] = "<p>下記予約不可の旨、エージェントに連絡済です、</p>
											<hr style='color:orange'/>
											<p>予約番号: {#BookingNo}</p>
											<p>ホテル名: {#HotelName}</p>
											<p>ゲスト名: {#GuestName}</p>
											<p>チェックイン: {#CheckIn}　　　チェックアウト: {#CheckOut}</p>
											<p>ルームタイプ: {#RoomType}</p>
											<p><a href='{#Url}'>詳細情報</a></p>
											<hr style='color:orange'/>";
	
	$message[8][3][1] = "			
	　　　　　　　　　　　　　　　　<p>Dear {#AgentName}</p>
									<p>Your payment due for below booking is already passed.</p>
									<hr style='color:orange'/>
									<p>Booking no: {#BookingNo}</p>
									<p>Hotel: {#HotelName}</p>
									<p>Guest Name: {#GuestName}</p>
									<p>Check In: {#CheckIn}　　　Check Out: {#CheckOut}</p>
									<p>Room Type: {#RoomType}</p>
									<p><a href='{#Url}'>more detail</a></p>
									<hr style='color:orange'/>
									<p>Booking will be automatically cancelled very soon.</p>
									<p>If you would like to keep this booking, please contact our team ASAP</p>
									<p>Best Regards<br/>TAS-AGENT.COM Team</p>";
	$message[8][3][2] = "				
	　　　　　　　　　　　　　　　　<p>{#AgentName} 您好</p>
									<p>由于逾期未支付，您的订单已过期失效。</p>
									<hr style='color:orange'/>
									<p>订单编号: {#BookingNo}</p>
									<p>酒店名称: {#HotelName}</p>
									<p>客户姓名: {#GuestName}</p>
									<p>入住日期: {#CheckIn}　　　退房日期: {#CheckOut}</p>
									<p>房间类型: {#RoomType}</p>
									<p><a href='{#Url}'>更多详细信息</a></p>
									<hr style='color:orange'/>
									<p>订单很快将自动取消。</p>
									<p>如果您想继续此订单，请尽快联系我们。</p>
									<p>非常感谢。<br/>TAS-AGENT.COM 团队</p>";
	$message[8][3][3] = "				
	                                <p>Dear {#AgentName}</p>
									<p>由於逾期未支付，您的訂單已過期失效。</p>
									<hr style='color:orange'/>
									<p>訂單编号: {#BookingNo}</p>
									<p>酒店名称: {#HotelName}</p>
									<p>客戶姓名: {#GuestName}</p>
									<p>入住日期: {#CheckIn}　　　退房日期: {#CheckOut}</p>
									<p>房間類型: {#RoomType}</p>
									<p><a href='{#Url}'>更多詳細信息</a></p>
									<hr style='color:orange'/>
									<p>訂單很快將自動取消</p>
									<p>如果您想繼續此訂單，請儘快聯繫我們。</p>
									<p>非常感謝<br/>TAS-AGENT.COM Team</p>";
	$message[8][3][4] = "			
	　　　　　　　　　　　　　　　　<p>{#AgentName} 様</p>
									<p>入金締切日を過ぎたので、ご予約が「期限切れ」になりました。</p>
									<hr style='color:orange'/>
									<p>予約番号: {#BookingNo}</p>
									<p>ホテル名: {#HotelName}</p>
									<p>ゲスト名: {#GuestName}</p>
									<p>チェックイン: {#CheckIn}　　　チェックアウト: {#CheckOut}</p>
									<p>ルームタイプ: {#RoomType}</p>
									<p><a href='{#Url}'>詳細情報</a></p>
									<hr style='color:orange'/>
									<p>ご予約が24時間内に自動キャンセルされます。</p>
									<p>この予約を続けたい場合、弊社に連絡してください。</p>
									<p>宜しくお願い致します。<br/>TAS-AGENT.COM チーム</p>";
	$message[8][4][4] = "<p>{#year}年{#month}月{#day}日　　{#hour}:{#minute}:{#second} {#apm}に下記予約を自動キャンセルします。</p>
									<hr style='color:orange'/>
									<p>エージェント名: {#AgentName}</p>
									<p>予約番号: {#BookingNo}</p>
									<p>ホテル名: {#HotelName}</p>
									<p>ゲスト名: {#GuestName}</p>
									<p>チェックイン: {#CheckIn}　　　チェックアウト: {#CheckOut}</p>
									<p>ルームタイプ: {#RoomType}</p>
									<p><a href='{#Url}'>詳細情報</a></p>
									<hr style='color:orange'/>";
	
	$message[7][3][1] = "			
	　　　　　　　　　　　　　　　　<p>Dear {#AgentName}</p>
									<p>your booking is canceld per requested.</p>
									<hr style='color:orange'/>
									<p>Agent: {#AgentName}</p>
									<p>Booking no: {#BookingNo}</p>
									<p>Hotel: {#HotelName}</p>
									<p>Guest Name: {#GuestName}</p>
									<p>Check In: {#CheckIn}　　　Check Out: {#CheckOut}</p>
									<p>Room Type: {#RoomType}</p>
									<p><a href='{#Url}'>more detail</a></p>
									<hr style='color:orange'/>
									<p>Thank you very much for using our service.</p>
									<br/><br/><br/><br/><br/><br/><br/><br/>
									<p>Best Regards<br/>TAS-AGENT.COM Team</p>";
	$message[7][3][2] = "			
	　　　　　　　　　　　　　　　　<p>{#AgentName} 您好</p>
									<p>您的订单已按照要求被取消了。</p>
									<hr style='color:orange'/>
									<p>旅行社名: {#AgentName}</p>
									<p>订单编号: {#BookingNo}</p>
									<p>酒店名称: {#HotelName}</p>
									<p>客户姓名: {#GuestName}</p>
									<p>入住日期: {#CheckIn}　　　退房日期: {#CheckOut}</p>
									<p>房间类型: {#RoomType}</p>
									<p><a href='{#Url}'>更多详细信息</a></p>
									<hr style='color:orange'/>
									<p>非常感谢您使用我们的服务。</p>
									<br/><br/><br/><br/><br/><br/><br/><br/>
									<p>非常感谢。<br/>TAS-AGENT.COM 团队</p>";
	$message[7][3][3] = "			
	                                <p>{#AgentName} 您好</p>
									<p>您的訂單已按照要求被取消了。</p>
									<hr style='color:orange'/>
									<p>旅行社名: {#AgentName}</p>
									<p>訂單編號: {#BookingNo}</p>
									<p>酒店名稱: {#HotelName}</p>
									<p>客戶姓名: {#GuestName}</p>
									<p>入住日期: {#CheckIn}　　　退房日期: {#CheckOut}</p>
									<p>房間類型: {#RoomType}</p>
									<p><a href='{#Url}'>更多詳細信息</a></p>
									<hr style='color:orange'/>
									<p>非常感謝您使用我們的服務。</p>
									<br/><br/><br/><br/><br/><br/><br/><br/>
									<p>非常感謝。<br/>TAS-AGENT.COM 團隊</p>";
	$message[7][3][4] = "			
	                                <p>{#AgentName}様</p>
									<p>ご指示通り、ご予約をキャンセルにしました。</p>
									<hr style='color:orange'/>
									<p>エージェント名: {#AgentName}</p>
									<p>予約番号: {#BookingNo}</p>
									<p>ホテル名: {#HotelName}</p>
									<p>ゲスト名: {#GuestName}</p>
									<p>チェックイン: {#CheckIn}　　　チェックアウト: {#CheckOut}</p>
									<p>ルームタイプ: {#RoomType}</p>
									<p><a href='{#Url}'>詳細情報</a></p>
									<hr style='color:orange'/>
									<p>TAS-Agentをご利用頂きありがとうございました。</p>
									<br/><br/><br/><br/><br/><br/><br/><br/>
									<p>宜しくお願い致します。<br/>TAS-AGENT.COM チーム</p>";
	$message[7][4][4] = "<hr style='color:orange'/>
									<p>エージェント名: {#AgentName}</p>
									<p>予約番号: {#BookingNo}</p>
									<p>ホテル名: {#HotelName}</p>
									<p>ゲスト名: {#GuestName}</p>
									<p>チェックイン: {#CheckIn}　　　チェックアウト: {#CheckOut}</p>
									<p>ルームタイプ: {#RoomType}</p>
									<p><a href='{#Url}'>詳細情報</a></p>
									<hr style='color:orange'/>";
	
	$message[10][5][1] = "<div style='font-family: MS PGothic; font-size:12px'>
{#HotelName}<br/>{#UserName}<br/><br/>
Please check this booking from TAS-Agent.com。<br/><br/>

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
</div>";

	$message[10][5][2] = "<div style='font-family: MS PGothic; font-size:12px'>
{#HotelName}<br/>{#UserName} 您好<br/><br/>
感谢您使用TAS-Agent.com。<br/>以下是向贵酒店下的订单。<br/><br/>

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
</div>";

	$message[10][5][3] = "<div style='font-family: MS PGothic; font-size:12px'>
{#HotelName}<br/>{#UserName} 您好<br/><br/>
感謝您使用TAS-Agent.com。<br/>　以下是向貴酒店下的訂單。<br/><br/>

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
</div>";


	$message[10][5][4] = "<div style='font-family: MS PGothic; font-size:12px'>
{#HotelName}<br/>宿泊手配ご担当者 様<br/><br/>
いつもお世話になっております。<br/>TAS-Agent.comです。<br/>下記の予約をお願いいたします。<br/><br/>

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
</div>";
	
	$emailTail = "<div style='border-bottom:1px dashed #000000;width=450;'></div>
<p><img width='154' style='margin-top:20;' alt='TAS-AGENT' src='http://tas-agent.com/themes/default/img/logo.jpg'/></p>
<div style='font-family: MS PGothic; font-size:12px'>
TAS-Agent.com (株式会社ティ･エ･エス)<br/>東京都中央区銀座 8-15-2 Wave Ginza 8F<br/>電話：81-3-5565-5850<br/>ファックス：81-3-5565-5855<br/>メール: booking@tas-agent.com<br/><br/>
<div style='border-bottom:1px dashed #000000;width=450;'></div>
<p>* Please consider the environment before printing this e-mail.</p>
</div>";
	
	$faxHead[10] = "新規予約申し込み";

	$faxHead[11] = "変更申し込み";

	$faxHead[12] = "キャンセル申し込み";

	$faxTail = "<hr style='color:orange'/>
<div style='float:left; margin: 0px 20px 10px 10px'><img alt='TAS-AGENT' src='http://tas-agent.com/themes/default/img/bottom_logo.jpg'/></div>
<div style='font-family: MS PGothic; font-size:12px'>
	TAS Agent / TAS Co.,Ltd<br/>
	TEL 03-5565-5850<br/>
	FAX: 03-5565-5850<br/>
	<a href='booking@tas-agent.com'>booking@tas-agent.com</a><br/>
	<br/>
	<p>※TAS Agent はTAS Co.,Ltdが運営しております。　上記予約の内容については直接TASまでご連絡ください。</p>
</div>
</body>
</html>";
//fax
$message[21][5][1] = "<div style='font-family: MS PGothic; font-size:12px'>
{#HotelName}<br/>{#UserName}<br/><br/>
Please check this booking from TAS-Agent.com。<br/><br/>

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
</div>";

$message[21][5][2] = "<div style='font-family: MS PGothic; font-size:12px'>
{#HotelName}<br/>{#UserName} 您好<br/><br/>
感谢您使用TAS-Agent.com。<br/>以下是向贵酒店下的订单。<br/><br/>

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
</div>";

$message[21][5][3] = "<div style='font-family: MS PGothic; font-size:12px'>
{#HotelName}<br/>{#UserName} 您好<br/><br/>
感謝您使用TAS-Agent.com。<br/>　以下是向貴酒店下的訂單。<br/><br/>

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
</div>";


$message[21][5][4] = "
	    	<table  width=190>
	    	   <tr><td width=5></td><td colspan=2 size=10 font-weight:bold></td></tr>
				<tr><td colspan=2 size=12 font-weight:bold>{#HotelName}<br/>宿泊手配ご担当者 様</td></tr>
				<tr></td><td colspan=2 size=12 font-weight:bold>いつもお世話になっております。<br/>TAS-Agent.comです。<br/>下記の予約をお願いいたします。<br/></td></tr>
			</table>
	    	<table  width=190>
	    		<tr><td size=12 >1.</td><td colspan=2 size=12 font-weight:bold>Customer Information(お客様情報)</td></tr>
				<tr><td size=3></td>
				<tr><td width=5></td><td size=10>Booking ID(予約番号): {#BookingNo}</td><td>Guest Name(お客様　氏名): {#ContactName}</td></tr>
				<tr><td width=5></td><td size=10>E-mail:  {#ContactEmail}</td><td>Tel: {#ContactTel}</td></tr>
			</table>

	    	<table  width=190>
	    		<tr><td size=12 >2. </td><td colspan=2 size=12 >Booking Information(予約情報)</td></tr>
				<tr><td size=3></td>
				<tr><td width=5></td><td  size=10>Check In : {#CheckIn}</td><td>Check Out : {#CheckOut}</td></tr>
				<tr><td width=5></td><td colspan=2 size=10>Total No or rooms:  {#RoomString}</td></tr>
			</table>

		    <table  width=190>
		        <tr><td width=5></td><td size=12 >Rooming Details(宿泊情報)</td></tr>
		    </table>
            {#RoomList}
	    	<table width=190>
	    		<tr><td size=12 >3.</td><td colspan=2 size=12 >Agent Information(旅行会社情報)</td></tr>
	    		<tr><td size=3></td>
				<tr><td width=5></td><td size=10>Name: {#AgentName} </td></tr>
				<tr><td width=5></td><td  size=10>Phone no: {#AgentPhoneNo}</td><td>Email: {#AgentEmail}</td></tr>
			</table>
			";


	$subject = array();
	
	$subject[2][3][1] = "Please wait for checking room availability for Booking No:{#BookingNo}";
	$subject[2][3][2] = "我们正在确认您所预订的房间（订单编号：{#BookingNo}）是否可以入住，请耐心等待";
	$subject[2][3][3] = "我們正在確認您所預訂的房間（訂單編號：{#BookingNo}）是否可以入住。請耐心等待";
	$subject[2][3][4] = "ご予約したルーム（予約番号：{#BookingNo}）の入居可否を確認しています。暫くお待ちしてください";
	
	$subject[2][4][4] = "予約番号{#BookingNo} の空き室確認が必要です。";
	
	$subject[3][3][1] = "for Booking No:{#BookingNo} is now confirmed";
	$subject[3][3][2] = "订单编号：{#BookingNo}的订单已经确认可以入住";
	$subject[3][3][3] = "訂單編號：{#BookingNo}的訂單已經確認可以入住";
	$subject[3][3][4] = "予約番号：{#BookingNo}のご予約が入居可能です。";
	
	$subject[3][4][4] = "Your Booking is confirmed.Booking No:{#BookingNo}";
	$subject[3][4][4] = "您的订单（编号：{#BookingNo}）已经确认可以入住";
	$subject[3][4][4] = "您的訂單（編號：{#BookingNo}）已經確認可以入住";
	$subject[3][4][4] = "予約番号：{#BookingNo}のご予約は入居可能です.";
	
	$subject[4][3][1] = "Thank you for your payment";
	$subject[4][3][2] = "感谢您的付款";
	$subject[4][3][3] = "感謝您的付款";
	$subject[4][3][4] = "ご入金頂きありがとうございます";
	
	$subject[4][4][4] = "予約番号: {#BookingNo}　入金されました。";
	
	$subject[5][3][1] = "Your booking for Booking no: {#BookingNo} has been fully booked";
	$subject[5][3][2] = "非常抱歉，因为已经满员，您所预订的房间（订单编号：{#BookingNo}）无法入住";
	$subject[5][3][3] = "非常抱歉，因為已經滿員，您所預訂的房間（訂單編號：{#BookingNo}）無法入住";
	$subject[5][3][4] = "予約番号:{#BookingNo}の予約は満室の為、予約不可。";
	
	$subject[5][4][1] = "Booking no: {#BookingNo} is fully booked。";
	$subject[5][4][2] = "因为已经订满，订单编号：{#BookingNo}的订单无法入住";
	$subject[5][4][3] = "因為已經訂滿，訂單編號：{#BookingNo}的訂單無法入住";
	$subject[5][4][4] = "予約番号:{#BookingNo}の予約は満室の為、予約不可。";
	
	$subject[8][3][1] = "Your booking has expired";
	$subject[8][3][2] = "订单已经变成“expired”";
	$subject[8][3][3] = "訂單已經變成“expired”";
	$subject[8][3][4] = "ご予約がexpiredになりました。";
	
	$subject[8][4][1] = "Booking No.{#BookingNo} is expired";
	$subject[8][4][2] = "订单编号：{#BookingNo}的订单已经“expired”";
	$subject[8][4][3] = "訂單編號：{#BookingNo}的訂單已經“expired”";
	$subject[8][4][4] = "予約番号：{#BookingNo}の予約が「expired」になりました";
	
	$subject[7][3][1] = "Your booking has been cancelled by request";
	$subject[7][3][2] = "订单已经被取消";
	$subject[7][3][3] = "訂單已經被取消";
	$subject[7][3][4] = "ご予約がキャンセルされました。";
	
	$subject[7][4][4] = "予約番号：{#BookingNo} の予約はagentにキャンセルされました。";

	$subject[10][5][1] = "<TAS-Agent.com> 新規予約申し込み : Booking ID(予約番号): {#BookingNo} ";
	$subject[10][5][2] = "<TAS-Agent.com> 新建订单 : Booking ID(订单编号): {#BookingNo} ";
	$subject[10][5][3] = "<TAS-Agent.com> 新建訂單: Booking ID(訂單編號): {#BookingNo} ";
	$subject[10][5][4] = "<TAS-Agent.com> 新規予約申し込み: Booking ID(予約番号): {#BookingNo} ";
	
	$subject[11][5][1] = "<TAS-Agent.com> 変更申し込み: Booking ID(予約番号): {#BookingNo} ";
	$subject[11][5][2] = "<TAS-Agent.com> 订单变更: Booking ID(订单编号): {#BookingNo} ";
	$subject[11][5][3] = "<TAS-Agent.com> 訂單變更: Booking ID(訂單編號): {#BookingNo} ";
	$subject[11][5][4] = "<TAS-Agent.com> 変更申し込み: Booking ID(予約番号): {#BookingNo} ";
	
	$subject[12][5][1] = "<TAS-Agent.com> cancalled: Booking ID(予約番号): {#BookingNo} ";
	$subject[12][5][2] = "<TAS-Agent.com> 订单取消: Booking ID(订单编号): {#BookingNo} ";
	$subject[12][5][3] = "<TAS-Agent.com> 訂單取消: Booking ID(訂單編號): {#BookingNo} ";
	$subject[12][5][4] = "<TAS-Agent.com> キャンセル申し込み: Booking ID(予約番号): {#BookingNo} ";	
?>