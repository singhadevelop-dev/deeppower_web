<?php include  "../header.php"; ?>
<?php $__IS_SINGLE = false; ?>


<?php
$_COG_REF_CODE = !empty($_GET['ref']) ? $_GET['ref'] : "SLIDE";
$uploadFileTarget =  $GLOBALS["ROOT"] . "/_content_images/" . GetCurrentLang() . "/home_banner_slider/";

if (isset($_POST["btnSortable"])) {
    $json = $_POST["txtSortable"];
    $sort = json_decode($json);
    foreach ($sort as $value) {
        $sqlSortUpdate = "update gallery set
            SEQ = :SEQ
            where ImageCode = :ImageCode";
        ExecuteSQL($sqlSortUpdate, array('SEQ' => $value->seq, 'ImageCode' => $value->code));
    }
}

if (isset($_POST["btnDelete"])) {
    $sqlDelete = "delete from gallery where ImageCode = :ImageCode";
    ExecuteSQL($sqlDelete, array('ImageCode' => $_POST["btnDelete"]));

    $filePath = $_POST["hddFilePath"];
    unlink($_SERVER['DOCUMENT_ROOT'] . $filePath);
    $filePath3 = $_POST["hddFilePath3"];
    if (!empty($filePath3)) {
        unlink($_SERVER['DOCUMENT_ROOT'] . $filePath3);
    }
}

if (isset($_POST["btnUpdateImage"])) {
    $imageCode = $_POST["btnUpdateImage"];
    $fileUploaded = $_FILES["fileUploadChange"];
    $fileUploaded2 = $_FILES["fileUploadChange2"];
    $fileUploaded3 = $_FILES["fileUploadChange3"];
    $fileUploaded4 = $_FILES["fileUploadChange4"];
    $fileType = $_POST["hdfBackUpCategory"];
    //image1
    if (!empty($fileUploaded["name"])) {
        $fileUploadedPath = $uploadFileTarget . UploadFile($_FILES["fileUploadChange"], $uploadFileTarget, $imageCode);

        $filePath = $_POST["hddBackUpImageChange"];
        if (!empty($filePath) && file_exists($_SERVER['DOCUMENT_ROOT'] . $filePath)) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $filePath);
        }
    } else {
        $fileUploadedPath = $_POST["hddBackUpImageChange"];
    }
    //image2
    if (!empty($fileUploaded2["name"])) {
        $fileUploadedPath2 = $uploadFileTarget . UploadFile($_FILES["fileUploadChange2"], $uploadFileTarget, $imageCode . "-2");

        $filePath2 = $_POST["hddBackUpImageChange2"];
        if (!empty($filePath2) && file_exists($_SERVER['DOCUMENT_ROOT'] . $filePath2)) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $filePath2);
        }
    } else {
        $fileUploadedPath2 = $_POST["hddBackUpImageChange2"];
    }
    //image3
    if (!empty($fileUploaded3["name"])) {
        $fileUploadedPath3 = $uploadFileTarget . UploadFile($_FILES["fileUploadChange3"], $uploadFileTarget, $imageCode . "-3");

        $filePath3 = $_POST["hddBackUpImageChange3"];
        if (!empty($filePath3) && file_exists($_SERVER['DOCUMENT_ROOT'] . $filePath3)) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $filePath3);
        }
    } else {
        $fileUploadedPath3 = $_POST["hddBackUpImageChange3"];
    }
    //image4
    if (!empty($fileUploaded4["name"])) {
        $fileUploadedPath4 = $uploadFileTarget . UploadFile($_FILES["fileUploadChange4"], $uploadFileTarget, $imageCode . "-4");

        $filePath4 = $_POST["hddBackUpImageChange4"];
        if (!empty($filePath4) && file_exists($_SERVER['DOCUMENT_ROOT'] . $filePath4)) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $filePath4);
        }
    } else {
        $fileUploadedPath4 = $_POST["hddBackUpImageChange4"];
    }

    $sqlDelete = "update gallery set
        ImageName = :ImageName1,
        ImageName2 = :ImageName2,
        ImageName3 = :ImageName3,
        ImageName4 = :ImageName4,
        ImageDetail = :ImageDetail,
        ImagePath = :ImagePath1,
        ImagePath2 = :ImagePath2,
        ImagePath3 = :ImagePath3,
        ImagePath4 = :ImagePath4,
        TypeCode = :TypeCode
        where ImageCode = :ImageCode";
    ExecuteSQL($sqlDelete, array(
        'ImageName1' => $_POST["txtImageName"],
        'ImageName2' => $_POST["txtImageName2"],
        'ImageName3' => $_POST["txtImageName3"],
        'ImageName4' => $_POST["txtImageName4"],
        'ImageDetail' => $_POST["txtImageDetail"],
        'ImagePath1' => $fileUploadedPath,
        'ImagePath2' => $fileUploadedPath2,
        'ImagePath3' => $fileUploadedPath3,
        'ImagePath4' => $fileUploadedPath4,
        'TypeCode' => $fileType,
        'ImageCode' => $_POST["btnUpdateImage"]
    ));

    // $filePath = $_POST["hddFilePath"];
    // unlink($_SERVER['DOCUMENT_ROOT'].$filePath);
}

