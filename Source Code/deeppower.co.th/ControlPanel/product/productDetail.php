<?php $_COG_ITEM_CODE = 'PRODUCT'; ?>
<?php include  "../header.php"; ?>
<?php include  "_config.php"; ?>

<?php

$prdCode = $_GET["ref"];

if (isset($_POST["btnSubmit"])) {
    $txtSubject = $_POST["txtSubject"];
    $txtShortDescription = $_POST["txtShortDescription"];
    $txtShortDescription2 = $_POST["txtShortDescription2"];
    $txtDetail = GeneratePageFile($_POST["txtDetail"]);
    $txtDetail2 = GeneratePageFile($_POST["txtDetail2"]);
    $txtDetail3 = GeneratePageFile($_POST["txtDetail3"]);
    $txtDetail4 = GeneratePageFile($_POST["txtDetail4"]);
    $txtDetail6 = GeneratePageFile($_POST["txtDetail6"]);
    $chkActive = isset($_POST["chkActive"]) ? 1 : 0;

    $txtByName = $_POST["txtByName"];
    $txtProductSize = $_POST["txtProductSize"];
    $txtAddress = $_POST["txtAddress"];
    $txtAmount = floatval(str_replace(",", "", $_POST["txtAmount"]));

    $txtRefCode = $_POST["txtRefCode"];
    $txtBasePrice = floatval(str_replace(",", "", $_POST["txtBasePrice"]));
    $txtOldPrice = floatval(str_replace(",", "", $_POST["txtOldPrice"]));
    $txtPrice = floatval(str_replace(",", "", $_POST["txtPrice"]));
    $txtPriceDesc = $_POST["txtPriceDesc"];

    $choPromotion = isset($_POST["choPromotion"]) ? 1 : 0;
    $choNew = isset($_POST["choNew"]) ? 1 : 0;
    $choRecommend = isset($_POST["choRecommend"]) ? 1 : 0;
    $choHot = isset($_POST["choHot"]) ? 1 : 0;

    $txtRank = $_POST["txtRank"];
    $ddlCategory = $_POST["ddlCategory"];
    $ddlBrand = $_POST["ddlBrand"];
    $ddlModel = $_POST["ddlModel"];
    $ddlSubCategory = $_POST["ddlSubCategory"];
    $ddlSubCategory3 = $_POST["ddlSubCategory3"];
    $ddlSubCategory4 = $_POST["ddlSubCategory4"];
    $txtLatLng = $_POST["txtLatLng"];
    $ddlStatus = $_POST["ddlStatus"];
    $txtSEOTitle = $_POST["txtSEOTitle"];
    $txtSEODesc = $_POST["txtSEODesc"];
    $txtSEOKeyword = $_POST["txtSEOKeyword"];
    $txtAltText = $_POST["txtAltText"];
    $txtAltText2 = $_POST["txtAltText2"];

    $hddFilePathVedio = $_POST["hddFilePathVedio"];

    //ข้อมูลการใช้สอย
    $txtLandArea = floatval(str_replace(",", "", $_POST["txtLandArea"]));
    $txtUsableArea = floatval(str_replace(",", "", $_POST["txtUsableArea"]));
    $txtBedRoom = floatval(str_replace(",", "", $_POST["txtBedRoom"]));
    $txtToilet = floatval(str_replace(",", "", $_POST["txtToilet"]));
    $txtParkingSpace = floatval(str_replace(",", "", $_POST["txtParkingSpace"]));
    $txtFloorNumber = floatval(str_replace(",", "", $_POST["txtFloorNumber"]));
    $txtLivingRoom = floatval(str_replace(",", "", $_POST["txtLivingRoom"]));
    $txtKitchenRoom = floatval(str_replace(",", "", $_POST["txtKitchenRoom"]));
    $txtStartDateType = !empty($_POST["txtStartDate"]) ? new DateTime(ConvertDateTimeDisplayToDateTimeDB($_POST["txtStartDate"]) . " 00:00:00.000000") : new DateTime();
    $txtStartDate = $txtStartDateType->format('Y-m-d H:i:s');
    $txtEndDateType = !empty($_POST["txtEndDate"]) ? new DateTime(ConvertDateTimeDisplayToDateTimeDB($_POST["txtEndDate"]) . " 00:00:00.000000") : new DateTime();
    $txtEndDate = $txtEndDateType->format('Y-m-d H:i:s');

    $allColor = "";
    $chkColor = $_POST["chkTag"];
    for ($i = 0; $i < countval($chkColor); $i++) {
        $tg = $chkColor[$i];
        if (isset($tg)) {
            if (!empty($allColor)) {
                $allColor .= ",";
            }
            $allColor .= $tg;
        }
    }

    $allSize = "";
    $chkSize = $_POST["chkSize"];
    for ($i = 0; $i < countval($chkSize); $i++) {
        $tg = $chkSize[$i];
        if (isset($tg)) {
            if (!empty($allSize)) {
                $allSize .= ",";
            }
            $allSize .= $tg;
        }
    }

    $allMat = "";
    $chkMat = $_POST["chkMaterial"];
    for ($i = 0; $i < countval($chkMat); $i++) {
        $tg = $chkMat[$i];
        if (isset($tg)) {
            if (!empty($allMat)) {
                $allMat .= ",";
            }
            $allMat .= $tg;
        }
    }

    $allKeyWord = "";
    $chkKeyWord = $_POST["chkTagKeyWord"];
    for ($i = 0; $i < countval($chkKeyWord); $i++) {
        $tg = $chkKeyWord[$i];
        if (isset($tg)) {
            if (!empty($allKeyWord)) {
                $allKeyWord .= ",";
            }
            $allKeyWord .= $tg;
        }
    }

    $allFacility = "";
    $chkFacility = $_POST["chkFacility"];
    for ($i = 0; $i < countval($chkFacility); $i++) {
        $tg = $chkFacility[$i];
        if (isset($tg)) {
            if (!empty($allFacility)) {
                $allFacility .= ",";
            }
            $allFacility .= $tg;
        }
    }

    $allDesign = "";
    $chkDesign = $_POST["chkDesign"];
    for ($i = 0; $i < countval($chkDesign); $i++) {
        $tg = $chkDesign[$i];
        if (isset($tg)) {
            if (!empty($allDesign)) {
                $allDesign .= ",";
            }
            $allDesign .= $tg;
        }
    }

    $allProjectModel = "";
    $chkProjectModel = $_POST["chkProjectModel"];
    for ($i = 0; $i < countval($chkProjectModel); $i++) {
        $tg = $chkProjectModel[$i];
        if (isset($tg)) {
            if (!empty($allProjectModel)) {
                $allProjectModel .= ",";
            }
            $allProjectModel .= $tg;
        }
    }


    //FILE 1
    $fileDownloadTarget =  $GLOBALS["ROOT"] . "/_content_files/" . GetCurrentLang() . "/product/";
    $fileDownloadUpload = $_FILES["txtFileUpload"];

    if (!empty($fileDownloadUpload["name"])) {
        $fileDownloadUploadPath = $fileDownloadTarget . UploadFile2($_FILES["txtFileUpload"], $fileDownloadTarget, $fileDownloadUpload["name"]);
        $fileDownloadName = $fileDownloadUpload["name"];
    } else {
        $fileDownloadUploadPath = $_POST["hddBackUpFileDownload"];
        $fileDownloadName = $_POST["hddBackUpFileDownloadName"];
    }
    //FILE 2
    $fileDownloadUpload2 = $_FILES["txtFileUpload2"];
    if (!empty($fileDownloadUpload2["name"])) {
        $fileDownloadUploadPath2 = $fileDownloadTarget . UploadFile($_FILES["txtFileUpload2"], $fileDownloadTarget);
        $fileDownloadName2 = $fileDownloadUpload2["name"];
    } else {
        $fileDownloadUploadPath2 = $_POST["hddBackUpFileDownload2"];
        $fileDownloadName2 = $_POST["hddBackUpFileDownloadName2"];
    }
    //FILE 3
    $fileDownloadUpload3 = $_FILES["txtFileUpload3"];
    if (!empty($fileDownloadUpload3["name"])) {
        $fileDownloadUploadPath3 = $fileDownloadTarget . UploadFile($_FILES["txtFileUpload3"], $fileDownloadTarget);
        $fileDownloadName3 = $fileDownloadUpload3["name"];
    } else {
        $fileDownloadUploadPath3 = $_POST["hddBackUpFileDownload3"];
        $fileDownloadName3 = $_POST["hddBackUpFileDownloadName3"];
    }


    $uploadFileTarget =  $GLOBALS["ROOT"] . "/_content_images/" . GetCurrentLang() . "/product/";
    $fileUploaded = $_FILES["fileUpload"];

    if (!empty($fileUploaded["name"])) {
        $fileUploadedPath = $uploadFileTarget . UploadFile($_FILES["fileUpload"], $uploadFileTarget);
    } else {
        $fileUploadedPath = $_POST["hddBackUpImage"];
    }

    $uploadFileTarget2 =  $GLOBALS["ROOT"] . "/_content_images/" . GetCurrentLang() . "/product/image2";
    $fileUploaded2 = $_FILES["fileUpload2"];
    if (!empty($fileUploaded2["name"])) {
        $fileUploadedPath2 = $uploadFileTarget2 . UploadFile($_FILES["fileUpload2"], $uploadFileTarget2);
    } else {
        $fileUploadedPath2 = $_POST["hddBackUpImage2"];
    }

    $uploadFileTarget3 =  $GLOBALS["ROOT"] . "/_content_images/" . GetCurrentLang() . "/product/image3";
    $fileUploaded3 = $_FILES["fileUpload3"];
    if (!empty($fileUploaded3["name"])) {
        $fileUploadedPath3 = $uploadFileTarget3 . UploadFile($_FILES["fileUpload3"], $uploadFileTarget3);
    } else {
        $fileUploadedPath3 = $_POST["hddBackUpImage3"];
    }

    $uploadFileTarget4 =  $GLOBALS["ROOT"] . "/_content_images/" . GetCurrentLang() . "/product/image4";
    $fileUploaded4 = $_FILES["fileUpload4"];
    if (!empty($fileUploaded4["name"])) {
        $fileUploadedPath4 = $uploadFileTarget4 . UploadFile($_FILES["fileUpload4"], $uploadFileTarget4);
    } else {
        $fileUploadedPath4 = $_POST["hddBackUpImage4"];
    }

    if (!empty($prdCode)) {
        $sqlUpdate = "update product set 
                     ProductName = :ProductName
                    ,ShortDescription = :ShortDescription1
                    ,ShortDescription2 = :ShortDescription2
                    ,ProductDetail = :ProductDetail1
                    ,ProductDetail2 = :ProductDetail2
                    ,ProductDetail3 = :ProductDetail3
                    ,ProductDetail4 = :ProductDetail4
                    ,ProductDetail6 = :ProductDetail6
                    ,Image = :Image1
                    ,Image2 = :Image2
                    ,Image3 = :Image3
                    ,Image4= :Image4
                    ,Video = :Video
                    ,FileDownload = :FileDownload1
                    ,FileDownload2 = :FileDownload2
                    ,FileDownload3 = :FileDownload3
                    ,FileDownloadName = :FileDownloadName1
                    ,FileDownloadName2 = :FileDownloadName2
                    ,FileDownloadName3 = :FileDownloadName3
                    ,Active = :Active
                    ,UpdatedOn = NOW()
                    ,UpdatedBy = :UpdatedBy
                    ,BasePrice = :BasePrice
                    ,OldPrice = :OldPrice
                    ,Price = :Price
                    ,Hot = :Hot
                    ,Promotion = :Promotion
                    ,New = :New
                    ,Recommend = :Recommend
                    ,Rank = :Rank
                    ,CategoryCode = :CategoryCode
                    ,Size = :Size
                    ,Material = :Material
                    ,ProductRefCode = :ProductRefCode
                    ,Color = :Color
                    ,Tag = :Tag
                    ,Facility = :Facility
                    ,ProjectModel= :ProjectModel
                    ,DesignModel = :DesignModel
                    ,BrandCode = :BrandCode
                    ,ModelCode = :ModelCode
                    ,SubCategoryCode = :SubCategoryCode1
                    ,SubCategoryCode3 = :SubCategoryCode3
                    ,SubCategoryCode4 = :SubCategoryCode4
                    ,MapLocation = :MapLocation
                    ,Type = :Type
                    ,LandArea = :LandArea
                    ,UsableArea = :UsableArea
                    ,BedRoom = :BedRoom
                    ,Toilet = :Toilet
                    ,ParkingSpace = :ParkingSpace
                    ,FloorNumber = :FloorNumber
                    ,LivingRoom = :LivingRoom
                    ,KitchenRoom = :KitchenRoom
                    ,ByName = :ByName
                    ,ProductSize = :ProductSize
                    ,Amount = :Amount
                    ,Address = :Address
                    ,PriceDesc = :PriceDesc
                    ,StartDate= :StartDate
                    ,EndDate= :EndDate
                    ,Title = :Title
                    ,Description = :Description
                    ,Keyword = :Keyword
                    ,AltText = :AltText
                    ,AltText2 = :AltText2
                    where ProductCode = :ProductCode;
        ";

        ExecuteSQLTransaction($sqlUpdate, array(
            'ProductName' => $txtSubject,
            'ShortDescription1' => $txtShortDescription,
            'ShortDescription2' => $txtShortDescription2,
            'ProductDetail1' => $txtDetail,
            'ProductDetail2' => $txtDetail2,
            'ProductDetail3' => $txtDetail3,
            'ProductDetail4' => $txtDetail4,
            'ProductDetail6' => $txtDetail6,
            'Image1' => $fileUploadedPath,
            'Image2' => $fileUploadedPath2,
            'Image3' => $fileUploadedPath3,
            'Image4' => $fileUploadedPath4,
            'Video' => $hddFilePathVedio,
            'FileDownload1' => $fileDownloadUploadPath,
            'FileDownload2' => $fileDownloadUploadPath2,
            'FileDownload3' => $fileDownloadUploadPath3,
            'FileDownloadName1' => $fileDownloadName,
            'FileDownloadName2' => $fileDownloadName2,
            'FileDownloadName3' => $fileDownloadName3,
            'Active' => $chkActive,
            'UpdatedBy' => UserService::UserCode(),
            'BasePrice' => $txtBasePrice,
            'OldPrice' => $txtOldPrice,
            'Price' => $txtPrice,
            'Hot' => $choHot,
            'Promotion' => $choPromotion,
            'New' => $choNew,
            'Recommend' => $choRecommend,
            'Rank' => $txtRank,
            'CategoryCode' => $ddlCategory,
            'Size' => $allSize,
            'Material' => $allMat,
            'ProductRefCode' => $txtRefCode,
            'Color' => $allColor,
            'Tag' => $allKeyWord,
            'Facility' => $allFacility,
            'ProjectModel' => $allProjectModel,
            'DesignModel' => $allDesign,
            'BrandCode' => $ddlBrand,
            'ModelCode' => $ddlModel,
            'SubCategoryCode1' => $ddlSubCategory,
            'SubCategoryCode3' => $ddlSubCategory3,
            'SubCategoryCode4' => $ddlSubCategory4,
            'MapLocation' => $txtLatLng,
            'Type' => $ddlStatus,
            'LandArea' => $txtLandArea,
            'UsableArea' => $txtUsableArea,
            'BedRoom' => $txtBedRoom,
            'Toilet' => $txtToilet,
            'ParkingSpace' => $txtParkingSpace,
            'FloorNumber' => $txtFloorNumber,
            'LivingRoom' => $txtLivingRoom,
            'KitchenRoom' => $txtKitchenRoom,
            'ByName' => $txtByName,
            'ProductSize' => $txtProductSize,
            'Amount' => $txtAmount,
            'Address' => $txtAddress,
            'PriceDesc' => $txtPriceDesc,
            'StartDate' => $txtStartDate,
            'EndDate' => $txtEndDate,
            'Title' => $txtSEOTitle,
            'Description' => $txtSEODesc,
            'Keyword' => $txtSEOKeyword,
            'AltText' => $txtAltText,
            'AltText2' => $txtAltText2,
            'ProductCode' => $prdCode
        ), "product.php");

        //SendLineNotification2($prdCode);
    } else {
        $prdCode = GenerateNextID("product", "ProductCode", 5, "P");
        $sqlInsert = "insert into product (ProductCode,ProductName,ShortDescription,ShortDescription2,ProductDetail,ProductDetail2,ProductDetail3,ProductDetail4,ProductDetail6,Image,Image2,Image3,Image4,Video
                        ,FileDownload,FileDownload2,FileDownload3,FileDownloadName,FileDownloadName2,FileDownloadName3,Active,CreatedOn,CreatedBy
                        ,BasePrice,OldPrice,Price,Hot,Promotion,New,Recommend,Rank,CategoryCode,Size,Material,ProductRefCode
                        ,Color,Tag,Facility,ProjectModel,DesignModel,BrandCode,ModelCode,SubCategoryCode,SubCategoryCode3,SubCategoryCode4,MapLocation,Type
                        ,LandArea,UsableArea,BedRoom,Toilet,ParkingSpace,FloorNumber,LivingRoom,KitchenRoom
                        ,ByName,ProductSize,Amount,Address,PriceDesc,StartDate,EndDate,Title,Description,Keyword,AltText,AltText2)
                    VALUES(
                        :ProductCode,
                        :ProductName,
                        :ShortDescription1,
                        :ShortDescription2,
                        :ProductDetail1,
                        :ProductDetail2,
                        :ProductDetail3,
                        :ProductDetail4,
                        :ProductDetail6,
                        :Image1,
                        :Image2,
                        :Image3,
                        :Image4,
                        :Video,
                        :FileDownload1,
                        :FileDownload2,
                        :FileDownload3,
                        :FileDownloadName1,
                        :FileDownloadName2,
                        :FileDownloadName3,
                        :Active,
                        NOW(),
                        :CreatedBy,
                        :BasePrice,
                        :OldPrice,
                        :Price,
                        :Hot,
                        :Promotion,
                        :New,
                        :Recommend,
                        :Rank,
                        :CategoryCode,
                        :Size,
                        :Material,
                        :ProductRefCode,
                        :Color,
                        :Tag,
                        :Facility,
                        :ProjectModel,
                        :DesignModel,
                        :BrandCode,
                        :ModelCode,
                        :SubCategoryCode1,
                        :SubCategoryCode3,
                        :SubCategoryCode4,
                        :MapLocation,
                        :Type,
                        :LandArea,
                        :UsableArea,
                        :BedRoom,
                        :Toilet,
                        :ParkingSpace,
                        :FloorNumber,
                        :LivingRoom,
                        :KitchenRoom,
                        :ByName,
                        :ProductSize,
                        :Amount,
                        :Address,
                        :PriceDesc,
                        :StartDate,
                        :EndDate,
                        :Title,
                        :Description,
                        :Keyword,
                        :AltText,
                        :AltText2
                    );";

        ExecuteSQLTransaction($sqlInsert, array(
            'ProductCode' => $prdCode,
            'ProductName' => $txtSubject,
            'ShortDescription1' => $txtShortDescription,
            'ShortDescription2' => $txtShortDescription2,
            'ProductDetail1' => $txtDetail,
            'ProductDetail2' => $txtDetail2,
            'ProductDetail3' => $txtDetail3,
            'ProductDetail4' => $txtDetail4,
            'ProductDetail6' => $txtDetail6,
            'Image1' => $fileUploadedPath,
            'Image2' => $fileUploadedPath2,
            'Image3' => $fileUploadedPath3,
            'Image4' => $fileUploadedPath4,
            'Video' => $hddFilePathVedio,
            'FileDownload1' => $fileDownloadUploadPath,
            'FileDownload2' => $fileDownloadUploadPath2,
            'FileDownload3' => $fileDownloadUploadPath3,
            'FileDownloadName1' => $fileDownloadName,
            'FileDownloadName2' => $fileDownloadName2,
            'FileDownloadName3' => $fileDownloadName3,
            'Active' => $chkActive,
            'CreatedBy' => UserService::UserCode(),
            'BasePrice' => $txtBasePrice,
            'OldPrice' => $txtOldPrice,
            'Price' => $txtPrice,
            'Hot' => $choHot,
            'Promotion' => $choPromotion,
            'New' => $choNew,
            'Recommend' => $choRecommend,
            'Rank' => $txtRank,
            'CategoryCode' => $ddlCategory,
            'Size' => $allSize,
            'Material' => $allMat,
            'ProductRefCode' => $txtRefCode,
            'Color' => $allColor,
            'Tag' => $allKeyWord,
            'Facility' => $allFacility,
            'ProjectModel' => $allProjectModel,
            'DesignModel' => $allDesign,
            'BrandCode' => $ddlBrand,
            'ModelCode' => $ddlModel,
            'SubCategoryCode1' => $ddlSubCategory,
            'SubCategoryCode3' => $ddlSubCategory3,
            'SubCategoryCode4' => $ddlSubCategory4,
            'MapLocation' => $txtLatLng,
            'Type' => $ddlStatus,
            'LandArea' => $txtLandArea,
            'UsableArea' => $txtUsableArea,
            'BedRoom' => $txtBedRoom,
            'Toilet' => $txtToilet,
            'ParkingSpace' => $txtParkingSpace,
            'FloorNumber' => $txtFloorNumber,
            'LivingRoom' => $txtLivingRoom,
            'KitchenRoom' => $txtKitchenRoom,
            'ByName' => $txtByName,
            'ProductSize' => $txtProductSize,
            'Amount' => $txtAmount,
            'Address' => $txtAddress,
            'PriceDesc' => $txtPriceDesc,
            'StartDate' => $txtStartDate,
            'EndDate' => $txtEndDate,
            'Title' => $txtSEOTitle,
            'Description' => $txtSEODesc,
            'Keyword' => $txtSEOKeyword,
            'AltText' => $txtAltText,
            'AltText2' => $txtAltText2
        ), "product.php");

        //SendLineNotification2($prdCode);
    }

    $sqlDeleteColor = "delete from product_properties_mapping where ProductCode = :ProductCode ";
    ExecuteSQL($sqlDeleteColor, array('ProductCode' => $prdCode));

    if ($__COG_PROPERTIES_OPTION) {
        $chkPropDetail = $_POST["chkPropDetail"];
        for ($i = 0; $i < countval($chkPropDetail); $i++) {
            $tg = $chkPropDetail[$i];
            if (isset($tg)) {

                $sqlInsertColor = "insert into product_properties_mapping (PropCode,ProductCode,Detail)
                                    values(
                                    :PropCode,
                                    :ProductCode,
                                    '1'
                                    );";
                ExecuteSQL($sqlInsertColor, array('PropCode' => $tg, 'ProductCode' => $prdCode));
            }
        }
    } else {
        $txtPropCode = $_POST["txtPropCode"];
        $txtPropDetail = $_POST["txtPropDetail"];
        for ($i = 0; $i < countval($txtPropCode); $i++) {
            $propCode = $txtPropCode[$i];
            $propDetail = trim($txtPropDetail[$i]);
            if (empty($propDetail))
                continue;

            $sqlInsertColor = "insert into product_properties_mapping (PropCode,ProductCode,Detail)
                                    values(
                                    :PropCode,
                                    :ProductCode,
                                    :Detail
                                    );";
            ExecuteSQL($sqlInsertColor, array(
                'PropCode' => $propCode,
                'ProductCode' => $prdCode,
                'Detail' => $propDetail
            ));
        }
    }

    if ($_COG_ALLOW_MASTER_PROPERTIES) {
        $sqlDeleteColor = "delete from product_properties_mapping where ProductCode = :ProductCode";
        ExecuteSQL($sqlDeleteColor, array('ProductCode' => $prdCode));
        $txtPropName = $_POST["txtPropNameUni"];
        $txtPropDetail = $_POST["txtPropDetailUni"];
        for ($i = 0; $i < countval($txtPropName); $i++) {
            $propCode = str_pad(($i + 1), 3, '0', STR_PAD_LEFT);
            $propName = trim($txtPropName[$i]);
            $propDetail = trim($txtPropDetail[$i]);
            $sqlInsertColor = "insert into product_properties_mapping (PropCode,ProductCode,Name,Detail)
                                    values(
                                    :PropCode,
                                    :ProductCode,
                                    :Name,
                                    :Detail
                                    );";
            ExecuteSQL($sqlInsertColor, array(
                'PropCode' => $propCode,
                'ProductCode' => $prdCode,
                'Name' => $propName,
                'Detail' => $propDetail
            ));
        }
    }

    GenerateHTAccess();
}

