<?php $_COG_ITEM_CODE = 'PRODUCT'; ?>
<?php include  "../header.php"; ?>
<?php include  "_config.php"; ?>
<?php $IsBrandImg = false; ?>

<?php 

if(isset($_POST["btnDeleteRow"])){
    $sql = "delete from product_brand where BrandCode = :BrandCode";
    ExecuteSQL($sql, array('BrandCode' => $_POST["btnDeleteRow"]));
    
    $sql = "update product set BrandCode = '',ModelCode = '' where BrandCode = :BrandCode";
    ExecuteSQL($sql, array('BrandCode' => $_POST["btnDeleteRow"]));
}

?>


<div class="mat-box grey-bar">

    <a href="product.php" class="link-history-btn">หน้าหลักข้อมูล<?php echo $_COG_ITEM_NAME ?></a>
    /
    <span class="link-history-btn">รายการยี่ห้อ<?php echo $_COG_ITEM_NAME ?></span>

</div>


<div class="mat-box" style="border-radius: 0 0 3px 3px">
    <div class="row">
       <div class="col-md-3">
            <?php 
            $_LEFT_MENU_ACTIVE = "BRAND";
            include "leftMenu.php";
            ?>
        </div>
        <div class="col-md-9">
            <div>
                <a href="productBrandDetail.php" class="pull-right">
                    <i class="fa fa-plus"></i>
                    เพิ่มรายการยี่ห้อ<?php echo $_COG_ITEM_NAME ?>
                </a>
                <span><b>รายการยี่ห้อ<?php echo $_COG_ITEM_NAME ?></b></span>
                <hr style="margin-top: 5px;" />
            </div>

            

            <table class="jquery-datatable display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style="width:50px;">รหัส</th>
                        <th>ชื่อยี่ห้อ<?php echo $_COG_ITEM_NAME ?></th>
                        <th style="width:50px;" class="text-center">ใช้งาน</th>
                        <th style="width:50px;" class="text-center">จัดการ</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>รหัส</th>
                        <th>ชื่อยี่ห้อ<?php echo $_COG_ITEM_NAME ?></th>
                        <th class="text-center">ใช้งาน</th>
                        <th class="text-center">จัดการ</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    
                    $sql = "select * from product_brand order by BrandCode";
                    $datas = SelectRowsArray($sql);
                    foreach ($datas as $data) {
                    ?>
                    <tr>
                        <td><?php echo $data["BrandCode"] ?></td>
                        <td>
                        <?php if($IsBrandImg){ ?>
                        <img src="<?php echo $data["Image"] ?>" width="40" height="30" alt="<?php echo $data["BrandName"] ?>">
                        <?php } ?>
                        <?php echo $data["BrandName"] ?>

                        </td>
                        <td class="text-center">
                            <?php echo $data["Active"] == 1 ? "ใช้งาน" : "ไม่ใช้งาน" ?>
                        </td>
                        <td class="text-center">
                            <a href="productBrandDetail.php?ref=<?php echo $data["BrandCode"] ?>">
                                <i class="fa fa-cog"></i>
                            </a>

                            <form method="post" style="display:inline">
                                <button type="submit" class="btn-link" 
                                    onclick="return Confirm(this,'ต้องการลบรายการนี้หรือไม่ ?');"
                                    value="<?php echo $data["BrandCode"] ?>" name="btnDeleteRow">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<?php include  "../footer.php"; ?>