if(isset($_POST["btnUpdateVideo"])){
    $imageCode = $_POST["btnUpdateVideo"];
    $fileUploaded = $_FILES["fileUploadChange"];
    $fileType = $_POST["hdfBackUpCategory"];
    $fileUploaded2 = $_FILES["fileUploadChange2"];
    //image1
    if(!empty($fileUploaded["name"])){
        $fileUploadedPath = $uploadFileTarget.UploadFile($_FILES["fileUploadChange"],$uploadFileTarget,$imageCode);
        $fileUploadedPath = parse_url( $fileUploadedPath, PHP_URL_PATH)."?vs=". GetCurrentStringDateTimeServer();
    }else{
        $fileUploadedPath = $_POST["hddBackUpImageChange"];
    }

    //image2
    if(!empty($fileUploaded2["name"])){
        $fileUploadedPath2 = $uploadFileTarget.UploadFile($_FILES["fileUploadChange2"],$uploadFileTarget,$imageCode."-2");
        $filePath2 = $_POST["hddBackUpImageChange2"];
    }else{
        $fileUploadedPath2 = $_POST["hddBackUpImageChange2"];
    }

    $txtImageDetail = $_POST["txtImageDetail"];

    $sqlUpdate = "update gallery set
        ImageName = :ImageName,
        ImageName2 = :ImageName2,
        ImageName3 = :ImageName3,
        ImageName4 = :ImageName4,
        ImageDetail = :ImageDetail,
        ImagePath = :ImagePath,
        ImagePath2 = :ImagePath2,
        TypeCode = :TypeCode
        where ImageCode = :ImageCode";
    ExecuteSQL($sqlUpdate, array(
        'ImageName' => $_POST["txtImageName"],
        'ImageName2' => $_POST["txtImageName2"],
        'ImageName3' => $_POST["txtImageName3"],
        'ImageName4' => $_POST["txtImageName4"],
        'ImageDetail' => $_POST["txtImageDetail"],
        'ImagePath' => $fileUploadedPath,
        'ImagePath2' => $fileUploadedPath2,
        'TypeCode' => $fileType,
        'ImageCode' => $_POST["btnUpdateVideo"]
    ));
    
    // $filePath = $_POST["hddFilePath"];
    // unlink($_SERVER['DOCUMENT_ROOT'].$filePath);
}

