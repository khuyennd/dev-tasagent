<?php
/*
* 2012 TAS
*/
if (! defined ( 'IN_TAS' )) {
	exit ( 'Access Denied' );
}
class BookingConfirmController extends FrontController {
	
	public function __construct() {
		$this->php_self = "booking_confirm.php";
		
		parent::__construct ();
	}
	
	public function preProcess() {
		
		parent::preProcess (); 
		
		if ($_REQUEST ['booking'] == 'view') { //如果是查看订单
			$orderId = $_GET ['oid']; //获取订单编号
            if ($_REQUEST ['voucher'])
                self::$smarty->assign ( "voucher", $_REQUEST ['voucher'] );
			$error = Booking::checkUserCanViewOrder ( self::$cookie->UserID, self::$cookie->RoleID, $orderId ); //查看用户是否可以查看订单
		} else { // other(build booking info from post variable for edit, confirm, finish)	//或者是查看发票，或者是查看详细信息，或者是保存
			$orderId = $_POST ['order_id'];
			$error = Booking::checkUserCanEditOrder ( self::$cookie->UserID, self::$cookie->RoleID, $orderId );
		}
		
		if ($error ['no'] > 0) {
			self::$smarty->assign ( "error", $error );
			self::$smarty->display ( _TAS_THEME_DIR_ . 'error_redirect.tpl' );
			exit ();
		}

        if ($_REQUEST ['booking'] == 'view') { // view page
            $this->brandNavi[] = array("name"=>"Booking List", "url"=>'booking_list.php');
            $booking_info = Booking::getBookingInfo ( $_GET ['oid'] );
            
            if (!$booking_info) {
                $booking_info = Booking::getBookingInfo_del($_GET ['oid']);
                if (!$booking_info) {
                    $error['no'] = 3;
                    $error['message'] = 'There is no exist booking info';
                    self::$smarty->assign("error", $error);
                    self::$smarty->display(_TAS_THEME_DIR_ . 'error_redirect.tpl');
                    exit ();
                }
            }

            $this->brandNavi[] = array("name"=>"Booking No:".$booking_info['BookingNo'], "url"=>'booking_confirm.php?booking=view&oid='.$booking_info['order_id'], "nolang" =>1);

            if ($_REQUEST ['payment']) 
                self::$smarty->assign ( "payment", $_REQUEST ['payment'] );

            self::$smarty->assign ( "method", 'view' );
            self::$smarty->assign ( "booking_info", $booking_info );
            self::$smarty->assign ( "payment_currency", DEFAULT_PAYMENT_CURRENCY );
            self::$smarty->assign ( "mail_address", DEFAULT_EMAIL_ADDRESS);
            self::$smarty->assign ( "env", DEFAULT_ENV );
            self::$smarty->assign ( "return_url", RETURN_URL );
            self::$smarty->assign ( "notify_url", NOTIFY_URL);

        }
	}
	
