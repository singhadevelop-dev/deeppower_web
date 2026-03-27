<?php 
include_once "../../_cogs.php";
include_once  "../assets/b4w-framework/UtilService.php"; 

//$_USER_ID = UserService::UserCode();
$_STATUS_CODE = $_GET["status"];
$_START_ROW = intval($_GET["item"]);
$whereStatus = " and StatusCode='$_STATUS_CODE' ";
$sortby = ($_STATUS_CODE == "SUCCESS" ? " desc " : " asc ");
$sqlProduct = "select p.seq,p.ProductCode,p.ProductName,p.Image
    ,cart.QTY,cart.Price as CartPrice, p.OldPrice 
    ,cart.Total
    ,cart.SEQ ,cart.CheckOutCode ,po.CreatedOn, po.UpdatedOn
    ,po.StatusCode 
    ,po.Total as POTotal
    ,po.DeliveryPrice
    ,po.Net as PONet
    ,po.Name ,po.Phone, po.Address, po.PostCode
    ,co.TagName as ColorName, si.TagName as SizeName
    ,b.Name as DelivieryName
    ,po.DelivieryCode
    ,po.DelivieryURL
    ,po.Image as POImage
    from (
        select * from checkout
        where 1=1 
         $whereStatus
        ORDER by CreatedOn $sortby
        limit $_START_ROW,10 
    ) po
    join cart on cart.CheckOutCode = po.CheckOutCode
    join product p
        on p.ProductCode = cart.ProductCode
    left join tag co on cart.Color = co.TagCode and co.TagType = 'COLOR'
    left join tag si on cart.Size = si.TagCode and si.TagType = 'SIZE'
    left join delivery_category b on po.DelivieryCode = b.Code
    
    order by po.CreatedOn $sortby ,cart.SEQ 
    ";
$dataPrd = SelectRowsArray($sqlProduct,array());


$_CART_LIST = array();
foreach ($dataPrd as $cart) {
    if(!isset($_CART_LIST[$cart["CheckOutCode"]])){
        $_CART_LIST[$cart["CheckOutCode"]] = array();
    }
    array_push($_CART_LIST[$cart["CheckOutCode"]],$cart);
}

