<?php
/* 
 *
 * @author zotiger
 * @created 2012-11-05
 * @file Booming model
 */

if (! defined ( 'IN_TAS' )) {
	exit ( 'Access Denied' );
}

/**
 * Booking class
 */
class Booking extends ObjectModel {

    /*
     * get booking info by order id
     *
     * @created
     * @modified 2012-12-13 zotiger bug fixed issue1207. we have not to check price field value in sql.
     */
	public static function getBookingInfo($orderId, $iso="") {
		global $cookie;
		if ($iso == "") $iso = Language::getIsoById((int)$cookie->LanguageID);
		
		$booking_info = array ();
		
		$sql = "SELECT A.OrderId as order_id, A.HotelId as hotel_id, A.BookingNo as BookingNo, A.OrderUserId as OrderUserId, A.OrderStatusId as OrderStatusId, A.CheckInDate as checkin, A.CheckOutDate as checkout, A.ContactName as contact_name,
				A.ContactPhoneNumber as contact_tel, A.ContactEmail as contact_email, A.ContactHomePage as contact_hp, A.TotalPrice, A.otherPrice
			FROM HT_Order as A
			WHERE A.OrderId = {$orderId}";
		$booking_record = Db::getInstance ()->getRow ( $sql ); 

		if (! $booking_record)
			return null;
		
		$booking_info = Tools::element_copy ( $booking_record, 'BookingNo', 'OrderUserId', 'order_id', 'hotel_id', 'OrderStatusId', 'checkin', 'checkout', 'contact_name', 'contact_email', 'contact_tel', 'contact_hp', 'TotalPrice', 'otherPrice' );
		$booking_info ['TotalPriceString'] = Tools::money ( $booking_info ['TotalPrice'] );
		$booking_info ['PaidIn'] = Tools::money ( $booking_info ['otherPrice'] );
		$booking_info ['money'] = $booking_info ['TotalPrice'] - $booking_info['otherPrice'];
		$booking_info ['UnPaid'] = Tools::money ( $booking_info['money'] );
		
		$nights = (strtotime ( $booking_info ['checkout'] ) - strtotime ( $booking_info ['checkin'] )) / (24 * 60 * 60); // diff day
		$booking_info ['nights'] = $nights;
		
		$booking_info ['hotel_info'] = HotelDetail::getHotelDescription ( $booking_info ['hotel_id'], $iso );
		
		$sql = "
			SELECT 
				A.*,  D.`OrderRoomId`, D.`SpecialRequestNoSmoking` as req_nonsmoking, D.`SpecialRequestSmoking` as req_smoking,
				D.`SpecialRequestAdjoin` as req_adjoin, D.`SpecialRequestRemark` as req_remark, D.`Price`, D.`PriceString`, E.`OrderCustomerId` as customer_id,
				 E.`CustomerTitle` as customer_title, E.CustomerSex as customer_sex, E.`CustomerFamilyName` as customer_fnames,
				 E.`CustomerGivenName` as customer_gnames, E.`CustomerCountryId` as customer_country, F.`CountryName_".$iso."` as customer_country_name
			FROM
				(
				SELECT 
					A.RoomPlanId, A.RoomPlanName_".$iso." as RoomPlanName, A.RoomTypeId, A.`Breakfast`, A.`Dinner`, B.`RoomTypeName`, A.`RoomMaxPersons`, min(C.`Price`) AS MinPrice
				FROM 
					HT_RoomPlan as A, HT_RoomType as B, HT_RoomStockAndPrice as C
				WHERE 
					A.RoomTypeId = B.`RoomTypeId` AND A.RoomPlanId = C.`RoomPlanId` 
				 AND C.`ApplyDate` >= \"{$booking_info['checkin']}\" AND  C.`ApplyDate` < \"{$booking_info['checkout']}\"
				 
				 group by C.RoomPlanId	
				 ) AS A, HT_OrderRoom as D, HT_OrderCustomer as E, HT_Country as F
			WHERE
				A.`RoomPlanId` = D.`RoomPlanId`
				AND D.`OrderRoomId` = E.`OrderRoomId`
				AND E.`CustomerCountryId` = F.`CountryId`
				AND D.`OrderId` = {$orderId}
			ORDER BY 
				D.OrderRoomId
		";

        // echo $sql;

		$db_rp_customer_list = Db::getInstance ()->ExecuteS ( $sql );
		
		if (! $db_rp_customer_list)
			return null;
		
		$booked_roomplan_list = array ();
		
		foreach ( $db_rp_customer_list as $rp_customer ) {
			$key = $rp_customer ['OrderRoomId'];
			
			$booked_roomplan = array ();
			
			$new_customer = Tools::element_copy ( $rp_customer, 'customer_fnames', 'customer_gnames', 'customer_sex', 'customer_country', 'customer_country_name' );
			
			if (array_key_exists ( $key, $booked_roomplan_list )) {
				$booked_roomplan = $booked_roomplan_list [$key];
			} else {
				$booked_roomplan = Tools::element_copy ( $rp_customer, 'RoomPlanId', 'RoomPlanName', 'RoomTypeId', 'Breakfast', 'Dinner', 'RoomTypeName', 'RoomMaxPersons', 'MinPrice', 'OrderRoomId', 'req_nonsmoking', 'req_smoking', 'req_adjoin', 'req_remark', 'Price', 'PriceString' );
				
				$booked_roomplan ['customer_info_list'] = array ();
			
			}
			
			$booked_roomplan ['customer_info_list'];
			$booked_roomplan ['customer_info_list'] [] = $new_customer;
			
			$booked_roomplan_list [$key] = $booked_roomplan;
		}
		
		$booking_info ['booked_roomplan_list'] = $booked_roomplan_list;

		return $booking_info;
	}

