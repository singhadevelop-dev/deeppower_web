<?php include  "../header.php"; ?>
<?php include  "_config.php"; ?>

<?php 
if(isset($_POST["btnSave"])){
    $txtSubject = $_POST["txtSubject"];
    $txtSubSubject = $_POST["txtSubSubject"];
    $txtDetail = $_POST["txtDetail"];
    $chkActive = isset($_POST["chkActive"]) ? 1 : 0;
    $uploadFileTarget = "/ControlPanel/assets/images/category/";
    $fileUploaded = $_FILES["fileUpload"];
    if(!empty($fileUploaded["name"])){
        $fileUploadedPath = $uploadFileTarget.UploadFile($_FILES["fileUpload"],$uploadFileTarget);
    }else{
        $fileUploadedPath = $_POST["hddBackUpImage"];
    }
    $sql = "";
    $values = array();
    if(empty($_GET["ref"])){
        $genID = GenerateNextID("product_category","CategoryCode",5,"C");
        $sql = "insert into product_category (CategoryCode,CategoryName,CategoryDetail,Active,CreatedOn,CreatedBy,CategorySubName,Image,CategoryGroup) values(
                 :CategoryCode
                ,:CategoryName
                ,:CategoryDetail
                ,:Active
                ,NOW()
                ,:CreatedBy
                ,:CategorySubName
                ,:Image
                ,:CategoryGroup
            );
        ";
        $values = array(
            'CategoryCode' => $genID,
            'CategoryName' => $txtSubject,
            'CategoryDetail' => $txtDetail,
            'Active' => $chkActive,
            'CreatedBy' => UserService::UserCode(),
            'CategorySubName' => $txtSubSubject,
            'Image' => $fileUploadedPath,
            'CategoryGroup' => $_COG_ITEM_CODE
        );
    }else{
        $sql = "update product_category set
                CategoryName = :CategoryName
                ,CategoryDetail = :CategoryDetail
                ,Active = :Active
                ,UpdatedOn = NOW()
                ,UpdatedBy = :UpdatedBy
                ,CategorySubName = :CategorySubName
                ,Image = :Image
                where CategoryCode = :CategoryCode
        ";
        $values = array(
            'CategoryName' => $txtSubject,
            'CategoryDetail' => $txtDetail,
            'Active' => $chkActive,
            'UpdatedBy' => UserService::UserCode(),
            'CategorySubName' => $txtSubSubject,
            'Image' => $fileUploadedPath,
            'CategoryCode' => $_GET["ref"],
        );
    }
    ExecuteSQLTransaction($sql, $values, "itemCategory.php");
}
if(!empty($_GET["ref"]))
{
    $sql = "select * from product_category where CategoryCode = :CategoryCode";
    $data = SelectRow($sql, array('CategoryCode' => $_GET["ref"]));
}
?>
<div class="mat-box grey-bar">
    <a href="item.php" class="link-history-btn">หน้าหลัก<?php echo $_COG_ITEM_NAME ?></a>
    /
    <a href="itemCategory.php" class="link-history-btn">รายการ<?php echo $_COG_ALLOW_CATEGORY ? "หมวดหมู่" : "" ?><?php echo $_COG_ITEM_NAME ?></a>
    /
    <span class="link-history-btn">จัดการข้อมูล<?php echo $_COG_ALLOW_CATEGORY ? "หมวดหมู่" : "" ?><?php echo $_COG_ITEM_NAME ?></span>
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
                                <label>ชื่อ<?php echo $_COG_ALLOW_CATEGORY ? "หมวดหมู่" : "" ?><?php echo $_COG_ITEM_NAME ?></label>
                                <input type="text" name="txtSubject" id="txtSubject" value="<?php echo $data["CategoryName"] ?>" class="form-control input-sm require" />
                            </div>
                        </div>
                        <div class="row <?php echo $_COG_ALLOW_CATEGORY ? "" : "hide" ?>">
                            <div class="col-sm-12">
                                <label>รายละเอียด / คำอธิบาย</label>
                                <textarea name="txtDetail" id="txtDetail" class="form-control input-sm"><?php echo $data["CategoryDetail"] ?></textarea>
                            </div>
                        </div>
                        <br />
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
                    <div class="col-md-3 hide">
                        <div>
                            <span><b>รุปภาพหลัก</b></span>
                            <hr style="margin-top: 5px; margin-bottom: 5px;" />
                            <p>
                                <small class="text-danger">*ขนาดภาพที่เหมาะสมที่สุดคือ 800 x 800 pixels</small>
                            </p>
                            <img id="imge-preview" src="<?php echo empty($data["Image"]) ? "https://ipsumimage.appspot.com/800x800,eee" : $data["Image"] ?>" 
                            class="img-responsive hand" onclick="$(this).next().click();"/>
                            <input class="hide" type="file" onchange="$(this).previewImage($('#imge-preview'));"
                                name="fileUpload" id="fileUpload" accept="image/*" />
                            <input type="hidden" name="hddBackUpImage" value="<?php echo $data["Image"] ?>" />
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
                    <a href="itemCategory.php" class="btn btn-danger">
                        <i class="fa fa-remove"></i>
                        ยกเลิก
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
<?php include  "../footer.php"; ?>