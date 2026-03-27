<?php include_once  "../_master/_master.php"; ?>
<?php
if (isset($_POST["btnDeleteRow"])) {
    $sql = "delete from portfolio where PortCode = :PortCode";
    ExecuteSQL($sql, array('PortCode' => $_POST["btnDeleteRow"]));
    $sql = "delete from gallery where RefCode = :RefCode";
    ExecuteSQL($sql, array('RefCode' => $_POST["btnDeleteRow"]));
}
?>
<style>
    .it-swi {
        cursor: pointer;
        font-size: 2rem;
    }

    .it-swi:before {
        content: "\f204";
        color: #E65041;
    }

    .it-swi.active:before {
        content: "\f205";
    }

    .it-swi.new.active:before {
        color: #0085A1;
    }

    .it-swi.act.active:before {
        color: #04AC9C;
    }

    .dataTables_length {
        display: none;
    }

    table.dataTable thead th.t-w50 {
        width: 50px !important;
    }

    table.dataTable thead th.t-w80 {
        width: 80px !important;
    }

    div.dataTables_wrapper div.dataTables_filter .form-control {
        display: block;
    }

    .sortable-table-x tbody tr {
        cursor: n-resize;
    }

    .pointer {
        cursor: pointer;
    }

    .t-mark {
        font-style: italic;
        color: #E65041 !important;
        text-align: center;
        font-size: 85%;
    }
</style>
<div class="mat-box grey-bar">
    <a href="item.php" class="link-history-btn">หน้าหลัก<?php echo $_COG_ITEM_NAME ?></a>
    /
    <span class="link-history-btn">รายการ<?php echo $_COG_ITEM_NAME ?></span>
