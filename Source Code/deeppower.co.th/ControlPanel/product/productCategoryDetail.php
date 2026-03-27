<?php $_COG_ITEM_CODE = 'PRODUCT'; ?>
<?php include  "../header.php"; ?>
<?php include  "_config.php"; ?>
<?php $IsCatImg = true; ?>
<?php $IsCatIcon = false; ?>
<link rel="stylesheet" type="text/css" href="../../css/flaticon.min.css">
<link rel="stylesheet" type="text/css" href="../../css/flaticon.css">

<?php

if (isset($_POST["btnSave"])) {

    $txtSubject = $_POST["txtSubject"];
    //$txtSubSubject = $_POST["txtSubSubject"];
    $txtShortDescription = $_POST["txtShortDescription"];
    $txtDetail = $_POST["txtDetail"];
    $txtCategorySubName = GeneratePageFile($_POST["txtCategorySubName"]);
    $hddBackUpIcon = $_POST["hddBackUpIcon"];
    $chkActive = isset($_POST["chkActive"]) ? 1 : 0;

    $uploadFileTarget =  $GLOBALS["ROOT"] . "/_content_images/" . GetCurrentLang() . "/product_category/";
    $fileUploaded = $_FILES["fileUpload"];
    $fileUploaded2 = $_FILES["fileUpload2"];

    if (!empty($fileUploaded["name"])) {
        $fileUploadedPath = $uploadFileTarget . UploadFile($_FILES["fileUpload"], $uploadFileTarget);
    } else {
        $fileUploadedPath = $_POST["hddBackUpImage"];
    }

    if (!empty($fileUploaded2["name"])) {
        $fileUploadedPath2 = $uploadFileTarget . UploadFile($_FILES["fileUpload2"], $uploadFileTarget);
    } else {
        $fileUploadedPath2 = $_POST["hddBackUpImage2"];
    }

    $sql = "";
    $values = array();
    if (empty($_GET["ref"])) {
        $genID = GenerateNextID("product_category", "CategoryCode", 5, "C");
        $sql = "insert into product_category (CategoryCode,CategoryName,ShortDescription,CategoryDetail,CategorySubName,Active,CreatedOn,CreatedBy,Image,Image2,ImageIcon,CategoryGroup,Title,Description,Keyword)values(
                 :CategoryCode
                ,:CategoryName
                ,:ShortDescription
                ,:CategoryDetail
                ,:CategorySubName
                ,:Active
                ,NOW()
                ,:CreatedBy
                ,:Image1
                ,:Image2
                ,:ImageIcon
                ,'PRODUCT'
                ,:Title
                ,:Description
                ,:Keyword
            );
        ";
        $values = array(
            'CategoryCode' => $genID,
            'CategoryName' => $txtSubject,
            'ShortDescription' => $txtShortDescription,
            'CategoryDetail' => $txtDetail,
            'CategorySubName' => $txtCategorySubName,
            'Active' => $chkActive,
            'CreatedBy' => UserService::UserCode(),
            'Image1' => $fileUploadedPath,
            'Image2' => $fileUploadedPath2,
            'ImageIcon' => $hddBackUpIcon,
            'Title' => $txtSEOTitle,
            'Description' => $txtSEODesc,
            'Keyword' => $txtSEOKeyword
        );
    } else {
        $sql = "update product_category set
                CategoryName = :CategoryName
                ,ShortDescription= :ShortDescription
                ,CategoryDetail = :CategoryDetail
                ,CategorySubName = :CategorySubName
                ,Active = :Active
                ,UpdatedOn = NOW()
                ,UpdatedBy = :UpdatedBy
                ,Image = :Image1
                ,Image2 = :Image2
                ,ImageIcon = :ImageIcon
                ,Title = :Title
                ,Description = :Description
                ,Keyword = :Keyword
                where CategoryCode = :CategoryCode
        ";
        $values = array(
            'CategoryName' => $txtSubject,
            'ShortDescription' => $txtShortDescription,
            'CategoryDetail' => $txtDetail,
            'CategorySubName' => $txtCategorySubName,
            'Active' => $chkActive,
            'UpdatedBy' => UserService::UserCode(),
            'Image1' => $fileUploadedPath,
            'Image2' => $fileUploadedPath2,
            'ImageIcon' => $hddBackUpIcon,
            'Title' => $txtSEOTitle,
            'Description' => $txtSEODesc,
            'Keyword' => $txtSEOKeyword,
            'CategoryCode' => $_GET["ref"],
        );
    }

    ExecuteSQLTransaction($sql, $values, "productCategory.php");

    GenerateHTAccess();
}

