<?php $_COG_ITEM_CODE = 'PRODUCT'; ?>
<?php include  "../header.php"; ?>
<?php include  "_config.php"; ?>

<?php

if (isset($_POST["btnSave"])) {

    $txtSubject = $_POST["txtSubject"];
    $txtIcon = $_POST["txtIcon"];
    $chkActive = isset($_POST["chkActive"]) ? 1 : 0;

    $uploadFileTarget =  $GLOBALS["ROOT"] . "/_content_images/" . GetCurrentLang() . "/product_prop/";
    $fileUploaded = $_FILES["fileUpload"];

    if (!empty($fileUploaded["name"])) {
        $fileUploadedPath = $uploadFileTarget . UploadFile($_FILES["fileUpload"], $uploadFileTarget);
    } else {
        $fileUploadedPath = $_POST["hddBackUpImage"];
    }

    $sql = "";
    $values = array();
    if (empty($_GET["ref"])) {
        $genID = GenerateNextID("product_properties", "PropCode", 5, "PR");
        $sql = "insert into product_properties (PropCode,PropName,PropIcon,Active,CreatedOn,CreatedBy,PropGroup,Image) values(
                 :PropCode
                ,:PropName
                ,:PropIcon
                ,:Active
                ,NOW()
                ,:CreatedBy
                ,:PropGroup
                ,:Image
            );
        ";
        $values = array(
            'PropCode' => $genID,
            'PropName' => $txtSubject,
            'PropIcon' => $txtIcon,
            'Active' => $chkActive,
            'CreatedBy' => UserService::UserCode(),
            'PropGroup' => $_COG_ITEM_CODE,
            'Image' => $fileUploadedPath
        );
    } else {
        $sql = "update product_properties set
                 PropName = :PropName
                ,PropIcon = :PropIcon
                ,Active = :Active
                ,UpdatedOn = NOW()
                ,UpdatedBy = :UpdatedBy
                ,PropGroup = :PropGroup
                ,Image = :Image
                where PropCode = :PropCode
        ";
        $values = array(
            'PropName' => $txtSubject,
            'PropIcon' => $txtIcon,
            'Active' => $chkActive,
            'UpdatedBy' => UserService::UserCode(),
            'PropGroup' => $_COG_ITEM_CODE,
            'Image' => $fileUploadedPath,
            'PropCode' => $_GET["ref"],
        );
    }

    ExecuteSQLTransaction($sql, $values, "productProperties.php");
}

if (!empty($_GET["ref"])) {
    $sql = "select * from product_properties where PropCode = :PropCode and PropGroup= :PropGroup ";
    $data = SelectRow($sql, array('PropCode' => $_GET["ref"], 'PropGroup' => $_COG_ITEM_CODE));
}
?>

<div class="mat-box grey-bar">

    <a href="product.php" class="link-history-btn">หน้าหลักข้อมูล<?php echo $_COG_ITEM_NAME ?></a>
    /
    <a href="productProperties.php" class="link-history-btn">รายการคุณสมบัติ</a>
    /
    <span class="link-history-btn">จัดการข้อมูลคุณสมบัติ</span>



</div>
<div class="mat-box" style="border-radius: 0 0 3px 3px">
    <form method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <span><b><?php echo empty($_GET["ref"]) ? "เพิ่มข้อมูล" : "แก้ไขข้อมูล " . $_GET["ref"] ?></b></span>
                    <hr style="margin-top: 5px;" />
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <label>
                            ชื่อคุณสมบัติ
                        </label>
                        <input type="text" name="txtSubject" id="txtSubject" value="<?php echo $data["PropName"] ?>" class="form-control input-sm require" />
                    </div>

                    <div class="col-sm-6">
                        <br>
                        <div>
                            <span><b>รูปภาพหลัก</b></span>
                            <hr style="margin-top: 5px; margin-bottom: 5px;" />
                            <p>
                                <small class="text-danger">*ขนาดภาพที่เหมาะสมที่สุดคือ 128 x 128 pixels</small>
                            </p>
                            <img id="imge-preview" src="<?php echo empty($data["Image"]) ? "https://dummyimage.com/128x128" : $data["Image"] ?>" class="img-responsive hand" onclick="$(this).next().click();" />
                            <input class="hide" type="file" onchange="$(this).previewImage($('#imge-preview'));" name="fileUpload" id="fileUpload" accept="image/*" />
                            <input type="hidden" name="hddBackUpImage" value="<?php echo $data["Image"] ?>" />
                            <div class="text-center">
                                <small>คลิกด้านบนรูปเพื่อเลือกรูปภาพ</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <br>
                        <b>ใช้งาน / ไม่ใช้งาน</b>


                        <div>
                            <i id="toggle-active" class="fa fa-toggle-on fa-3x text-success hand" style="" onclick="toggleActive(this);"></i>
                            <input type="checkbox" name="chkActive" class="hide" checked="checked" value="" />
                        </div>
                        <script>
                            function toggleActive(obj) {
                                $(obj).toggleClass('fa-toggle-on').toggleClass('fa-toggle-off')
                                    .toggleClass('text-success')
                                    .toggleClass('text-danger').next().click();
                            }
                            <?php if (!empty($_GET["ref"]) && $data["Active"] == 0) { ?>
                                $("#toggle-active").click();
                            <?php } ?>
                        </script>
                    </div>
                </div>



                <hr />

                <div>

                    <button type="submit" name="btnSave" class="btn btn-success" onclick="return validateSave(this);">
                        <i class="fa fa-save"></i>
                        บันทึก
                    </button>

                    <a href="productProperties.php" class="btn btn-danger">
                        <i class="fa fa-remove"></i>
                        ยกเลิก
                    </a>
                </div>


                <script>
                    function validateSave(sender) {
                        var msg = [];
                        if ($("#txtSubject").val().trim() == "") {
                            msg.push("ชื่อคุณสมบัติ");
                        }
                        //if ($("#txtIcon").val().trim() == "") {
                        //    msg.push("เลือกไอคอน");
                        //}
                        if (msg.length > 0) {
                            swal('Please fill in all required fields.', msg.join("\n").split(":").join(""), 'warning');
                            return false;
                        }
                        return Confirm(sender, "Comfirm to continue");
                    }
                </script>

            </div>
        </div>
    </form>
</div>



<?php include "../footer.php"; ?>