	/* Booking confirm page main function
	 *
	 * user access this page four method.
	 *	1) from booking_order.php(booking new order), user can access confirm page. url : booking_confirm.php?booking=confirm
	 *	2) from self confirm page, user can submit finish. The new booking order will be inserted. url : booking_confirm.php?booking=finish
	 *	3) from booking_order.php(edit page), user can edit self booking order. 
	 *		We will save booking order and redirect url. url : booking_confirm.php?booking=save
	 *  4) from booking_list.php, user can view booking order. url : booking_confirm.php?booking=view&oid=[order id]
	 *
	 * @author zotiger
	 * @created 2012-11-08
	 */
	public function process() {
		global $cookie;
		
		if ($_POST ["booking"] != 'confirm' && $_POST ["booking"] != 'calculate' && $_REQUEST ['booking'] != 'view' && $_POST ['booking'] != 'payment' && $_POST ["booking"] != 'finish' && $_POST ["booking"] != 'save') {
			Tools::redirect ( 'index.php' );
		}
		if ($_REQUEST ['booking'] == 'view') { // view page
			
			if ( $_REQUEST['vouch_info'] == 1 || $_REQUEST['savepdf'] == 1) {
				$orderId = $_GET ['oid']; //获取订单编号
				if ($_REQUEST['savepdf'] ==1 )
					$booking_info = Booking::getBookingInfo ( $_GET ['oid'], "en" ); 
				else $booking_info = Booking::getBookingInfo ( $_GET ['oid'] );
				$booking_info['agent_info'] = new Member($booking_info['OrderUserId']);
				
				// make string of  "Total No or rooms"
				$_rooms = Array(); 
				foreach ($booking_info ['booked_roomplan_list'] as $roomplan) {
					if ($_rooms[$roomplan[RoomPlanId]]) 
						$_rooms[$roomplan[RoomPlanId]]['count']++;
					else {
						$_rooms[$roomplan[RoomPlanId]]['count'] = 1;
						$_rooms[$roomplan[RoomPlanId]]['name'] = $roomplan[RoomPlanName];
					}  
				}
				$_roomsString = "";
				foreach ($_rooms as $_room) {
					if ($_roomsString != "") $_roomsString .= "& ";
					$_roomsString .= $_room['count']. " ". $_room['name'];
				}
				$booking_info['roomString'] = $_roomsString;
				if ($_REQUEST['savepdf'] ==1 ) {
					$this->printPDF($booking_info);
					exit();
				} else  self::$smarty->assign ( "booking_info", $booking_info );
			} 
            // move the engine to preprocess function
            /*
			$booking_info = Booking::getBookingInfo ( $_GET ['oid'] );
			if (! $booking_info)
				Tools::redirect ( 'index.php' );
			if ($_REQUEST ['payment'])
				self::$smarty->assign ( "payment", $_REQUEST ['payment'] );
			self::$smarty->assign ( "method", 'view' );
            */
		} else { // other(build booking info from post variable for edit, confirm, finish)
			$booking_info = Booking::buildBookingInfoFromPost ( self::$cookie->CompanyID );

			self::$smarty->assign ( "method", 'order' );

            self::$smarty->assign ( "booking_info", $booking_info );


            foreach ($booking_info['booked_roomplan_list'] as $bi) {
                //echo $bi['Check_0'];
                if ($bi['Check_0'] == '0') {
                    $error['message'] = "満室のためご希望の日程には変更できません";
                    self::$smarty->assign("error", $error);
                    self::$smarty->display(_TAS_THEME_DIR_ . 'error_redirect.tpl');
                    exit();
                }
            }
            //p($booking_info['booked_roomplan_list']);
		}
		
		if ($_POST["booking"] == 'calculate') {
			$checkin = $_POST['checkin'];	//获取checkin的值
			$checkout = $_POST['checkout'];	//获取checkout的值
			//获取roomPlanId
			$ids = $_POST ['ids'];	
			$rpid_list = array ();
			foreach ( $ids as $id ) {
				$rpid_list [] = $_POST ['roomplan_ids_' . $id];
			}
			//计算房间数量是否满足条件,如果有一条不满足则发出错误报告
			$roomplan_list = RoomPlan::getRoomPlanListForBooking ( $rpid_list, $checkin, $checkout );
			
			$plan_list = array();
	        foreach($roomplan_list as $record) {
	            $plan_list[$record['RoomPlanId']] = $record;
	        }
	        
			//查看是否有房间不满足条件
			$isOk = true;
			foreach($rpid_list as $rpid) {
	          	if (empty($plan_list[$rpid])) {
	          		$isOk = false;
	          		break;
	          	}
	        }
			
			if (!$isOk) {
				$error['message'] = "There is not any room as requested";
				self::$smarty->assign ( "error", $error );
				self::$smarty->display ( _TAS_THEME_DIR_ . 'error_redirect.tpl' );
				exit();
			}
			
			self::$smarty->assign("countries", Tools::getCountries());
			self::$smarty->assign ( "method", 'edit' );	
		}
		
		//添加修改的情况
		if ($_POST ["booking"] == 'save') {
			
			if ($booking_info ['order_id'] == 0) {	//如果订单ID没有，则报错
				$error['message'] = "订单编号不存在";
				self::$smarty->assign ( "error", $error );
				self::$smarty->display ( _TAS_THEME_DIR_ . 'error_redirect.tpl' );
				exit();
			}

			$checkin = $_POST['checkin'];	//获取checkin的值
			$checkout = $_POST['checkout'];	//获取checkout的值
			//获取roomPlanId
			$ids = $_POST ['ids'];	
			$rpid_list = array ();
			foreach ( $ids as $id ) {
				$rpid_list [] = $_POST ['roomplan_ids_' . $id];
			}
			//计算房间数量是否满足条件,如果有一条不满足则发出错误报告
			$roomplan_list = RoomPlan::getRoomPlanListForBooking ( $rpid_list, $checkin, $checkout );
			
			$plan_list = array();
	        foreach($roomplan_list as $record) {
	            $plan_list[$record['RoomPlanId']] = $record;
	        }
	        
			//查看是否有房间不满足条件
			$isOk = true;
			foreach($rpid_list as $rpid) {
	          	if (empty($plan_list[$rpid])) {
	          		$isOk = false;
	          		break;
	          	}
	        }
			
			if (!$isOk) {
				$error['message'] = "There is not any room as requested";
				self::$smarty->assign ( "error", $error );
				self::$smarty->display ( _TAS_THEME_DIR_ . 'error_redirect.tpl' );
				exit();
			}

			$booking_info ['paymentMethod'] = Member::getPaymentMethod ( self::$cookie->CompanyID );//获取支付方式，是前支付还是后支付
			
			$order_id = Booking::modifyBooking ( $booking_info );
			
			if (empty($order_id)) {
				$error['message'] = "修改失败, 您修订的房间信息不存在。";
				self::$smarty->assign ( "error", $error );
				self::$smarty->display ( _TAS_THEME_DIR_ . 'error_redirect.tpl' );
			} else {
				//下订单成功,此时需要发送邮件
				Tools::ordermail($order_id);
				Tools::emailHotel($order_id, 11);
				Tools::redirect ( 'booking_list.php' );	
			}
			exit();
		}
			
		if ($_POST ["booking"] == 'finish') {		//  $_POST ["booking"] == 'save'
			if ($booking_info ['order_id'] == 0)
				$booking_info ['OrderUserId'] = self::$cookie->UserID;	//获取用户ID
			
			$booking_info ['paymentMethod'] = Member::getPaymentMethod ( self::$cookie->CompanyID );
			$order_id = Booking::insertNewBooking ( $booking_info );
			if ($order_id) {
				$booking_info = Booking::getBookingInfo ( $order_id );
				//下订单成功,此时需要发送邮件
				Tools::ordermail($order_id);
				Tools::emailHotel($order_id, 10);
			} else {
				$error ['message'] = "Booking has time out!";
				self::$smarty->assign ( "error", $error );
				self::$smarty->display ( _TAS_THEME_DIR_ . 'error_redirect.tpl' );
				exit ();
			}
			//$booking_info = Booking::getBookingInfo ( $order_id );
			self::$smarty->assign ( "booking_info", $booking_info );
			
			//if ($_POST ["booking"] == 'save')
			//	Tools::redirect ( 'booking_list.php' );
		}
		
		if ($_POST ['booking'] == 'payment') { //支付接口调用
			$url = "http://localhost/payment.php"; //支付站点网址
			
			$ch = curl_init ();
			curl_setopt ( $ch, CURLOPT_URL, $url );
			curl_exec ( $ch ); //$content = 
			$response = curl_getinfo ( $ch );
			curl_close ( $ch );
			
			if ($response ['http_code'] == 200) { //判断是否支付成功,此处只是模拟使用	
				Booking::changeBookingStatus ( $booking_info ['order_id'], 4 );
				Booking::changePayStatus ( $booking_info ['order_id'], 2 );
				Booking::payment ( $booking_info ['order_id'], $_POST['money'] );
				//下订单成功,此时需要发送邮件
				Tools::ordermail($order_id);
			} else { //模拟支付失败的情况
				$error = array ();
				$error ['message'] = 'sorroy charge fail';
				self::$smarty->assign ( "error", $error );
				self::$smarty->display ( _TAS_THEME_DIR_ . 'error_redirect.tpl' );
				exit ();
			}
		}
		
		parent::process ();
	}
	
