<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class BookingOrderController extends FrontController
{
	public function __construct()
	{
		$this->php_self = "booking_order.php";
		
		
		parent::__construct();
	}
	public function preProcess()
	{ 
		parent::preProcess();
		
		// if (!Tools::hasFunction('room_plan_edit')) Tools::redirect('index.php');
		if ($_GET['action'] == 'customer')
		{
			$customer_info_list = array();
			for($i = 0; $i < $_GET['count']; $i++)
				{
					// default value
					$customer_info['customer_fnames'] = '';
					$customer_info['customer_gnames'] = '';
					$customer_info['customer_sex'] = 1; // male
					$customer_info['customer_country'] = 109; // japan
					
					$customer_info_list[]= $customer_info;
				}
			self::$smarty->assign("count", $_GET['count']);
			self::$smarty->assign("id", $_GET['id']);
			self::$smarty->assign("countries", Tools::getCountries());
			self::$smarty->assign("customers", $customer_info_list);
			self::$smarty->display(_TAS_THEME_DIR_.'booking_sub_customer.tpl');
			exit();
		}

        if ($_POST['booking'] == 'edit')
        {
            // check that user has privilege editing this order
            $orderId = $_GET['oid'];

            if ($orderId == '')
                return;
            $error = Booking::checkUserCanEditOrder(self::$cookie->UserID, self::$cookie->RoleID, $orderId);
            if ($error['no'] > 0)
            {
                self::$smarty->assign("error", $error);
                self::$smarty->display(_TAS_THEME_DIR_.'error_redirect.tpl');
                exit();
            }
        }

        $booking_info = array();

        if ($_POST['booking'] == 'order')
        {
            // new booking order rooms
            $param_id_amounts = $_POST['plan_id_amount']; // the array in formated [planid]_[count]

            $_POST['ids'] = array();
            // $_POST['roomplan_ids'] = array();
            $id = 0;

            foreach($param_id_amounts as $id_amount)
            {
                // $chars = preg_split('/_/', $param_plan_id); // split [room plan id]_[count]
                $chars = explode("_", $id_amount);
                $rpid = $chars[0];

                for ($i = 0; $i < $chars[1]; $i++)
                {
                    $_POST['ids'][] = $id;
                    $_POST['or_ids_'.$id] = 0; // new order roomplan
                    $_POST['roomplan_ids_'.$id] = $rpid;
                    $id++;
                }
                // $_POST['roomplan_counts_'.$rpid] = $chars[1];
            }

            $booking_info = Booking::buildBookingInfoFromPost(self::$cookie->CompanyID);

            $booking_info ['OrderUserId'] = self::$cookie->UserID; //获取用户ID
            $booking_info ['paymentMethod'] = Member::getPaymentMethod ( self::$cookie->CompanyID );

            $order_id = Booking::insertNewBooking ( $booking_info );
            $booking_info = Booking::getBookingInfo ( $order_id );
            // echo 'order_id = '.$order_id;
            // print_r($booking_info);
            // print_r(self::$cookie->CompanyID);
			self::$smarty->assign("language", "order");
            self::$smarty->assign("method", "order");
        }
        else
        {
            $this->brandNavi[] = array("name"=>"Booking List", "url"=>'booking_list.php');
            // edit
            $booking_info = Booking::getBookingInfo($_GET['oid']);

             //print_r($booking_info);
            if ($booking_info)
            {
                $this->brandNavi[] = array("name" => "Booking No:" . $booking_info['BookingNo'], "url" => 'booking_order.php?booking=edit&oid=' . $booking_info['order_id'], "nolang" => 1);
            }
            if (!$booking_info) // empty
            {
                $booking_info = Booking::getBookingInfo_del($_GET['oid']);
                $this->brandNavi[] = array("name"=>"Booking No:".$booking_info['BookingNo'], "url"=>'booking_order.php?booking=edit&oid='.$booking_info['order_id'], "nolang" =>1);
                if (!$booking_info) // empty del
                {
                    // redirect
                    Tools::redirect('index.php');
                }
            }

            self::$smarty->assign("method", "edit");

        }
        self::$smarty->assign("booking_info", $booking_info);
        // $this->booking_info = $booking_info;
        // $roomtype_list = RoomPlan::getRoomTypeList();
        //
	}
	
	/* booking order page
	 *
	 * user can access this page two methods.
	 *	1) from booking page(search hotel page), user can book new order. url : booking_order.php?booking=order
	 *	2) from booking list page, user can edit user's booking order. url : booking_order.php?booking=edit&oid=[order id]
	 *
	 * @author zotiger
	 * @created 2012-11-08
	 * @modified 2012-11-12 add code check authorization.
	 * @modified 2012-11-21 show booked room plan list changed.(not used roomplan_counts val)
	 * @modified 2012-12-14 move code to preprocess for navi menu.
	 */
	public function process()
	{
		global $cookie;

        if ($_POST["booking"] != 'order' && $_REQUEST["booking"] != 'edit'  ) {
			// redirect 
			Tools::redirect('index.php');
		}

		self::$smarty->assign("countries", Tools::getCountries());
		// self::$smarty->assign("roomplan_list", $roomplan_list);
		
		parent::process();
	}
	
	
	public function setMedia() {
		parent::setMedia();
		Tools::addJS(_THEME_JS_DIR_.'slider.js');
		Tools::addJS(_THEME_JS_DIR_.'slides.min.jquery.js');
		Tools::addJS(_THEME_JS_DIR_.'jquery.slide.js');		
	}
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display(_TAS_THEME_DIR_.'booking_order.tpl');
	}
}
