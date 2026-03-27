<?php 

$_COG_ALLOW_HEADER = false;
include  "_config.php"; 
?>

<div>
    <span><b>เมนูข้อมูล<?php echo $_COG_ITEM_NAME ?></b></span>
    <hr style="margin-top: 5px;margin-bottom:0" />
    <a class="left-group" data-det-group="PRODUCT" href="<?php echo $GLOBALS["ROOT"]."/ControlPanel/product/" ?>product.php"><?php echo $_COG_ITEM_NAME ?> <i class="fa fa-caret-right pull-right"></i></a>
    <a class="left-group" data-det-group="CATEGORY" href="<?php echo $GLOBALS["ROOT"]."/ControlPanel/product/" ?>productCategory.php">หมวดหมู่ <i class="fa fa-caret-right pull-right"></i></a>
    <a class="left-group hide" data-det-group="SUBCATEGORY" href="<?php echo $GLOBALS["ROOT"]."/ControlPanel/product/" ?>productSubCategory.php">หมวดหมู่ย่อยที่ 2 <i class="fa fa-caret-right pull-right"></i></a>
    <a class="left-group hide" data-det-group="SUBCATEGORY3" href="<?php echo $GLOBALS["ROOT"]."/ControlPanel/product/" ?>productSubCategory3.php">หมวดหมู่ย่อยที่ 3 <i class="fa fa-caret-right pull-right"></i></a>
    <a class="left-group hide" data-det-group="SUBCATEGORY4" href="<?php echo $GLOBALS["ROOT"]."/ControlPanel/product/" ?>productSubCategory4.php">หมวดหมู่ย่อยที่ 4 <i class="fa fa-caret-right pull-right"></i></a>
    
    <a class="left-group hide" data-det-group="TYPE" href="<?php echo $GLOBALS["ROOT"]."/ControlPanel/product/" ?>productType.php">ประเภท<?php echo $_COG_ITEM_NAME ?> <i class="fa fa-caret-right pull-right"></i></a>
    <a class="left-group hide" data-det-group="SERIES" href="<?php echo $GLOBALS["ROOT"]."/ControlPanel/product/" ?>productSeries.php">ซีรีย์<?php echo $_COG_ITEM_NAME ?> <i class="fa fa-caret-right pull-right"></i></a>
    
    <a class="left-group hide" data-det-group="BRAND" href="<?php echo $GLOBALS["ROOT"]."/ControlPanel/product/" ?>productBrand.php">ยี่ห้อ <i class="fa fa-caret-right pull-right"></i></a>
    <a class="left-group hide" data-det-group="MODEL" href="<?php echo $GLOBALS["ROOT"]."/ControlPanel/product/" ?>productModel.php">รุ่น <i class="fa fa-caret-right pull-right"></i></a>
    
    <a class="left-group hide" data-det-group="COLOR" href="<?php echo $GLOBALS["ROOT"]."/ControlPanel/product/" ?>productColor.php">สี <i class="fa fa-caret-right pull-right"></i></a>
    <a class="left-group hide" data-det-group="SIZE" href="<?php echo $GLOBALS["ROOT"]."/ControlPanel/product/" ?>productSize.php">ไซส์ <!-- Power --> <i class="fa fa-caret-right pull-right"></i></a>
    <a class="left-group hide" data-det-group="MATERIAL" href="<?php echo $GLOBALS["ROOT"]."/ControlPanel/product/" ?>productMaterial.php">Features <i class="fa fa-caret-right pull-right"></i></a>
    <a class="left-group hide" data-det-group="PROPERTIES" href="<?php echo $GLOBALS["ROOT"]."/ControlPanel/product/" ?>productProperties.php">คุณสมบัติ <i class="fa fa-caret-right pull-right"></i></a>
    <a class="left-group hide" data-det-group="TAG" href="<?php echo $GLOBALS["ROOT"]."/ControlPanel/product/" ?>productTag.php">แท็ก <i class="fa fa-caret-right pull-right"></i></a>
    <a class="left-group hide" data-det-group="STATUS" href="<?php echo $GLOBALS["ROOT"]."/ControlPanel/product/" ?>productStatus.php">สถานะ <i class="fa fa-caret-right pull-right"></i></a>
    <a class="left-group hide" data-det-group="MASTERDETAIL" href="<?php echo $GLOBALS["ROOT"]."/ControlPanel/product/" ?>masterDetail.php">รายละเอียดทั่วไป<i class="fa fa-caret-right pull-right"></i></a>

    <a class="left-group hide" data-det-group="IMPORT" href="<?php echo $GLOBALS["ROOT"]."/ControlPanel/import/" ?>importData.php"> นำเข้าข้อมูลด้วย Excel<i class="fa fa-caret-right pull-right"></i></a>

</div>
<script>
    $(".left-group[data-det-group='<?php echo $_LEFT_MENU_ACTIVE; ?>']").addClass("active");
</script>