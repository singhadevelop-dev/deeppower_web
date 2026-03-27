<?php 
include_once "../../../_cogs.php";
include_once  "../../assets/b4w-framework/UtilService.php";
include_once  "../AbstractAPI.php";
libxml_use_internal_errors(true);
$abst = new AbstractAPI();
try {
    if(!UserService::_IsAdmin()){
        new Exception("Not allowed function!");
    }
    $method = $_SERVER['REQUEST_METHOD'];
    $user_id = UserService::UserCode();
    switch($method)
    {
        case "POST" :
            if($_POST["action"] == "UPDATE_STATUS"){
                $checkOutCode = UpdateCheckoutStatus($_POST,$user_id);
                $abst->OK("อัพเดตสถานะสำเร็จแล้ว.",$checkOutCode);
            }else if($_POST["action"] == "POST_DELIVERY"){
                $checkOutCode = UpdateCheckoutDelivery($_POST,$user_id);
                $abst->OK("อัพเดตสถานะสำเร็จแล้ว.",$checkOutCode);
            }
            break;
        default : 
            throw new Exception("Not allowed function!");
    }
} catch (Exception $e) {
    $abst->BadRequest($e->getMessage(),null);
}

function UpdateCheckoutStatus($data,$user_id)
{
    $ponumber = $data["ponumber"];
    $status = $data["status"];
    $sql = " update checkout set
        StatusCode = :StatusCode, UpdatedOn=now(), UpdatedBy=:UpdatedBy
        where CheckOutCode = :CheckOutCode ";
    ExecuteSQL($sql, array('StatusCode' => $status, 'UpdatedBy' => $user_id, 'CheckOutCode' => $ponumber));
    return $ponumber;

}
function UpdateCheckoutDelivery($data,$user_id){
    $ponumber = $data["ponumber"];
    $status = $data["status"];
    $ship_number = $data["shipping_number"];
    $ship_url = $data["shipping_url"];
    $sql = " update checkout set
        StatusCode = :StatusCode,
        DelivieryCode = :DelivieryCode,
        DelivieryURL = :DelivieryURL,
        UpdatedOn=now(), UpdatedBy=:UpdatedBy
        where CheckOutCode = :CheckOutCode ";
    ExecuteSQL($sql, array('StatusCode' => $status, 'DelivieryCode' => $ship_number, 'DelivieryURL' => $ship_url, 'UpdatedBy' => $user_id, 'CheckOutCode' => $ponumber));
    $statusDesc =  GetPOStatusDesc($status);
    SendEmailPODelivery($ponumber, "อีเมล์แจ้ง$statusDesc ใบสั่งซื้อเลขที่: $ponumber");
    return $ponumber;
}


?>