<?php $_COG_ITEM_CODE = 'PRODUCT'; ?>
<?php include  "../header.php"; ?>
<?php include  "_config.php"; ?>
<link rel="stylesheet" type="text/css" href="../../vendor/fontawesome-free/css/all.min.css">
<link rel="stylesheet" type="text/css" href="../../vendor/animate/animate.min.css"> 
<?php 
$get_ref = $_GET["ref"];
$get_ref2 = $_GET["ref2"];

if(isset($_POST["btnSave"])){
    
    $uploadFileTarget =  $GLOBALS["ROOT"] . "/_content_images/" . GetCurrentLang() . "/product_sub_detail/";
    $fileUploaded = $_FILES["fileUpload"];

    if (!empty($fileUploaded["name"])) {
        $fileUploadedPath = $uploadFileTarget . UploadFile($_FILES["fileUpload"], $uploadFileTarget);
    } else {
        $fileUploadedPath = $_POST["hddBackUpImage"];
    }
    
    $ddlGroup = $_POST['ddlGroup']; 
    $txtSubject = $_POST["txtSubject"];
    $txtSubDetail = $_POST["txtSubDetail"];
    //$txtShortDescription = $_POST["txtShortDescription"];
    $chkActive = isset($_POST["chkActive"]) ? 1 : 0;
    
    $sql = "";
    if(empty($get_ref2)){
        $genID = GenerateNextID("product_sub_detail","SubDetailCode",5,"SD");
        $sql = "insert into product_sub_detail(ProductCode, SubDetailCode, SubDetailName, SubDetail, CreatedOn, CreatedBy,Image) 
                VALUES(
                    :ProductCode,
                    :SubDetailCode,
                    :SubDetailName,
                    :SubDetail,
                    NOW(),
                    :CreatedBy,
                    :Image
                )";

        $values = array(
            'ProductCode' => $get_ref,
            'SubDetailCode' => $genID,
            'SubDetailName' => $txtSubject,
            'SubDetail' => $txtSubDetail,
            'CreatedBy' => UserService::UserCode(),
            'Image' => $fileUploadedPath
        );

    }else{
        $sql = "update product_sub_detail set
                SubDetailName = :SubDetailName
                ,SubDetail= :SubDetail
                ,Image= :Image
                ,UpdatedOn = NOW()
                ,UpdatedBy = :UpdatedBy
                where SubDetailCode = :SubDetailCode
        ";

        $values = array(
            'SubDetailName' => $txtSubject,
            'SubDetail' => $txtSubDetail,
            'Image' => $fileUploadedPath,
            'Image' => $fileUploadedPath,
            'UpdatedBy' => UserService::UserCode(),
            'SubDetailCode' => $get_ref2
        );
    }

    ExecuteSQLTransaction($sql,$values,"productSubDetail.php?ref=$get_ref");
}

if(!empty($get_ref2))
{

    $sql = "select * from product_sub_detail where SubDetailCode = :SubDetailCode ";
    $data = SelectRow($sql,array('SubDetailCode' => $get_ref2));
}
?>

<div class="mat-box grey-bar">

    <a href="product.php" class="link-history-btn">หน้าหลักข้อมูล<?php echo $_COG_ITEM_NAME ?></a>
    /
    <a href="productSubDetail.php?ref=<?php echo $get_ref ?>" class="link-history-btn">รายการหัวข้อรายละเอียด</a>
    /
    <span class="link-history-btn">จัดการข้อมูลหัวข้อรายละเอียด</span>



</div>
<div class="mat-box" style="border-radius: 0 0 3px 3px">
    <form method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <span><b><?php echo empty($get_ref2) ? "เพิ่มข้อมูล" : "แก้ไขข้อมูล ".$get_ref2 ?></b></span>
                    <hr style="margin-top: 5px;" />
                </div>

                <div class="row">
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-md-12">
                                <label>ชื่อหัวข้อ</label>
                                <input type="text" name="txtSubject" id="txtSubject" value="<?php echo $data["SubDetailName"] ?>" class="form-control input-sm require" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 summernote-container">
                                <label>รายละเอียด</label>
                                <textarea name="txtSubDetail" id="txtSubDetail" class="form-control input-sm"><?php echo $data["SubDetail"] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div>
                            <div>
                                <span><b>รูปภาพหลัก</b></span>
                                <hr style="margin-top: 5px; margin-bottom: 5px;" />
                                <p>
                                    <small class="text-danger">*ขนาดภาพที่เหมาะสมที่สุดคือ 150 x 150 pixels</small>
                                </p>
                                <div id="imge-preview" class="image-box hand" onclick="$(this).next().click();" style="margin:0 auto; width: 200px; height: 230px;margin-bottom:15px; background-image: url(<?php echo $data["Image"] ?>), url('http://placehold.it/1920x1080')">
                                </div>
                                <input class="hide" type="file" onchange="$(this).previewImage($('#imge-preview'));" name="fileUpload" id="fileUpload" accept="image/*" />
                                <input type="hidden" name="hddBackUpImage" value="<?php echo $data["Image"] ?>" />
                                <div class="text-center">
                                    <small>คลิกด้านบนรูปเพื่อเลือกรูปภาพ</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="row">
                    <div class="col-sm-6 text-right hide">
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
                            <?php if(!empty($get_ref2) && $data["Active"] == 0){ ?>
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

                    <a href="productSubDetail.php?ref=<?php echo $get_ref ?>" class="btn btn-danger">
                        <i class="fa fa-remove"></i>
                        ยกเลิก
                    </a>
                </div>


                <script>
                    function validateSave(sender) {
                        var msg = [];
                        if ($("#txtSubject").val().trim() == "") {
                            msg.push("ชื่อหัวข้อรายละเอียด");
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