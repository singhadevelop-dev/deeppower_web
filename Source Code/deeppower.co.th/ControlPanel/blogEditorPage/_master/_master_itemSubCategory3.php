<?php include_once  "../_master/_master.php"; ?>

<?php 

if(isset($_POST["btnDeleteRow"])){

    $sql = "delete from product_sub_category3 where SubCategoryCode3 = :SubCategoryCode3";
    ExecuteSQL($sql, array('SubCategoryCode3' => $_POST["btnDeleteRow"]));

    $sql = "update portfolio set SubCategoryCode3 = '' where SubCategoryCode3 = :SubCategoryCode3";
    ExecuteSQL($sql, array('SubCategoryCode3' => $_POST["btnDeleteRow"]));
}

?>



<div class="mat-box grey-bar">

    <a href="item.php" class="link-history-btn">หน้าหลักข้อมูล<?php echo $_COG_ITEM_NAME ?></a>
    /
    <span class="link-history-btn">รายการ<?php echo $_COG_ITEM_NAME ?>ย่อย</span>

</div>


<div class="mat-box" style="border-radius: 0 0 3px 3px">
    <div class="row">
       <div class="col-md-2">
            <?php include_once  $GLOBALS['DOCUMENT_ROOT']."/ControlPanel/blogEditorPage/_master/_master_leftMenu.php"; ?>
        </div>
        <div class="col-md-10">
            <div>
                <a href="itemSubCategoryDetail3.php" class="pull-right">
                    <i class="fa fa-plus"></i>
                    เพิ่มรายการหมวดหมู่<?php echo $_COG_ITEM_NAME ?>ย่อย 3
                </a>
                <span><b>รายการหมวดหมู่<?php echo $_COG_ITEM_NAME ?>ย่อย 3</b></span>
                <hr style="margin-top: 5px;" />
            </div>
       
            <table 
                data-sortable-table="product_sub_category3"
                data-sortable-column-seq="SEQ"
                data-sortable-column-key="SubCategoryCode3"
                class="jquery-datatable sortable-table table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width:50px;">รหัส</th>
                        <th>ชื่อรายการ<?php echo $_COG_ITEM_NAME ?>ย่อย 3</th>
                        <th>ชื่อรายการ<?php echo $_COG_ITEM_NAME ?>ย่อย 2</th>
                        <th>หมวดหมู่<?php echo $_COG_ITEM_NAME ?></th>
                        <th style="width:50px;" class="text-center">ใช้งาน</th>
                        <th style="width:50px;" class="text-center">จัดการ</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>รหัส</th>
                        <th>ชื่อรายการ<?php echo $_COG_ITEM_NAME ?>ย่อย 3</th>
                        <th>ชื่อรายการ<?php echo $_COG_ITEM_NAME ?>ย่อย 2</th>
                        <th>หมวดหมู่<?php echo $_COG_ITEM_NAME ?></th>
                        <th class="text-center">ใช้งาน</th>
                        <th class="text-center">จัดการ</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    
                    $sql = "select m.*,b.CategoryName ,c.SubCategoryName
                    from product_sub_category3 m 
                    left join product_category b on b.CategoryCode = m.CategoryCode
                    left join product_sub_category c on c.CategoryCode = m.CategoryCode and c.SubCategoryCode = m.SubCategoryCode
                    where b.CategoryGroup= :CategoryGroup
                    order by m.SEQ, m.SubCategoryCode";
                    $datas = SelectRows($sql, array('CategoryGroup' => $_COG_ITEM_CODE));
                    foreach($datas as $data){
                    ?>
                    <tr data-sortable-row-key="<?php echo $data["SubCategoryCode"] ?>">
                        <td><?php echo $data["SubCategoryCode3"] ?></td>
                        <td><?php echo $data["SubCategoryName3"] ?></td>
                        <td><?php echo $data["SubCategoryName"] ?></td>
                        <td><?php echo $data["CategoryName"] ?></td>
                        <td class="text-center sortable-hide-item">
                            <?php echo $data["Active"] == 1 ? "ใช้งาน" : "ไม่ใช้งาน" ?>
                        </td>
                        <td class="text-center sortable-hide-item">
                            <a href="itemSubCategoryDetail3.php?ref=<?php echo $data["SubCategoryCode3"] ?>">
                                <i class="fa fa-cog"></i>
                            </a>

                            <form method="post" style="display:inline">
                                <button type="submit" class="btn-link" 
                                    onclick="return Confirm(this,'ต้องการลบรายการนี้หรือไม่ ?');"
                                    value="<?php echo $data["SubCategoryCode3"] ?>" name="btnDeleteRow">
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

<?php include  $GLOBALS['DOCUMENT_ROOT']."/ControlPanel/footer.php"; ?>