    public static function getBookingInfoByBN($BookingNo, $iso="en") {
   		global $cookie;
   		if ($iso == "") $iso = Language::getIsoById((int)$cookie->LanguageID);

   		$booking_info = array ();

   		$sql = "SELECT A.OrderId as order_id, A.HotelId as hotel_id, A.BookingNo as BookingNo, A.OrderUserId as OrderUserId, A.OrderStatusId as OrderStatusId, A.CheckInDate as checkin, A.CheckOutDate as checkout, A.ContactName as contact_name,
   				A.ContactPhoneNumber as contact_tel, A.ContactEmail as contact_email, A.ContactHomePage as contact_hp, A.TotalPrice, A.otherPrice
   			FROM HT_Order as A
   			WHERE A.BookingNo = '{$BookingNo}'";
   		$booking_record = Db::getInstance ()->getRow ( $sql );

   		if (! $booking_record)
   			return null;
       // p($booking_record);
        $orderId=$booking_record['order_id'];
   		$booking_info = Tools::element_copy ( $booking_record, 'BookingNo', 'OrderUserId', 'order_id', 'hotel_id', 'OrderStatusId', 'checkin', 'checkout', 'contact_name', 'contact_email', 'contact_tel', 'contact_hp', 'TotalPrice', 'otherPrice' );
   		$booking_info ['TotalPriceString'] = Tools::money ( $booking_info ['TotalPrice'] );
   		$booking_info ['PaidIn'] = Tools::money ( $booking_info ['otherPrice'] );
   		$booking_info ['money'] = $booking_info ['TotalPrice'] - $booking_info['otherPrice'];
   		$booking_info ['UnPaid'] = Tools::money ( $booking_info['money'] );

   		$nights = (strtotime ( $booking_info ['checkout'] ) - strtotime ( $booking_info ['checkin'] )) / (24 * 60 * 60); // diff day
   		$booking_info ['nights'] = $nights;

   		$booking_info ['hotel_info'] = HotelDetail::getHotelDescription ( $booking_info ['hotel_id'], $iso );

   		$sql = "
   			SELECT
   				A.*,  D.`OrderRoomId`, D.`SpecialRequestNoSmoking` as req_nonsmoking, D.`SpecialRequestSmoking` as req_smoking,
   				D.`SpecialRequestAdjoin` as req_adjoin, D.`SpecialRequestRemark` as req_remark, D.`Price`, D.`PriceString`, E.`OrderCustomerId` as customer_id,
   				 E.`CustomerTitle` as customer_title, E.CustomerSex as customer_sex, E.`CustomerFamilyName` as customer_fnames,
   				 E.`CustomerGivenName` as customer_gnames, E.`CustomerCountryId` as customer_country, F.`CountryName_".$iso."` as customer_country_name
   			FROM
   				(
   				SELECT
   					A.RoomPlanId, A.RoomPlanName_".$iso." as RoomPlanName, A.RoomTypeId, A.`Breakfast`, A.`Dinner`, B.`RoomTypeName`, A.`RoomMaxPersons`, min(C.`Price`) AS MinPrice
   				FROM
   					HT_RoomPlan as A, HT_RoomType as B, HT_RoomStockAndPrice as C
   				WHERE
   					A.RoomTypeId = B.`RoomTypeId` AND A.RoomPlanId = C.`RoomPlanId`
   				 AND C.`ApplyDate` >= \"{$booking_info['checkin']}\" AND  C.`ApplyDate` < \"{$booking_info['checkout']}\"

   				 group by C.RoomPlanId
   				 ) AS A, HT_OrderRoom as D, HT_OrderCustomer as E, HT_Country as F
   			WHERE
   				A.`RoomPlanId` = D.`RoomPlanId`
   				AND D.`OrderRoomId` = E.`OrderRoomId`
   				AND E.`CustomerCountryId` = F.`CountryId`
   				AND D.`OrderId` = {$orderId}
   			ORDER BY
   				D.OrderRoomId
   		";

          //  echo $sql;

   		$db_rp_customer_list = Db::getInstance ()->ExecuteS ( $sql );

   		if (! $db_rp_customer_list)
   			return null;

   		$booked_roomplan_list = array ();

   		foreach ( $db_rp_customer_list as $rp_customer ) {
   			$key = $rp_customer ['OrderRoomId'];

   			$booked_roomplan = array ();

   			$new_customer = Tools::element_copy ( $rp_customer, 'customer_fnames', 'customer_gnames', 'customer_sex', 'customer_country', 'customer_country_name' );

   			if (array_key_exists ( $key, $booked_roomplan_list )) {
   				$booked_roomplan = $booked_roomplan_list [$key];
   			} else {
   				$booked_roomplan = Tools::element_copy ( $rp_customer, 'RoomPlanId', 'RoomPlanName', 'RoomTypeId', 'Breakfast', 'Dinner', 'RoomTypeName', 'RoomMaxPersons', 'MinPrice', 'OrderRoomId', 'req_nonsmoking', 'req_smoking', 'req_adjoin', 'req_remark', 'Price', 'PriceString' );

   				$booked_roomplan ['customer_info_list'] = array ();

   			}

   			$booked_roomplan ['customer_info_list'];
   			$booked_roomplan ['customer_info_list'] [] = $new_customer;

   			$booked_roomplan_list [$key] = $booked_roomplan;
   		}

   		$booking_info ['booked_roomplan_list'] = $booked_roomplan_list;

   		return $booking_info;
   	}