if (isset($_POST["btnUpload"])) {

    $imageCode = GenerateNextID("gallery", "ImageCode", 10, "G");

    $fileUploaded = $_FILES["fileUpload"];
    $fileUploadedPath = $uploadFileTarget . UploadFile($_FILES["fileUpload"], $uploadFileTarget, $imageCode);
    $fileType = $_POST["hdfCategory"];

    $sqlMax = "select MAX(SEQ) as xMax from gallery where RefCode = :RefCode";
    $dataMax = SelectRow($sqlMax, array('RefCode' => $_COG_REF_CODE));
    $num = empty($dataMax["xMax"]) ? 0 : intval($dataMax["xMax"]);
    $num++;

    $sqlInsert = "insert into gallery (SEQ,ImageCode,RefCode,ImagePath,ImagePath2,ImagePath3,ImagePath4,TypeCode,Active,CreatedOn,CreatedBy)
    VALUES(
        :SEQ,
        :ImageCode,
        :RefCode,
        :ImagePath,
        '',
        '',
        '',
        :TypeCode,
        '1',
        NOW(),
        :CreatedBy
    );";
    ExecuteSQL($sqlInsert, array(
        'SEQ' => $num,
        'ImageCode' => $imageCode,
        'RefCode' => $_COG_REF_CODE,
        'ImagePath' => $fileUploadedPath,
        'TypeCode' => $fileType,
        'CreatedBy' => UserService::UserCode()
    ));
}

?>

<div class="mat-box" style="margin-bottom: 0; border-radius: 3px 3px 0 0">
    <div class="row" style="margin-bottom: 0;">
        <div class="col-sm-9">
            <h3 style="margin: 0;"><i class="fa fa-home fa-fw"></i>
                <span class="analysis-left-menu-desc">จัดการเว็บไซต์ทั่วไป</span>
            </h3>
        </div>
        <div class="col-sm-3" style="padding-top: 5px;">
        </div>
    </div>
</div>

<div class="mat-box grey-bar">
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/" class="link-history-btn">จัดการเว็บไซต์ทั่วไป</a>
    /
    <span class="link-history-btn">ตั้งค่าแบนเนอร์</span>
