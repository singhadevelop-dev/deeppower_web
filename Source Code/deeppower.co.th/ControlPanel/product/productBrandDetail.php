<?php $_COG_ITEM_CODE = 'PRODUCT'; ?>
<?php include  "../header.php"; ?>
<?php include  "_config.php"; ?>
<?php $IsBrandImg = false; ?>

<?php 

if(isset($_POST["btnSave"])){
    
    $txtSubject = $_POST["txtSubject"];
    $txtSubSubject = $_POST["txtSubSubject"];
    $txtDetail = $_POST["txtDetail"];
    $chkActive = isset($_POST["chkActive"]) ? 1 : 0;
    
    $uploadFileTarget = $GLOBALS["ROOT"]."/_content_files/".GetCurrentLang()."/brand/";
    $fileUploaded = $_FILES["fileUpload"];
    
    if(!empty($fileUploaded["name"])){
        $fileUploadedPath = $uploadFileTarget.UploadFile($_FILES["fileUpload"],$uploadFileTarget);
    }else{
        $fileUploadedPath = $_POST["hddBackUpImage"];
    }
    
    $sql = "";
    $values = array();
    if(empty($_GET["ref"])){
        $genID = GenerateNextID("product_brand","BrandCode",5,"B");
        $sql = "insert into product_brand (BrandCode,BrandName,BrandDetail,Image,Active,CreatedOn,CreatedBy) values(
                 :BrandCode
                ,:BrandName
                ,:BrandDetail
                ,:Image
                ,:Active
                ,NOW()
                ,:CreatedBy
            );
        ";
        $values = array(
            'BrandCode' => $genID,
            'BrandName' => $txtSubject,
            'BrandDetail' => $txtDetail,
            'Image' => $fileUploadedPath,
            'Active' => $chkActive,
            'CreatedBy' => UserService::UserCode()
        );
    }else{
        $sql = "update product_brand set
                 BrandName = :BrandName
                ,BrandDetail = :BrandDetail
                ,Active = :Active
                ,Image = :Image
                ,UpdatedOn = NOW()
                ,UpdatedBy = :UpdatedBy
                where BrandCode = :BrandCode
        ";
        $values = array(
            'BrandName' => $txtSubject,
            'BrandDetail' => $txtDetail,
            'Active' => $chkActive,
            'Image' => $fileUploadedPath,
            'UpdatedBy' => UserService::UserCode(),
            'BrandCode' => $_GET["ref"],
        );
    }
    
    ExecuteSQLTransaction($sql, $values,"productBrand.php");
}

if(!empty($_GET["ref"]))
{
    $sql = "select * from product_brand where BrandCode = :BrandCode";
    $data = SelectRow($sql, array('BrandCode' => $_GET["ref"]));
}
?>

<div class="mat-box grey-bar">

    <a href="product.php" class="link-history-btn">หน้าหลักข้อมูล<?php echo $_COG_ITEM_NAME ?></a>
    /
    <a href="productBrand.php" class="link-history-btn">รายการยี่ห้อ<?php echo $_COG_ITEM_NAME ?></a>
    /
    <span class="link-history-btn">จัดการยี่ห้อ<?php echo $_COG_ITEM_NAME ?></span>

</div>

<div class="mat-box" style="border-radius: 0 0 3px 3px">
    <form method="post" id="form-data" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                

                <div class="row">
                    <div class="col-md-<?php echo $IsBrandImg ? "8" : "12" ?>">
                        <div>
                            <span><b><?php echo empty($_GET["ref"]) ? "เพิ่มข้อมูล" : "แก้ไขข้อมูล ".$_GET["ref"] ?></b></span>
                            <hr style="margin-top: 5px;" />
                        </div>

                        <div class="row">
                            <div class="col-sm-8">
                                <label>ชื่อยี่ห้อ<?php echo $_COG_ITEM_NAME ?></label>
                                <input type="text" name="txtSubject" id="txtSubject" value="<?php echo $data["BrandName"] ?>" class="form-control input-sm require" />
                            </div>
                        </div>

                        <div class="row hide">
                            <div class="col-sm-12">
                                <label>รายละเอียด / คำอธิบาย</label>
                                <textarea name="txtDetail" id="txtDetail" class="form-control input-sm"><?php echo $data["BrandDetail"] ?></textarea>
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
                    <div class="col-md-4 <?php echo $IsBrandImg ? "" : "hide" ?>">
                        <div>
                            <span><b>รุปภาพหลัก</b></span>
                            <hr style="margin-top: 5px; margin-bottom: 5px;" />
                            <p>
                                <small class="text-danger">*ขนาดภาพที่เหมาะสมที่สุดคือ 230 x 138 pixels</small>
                            </p>

                            <img id="imge-preview" src="<?php echo empty($data["Image"]) ? "https://ipsumimage.appspot.com/230x138,eee" : $data["Image"] ?>" 
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

                    <a href="productBrand.php" class="btn btn-danger">
                        <i class="fa fa-remove"></i>
                        ยกเลิก
                    </a>
                </div>



            </div>
        </div>
    </form>
</div>


<?php include  "../footer.php"; ?>