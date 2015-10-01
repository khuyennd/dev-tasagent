<?php
	error_reporting(0);
	date_default_timezone_set('Asia/Tokyo');	
	$date = date('Y-m-d H:i:s', strtotime("-30 minutes"));
	
	$db_info = array();
	$db_info['host']     = 'localhost';
	$db_info['name']     = 'hotel';
	$db_info['user']     = 'dev';
	$db_info['password'] = '1qaz2wsx';
	
	$link = @mysql_connect($db_info['host'], $db_info['user'], $db_info['password']);
	if(!$link) exit ;
	@mysql_select_db($db_info['name'], $link);

	$sql = "select `OrderId`, `OrderStatusId`, `CheckInDate`, `CheckOutDate` from `HT_Order` where `BookingNo` = '' and last_time < '".$date."'";
	$results = mysql_query($sql);
	
	while ($exist_booking_info = mysql_fetch_assoc($results)) {
		$new_order_id = $exist_booking_info ['OrderId'];
		if ($exist_booking_info ['OrderStatusId'] != 2) {
			$sql = "UPDATE HT_RoomStockAndPrice as A right join (
						SELECT B.`RoomPlanId`, count(B.`RoomPlanId`) as OrderCount 
						FROM HT_Order as A, HT_OrderRoom as B
						WHERE A.`OrderId` = B.`OrderId`	and A.`OrderId` = {$new_order_id}
						GROUP BY B.`RoomPlanId`
					) AS B on A.`RoomPlanId` = B.RoomPlanId
				SET A.Amount = greatest(A.Amount + B.OrderCount, 0)
				WHERE A.`ApplyDate` between '{$exist_booking_info['CheckInDate']}' and DATE_SUB('{$exist_booking_info['CheckOutDate']}'	, INTERVAL 1 DAY)";
			mysql_query ( $sql );
		}
		
		$sql = "DELETE FROM A, B USING HT_OrderCustomer as A, HT_OrderRoom as B
				WHERE A.`OrderRoomId` = B.`OrderRoomId` AND  B.`OrderId` = {$new_order_id}";
		mysql_query ( $sql );
	}
	
	$sql = "delete from HT_Order where `BookingNo` = '' and last_time < '".$date."'";
	mysql_query($sql);

	mysql_close($link);
?>