	public function setMedia() {
		parent::setMedia ();
	
	}
	public function displayContent() {
		parent::displayContent ();
		
		if ($_POST ["booking"] == 'finish') {
			self::$smarty->display ( _TAS_THEME_DIR_ . 'booking_finish.tpl' );
		} else if ($_POST ["booking"] == 'payment') {
			self::$smarty->display ( _TAS_THEME_DIR_ . 'paymentsuccess.tpl' );
		} else if ($_POST ["booking"] == 'calculate') { 
			self::$smarty->display ( _TAS_THEME_DIR_ . 'booking_order.tpl' );
		} else{ // view
			if ($_REQUEST ['voucher'])
				self::$smarty->display ( _TAS_THEME_DIR_ . 'booking_confirm_voucher.tpl' );
			else if ($_REQUEST['vouch_info'])  {
				self::$smarty->display ( _TAS_THEME_DIR_ . 'hotelvoucher.tpl' );
			}
			else 	self::$smarty->display ( _TAS_THEME_DIR_ . 'booking_confirm.tpl' );
		}
	}
	
	public function printPDF($booking_info) {
		require_once(_TAS_TOOL_DIR_. "/tfpdf/pdftable.inc.php");

	
		$title = "Voucher";
			
			
		$defFont = 'MyFont';	
		$pdf = new PDFTable();
		/*switch (self::$cookie->LanguageID) {
		case 1: 
			//...English
		*/
			$pdf->AddFont($defFont,'','ARIALUNI.TTF',true);
			//...$pdf->AddFont($defFont.'B','','ARIALUNI.TTF',true);
			$pdf->AddFont($defFont.'B','','ARIALUNI.TTF',true);
			/*break;
		case 2: 
			//...China(GB2312)
			$pdf->AddFont($defFont,'','SIMSUN.TTF',true);
			$pdf->AddFont($defFont.'B','','SIMSUNB.TTF',true);
			break;
		case 3:
			//...China(GBK)
			$pdf->AddFont($defFont,'','MINGLIU.TTF',true);
			$pdf->AddFont($defFont.'B','','MINGLIUB.TTF',true);
			break;
		case 4:
			//...Japan
			$pdf->AddFont($defFont,'','MSGOTHIC.TTF',true);
			$pdf->AddFont($defFont.'B','','MSGOTHICB.TTF',true);
			break;
		};*/
		
		$pdf->SetCreator("Hotel");
		$pdf->SetAuthor("Hotel");
		$pdf->SetTitle("Hotel");
		$pdf->SetSubject("Hotel", true);
		
		$pdf->SetMargins(10,2, 0, 20);
		$pdf->SetDrawColor(0,0,0);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetPadding(0);
		$pdf->SetSpacing(0,0);
		
		
		$pdf->AddPage();
		$pdf->SetFont($defFont,'',20);

		$pdf->SetHeaderFooter("header", "footer");
		
	    $pdf->Ln(3);		
		$pdf->SetFont($defFont,'',10,true);
		$pdf->htmltable("
	    	<table width=190>
				<tr><td size=12>Hotel: {$booking_info['hotel_info']['HotelName']}</td></tr>
			</table>");	
		$pdf->Ln(-2);
		$pdf->htmltable("
	    	<table width=190>
				<tr><td size=12>Address: {$booking_info['hotel_info']['HotelAddress']}</td></tr>
			</table>");	
		$pdf->Ln(-2);		
		$pdf->htmltable("
	    	<table width=190>
				<tr><td size=12>Hotel Contact No: {$booking_info['hotel_info']['HotelContactNo']}</td></tr>
			</table>");
		$pdf->Ln(5);	
		
		$pdf->SetFont($defFont,'',8,true);
		$pdf->htmltable("
	    	<table  width=190>
	    		<tr><td size=10 family={$defFont}B>1.</td><td colspan=2 size=10 font-weight:bold>Customer Information(お客様情報)</td></tr>    		    		
				<tr><td size=3></td>
				<tr><td width=5></td><td width=80>Booking ID(予約番号): {$booking_info['BookingNo']}</td>				<td>Guest Name(お客様　氏名): {$booking_info['contact_name']}</td></tr>
				<tr><td width=5></td><td width=80>E-mail: {$booking_info['contact_email']}</td>				<td>Tel: {$booking_info['contact_tel']}</td></tr>
			</table>");
		$pdf->Ln(3);
		
		$pdf->htmltable("
	    	<table  width=190>
	    		<tr><td size=10 family={$defFont}B>2. </td><td colspan=2 size=10 family={$defFont}B>Booking Information(予約情報)</td></tr>
				<tr><td size=3></td>
				<tr><td width=5></td><td width=80>Check In : {$booking_info['checkin']}</td>				<td>Check Out : {$booking_info['checkout']}</td></tr>
				<tr><td width=5></td><td colspan=2>Total No or rooms:  {$booking_info['roomString']}</td></tr>
			</table>");
		$pdf->Ln(3);
		
		$pdf->htmltable("
		<table  width=190>
		        <tr><td width=5></td><td size=10 family={$defFont}B>Rooming Details(宿泊情報)</td></tr>
		    </table>");
			
		$i = 0;
		foreach ($booking_info['booked_roomplan_list'] as $roomplan) {
			$i++; $customer_count = count($roomplan['customer_info_list']);
			$customer_names = "";
			foreach ($roomplan['customer_info_list'] as $customer) {
				if ($customer_names != "") $customer_names .= " ,  "; 
				$customer_names .= ($customer['customer_sex'] == 1? "Mr ":"Mrs ").$customer['customer_fnames']. " ". $customer['customer_gnames']. " (".$customer['customer_country_name'].")"; 
			}
			$breakfast = ($roomplan['Breakfast'] ==1) ? "Included" : "None";
			$Dinner = ($roomplan['Dinner'] ==1) ? "Included" : "None";
			$special = "";
			if ($roomplan['req_nonsmoking']==1) $special .="Non Smoking, ";
			if ($roomplan['req_smoking']==1) $special .="Smoking, ";
			if ($roomplan['req_adjoin']==1) $special .="Adjoin room, "; 
			$special .= $roomplan['req_remark'];
		$pdf->htmltable("
	    	<table  width=190>
	    		<tr><td width=5></td><td size=8 family={$defFont}B>- Room {$i}</td></tr>
	    		<tr><td width=5></td><td>Room Plan(宿泊プラン): {$roomplan['RoomPlanName']}</td></tr>
				<tr><td width=5></td><td width=80>Room Type(ルームタイプ): {$roomplan['RoomTypeName']}</td>				<td>no of pax stay at room: {$customer_count}</td></tr> 
			</table>");
		$pdf->htmltable("
			<table width=190>
				<tr><td width=5></td><td>Guest Name(宿泊者名): {$customer_names}</td></tr>
			</table>
		");
		$pdf->htmltable("
			<table width=190>
				<tr><td width=5></td><td width=80>Breakfast(朝食): {$breakfast}</td>			<td>Dinner(夕食): {$Dinner}</td></tr>
				<tr><td width=5></td><td colspan=2>Special Request(特別リクエスト): {$special}</td></tr>
				<tr><td width=5></td><td size=8>* All Special request are subjects to availability</td></tr>
			</table>");
		$pdf->Ln(2);
		
		if ($i % 4 == 0) $pdf->AddPage();
	  }	
		
		$pdf->htmltable("
	    	<table width=190>
	    		<tr><td size=10 family={$defFont}B>3.</td><td colspan=2 size=10 family={$defFont}B>Agent Information(旅行会社情報)</td></tr>
	    		<tr><td size=3></td>
				<tr><td width=5></td><td>Name: {$booking_info['agent_info']->Name}</td></tr>
				<tr><td width=5></td><td width=80>Phone no:  {$booking_info['agent_info']->Tel}</td>				<td>Email: {$booking_info['agent_info']->Email}</td></tr>
			</table>");
		$pdf->Ln(2);
		$pdf->htmltable("<table width=190><tr><td> Note: <br>
			-This voucher must be presented during check in. Failure to　do so may result in the reservation not being honored.<br> 
			-Hotel has right a right to request credit card or deposit upon arrival to cover and guaranteed any incidental cost that maybe incurred during the stay.<br>
			-If you expect to arrive after 21:00, please inform the hotel your arrival time to avoid being released. In the event of No show or Early check-out, the hotel reserves right to charge a full cancellation fee.<br> 
			-In case where Breakfast is included with the room rate, please note that certain hotels may charge extra for children travelling with their parents. If applicable, the hotel will bill you directly. Upon arrival, if you have any question, please verify with hotel.<br>
		</td></tr></table>");
		
		
	
		$pdf->Output("voucher.pdf","D");
	}
}