</div>
<div class="mat-box" style="border-radius: 0 0 3px 3px">
    <div class="row">
        <?php if ($_COG_ALLOW_LEFT_MENU) { ?>
            <div class="col-md-2">
                <?php include_once  $GLOBALS['DOCUMENT_ROOT'] . "/ControlPanel/blogEditorPage/_master/_master_leftMenu.php"; ?>
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
                            <?php if ($_COG_ALLOW_CATEGORY) { ?>
                                <th>หมวดหมู่</th>
                            <?php } ?>
                            <th>หัวข้อ<?php echo $_COG_ITEM_NAME ?></th>
                            <?php if ($_COG_ALLOW_FIRST_SHORT_DESCRIPTION) { ?>
                                <th style="width:200px;">รายละเอียด</th>
                            <?php } ?>
                            <?php if ($_COG_ALLOW_HTML_DETAIL) { ?>
                                <th>คำอธิบาย</th>
                            <?php } ?>
                            <?php if ($_COG_ALLOW_AMOUNT) { ?>
                                <th>จำนวน</th>
                            <?php } ?>
                            <?php if ($_COG_ALLOW_NEW) { ?>
                                <th class="text-center">แนะนำ</th>
                            <?php } ?>
                            <th style="width:50px;" class="text-center">ใช้งาน</th>
                            <th style="width:100px;" class="text-center">จัดการ</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="text-center">#</th>
                            <?php if ($_COG_ALLOW_CATEGORY) { ?>
                                <th>หมวดหมู่</th>
                            <?php } ?>
                            <th>หัวข้อ<?php echo $_COG_ITEM_NAME ?></th>
                            <?php if ($_COG_ALLOW_FIRST_SHORT_DESCRIPTION) { ?>
                                <th>รายละเอียด</th>
                            <?php } ?>
                            <?php if ($_COG_ALLOW_HTML_DETAIL) { ?>
                                <th>คำอธิบาย</th>
                            <?php } ?>
                            <?php if ($_COG_ALLOW_AMOUNT) { ?>
                                <th>จำนวน</th>
                            <?php } ?>
                            <?php if ($_COG_ALLOW_NEW) { ?>
                                <th class="text-center">แนะนำ</th>
                            <?php } ?>
                            <th style="width:50px;" class="text-center">ใช้งาน</th>
                            <th style="width:100px;" class="text-center">จัดการ</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $sql = "select p.*,c.CategoryName , d.SubCategoryName from portfolio p 
                    left join product_category c on c.CategoryCode = p.CategoryCode
                    left join product_sub_category d on p.SubCategoryCode = d.SubCategoryCode
                    where p.PortType = :PortType order by p.seq,p.PortCode";
                        $datas = SelectRows($sql, array('PortType' => $_COG_ITEM_CODE));
                        $inx = 1;
                        foreach ($datas as $data) {
                        ?>
                            <tr data-sortable-row-key="<?php echo $data["PortCode"] ?>" data-key="<?php echo $data["PortCode"] ?>">
                                <td class="text-center"><?php echo $inx++; ?></td>
                                <?php if ($_COG_ALLOW_CATEGORY) { ?>
                                    <td><?php echo empty($data["CategoryName"]) ? "ไม่ได้ระบุหมวดหมู่" : $data["CategoryName"] . (!empty($data["SubCategoryName"]) ? " -> <span class='text-info'>" . $data["SubCategoryName"] . "</span> " : "") ?></td>
                                <?php } ?>
                                <td>
                                    <?php echo $data["PortName"] ?>
                                </td>
                                <?php if ($_COG_ALLOW_FIRST_SHORT_DESCRIPTION) { ?>
                                    <td><?php echo empty($data["ShortDescription"]) ? "" : $data["ShortDescription"] ?></td>
                                <?php } ?>
                                <?php if ($_COG_ALLOW_HTML_DETAIL) { ?>
                                    <td><?php echo empty($data["PortDetail2"]) ? "ไม่ได้ระบุ" : $data["PortDetail2"] ?></td>
                                <?php } ?>
                                <?php if ($_COG_ALLOW_AMOUNT) { ?>
                                    <td><?php echo number_format($data["Amount"], $_COG_ALLOW_AMOUNT_DECIMAL) ?></td>
                                <?php } ?>
                                <?php if ($_COG_ALLOW_NEW) { ?>
                                    <td class="text-center sortable-hide-item">
                                        <i class="it-swi new fa <?php echo $data["New"] == 1 ? "active" : "" ?>" onclick="xNew(this)"></i>
                                    </td>
                                <?php } ?>
                                <td class="text-center sortable-hide-item">
                                    <?php //echo $data["Active"] == 1 ? "ใช้งาน" : "ไม่ใช้งาน" 
                                    ?>
                                    <i class="it-swi act fa <?php echo $data["Active"] == 1 ? "active" : "" ?>" onclick="xActive(this)"></i>
                                </td>
                                <td class="text-center sortable-hide-item">
                                    <?php if ($_COG_ALLOW_SUBITEM) { ?>
                                        <a title="เพิ่มรายการย่อย" style="margin-right:8px;" href="itemSubDetail.php?ref=<?php echo $data["PortCode"] ?>">
                                            <i class="fa fa-tasks"></i>
                                        </a>
                                    <?php } ?>
                                    <?php if ($_COG_ALLOW_FEEDBACK) { ?>
                                        <a title="ผลตอบรับ" style="margin-right:8px;" href="itemFeedBack.php?ref=<?php echo $data["PortCode"] ?>">
                                            <i class="fa fa-tasks"></i>
                                        </a>
                                    <?php } ?>
                                    <?php if ($_COG_ALLOW_GALLERY) { ?>
                                        <a title="แกลเลอรี่" style="margin-right:8px;" href="itemDetailGallery.php?ref=<?php echo $data["PortCode"] ?>">
                                            <i class="fa fa-picture-o"></i>
                                        </a>
                                    <?php } ?>
                                    <?php if ($_COG_ALLOW_GALLERY2) { ?>
                                        <a title="รูปแบบห้อง" style="margin-right:8px;" href="itemDetailGallery.php?no=2&ref=<?php echo $data["PortCode"] ?>">
                                            <i class="fa fa-building-o"></i>
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
<script>
    function xActive(ele) {
        var p = $(ele).closest("tr").attr("data-key");
        var _active = !$(ele).hasClass("active");
        AlertLoading(true, "กำลังทำรายการ");
        $.ajax({
            type: "POST", // type of request
            url: "../_master/_post_data.php", // funtion name // resource file with extension
            data: {
                "action": "ACTIVE",
                "product": p,
                "active": _active
            },
            success: function(xhr, reason, exMessage) {
                if (xhr.status == "OK") {
                    var code = xhr.result.product;
                    var status = xhr.result.active;
                    if (status == "true") {
                        $("tr[data-key='" + code + "']").find(".it-swi.act").addClass("active");
                    } else {
                        $("tr[data-key='" + code + "']").find(".it-swi.act").removeClass("active");
                    }
                } else {
                    AlertError(reason + "[" + xhr.status + "] : " + xhr.message == undefined ? xhr : xhr.message);
                }
                AlertLoading(false);
            },
            error: function(xhr, reason, exMessage) {
                AlertError(reason + "[" + xhr.status + "] : " + xhr.message == undefined ? xhr : xhr.message);
                AlertLoading(false);
            }
        });
    }

    function xNew(ele) {
        var p = $(ele).closest("tr").attr("data-key");
        var _new = !$(ele).hasClass("active");
        AlertLoading(true, "กำลังทำรายการ");
        $.ajax({
            type: "POST", // type of request
            url: "../_master/_post_data.php", // funtion name // resource file with extension
            data: {
                "action": "NEW",
                "product": p,
                "new": _new
            },
            success: function(xhr, reason, exMessage) {
                if (xhr.status == "OK") {
                    var code = xhr.result.product;
                    var status = xhr.result.new;
                    if (status == "true") {
                        $("tr[data-key='" + code + "']").find(".it-swi.new").addClass("active");
                    } else {
                        $("tr[data-key='" + code + "']").find(".it-swi.new").removeClass("active");
                    }
                } else {
                    AlertError(reason + "[" + xhr.status + "] : " + xhr.message == undefined ? xhr : xhr.message);
                }
                AlertLoading(false);
            },
            error: function(xhr, reason, exMessage) {
                AlertError(reason + "[" + xhr.status + "] : " + xhr.message == undefined ? xhr : xhr.message);
                AlertLoading(false);
            }
        });
    }
</script>
<?php include_once  $GLOBALS['DOCUMENT_ROOT'] . "/ControlPanel/footer.php"; ?>