if (!empty($prdCode)) {
    $sqlPrd = "select * from product where ProductCode = :ProductCode";
    $data = SelectRow($sqlPrd, array('ProductCode' => $prdCode));
}

?>

<style>
    .product-ranking-container {
        display: none
    }

    .product-promotion-container {
        display: none
    }

    .product-new-container {
        display: none
    }

    .product-recommend-container {
        display: none
    }

    .product-bestseller-container {
        display: block
    }

    .product-size-container {
        display: none
    }

    .product-color-container {
        display: none
    }

    .product-material-container {
        display: none
    }

    .product-file-container {
        display: none
    }

    .product-location-container {
        display: block
    }

    .product-tag-container {
        display: none
    }
</style>


<div class="mat-box grey-bar">

    <a href="product.php" class="link-history-btn">หน้าหลักข้อมูล<?php echo $_COG_ITEM_NAME ?></a>
    /
    <a href="product.php" class="link-history-btn">รายการ<?php echo $_COG_ITEM_NAME ?></a>
    /
    <span class="link-history-btn">จัดการข้อมูล<?php echo $_COG_ITEM_NAME ?></span>

</div>

<div class="mat-box" style="border-radius: 0 0 3px 3px">
    <form id="form-product" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-9">
                        <div>
                            <span><b><?php echo empty($_GET["ref"]) ? "เพิ่มข้อมูล" : "แก้ไขข้อมูล " . $_GET["ref"] ?></b></span>
                            <hr style="margin-top: 5px;" />
                        </div>
                        <div class="row">
                            <div class="col-sm-6 hide">
                                <label>รหัส</label>
                                <input type="text" placeholder="รหัส..." name="txtRefCode" id="txtRefCode" value="<?php echo $data["ProductRefCode"] ?>" class="form-control input-sm" />
                            </div>
                            <div class="col-sm-6">
                                <label>ชื่อ<?php echo $_COG_ITEM_NAME ?></label>
                                <input type="text" placeholder="ชื่อ<?php echo $_COG_ITEM_NAME ?>..." name="txtSubject" id="txtSubject" value="<?php echo $data["ProductName"] ?>" class="form-control input-sm require" />
                            </div>
                            <div class="col-sm-6">
                                <label>หมวดหมู่</label>
                                <!-- onchange="loadSubCategory(this.value);" -->
                                <select name="ddlCategory" class="form-control input-sm require">
                                    <?php echo GetDropDownListOptionWithDefaultSelectedAndCondition("product_category", "CategoryCode", "CategoryName", "กรุณาเลือก", $data["CategoryCode"], array('Active' => 1, 'CategoryGroup' => 'PRODUCT')) ?>
                                </select>
                            </div>
                        </div>

                        <div class="row hide">

                            <div class="col-sm-6 hide">
                                <label>ยี่ห้อ</label>
                                <!-- onchange="loadModel(this.value);" -->
                                <select name="ddlBrand" class="form-control input-sm require">
                                    <?php echo GetDropDownListOptionWithDefaultSelectedAndCondition("product_brand", "BrandCode", "BrandName", "ไม่ระบุ", $data["BrandCode"], array('Active' => 1)) ?>
                                </select>
                            </div>
                            <div class="col-sm-6 hide">
                                <label>หมวดหมู่ย่อยที่ 2</label>
                                <select name="ddlSubCategory" onchange="loadSubCategory3(this.value);" id="ddlSubCategory" class="form-control input-sm">
                                    <option value="">ไม่ระบุ</option>
                                </select>
                            </div>
                            <script>
                                function loadSubCategory(cateCode, setValue) {
                                    console.log(cateCode + "," + setValue);
                                    $("#ddlSubCategory").load("productSubCategoryLoadData.php?ref=" + cateCode, function() {
                                        if (setValue != undefined) {
                                            $("#ddlSubCategory").val(setValue);
                                        }
                                    });
                                }
                                <?php if (!empty($prdCode)) { ?>

                                    loadSubCategory('<?php echo $data["CategoryCode"] ?>', '<?php echo $data["SubCategoryCode"] ?>');

                                <?php } ?>
                            </script>
                            <div class="col-sm-4 hide">
                                <label>หมวดหมู่ย่อยที่ 3</label>
                                <!-- onchange="loadSubCategory4(this.value);" -->
                                <select name="ddlSubCategory3" id="ddlSubCategory3" class="form-control input-sm require">
                                    <option value="">ไม่ระบุ</option>
                                </select>
                            </div>
                        </div>
                        <div class="row hide">

                            <div class="col-sm-6 hide">
                                <label>หมวดหมู่<?php echo $_COG_ITEM_NAME ?> ย่อยที่ 4</label>
                                <select name="ddlSubCategory4" id="ddlSubCategory4" class="form-control input-sm require">
                                    <option value="">ไม่ระบุ</option>
                                </select>
                            </div>
                            <script>
                                function loadSubCategory3(cateCode, setValue) {
                                    $("#ddlSubCategory3").load("productSubCategoryLoadData3.php?ref=" + cateCode, function() {
                                        if (setValue != undefined) {
                                            $("#ddlSubCategory3").val(setValue);
                                        }
                                    });
                                }

                                function loadSubCategory4(cateCode, setValue) {
                                    $("#ddlSubCategory4").load("productSubCategoryLoadData4.php?ref=" + cateCode, function() {
                                        if (setValue != undefined) {
                                            $("#ddlSubCategory4").val(setValue);
                                        }
                                    });
                                }
                                <?php if (!empty($data["SubCategoryCode"])) { ?>
                                    loadSubCategory3('<?php echo $data["SubCategoryCode"] ?>', '<?php echo $data["SubCategoryCode3"] ?>');
                                <?php } ?>
                                <?php if (!empty($data["SubCategoryCode3"])) { ?>
                                    loadSubCategory4('<?php echo $data["SubCategoryCode3"] ?>', '<?php echo $data["SubCategoryCode4"] ?>');
                                <?php } ?>
                            </script>
                        </div>

                        <div class="row hide">
                            <div class="col-sm-6 hide">
                                <label>รุ่น<?php echo $_COG_ITEM_NAME ?></label>
                                <select name="ddlModel" id="ddlModel" class="form-control input-sm">
                                    <option value="">ไม่ระบุ</option>
                                </select>
                            </div>
                            <script>
                                function loadModel(brandCode, setValue) {
                                    $("#ddlModel").load("productModelLoadData.php?ref=" + brandCode, function() {
                                        if (setValue != undefined) {
                                            $("#ddlModel").val(setValue);
                                        }
                                    });
                                }
                                <?php if (!empty($prdCode)) { ?>

                                    loadModel('<?php echo $data["BrandCode"] ?>', '<?php echo $data["ModelCode"] ?>');

                                <?php } ?>
                            </script>

                        </div>

                        <div class="row hide">
                            <div class="col-sm-4">
                                <label>สถานะ</label>
                                <select name="ddlStatus" class="form-control input-sm require">
                                    <?php //echo GetDropDownListOptionWithDefaultSelectedAndCondition("tag","TagCode","TagName","กรุณาเลือก",$data["Type"],"TagType = 'PRODUCT_STATUS'") 
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row hide">
                            <div class="col-sm-4 hide">
                                <label>ปีที่ก่อสร้าง</label>
                                <input type="text" placeholder="ปีที่ก่อสร้าง..." name="txtByName" id="txtByName" value="<?php echo $data["ByName"] ?>" class="form-control input-sm" />
                            </div>
                            <div class="col-sm-4">
                                <label>ขนาดพื้นที่</label>
                                <input type="text" placeholder="ขนาด..." name="txtProductSize" id="txtProductSize" value="<?php echo $data["ProductSize"] ?>" class="form-control input-sm" />
                            </div>
                            <div class="col-sm-4 hide">
                                <label>จำนวน (ยูนิต)</label>
                                <input type="number" placeholder="จำนวน..." name="txtAmount" id="txtAmount" value="<?php echo $data["Amount"] ?>" class="form-control input-sm" />
                            </div>
                        </div>

                        <div class="row hide">
                            <div class="col-sm-12">
                                <label>ที่อยู่</label>
                                <input type="text" placeholder="ที่อยู่..." name="txtAddress" id="txtAddress" value="<?php echo $data["Address"] ?>" class="form-control input-sm" />
                            </div>
                            <div class="col-sm-4 hide">
                                <label>MPN</label>
                                <input type="text" placeholder="MPN..." name="txtPriceDesc" id="txtPriceDesc" value="<?php echo $data["PriceDesc"] ?>" class="form-control input-sm" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>รายละเอียดย่อ</label>
                                <textarea name="txtShortDescription" id="txtShortDescription" class="form-control input-sm require" rows="4"><?php echo $data["ShortDescription"] ?></textarea>
                            </div>
                        </div>

                        <div class="row hide">
                            <div class="col-sm-4">
                                <!-- <label>จำนวน (ยูนิต)</label> -->
                                <label>จำนวนสินค้า (คงเหลือ)</label>
                                <input type="number" placeholder="จำนวนคงเหลือ..." name="txtAmount" id="txtAmount" value="<?php echo $data["Amount"] ?>" class="form-control input-sm text-right require" />
                            </div>

                            <div class="col-sm-8">
                                <label>&nbsp;</label>
                                <div style="color:red">
                                    <b><i>* ระบบจะตัดจำนวนลงอัตโนมัติเมื่อสินค้าถูกสั่งซื้อ</i></b>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info hide">
                            <h4><b>ราคาเริ่มต้น</b></h4>
                            <div class="row">
                                <div class="col-sm-4 hide">
                                    <label>ราคาต้นทุน</label>
                                    <span class="text-muted">(บาท)</span>
                                    <input type="number" step="1" placeholder="ราคาต้นทุน..." name="txtBasePrice" id="txtBasePrice" value="<?php echo empty($data["BasePrice"]) ? "0" : $data["BasePrice"] ?>" class="form-control input-sm" />
                                </div>
                                <div class="col-sm-4 hide">
                                    <label>ราคาเดิม</label>
                                    <span class="text-muted">(บาท)</span>
                                    <input type="text" step="1" placeholder="ราคาเดิม..." name="txtOldPrice" id="txtOldPrice" value="<?php echo number_format($data["OldPrice"], 2) ?>" class="form-control input-sm require text-right" onkeypress="IsKeyNumber(event);" onchange="IsFormatNumber(this);" />
                                </div>
                                <div class="col-sm-4">
                                    <!-- <label>ราคาใหม่</label> -->
                                    <label>ราคา</label>
                                    <span class="text-muted">(บาท)</span>
                                    <input type="text" step="1" placeholder="ราคาเริ่มต้น..." name="txtPrice" id="txtPrice" value="<?php echo number_format($data["Price"], 2) ?>" class="form-control input-sm require text-right" onkeypress="IsKeyNumber(event);" onchange="IsFormatNumber(this);" />
                                </div>
                            </div>
                            <!-- <p class="label label-danger">
                                <b>** หากไม่มีการ Sale ให้ระบุราคาในช่องราคาเดิม และราคาใหม่เท่ากัน</b>
                            </p> -->
                        </div>
                        <!-- <p class="label label-danger hide">
                            <b>** ราคาต้นทุนจะไม่ถูกนำไปแสดงในหน้าสินค้า</b>
                        </p> -->
                        <!-- <br /> -->
                        <!-- <br> -->
                        <!-- home detail -->
                        <!-- <br> -->
                        <div class="alert alert-info hide">
                            <span class="text-primary"><b>ข้อมูลการใช้สอย</b></span>
                            <hr style="margin-top: 5px;" />
                            <div class="row">
                                <div class="col-sm-4 hide">
                                    <label>แบบบ้าน</label>
                                    <!-- <select name="ddlCategory" class="form-control input-sm require">
                                        <?php //echo GetDropDownListOptionWithDefaultSelectedAndCondition("product_category","CategoryCode","CategoryName","กรุณาเลือก",$data["CategoryCode"],"Active = 1 and CategoryGroup = 'PRODUCT'") 
                                        ?>
                                    </select> -->
                                </div>
                                <div class="col-sm-4">
                                    <label>พื้นที่ใช้สอย (ตารางเมตร)</label>
                                    <input type="number" placeholder="" name="txtUsableArea" id="txtUsableArea" value="<?php echo $data["UsableArea"] ?>" class="form-control input-sm text-right" />
                                </div>
                                <div class="col-sm-4">
                                    <label>ขนาดที่ดิน (ตารางวา)</label>
                                    <input type="number" placeholder="" name="txtLandArea" id="txtLandArea" value="<?php echo $data["LandArea"] ?>" class="form-control input-sm text-right" />
                                </div>
                                <div class="col-sm-4">
                                    <label>จำนวนชั้น</label>
                                    <input type="number" placeholder="" name="txtFloorNumber" id="txtFloorNumber" value="<?php echo $data["FloorNumber"] ?>" class="form-control input-sm text-right" />
                                </div>
                            </div>
                            <div class="row hide">
                                <div class="col-sm-4">
                                    <label>ห้องนอน</label>
                                    <input type="number" placeholder="" name="txtBedRoom" id="txtBedRoom" value="<?php echo $data["BedRoom"] ?>" class="form-control input-sm text-right" />
                                </div>
                                <div class="col-sm-4">
                                    <label>ห้องน้ำ</label>
                                    <input type="number" placeholder="" name="txtToilet" id="txtToilet" value="<?php echo $data["Toilet"] ?>" class="form-control input-sm text-right" />
                                </div>
                                <div class="col-sm-4">
                                    <label>ห้องรับแขก</label>
                                    <input type="number" placeholder="" name="txtLivingRoom" id="txtLivingRoom" value="<?php echo $data["LivingRoom"] ?>" class="form-control input-sm text-right" />
                                </div>
                            </div>
                            <div class="row hide">
                                <div class="col-sm-4">
                                    <label>ห้องครัว</label>
                                    <input type="number" placeholder="" name="txtKitchenRoom" id="txtKitchenRoom" value="<?php echo $data["KitchenRoom"] ?>" class="form-control input-sm text-right" />
                                </div>
                                <div class="col-sm-4">
                                    <label>ที่จอดรถ</label>
                                    <input type="number" placeholder="" name="txtParkingSpace" id="txtParkingSpace" value="<?php echo $data["ParkingSpace"] ?>" class="form-control input-sm text-right" />
                                </div>
                            </div>

                        </div>
                        <!-- <br> -->
                        <div class="alert alert-warning hide">
                            <span class="text-primary"><b>ข้อมูลโปรโมชั่น</b></span>
                            <hr style="margin-top: 5px;" />
                            <!-- <div class="row">
                                <div class="col-sm-8">
                                    <label>รายละเอียดราคา</label>
                                    <input type="text" placeholder="รายละเอียดราคา..." name="txtPriceDesc" id="txtPriceDesc" value="<?php echo $data["PriceDesc"] ?>" class="form-control input-sm require" />
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>เริ่ม</label>
                                    <div class="input-group">
                                        <input name="txtStartDate" type="text" placeholder="เริ่ม..." class="form-control date-picker require" autocomplete="off" value="<?php echo ConvertDateDBToDateDisplay($data["StartDate"]); ?>" />
                                        <span class="input-group-addon hand">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>ถึง</label>
                                    <div class="input-group">
                                        <input name="txtEndDate" type="text" placeholder="ถึง..." class="form-control date-picker require" autocomplete="off" value="<?php echo ConvertDateDBToDateDisplay($data["EndDate"]); ?>" />
                                        <span class="input-group-addon hand">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="hide">
                                <?php if ($__COG_PROPERTIES_OPTION) { ?>
                                    <br />
                                    <div class="">
                                        <span><b>ข้อมูลฟังก์ชั่น<?php echo $_COG_ITEM_NAME ?></b></span>
                                        <hr style="margin-top: 5px; margin-bottom: 10px;" />
                                        <div class="row">
                                            <?php
                                            $sqlTags = "select prop.*,map.Detail 
                                                    from product_properties prop
                                                    left join product_properties_mapping map
                                                        on map.PropCode = prop.PropCode 
                                                        and map.ProductCode = :ProductCode
                                                    where prop.Active = 1 
                                                        and prop.PropGroup = :PropGroup
                                                    order by prop.SEQ";
                                            $dataTags = SelectRowsArray($sqlTags, array('ProductCode' => $prdCode, 'PropGroup' => $_COG_ITEM_CODE));
                                            foreach ($dataTags  as $tag) {
                                            ?>
                                                <div class="col-sm-6" onclick="$(this).find('input').click();">
                                                    <input onclick="event.stopPropagation();" class="chk-project-model" type="checkbox" <?php echo !empty($tag["Detail"]) ? "checked" : "" ?> name="chkPropDetail[]" id="chk-<?php echo $tag["PropCode"] ?>" value="<?php echo $tag["PropCode"] ?>" />
                                                    <label onclick="event.stopPropagation();" for="chk-<?php echo $tag["PropCode"] ?>" class="hand"><span class="text-primary"><?php echo $tag["PropName"]; ?></span></label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>

                        <div class="hide">
                            <span><b>ฟังก์ชั่นบ้าน
                                </b></span>
                            <hr style="margin-top: 5px; margin-bottom: 10px;" />
                            <div class="row">
                                <?php
                                $sqlTags = "select a.PortCode,a.PortName,a.CategoryCode,b.CategoryName,a.Image 
                                        FROM portfolio a
                                        left join product_category b on a.CategoryCode = b.CategoryCode
                                        WHERE a.Active=1 and a.PortType='PROJECTMODEL' ";
                                $dataTags = SelectRowsArray($sqlTags);
                                foreach ($dataTags  as $tag) {
                                ?>
                                    <div class="col-sm-12" onclick="$(this).find('input').click();">
                                        <input onclick="event.stopPropagation();" class="chk-project-model" type="checkbox" <?php echo strpos($data["ProjectModel"], $tag["PortCode"]) !== false ? "checked" : "" ?> name="chkProjectModel[]" id="chk-<?php echo $tag["PortCode"] ?>" value="<?php echo $tag["PortCode"] ?>" />
                                        <label onclick="event.stopPropagation();" for="chk-<?php echo $tag["PortCode"] ?>" class="hand"><span class="text-primary">[<?php echo $tag["CategoryName"]; ?>]</span> <?php echo $tag["PortName"]; ?></label>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="hide">
                            <span><b>สิ่งอำนวยความสะดวก
                                </b></span>
                            <hr style="margin-top: 5px; margin-bottom: 10px;" />
                            <div class="row">
                                <?php
                                $sqlTags = "select PortCode,PortName,Image FROM portfolio WHERE Active=1 and PortType='FACILITY'";
                                $dataTags = SelectRowsArray($sqlTags);
                                foreach ($dataTags  as $tag) {
                                ?>
                                    <div class="col-sm-6" onclick="$(this).find('input').click();">
                                        <input onclick="event.stopPropagation();" class="chk-facility" type="checkbox" <?php echo strpos($data["Facility"], $tag["PortCode"]) !== false ? "checked" : "" ?> name="chkFacility[]" id="chk-<?php echo $tag["PortCode"] ?>" value="<?php echo $tag["PortCode"] ?>" />
                                        <label onclick="event.stopPropagation();" for="chk-<?php echo $tag["PortCode"] ?>" class="hand"><?php echo $tag["PortName"] ?></label>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="hide">
                            <span><b>การออกแบบ
                                </b></span>
                            <hr style="margin-top: 5px; margin-bottom: 10px;" />
                            <div class="row">
                                <?php
                                $sqlTags = "select PortCode,PortName,Image FROM portfolio WHERE Active=1 and PortType='DESIGN'";
                                $dataTags = SelectRowsArray($sqlTags);
                                foreach ($dataTags  as $tag) {
                                ?>
                                    <div class="col-sm-6" onclick="$(this).find('input').click();">
                                        <input onclick="event.stopPropagation();" class="chk-design" type="checkbox" <?php echo strpos($data["DesignModel"], $tag["PortCode"]) !== false ? "checked" : "" ?> name="chkDesign[]" id="chk-<?php echo $tag["PortCode"] ?>" value="<?php echo $tag["PortCode"] ?>" />
                                        <label onclick="event.stopPropagation();" for="chk-<?php echo $tag["PortCode"] ?>" class="hand"><?php echo $tag["PortName"] ?></label>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <?php if ($_COG_ALLOW_MASTER_PROPERTIES) { ?>
                            <div class="alert alert-success">
                                <h4 style="margin-bottom:10px"><b><?php echo !empty($_COG_ALLOW_MASTER_PROPERTIES_TITLE) ? $_COG_ALLOW_MASTER_PROPERTIES_TITLE : "ข้อมูลเฉพาะ" ?></b></h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-striped" style="background: #fff">
                                            <thead class="text-center" style="background: rgb(56 191 0);color:#fff">
                                                <tr>
                                                    <th style="width: 35%;">
                                                        หัวข้อ
                                                    </th>
                                                    <th>
                                                        คำอธิบาย
                                                    </th>
                                                    <th style="width: 50px;"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sqlPropUnique = "select * from product_properties_mapping where ProductCode= :ProductCode order by PropCode asc ";
                                                $datasProps = SelectRowsArray($sqlPropUnique, array('ProductCode' => $data["ProductCode"]));
                                                foreach ($datasProps as $propQ) {
                                                ?>
                                                    <tr>
                                                        <th>
                                                            <label class="hide">หัวข้อ</label>
                                                            <input type="text" placeholder="หัวข้อ..." name="txtPropNameUni[]" value="<?php echo $propQ["Name"] ?>" class="form-control input-sm require">
                                                        </th>
                                                        <td class="">
                                                            <label class="hide">คำอธิบาย</label>
                                                            <input type="text" placeholder="คำอธิบาย..." name="txtPropDetailUni[]" value="<?php echo $propQ["Detail"] ?>" class="form-control input-sm require">
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="javascript:;" onclick="$(this).closest('tr').remove();">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                <?php if (countval($datasProps) <= 0 && empty($data["PortCode"])) { ?>
                                                    <tr>
                                                        <th>
                                                            <label class="hide">หัวข้อ</label>
                                                            <input type="text" placeholder="หัวข้อ..." name="txtPropNameUni[]" value="" class="form-control input-sm require">
                                                        </th>
                                                        <td class="">
                                                            <label class="hide">คำอธิบาย</label>
                                                            <input type="text" placeholder="คำอธิบาย..." name="txtPropDetailUni[]" class="form-control input-sm require">
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="javascript:;" onclick="$(this).closest('tr').remove();">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td colspan="100%" class="text-center">
                                                        <a href="javascript:;" onclick="$(this).closest('tr').before($('.tmp').clone().removeClass('tmp'));">
                                                            <i class="fa fa-plus fa-fw"></i>
                                                            สร้างรายการ
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if (!$__COG_PROPERTIES_OPTION) { ?>
                            <div class="hide">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h3>
                                            <small class="text-danger">*กรอกเฉพาะคุณสมบัติที่ตรงกับ<?php echo $_COG_ITEM_NAME ?></small>
                                        </h3>
                                        <hr style="margin-top: 5px;" />
                                        <div>
                                            <table class="table table-striped">
                                                <?php

                                                $sql = "select prop.*,map.Detail 
                                                from product_properties prop
                                                left join product_properties_mapping map
                                                    on map.PropCode = prop.PropCode 
                                                    and map.ProductCode = :ProductCode
                                                where prop.Active = 1 
                                                    and prop.PropGroup = :PropGroup
                                                order by prop.SEQ";
                                                $dataProps = SelectRows($sql, array('ProductCode' => $prdCode, 'PropGroup' => $_COG_ITEM_CODE));
                                                foreach ($dataProps as $dataProp) {
                                                ?>
                                                    <tr>
                                                        <th class="text-right" style="width: 200px; vertical-align: middle; padding-right: 30px; color: #ed2437"><?php echo $dataProp["PropName"] ?></th>
                                                        <td>
                                                            <?php
                                                            if (!empty($dataProp["PropSelected"])) {
                                                            ?>
                                                                <select name="txtPropDetail[]" class="form-control input-sm">
                                                                    <?php //echo GetDropDownListOptionWithDefaultSelectedAndCondition("tag", "TagCode", "TagName", "", $dataProp["Detail"], array('TagType' => $dataProp["PropSelected"])) 
                                                                    ?>
                                                                    <option value=""></option>
                                                                    <?php
                                                                    $options = SelectRows("select * from tag where TagType = :TagType order by TagName asc",  array('TagType' => $dataProp["PropSelected"]));
                                                                    foreach ($options as $opt) {
                                                                    ?>
                                                                        <option value="<?php echo $opt["TagCode"] ?>" <?php echo $opt["TagCode"] == $dataProp["Detail"] ? ' selected="selected" ' : ''  ?><?php echo $opt["TagName"] ?></option>
                                                                        <?php
                                                                    }
                                                                        ?>
                                                                </select>
                                                            <?php } else { ?>
                                                                <textarea name="txtPropDetail[]" style="min-height:30px;" class="form-control input-sm"><?php echo $dataProp["Detail"] ?></textarea>
                                                            <?php } ?>
                                                            <input type="hidden" name="txtPropCode[]" value="<?php echo $dataProp["PropCode"] ?>" />
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        </div>
                                        <br />
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="product-material-container">

                            <span><b>สิ่งอำนวยความสะดวก ที่มี
                                    <span class="text-danger">*เลือกอย่างน้อย 1 รายการ
                                    </span>
                                </b></span>
                            <hr style="margin-top: 5px; margin-bottom: 10px;" />

                            <div class="row">
                                <?php

                                $sqlTags = "select * from tag where TagType = 'MATERIAL' and Active = 1 order by TagName";

                                $dataTags = SelectRows($sqlTags);
                                foreach ($dataTags as $tag) {
                                    $chechTag = strpos($tag["TagCode"], $data["Material"]);
                                ?>
                                    <div class="col-sm-6" onclick="$(this).find('input').click();">
                                        <input onclick="event.stopPropagation();" class="chk-material" type="checkbox" <?php echo strpos($data["Material"], $tag["TagCode"]) !== false ? "checked" : "" ?> name="chkMaterial[]" id="chk-<?php echo $tag["TagCode"] ?>" value="<?php echo $tag["TagCode"] ?>" />
                                        <label onclick="event.stopPropagation();" for="chk-<?php echo $tag["TagCode"] ?>" class="hand"><?php echo $tag["TagName"] ?></label>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>

                        <!-- <br /><br /> -->

                        <div class="row hide">
                            <div class="col-sm-12">
                                <label>รายละเอียดย่อ 2</label>
                                <textarea name="txtShortDescription2" id="txtShortDescription2" class="form-control input-sm require" rows="4"><?php echo $data["ShortDescription2"] ?></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 summernote-container">
                                <label>รายละเอียด</label>
                                <?php
                                // =============== HTML EDITOR =============== 
                                $_HTML_EDITOR_NAME = "txtDetail";
                                $_HTML_EDITOR_CONTENT_ID = $data["ProductDetail"];
                                include $GLOBALS['DOCUMENT_ROOT'] . '/ControlPanel/HtmlEditor/HtmlEditor.php';
                                ?>
                            </div>
                        </div>

                        <div class="row hide">
                            <div class="col-sm-12 summernote-container">
                                <label>รายละเอียด 2</label>
                                <?php
                                // =============== HTML EDITOR =============== 
                                $_HTML_EDITOR_NAME = "txtDetail2";
                                $_HTML_EDITOR_CONTENT_ID = $data["ProductDetail2"];
                                include $GLOBALS['DOCUMENT_ROOT'] . '/ControlPanel/HtmlEditor/HtmlEditor.php';
                                ?>
                            </div>
                        </div>
                        <div class="row hide">
                            <div class="col-sm-12 summernote-container">
                                <label>Specification</label>
                                <?php
                                // =============== HTML EDITOR =============== 
                                $_HTML_EDITOR_NAME = "txtDetail3";
                                $_HTML_EDITOR_CONTENT_ID = $data["ProductDetail3"];
                                include $GLOBALS['DOCUMENT_ROOT'] . '/ControlPanel/HtmlEditor/HtmlEditor.php';
                                ?>
                            </div>
                        </div>

                        <div class="hide">
                            <div class="col-sm-12 summernote-container">
                                <label>มาตรฐาน</label>
                                <?php
                                // =============== HTML EDITOR =============== 
                                $_HTML_EDITOR_NAME = "txtDetail4";
                                $_HTML_EDITOR_CONTENT_ID = $data["ProductDetail4"];
                                include $GLOBALS['DOCUMENT_ROOT'] . '/ControlPanel/HtmlEditor/HtmlEditor.php';
                                ?>
                            </div>
                        </div>



                        <div class="row hide">
                            <div class="col-sm-12 summernote-container">
                                <label>รายละเอียดแสดงที่หน้าแรก</label>
                                <?php
                                // =============== HTML EDITOR =============== 
                                $_HTML_EDITOR_NAME = "txtDetail6";
                                $_HTML_EDITOR_CONTENT_ID = $data["ProductDetail6"];
                                include $GLOBALS['DOCUMENT_ROOT'] . '/ControlPanel/HtmlEditor/HtmlEditor.php';
                                ?>
                            </div>
                        </div>
                        <br />

                        <style>
                            .tag-panel {
                                border-bottom: 1px solid #ccc;
                                margin-bottom: 0;
                                padding: 3px 10px;
                                cursor: pointer;
                            }

                            .tag-panel:hover {
                                background: #eee;
                            }
                        </style>

                        <div class="product-color-container">

                            <span><b>สีที่มี
                                    <span class="text-danger">*เลือกอย่างน้อย 1 รายการ
                                    </span>
                                </b></span>
                            <hr style="margin-top: 5px; margin-bottom: 10px;" />

                            <div class="row">
                                <?php

                                $sqlTags = "select * from tag where TagType = 'COLOR' and Active = 1 order by TagName";

                                $dataTags = SelectRows($sqlTags);
                                foreach ($dataTags as $tag) {
                                ?>
                                    <div class="col-sm-6" onclick="$(this).find('input').click();">
                                        <input onclick="event.stopPropagation();" class="chk-tag" type="checkbox" <?php echo strpos($data["Color"], $tag["TagCode"]) !== false ? "checked" : "" ?> name="chkTag[]" id="chk-<?php echo $tag["TagCode"] ?>" value="<?php echo $tag["TagCode"] ?>" />
                                        <label onclick="event.stopPropagation();" for="chk-<?php echo $tag["TagCode"] ?>" class="hand"><?php echo $tag["TagName"] ?></label>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>

                        <div class="product-size-container">

                            <span><b>
                                    ไซส์ที่มี
                                    <span class="text-danger">*เลือกอย่างน้อย 1 รายการ
                                    </span>
                                </b></span>
                            <hr style="margin-top: 5px; margin-bottom: 10px;" />

                            <div class="row">
                                <?php

                                $sqlTags = "select * from tag where TagType = 'SIZE' and Active = 1"; //order by TagName

                                $dataTags = SelectRows($sqlTags);
                                foreach ($dataTags as $tag) {
                                ?>
                                    <div class="col-sm-6" onclick="$(this).find('input').click();">
                                        <input onclick="event.stopPropagation();" class="chk-size" type="checkbox" <?php echo strpos($data["Size"], $tag["TagCode"]) !== false ? "checked" : "" ?> name="chkSize[]" id="chk-<?php echo $tag["TagCode"] ?>" value="<?php echo $tag["TagCode"] ?>" />
                                        <label onclick="event.stopPropagation();" for="chk-<?php echo $tag["TagCode"] ?>" class="hand"><?php echo $tag["TagName"] ?></label>
                                    </div>
                                <?php } ?>
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

                    </div>
                    <div class="col-md-3">

                        <div>
                            <!-- image 1 -->
                            <div>
                                <span><b>รูปภาพหลัก</b></span>
                                <hr style="margin-top: 5px; margin-bottom: 5px;" />
                                <p>
                                    <small class="text-danger">*ขนาดภาพที่เหมาะสมที่สุดคือ 600 x 800 pixels</small>
                                </p>
                                <div id="imge-preview" class="image-box hand" onclick="$(this).next().click();" style="margin:0 auto; width: 200px; height: 230px;margin-bottom:15px; background-image: url(<?php echo $data["Image"] ?>), url('http://placehold.it/463x353')">
                                </div>
                                <input class="hide" type="file" onchange="$(this).previewImage($('#imge-preview'));" name="fileUpload" id="fileUpload" accept="image/*" />
                                <input type="hidden" name="hddBackUpImage" value="<?php echo $data["Image"] ?>" />
                                <div class="text-center">
                                    <small>คลิกด้านบนรูปเพื่อเลือกรูปภาพ</small>
                                </div>
                            </div>

                            <br>

                            <!-- image 2 -->
                            <div class="hide">
                                <span><b>รูปภาพ Logo</b></span>
                                <hr style="margin-top: 5px; margin-bottom: 5px;" />
                                <p>
                                    <small class="text-danger">*ขนาดภาพที่เหมาะสมที่สุดคือ 600 x 800 pixels</small>
                                </p>
                                <div id="imge-preview-2" class="image-box hand" onclick="$(this).next().click();" style="margin:0 auto; width: 200px; height: 230px;margin-bottom:15px; background-image: url(<?php echo $data["Image2"] ?>), url('http://placehold.it/389x500')">
                                </div>
                                <input class="hide" type="file" onchange="$(this).previewImage($('#imge-preview-2'));" name="fileUpload2" id="fileUpload2" accept="image/*" />
                                <input type="hidden" name="hddBackUpImage2" value="<?php echo $data["Image2"] ?>" />
                                <div class="text-center">
                                    <small>คลิกด้านบนรูปเพื่อเลือกรูปภาพ</small>
                                </div>
                            </div>

                            <!-- image 3 -->
                            <div class="hide">
                                <br>
                                <span><b>รูปภาพปกวีดีโอ</b></span>
                                <hr style="margin-top: 5px; margin-bottom: 5px;" />
                                <p>
                                    <small class="text-danger">*ขนาดภาพที่เหมาะสมที่สุดคือ 1200 x 350 pixels</small>
                                </p>

                                <div id="imge-preview3" class="image-box hand" onclick="$(this).next().click();" style="margin:0 auto; width: 200px; height: 230px;margin-bottom:15px; background-image: url(<?php echo $data["Image3"] ?>), url('https://ipsumimage.appspot.com/800x800,eee')">
                                </div>

                                <input class="hide" type="file" onchange="$(this).previewImage($('#imge-preview3'));" name="fileUpload3" id="fileUpload3" accept="image/*" />

                                <input type="hidden" name="hddBackUpImage3" value="<?php echo $data["Image3"] ?>" />

                                <div class="text-center">
                                    <small>คลิกด้านบนรูปเพื่อเลือกรูปภาพ</small>
                                </div>
                            </div>


                            <!-- image 4 -->
                            <div class="hide">
                                <br>
                                <span><b>รูปภาพสเปครุ่นรถ</b></span>
                                <hr style="margin-top: 5px; margin-bottom: 5px;" />
                                <p>
                                    <small class="text-danger">*ขนาดภาพที่เหมาะสมที่สุดคือ 800 x 800 pixels</small>
                                </p>

                                <div id="imge-preview4" class="image-box hand" onclick="$(this).next().click();" style="margin:0 auto; width: 200px; height: 230px;margin-bottom:15px; background-image: url(<?php echo $data["Image4"] ?>), url('https://ipsumimage.appspot.com/800x800,eee')">
                                </div>


                                <input class="hide" type="file" onchange="$(this).previewImage($('#imge-preview4'));" name="fileUpload4" id="fileUpload4" accept="image/*" />

                                <input type="hidden" name="hddBackUpImage4" value="<?php echo $data["Image4"] ?>" />


                                <div class="text-center">
                                    <small>คลิกด้านบนรูปเพื่อเลือกรูปภาพ</small>
                                </div>
                            </div>

                            <div class="hide">
                                <span>
                                    <b>
                                        <a href="javascript:;" onclick="$('#modal-howto').modal('show');">
                                            <i class="fa fa-search"></i>
                                            เพิ่มวีดีโอ ดูวิธีการหาลิงค์ยูทูป
                                        </a>
                                    </b>
                                </span>
                                <hr style="margin-top: 5px; margin-bottom: 5px;" />
                                <div class="row">
                                    <div class="col-md-12">
                                        <div>
                                            <style>
                                                .slide-banner {
                                                    width: 100%;
                                                    height: 200px;
                                                    position: relative;
                                                }

                                                .slide-banner.h-auto {
                                                    width: 100%;
                                                    height: auto !important;
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

                                                .slide-banner .editer {
                                                    right: 20px;
                                                }
                                            </style>
                                            <div class="row panel-video">

                                                <div class="panel-video-display col-xs-12 <?php echo !empty($data["Video"]) ? "" : "hide" ?>">
                                                    <div class="slide-banner image-box">
                                                        <iframe class="iframe-video-diaplay" style="width:100%;height:100%;background:#000" src="<?php echo $data["Video"] ?>"></iframe>
                                                        <i class="fa fa-trash remover" onclick="$(this).next().click();"></i>
                                                        <input type="button" onclick="confirmDeleteVedio(this);" class="btn-delete hide" name="btnDelete" value="" />
                                                        <input type="hidden" name="hddFilePathVedio" value="<?php echo $data["Video"] ?>" />
                                                    </div>
                                                </div>

                                                <div class="panel-video-add col-xs-12 <?php echo empty($data["Video"]) ? "" : "hide" ?>">
                                                    <form method="post" enctype="multipart/form-data">
                                                        <div class="slide-banner image-box slide-adder hand" onclick="openModalInsert();" style="position: relative; background-color: #eee;">
                                                            <div style="position: absolute; left: 0; right: 0; top: 75px; text-align: center;">
                                                                <i class="fa fa-video fa-5x text-muted"></i>
                                                            </div>
                                                            <div style="position: absolute; left: 0; right: 0; bottom: 75px; text-align: center;">
                                                                <small>คลิกเพื่อเพิ่มวีดีโอ</small>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- Modal -->
                                            <div id="modal-howto" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-lg">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">วิธีการหาลิงค์ยูทูป</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>1. ไปที่ <a target="_blank" href="https://www.youtube.com">https://www.youtube.com</a></p>
                                                            <p>
                                                                2. ค้นหาและคลิกเพื่อดูวีดีโอที่คุณต้องการเพิ่ม เช่น
                                                            </p>
                                                            <p>
                                                                <img src="../video/assets/how-1.png" style="width:100%" />
                                                            </p>
                                                            <p>
                                                                3. คัดลอก URL ของวีดีโอ
                                                            </p>
                                                            <p>
                                                                <img src="../video/assets/how-2.png" style="width:100%" />
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                function openModalInsert() {
                                                    $("#modal-insert").modal("show");
                                                }

                                                function onchangeVideoInsert(obj) {
                                                    var val = $(obj).prev().val();
                                                    if (val.toLowerCase().match("youtube.com") && val.toLowerCase().match("v=")) {
                                                        val = "https://www.youtube.com/embed/" + getUrlVars(val)["v"]; //val.split("v=")[val.split("v=").length - 1];
                                                    } else if (val.toLowerCase().match("youtu.be")) {
                                                        val = "https://www.youtube.com/embed/" + val.split("/")[val.split("/").length - 1];
                                                    }
                                                    $(obj).prev().val(val);
                                                    var frame = $(obj).closest(".modal").find(".iframe-video");
                                                    frame.prop("src", val);
                                                }

                                                function getUrlVars(val) {
                                                    var vars = [],
                                                        hash;
                                                    var hashes = val.slice(val.indexOf('?') + 1).split('&');
                                                    for (var i = 0; i < hashes.length; i++) {
                                                        hash = hashes[i].split('=');
                                                        vars.push(hash[0]);
                                                        vars[hash[0]] = hash[1];
                                                    }
                                                    return vars;
                                                }

                                                function confirmDeleteVedio(obj) {
                                                    if (Confirm(obj, 'Are you sure you want delete ?')) {
                                                        var frame = $(obj).closest(".modal").find(".iframe-video");
                                                        frame.prop("src", "");
                                                        $(obj).next().val("");
                                                        //$("[name='txtImagePathVideo']").val("");
                                                        var panelVideo = $(obj).closest('.panel-video');
                                                        $(panelVideo).find('.panel-video-display').addClass('hide');
                                                        $(panelVideo).find('.panel-video-add').removeClass('hide');

                                                    }
                                                }

                                                function onchangeVideoDiaplayForSave(obj) {
                                                    if (Validate(obj, $('#modal-insert'))) {
                                                        var val = $(obj).closest('.modal-dialog').find("[name='txtImagePathVideo']").val();
                                                        if (val.toLowerCase().match("youtube.com") && val.toLowerCase().match("v=")) {
                                                            val = "https://www.youtube.com/embed/" + getUrlVars(val)["v"]; //val.split("v=")[val.split("v=").length - 1];
                                                        } else if (val.toLowerCase().match("youtu.be")) {
                                                            val = "https://www.youtube.com/embed/" + val.split("/")[val.split("/").length - 1];
                                                        }
                                                        var frame = $(".iframe-video-diaplay");
                                                        $(frame).closest('.slide-banner').find('[name="hddFilePathVedio"]').val(val);
                                                        frame.prop("src", val);
                                                        var panelVideo = $(frame).closest('.panel-video');
                                                        $(panelVideo).find('.panel-video-display').removeClass('hide');
                                                        $(panelVideo).find('.panel-video-add').addClass('hide');
                                                        $("#modal-insert").modal("hide");

                                                    }
                                                }
                                            </script>
                                            <!-- Modal -->
                                            <div id="modal-insert" class="modal fade" role="dialog">
                                                <div class="modal-dialog  modal-lg">
                                                    <!-- Modal content-->
                                                    <form method="post" class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">เพิ่มลิงค์ของวีดีโอ</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <p>
                                                                        <label>วีดีโอ</label>
                                                                        <iframe class="iframe-video" style="width:100%;height:280px;background:#000"></iframe>
                                                                    </p>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <p>
                                                                        <label>URL Youtube</label>
                                                                    <div class="input-group">
                                                                        <input type="text" placeholder="URL Youtube" class="form-control input-sm require" name="txtImagePathVideo" value="<?php echo $data["Video"] ?>" />
                                                                        <span class="input-group-addon hand" onclick="onchangeVideoInsert(this);">
                                                                            <i class="fa fa-refresh"></i>
                                                                        </span>
                                                                    </div>
                                                                    </p>
                                                                    <p>
                                                                        <b class="text-danger">
                                                                            ** เมื่อกรอก URL แล้วกดปุ่ม <i class="fa fa-refresh"></i> หาก URL ถูกต้องวีดีโอของคุณจะปรากฏในด้านซ้าย
                                                                        </b>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <span onclick="onchangeVideoDiaplayForSave(this);" class="btn btn-success">บันทึก</span>
                                                            <!-- <button type="submit" onclick="return Validate(this,$('#modal-insert'));" class="btn btn-success" value="VIDEO" name="btnUpload">บันทึก</button> -->
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="product-tag-container">
                                <span><b>แท็ก
                                        <span class="text-danger">*เลือกอย่างน้อย 1 รายการ
                                        </span>
                                    </b></span>
                                <hr style="margin-top: 5px; margin-bottom: 10px;" />
                                <div class="row">
                                    <?php
                                    $sqlTags = "select * from tag where Active = 1 and TagType = 'PRODUCT' order by TagName";
                                    $dataTags = SelectRowsArray($sqlTags);
                                    foreach ($dataTags  as $tag) {
                                    ?>
                                        <div class="col-sm-12" onclick="$(this).find('input').click();">
                                            <input onclick="event.stopPropagation();" class="chk-tag-keyword" type="checkbox" <?php echo strpos($data["Tag"], $tag["TagCode"]) !== false ? "checked" : "" ?> name="chkTagKeyWord[]" id="chk-<?php echo $tag["TagCode"] ?>" value="<?php echo $tag["TagCode"] ?>" />
                                            <label onclick="event.stopPropagation();" for="chk-<?php echo $tag["TagCode"] ?>" class="hand"><?php echo $tag["TagName"] ?></label>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="product-active-container">

                                <br />
                                <span><b>ใช้งาน / ไม่ใช้งาน</b></span>
                                <hr style="margin-top: 5px; margin-bottom: 5px;" />

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

                            <div class="product-promotion-container">
                                <br />
                                <span><b>Promotion</b></span>
                                <hr style="margin-top: 5px; margin-bottom: 5px;" />

                                <div>
                                    <i id="toggle-Promotion" class="fa fa-toggle-on fa-3x text-info hand" style="" onclick="togglePromotion(this);"></i>
                                    <input type="checkbox" name="choPromotion" class="hide" checked="checked" value="" />
                                </div>
                                <script>
                                    function togglePromotion(obj) {
                                        $(obj).toggleClass('fa-toggle-on').toggleClass('fa-toggle-off')
                                            .toggleClass('text-info')
                                            .toggleClass('text-danger').next().click();
                                    }
                                    <?php if (!empty($_GET["ref"]) && $data["Promotion"] == 0) { ?>
                                        $("#toggle-Promotion").click();
                                    <?php } ?>
                                </script>
                            </div>

                            <div class="product-new-container">
                                <br />
                                <span><b>สินค้ามาใหม่</b></span>
                                <hr style="margin-top: 5px; margin-bottom: 5px;" />

                                <div>
                                    <i id="toggle-new" class="fa fa-toggle-on fa-3x text-primary hand" style="" onclick="toggleNew(this);"></i>
                                    <input type="checkbox" name="choNew" class="hide" checked="checked" value="" />
                                </div>
                                <script>
                                    function toggleNew(obj) {
                                        $(obj).toggleClass('fa-toggle-on').toggleClass('fa-toggle-off')
                                            .toggleClass('text-primary')
                                            .toggleClass('text-danger').next().click();
                                    }
                                    <?php if (!empty($_GET["ref"]) && $data["New"] == 0) { ?>
                                        $("#toggle-new").click();
                                    <?php } ?>
                                </script>
                            </div>

                            <div class="product-recommend-container">
                                <br />
                                <span><b>แนะนำ หน้าแรก</b></span>
                                <hr style="margin-top: 5px; margin-bottom: 5px;" />
                                <div>
                                    <i id="toggle-recommend" class="fa fa-toggle-on fa-3x text-primary hand" style="" onclick="toggleRecommend(this);"></i>
                                    <input type="checkbox" name="choRecommend" class="hide" checked="checked" value="" />
                                </div>
                                <script>
                                    function toggleRecommend(obj) {
                                        $(obj).toggleClass('fa-toggle-on').toggleClass('fa-toggle-off')
                                            .toggleClass('text-primary')
                                            .toggleClass('text-danger').next().click();
                                    }
                                    <?php if (!empty($_GET["ref"]) && $data["Recommend"] == 0 || empty($_GET["ref"])) { ?>
                                        $("#toggle-recommend").click();
                                    <?php } ?>
                                </script>
                            </div>

                            <div class="product-bestseller-container">
                                <br />
                                <span><b>สินค้าขายดี</b></span>
                                <hr style="margin-top: 5px; margin-bottom: 5px;" />

                                <div>
                                    <i id="toggle-hot" class="fa fa-toggle-on fa-3x text-primary hand" style="" onclick="toggleHot(this);"></i>
                                    <input type="checkbox" name="choHot" class="hide" checked="checked" value="" />
                                </div>
                                <script>
                                    function toggleHot(obj) {
                                        $(obj).toggleClass('fa-toggle-on').toggleClass('fa-toggle-off')
                                            .toggleClass('text-primary')
                                            .toggleClass('text-danger').next().click();
                                    }
                                    <?php if (!empty($_GET["ref"]) && $data["Hot"] == 0 || empty($_GET["ref"])) { ?>
                                        $("#toggle-hot").click();
                                    <?php } ?>
                                </script>
                            </div>

                            <div class="product-ranking-container">
                                <br />
                                <span><b>Most Popular Ranking</b></span>
                                <hr style="margin-top: 5px; margin-bottom: 5px;" />

                                <style>
                                    .star-panel .gold,
                                    .star-panel:hover .fa-star {
                                        color: gold;
                                    }

                                    .star-panel .grey,
                                    .star-panel .fa-star:hover~.fa-star {
                                        color: #aaa;
                                    }
                                </style>

                                <?php $rank = empty($data["Rank"]) ? 3 : intval($data["Rank"]); ?>

                                <div class="star-panel">
                                    <i class="fa fa-2x fa-star hand <?php echo $rank >= 1 ? "gold" : "grey" ?>" data-rank="1"></i>
                                    <i class="fa fa-2x fa-star hand <?php echo $rank >= 2 ? "gold" : "grey" ?>" data-rank="2"></i>
                                    <i class="fa fa-2x fa-star hand <?php echo $rank >= 3 ? "gold" : "grey" ?>" data-rank="3"></i>
                                    <i class="fa fa-2x fa-star hand <?php echo $rank >= 4 ? "gold" : "grey" ?>" data-rank="4"></i>
                                    <i class="fa fa-2x fa-star hand <?php echo $rank >= 5 ? "gold" : "grey" ?>" data-rank="5"></i>
                                </div>
                                <script>
                                    $(".star-panel .fa-star").click(function() {
                                        $("#txtRank").val($(this).attr("data-rank"));
                                        $(this).removeClass("grey").removeClass("gold").addClass("gold");
                                        $(this).prevAll().removeClass("grey").removeClass("gold").addClass("gold");
                                        $(this).nextAll().removeClass("grey").removeClass("gold").addClass("grey");
                                    });
                                </script>

                                <input type="hidden" id="txtRank" name="txtRank" value="<?php echo $rank ?>" />

                            </div>

                            <div class="product-file-container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <br />
                                        <div class="slide-banner h-auto">
                                            <span><b> ไฟล์ดาวน์โหลด </b></span>
                                            <hr style="margin-top: 5px; margin-bottom: 5px;" />

                                            <input type="file" name="txtFileUpload" value="" accept="application/msword, application/vnd.ms-excel, application/pdf, image/*" onchange="validateUploadFileUpload(this);$(this).closest('.slide-banner').find('.remover').removeClass('hide');" />

                                            <?php if (!empty($data["FileDownload"])) { ?>
                                                <div class="file-display" style="margin-top:5px;">
                                                    <b class="text-success">เคยอัพโหลดไฟล์แล้ว
                                                        <a target="_blank" href="<?php echo $data["FileDownload"]; ?>">
                                                            <i class="fa fa-download"></i>
                                                            ดาวน์โหลด</a>
                                                    </b>
                                                </div>
                                            <?php } ?>
                                            <input type="hidden" name="hddBackUpFileDownload" value="<?php echo $data["FileDownload"] ?>" />
                                            <input type="hidden" name="hddBackUpFileDownloadName" value="<?php echo $data["FileDownloadName"] ?>" />
                                            <i class="fa fa-trash remover <?php echo empty($data["FileDownload"]) ? "hide" : "" ?>" onclick="deletefile(this);"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="product-file-container hide">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <br />
                                        <div class="slide-banner h-auto">
                                            <span><b> ไฟล์ดาวน์โหลด 2</b></span>
                                            <hr style="margin-top: 5px; margin-bottom: 5px;" />

                                            <input type="file" name="txtFileUpload2" value="" accept="application/msword, application/vnd.ms-excel, application/pdf, image/*" onchange="validateUploadFileUpload(this);$(this).closest('.slide-banner').find('.remover').removeClass('hide')" />

                                            <?php if (!empty($data["FileDownload2"])) { ?>
                                                <div class="file-display" style="margin-top:5px;">
                                                    <b class="text-success">เคยอัพโหลดไฟล์แล้ว
                                                        <a target="_blank" href="<?php echo $data["FileDownload2"]; ?>">
                                                            <i class="fa fa-download"></i>
                                                            ดาวน์โหลด</a>
                                                    </b>
                                                </div>
                                            <?php } ?>
                                            <input type="hidden" name="hddBackUpFileDownload2" value="<?php echo $data["FileDownload2"] ?>" />
                                            <input type="hidden" name="hddBackUpFileDownloadName2" value="<?php echo $data["FileDownloadName2"] ?>" />
                                            <i class="fa fa-trash remover <?php echo empty($data["FileDownload2"]) ? "hide" : "" ?>" onclick="deletefile(this);"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="product-file-container hide">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <br />
                                        <div class="slide-banner h-auto">
                                            <span><b>ไฟล์ให้ดาวน์โหลด 3</b></span>
                                            <hr style="margin-top: 5px; margin-bottom: 5px;" />

                                            <input type="file" name="txtFileUpload3" value="" accept=".pdf" onchange="validateUploadFileUpload(this);" />

                                            <?php if (!empty($data["FileDownload3"])) { ?>
                                                <div class="file-display" style="margin-top:5px;">
                                                    <b class="text-success">เคยอัพโหลดไฟล์แล้ว
                                                        <a target="_blank" href="<?php echo $data["FileDownload3"]; ?>">
                                                            <i class="fa fa-download"></i>
                                                            ดาวน์โหลด</a>
                                                    </b>
                                                </div>
                                            <?php } ?>
                                            <input type="hidden" name="hddBackUpFileDownload3" value="<?php echo $data["FileDownload3"] ?>" />
                                            <input type="hidden" name="hddBackUpFileDownloadName3" value="<?php echo $data["FileDownloadName3"] ?>" />
                                            <i class="fa fa-trash remover <?php echo empty($data["FileDownload3"]) ? "hide" : "" ?>" onclick="deletefile(this);"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                function validateUploadFileUpload(obj) {
                                    var file = $(obj).get(0).files[0];
                                    var maxSize = 60000000;
                                    if (file.size > maxSize) {
                                        $(obj).val("");
                                        swal("Invalid file size", "Maximum image size is 60 MB.", "error");
                                    }
                                }
                            </script>

                            <div class="row hide" style="display:flex;align-items:center;">
                                <div class="col-sm-12">
                                    <label>ที่อยู่บน Google map</label>
                                    <div class="input-group">
                                        <input id="mapinsert" type="text" class="form-control" name="txtLatLng" placeholder="https://www.google.com/maps/embed?pb=..." value="<?php echo $data["MapLocation"] ?>" />
                                        <span class="input-group-addon hand">
                                            <i class="fa fa-refresh"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div id="mapcheck" class="col-12 hide">
                                <?php if (!empty($data["MapLocation"])) { ?>
                                    <iframe src="https://www.google.com/maps/embed?pb=<?php echo $data["MapLocation"]; ?>" width="100%" height="450" style="border:0"></iframe>
                                <?php } ?>
                            </div>
                            <script>
                                $("#mapinsert").change(function(e) {
                                    $("#mapcheck").html($(this).val());
                                    var url = new URL($("#mapcheck").children("iframe").attr("src"));
                                    var urlparams = url.searchParams;
                                    $(this).val(urlparams.getAll("pb"));
                                });
                            </script>

                        </div>
                    </div>
                </div>

                <hr />

                <div>

                    <button type="submit" name="btnSubmit" class="btn btn-success" onclick="return validateSave(this);">
                        <i class="fa fa-save"></i>
                        บันทึก
                    </button>

                    <script>
                        function validateSave(sender) {
                            var msg = [];
                            var elt = $('#form-product').find(".require:visible");
                            $(elt).each(function() {
                                if ($(this).val().trim() == "") {
                                    var html = $(this).parent().find("label").html();
                                    msg.push(html);
                                }
                            });
                            // if ($(".product-color-container").is(":visible") && $(".chk-tag:checked").length == 0) {
                            //     msg.push("เลือกสีอย่างน้อย 1 รายการ");
                            // }
                            // if ($(".product-size-container").is(":visible") && $(".chk-size:checked").length == 0) {
                            //     msg.push("เลือกไซส์ที่มี อย่างน้อย 1 รายการ");
                            // }

                            // if ($(".product-material-container").is(":visible") && $(".chk-material:checked").length == 0) {
                            //     msg.push("เลือก Material อย่างน้อย 1 รายการ");
                            // }

                            // if ($(".product-tag-container").is(":visible") && $(".chk-tag-keyword:checked").length == 0) {
                            //     msg.push("เลือกแท็กอย่างน้อย 1 รายการ");
                            // }
                            if (msg.length > 0) {
                                swal('Please fill in all required fields.', msg.join("\n").split(":").join(""), 'warning');
                                return false;
                            }

                            return Confirm(sender, "Comfirm to continue");
                        }
                    </script>

                    <a href="product.php" class="btn btn-danger">
                        <i class="fa fa-remove"></i>
                        ยกเลิก
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

<table class="hide">
    <tr class="tmp">
        <th>
            <label class="hide">หัวข้อ</label>
            <input type="text" placeholder="หัวข้อ..." name="txtPropNameUni[]" class="form-control input-sm require">
        </th>
        <td class="">
            <label class="hide">คำอธิบาย</label>
            <input type="text" placeholder="คำอธิบาย..." name="txtPropDetailUni[]" class="form-control input-sm require">
        </td>
        <td class="text-center">
            <a href="javascript:;" onclick="$(this).closest('tr').remove();">
                <i class="fa fa-trash"></i>
            </a>
        </td>
    </tr>
</table>

<script>
    function deletefile(obj) {
        if (AlertConfirm(obj, "Confirm ?")) {
            var target = $(obj).closest('.slide-banner');
            $(target).find("input[type='file']").val("");
            $(target).find("input[type='hidden']").val("");
            $(target).find(".file-display").addClass("hide");
            $(target).find(".remover").addClass("hide");
        }
    }
</script>

<?php include  "../footer.php"; ?>