    public static function getBookingInfo_del($orderId, $iso="") {
    		global $cookie;
    		if ($iso == "") $iso = Language::getIsoById((int)$cookie->LanguageID);

    		$booking_info = array ();

    		$sql = "SELECT A.OrderId as order_id, A.HotelId as hotel_id, A.BookingNo as BookingNo, A.OrderUserId as OrderUserId, A.OrderStatusId as OrderStatusId, A.CheckInDate as checkin, A.CheckOutDate as checkout, A.ContactName as contact_name,
    				A.ContactPhoneNumber as contact_tel, A.ContactEmail as contact_email, A.ContactHomePage as contact_hp, A.TotalPrice, A.otherPrice
    			FROM HT_Order as A
    			WHERE A.OrderId = {$orderId}";
    		$booking_record = Db::getInstance ()->getRow ( $sql );

    		if (! $booking_record)
    			return null;

    		$booking_info = Tools::element_copy ( $booking_record, 'BookingNo', 'OrderUserId', 'order_id', 'hotel_id', 'OrderStatusId', 'checkin', 'checkout', 'contact_name', 'contact_email', 'contact_tel', 'contact_hp', 'TotalPrice', 'otherPrice' );
    		$booking_info ['TotalPriceString'] = Tools::money ( $booking_info ['TotalPrice'] );
    		$booking_info ['PaidIn'] = Tools::money ( $booking_info ['otherPrice'] );
    		$booking_info ['money'] = $booking_info ['TotalPrice'] - $booking_info['otherPrice'];
    		$booking_info ['UnPaid'] = Tools::money ( $booking_info['money'] );

    		$nights = (strtotime ( $booking_info ['checkout'] ) - strtotime ( $booking_info ['checkin'] )) / (24 * 60 * 60); // diff day
    		$booking_info ['nights'] = $nights;

    		$booking_info ['hotel_info'] = HotelDetail::getHotelDescription ( $booking_info ['hotel_id'], $iso );

    		$sql = "
    			SELECT
    				A.*,  D.`OrderRoomId`, D.`SpecialRequestNoSmoking` as req_nonsmoking, D.`SpecialRequestSmoking` as req_smoking,
    				D.`SpecialRequestAdjoin` as req_adjoin, D.`SpecialRequestRemark` as req_remark, D.`Price`, D.`PriceString`, E.`OrderCustomerId` as customer_id,
    				 E.`CustomerTitle` as customer_title, E.CustomerSex as customer_sex, E.`CustomerFamilyName` as customer_fnames,
    				 E.`CustomerGivenName` as customer_gnames, E.`CustomerCountryId` as customer_country, F.`CountryName_".$iso."` as customer_country_name
    			FROM
    				(
    				SELECT
    					A.RoomPlanId, A.RoomPlanName_".$iso." as RoomPlanName, A.RoomTypeId, A.`Breakfast`, A.`Dinner`, B.`RoomTypeName`, A.`RoomMaxPersons`, min(C.`Price`) AS MinPrice
    				FROM
    					HT_RoomPlan_del as A, HT_RoomType as B, HT_RoomStockAndPrice_del as C
    				WHERE
    					A.RoomTypeId = B.`RoomTypeId` AND A.RoomPlanId = C.`RoomPlanId`
    				 AND C.`ApplyDate` >= \"{$booking_info['checkin']}\" AND  C.`ApplyDate` < \"{$booking_info['checkout']}\"

    				 group by C.RoomPlanId
    				 ) AS A, HT_OrderRoom as D, HT_OrderCustomer as E, HT_Country as F
    			WHERE
    				A.`RoomPlanId` = D.`RoomPlanId`
    				AND D.`OrderRoomId` = E.`OrderRoomId`
    				AND E.`CustomerCountryId` = F.`CountryId`
    				AND D.`OrderId` = {$orderId}
    			ORDER BY
    				D.OrderRoomId
    		";

            // echo $sql;

    		$db_rp_customer_list = Db::getInstance ()->ExecuteS ( $sql );

    		if (! $db_rp_customer_list)
    			return null;

    		$booked_roomplan_list = array ();

    		foreach ( $db_rp_customer_list as $rp_customer ) {
    			$key = $rp_customer ['OrderRoomId'];

    			$booked_roomplan = array ();

    			$new_customer = Tools::element_copy ( $rp_customer, 'customer_fnames', 'customer_gnames', 'customer_sex', 'customer_country', 'customer_country_name' );

    			if (array_key_exists ( $key, $booked_roomplan_list )) {
    				$booked_roomplan = $booked_roomplan_list [$key];
    			} else {
    				$booked_roomplan = Tools::element_copy ( $rp_customer, 'RoomPlanId', 'RoomPlanName', 'RoomTypeId', 'Breakfast', 'Dinner', 'RoomTypeName', 'RoomMaxPersons', 'MinPrice', 'OrderRoomId', 'req_nonsmoking', 'req_smoking', 'req_adjoin', 'req_remark', 'Price', 'PriceString' );

    				$booked_roomplan ['customer_info_list'] = array ();

    			}

    			$booked_roomplan ['customer_info_list'];
    			$booked_roomplan ['customer_info_list'] [] = $new_customer;

    			$booked_roomplan_list [$key] = $booked_roomplan;
    		}

    		$booking_info ['booked_roomplan_list'] = $booked_roomplan_list;

    		return $booking_info;
    	}
	/*
	 *  make booking object from post variable
	 *
	 * factory function
	 *
	 * @author zotiger
	 * @created 2012-11-10
	 * @modified 2012-11-21 remove roomplan count
	 */
	public static function buildBookingInfoFromPost($companyId) {	//从Post表单中建立预定信息
		$booking_info = array ();
		$booking_info = Tools::element_copy ( $_POST, 'order_id', 'hotel_id', 'checkin', 'checkout', 'contact_name', 'contact_email', 'contact_tel', 'contact_hp' );
		
		$booking_info ['order_id'] = Tools::get_default_val ( @$_POST ['order_id'], 0 );	//获取订单编号，没有则认为是0
		$nights = (strtotime ( $booking_info ['checkout'] ) - strtotime ( $booking_info ['checkin'] )) / (24 * 60 * 60); // diff day
		$booking_info ['nights'] = $nights;	//计算预定几个晚上
		$booking_info ['hotel_info'] = HotelDetail::getHotelDescription ( $_POST ['hotel_id'] );	//获取酒店信息

		//OrderRoom表中会用到
		$ids = $_POST ['ids'];
		$orid_list = array ();
		$rpid_list = array ();
		foreach ( $ids as $id ) {
			$orid_list [] = $_POST ['or_ids_' . $id];
			$rpid_list [] = $_POST ['roomplan_ids_' . $id];
		}
		
		//获取房间列表
		$roomplan_list = RoomPlan::getRoomPlanListForBooking ( $rpid_list, $booking_info ['checkin'], $booking_info ['checkout'] );
		
		$total_price = 0.0;	//计算总价格
        $org_total_price = 0.0;	//计算不含手数料总价格
		$booked_roomplan_list = array ();
		foreach ( $roomplan_list as $key => $booked_roomplan ) {
			$id = $ids [$key];
			$orid = $orid_list [$id];
			$booked_roomplan ['OrderRoomId'] = $orid;
			$booked_roomplan ['req_nonsmoking'] = Tools::get_default_val ( $_POST ['req_nonsmoking_' . $id], 0 );
			$booked_roomplan ['req_smoking'] = Tools::get_default_val ( $_POST ['req_smoking_' . $id], 0 );
			$booked_roomplan ['req_adjoin'] = Tools::get_default_val ( $_POST ['req_adjoin_' . $id], 0 );
			$booked_roomplan ['req_remark'] = Tools::get_default_val ( $_POST ['req_remark_' . $id], '' );
			
			$customer_info_list = array ();

			if (array_key_exists ( 'customer_fnames_' . $id, $_POST )) {
				foreach ( $_POST ['customer_fnames_' . $id] as $i => $val ) {
					if ($_POST ['customer_fnames_' . $id] [$i] != '' || $_POST ['customer_gnames_' . $id] [$i] != '') {
						$customer_info = array ();
						
						$customer_info ['customer_fnames'] = $_POST ['customer_fnames_' . $id] [$i];
						$customer_info ['customer_gnames'] = $_POST ['customer_gnames_' . $id] [$i];
						$customer_info ['customer_sex'] = Tools::get_default_val ( $_POST ['customer_sex_' . $id . "_$i"], 0 );
						$customer_info ['customer_country'] = $_POST ['customer_country_' . $id] [$i];
						$customer_info ['customer_country_name'] = Tools::getCountryName ( $customer_info ['customer_country'] );
						$customer_info_list [] = $customer_info;
					}
				}
			} else { // empty customers info
				for($i = 0; $i < $booked_roomplan ['RoomMaxPersons']; $i ++) {
					// default value
					$customer_info ['customer_fnames'] = '';
					$customer_info ['customer_gnames'] = '';
					$customer_info ['customer_sex'] = 1; // male
					$customer_info ['customer_country'] = 109; // japan
					$customer_info_list [] = $customer_info;
				}
			
			}
			$booked_roomplan ['customer_info_list'] = $customer_info_list;
			
			$price_result = Booking::calculation_roomplan_price ( $booked_roomplan ['RoomPlanId'], $booking_info ['checkin'], $booking_info ['checkout'], $companyId );
			$booked_roomplan ['Price'] = $price_result ['Price'];
			$booked_roomplan ['PriceString'] = $price_result ['PriceString'];
			$total_price += $booked_roomplan ['Price'];
            $booked_roomplan ['Check_0'] = $price_result ['check_0'];
            $booked_roomplan ['OrgPrice'] = $price_result ['OrgPrice'];
            $org_total_price += $booked_roomplan ['OrgPrice'];
			$booked_roomplan_list [] = $booked_roomplan;
		}
		
		$booking_info ['TotalPrice'] = $total_price;
		$booking_info ['TotalPriceString'] = Tools::money ( $total_price );
		$booking_info ['booked_roomplan_list'] = $booked_roomplan_list;
        $booking_info ['OrgTotalPrice'] = $org_total_price;
		//由于此处只有初次下订单时才经过，所以otherPrice必定为0
		$booking_info ['otherPrice'] = 0;
		$booking_info ['PaidIn'] = Tools::money ( $booking_info ['otherPrice'] );
		$booking_info ['money'] = $booking_info ['TotalPrice'] - $booking_info['otherPrice'];
		$booking_info ['UnPaid'] = Tools::money ( $booking_info['money'] );
        $booking_info ['org_money'] = $booking_info ['OrgTotalPrice'] - $booking_info['otherPrice'];
		return $booking_info;
	}
	
	/*
	 * get next booking number formatted in 'TASF<number length = 7>'
	 *
	 * @author zotiger
	 * @created 2012-11-12
	 */
	public static function getNextBookingNo() {
		$sql = "SELECT ifnull(max(convert(right(BookingNo, 7) + 1, UNSIGNED)) , 1) FROM HT_Order";
		$next_no = Db::getInstance ()->getValue ( $sql );
		return 'TASF' . str_pad ( $next_no, 7, "0", STR_PAD_LEFT );
	}
	