if (!empty($_GET["ref"])) {
    $sql = "select * from product_category where CategoryCode = :CategoryCode";
    $data = SelectRow($sql, array('CategoryCode' => $_GET["ref"]));
}
?>

<div class="mat-box grey-bar">

    <a href="product.php" class="link-history-btn">หน้าหลักข้อมูล<?php echo $_COG_ITEM_NAME ?></a>
    /
    <a href="productCategory.php" class="link-history-btn">รายการหมวดหมู่<?php echo $_COG_ITEM_NAME ?></a>
    /
    <span class="link-history-btn">จัดการหมวดหมู่<?php echo $_COG_ITEM_NAME ?></span>

</div>

<div class="mat-box" style="border-radius: 0 0 3px 3px">
    <form method="post" id="form-data" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">


                <div class="row">
                    <div class="col-md-9">
                        <div>
                            <span><b><?php echo empty($_GET["ref"]) ? "เพิ่มข้อมูล" : "แก้ไขข้อมูล " . $_GET["ref"] ?></b></span>
                            <hr style="margin-top: 5px;" />
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>ชื่อหมวดหมู่<?php echo $_COG_ITEM_NAME ?></label>
                                <input type="text" name="txtSubject" id="txtSubject" value="<?php echo $data["CategoryName"] ?>" class="form-control input-sm require" />
                            </div>
                        </div>

                        <div class="row hide">
                            <div class="col-sm-12">
                                <label>หัวข้อแสดงหน้าแรก</label>
                                <input type="text" name="txtShortDescription" id="txtShortDescription" value="<?php echo $data["ShortDescription"] ?>" class="form-control input-sm">
                            </div>
                        </div>

                        <div class="row hide">
                            <div class="col-sm-12">
                                <label>รายละเอียดโดยย่อ</label>
                                <textarea name="txtDetail" id="txtDetail" class="form-control input-sm"><?php echo $data["CategoryDetail"] ?></textarea>
                            </div>
                        </div>

                        <div class="row hide">
                            <div class="col-sm-12">
                                <label>รายละเอียด</label>
                                <?php
                                // =============== HTML EDITOR =============== 
                                $_HTML_EDITOR_NAME = "txtCategorySubName";
                                $_HTML_EDITOR_CONTENT_ID = $data["CategorySubName"];
                                include $GLOBALS['DOCUMENT_ROOT'] . '/ControlPanel/HtmlEditor/HtmlEditor.php';
                                ?>
                            </div>
                        </div>

                        <div class="row hide">
                            <div class="col-md-12">
                                <span><b>SEO สำหรับหัวข้อนี้
                                    </b></span>
                                <hr style="margin-top: 5px; margin-bottom: 5px;" />
                                <div class="panel panel-info">
                                    <div class="panel-body">
                                        <p>
                                            <label>Title</label>
                                            <input type="text" class="form-control" name="txtSEOTitle" value="<?php echo $data["Title"] ?>" />
                                            <small class="text-success">Title คือ ข้อความที่เป็นหัวข้อ จะถูกดึงไปแสดงอยู่ที่หน้าของ Google ไม่ควรยาวเกิน 50 ตัวอักษร</small>
                                        </p>
                                        <p>
                                            <label>Description</label>
                                            <input type="text" class="form-control" name="txtSEODesc" value="<?php echo $data["Description"] ?>" />
                                            <small class="text-success">Description คือ ข้อความที่เป็นรายละเอียด จะถูกดึงไปแสดงอยู่ที่หน้าของ Google ไม่ควรยาวเกิน 150 ตัวอักษร</small>
                                        </p>
                                        <p>
                                            <label>Keywords</label>
                                            <input type="text" class="form-control" name="txtSEOKeyword" value="<?php echo $data["Keyword"] ?>" />
                                            <small class="text-success">Keywords คือ คำที่ลูกค้าของคุณจะใช้ค้นหาเว็บไซต์คุณด้วยคำว่าอะไร สามารถระบุได้ไม่ควรเกิน 5 คำ คั่นด้วยเครื่องหมาย "," เช่น เสื้อผ้าเด็ก, ร้านเสื้อผ้าเด็ก, ขายเสื้อผ้าเด็ก, เสื้อผ้าเด็กราคาถูก</small>
                                        </p>
                                    </div>
                                    <div class="panel-footer">
                                        <small>ระบุข้อมูล SEO ให้ครบทุกช่องเพิ่มโอกาสเข้าถึงเว็บไซต์ได้มากขึ้น</small>
                                    </div>
                                </div>
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
                            <?php if (!empty($_GET["ref"]) && $data["Active"] == 0) { ?>
                                $("#toggle-active").click();
                            <?php } ?>
                        </script>

                    </div>
                    <div class="col-md-3 <?php echo $IsCatImg ? "" : "hide" ?>">
                        <div>
                            <span><b>รูปภาพหลัก</b></span>
                            <hr style="margin-top: 5px; margin-bottom: 5px;" />
                            <p>
                                <small class="text-danger">*ขนาดภาพที่เหมาะสมที่สุดคือ 156 x 156 pixels</small>
                            </p>
                            <img id="imge-preview" src="<?php echo empty($data["Image"]) ? "https://dummyimage.com/156x156" : $data["Image"] ?>"
                                class="img-responsive hand" onclick="$(this).next().click();" />
                            <input class="hide" type="file" onchange="$(this).previewImage($('#imge-preview'));"
                                name="fileUpload" id="fileUpload" accept="image/*" />
                            <input type="hidden" name="hddBackUpImage" value="<?php echo $data["Image"] ?>" />
                            <div class="text-center">
                                <small>คลิกด้านบนรูปเพื่อเลือกรูปภาพ</small>
                            </div>
                        </div>

                        <?php if ($IsCatIcon) { ?>
                            <div>
                                <br>
                                <span><b>รูปภาพไอคอน</b></span>
                                <hr style="margin-top: 5px; margin-bottom: 5px;" />
                                <p>
                                    <small class="text-danger">*ขนาดภาพที่เหมาะสมที่สุดคือ 100 x 100 pixels</small>
                                </p>
                                <img id="imge-preview2" src="<?php echo empty($data["Image2"]) ? "https://dummyimage.com/100x100" : $data["Image2"] ?>"
                                    class="img-responsive hand" onclick="$(this).next().click();" />
                                <input class="hide" type="file" onchange="$(this).previewImage($('#imge-preview2'));"
                                    name="fileUpload2" id="fileUpload2" accept="image/*" />
                                <input type="hidden" name="hddBackUpImage2" value="<?php echo $data["Image2"] ?>" />
                                <div class="text-center">
                                    <small>คลิกด้านบนรูปเพื่อเลือกรูปภาพ</small>
                                </div>
                            </div>
                        <?php } ?>


                    </div>
                </div>

                <hr />

                <div>

                    <button type="submit" name="btnSave" class="btn btn-success" onclick="return Validate(this,$('#form-data'));">
                        <i class="fa fa-save"></i>
                        บันทึก
                    </button>

                    <a href="productCategory.php" class="btn btn-danger">
                        <i class="fa fa-remove"></i>
                        ยกเลิก
                    </a>
                </div>



            </div>
        </div>
    </form>
</div>



<?php include  "../footer.php"; ?>