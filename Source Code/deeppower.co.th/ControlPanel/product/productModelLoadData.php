<?php include  $_SERVER['DOCUMENT_ROOT']."/ControlPanel/assets/b4w-framework/UtilService.php"; ?>



<option value="">ไม่ระบุ</option>
<?php

$sql = "select m.*,b.BrandName from product_model m , product_brand b 
                    where b.BrandCode = m.BrandCode and m.BrandCode = :BrandCode
                    order by m.ModelCode";
$datas = SelectRows($sql, array('BrandCode' => $_GET["ref"]));
foreach ($datas as $data) {
?>
<option value="<?php echo $data["ModelCode"] ?>"><?php echo $data["ModelName"] ?></option>
<?php } ?>