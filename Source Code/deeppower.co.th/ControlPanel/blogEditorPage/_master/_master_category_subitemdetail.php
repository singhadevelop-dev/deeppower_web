<?php include_once  "../_master/_master.php"; ?>
<?php
$_Is_EditMode = !empty($_GET["ref"]);
$_portcode = !empty($_GET["ref2"]);
$txtItemCode = !empty($_Is_EditMode) ? $_GET["ref"] : GenerateNextID("portfolio_item","ItemCode",10,"I");
$portCode = !empty($_portcode) ? $_GET["ref2"] : "";

if(isset($_POST["btnSubmit"])){
    
    $uploadFileTarget =  $GLOBALS["ROOT"]."/_content_images/itemdetail/".GetCurrentLang()."/".strtolower($_COG_ITEM_CODE)."/";
    $txtItemName = $_POST["txtItemName"];
    //$txtItemDetail = $_POST["txtItemDetail"];
    $txtItemDetail = GeneratePageFile($_POST["txtItemDetail"],$_COG_ITEM_CODE."-".$txtItemCode);
    $chkItemActive = isset($_POST["chkActive"]) ? 1 : 0;
    $fileUploaded = $_FILES["fileUpload"];

    $cuurentDateTime = GetCurrentStringDateTimeServer();

    if(!empty($fileUploaded["name"])){
        $fileUploadedPath = $uploadFileTarget.UploadFile($_FILES["fileUpload"],$uploadFileTarget,$txtItemCode);
        $fileUploadedPath = parse_url( $fileUploadedPath, PHP_URL_PATH)."?vs=".$cuurentDateTime;
    }else{
        $fileUploadedPath = $_POST["hddBackUpImage"];
    }

    if($_Is_EditMode)
    {
        $sqlUpdate = "update portfolio_item set 
                    ItemName=:ItemName
                    ,Image =:Image
                    ,ItemDetail=:ItemDetail
                    ,Active=:Active
                    WHERE ItemCode=:ItemCode
        ";
        ExecuteSQL($sqlUpdate,array(
            'ItemName' => $txtItemName,
            'Image' => $fileUploadedPath,
            'ItemDetail' => $txtItemDetail,
            'Active' => $chkItemActive,
            'ItemCode' => $txtItemCode
        ));
    }
    else
    {
        $sqlInsert = "insert into portfolio_item(ItemCode,PortCode,ItemName,Image,ItemDetail,SEQ,Active)
                    VALUES (
                        :ItemCode,
                        :PortCode,
                        :ItemName,
                        :Image,
                        :ItemDetail,
                        (select IFNULL(max(a.SEQ),0)+1 from portfolio_item a where a.PortCode=:PortCode),
                        :Active
                    )";
        ExecuteSQL($sqlInsert,array(
            'ItemCode' => $txtItemCode,
            'PortCode' => $portCode,
            'ItemName' => $txtItemName,
            'Image' => $fileUploadedPath,
            'ItemDetail' => $txtItemDetail,
            'Active' => $chkItemActive
        ));
    }

    AlertSuccessRedirect("สำเร็จ","บันทึกรายการ","itemCategorySubDetail.php?ref=".$portCode);
}

if($_Is_EditMode){
    $sqlPrd = "select * from portfolio_item where ItemCode = :ItemCode ";
    $data = SelectRow($sqlPrd,array('ItemCode' => $txtItemCode));
}
?>

<div class="mat-box grey-bar">
    <a href="item.php" class="link-history-btn">หน้าหลัก<?php echo $_COG_ITEM_NAME ?></a>
    /
    <a href="itemSubDetail.php?ref=<?php echo $portCode ?>" class="link-history-btn">รายการ<?php echo $_COG_ITEM_NAME ?></a>
    /
    <span class="link-history-btn">จัดการข้อมูลรายการย่อย<?php echo $_COG_ITEM_NAME ?></span>
</div>
<div class="mat-box" style="border-radius: 0 0 3px 3px">
    <form id="form-product" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-9">
                                <div>
                                    <span><b><?php echo !$_Is_EditMode ? "เพิ่มข้อมูล" : "แก้ไขข้อมูล <i class='text-primary'>".$data["ItemName"]."</i>" ?></b></span>
                                    <hr style="margin-top: 5px;" />
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>หัวข้อ<?php echo $_COG_ITEM_NAME ?></label>
                                        <input type="text" placeholder="หัวข้อ<?php echo $_COG_ITEM_NAME ?>..." name="txtItemName" id="txtItemName" value='<?php echo $data["ItemName"] ?>' class="form-control input-sm require" />
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-sm-12">
                                        <label>รายละเอียด</label>
                                        <input type="text" placeholder="ลิงค์เว็บไซต์..." name="txtItemDetail" id="txtItemDetail" value='<?php //echo $data["ItemDetail"] ?>' class="form-control input-sm">
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-sm-12 summernote-container">
                                        <label>รายละเอียด</label>
                                        <?php 
                                        // =============== HTML EDITOR =============== 
                                        $_HTML_EDITOR_NAME = "txtItemDetail";
                                        $_HTML_EDITOR_CONTENT_ID = $data["ItemDetail"];
                                        include $GLOBALS['DOCUMENT_ROOT'].'/ControlPanel/HtmlEditor/HtmlEditor.php'; 
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <span><b>รูปภาพหลัก</b></span>
                                    <hr style="margin-top: 5px; margin-bottom: 5px;" />
                                    <p>
                                        <small class="text-danger">*ขนาดภาพที่เหมาะสมที่สุดคือ 274 x 200 pixels</small>
                                    </p>
                                    <img id="imge-preview" data-size="128x128" style="background-color: #eae8e8;" src="<?php echo empty($data["Image"]) ? (empty($_COG_ALLOW_MAIN_IMAGE_SIZE) || $_COG_ALLOW_MAIN_IMAGE_SIZE == "1200x900" ? "../../assets/images/default/1200x900.png" : "http://placehold.it/274x200") : $data["Image"] ?>" 
                                    class="img-responsive hand" onclick="$(this).next().click();"/>
                                    <input class="hide" type="file" onchange="$(this).validateUploadImage($('#imge-preview'));"
                                        name="fileUpload" id="fileUpload" accept="image/*" />
                                    <input type="hidden" name="hddBackUpImage" value="<?php echo $data["Image"] ?>" />
                                    <div class="text-center">
                                        <small>คลิกด้านบนรูปเพื่อเลือกรูปภาพ</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
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
                                <?php if($_Is_EditMode && $data["Active"] == 0){ ?>
                                    $("#toggle-active").click();
                                <?php } ?>
                            </script>
                        </div>
                        <hr />
                        <div>
                            <script>
                                function validateSave(sender) {
                                    if (Validate(sender)) {
                                        return true;
                                    } else {
                                        return false;
                                    }
                                }
                            </script>
                            <button type="submit" name="btnSubmit" class="btn btn-success" onclick="return validateSave(this);">
                                <i class="fa fa-save"></i>
                                บันทึก
                            </button>
                            <a href="itemSubDetail.php?ref=<?php echo $portCode ?>" class="btn btn-danger">
                                <i class="fa fa-remove"></i>
                                ยกเลิก
                            </a>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php include_once  $GLOBALS['DOCUMENT_ROOT']."/ControlPanel/footer.php"; ?>