	/**
	 * 这里与 getBookingInfo 不同，这里获取订单表中对应ID的全部信息，而且不涉及其他数据.千万不要删除
	 *
	 * @param unknown_type $orderId
	 * @return unknown
	 */
	public static function getBookingOrder( $orderId ) {
		$sql = "SELECT A.OrderId as order_id, A.BookingNo as BookingNo, A.OrderUserId as OrderUserId, A.HotelId as hotel_id, A.OrderStatusId as OrderStatusId, A.CheckInDate as checkin, A.CheckOutDate as checkout, 
				A.ContactName as contact_name, A.ContactPhoneNumber as contact_tel, A.ContactEmail as contact_email, A.ContactHomePage as contact_hp, 
				A.Active, A.PayStatus, A.TotalPrice, A.paymentMethod, A.otherPrice, A.last_time 
			FROM HT_Order as A
			WHERE A.OrderId = {$orderId}";
		return Db::getInstance ()->getRow ( $sql ); 
	}

	/**
	 * 修改已有订单
	 *
	 * @param unknown_type $booking_info
	 */
	public static function modifyBooking($booking_info) {
		$old_order_id = $booking_info['order_id'];	//获取原有的订单编号
		$exist_booking_info = Booking::getBookingOrder ( $old_order_id );	//获取原有的订单信息
		
		//当订单 是存在的时候，才能对下面的信息进行修改
		if (empty($exist_booking_info)) return null;
		
		$booking_info ['OrderUserId'] = $exist_booking_info ['OrderUserId'];	//获取原订单的用户信息	
		$booking_info ['BookingNo'] = $exist_booking_info ['BookingNo'];	//获取原订单的订单编号
		
		/******************* 清除旧信息 ***********************/
		//当订单状态时2(confirming)时，是没有真正在RoomStockAndPrice中减去房间数的
		//当订单状态为5(Fully Booked)时，此状态是由管理员修改的，这个状态也不会减少房间数量。此处需要注意，当订单状态由 confirming改为confirmed时，需要在RoomStockAndPrice中减少房间数量
		//当订单状态为7(Cancelled)时，是不能进行modify操作的。所以此处排除cancelled的状态
		//除此之外才能更新RoomStockAndPrice中的数量,将以前减去的房间数量加回来
		if($exist_booking_info['OrderStatusId'] != 2 && $exist_booking_info['OrderStatusId'] != 5) {
			$sql = "UPDATE HT_RoomStockAndPrice as A right join (
						SELECT B.`RoomPlanId`, count(B.`RoomPlanId`) as OrderCount 
						FROM HT_Order as A, HT_OrderRoom as B
						WHERE A.`OrderId` = B.`OrderId`	and A.`OrderId` = {$old_order_id}
						GROUP BY B.`RoomPlanId`
					) AS B on A.`RoomPlanId` = B.RoomPlanId
				SET A.Amount = greatest(A.Amount + B.OrderCount, 0)
				WHERE A.`ApplyDate` between '{$exist_booking_info['checkin']}' and DATE_SUB('{$exist_booking_info['checkout']}'	, INTERVAL 1 DAY)";
			Db::getInstance ()->ExecuteS ( $sql );
		}

		//删除OrderCustomer中与旧订单相关的信息, 需要注意的是在此处需要保留Order中的信息，这条信息会被更新
		$sql = "DELETE FROM A, B USING HT_OrderCustomer as A, HT_OrderRoom as B
				WHERE A.`OrderRoomId` = B.`OrderRoomId` AND  B.`OrderId` = {$old_order_id}";
		Db::getInstance ()->ExecuteS ( $sql );
		/********************** 清除旧信息结束  *********************************/
		
		/****************** 判断新订单的订单状态 *************************/
		//获取RoomPlanId的数组，在之后的SQL语句中有用
		$roomplan_id_list = array ();
		foreach ( $booking_info ['booked_roomplan_list'] as $booked_roomplan ) 
			$roomplan_id_list [] = $booked_roomplan ['RoomPlanId'];
		
		// 获取所预定房间的信息(房间数量信息)， 用于判断是否处理Confirming状态
		//此处SQL需要注意，删除原来的B.Price > 0.原因是 TotalPrice已经通过buildBookingInfoFromPost计算出来并且是正确的，而且每个房间的Price也是正确的.
		//所以此处只需要判断这些房间在规定日期内是存在的就好了。加Price是多余的，并且也是错误的。正确的Price计算方式是 根据 洲信息 获取价格的不是单纯的通过Price这一个字段
		$sql = "SELECT A.RoomPlanId, min(B.Amount) as MinAmount 
            FROM HT_RoomPlan as A, HT_RoomStockAndPrice as B 
            WHERE A.`RoomPlanId` = B.RoomPlanId  
            	AND A.RoomPlanId in (" . implode ( ",", $roomplan_id_list ) . ")  
				AND B.`ApplyDate` between '{$booking_info['checkin']}' and DATE_SUB('{$booking_info['checkout']}', INTERVAL 1 DAY)   
            GROUP BY B.RoomPlanId";
       	$minamount_list = Db::getInstance ()->ExecuteS ( $sql );
		
		//如果房间信息根本都不存在则直接返回，不做任何修改
		if (empty($minamount_list)) return null;
		
		$roomplan_minamount_list = array ();
		foreach ( $minamount_list as $roomplan_minamount ) 
			$roomplan_minamount_list [$roomplan_minamount ['RoomPlanId']] = $roomplan_minamount ['MinAmount'];
		
		//在此处将订单状态默认为3，是非常糟糕的事情。因为
		$order_status = 3; //默认为 3:confirmed
		if ($booking_info['paymentMethod'] == 1) {	//如果是支付，则订单变为 9:waiting for payment		
			$order_status = 9;	
		}
		
		$pay_status = 1;
		//如果订单状态是succeeded状态，且是前支付，则表明用户已付款.需要查看已付金额是否能够使订单成功
		if ($exist_booking_info['paymentMethod'] == 0) {
			if ($booking_info['TotalPrice'] <= $exist_booking_info['otherPrice']) {
				$order_status = 4;	
				$pay_status = 2;
			}
		}
		
		//如果订单状态是succeeded by admin状态，且是后支付，则表明用户已付款。需要查看已付金额是否能够使订单成功
		if ($exist_booking_info['paymentMethod'] == 1) {
			if ($booking_info['TotalPrice'] <= $exist_booking_info['otherPrice']) {
				$order_status = 10;		
				$pay_status = 2;
			}
		}
		
		//如果这些房间中数量小于1的则表示，这些房间暂时不能入住
		foreach ( $roomplan_minamount_list as $minamount ) {	
			if ($minamount < 1) {	//将订单状态改为 2:confirming
				$order_status = 2;
				break;
			}
		}

		$changeOrderStatus = 1;
		if ($exist_booking_info['checkin'] == $booking_info['checkin'] 
			&& $exist_booking_info['checkout'] == $booking_info['checkout']) {
			$order_status = $exist_booking_info['OrderStatusId'];
			$changeOrderStatus = 0;		
		}
		/********************** 判断新订单的订单状态结束  *********************************/
		