$round = 0;
$netPriceTotal = 0;
$deliveryTotal = 0;
foreach ($_CART_LIST as $shop)
{
    $round++;
?>
    <div class="row item-order">
        <div class="col-md-12">
            <div class="bg-white mb-3">
                <div class="px-3 pb-3">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-check-list">
                                <thead>
                                    <tr>
                                        <td colspan="3">
                                            <div>
                                                <img src="<?php echo SystemConfig::cogs_logo_path() ?>"
                                                    class="shadow-sm" width="30" height="30"
                                                    style="object-fit: cover;border-radius: 50%;">
                                                    &nbsp;
                                                <small class="text-secondary"> (<?php echo ConvertDateTimeDBToDateTimeDisplay($shop[0]["CreatedOn"]) ?>)</small>
                                            </div>
                                        </td>
                                        <td class="text-right td-p-price text-header">
                                            <div class="text-desc">
                                                <b class="text-shop"> <?php if($shop[0]["StatusCode"] == "SUCCESS") { ?> <i class="fas fa-money-bill-wave-alt"></i>&nbsp;<?php echo ConvertDateTimeDBToDateTimeDisplay($shop[0]["UpdatedOn"]) ?> | <?php } ?> <?php echo GetPOStatusDesc($shop[0]["StatusCode"]) ?></b>
                                            </div>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
                                        foreach ($shop as $cart) {
                                    ?>
                                    <tr>
                                        <td class="td-image">
                                            <img src="<?php echo ResizeImage($cart["Image"],60) ?>" width="40" height="40" class="image-product">
                                        </td>
                                        <td class="td-p-name">
                                            <div class="two-line">
                                                <label class="text-shop"><?php echo $cart["ProductName"] ?></label>
                                            </div>
                                            <?php if(!empty($cart["ColorName"])){ ?>
                                            <div><small>สี : <?php echo $cart["ColorName"] ?></small></div>
                                            <?php } ?>
                                            <?php if(!empty($cart["SizeName"])){ ?>
                                            <div><small>ไซต์ : <?php echo $cart["SizeName"] ?></small></div>
                                            <?php } ?>
                                        </td>
                                        <td><div class="text-shop">x <?php echo number_format($cart["QTY"]) ?></div></td>
                                        <td class="text-right td-p-price">
                                            <div class="text-shop">฿<?php echo number_format($cart["Total"]) ?></div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-7">
                                <div class="pl-3">
                                    <label><?php echo $shop[0]["Name"] ?> </label>
                                    <div><?php echo $shop[0]["Address"]." ".$shop[0]["PostCode"] ?></div>
                                    <div>คำสั่งซื้อเลขที่ : <a href="transactionDetail.php?b=order&ref=<?php echo $shop[0]["CheckOutCode"] ?>" target="_bank"><b><?php echo $shop[0]["CheckOutCode"] ?></b></i></a></div>
                                    <div>เบอร์โทร : <?php echo $shop[0]["Phone"] ?></div>
                                    <?php if(!empty($shop[0]["DelivieryCode"])){ ?>
                                    <div>เลขที่จัดส่ง : <a href="<?php echo $shop[0]["DelivieryURL"] ?>" target="_bank"><?php echo $shop[0]["DelivieryCode"] ?></a> &nbsp;&nbsp;<i class="fa fa-pencil-square text-primary c-pointer btn-delivery-orders" data-ponumber="<?php echo $shop[0]["CheckOutCode"]; ?>" data-ship_no="<?php echo $shop[0]["DelivieryCode"]; ?>" data-status="SUCCESS" aria-hidden="true"></i> </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-5">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-7 col-lg-7 text-right">
                                        <div class="pl-5 pt-1">
                                            ยอดรวมสินค้า:
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5 text-right">
                                        <div class="text-shop"><b>฿<?php echo number_format($shop[0]["POTotal"],2) ?></b></div>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-7 col-lg-7 text-right">
                                        <div class="pl-5 pt-1">
                                            ส่วนลด:
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5 text-right">
                                        <div class="text-shop"><b>฿<?php echo number_format($shop[0]["Discount"],2) ?></b></div>
                                    </div>
                                </div> -->
                                <!-- <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-7 col-lg-7 text-right">
                                        <div class="pl-5 pt-1">
                                            ค่าจัดส่ง:
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5 text-right">
                                        <div class="text-shop"><b>฿<?php echo number_format($shop[0]["DeliveryPrice"],2) ?></b></div>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-7 col-lg-7 text-right">
                                        <div class="pl-5 pt-1">
                                            การชำระเงินทั้งหมด:
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5 text-right">
                                        <h4 class="text-shop"><b>฿<?php echo number_format($shop[0]["PONet"],2) ?></b></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 text-right">
                                <?php $isSlip = !empty($shop[0]["POImage"]);  ?>
                                <?php if($isSlip){ ?>
                                แนบสลิปโอนเงิน: <a class="transactionimg" href="<?php echo $isSlip ? $shop[0]["POImage"] : "#"  ?>"><i class="fa fa-list"></i> ดูรายละเอียด</a>
                                <?php }else{ ?>
                                    แนบสลิปโอนเงิน: <span class="text-danger">ไม่พบการแนบสลิปโอนเงิน</span>
                                <?php } ?>
                            </div>
                            <div class="col-md-2 text-right">
                                <div class="">
                                    <?php if(empty($shop[0]["StatusCode"]) || $shop[0]["StatusCode"] == "WAITING"){ ?>
                                        <a href="Javascript:;" class="btn btn-warning btn-md btn-order btn-transfer-payment" data-ponumber="<?php echo $shop[0]["CheckOutCode"]; ?>" data-status="PAID">ยืนยันชำระเงินแล้ว</a>
                                    <?php }else if($shop[0]["StatusCode"] == "PAID"){ ?>
                                        <a href="Javascript:;" class="btn btn-primary btn-md btn-order btn-delivery-orders" data-ponumber="<?php echo $shop[0]["CheckOutCode"]; ?>" data-status="SUCCESS">ยืนยันจัดส่งแล้ว</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php 
    if($round <= 0){
?>
    <div style="padding: 2rem;">
        <div class="alert alert-warning text-center">
           <b>ไม่พบใบสั่งซื้อที่สถานะนี้.</b>
        </div>
    </div>
    
<?php } ?>

<?php if(empty($shop[0]["StatusCode"]) || $shop[0]["StatusCode"] == "WAITING" || $shop[0]["StatusCode"] == "PAID"){ ?>
<script>
    $(".btn-transfer-payment").on('click',function(){
        if(AlertConfirm($(this),"ยืนยันรายการ?")){
            var dataPost = {
                ponumber : $(this).data("ponumber"),
                status : $(this).data("status"),
                action : "UPDATE_STATUS"
            };
            PostTransectionsAPI("<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/api/order/",dataPost,function(data,method,ele){
                if(data.status == "OK"){
                    AlertSuccess('อัพเดตสถานะสำเร็จแล้ว');
                    _load_orders_list('<?php echo $shop[0]["StatusCode"] ?>');
                }else{
                    AlertError(data.message == undefined ? data : data.message);
                }
            },"POST");
        }
    });
</script>
<?php } ?>

<?php if($_STATUS_CODE == "PAID" || $_STATUS_CODE == "SUCCESS"){ ?>
<div id="modal-delivery-order" class="modal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <form id="form-modal-delivery-order" method="post" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">
                    <i class="fa fa-truck"></i>&nbsp;บันทึกการส่งสินค้า
                </h4>
            </div>
            <div class="modal-body" style="background: #f7f7f7">
                <div class="row">
                    <div class="col-md-12">
                        <label>เลขที่ใบส่งของ [ตัวอย่าง : EF582568151TH]</label>
                        <input type="text" name="txtModalDeliveryShippingNumber" class="form-control" maxlength="50" required placeholder="เลขที่...">
                    </div>
                </div>
                <div class="row pt-1">
                    <div class="col-md-12">
                        <label>Url สำหรับเรียกดูสถานะการส่งของ [ตัวอย่างไปรษณีย์ไทย : https://track.thailandpost.co.th/?trackNumber=EF582568151TH]</label>
                        <input type="text" name="txtModalDeliveryShippingURL" class="form-control" maxlength="200" placeholder="" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" name="hddModalDeliveryCheckOutCode">
                        <input type="hidden" name="hddStatusView" value="">
                        <button name="btnDeliveryProduct" type="submit" class="btn btn-round btn-primary">บันทึก</button>
                        <button name="btnClose" type="button" class="btn btn-round btn-secondary" data-dismiss="modal"> ปิด </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(".btn-delivery-orders").on('click',function(){
        var target = $("#modal-delivery-order");
        var ship_no = $(this).data("ship_no");
        if(ship_no == undefined)
        {
            ship_no = "";
        }
        $(target).find("[name='hddModalDeliveryCheckOutCode']").val($(this).data("ponumber"));
        $(target).find("[name='txtModalDeliveryShippingNumber']").val(ship_no);
        $(target).find("[name='txtModalDeliveryShippingURL']").val("https://track.thailandpost.co.th/?trackNumber=" + ship_no);
        $(target).modal('show');
    });
    $("#form-modal-delivery-order").submit(function(){
        var dataPost = {
            ponumber : $("[name='hddModalDeliveryCheckOutCode']").val(),
            status: "SUCCESS",
            shipping_number: $("[name='txtModalDeliveryShippingNumber']").val(),
            shipping_url : $("[name='txtModalDeliveryShippingURL']").val(),
            action: "POST_DELIVERY"
        };
        PostTransectionsAPI("<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/api/order/",dataPost,function(data,method,ele){
            console.log(data);
            if(data.status == "OK"){
                AlertSuccess('สินค้าจัดส่งแล้ว');
                $("#modal-delivery-order").modal('hide');
                _load_orders_list("<?php echo $_STATUS_CODE ?>");
            }else{
                AlertError(data.message == undefined ? data : data.message);
            }
        },"POST");
        return false;
    });
</script>

<?php } ?>
