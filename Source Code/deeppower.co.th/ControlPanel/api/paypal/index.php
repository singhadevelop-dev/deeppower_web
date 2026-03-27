<?php
include_once "../../../_cogs.php";
include_once  "../../assets/b4w-framework/UtilService.php";
include_once  "../AbstractAPI.php";
libxml_use_internal_errors(true);
$abst = new AbstractAPI();
try {
    $action = $_SERVER['REQUEST_METHOD'];
    switch($action)
    {
        case "POST" :
            $userid = GetCookieClientID();
            UpdateOrderPayment($userid,$_POST);
            $abst->OK("Payment Complete!","");
            break;
        default : 
            throw new Exception("Not allowed function!");
    }
} catch (Exception $e) {
    $abst->BadRequest($e->getMessage(),null);
}

function UpdateOrderPayment($userid,$data)
{
    $paymentToken = $data["paymentToken"];
    $orderID = $data["orderID"];
    $payerID = $data["payerID"];
    $paymentID = $data["paymentID"];
    $intent = $data["intent"];
    $status = $data["status"];
    $merchant = $data["merchant"];
    $email = $data["email"];
    $createdOn = $data["create_time"];
    $checkout_code = $data["checkout_code"];
    $checkOutType = $data["checkout_type"];
    $clientid = $data["clientid"];
    
    $selectSub = SelectRowsArray(" select * FROM checkout WHERE CheckOutCode= :CheckOutCode and ClientID= :ClientID "
        , array('CheckOutCode' => $checkout_code, 'ClientID' => $clientid));
    if(count($selectSub) > 0)
    {
        ExecuteSQL(" Update checkout 
                Set StatusCode='PAID',
                PaymentType= :PaymentType,
                UpdatedOn=Now(),
                UpdatedBy= :UpdatedBy, 
                Paypal_PaymentToken= :Paypal_PaymentToken,
                Paypal_OrderID = :Paypal_OrderID,
                Paypal_PayerID= :Paypal_PayerID,
                Paypal_PaymentID= :Paypal_PaymentID,
                Paypal_Intent= :Paypal_Intent,
                Paypal_Status= :Paypal_Status,
                Paypal_Merchant= :Paypal_Merchant,
                Paypal_Email= :Paypal_Email,
                Paypal_CreatedOn= :Paypal_CreatedOn
                Where CheckOutCode= :CheckOutCode "
            , array(
                'PaymentType' => $checkOutType,
                'UpdatedBy' => $userid, 
                'Paypal_PaymentToken' => $paymentToken,
                'Paypal_OrderID' => $orderID,
                'Paypal_PayerID' => $payerID,
                'Paypal_PaymentID' => $paymentID,
                'Paypal_Intent' => $intent,
                'Paypal_Status' => $status,
                'Paypal_Merchant' => $merchant,
                'Paypal_Email' => $email,
                'Paypal_CreatedOn' => $createdOn,
                'CheckOutCode' => $checkout_code
            ));
            SendEmailPO($checkout_code,"อีเมล์ยืนยันชำระเงินใบสั่งซื้อเลขที่: $checkout_code");
    }
    else
    {
        throw new Exception("เกิดข้อผิดพลาด กรุณาติดต่อเจ้าหน้าที่เพื่อตรวจสอบรายการ[$checkout_code]!");
    }
}


?>