</div>
<div class="mat-box" style="border-radius: 0 0 3px 3px">

    <div class="row">
        <div class="col-md-3">
            <?php
            $_LEFT_MENU_ACTIVE = "$_COG_REF_CODE";
            include $GLOBALS['DOCUMENT_ROOT'] . "/ControlPanel/home/leftMenu.php";
            ?>
        </div>
        <div class="col-md-9">
            <div>
                <span><b>รายการสไลด์</b></span>
                <hr style="margin-top: 5px;" />

                <style>
                    .slide-banner {
                        height: 150px;
                        position: relative;
                    }

                    .slide-banner .remover,
                    .slide-banner .editer {
                        position: absolute;
                        right: -8px;
                        top: -8px;
                        width: 26px;
                        height: 26px;
                        border-radius: 50%;
                        background: #000;
                        color: #fff;
                        text-align: center;
                        font-size: 17px;
                        padding-top: 2px;
                        z-index: 10;
                        cursor: pointer;
                        border: 1px solid #fff;
                    }

                    .slide-banner .remover:hover,
                    .slide-banner .editer:hover {
                        background: #F58512;
                    }

                    <?php if (!$__IS_SINGLE) { ?>.slide-banner .editer {
                        right: 20px;
                    }

                    <?php } ?>.ui-state-item {
                        cursor: pointer;
                    }

                    .ui-state-focus {
                        outline: 2px dashed orange;
                        border-radius: 3px;
                    }

                    .panel-banner .remover {
                        position: absolute;
                        right: -8px;
                        top: -8px;
                        width: 26px;
                        height: 26px;
                        border-radius: 50%;
                        background: #000;
                        color: #fff;
                        text-align: center;
                        font-size: 17px;
                        padding-top: 2px;
                        z-index: 10;
                        cursor: pointer;
                        border: 1px solid #fff;
                    }

                    .panel-banner .remover:hover {
                        background: #F58512;
                    }

                    video.slide-banner {
                        width: 100%;
                    }
                </style>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>รูปภาพทั้งหมด</b>
                    </div>
                    <div class="panel-body">

                        <div class="row" id="sortable">
                            <?php
                            $sql = "select * from gallery where RefCode = :RefCode order by SEQ";
                            $datas = SelectRows($sql, array('RefCode' => $_COG_REF_CODE));
                            $xCountItem = 0;
                            foreach ($datas as $data) {
                                $xCountItem++;
                                if ($__IS_SINGLE && $xCountItem > 1) {
                                    continue;
                                }
                            ?>
                                <div class="col-sm-4 col-lg-3 ui-state-item" data-image-code="<?php echo $data["ImageCode"] ?>">
                                    <?php if ($data["TypeCode"] == "VIDEO") { ?>
                                        <div class="slide-banner image-box">
                                            <video class="slide-banner" controls="" autoplay="" muted="" style="object-fit:cover;border-radius: 5px;">
                                                <source src="<?php echo $data["ImagePath"] ?>">
                                            </video>
                                            <i class="fa fa-pencil editer" onclick="openVideoUpdate('<?php echo $data["ImageCode"] ?>')"></i>
                                            <i class="fa fa-remove remover <?php echo $__IS_SINGLE ? "hide" : "" ?>" onclick="$(this).next().find('input[type=submit]').click();"></i>
                                            <form method="post">
                                                <input type="hidden" name="hddFilePath" value="<?php echo $data["ImagePath"] ?>" />
                                                <input type="hidden" name="hddFilePath3" value="<?php echo $data["ImagePath3"] ?>" />
                                                <input type="submit" onclick="return Confirm(this, 'Are you sure you want delete ?');" class="btn-delete hide" name="btnDelete" value="<?php echo $data["ImageCode"] ?>" />
                                            </form>
                                        </div>

                                    <?php } else { ?>

                                        <div class="slide-banner image-box" style="background-image:url(<?php echo $data["ImagePath"] ?>);">
                                            <i class="fa fa-pencil editer" onclick="openImageUpdate('<?php echo $data["ImageCode"] ?>');"></i>
                                            <i class="fa fa-remove remover <?php echo $__IS_SINGLE ? "hide" : "" ?>" onclick="$(this).next().find('input[type=submit]').click();"></i>
                                            <form method="post">
                                                <input type="hidden" name="hddFilePath" value="<?php echo $data["ImagePath"] ?>" />
                                                <input type="hidden" name="hddFilePath3" value="<?php echo $data["ImagePath3"] ?>" />
                                                <input type="submit" onclick="return Confirm(this, 'Are you sure you want delete ?');" class="btn-delete hide" name="btnDelete" value="<?php echo $data["ImageCode"] ?>" />
                                            </form>
                                        </div>

                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <div class="col-sm-4 col-lg-3 <?php echo $__IS_SINGLE && $xCountItem > 0 ? "hide" : "" ?>">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="slide-banner image-box slide-adder hand" onclick="$(this).next().click();" style="position: relative; background-image: url('https://ipsumimage.appspot.com/1920x1080,eee');">

                                        <div style="position: absolute; left: 0; right: 0; top: 20px; text-align: center;">
                                            <i class="fa fa-plus fa-2x text-muted"></i>
                                        </div>

                                        <div style="position: absolute; left: 0; right: 0; bottom: 20px; text-align: center;">
                                            <small>คลิกเพื่ออัพโหลดสไลด์</small>
                                        </div>

                                    </div>
                                    <input class="hide" type="file" onchange="uploadBanner(this);"
                                        name="fileUpload" id="fileUpload" accept="image/*,video/*" />

                                    <input type="submit" id="btn-upload" name="btnUpload" class="hide" value="" />
                                    <input type="hidden" name="hdfCategory" value="">
                                </form>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <p>
                                <b class="text-success">
                                    <i class="fa fa-info-circle"></i>
                                    ลากรูปภาพเพื่อสลับตำแหน่ง
                                </b>
                            </p>
                            <b class="text-danger">
                                <small>*ขนาดภาพที่เหมาะสมที่สุดคือ 1920 x 406 pixels</small>
                            </b>
                        </div>

                    </div>
                    <script>
                        function uploadBanner(input) {
                            if ($(input).validateUploadSlide()) {
                                var file = $(input).get(0).files[0];
                                var cat = "IMAGE";
                                if (file.type.match("video/")) {
                                    cat = "VIDEO";
                                }
                                $('[name="hdfCategory"]').val(cat);
                                $("#btn-upload").click();
                            }
                        }

                        function updateBanner(input, eleDisplay) {
                            if ($(input).validateUploadSlide(eleDisplay)) {
                                var file = $(input).get(0).files[0];
                                var cat = "IMAGE";
                                if (file.type.match("video/")) {
                                    cat = "VIDEO";
                                }
                                $(input).parent().find('[name="hdfCategory"]').val(cat);
                                $("#btn-upload").click();
                            }
                        }

                        $(function() {
                            $("#sortable").sortable({
                                items: ".ui-state-item",
                                placeholder: "slide-banner ui-state-focus col-sm-4 col-lg-3",
                                stop: function() {
                                    var arrSort = [];
                                    $("#sortable .ui-state-item").each(function(inx) {
                                        arrSort.push({
                                            code: $(this).attr("data-image-code"),
                                            seq: inx
                                        });
                                    });
                                    $("#txtSortable").val(JSON.stringify(arrSort));
                                    $("#btnSortable").click();
                                }
                            });
                            $("#sortable").disableSelection();
                        });
                    </script>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- IMAGE UPDATE -->
<script>
    function openImageUpdate(code) {
        $('[name="image_code"]').val(code);
        $('[name="btnOpenImageUpdate"]').click();
    }
</script>
<form method="post" class="hide">
    <input type="hidden" name="image_code" value="">
    <button type="submit" name="btnOpenImageUpdate"></button>
</form>
<?php if (isset($_POST["btnOpenImageUpdate"])) { ?>
    <div id="modal-image-update" class="modal fade modal-update-cover" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <form id="panel-content-image" method="post" enctype="multipart/form-data">
                    <?php
                    $_HTML_EDITOR_CODE = $_POST["image_code"];
                    include "slideLoadImageData.php";
                    ?>
                </form>
            </div>

        </div>
    </div>

    <script>
        $("#modal-image-update").modal('show');
    </script>
<?php } ?>

<!-- VIDEO UPDATE -->
<script>
    function openVideoUpdate(code) {
        $('[name="image_code"]').val(code);
        $('[name="btnOpenVideoUpdate"]').click();
    }
</script>
<form method="post" class="hide">
    <input type="hidden" name="image_code" value="">
    <button type="submit" name="btnOpenVideoUpdate"></button>
</form>
<?php if (isset($_POST["btnOpenVideoUpdate"])) { ?>
    <div id="modal-video-update" class="modal fade modal-update-cover" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <form id="panel-content-video" method="post" enctype="multipart/form-data">
                    <?php
                    $_HTML_EDITOR_CODE = $_POST["image_code"];
                    include "slideLoadVideoData.php";
                    ?>
                </form>
            </div>

        </div>
    </div>
    <script>
        $("#modal-video-update").modal('show');
    </script>
<?php } ?>


<form method="post" class="hide">
    <textarea id="txtSortable" name="txtSortable">[]</textarea>
    <input type="submit" id="btnSortable" name="btnSortable" value="" />
</form>

<script>
    function deleteImage(obj) {
        //if(AlertConfirm(obj,"Confirm ?")){
        var target = $(obj).closest('.panel-banner');
        $(target).find("input[type='file']").val("");
        $(target).find("input[type='hidden']").val("");
        var _imagePath = $(target).find(".image-box").data("img-path");
        if (_imagePath == "" || _imagePath == undefined) {
            _imagePath = "../assets/images/default/120x150.png";
        }
        $(target).find(".image-box").css("background-image", "url(" + _imagePath + ")");
        $(target).find(".remover").addClass("hide");
        //}
    }
</script>

<?php include  $GLOBALS['DOCUMENT_ROOT'] . "/ControlPanel/footer.php"; ?>