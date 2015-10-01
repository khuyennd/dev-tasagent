<?php
/*
* 2012 TAS
*/
if (! defined ( 'IN_TAS' )) {
	exit ( 'Access Denied' );
}
class BookingListController extends FrontController {
	protected $searchField = array ('BookingNo' => 'like', 'ManagingDirector' => 'like', 'CompanyName' => 'like', 'PayStatus' => '=' );
	
	public function __construct() {
		$this->php_self = "booking_list.php";
		
		parent::__construct ();
	}
	public function preProcess() { 
		if (! Tools::hasFunction ( 'booking_list' ))
			Tools::redirect ( 'index.php' );
        if (Tools::getValue("settle") == 1) {
            $this->brandNavi [] = array("name" => "Settlement", "url" => 'booking_list.php?settle=1');
        } else {
            $this->brandNavi [] = array("name" => "Booking List", "url" => $this->php_self);
        }
		
		if (Tools::isSubmit ( "change_pay" )) {
			$id = ( int ) Tools::getValue ( "id" );
			$status = ( int ) Tools::getValue ( "status" );
			Booking::changePayStatus ( $id, $status );
			if ($status == 2)  {
				Booking::changeBookingStatus ( $id, 10 ); // Successed
				Booking::payment( $id, $_POST['money']);	//给otherPrice值
			}
			exit ();
		} else if (Tools::isSubmit ( "change_status" )) {
			$id = ( int ) Tools::getValue ( "id" );
			$status = ( int ) Tools::getValue ( "status" );
			$roleid = self::$cookie->RoleID;

            if( $status == 7){
                $bookingInfo = Booking::getBookingInfo($id);
                $checkin = $bookingInfo['checkin'];
                $nights = $bookingInfo['nights'];
                $roomplan_list = array();
                foreach($bookingInfo['booked_roomplan_list'] as $booked_roomplan_list) {
                    $roomplan_list[] = $booked_roomplan_list['RoomPlanId'];
                }
                Stock::updateAmountStock($checkin, $nights, $roomplan_list);
            }
            
			Booking::changeBookingStatus ( $id, $status );
			exit ();
		}
	}
	public function process() {
		global $cookie;
		$iso = Language::getIsoById((int)$cookie->LanguageID);

		parent::process ();
		
		$swhere = parent::getSearchWhere ();
		if ($swhere == "")
			$swhere .= " 1 = 1 ";
		if (Tools::getValue ( "HotelName" ) != "") {
			$swhere .= " AND HotelName_".$iso." like '" . Tools::getValue ( "HotelName" ) . "'";
		}

		$OrderStatusId = Tools::getValue("OrderStatusId");
		if (!empty($OrderStatusId)) {
			if (self::$cookie->RoleID != 1) {
				if (Tools::getValue( "OrderStatusId" ) == 4) {
					$swhere .= " AND OrderStatusId in ('4', '10') ";	
				} else {
					$swhere .= " AND OrderStatusId = '" . Tools::getValue ( "OrderStatusId" ) . "'";
				}
			}
			else
			{
				if (Tools::getValue( "OrderStatusId" ) == 3) {
					$swhere .= " AND OrderStatusId in ('3','4','8','9','10') ";	
				} else {
					$swhere .= " AND OrderStatusId = '" . Tools::getValue ( "OrderStatusId" ) . "'";
				}
			}
		}

		if (Tools::getValue ( "CheckInDate" ) != "") {
			$swhere .= " AND CheckInDate = '" . Tools::getValue ( "CheckInDate" ) . "'";
		}
		if (Tools::getValue ( "CheckOutDate" ) != "") {
			$swhere .= " AND CheckOutDate <= '" . Tools::getValue ( "CheckOutDate" ) . "'";
		}
		if (Tools::getValue ( "DueDate" ) != "") {
			$swhere .= " AND DATE_SUB(CheckOutDate,INTERVAL 5 DAY)  = '" . Tools::getValue ( "DueDate" ) . "'";
		}

        if (Tools::getValue("CheckInDateFrom") != "") {
            $CheckInDateFrom=Tools::getValue("CheckInDateFrom");
            $swhere .= " AND CheckInDate >= '" . Tools::getValue("CheckInDateFrom") . "'";
        }
        if (Tools::getValue("CheckInDateTo") != "") {
            $CheckInDateTo=Tools::getValue("CheckInDateTo");
            $swhere .= " AND CheckInDate <= '" . Tools::getValue("CheckInDateTo") . "'";
        }
        if ((Tools::getValue("CheckInDateFrom") == "" || Tools::getValue("CheckInDateTo") == "") && self::$cookie->RoleID == 1) {
            $CheckInDateTo = date("Y-m-d");
            $CheckInDateFrom = date("Y-m-d", mktime(0, 0, 0, date("m") - 2, date("d"), date("Y")));
            $swhere .= " AND '{$CheckInDateFrom} 00:00:00' <= OrderedDate AND OrderedDate <= '{$CheckInDateTo} 23:59:59'";
        }
        if (self::$cookie->RoleID != 1) {
            if (Tools::getValue("OrderEndDate") != "")
                $OrderEndDate = Tools::getValue("OrderEndDate");
            else $OrderEndDate = date("Y-m-d");
            if (Tools::getValue("OrderStartDate") != "")
                $OrderStartDate = Tools::getValue("OrderStartDate");
            else $OrderStartDate = date("Y-m-d", mktime(0, 0, 0, date("m") - 2, date("d"), date("Y")));
            //$swhere .= " AND '{$OrderStartDate} 00:00:00' <= OrderedDate AND OrderedDate <= '{$OrderEndDate} 23:59:59'";
        }
		$paymentMethod = 1;
		if (self::$cookie->RoleID == 3) {
			$swhere .= " AND HT_Company.CompanyId = " . self::$cookie->CompanyID;
			$paymentMethod = Member::getPaymentMethod ( self::$cookie->CompanyID );
		} else if (self::$cookie->RoleID == 2) {
			$swhere .= " AND OrderUserId = " . self::$cookie->UserID;
			$paymentMethod = Member::getPaymentMethod ( self::$cookie->CompanyID );
		} else if (self::$cookie->RoleID == 1) {
			$swhere .= " AND HT_Hotel.HotelId = " . self::$cookie->HotelID;
			$paymentMethod = Member::getPaymentMethod ( self::$cookie->CompanyID );
		}
		
		$settle = Tools::getValue ( "settle" );
		if ($settle == 1) {
			$swhere .= " AND (OrderStatusId = 3 OR OrderStatusId = 4)";
		}
		
		$bookingCount = Booking::getBookingCount ( $swhere );
		$this->pagination ( $bookingCount );
		$bookingList = Booking::getBookingList ( $swhere, $this->p, $this->n );
		
		foreach ($bookingList as $key => $value) {
			if (self::$cookie->RoleID > 3) {
				if ($value['CheckInDate'] >= date('Y-m-d'))
					$bookingList[$key]['isCancell'] = 1;
				else 
					$bookingList[$key]['isCancell'] = 0;
			}
            if ($value['CheckInDate'] < date('Y-m-d'))
                $bookingList[$key]['exp'] = 1;
            else
                $bookingList[$key]['exp'] = 0;
            $bookingList[$key]['money'] = $value['TotalPrice'] - $value['otherPrice'];
        }
		//get paymentMethod for show pay button
		
		
		self::$smarty->assign ( "listData", $bookingList );
		self::$smarty->assign ( "paymentMethod", $paymentMethod );
		self::$smarty->assign ( "statusList", booking::getBookingStatus () );
		self::$smarty->assign ( "settle", $settle );
		self::$smarty->assign ( "orderStartDate", $OrderStartDate);
		self::$smarty->assign ( "orderEndDate", $OrderEndDate);
        self::$smarty->assign ( "CheckInDateFrom", $CheckInDateFrom);
      	self::$smarty->assign ( "CheckInDateTo", $CheckInDateTo);
	}
	
	public function displayContent() {
		parent::displayContent ();
		self::$smarty->display ( _TAS_THEME_DIR_ . 'booking_list.tpl' );
	}
}
