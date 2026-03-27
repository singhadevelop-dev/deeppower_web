<?php include  "../header.php"; ?>
<?php include  "_config.php"; ?>

<?php 
if(isset($_POST["btnDeleteRow"])){
    $sql = "delete from portfolio where PortCode = :PortCode";
    ExecuteSQL($sql, array('PortCode' => $_POST["btnDeleteRow"]));
    $sql = "delete from gallery where RefCode = :RefCode";
    ExecuteSQL($sql, array('RefCode' => $_POST["btnDeleteRow"]));
}
?>
<div class="mat-box grey-bar">
    <a href="item.php" class="link-history-btn">หน้าหลัก<?php echo $_COG_ITEM_NAME ?></a>
    /
    <span class="link-history-btn">รายการ<?php echo $_COG_ITEM_NAME ?></span>
</div>
<div class="mat-box" style="border-radius: 0 0 3px 3px">
    <div class="row">
        <?php if($_COG_ALLOW_LEFT_MENU){ ?>
        <div class="col-md-2">
            <?php $_LEFT_MENU_ACTIVE = "ITEM"; ?>
            <?php include_once  "leftMenu.php"; ?>
        </div>
        <?php } ?>
        <div class="col-md-<?php echo $_COG_ALLOW_LEFT_MENU ? "10" : "12" ?>">
            <div>
                <a href="itemDetail.php" class="pull-right">
                    <i class="fa fa-plus"></i>
                    เพิ่มรายการ<?php echo $_COG_ITEM_NAME ?>
                </a>
                <span><b>รายการ<?php echo $_COG_ITEM_NAME ?></b></span>
                <hr style="margin-top: 5px;" />
                <table 
                    data-sortable-table="portfolio"
                    data-sortable-column-seq="SEQ"
                    data-sortable-column-key="PortCode"
                    class="jquery-datatable sortable-table table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center" style="width:10px;">#</th>
                        <?php if($_COG_ALLOW_CATEGORY){ ?>
                        <th>หมวดหมู่</th>
                        <?php } ?>
                        <th>หัวข้อ<?php echo $_COG_ITEM_NAME ?></th>
                        <?php if($_COG_ALLOW_FIRST_SHORT_DESCRIPTION){ ?>
                        <th style="width:200px;" >รายละเอียด</th>
                        <?php } ?>
                        <th style="width:50px;" class="text-center">ใช้งาน</th>
                        <th style="width:100px;" class="text-center">จัดการ</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-center">#</th>
                        <?php if($_COG_ALLOW_CATEGORY){ ?>
                        <th>หมวดหมู่</th>
                        <?php } ?>
                        <th>หัวข้อ<?php echo $_COG_ITEM_NAME ?></th>
                        <?php if($_COG_ALLOW_FIRST_SHORT_DESCRIPTION){ ?>
                        <th>รายละเอียด</th>
                        <?php } ?>
                        <th style="width:50px;" class="text-center">ใช้งาน</th>
                        <th style="width:100px;" class="text-center">จัดการ</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $sql = "select p.*,c.CategoryName from portfolio p 
                    left join product_category c on c.CategoryCode = p.CategoryCode
                    where p.PortType = :PortType order by p.seq,p.PortCode";
                    $datas = SelectRows($sql, array('PortType' => $_COG_ITEM_CODE));
                    $inx = 1;
                    foreach ($datas as $data) {
                    ?>
                    <tr data-sortable-row-key="<?php echo $data["PortCode"] ?>">
                        <td class="text-center"><?php echo $inx++; ?></td>
                        <?php if($_COG_ALLOW_CATEGORY){ ?>
                        <td style="width:200px;"><?php echo empty($data["CategoryName"]) ? "ไม่ได้ระบุหมวดหมู่" : $data["CategoryName"] ?></td>
                        <?php } ?>
                        <td>
                        <?php echo $data["PortName"] ?>
                        </td>
                        <?php if($_COG_ALLOW_FIRST_SHORT_DESCRIPTION){ ?>
                        <td><?php echo empty($data["ShortDescription"]) ? "" : $data["ShortDescription"] ?></td>
                        <?php } ?>
                        <td class="text-center sortable-hide-item">
                            <?php echo $data["Active"] == 1 ? "ใช้งาน" : "ไม่ใช้งาน" ?>
                        </td>
                        <td class="text-center sortable-hide-item">
                            <?php if($_COG_ALLOW_GALLERY){ ?>
                            <a title="แกลเลอรี่" style="margin-right:8px;" href="itemDetailGallery.php?ref=<?php echo $data["PortCode"] ?>">
                                <i class="fa fa-picture-o"></i>
                            </a>
                            <?php } ?>
                            <a title="แก้ไขข้อมูล" href="itemDetail.php?ref=<?php echo $data["PortCode"] ?>">
                                <i class="fa fa-cog"></i>
                            </a>
                            <form method="post" style="display:inline">
                                <button type="submit" class="btn-link" 
                                    onclick="return Confirm(this,'ต้องการลบรายการนี้หรือไม่ ?');"
                                    value="<?php echo $data["PortCode"] ?>" name="btnDeleteRow">
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
</div>
<?php include  "../footer.php"; ?>