		//将新订单或者是修改的订单 放入订单表中
		$sql = "REPLACE INTO `HT_Order` (`OrderId`, `BookingNo`, `OrderUserId`, `HotelId`, 
			`ContactName`, `ContactPhoneNumber`, `ContactEmail`, `ContactHomePage`, 
			`OrderStatusId`, `OrderedDate`, `CheckInDate`, `CheckOutDate`, `PayStatus`, 
			TotalPrice, `paymentMethod`, `otherPrice`,`OrgTotalPrice`,`last_time`)
		VALUES
			({$booking_info['order_id']}, '{$booking_info['BookingNo']}', {$booking_info['OrderUserId']}, {$booking_info['hotel_id']},
			'{$booking_info['contact_name']}', '{$booking_info['contact_tel']}', '{$booking_info['contact_email']}', '{$booking_info['contact_hp']}', 
			{$order_status}, '" . date ( 'Y-m-d H:i:s' ) . "', '{$booking_info['checkin']}', '{$booking_info['checkout']}', {$pay_status}, 
			{$booking_info['TotalPrice']}, '{$booking_info['paymentMethod']}', {$exist_booking_info['otherPrice']},{$booking_info['OrgTotalPrice']},'". date ( 'Y-m-d H:i:s' )."')";
		
		Db::getInstance ()->ExecuteS ( $sql );
		
		$new_order_id = Db::getInstance ()->Insert_ID ();
		
		if(!$new_order_id) {
			$new_order_id = $old_order_id;
		}
		
		//删除OrderCustomer中与新订单相关的信息, 清楚杂项保留新数据的正确性
		$sql = "DELETE FROM A, B USING HT_OrderCustomer as A, HT_OrderRoom as B
				WHERE A.`OrderRoomId` = B.`OrderRoomId` AND  B.`OrderId` = {$new_order_id}";
		Db::getInstance ()->ExecuteS ( $sql );
		
		foreach ( $booking_info ['booked_roomplan_list'] as $booked_roomplan ) {
			$sql = "INSERT INTO `HT_OrderRoom` (`OrderId`, `RoomPlanId`,  
				`SpecialRequestNoSmoking`, `SpecialRequestSmoking`,
				`SpecialRequestAdjoin`, `SpecialRequestRemark`, 
				`Price`, `PriceString`,`OrgPrice`)
			VALUES
				({$new_order_id}, {$booked_roomplan['RoomPlanId']},  
				{$booked_roomplan['req_nonsmoking']}, {$booked_roomplan['req_smoking']}, 
				{$booked_roomplan['req_adjoin']}, '{$booked_roomplan['req_remark']}',
				{$booked_roomplan['Price']}, '{$booked_roomplan['PriceString']}',{$booked_roomplan['OrgPrice']});";
			Db::getInstance ()->ExecuteS ( $sql );
			
			$new_orderroom_id = Db::getInstance ()->Insert_ID ();	//获取OrderRoom表插入的信息，将预定房间房间的用户信息插入OrderCustomer表中
			foreach ( $booked_roomplan ['customer_info_list'] as $customer_info ) {
				$sql = "INSERT INTO `HT_OrderCustomer` (`OrderRoomId`, `CustomerTitle`, CustomerSex, `CustomerFamilyName`,`CustomerGivenName`, `CustomerCountryId`)
				VALUES ({$new_orderroom_id}, 'title',{$customer_info['customer_sex']}, '{$customer_info['customer_fnames']}', '{$customer_info['customer_gnames']}',{$customer_info['customer_country']});";
				Db::getInstance ()->ExecuteS ( $sql );
			}
		}
		
		//查看订单数量是否大于现有值
		$sql = "SELECT B.`RoomPlanId`, count(B.`RoomPlanId`) as OrderCount
						FROM HT_Order as A, HT_OrderRoom as B
						WHERE A.`OrderId` = B.`OrderId`	and A.`OrderId` = {$new_order_id}
						GROUP BY B.`RoomPlanId`";
		$roomcount_list = Db::getInstance ()->ExecuteS ( $sql );
		
		if ($changeOrderStatus == 1) {
			foreach($roomcount_list as $value) {
				$RoomPlanId = $value['RoomPlanId'];
				$OrderCount = $value['OrderCount'];
				if($roomplan_minamount_list[$RoomPlanId] < $OrderCount) {
					$order_status = 2;
					$sql = "update `HT_Order` set `OrderStatusId` = {$order_status} where `OrderId` = {$new_order_id}";
					Db::getInstance ()->ExecuteS ( $sql );
					break;
				}
			}
		}

		if($order_status != 2) {	
			//更新RoomStockAndPrice中的数量
			$sql = "UPDATE HT_RoomStockAndPrice as A right join (
						SELECT B.`RoomPlanId`, count(B.`RoomPlanId`) as OrderCount
						FROM HT_Order as A, HT_OrderRoom as B
						WHERE A.`OrderId` = B.`OrderId`	and A.`OrderId` = {$new_order_id}
						GROUP BY B.`RoomPlanId`
					) AS B on A.`RoomPlanId` = B.RoomPlanId
				SET A.Amount = greatest(A.Amount - B.OrderCount, 0)
				WHERE A.`ApplyDate` between '{$booking_info['checkin']}' and DATE_SUB('{$booking_info['checkout']}'	, INTERVAL 1 DAY)";
			Db::getInstance ()->ExecuteS ( $sql );
		}
		
		return $new_order_id;
	}
	
	/*
	 *  insert new booking or update record
	 *
	 * @param object $booking_info
	 *
	 * @author zotiger
	 * @created 2012-11-09
	 * @modified 2012-11-13 if edit booking order, then change order's status to modified status
	 */
	public static function insertNewBooking($booking_info) {
        //p($booking_info);
		$new_order_id = $booking_info ['order_id'];
		
		if ($new_order_id == 0) { //只是预定
			$booking_info ['booking_no'] = '';			
		} else { //正是插入 
			$exist_booking_info = Booking::getBookingOrder ( $new_order_id );
			if ($exist_booking_info) {	//如果这个订单ID对应的记录还存在，则说明是在30分钟以内,那么删除旧订单，插入新订单。否则直接返回NULL
				if($exist_booking_info['OrderStatusId'] != 2) {
					$sql = "UPDATE HT_RoomStockAndPrice as A right join (
								SELECT B.`RoomPlanId`, count(B.`RoomPlanId`) as OrderCount 
								FROM HT_Order as A, HT_OrderRoom as B
								WHERE A.`OrderId` = B.`OrderId`	and A.`OrderId` = {$new_order_id}
								GROUP BY B.`RoomPlanId`
							) AS B on A.`RoomPlanId` = B.RoomPlanId
						SET A.Amount = greatest(A.Amount + B.OrderCount, 0)
						WHERE A.`ApplyDate` between '{$exist_booking_info['checkin']}' and DATE_SUB('{$exist_booking_info['checkout']}'	, INTERVAL 1 DAY)";
					Db::getInstance ()->ExecuteS ( $sql );
				}

				$booking_info ['OrderUserId'] = $exist_booking_info ['OrderUserId'];
				$booking_info ['booking_no'] = Booking::getNextBookingNo (); //获取一条新的订单编号 TASF开头
			} else {
				return null;
			}
		}
		
		//删除OrderCustomer中与旧订单相关的信息, 清楚杂项保留新数据的正确性
		$sql = "DELETE FROM A, B USING HT_OrderCustomer as A, HT_OrderRoom as B
				WHERE A.`OrderRoomId` = B.`OrderRoomId` AND  B.`OrderId` = {$new_order_id}";
		Db::getInstance ()->ExecuteS ( $sql );

		//检查订单状态是否为confirming 
		$roomplan_id_list = array ();
		foreach ( $booking_info ['booked_roomplan_list'] as $booked_roomplan ) {
			$roomplan_id_list [] = $booked_roomplan ['RoomPlanId'];
		}
		
		// 获取所预定房间的信息(房间数量信息)
		$sql = "SELECT A.RoomPlanId, min(B.Amount) as MinAmount 
            FROM HT_RoomPlan as A, HT_RoomStockAndPrice as B 
            WHERE A.`RoomPlanId` = B.RoomPlanId  AND A.RoomPlanId in (" . implode ( ",", $roomplan_id_list ) . ")  
				AND B.`ApplyDate` between '{$booking_info['checkin']}' and DATE_SUB('{$booking_info['checkout']}', INTERVAL 1 DAY)  
            GROUP BY B.RoomPlanId";
		
		$roomplan_minamount_list = array ();
		$minamount_list = Db::getInstance ()->ExecuteS ( $sql );
		foreach ( $minamount_list as $roomplan_minamount ) {
			$roomplan_minamount_list [$roomplan_minamount ['RoomPlanId']] = $roomplan_minamount ['MinAmount'];
		}
		
		$order_status = 3; //默认为 3:confirmed
		if ($booking_info['paymentMethod'] == 1) {	//如果是支付，则订单变为 9:waiting for payment		
			$order_status = 9;				
		}

		foreach ( $roomplan_minamount_list as $minamount ) {	//如果这些房间中数量小于1的则表示，这些房间暂时不能入住
			if ($minamount < 1) {	//将订单状态改为 2:confirming
				$order_status = 2;
				break;
			}
		}

		//将新订单或者是修改的订单 放入订单表中
		$sql = "REPLACE INTO `HT_Order` (`OrderId`, `BookingNo`, `OrderUserId`, `HotelId`, 
			`ContactName`, `ContactPhoneNumber`, `ContactEmail`, `ContactHomePage`, 
			`OrderStatusId`, `OrderedDate`, `CheckInDate`, `CheckOutDate`, 
			TotalPrice, `paymentMethod`,`OrgTotalPrice`)
		VALUES
			({$booking_info['order_id']}, '{$booking_info['booking_no']}', {$booking_info['OrderUserId']}, {$booking_info['hotel_id']},
			'{$booking_info['contact_name']}', '{$booking_info['contact_tel']}', '{$booking_info['contact_email']}', '{$booking_info['contact_hp']}', 
			{$order_status}, '" . date ( 'Y-m-d H:i:s' ) . "', '{$booking_info['checkin']}', '{$booking_info['checkout']}', 
			{$booking_info['TotalPrice']}, '{$booking_info['paymentMethod']}',{$booking_info['OrgTotalPrice']})";
		Db::getInstance ()->ExecuteS ( $sql );
		
		$new_order_id = Db::getInstance ()->Insert_ID ();

		//删除OrderCustomer中与新订单相关的信息, 清楚杂项保留新数据的正确性
		$sql = "DELETE FROM A, B USING HT_OrderCustomer as A, HT_OrderRoom as B
				WHERE A.`OrderRoomId` = B.`OrderRoomId` AND  B.`OrderId` = {$new_order_id}";
		Db::getInstance ()->ExecuteS ( $sql );
		
		
		foreach ( $booking_info ['booked_roomplan_list'] as $booked_roomplan ) {
			$sql = "INSERT INTO `HT_OrderRoom` (`OrderId`, `RoomPlanId`,  
				`SpecialRequestNoSmoking`, `SpecialRequestSmoking`,
				`SpecialRequestAdjoin`, `SpecialRequestRemark`, 
				`Price`, `PriceString`,`OrgPrice`)
			VALUES
				({$new_order_id}, {$booked_roomplan['RoomPlanId']},  
				{$booked_roomplan['req_nonsmoking']}, {$booked_roomplan['req_smoking']}, 
				{$booked_roomplan['req_adjoin']}, '{$booked_roomplan['req_remark']}',
				{$booked_roomplan['Price']}, '{$booked_roomplan['PriceString']}',{$booked_roomplan['OrgPrice']});";
			Db::getInstance ()->ExecuteS ( $sql );
			
			$new_orderroom_id = Db::getInstance ()->Insert_ID ();	//获取OrderRoom表插入的信息，将预定房间房间的用户信息插入OrderCustomer表中
			foreach ( $booked_roomplan ['customer_info_list'] as $customer_info ) {
				$sql = "INSERT INTO `HT_OrderCustomer` (`OrderRoomId`, `CustomerTitle`, CustomerSex, `CustomerFamilyName`,`CustomerGivenName`, `CustomerCountryId`)
				VALUES ({$new_orderroom_id}, 'title',{$customer_info['customer_sex']}, '{$customer_info['customer_fnames']}', '{$customer_info['customer_gnames']}',{$customer_info['customer_country']});";
				Db::getInstance ()->ExecuteS ( $sql );
			}
		}
		
		//查看订单数量是否大于现有值
		$sql = "SELECT B.`RoomPlanId`, count(B.`RoomPlanId`) as OrderCount
						FROM HT_Order as A, HT_OrderRoom as B
						WHERE A.`OrderId` = B.`OrderId`	and A.`OrderId` = {$new_order_id}
						GROUP BY B.`RoomPlanId`";
		$roomcount_list = Db::getInstance ()->ExecuteS ( $sql );
		
		foreach($roomcount_list as $value) {
			$RoomPlanId = $value['RoomPlanId'];
			$OrderCount = $value['OrderCount'];
			if($roomplan_minamount_list[$RoomPlanId] < $OrderCount) {
				$order_status = 2;
				$sql = "update `HT_Order` set `OrderStatusId` = {$order_status} where `OrderId` = {$new_order_id}";
				Db::getInstance ()->ExecuteS ( $sql );
				break;
			}
		}

		if($order_status != 2) {	
			//更新RoomStockAndPrice中的数量
			$sql = "UPDATE HT_RoomStockAndPrice as A right join (
						SELECT B.`RoomPlanId`, count(B.`RoomPlanId`) as OrderCount
						FROM HT_Order as A, HT_OrderRoom as B
						WHERE A.`OrderId` = B.`OrderId`	and A.`OrderId` = {$new_order_id}
						GROUP BY B.`RoomPlanId`
					) AS B on A.`RoomPlanId` = B.RoomPlanId
				SET A.Amount = greatest(A.Amount - B.OrderCount, 0)
				WHERE A.`ApplyDate` between '{$booking_info['checkin']}' and DATE_SUB('{$booking_info['checkout']}'	, INTERVAL 1 DAY)";
			Db::getInstance ()->ExecuteS ( $sql );
		}
		
		return $new_order_id;
	}
	
	public static function getBookingCount($swhere) {
		$sql = "
			SELECT count(*)
			FROM HT_Order 
			LEFT JOIN HT_User ON HT_Order.OrderUserId = HT_User.UserID 
			LEFT JOIN HT_Company ON HT_User.CompanyID = HT_Company.CompanyId
			LEFT JOIN HT_Hotel ON HT_Order.HotelId = HT_Hotel.HotelId
			WHERE 1 = 1 and HT_Order.BookingNo != ''  
		" . (($swhere == "") ? "" : ' AND ' . $swhere);

		return ( int ) Db::getInstance ()->getValue ( $sql );
	}
	public static function getBookingList($swhere, $p, $n) {
		global $cookie;
		$iso = Language::getIsoById((int)$cookie->LanguageID);
		
		$sql = "
			SELECT HT_Order.OrderId, HT_Order.BookingNo, HT_Order.CheckInDate, HT_Order.OrderStatusId, HT_Order.CheckOutDate, HT_Order.PayStatus, HT_Order.TotalPrice, HT_Order.otherPrice, 
			HT_User.LoginUserName, HT_Company.AgentID, HT_Company.CompanyName, HT_Company.ManagingDirector, HT_Company.PaymentMethod, HT_Hotel.HotelName_".$iso." as HotelName, 
			DATE_SUB(CheckInDate,INTERVAL 4 DAY) DueDate, 
			(IF(DATE_SUB(CheckInDate, INTERVAL '3 1:0:0' DAY_SECOND) > now(), 1, 0)) isCancell 
			
			FROM HT_Order 
			LEFT JOIN HT_User ON HT_Order.OrderUserId = HT_User.UserID 
			LEFT JOIN HT_Company ON HT_User.CompanyID = HT_Company.CompanyId
			LEFT JOIN HT_Hotel ON HT_Order.HotelId = HT_Hotel.HotelId
			WHERE 1 = 1 and HT_Order.BookingNo != '' 
			" . (($swhere == "") ? "" : ' AND ' . $swhere) . "
			Order By HT_Order.last_time desc, HT_Order.PayStatus asc, HT_Order.OrderId desc 
			limit ".($p - 1) * $n .", $n";

		return Db::getInstance ()->ExecuteS ( $sql );
	}
	
	public static function getBookingStatus() {
		$result = Db::getInstance ()->ExecuteS ( "select * from HT_OrderStatus order by OrderStatusId desc" );
		$statusArray = array ();
		foreach ( $result as $row ) {
			$statusArray [$row ['OrderStatusId']] = $row ['OrderStatusName'];
		}
		return $statusArray;
	}
	
	public static function changePayStatus($id, $status) {
		if ($id == 0)
			return;
		Db::getInstance ()->Execute ( 'update `' . _DB_PREFIX_ . 'Order` set PayStatus = ' . ( int ) $status . ', last_time = now() WHERE `OrderId` = ' . ( int ) ($id) );
	}
	
	public static function changeBookingStatus($id, $status) {
		if ($id == 0)
			return;
			
		//获取订单原来信息
		$result = Db::getInstance ()->getRow ( 'select * from `'. _DB_PREFIX_ . 'Order` where `OrderId` = ' . ( int ) ($id) );			
		//如果状态要变为3,并且是前支付,则将状态改为9
		if ($status == 3 && $result['paymentMethod'] == 1) {	
			$status = 9;
		}

		//如果状态药变为3,并且已经支付，且是前支付，则变为succeed, 如果是后支付则为succeed by admin
		if ($status == 3 && $result['PayStatus'] == 2) {
			if ($result['paymentMethod'] == 0)	$status = 4;
			if ($result['paymentMethod'] == 1)	$status = 10;
		}

		Db::getInstance ()->Execute ( 'update `' . _DB_PREFIX_ . 'Order` set OrderStatusId = ' . ( int ) $status . ', last_time = now() WHERE `OrderId` = ' . ( int ) ($id) );
	
		//修改订单成功,此时需要发送邮件
		if ($status == 9 && ($result['OrderStatusId'] == 8 || $result['OrderStatusId'] == 3)) {
			return ;
		} else {
			Tools::ordermail($id);
			if ($status == 7) Tools::emailHotel($id, 12);
		}
	}
	
	//这里是支付过程，涉及表的otherPrice字段
	public static function payment($id, $money) {
		if ($id == 0)
			return;
		$sql = 'update `' . _DB_PREFIX_ . 'Order` set `otherPrice` = `otherPrice` + ' . ( int ) $money . ', last_time = now() WHERE `OrderId` = ' . ( int ) ($id);
		Db::getInstance()->Execute ($sql);
	}

	/*
     * user can view order
     *
     * @author zotiger
     * @created 2012-11
     */
	public static function checkUserCanViewOrder($userId, $roleId, $orderId) {
		$error = array ();
		$error ['no'] = 0;
		
		if ($roleId == 1) {	//如果是酒店管理员,酒店用户可以查看属于本酒店的用户订单
			$sql = "SELECT count(*) FROM HT_User as A, HT_Order as B 
				WHERE A.HotelId = B.HotelId and A.`UserID` = {$userId} and B.`OrderId` = $orderId";
			
			if (($orderId > 0) && (Db::getInstance ()->getValue ( $sql ) == 0)) {
				echo "error";
				$error ['no'] = 1;
				$error ['message'] = 'User can not access this page';
			}
			
			return $error;
		}
		
		return Booking::checkUserCanEditOrder ( $userId, $roleId, $orderId );	//返回是否可以编辑
	}
	
	/*
     * check user can edit order
     *
     * @author zotiger
     * @created 2012-11
     */
	public static function checkUserCanEditOrder($userId, $roleId, $orderId) {
		$error = array ();
		$error ['no'] = 0;
		
		if ($roleId == 1) {	//如果是酒店管理员，酒店管理员不能编辑该订单
			$error ['no'] = 1;
			$error ['message'] = 'User can not access this page';
		} else if ($roleId == 2) {	//如果是agent user，则可以编辑自己的订单
			$sql = "select count(*) from HT_Order as A where A.`OrderUserId` = {$userId} and A.OrderId = {$orderId}";
			
			if (($orderId > 0) && (Db::getInstance ()->getValue ( $sql ) == 0)) {
				echo "error";
				$error ['no'] = 1;
				$error ['message'] = 'User can not access this page';
			}
		} else if ($roleId == 3) {	//如果是agent admin，则可以编辑该旅行社下所有订单
			$sql = "select count(*)
				from HT_Order as A, HT_User as B,
			    	(select CompanyID
			    	 from HT_User
			    	 where UserId = {$userId}
			    	) as C
				where A.`OrderUserId` = B.`UserID` and A.OrderId = {$orderId} and B.`CompanyID` = C.CompanyID";
				
			if ($orderId != 0 && Db::getInstance ()->getValue ( $sql ) == 0) {
				$error ['no'] = 1;
				$error ['message'] = 'User can not access this page';
			}
		}
		return $error;
	}
	
	/*
     * calculation booking roomplan price value and price string
     *
     * @param int $rpid room plan id
     * @param string $checkin check-in date string formatted in "YYYY-mm-dd"
     * @param string $checkout check-out date string formatted in "YYYY-mm-dd"
     *
     * @author zotiger
     * @created 2012-11-16
     * @modified 2012-11-17
     */
	public static function calculation_roomplan_price($rpid, $checkin, $checkout, $companyId) {
		$price_result = array ();
		
		$price_result ['Price'] = 0;
        $price_result ['OrgPrice'] = 0;
		$price_result ['PriceString'] = '';
		$continentCode = Tools::getUserContinentCode ( $companyId );
		
		// @TODO validation room plan info
		//
		

		// fetch roomplan info for consecutive information
		$rp_sales = RoomPlan::getRoomPlanSales ( $rpid );
		
		// fetch roomplan price info list
		$sql = "
        SELECT DATE_FORMAT(A.ApplyDate, '%Y-%m-%d') as ApplyDate, (

        						IF('{$continentCode}' = 'AS',
        								IF(A.`Asia` > 0, A.Asia, A.Price) ,
        								IF('{$continentCode}' = 'EU',
        									IF(A.`Euro` > 0, A.Euro, A.Price) ,
        									A.Price) )
        					) as Price
        FROM HT_RoomStockAndPrice as A, HT_RoomPlan as B
        WHERE A.`ApplyDate` between '{$checkin}' and DATE_SUB('{$checkout}', INTERVAL 1 DAY) and A.`RoomPlanId` = {$rpid} and B.RoomPlanId = {$rpid}
        ORDER BY A.`ApplyDate`
        ";
		 //echo $sql;

		$price_list = Db::getInstance ()->ExecuteS ( $sql );
		
		// @TODO refactoring grouping code

		// sales duration recalc for checkin-checkout
		if ($rp_sales ['ConFromTime'] < $checkin) {
			$rp_sales ['ConFromTime'] = $checkin;
		}
		
		if ($rp_sales ['ConToTime'] > $checkout && $checkout >= $rp_sales ['ConFromTime']) {
			$rp_sales ['ConToTime'] = $checkout;
		}
		
		// calc var that we can apply consecutive price
		$apply_con_var = 0;
		if ($rp_sales ['UseCon'] == 1) {
			$diff_days = (strtotime ( $rp_sales ['ConToTime'] ) - strtotime ( $rp_sales ['ConFromTime'] )) / (24 * 60 * 60);
			$apply_con_var = ( int ) ($diff_days / $rp_sales ['Nights']);
			// echo 'apply : '.$apply_con_var;
		}
		
		// ============================================================
		// grouping price string
		// ============================================================
		// each price will be demonstrated by [Price]/[Days]. For example 100$ / 1 day, 200$ / 2 days
		// we will group each values for showing. Grouping condition is that price and days value are all the same and sequential.
		// For example :
		//  100$/1day + 100$/1day + 200$/3days + 200$/3days + 200$/1day + 100$/1day will be
		//  100$/1day * 2 + 200$/3days * 2 + 200$/1day + 100$/1day
		//
		

		// initialize variables
		$rp_price = 0; // roomplan total price
		$rp_price_string = ''; // roomplan total price string
		// calc price / [n per day]
		$price = 0; // current price value
		$per_day = 1; // day
		$prev_price = 0; // previous price val
		$prev_per_day = 1; // previous day val
		$prev_day_count = 0; // counting previous same price/day pair
		$check_0=1;
        $shoushu_price=0;
        $shoushu_prev_price=0;
		foreach ( $price_list as $price_info ) {
			// if there is sales price
			if ($rp_sales ['UseCon'] == 1 && $price_info ['ApplyDate'] >= $rp_sales ['ConFromTime'] && $price_info ['ApplyDate'] <= $rp_sales ['ConToTime']) {
				// check we can apply sales condition espetially nights
				

				$diff_days = (strtotime ( $price_info ['ApplyDate'] ) - strtotime ( $rp_sales ['ConFromTime'] )) / (24 * 60 * 60);
				
				if (($diff_days / $rp_sales ['Nights']) < $apply_con_var) // if we can apply sales price
{
					// sales price
					if ($diff_days % $rp_sales ['Nights'] == 0) // we will apply sales price every first sales day
{
						
						if ($continentCode == 'AS') {
							$price_info ['Price'] = ($rp_sales ['PriceAsia'] > 0) ? $rp_sales ['PriceAsia'] : $rp_sales ['PriceAll'];
						} else if ($continentCode == 'EU') {
							$price_info ['Price'] = ($rp_sales ['PriceEuro'] > 0) ? $rp_sales ['PriceEuro'] : $rp_sales ['PriceAll'];
						} else {
							$price_info ['Price'] = $rp_sales ['PriceAll'];
						}
						$price = $price_info ['Price'];
						$per_day = $rp_sales ['Nights']; // sales day price
					} else {
						// other sales day, we can skip that
						continue;
					}
				} else { // Even sales day, the sales condition is not acceptable so that we can't apply sales price.
					$price = $price_info ['Price']; // room stock price
					$per_day = 1;
				}
			} else { // normal day, we apply room stock price
				$price = $price_info ['Price'];
				$per_day = 1;
			}
			
			// check grouping
			if ($prev_price == $price && $prev_per_day == $per_day) // the price/day pair is same with previous.
{
				$prev_day_count ++; //
			} else { // the pair isn't same, the price string will be generated.
				

				if ($prev_day_count > 0) //
{
					$rp_price_string .= "+ [ " . Tools::money ( self::shoushuliao($prev_price,$rpid)  ) . "/{$prev_per_day}day(s) X {$prev_day_count} ]";
				}
				
				//
				$prev_price = $price;
				$prev_per_day = $per_day;
				$prev_day_count = 1;
			}
			
			$rp_price += $price_info ['Price'];
            if($check_0=='0'){
                continue;
            }

            $check_0=$price_info ['Price'];
		}
		
		// finally we recheck price string.
		if ($prev_day_count > 0) {
			$rp_price_string .= "+ [ " . Tools::money (self::shoushuliao($prev_price,$rpid) ) . "/{$prev_per_day}day(s) X {$prev_day_count} ]";
		}
        $price_result ['OrgPrice'] = $rp_price;
		$price_result ['Price'] = self::shoushuliao($rp_price,$rpid);//$rp_price;
		$price_result ['PriceString'] = "" . trim ( $rp_price_string, '+' ) . " = " . Tools::money ( $price_result ['Price'] );
        $price_result ['check_0'] = $check_0;
		//echo $check_0;
		return $price_result;
	}


    public  static function shoushuliao($price,$rpid){
        $sql="
         SELECT
	c.*
FROM
	`HT_HotelRoomPlanLink` hrpl
LEFT JOIN HT_User u ON u.HotelId = hrpl.HotelId
LEFT JOIN HT_Company c ON c.CompanyId = u.CompanyID
WHERE
	hrpl.RoomPlanId = $rpid";
        $company = Db::getInstance ()->getRow ( $sql );
        //p($company);
        if($company['ShouShuType']=='1'&&$company['ShouShu']!=''&&$company['ShouShu']!='0'){
            $price=(int)$price*($company['ShouShu']/100)+(int)$price;
        }else if($company['ShouShuType']=='2'&&$company['ShouShu']!=''&&$company['ShouShu']!='0'){
            $price=(int)$price+$company['ShouShu'];
        }
        return $price;
    }

    public  static function shoushuliaoByHid($price,$hid){
        $sql="
         SELECT
	c.*
FROM
	 HT_User u
LEFT JOIN HT_Company c ON c.CompanyId = u.CompanyID
WHERE
	u.HotelId = $hid";
        $company = Db::getInstance ()->getRow ( $sql );
        //p($company);
        if($company['ShouShuType']=='1'&&$company['ShouShu']!=''&&$company['ShouShu']!='0'){
            $price=(int)$price*($company['ShouShu']/100)+(int)$price;
        }else if($company['ShouShuType']=='2'&&$company['ShouShu']!=''&&$company['ShouShu']!='0'){
            $price=(int)$price+$company['ShouShu'];
        }
        return $price;
    }

}