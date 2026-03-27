<?php $_COG_ITEM_CODE = 'PRODUCT'; ?>
<?php include  "../header.php"; ?>
<?php include  "_config.php"; ?>

<?php 

if(isset($_POST["btnSave"])){
    
    $txtSubject = $_POST["txtSubject"];
    $txtDetail = $_POST["txtDetail"];
    $chkActive = isset($_POST["chkActive"]) ? 1 : 0;

    $uploadFileTarget =  $GLOBALS["ROOT"]."/_content_images/".GetCurrentLang()."/product_tag/";
    $fileUploaded = $_FILES["fileUpload"];
    
    if(!empty($fileUploaded["name"])){
        $fileUploadedPath = $uploadFileTarget.UploadFile($_FILES["fileUpload"],$uploadFileTarget);
    }else{
        $fileUploadedPath = $_POST["hddBackUpImage"];
    }
    
    $sql = "";
    $values = array();
    if(empty($_GET["ref"])){
        $genID = GenerateNextID("tag","TagCode",5,"T");
        $sql = "insert into tag (TagCode,TagName,TagDetail,FreeText,Active,CreatedOn,CreatedBy,TagType) values(
                 :TagCode
                ,:TagName
                ,:TagDetail
                ,:FreeText
                ,:Active
                ,NOW()
                ,:CreatedBy
                ,'PRODUCT'
            );
        ";
        $values = array(
            'TagCode' => $genID,
            'TagName' => $txtSubject,
            'TagDetail' => $txtDetail,
            'FreeText' => $fileUploadedPath,
            'Active' => $chkActive,
            'CreatedBy' => UserService::UserCode(),
        );
    }else{
        $sql = "update tag set
                 TagName = :TagName
                ,TagDetail = :TagDetail
                ,FreeText = :FreeText
                ,Active = :Active
                ,UpdatedOn = NOW()
                ,UpdatedBy = :UpdatedBy
                where TagCode = :TagCode
        ";
        $values = array(
            'TagName' => $txtSubject,
            'TagDetail' => $txtDetail,
            'FreeText' => $fileUploadedPath,
            'Active' => $chkActive,
            'UpdatedBy' => UserService::UserCode(),
            'TagCode' => $_GET["ref"],
        );
    }
    
    ExecuteSQLTransaction($sql, $values, "productTag.php");
}

if(!empty($_GET["ref"]))
{
    $sql = "select * from tag where TagCode = :TagCode";
    $data = SelectRow($sql, array('TagCode' => $_GET["ref"]));
}
?>



<div class="mat-box grey-bar">

    <a href="product.php" class="link-history-btn">หน้าหลักข้อมูล<?php echo $_COG_ITEM_NAME ?></a>
    /
    <a href="productTag.php" class="link-history-btn">รายการแท็ก</a>
    /
    <span class="link-history-btn">จัดการข้อมูล<?php echo $_COG_ITEM_NAME ?></span>

</div>

<div class="mat-box" style="border-radius: 0 0 3px 3px">
    <form method="post" id="form-data" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-9">
                        <div>
                            <span><b><?php echo empty($_GET["ref"]) ? "เพิ่มข้อมูล" : "แก้ไขข้อมูล ".$_GET["ref"] ?></b></span>
                            <hr style="margin-top: 5px;" />
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>ชื่อแท็ก</label>
                                <input type="text" name="txtSubject" id="txtSubject" value="<?php echo $data["TagName"] ?>" class="form-control input-sm require" />
                            </div>
                        </div>

                        <div class="row hide">
                            <div class="col-sm-12">
                                <label>รายละเอียด / คำอธิบาย</label>
                                <textarea name="txtDetail" id="txtDetail" class="form-control input-sm"><?php echo $data["TagDetail"] ?></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
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
                                    <?php if(!empty($_GET["ref"]) && $data["Active"] == 0){ ?>
                                    $("#toggle-active").click();
                                    <?php } ?>
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <span><b>รุปภาพหลัก</b></span>
                            <hr style="margin-top: 5px; margin-bottom: 5px;" />
                            <p>
                                <small class="text-danger">*ขนาดภาพที่เหมาะสมที่สุดคือ 25 x 25 pixels</small>
                            </p>
                            <img id="imge-preview" src="<?php echo empty($data["FreeText"]) ? "https://dummyimage.com/25x25" : $data["FreeText"] ?>" 
                            class="img-responsive hand" onclick="$(this).next().click();"/>
                            <input class="hide" type="file" onchange="$(this).previewImage($('#imge-preview'));"
                                name="fileUpload" id="fileUpload" accept="image/*" />
                            <input type="hidden" name="hddBackUpImage" value="<?php echo $data["FreeText"] ?>" />
                            <div class="text-center">
                                <small>คลิกด้านบนรูปเพื่อเลือกรูปภาพ</small>
                            </div>
                        </div>
                    </div>
                </div>

                <hr />

                <div>

                    <button type="submit" name="btnSave" class="btn btn-success" onclick="return Validate(this,$('#form-data'));">
                        <i class="fa fa-save"></i>
                        บันทึก
                    </button>

                    <a href="productTag.php" class="btn btn-danger">
                        <i class="fa fa-remove"></i>
                        ยกเลิก
                    </a>
                </div>



            </div>
        </div>
    </form>
</div>

<?php include  "../footer.php"; ?>