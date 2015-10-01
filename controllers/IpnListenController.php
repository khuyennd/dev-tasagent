<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ZhangYang
 * Date: 13-4-10
 * Time: 下午12:14
 */
if (!defined('IN_TAS')) {
    exit('Access Denied');
}
class IpnListenController
{
    public function __construct()
    {
        $this->php_self = "ipnlisten.php";

    }

    public function run()
    {

        $logStr = "";
        $logFd = fopen(PAYPAL_IPN_LOG, "a");
        //$booking_info = Booking::getBookingInfoByBN('TASF0000427');
      // p($booking_info);

        fwrite($logFd, "******************************START*****************************************************************\n");
        //echo PAYPAL_IPN_LOG;
        if (array_key_exists("txn_id", $_POST)) {
            $logStr = "Received IPN,  TX ID : " . htmlspecialchars($_POST["txn_id"]);
            fwrite($logFd, strftime("%d %b %Y %H:%M:%S ") . "[IPNListner.php] $logStr\n");
        } else {
            $logStr = "IPN Listner recieved an HTTP request with out a Transaction ID.";
            fwrite($logFd, strftime("%d %b %Y %H:%M:%S ") . "[IPNListner.php] $logStr\n");
            fclose($logFd);
            exit;
        }
        //从 PayPal 出读取 POST 信息同时添加变量?cmd?
        $req = 'cmd=_notify-validate';
        foreach ($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $req .= "&$key=$value";
        }
        //建议在此将接受到的信息记录到日志文件中以确认是否收到 IPN 信息
        $tmpAr = array_merge($_POST, array("cmd" => "_notify-validate"));
        $postFieldsAr = array();
        foreach ($tmpAr as $name => $value) {
            $postFieldsAr[] = "$name=$value";
        }
        $logStr = "Sending IPN values:\n" . implode("\n", $postFieldsAr);
        fwrite($logFd, strftime("%d %b %Y %H:%M:%S ") . "[IPNListner.php] $logStr\n");
        //将信息 POST 回给 PayPal 进行验证
        $ppResponseAr = Utils::PPHttpPost("https://www." . DEFAULT_ENV . ".paypal.com/cgi-bin/webscr", implode("&", $postFieldsAr), false);
        if (!$ppResponseAr["status"]) {
            fwrite($logFd, "--------------------\n");
            $logStr = "IPN Listner recieved an Error:\n";
            if (0 !== $ppResponseAr["error_no"]) {
                $logStr .= "Error " . $ppResponseAr["error_no"] . ": ";
            }
            $logStr .= $ppResponseAr["error_msg"];
            fwrite($logFd, strftime("%d %b %Y %H:%M:%S ") . "[IPNListner.php] $logStr\n");
            fclose($logFd);
            exit;
        }
        //将 POST 变量记录在本地变量中
        //该付款明细所有变量可参考：
        //https://www.paypal.com/IntegrationCenter/ic_ipn-pdt-variable-reference.html
        $item_name = $_POST['item_name'];
        $item_number = $_POST['item_number'];
        $payment_status = $_POST['payment_status'];
        $payment_amount = $_POST['mc_gross'];
        $payment_currency = $_POST['mc_currency'];
        $txn_id = $_POST['txn_id'];
        $receiver_email = $_POST['receiver_email'];
        $payer_email = $_POST['payer_email'];
        //…
        //判断回复 POST 是否创建成功
        fwrite($logFd, "--------------------\n");
        $logStr = "IPN Post Response:\n" . $ppResponseAr["httpResponse"];
        fwrite($logFd, strftime("%d %b %Y %H:%M:%S ") . "[IPNListner.php] $logStr\n");

        $res = $ppResponseAr["httpResponse"];
        //已经通过认证
        if (strcmp($res, "VERIFIED") == 0) {
            fwrite($logFd, "----- VERIFIED -----------\n");
            //检查付款状态
            fwrite($logFd, "----- Payment Status:$payment_status -----------\n");
            if ($payment_status == "Completed") {
                //检查 txn_id  是否已经处理过
                fwrite($logFd, "-----Check Transaction ID :$txn_id-----------\n");
                //检查 receiver_email 是否是您的 PayPal 账户中的 EMAIL 地址
                fwrite($logFd, "-----Check Receiver_email :$receiver_email-----------\n");
                if ($receiver_email != DEFAULT_EMAIL_ADDRESS) {
                    fwrite($logFd, "----- Receiver_email Error :$receiver_email-----------\n");
                } else {
                    //检查付款金额和货币单位是否正确
                    //todo:$ammount

                    $booking_info = Booking::getBookingInfoByBN($item_name);
                    // fwrite($logFd, "-----Booking Info :-----------\n");
                    //fwrite($logFd, var_dump($booking_info));

                    $ammount = $booking_info ['money'];
                    fwrite($logFd, "-----Check Payment Amount :$payment_amount-----------\n");
                    fwrite($logFd, "-----Check Payment Currency :$payment_currency-----------\n");
                    if ($payment_currency != DEFAULT_PAYMENT_CURRENCY) {
                        fwrite($logFd, "-----Payment Currency Error :$payment_currency-----------\n");
                    } elseif ($payment_amount != $ammount) {
                        fwrite($logFd, "-----Payment Error :$payment_amount---$ammount--------\n");
                    } else {
                        //处理这次付款，包括写数据库
                        fwrite($logFd, "----- changeBookingStatus  -----------\n");
                        Booking::changeBookingStatus($booking_info ['order_id'], 4);
                        fwrite($logFd, "----- changePayStatus  -----------\n");
                        Booking::changePayStatus($booking_info ['order_id'], 2);
                        fwrite($logFd, "----- payment  -----------\n");
                        Booking::payment($booking_info ['order_id'], $payment_amount);
                        //下订单成功,此时需要发送邮件
                        fwrite($logFd, "----- ordermail  -----------\n");
                        Tools::ordermail($booking_info ['order_id']);
                        fwrite($logFd, "----- finish  -----------\n");
                    }
                }
            }
        } else if (strcmp($res, "INVALID") == 0) {
            //未通过认证，有可能是编码错误或非法的 POST 信息
            fwrite($logFd, "----- INVALID -----------\n");
        }
        fwrite($logFd, "***********************************END**************************************************************\n");
        fclose($logFd);
    }
}