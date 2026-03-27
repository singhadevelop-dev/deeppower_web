
<?php include_once  "../_master/_master.php"; ?>
<?php 

$uploadFileTarget =  $GLOBALS["ROOT"]."/_content_images/".GetCurrentLang()."/".strtolower($_COG_ITEM_CODE)."/feedback/";

$refCode = !empty($_GET["ref"]) ? $_GET["ref"] : $_COG_ITEM_CODE;
if(isset($_POST["btnDeleteRow"])){
    $sqlDelete = "delete from portfolio_item where ItemCode = :ItemCode";
    ExecuteSQL($sqlDelete, array('ItemCode' => $_POST["btnDeleteRow"]));
}

if(!empty($refCode)){
    $sqlPrd = "select * from product_category where CategoryCode = :CategoryCode";
    $data = SelectRow($sqlPrd, array('CategoryCode' => $refCode));
}

?>
<div class="mat-box grey-bar">
    <?php if($_COG_ALLOW_LEFT_MENU || $_COG_ALLOW_LEFT_MENU_ITEMS){  ?>
    <a href="<?php echo $_COG_ALLOW_LEFT_MENU_ITEMS ? "item.php" : "masterDetail.php"  ?>" class="link-history-btn">หน้าหลัก<?php echo $_COG_ITEM_NAME ?></a>
    <?php if($_COG_ALLOW_LEFT_MENU_ITEMS){  ?>
    /
    <a href="itemCategory.php" class="link-history-btn">รายการ<?php echo $_COG_ITEM_NAME ?></a>
    <?php } ?>
    /
    <?php } ?>
    <span class="link-history-btn">รายการย่อย <?php echo $_COG_ITEM_NAME ?></span>
</div>
<div class="mat-box" style="border-radius: 0 0 3px 3px">
    <div class="row">
        <div class="col-md-12">
            <div>
                <a href="itemCategorySubDetailDetail.php?ref2=<?php echo $data["CategoryCode"] ?>" class="pull-right">
                    <i class="fa fa-plus"></i>
                    เพิ่มรายการ<?php echo $_COG_ITEM_NAME ?>
                </a>
                <span><b>รายการ<?php echo $_COG_ITEM_NAME ?> <span class="text-orange"><?php echo $data["PortName"]." (รายการย่อย)" ?></span></b></span>
                <hr style="margin-top: 5px;" />
                <table 
                    data-sortable-table="portfolio_item"
                    data-sortable-column-seq="SEQ"
                    data-sortable-column-key="concat(ItemCode,'-',PortCode)"
                    class="jquery-datatable sortable-table table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" style="width:10px;">#</th>
                            <th>หัวข้อ</th>
                            <th style="width:50px;" class="text-center">ใช้งาน</th>
                            <th style="width:100px;" class="text-center">จัดการ</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="text-center">#</th>
                            <th>หัวข้อ</th>
                            <th style="width:50px;" class="text-center">ใช้งาน</th>
                            <th style="width:100px;" class="text-center">จัดการ</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $sql = "select r.* from portfolio_item r
                        where r.PortCode = :portCode order by r.SEQ,r.ItemCode";
                        $datas = SelectRows($sql, array('portCode' => $refCode));
                        $inx = 1;
                        foreach ($datas as $data) {
                        ?>
                        <tr data-sortable-row-key="<?php echo $data["ItemCode"]."-".$data["PortCode"] ?>">
                            <td class="text-center"><?php echo $inx++; ?></td>
                            <td>
                                <?php echo $data["ItemName"] ?>
                            </td>
                            <td class="text-center sortable-hide-item">
                                <?php echo $data["Active"] == 1 ? "ใช้งาน" : "ไม่ใช้งาน" ?>
                            </td>
                            <td class="text-center sortable-hide-item">
                                <a title="แก้ไขข้อมูล" href="itemSubDetailDetail.php?ref=<?php echo $data["ItemCode"]."&ref2=".$data["PortCode"] ?>">
                                    <i class="fa fa-cog"></i>
                                </a>
                                <form method="post" style="display:inline">
                                    <button type="submit" class="btn-link" 
                                        onclick="return Confirm(this,'ต้องการลบรายการนี้หรือไม่ ?');"
                                        value="<?php echo $data["ItemCode"] ?>" name="btnDeleteRow">
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

<form method="post" class="hide">
    <textarea id="txtSortable" name="txtSortable">[]</textarea>
    <input type="submit" id="btnSortable" name="btnSortable" value="" />
</form>


<?php include  $GLOBALS['DOCUMENT_ROOT']."/ControlPanel/footer.php"; ?>