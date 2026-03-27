<?php include_once  "_config.php"; ?>
<?php //include_once  "../_master/_master_itemDetail.php"; ?>

<?php include_once  "../_master/_master.php"; ?>
<?php
$_Is_EditMode = !empty($_GET["ref"]);
$portCode = $_Is_EditMode ? $_GET["ref"] : GenerateNextID("portfolio","PortCode",5,"S");

if(isset($_POST["btnSubmit"])){
    echo "<p>btnSubmit</p>";
    $txtSubject = $_POST["txtSubject"];
    $txtDetail = $_COG_ALLOW_HTML_EDITOR ? GeneratePageFile($_POST["txtDetail"],$_COG_ITEM_CODE."-".$portCode) : "";
    $txtDetail2 = $_COG_ALLOW_HTML_EDITOR2 ? GeneratePageFile($_POST["txtDetailHTML2"],$_COG_ITEM_CODE."-".$portCode."2") : "";
    $txtDetail3 = $_COG_ALLOW_HTML_EDITOR3 ? GeneratePageFile($_POST["txtDetailHTML3"],$_COG_ITEM_CODE."-".$portCode."3") : "";
    
    $txtByName = $_POST["txtByName"];
    $txtClient = $_POST["txtClient"];
    $txtSEOTitle = $_POST["txtSEOTitle"];
    $txtSEODesc = $_POST["txtSEODesc"];
    $txtSEOKeyword = $_POST["txtSEOKeyword"];
    $chkActive = isset($_POST["chkActive"]) ? 1 : 0;
    $txtShortDescription = $_POST["txtShortDescription"];
    $ddlCattegory = $_POST["ddlCattegory"];
    $ddlSubCategory = $_POST["ddlSubCategory"];
    $uploadFileTarget =  $GLOBALS["ROOT"]."/_content_images/".GetCurrentLang()."/".strtolower($_COG_ITEM_CODE)."/";
    $uploadFileTarget2 =  $GLOBALS["ROOT"]."/_content_images/".GetCurrentLang()."/".strtolower($_COG_ITEM_CODE)."/image2/";
    $uploadFileTarget3 = $GLOBALS["ROOT"]."/_content_images/".GetCurrentLang()."/".strtolower($_COG_ITEM_CODE)."/image3/";
    $uploadFileTargetDetail =  $GLOBALS["ROOT"]."/_content_images/".GetCurrentLang()."/".strtolower($_COG_ITEM_CODE)."/fileupload/";
    $uploadFileTargetDetail2 =  $GLOBALS["ROOT"]."/_content_images/".GetCurrentLang()."/".strtolower($_COG_ITEM_CODE)."/fileupload2/";
    
    $fileUploaded = $_FILES["fileUpload"];
    $fileUploadLogo = $_FILES["fileUploadLogo"];
    $fileUploaded3 = $_FILES["fileUpload3"];
    $fileUploadDetail = $_FILES["txtFileUpload"];
    $fileUploadDetail2 = $_FILES["txtFileUpload2"];
    $hddFilePathVedio = $_POST["hddFilePathVedio"];
    $txtLinkWeb = $_POST["txtLinkWeb"];
    $txtShortDetial2 = $_POST["txtShortDetial2"];
    $txtEmail = $_POST["txtEmail"];
    $txtTelephone = $_POST["txtTelephone"];
    $txtFax = $_POST["txtFax"];
    $txtAddress = $_POST["txtAddress"];
    $txtLatLng = $_POST["txtLatLng"];
    $txtFacebook = $_POST["txtFacebook"];
    $txtIG = $_POST["txtIG"];
    $txtTwitter = $_POST["txtTwitter"];
    $txtYoutube = $_POST["txtYoutube"];
    $txtGoogleplus = $_POST["txtGoogleplus"];
    $txtLinkedin = $_POST["txtLinkedin"];
    $hddBackUpIcon = $_POST["hddBackUpIcon"];
    $txtRank = intval($_POST["txtRank"]);
    $choNew = isset($_POST["choNew"]) ? 1 : 0;
    
    $txtDateTimeType = !empty($_POST["txtDateTime"]) ? new DateTime(ConvertDateTimeDisplayToDateTimeDB($_POST["txtDateTime"])." 00:00:00.000000") : new DateTime();
    $txtDataTime = $txtDateTimeType->format('Y-m-d H:i:s');

    $txtYear = $_POST["txtYear"];
    $txtHour = $_POST["txtHour"];
    $txtProject = $_POST["txtProject"];
    $txtStatus = $_POST["txtStatus"];
    $txtAmount = doubleval(str_replace(",","",$_POST["txtAmount"]));
    

    if(!empty($fileUploaded["name"])){
        $fileUploadedPath = $uploadFileTarget.UploadFile($_FILES["fileUpload"],$uploadFileTarget,$portCode);
    }else{
        $fileUploadedPath = $_POST["hddBackUpImage"];
    }
    if(!empty($fileUploadLogo["name"])){
        $fileUploadedPathLogo = $uploadFileTarget2.UploadFile($_FILES["fileUploadLogo"],$uploadFileTarget2,$portCode);
    }else{
        $fileUploadedPathLogo = $_POST["hddBackUpImageLogo"];
    }
    if(!empty($fileUploaded3["name"])){
        $fileUploadedPath3 = $uploadFileTarget3.UploadFile($_FILES["fileUpload3"],$uploadFileTarget3,$portCode);
    }else{
        $fileUploadedPath3 = $_POST["hddBackUpImage3"];
    }
    if(!empty($fileUploadDetail["name"])){
        $fileUploadedPathDetail = $uploadFileTargetDetail.UploadFile2($_FILES["txtFileUpload"],$uploadFileTargetDetail,$fileUploadDetail["name"]);
        $fileNameUpdate = REP_SG($fileUploadDetail["name"]);
    }else{
        $fileUploadedPathDetail = $_POST["hddBackUpFileDownload"];
        $fileNameUpdate = REP_SG($_POST["hddBackUpFileDownloadName"]);
    }
    if(!empty($fileUploadDetail2["name"])){
        $fileUploadedPathDetail2 = $uploadFileTargetDetail2.UploadFile($_FILES["txtFileUpload2"],$uploadFileTargetDetail2,$portCode);
        $fileNameUpdate2 = REP_SG($fileUploadDetail2["name"]);
    }else{
        $fileUploadedPathDetail2 = $_POST["hddBackUpFileDownload2"];
        $fileNameUpdate2 = REP_SG($_POST["hddBackUpFileDownloadName2"]);
    }

    $allTag = "";
    $chkTag =  $_POST["chkTag"];
    for ($i = 0; $i < countval($chkTag); $i++)
    {
        $tg = $chkTag[$i];
        if(isset($tg)){
    	    if(!empty($allTag)){
                $allTag .=",";
            }
            $allTag .= $tg;
        }
    }

    $allItemSelected = "";
    $chkItemSelected = $_POST["chkItemSelected"];
    for ($i = 0; $i < countval($chkItemSelected); $i++)
    {
        $select = $chkItemSelected[$i];
        if(isset($select)){
    	    if(!empty($allItemSelected)){
                $allItemSelected .=",";
            }
            $allItemSelected .= $select;
        }
    }

    if($_Is_EditMode)
    {
        $cuurentDateTime = GetCurrentStringDateTimeServer();
        if(!empty($fileUploadedPath))
        {
            $fileUploadedPath = parse_url( $fileUploadedPath, PHP_URL_PATH)."?vs=".$cuurentDateTime;
        }
        if(!empty($fileUploadedPathLogo))
        {
            $fileUploadedPathLogo = parse_url( $fileUploadedPathLogo, PHP_URL_PATH)."?vs=".$cuurentDateTime;
        }
        if(!empty($fileUploadedPath3))
        {
            $fileUploadedPath3 = parse_url( $fileUploadedPath3, PHP_URL_PATH)."?vs=".$cuurentDateTime;
        }

        if(!empty($fileUploadedPathDetail))
        {
            $fileUploadedPathDetail = parse_url( $fileUploadedPathDetail, PHP_URL_PATH)."?vs=".$cuurentDateTime;
        }
        if(!empty($fileUploadedPathDetail2))
        {
            $fileUploadedPathDetail2 = parse_url( $fileUploadedPathDetail2, PHP_URL_PATH)."?vs=".$cuurentDateTime;
        }

        $sqlUpdate = "update portfolio set 
                     PortName = :PortName
                    ,PortDetail = :PortDetail
                    ,PortHtml2 = :PortHtml2
                    ,PortHtml3 = :PortHtml3
                    ,ShortDescription = :ShortDescription
                    ,Image = :Image1
                    ,Image2 = :Image2
                    ,Image3 = :Image3
                    ,ImageIcon = :ImageIcon
                    ,Video = :Video
                    ,FileDownload = :FileDownload1
                    ,FileDownloadName = :FileDownloadName
                    ,FileDownload2 = :FileDownload2
                    ,FileDownloadName2 = :FileDownloadName2
                    ,ByName = :ByName
                    ,Client = :Client
                    ,Title = :Title
                    ,Description = :Description
                    ,Keyword = :Keyword
                    ,Tag = :Tag
                    ,ItemSelected = :ItemSelected
                    ,Active = :Active
                    ,UpdatedOn = NOW()
                    ,UpdatedBy = :UpdatedBy
                    ,CategoryCode = :CategoryCode
                    ,SubCategoryCode = :SubCategoryCode
                    ,PortDetail1 = :PortDetail1
                    ,PortDetail2 = :PortDetail2
                    ,Email = :Email
                    ,Phone = :Phone
                    ,Fax = :Fax
                    ,Address = :Address
                    ,MapLocation = :MapLocation
                    ,Facebook = :Facebook
                    ,IG = :IG
                    ,Twitter = :Twitter
                    ,Youtube = :Youtube
                    ,Googleplus = :Googleplus
                    ,Whatsapp = :Whatsapp
                    ,Linkedin = :Linkedin
                    ,PortDateTime = :PortDateTime
                    ,New = :New
                    ,Year = :Year
                    ,Hour = :Hour
                    ,Project = :Project
                    ,Status = :Status
                    ,Amount = :Amount
                    ,Rank = :Rank
                    where PortCode = :PortCode
        ";
        ExecuteSQL($sqlUpdate, array(
                     'PortName' => $txtSubject
                    ,'PortDetail' => $txtDetail
                    ,'PortHtml2' => $txtDetail2
                    ,'PortHtml3' => $txtDetail3
                    ,'ShortDescription' => $txtShortDescription
                    ,'Image1' => $fileUploadedPath
                    ,'Image2' => $fileUploadedPathLogo
                    ,'Image3' => $fileUploadedPath3
                    ,'ImageIcon' => $hddBackUpIcon
                    ,'Video' => $hddFilePathVedio
                    ,'FileDownload1' => $fileUploadedPathDetail
                    ,'FileDownloadName' => $fileNameUpdate
                    ,'FileDownload2' => $fileUploadedPathDetail2
                    ,'FileDownloadName2'=> $fileNameUpdate2
                    ,'ByName' => $txtByName
                    ,'Client' => $txtClient
                    ,'Title' => $txtSEOTitle
                    ,'Description' => $txtSEODesc
                    ,'Keyword' => $txtSEOKeyword
                    ,'Tag' => $allTag
                    ,'ItemSelected' => $allItemSelected
                    ,'Active' => $chkActive
                    ,'UpdatedBy' => UserService::UserCode()
                    ,'CategoryCode' => $ddlCattegory
                    ,'SubCategoryCode' => $ddlSubCategory
                    ,'PortDetail1' => $txtLinkWeb
                    ,'PortDetail2' => $txtShortDetial2
                    ,'Email' => $txtEmail
                    ,'Phone' => $txtTelephone
                    ,'Fax' => $txtFax
                    ,'Address' => $txtAddress
                    ,'MapLocation' => $txtLatLng
                    ,'Facebook' => $txtFacebook
                    ,'IG' => $txtIG
                    ,'Twitter' => $txtTwitter
                    ,'Youtube' => $txtYoutube
                    ,'Googleplus' => $txtGoogleplus
                    ,'Whatsapp' => $txtWhatsapp
                    ,'Linkedin' => $txtLinkedin
                    ,'PortDateTime' => $txtDataTime
                    ,'New' => $choNew
                    ,'Year' => $txtYear
                    ,'Hour' => $txtHour
                    ,'Project' => $txtProject
                    ,'Status' => $txtStatus
                    ,'Amount' => $txtAmount
                    ,'Rank' => $txtRank
                    ,'PortCode' => $portCode
        ));
    }
    else
    {
        $sqlInsert = "insert into portfolio (PortCode,PortName,ShortDescription,PortDetail,PortHtml2,PortHtml3,Image,Image2,Image3,ImageIcon,Video,FileDownload,FileDownloadName,FileDownload2,FileDownloadName2,ByName,Client,Title,
                        Description,Keyword,Tag,ItemSelected,Active,CreatedOn,CreatedBy,PortType,CategoryCode,SubCategoryCode,PortDetail1,PortDetail2,
                        Email,Phone,Fax,Address,MapLocation,Facebook,IG,Twitter,Youtube,Googleplus,Whatsapp,Linkedin,PortDateTime,New,Year,Hour,Project,Status,Amount,Rank)
                    VALUES(
                        :portCode,
                        :Subject,
                        :ShortDescription,
                        :Detail1,
                        :Detail2,
                        :Detail3,
                        :UploadedPath1,
                        :UploadedPathLogo,
                        :UploadedPath3,
                        :BackUpIcon,
                        :FilePathVedio,
                        :fileUploadedPathDetail,
                        :fileNameUpdate1,
                        :fileUploadedPathDetail2,
                        :fileNameUpdate2,
                        :ByName,
                        :Client,
                        :SEOTitle,
                        :SEODesc,
                        :SEOKeyword,
                        :Tag,
                        :ItemSelected,
                        :Active,
                        NOW(),
                        :CreatedBy,
                        :PortType,
                        :Category,
                        :SubCategory2,
                        :LinkWeb,
                        :ShortDetial2,
                        :Email,
                        :Telephone,
                        :Fax,
                        :Address,
                        :LatLng,
                        :Facebook,
                        :IG,
                        :Twitter,
                        :Youtube,
                        :Googleplus,
                        :Whatsapp,
                        :Linkedin,
                        :DataTime,
                        :New,
                        :Year,
                        :Hour,
                        :Project,
                        :Status,
                        :Amount,
                        :Rank
                    );";
        ExecuteSQL($sqlInsert, array(
            'portCode' => $portCode,
            'Subject' => $txtSubject,
            'ShortDescription' => $txtShortDescription,
            'Detail1' => $txtDetail,
            'Detail2' => $txtDetail2,
            'Detail3' => $txtDetail3,
            'UploadedPath1' => $fileUploadedPath,
            'UploadedPathLogo' => $fileUploadedPathLogo,
            'UploadedPath3' => $fileUploadedPath3,
            'BackUpIcon' => $hddBackUpIcon,
            'FilePathVedio' => $hddFilePathVedio,
            'fileUploadedPathDetail' => $fileUploadedPathDetail,
            'fileNameUpdate1' => $fileNameUpdate,
            'fileUploadedPathDetail2' => $fileUploadedPathDetail2,
            'fileNameUpdate2' => $fileNameUpdate2,
            'ByName' => $txtByName,
            'Client' => $txtClient,
            'SEOTitle' => $txtSEOTitle,
            'SEODesc' => $txtSEODesc,
            'SEOKeyword' => $txtSEOKeyword,
            'Tag' => $allTag,
            'ItemSelected' => $allItemSelected,
            'Active' => $chkActive,
            'CreatedBy' => UserService::UserCode(),
            'PortType' => $_COG_ITEM_CODE,
            'Category' => $ddlCattegory,
            'SubCategory2' => $ddlSubCategory,
            'LinkWeb' => $txtLinkWeb,
            'ShortDetial2' => $txtShortDetial2,
            'Email' => $txtEmail,
            'Telephone' => $txtTelephone,
            'Fax' => $txtFax,
            'Address' => $txtAddress,
            'LatLng' => $txtLatLng,
            'Facebook' => $txtFacebook,
            'IG' => $txtIG,
            'Twitter' => $txtTwitter,
            'Youtube' => $txtYoutube,
            'Googleplus' => $txtGoogleplus,
            'Whatsapp' => $txtWhatsapp,
            'Linkedin' => $txtLinkedin,
            'DataTime' => $txtDataTime,
            'New' => $choNew,
            'Year' => $txtYear,
            'Hour' => $txtHour,
            'Project' => $txtProject,
            'Status' => $txtStatus,
            'Amount' => $txtAmount,
            'Rank' => $txtRank
        ));
    }

    if($_COG_ALLOW_PROPERTIES){
        $arrSql = array();
        $values = array();
        $sqlDeleteColor = " delete from product_properties_mapping where ProductCode = :ProductCode ";
        if($_COG_PROPERTIES_OPTION){

            $chkPropDetail = $_POST["chkPropDetail"];
            for ($i = 0; $i < countval($chkPropDetail); $i++)
            {
                $tg = $chkPropDetail[$i];
                if(isset($tg)){

                    array_push($arrSql,"insert into product_properties_mapping (PropCode,ProductCode,Detail) values (:PropCode$i,:ProductCode$i,'1')");
                    $values["PropCode$i"] = $tg;
                    $values["ProductCode$i"] = $portCode;
                }
            }

        }else{
           
            $txtPropCode = $_POST["txtPropCode"];
            $txtPropDetail = $_POST["txtPropDetail"];
            for ($i = 0; $i < countval($txtPropCode); $i++)
            {
                $propCode = $txtPropCode[$i];
                $propDetail = trim($txtPropDetail[$i]);
                if(empty($propDetail))
                    continue;
                
                array_push($arrSql,"insert into product_properties_mapping (PropCode,ProductCode,Detail) values(:PropCode$i, :ProductCode$i, :Detail$i)");
                $values["PropCode$i"] = $propCode;
                $values["ProductCode$i"] = $portCode;
                $values["Detail$i"] = $propDetail;
            }
        }
        ExecuteSQL($sqlDeleteColor, array('ProductCode' => $portCode));
        if(countval($arrSql) > 0){
            ExecuteMultiSQL(join(";  ",$arrSql), $values);
        }
    }

    if ($_COG_ALLOW_MASTER_PROPERTIES) {
        $sqlDeleteColor = "delete from portfolio_properties where PortCode = :PortCode";
        ExecuteSQL($sqlDeleteColor, array('PortCode' => $portCode));
        $txtPropName = $_POST["txtPropNameUni"];
        for ($i = 0; $i < countval($txtPropName); $i++) {
            $propCode = str_pad(($i + 1), 3, '0', STR_PAD_LEFT);
            $propName = trim($txtPropName[$i]);
            $sqlInsertColor = "insert into portfolio_properties (PropCode,PortCode,Name)
                                    values(
                                    :PropCode,
                                    :PortCode,
                                    :Name
                                    );";
            ExecuteSQL($sqlInsertColor, array(
                'PropCode' => $propCode,
                'PortCode' => $portCode,
                'Name' => $propName
            ));
        }
    }

    GenerateHTAccess();
    Redirect("item.php");
    exit();
}

function REP_SG($input){
    return str_replace("'","’",$input);
}

if($_Is_EditMode){
    $sqlPrd = "select * from portfolio where PortCode = :PortCode";
    $data = SelectRow($sqlPrd, array('PortCode' => $portCode));
}
?>

<style>
    .slide-banner.h-auto {
        width: 100%;
        height: auto!important;
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

<div class="mat-box grey-bar">
    <a href="item.php" class="link-history-btn">หน้าหลัก<?php echo $_COG_ITEM_NAME ?></a>
    /
    <a href="item.php" class="link-history-btn">รายการ<?php echo $_COG_ITEM_NAME ?></a>
    /
    <span class="link-history-btn">จัดการข้อมูล<?php echo $_COG_ITEM_NAME ?></span>
</div>
<div class="mat-box" style="border-radius: 0 0 3px 3px">
    <form id="form-product" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="<?php echo $_COG_ALLOW_TEXT_FULL_PAGE ? "col-md-12" : "col-md-9"  ?>">
                        <div>
                            <span><b><?php echo !$_Is_EditMode ? "เพิ่มข้อมูล" : "แก้ไขข้อมูล <i class='text-primary'>".$data["PortName"]."</i>" ?></b></span>
                            <hr style="margin-top: 5px;" />
                        </div>
                        <?php if($_COG_ALLOW_TITLE){ ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>หัวข้อ<?php echo $_COG_ITEM_NAME ?></label>
                                <input type="text" placeholder="หัวข้อ<?php echo $_COG_ITEM_NAME ?>..." name="txtSubject" id="txtSubject" value='<?php echo $data["PortName"] ?>' class="form-control input-sm require" />
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($_COG_ALLOW_CATEGORY){ ?>
                        <div class="row">
                            <?php 
                                $_COL = 12;
                                if($_COG_ALLOW_CATEGORY_SUB && $_COG_ALLOW_CATEGORY_SUB3)
                                {
                                    $_COL = "4";
                                }else if ($_COG_ALLOW_CATEGORY_SUB){
                                    $_COL = "6";
                                }
                            ?>
                            <div class="col-sm-<?php echo $_COL ?>">
                                <label>หมวดหมู่</label>
                                <select name="ddlCattegory" class="form-control input-sm require" <?php echo $_COG_ALLOW_CATEGORY_SUB ? ' onchange="loadSubCategory(this.value);" ' : ""  ?>>
                                    <option value="">เลือก</option>
                                        <?php
                                        $sqlCate = "select * from product_category b
                                                where b.Active = 1 AND CategoryGroup = :CategoryGroup order by b.CategoryName";
                                        $datasCate = SelectRows($sqlCate, array('CategoryGroup' =>  $_COG_ITEM_CODE));
                                        $cIndex = 0;
                                        foreach ($datasCate as $dataCate) {
                                        ?>
                                            <option value="<?php echo $dataCate["CategoryCode"] ?>" <?php echo $data["CategoryCode"] == $dataCate["CategoryCode"] ? 'selected="selected"' : '' ?>><?php echo $dataCate["CategoryName"] ?></option>
                                        <?php } ?>
                                </select>
                            </div>
                            <?php if($_COG_ALLOW_CATEGORY_SUB){ ?>
                            <div class="col-sm-<?php echo $_COL ?>">
                                <label>หมวดหมู่ย่อย 2</label>
                                <select name="ddlSubCategory" id="ddlSubCategory" class="form-control input-sm require" <?php echo $_COG_ALLOW_CATEGORY_SUB ? ' onchange="loadSubCategory3(this.value);" ' : ""  ?>>
                                    <option value="">ไม่ระบุ</option>
                                </select>
                            </div>
                            <script>
                                function loadSubCategory(cateCode, setValue) {
                                    $("#ddlSubCategory").load("../_master/_load_itemSubCategoryLoadData.php?ref=" + cateCode, function () {
                                        if (setValue != undefined) {
                                            $("#ddlSubCategory").val(setValue);
                                        }
                                    });
                                }
                                <?php if(!empty($data["PortCode"])){ ?>

                                loadSubCategory('<?php echo $data["CategoryCode"] ?>', '<?php echo $data["SubCategoryCode"] ?>');

                                <?php } ?>
                            </script>
                            <?php } ?>

                            <?php if($_COG_ALLOW_CATEGORY_SUB3){ ?>
                            <div class="col-sm-<?php echo $_COL ?>">
                                <label>หมวดหมู่ย่อย 3</label>
                                <select name="ddlSubCategory3" id="ddlSubCategory3" class="form-control input-sm require">
                                    <option value="">ไม่ระบุ</option>
                                </select>
                            </div>
                            <script>
                                function loadSubCategory3(cateCode, setValue) {
                                    $("#ddlSubCategory3").load("../_master/_load_itemSubCategoryLoadData3.php?ref=" + cateCode, function () {
                                        if (setValue != undefined) {
                                            $("#ddlSubCategory3").val(setValue);
                                        }
                                    });
                                }
                                <?php if(!empty($data["PortCode"])){ ?>

                                    loadSubCategory3('<?php echo $data["SubCategoryCode"] ?>', '<?php echo $data["SubCategoryCode3"] ?>');

                                <?php } ?>
                            </script>
                            <?php } ?>
                        </div>
                        <?php } ?>
                        <?php if($_COG_ALLOW_SHORT_DESCRIPTION){ ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>รายละเอียดแบบย่อ</label>
                                <textarea name="txtShortDescription" id="txtShortDescription" class="form-control input-sm require"><?php echo $data["ShortDescription"] ?></textarea>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($_COG_ALLOW_AUTHOR){ ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>ชื่อผู้เขียน (ชื่อที่ใช้แสดง)</label>
                                <input type="text" placeholder="โดย..." name="txtByName" id="txtByName" value="<?php echo  empty($data["ByName"]) ? UserService::UserFullName() : $data["ByName"] ?>" class="form-control input-sm require" />
                            </div>
                        </div>
                         <?php } ?>

                         <?php if($_COG_ALLOW_HTML_DETAIL || $_COG_ALLOW_AMOUNT){ ?>
                        <div class="row">
                            <?php if($_COG_ALLOW_HTML_DETAIL){ ?>
                            <div class="col-sm-6">
                                <label>ประเภทงาน<?php echo $_COG_ITEM_NAME ?></label>
                                <input type="text" placeholder="ประเภทงาน..." name="txtShortDetial2" id="txtShortDetial2" value="<?php echo  $data["PortDetail2"] ?>" class="form-control input-sm" />
                            </div>
                            <?php } ?>
                            <?php if($_COG_ALLOW_AMOUNT){ ?>
                            <div class="col-sm-4">
                                <label>จำนวน</label>
                                <input type="text" onkeypress='IsKeyNumber(event)' onchange="IsFormatNumber(this);" placeholder="จำนวน..." name="txtAmount" id="txtAmount" value="<?php echo number_format($data["Amount"],(isset($_COG_ALLOW_AMOUNT_DECIMAL) ? $_COG_ALLOW_AMOUNT_DECIMAL : 0)) ?>"  class="form-control input-sm text-right require" />
                            </div>
                            <?php } ?>
                            
                        </div>
                        <?php } ?>

                        <?php if($_COG_ALLOW_HTML_LINK){ ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>ลิ้งเว็บ</label>
                                <input type="text" placeholder="ลิ้งเว็บ..." name="txtLinkWeb" id="txtLinkWeb" value="<?php echo  $data["PortDetail1"] ?>" class="form-control input-sm" />
                            </div>
                        </div>
                         <?php } ?>

                        <?php if($_COG_ALLOW_HTML_PHONE){ ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>เบอร์โทร<?php echo $_COG_ITEM_NAME ?></label>
                                <input type="text" placeholder="เบอร์โทร..." name="txtTelephone" id="txtTelephone" value="<?php echo  $data["Phone"] ?>" class="form-control input-sm require" />
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($_COG_ALLOW_HTML_FAX){ ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>แฟ็กซ์<?php echo $_COG_ITEM_NAME ?></label>
                                <input type="text" placeholder="แฟ็กซ์..." name="txtFax" id="txtFax" value="<?php echo  $data["Fax"] ?>" class="form-control input-sm require" />
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($_COG_ALLOW_HTML_EMAIL){ ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>อีเมลล์<?php echo $_COG_ITEM_NAME ?></label>
                                <input type="text" placeholder="อีเมลล์..." name="txtEmail" id="txtEmail" value="<?php echo  $data["Email"] ?>" class="form-control input-sm require" />
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($_COG_ALLOW_HTML_ADDRESS){ ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>ที่อยู่<?php echo $_COG_ITEM_NAME ?></label>
                                <textarea name="txtAddress" id="txtAddress" class="form-control input-sm require"><?php echo $data["Address"] ?></textarea>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if($_COG_ALLOW_REF_CISTOMER){ ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>ชื่อลูกค้า</label>
                                <input type="text" placeholder="ชื่อลูกค้า..." name="txtClient" id="txtClient" value="<?php echo  $data["Client"] ?>" class="form-control input-sm" />
                            </div>
                        </div>
                        <?php } ?>

                        <?php if($_COG_ALLOW_DATE){ ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>วันที่</label>
                                <div class="input-group">
                                    <input name="txtDateTime" type="text" placeholder="วันที่..."
                                        class="form-control date-picker require" autocomplete="off"
                                        value="<?php echo ConvertDateDBToDateDisplay($data["PortDateTime"]); ?>" />
                                    <span class="input-group-addon hand">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if($_COG_ALLOW_PROJECT){ ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>ชื่อโครงการ</label>
                                    <input type="text" placeholder="ชื่อโครงการ..." name="txtProject" id="txtProject" value="<?php echo  $data["Project"] ?>" class="form-control input-sm require" />
                                </div>
                            </div>
                        <?php } ?>

                        <?php if($_COG_ALLOW_YEAR || $_COG_ALLOW_HOUR){ ?>
                            <div class="row">
                                <?php if($_COG_ALLOW_YEAR){ ?>
                                <div class="col-sm-4">
                                    <label>ปี</label>
                                    <input type="text" placeholder="ปี..." name="txtYear" id="txtYear" maxlength="50" value="<?php echo  $data["Year"] ?>" class="form-control input-sm require" />
                                </div>
                                <?php } ?>
                                <?php if($_COG_ALLOW_HOUR){ ?>
                                <div class="col-sm-4">
                                    <label>ชั่วโมงการทำงาน</label>
                                    <input type="text" placeholder="ชั่วโมงการทำงาน..." name="txtHour" id="txtHour" value="<?php echo  $data["Hour"] ?>" class="form-control input-sm require" />
                                </div>
                                <?php } ?>
                                <?php if($_COG_ALLOW_STATUS){ ?>
                                <div class="col-sm-4">
                                    <label>สถานะ</label>
                                    <input type="text" placeholder="สถานะ..." name="txtStatus" id="txtStatus" value="<?php echo  $data["Status"] ?>" class="form-control input-sm require" />
                                </div>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <?php if($_COG_ALLOW_MAIN_IMAGE3){ ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <span><b>รูปภาพแบรนเนอร์</b></span>
                                    <hr style="margin-top: 5px; margin-bottom: 5px;" />
                                    <p>
                                        <?php $image_size3 = !empty($_COG_ALLOW_MAIN_IMAGE_SIZE3) ? $_COG_ALLOW_MAIN_IMAGE_SIZE3 : "1200x900" ?>
                                        <small class="text-danger">*ขนาดภาพที่เหมาะสมที่สุดคือ <?php echo $image_size3 ?> pixels</small>
                                    </p>
                                    <img id="imge-preview3" style="background-color: #eae8e8;" src="<?php echo empty($data["Image3"]) ? "https://ipsumimage.appspot.com/1200x600,eee" : $data["Image3"] ?>" 
                                    class="img-responsive hand" onclick="$(this).next().click();"/>
                                    <input class="hide" type="file" onchange="$(this).validateUploadImage($('#imge-preview3'));"
                                        name="fileUpload3" id="fileUpload3" accept="image/*" />
                                    <input type="hidden" name="hddBackUpImage3" value="<?php echo $data["Image3"] ?>" />
                                    <div class="text-center">
                                        <small>คลิกด้านบนรูปเพื่อเลือกรูปภาพ</small>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if($_COG_REF_SELECT_ITEM){ ?>
                            <br>
                            <div>
                                <style>
                                    .img-selected{
                                        width: 25px;
                                        height: 25px;
                                        object-fit: cover;
                                        border-radius: 50%;
                                    }
                                </style>
                                <span><b><?php echo $_COG_REF_SELECT_ITEM_TITLE ?></b></span>
                                <hr style="margin-top: 5px; margin-bottom: 10px;" />
                                <div class="row">
                                    <?php
                                        $sqlitem = "select PortCode,PortName,Image FROM portfolio WHERE Active=1 and PortType= :PortType order by PortName ";
                                        $dataItem = SelectRowsArray($sqlitem, array('PortType' => $_COG_REF_SELECT_ITEM_CODE));
                                        foreach ($dataItem  as $item) {
                                        ?>
                                        <div class="col-sm-6" onclick="$(this).find('input').click();">
                                            <input onclick="event.stopPropagation();" class="chk-itemselected" type="checkbox" <?php echo strpos($data["ItemSelected"],$item["PortCode"]) !== false ? "checked" : "" ?> name="chkItemSelected[]" id="chk-<?php echo $item["PortCode"] ?>" value="<?php echo $item["PortCode"] ?>" />
                                            <?php if($_COG_REF_SELECT_ITEM_IMAGE){ ?>
                                                &nbsp;<img src="<?php echo $item["Image"] ?>" alt="item-<?php echo $item["PortCode"] ?>" class="img-selected">
                                            <?php } ?>
                                            <label onclick="event.stopPropagation();" for="chk-<?php echo $item["PortCode"] ?>" class="hand"><?php echo $item["PortName"] ?></label>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        
                        <?php if ($_COG_ALLOW_MASTER_PROPERTIES) { ?>
                            <div class="alert alert-success">
                                <h4 style="margin-bottom:10px"><b><?php echo !empty($_COG_ALLOW_MASTER_PROPERTIES_TITLE) ? $_COG_ALLOW_MASTER_PROPERTIES_TITLE : "ข้อมูลเฉพาะ" ?></b></h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-striped" style="background: #fff">
                                            <thead class="text-center" style="background: rgb(56 191 0);color:#fff">
                                                <tr>
                                                    <th >
                                                        หัวข้อ
                                                    </th>
                                                    <th style="width: 50px;"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sqlPropUnique = "select * from portfolio_properties where PortCode= :PortCode order by PropCode asc ";
                                                $datasProps = SelectRowsArray($sqlPropUnique, array('PortCode' => $data["PortCode"]));
                                                foreach ($datasProps as $propQ) {
                                                ?>
                                                    <tr>
                                                        <th>
                                                            <label class="hide">หัวข้อ</label>
                                                            <input type="text" placeholder="หัวข้อ..." name="txtPropNameUni[]" value="<?php echo $propQ["Name"] ?>" class="form-control input-sm require">
                                                        </th>
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


                        <!-- social media -->
                        <?php if($_COG_ALLOW_SOCIAL_MEDIA){ ?>
                            <br>
                            <style>
                            .panel-social-media .col-sm-6{
                                margin-bottom: 10px;
                            }
                            </style>
                            <div class="panel-social-media">
                                <span><b>ข้อมูลการติดต่อ</b></span>
                                <hr style="margin-top: 5px;" />
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>FaceBook</label>
                                        <input type="text" placeholder="Facebook..." name="txtFacebook" id="txtFacebook"
                                            value="<?php echo $data["Facebook"] ?>" class="form-control input-sm" />
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Twitter</label>
                                        <input type="text" placeholder="Twitter..." name="txtTwitter" id="txtTwitter"
                                            value="<?php echo $data["Twitter"] ?>" class="form-control input-sm" />
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Instagram</label>
                                        <input type="text" placeholder="IG..." name="txtIG" id="txtIG"
                                            value="<?php echo $data["IG"] ?>" class="form-control input-sm" />
                                    </div>
                                    <div class="col-md-6 hide">
                                        <label>Google plus</label>
                                        <input type="text" placeholder="Googleplus.." class="form-control"
                                            name="txtGoogleplus" value="<?php echo $data["Googleplus"] ?>" />
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Linkedin</label>
                                        <input type="text" placeholder="Linkedin..." name="txtLinkedin" id="txtLinkedin"
                                            value="<?php echo $data["Linkedin"] ?>" class="form-control input-sm" />
                                    </div>
                                    <div class="col-sm-6 hide">
                                        <label>Youtube</label>
                                        <input type="text" placeholder="Youtube..." name="txtYoutube" id="txtYoutube"
                                            value="<?php echo $data["Youtube"] ?>" class="form-control input-sm" />
                                    </div>

                                    <div class="col-sm-6 hide">
                                        <label>Whats app</label>
                                        <input type="text" placeholder="Whats app..." name="txtWhatsapp" id="txtWhatsapp"
                                            value="<?php echo $data["Whatsapp"] ?>" class="form-control input-sm" />
                                    </div>

                                </div>
                            </div>
                            <br>

                        <?php } ?>

                        <!-- end social media -->



                    </div>
                    <div class="<?php echo $_COG_ALLOW_TEXT_FULL_PAGE ? "col-md-5" : "col-md-3"  ?>">
                    <?php if($_COG_ALLOW_MAIN_IMAGE){ ?>
                        <div>
                            <span><b>รูปภาพหลัก</b></span>
                            <hr style="margin-top: 5px; margin-bottom: 5px;" />
                            <p>
                                <?php $image_size = !empty($_COG_ALLOW_MAIN_IMAGE_SIZE) ? $_COG_ALLOW_MAIN_IMAGE_SIZE : "1200x900" ?>
                                <small class="text-danger">*ขนาดภาพที่เหมาะสมที่สุดคือ <?php echo $image_size ?> pixels</small>
                            </p>
                            <img id="imge-preview" data-size="<?php echo $image_size ?>" style="background-color: #eae8e8;" src="<?php echo empty($data["Image"]) ? "https://ipsumimage.appspot.com/$image_size,eee" : $data["Image"] ?>" 
                            class="img-responsive hand" onclick="$(this).next().click();"/>
                            <input class="hide" type="file" onchange="$(this).validateUploadImage($('#imge-preview'));"
                                name="fileUpload" id="fileUpload" accept="image/*" />
                            <input type="hidden" name="hddBackUpImage" value="<?php echo $data["Image"] ?>" />
                            <div class="text-center">
                                <small>คลิกด้านบนรูปเพื่อเลือกรูปภาพ</small>
                            </div>
                        </div>
                    <?php } if($_COG_ALLOW_HTML_LOGO){ ?>
                        <br>
                        <div>
                            <span><b>รูปภาพรอง</b></span>
                            <hr style="margin-top: 5px; margin-bottom: 5px;" />
                            <p>
                                <?php $image_size2 = !empty($_COG_ALLOW_MAIN_IMAGE_SIZE2) ? $_COG_ALLOW_MAIN_IMAGE_SIZE2 : "1200x900" ?>
                                <small class="text-danger">*ขนาดภาพที่เหมาะสมที่สุดคือ <?php echo $image_size2 ?> pixels</small>
                            </p>
                            <img id="imge-preview-2" style="background-color: #eae8e8;" src="<?php echo empty($data["Image2"]) ? "https://ipsumimage.appspot.com/1200x900,eee" : $data["Image2"] ?>" 
                            class="img-responsive hand" onclick="$(this).next().click();"/>
                            <input class="hide" type="file" onchange="$(this).validateUploadImage($('#imge-preview-2'));"
                                name="fileUploadLogo" id="fileUploadLogo" accept="image/*" />
                            <input type="hidden" name="hddBackUpImageLogo" value="<?php echo $data["Image2"] ?>" />
                            <div class="text-center">
                                <small>คลิกด้านบนรูปเพื่อเลือกรูปภาพ</small>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if($_COG_ALLOW_MAIN_VIDEO){ ?>
                        <br>
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
                                                        <img src="../../video/assets/how-1.png" style="width:100%" />
                                                    </p>
                                                    <p>
                                                        3. คัดลอก URL ของวีดีโอ
                                                    </p>
                                                    <p>
                                                        <img src="../../video/assets/how-2.png" style="width:100%" />
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
                                                val = "https://www.youtube.com/embed/" + getUrlVars(val)["v"] //val.split("v=")[val.split("v=").length - 1];
                                            } else if (val.toLowerCase().match("youtu.be")) {
                                                val = "https://www.youtube.com/embed/" + val.split("/")[val.split("/").length - 1];
                                            }
                                            $(obj).prev().val(val);
                                            var frame = $(obj).closest(".modal").find(".iframe-video");
                                            frame.prop("src", val);
                                        }

                                        function getUrlVars(val)
                                        {
                                            var vars = [], hash;
                                            var hashes = val.slice(val.indexOf('?') + 1).split('&');
                                            for(var i = 0; i < hashes.length; i++)
                                            {
                                                hash = hashes[i].split('=');
                                                vars.push(hash[0]);
                                                vars[hash[0]] = hash[1];
                                            }
                                            return vars;
                                        }

                                        function confirmDeleteVedio(obj)
                                        {
                                            if(Confirm(obj, 'Are you sure you want delete ?'))
                                            {
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
                                            if(Validate(obj,$('#modal-insert')))
                                            {
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
                    <?php } ?>

                    <?php if($_COG_ALLOW_HTML_ICON){ ?>
                        <?php echo $_COG_ALLOW_MAIN_IMAGE ? "<br>" : ""; ?>
                        <span><b>ไอคอนหลัก</b></span>
                        <hr style="margin-top: 5px; margin-bottom: 5px;" />
                        <div class="service-item-box icon-effect-1 icon-effect-1a text-center">
                            <style>
                                .icon-effect-1 .hi-icon{
                                    border-color: #cc0617;
                                    background-color: transparent;
                                    border: 2px solid #cc0617;
                                    -webkit-transition: background 0.2s, color 0.2s;
                                    -moz-transition: background 0.2s, color 0.2s;
                                    -ms-transition: background 0.2s, color 0.2s;
                                    -o-transition: background 0.2s, color 0.2s;
                                    transition: background 0.2s, color 0.2s;
                                }
                                .service-item-box i {
                                    /* display: block; */
                                    font-size: 24px;
                                    line-height: 70px;
                                    color: #fff;
                                }
                                .hi-icon {
                                    display: inline-block;
                                    font-size: 0px;
                                    cursor: pointer;
                                    width: 70px;
                                    height: 70px;
                                    -webkit-border-radius: 50%;
                                    border-radius: 50%;
                                    text-align: center;
                                    position: relative;
                                    z-index: 1;
                                    color: #fff;
                                }

                                .icon {
                                    font-family: Stroke-Gap-Icons;
                                    speak: none;
                                    font-style: normal;
                                    font-weight: 400;
                                    font-variant: normal;
                                    text-transform: none;
                                    line-height: 1;
                                    -webkit-font-smoothing: antialiased;
                                    -moz-osx-font-smoothing: grayscale;
                                }

                                .icon-effect-1 .hi-icon:hover {
                                    background: #111111;
                                    color: #fff;
                                    border-color: transparent;
                                }

                                .icon-effect-1 .hi-icon:hover:after {
                                    -webkit-transform: scale(1);
                                    -moz-transform: scale(1);
                                    -ms-transform: scale(1);
                                    -o-transform: scale(1);
                                    transform: scale(1);
                                    opacity: 1;
                                }

                                .icon-effect-1 .hi-icon:after {
                                    top: -5px;
                                    left: -5px;
                                    padding: 5px;
                                    -webkit-box-shadow: 0 0 0 2px #111;
                                    -moz-box-shadow: 0 0 0 2px #111;
                                    -ms-box-shadow: 0 0 0 2px #111;
                                    box-shadow: 0 0 0 2px #111;
                                    -webkit-transition: transform 0.2s, opacity 0.2s;
                                    -moz-transition: transform 0.2s, opacity 0.2s;
                                    -ms-transition: transform 0.2s, opacity 0.2s;
                                    -o-transition: transform 0.2s, opacity 0.2s;
                                    transition: transform 0.2s, opacity 0.2s;
                                    -webkit-transform: scale(0.8);
                                    -moz-transform: scale(0.8);
                                    -ms-transform: scale(0.8);
                                    -o-transform: scale(0.8);
                                    transform: scale(0.8);
                                    opacity: 0;
                                }

                                .hi-icon:after {
                                    pointer-events: none;
                                    position: absolute;
                                    width: 100%;
                                    height: 100%;
                                    -webkit-border-radius: 50%;
                                    border-radius: 50%;
                                    content: '';
                                    -webkit-box-sizing: content-box;
                                    -moz-box-sizing: content-box;
                                    box-sizing: content-box;
                                }
                                .icon-effect-1 .hi-icon {
                                    color: #cc0617;
                                    border-color: #cc0617;
                                }


                            </style>
                            <i id="icon-preview" onclick="$('#modal-seelct-icon').modal('show');" class="fa  hi-icon <?php echo !empty($data["ImageIcon"]) ? $data["ImageIcon"] : "" ?>"></i>
                            <input type="hidden" name="hddBackUpIcon" value="<?php echo $data["ImageIcon"] ?>" />
                            <div class="text-center">
                                <small>คลิกด้านบนรูปเพื่อเลือกไอคอน</small>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div id="modal-seelct-icon" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog  modal-lg">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">คลิกเลือกไอคอน</h4>
                                    </div>
                                    <div class="modal-body">
                                        <style>
                                            #modal-panel-select-icon > i{
                                                margin: 5px;
                                            }
                                            .one-line-title {
                                                overflow-x: hidden;
                                                white-space: nowrap;
                                                text-overflow: ellipsis;
                                                overflow-y: hidden;
                                                font-size: 12px;
                                                color:gray;
                                            }
                                        </style>
                                        <script>
                                            function selectMainHiIcon(obj)
                                            {
                                                var icon = $(obj).attr("data-code");
                                                var iconold = $("[name='hddBackUpIcon']").val();
                                                $("#icon-preview").removeClass(iconold).addClass(icon);
                                                $("[name='hddBackUpIcon']").val(icon);
                                                $("#modal-seelct-icon").modal('hide');
                                            }
                                        </script>
                                        <div id="modal-panel-select-icon" class="service-item-box icon-effect-1 icon-effect-1a text-center">
                                            <div class="row">
                                                <?php
                                                    if(!isset($__ICONS_ARR)){
                                                        $__ICONS_ARR = array("fa-american-sign-language-interpreting","fa-glass","fa-music","fa-search","fa-envelope-o","fa-heart","fa-star","fa-star-o","fa-user","fa-users","fa-user-md","fa-graduation-cap","fa-film","fa-th-large","fa-th","fa-th-list","fa-check","fa-times","fa-search-plus","fa-search-minus","fa-power-off","fa-signal","fa-cog","fa-trash-o","fa-home","fa-file-o","fa-clock-o","fa-road","fa-download","fa-arrow-circle-o-down","fa-arrow-circle-o-up","fa-inbox","fa-repeat","fa-refresh","fa-list-alt","fa-lock","fa-flag","fa-headphones","fa-volume-off","fa-volume-down","fa-volume-up","fa-qrcode","fa-barcode","fa-tag","fa-tags","fa-book","fa-bookmark","fa-print","fa-camera","fa-font","fa-bold","fa-italic","fa-text-height","fa-text-width","fa-align-left","fa-align-center","fa-align-right","fa-align-justify","fa-list","fa-indent","fa-video-camera","fa-picture-o","fa-pencil","fa-map-marker","fa-adjust","fa-tint","fa-pencil-square-o","fa-share-square-o","fa-check-square-o","fa-arrows","fa-step-backward","fa-fast-backward","fa-backward","fa-play","fa-pause","fa-stop","fa-forward","fa-fast-forward","fa-step-forward","fa-eject","fa-chevron-left","fa-chevron-right","fa-plus-circle","fa-minus-circle","fa-check-circle","fa-question-circle","fa-info-circle","fa-crosshairs","fa-times-circle-o","fa-check-circle-o","fa-ban","fa-arrow-left","fa-arrow-right","fa-arrow-up","fa-arrow-down","fa-mail-forward","fa-share","fa-expand","fa-compress","fa-plus","fa-minus","fa-asterisk","fa-exclamation-circle","fa-gift","fa-leaf","fa-fire","fa-eye","fa-eye-slash","fa-warning","fa-plane","fa-calendar","fa-random","fa-comment","fa-magnet","fa-chevron-up","fa-chevron-down","fa-retweet","fa-shopping-cart","fa-folder","fa-folder-open","fa-arrows-v","fa-arrows-h","fa-line-chart","fa-bar-chart","fa-twitter-square","fa-facebook-square","fa-camera-retro","fa-key","fa-cogs","fa-comments","fa-thumbs-o-up","fa-thumbs-o-down","fa-star-half","fa-heart-o","fa-sign-out","fa-linkedin-square","fa-thumb-tack","fa-external-link","fa-sign-in","fa-trophy","fa-github-square","fa-upload","fa-phone","fa-fax","fa-square-o","fa-bookmark-o","fa-phone-square","fa-twitter","fa-facebook","fa-github","fa-unlock","fa-credit-card","fa-feed","fa-bullhorn","fa-bell","fa-certificate","fa-hand-o-right","fa-hand-o-left","fa-hand-o-up","fa-hand-o-down","fa-arrow-circle-left","fa-arrow-circle-right","fa-arrow-circle-up","fa-arrow-circle-down","fa-globe","fa-wrench","fa-tasks","fa-filter","fa-briefcase","fa-arrows-alt","fa-link","fa-cloud","fa-flask","fa-cut","fa-files-o","fa-paperclip","fa-floppy-o","fa-square","fa-bars","fa-list-ul","fa-list-ol","fa-truck","fa-pinterest","fa-google-plus-square","fa-google-plus","fa-money","fa-caret-down","fa-caret-up","fa-caret-left","fa-caret-right","fa-shield","fa-unsorted","fa-sort-desc","fa-sort-up","fa-envelope","fa-linkedin","fa-dashboard","fa-exchange","fa-cloud-download","fa-cloud-upload","fa-bell-o","fa-cutlery","fa-file-text-o","fa-building-o","fa-desktop","fa-laptop","fa-mobile-phone","fa-mail-reply","fa-github-alt","fa-folder-o","fa-folder-open-o","fa-keyboard-o");
                                                    }
                                                    $_Prefix = explode("-",$__ICONS_ARR[0])[0]; 
                                                    foreach ($__ICONS_ARR as $key) {
                                                        $__faName = str_replace("$_Prefix-","",$key);
                                                ?>
                                                    <div class="col-md-1" title="<?php echo $__faName; ?>">
                                                        <i class="fa hi-icon <?php echo $key; ?>" data-code="<?php echo $key; ?>" onclick="selectMainHiIcon(this);"></i>
                                                        <div class="one-line-title"><?php echo $__faName; ?></div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if($_COG_ALLOW_RANKING){ ?>
                        <div class="product-ranking-container">
                            <br />
                            <span><b>Most Popular Ranking</b></span>
                            <hr style="margin-top: 5px; margin-bottom: 5px;" />

                            <style>
                                .star-panel .gold,
                                .star-panel:hover .fa-star{
                                    color:gold;
                                }
                                .star-panel .grey,
                                .star-panel .fa-star:hover ~ .fa-star{
                                    color:#aaa;
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
                                $(".star-panel .fa-star").click(function () {
                                    $("#txtRank").val($(this).attr("data-rank"));
                                    $(this).removeClass("grey").removeClass("gold").addClass("gold");
                                    $(this).prevAll().removeClass("grey").removeClass("gold").addClass("gold");
                                    $(this).nextAll().removeClass("grey").removeClass("gold").addClass("grey");
                                });
                            </script>

                            <input type="hidden" id="txtRank" name="txtRank" value="<?php echo $rank ?>" />

                        </div>
                    <?php } ?>

                    <?php if($_COG_ALLOW_SOCIAL_FILE_DOWNLOAD){ ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php echo $_COG_ALLOW_MAIN_IMAGE ? "<br>" : ""; ?>
                                    <div class="slide-banner h-auto">
                                        <span><b>ไฟล์ให้ดาวน์โหลด </b></span>
                                        <hr style="margin-top: 5px; margin-bottom: 5px;" />
                                        <input type="file" name="txtFileUpload" value=""  onchange="validateUploadFileUpload(this);$(this).closest('.slide-banner').find('.remover').removeClass('hide')"  />
                                        
                                        <?php if(!empty($data["FileDownload"])){ ?>
                                        <div style="margin-top:5px;">
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
                    <?php } ?>
                    <?php if($_COG_ALLOW_SOCIAL_FILE_DOWNLOAD2){ ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <br />
                                    <div class="slide-banner h-auto">
                                        <span><b>ไฟล์ให้ดาวน์โหลด (SPEC)</b></span>
                                        <hr style="margin-top: 5px; margin-bottom: 5px;" />
                                        <input type="file" name="txtFileUpload2" value="" onchange="validateUploadFileUpload(this);$(this).closest('.slide-banner').find('.remover').removeClass('hide')"  />
                                        
                                        <?php if(!empty($data["FileDownload2"])){ ?>
                                        <div style="margin-top:5px;">
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
                    <?php } ?>
                    <script>
                        function validateUploadFileUpload(obj)
                        {
                            var file = $(obj).get(0).files[0];
                            var maxSize = 60000000;
                            if (file.size > maxSize) {
                                $(obj).val("");
                                swal("Invalid file size", "Maximum image size is 60 MB.", "error");
                            }
                        }

                    </script>

                    <?php if($_COG_ALLOW_HTML_MAPLOCATION){ ?>
                        <div class="row" style="display:flex;align-items:center;">
                                <div class="col-sm-12">
                                    <label>ที่อยู่บน Google map</label>
                                    <div class="input-group">
                                        <input id="mapinsert" type="text" class="form-control" name="txtLatLng" placeholder="https://www.google.com/maps/embed?pb=..." value="<?php echo $data["MapLocation"] ?>" />
                                        <span id="refresher" class="input-group-addon hand">
                                            <i class="fa fa-refresh"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div id="mapcheck" class="col-12">
                                <?php if (!empty($data["MapLocation"])) { ?>
                                    <iframe src="https://www.google.com/maps/embed?pb=<?php echo $data["MapLocation"]; ?>" width="100%" height="450" style="border:0"></iframe>
                                <?php } ?>
                            </div>
                            <script>
                                $("#refresher").click(function(e) {
                                    const iframe = $("#mapinsert").val();
                                    const url = iframe.match(/(?<=src="https:\/\/www\.google\.com\/maps\/embed\?pb=)(.*?)(?=")/gm);
                                    $("#mapcheck").html(iframe);
                                    $("#mapinsert").val(url);
                                    console.log(url);
                                });
                            </script>
                    <?php } ?>

                    <?php if($_COG_ALLOW_NEW){ ?>
                        <div class="product-new-container">
                                <br />
                                <span><b><?php echo $_COG_ITEM_NAME ?> แนะนำ</b></span>
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
                                    <?php if(!empty($_GET["ref"]) && $data["New"] == 0){ ?>
                                    $("#toggle-new").click();
                                    <?php } ?>
                                </script>
                            </div>
                        <?php } ?>
                         
                    </div>

                </div>
                <?php if($_COG_ALLOW_PROPERTIES){ ?>
                
                    <?php if($_COG_PROPERTIES_OPTION){ ?>
                        <div class="">
                            <span><b>คุณสมบัติ<?php echo $_COG_ITEM_NAME ?></b></span>
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
                                    $dataTags = SelectRowsArray($sqlTags, array('ProductCode' => $portCode, 'PropGroup' => $_COG_ITEM_CODE));
                                    foreach ($dataTags  as $tag) {
                                    ?>
                                    <div class="col-sm-6" onclick="$(this).find('input').click();">
                                        <input onclick="event.stopPropagation();" class="chk-project-model" type="checkbox" <?php echo !empty($tag["Detail"]) ? "checked" : "" ?> name="chkPropDetail[]" id="chk-<?php echo $tag["PropCode"] ?>" value="<?php echo $tag["PropCode"] ?>" />
                                        <label onclick="event.stopPropagation();" for="chk-<?php echo $tag["PropCode"] ?>" class="hand"><span class="text-primary"><?php echo $tag["PropName"]; ?></span></label>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php }else{ ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>ข้อมูลและคุณสมบัติ<?php echo $_COG_ITEM_NAME ?>
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
                                        $dataProps = SelectRows($sql, array('ProductCode' => $data["PortCode"], 'PropGroup' => $_COG_ITEM_CODE));
                                        foreach ($dataProps as $dataProp) {
                                        ?>
                                        <tr>
                                            <th class="text-right" style="width: 200px; vertical-align: middle; padding-right: 30px; color: #ed2437"><?php echo $dataProp["PropName"] ?></th>
                                            <?php if($_COG_PROPERTIES_IMAGE){ ?>
                                            <th class="text-center" style="width: 100px;">
                                                <img src="<?php echo !empty($dataProp["Image"]) ? $dataProp["Image"] : "https://ipsumimage.appspot.com/34x34,eee"; ?>" style="width:30px;height:30px;object-fit:cover;" alt="">
                                            </th>
                                            <?php } ?>
                                            <td>
                                                <?php
                                                    if(!empty($dataProp["PropSelected"])){
                                                    ?>
                                                    <select name="txtPropDetail[]" class="form-control input-sm">
                                                        <?php //echo GetDropDownListOptionWithDefaultSelectedAndCondition("tag","TagCode","TagName","",$dataProp["Detail"], array('TagType' => $dataProp["PropSelected"])) ?>
                                                        <option value=""></option>
                                                        <?php 
                                                            $options = SelectRows("select * from tag where TagType = :TagType order by TagName asc",  array('TagType' => $dataProp["PropSelected"]));
                                                            foreach ($options as $opt) {
                                                            ?>
                                                                <option value="<?php echo $opt["TagCode"] ?>" <?php echo $opt["TagCode"] == $dataProp["Detail"] ? ' selected="selected" ' : ''  ?>><?php echo $opt["TagName"] ?></option>
                                                            <?php
                                                            }
                                                        ?>
                                                    </select>
                                                    <?php }else{ ?>
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
                    <?php } ?>
                <?php } ?>

                <?php if($_COG_ALLOW_HTML_EDITOR){ ?>
                    <hr />
                    <div class="row">
                        <div class="col-sm-12 summernote-container">
                            <label>รายละเอียด</label>
                            <?php 
                            // =============== HTML EDITOR =============== 
                            $_HTML_EDITOR_NAME = "txtDetail";
                            $_HTML_EDITOR_CONTENT_ID = $data["PortDetail"];
                            include $GLOBALS['DOCUMENT_ROOT'].'/ControlPanel/HtmlEditor/HtmlEditor.php'; 
                            ?>
                        </div>
                    </div>
                <?php } ?>

                <?php if($_COG_ALLOW_HTML_EDITOR2){ ?>
                    <hr />
                    <div class="row">
                        <div class="col-sm-12 summernote-container">
                            <label>รายละเอียด 2</label>
                            <?php 
                            // =============== HTML EDITOR =============== 
                            $_HTML_EDITOR_NAME = "txtDetailHTML2";
                            $_HTML_EDITOR_CONTENT_ID = $data["PortHtml2"];
                            include $GLOBALS['DOCUMENT_ROOT'].'/ControlPanel/HtmlEditor/HtmlEditor.php'; 
                            ?>
                        </div>
                    </div>
                <?php } ?>

                <?php if($_COG_ALLOW_HTML_EDITOR3){ ?>
                    <hr />
                    <div class="row">
                        <div class="col-sm-12 summernote-container">
                            <label>รายละเอียด 3</label>
                            <?php 
                            // =============== HTML EDITOR =============== 
                            $_HTML_EDITOR_NAME = "txtDetailHTML3";
                            $_HTML_EDITOR_CONTENT_ID = $data["PortHtml3"];
                            include $GLOBALS['DOCUMENT_ROOT'].'/ControlPanel/HtmlEditor/HtmlEditor.php'; 
                            ?>
                        </div>
                    </div>
                <?php } ?>
                
                <?php if($_COG_ALLOW_SEO){ ?>
                <div class="row">
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
                <?php } ?>

                <?php if($_COG_ALLOW_TAG){ ?>
                    <div class="row">
                        <div class="col-md-4">
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
                            <span><b>แท็ก
                            <span class="text-danger">*เลือกอย่างน้อย 1 รายการ
                            </span>
                            </b></span>
                            <hr style="margin-top: 5px; margin-bottom: 5px;" />
                            <?php
                            $sqlTags = "select * from tag where Active = 1 and TagType = :TagType order by TagName";
                            $dataTags = SelectRowsArray($sqlTags, array('TagType' => $_COG_ITEM_CODE));
                            foreach ($dataTags  as $tag) {
                                //$chechTag = strpos($tag["TagCode"], $data["Tag"]);
                            ?>
                            <p class="tag-panel" onclick="$(this).find('input').click();">
                                <input onclick="event.stopPropagation();" class="pull-right chk-tag" type="checkbox" <?php echo strpos($data["Tag"],$tag["TagCode"]) !== false ? "checked" : "" ?> name="chkTag[]" id="chk-<?php echo $tag["TagCode"] ?>" value="<?php echo $tag["TagCode"] ?>" />
                                <label onclick="event.stopPropagation();" for="chk-<?php echo $tag["TagCode"] ?>" class="hand"><?php echo $tag["TagName"] ?></label>
                            </p>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>

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
                            //var msg = [];
                            //if ($("#txtSubject").val().trim() == "") {
                            //    msg.push("หัวข้อแกลเลอรี่");
                            //}
                            //if ($("#txtByName").val().trim() == "") {
                            //    msg.push("ชื่อผู้เขียน (ชื่อที่ใช้แสดง)");
                            //}
                            //if ($(".chk-tag:checked").length == 0) {
                            //    msg.push("เลือกแท็กอย่างน้อย 1 รายการ");
                            //}
                            //if (msg.length > 0) {
                            //    swal('Please fill in all required fields.', msg.join("\n").split(":").join(""), 'warning');
                            //    return false;
                            //}
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
                    <a href="item.php" class="btn btn-danger">
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
        <td class="text-center">
            <a href="javascript:;" onclick="$(this).closest('tr').remove();">
                <i class="fa fa-trash"></i>
            </a>
        </td>
    </tr>
</table>

<script>
    //onchange="IsFormatNumber(this);"
    function IsFormatNumber(obj) {
        var formatValue = new NumberFormat($(obj).val());
        formatValue.setPlaces(<?php echo (isset($_COG_ALLOW_AMOUNT_DECIMAL) ? $_COG_ALLOW_AMOUNT_DECIMAL : 0) ?>);
        $(obj).val(formatValue.toFormatted());
    }
    function ConvertFormatNumber(Value, digit) {
        var formatValue = new NumberFormat(Value);
        formatValue.setPlaces(digit);
        return formatValue.toFormatted();
    }
    function ConvertToNumber(Value) {
        var formatValue = new NumberFormat(Value);
        return parseFloat(formatValue.toFormatted().replace(/,/g , ''));
    }
    //onkeypress='IsKeyNumber(event)' 
    function IsKeyNumber(evt) {
        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
        var regex = /[0-9]|\./;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault) theEvent.preventDefault();
        }
    }

</script>

<script>
    function deletefile(obj){
        if(AlertConfirm(obj,"Confirm ?")){
            var target = $(obj).closest('.slide-banner');
            $(target).find("input[type='file']").val("");
            $(target).find("input[type='hidden']").val("");
            $(target).find(".file-display").addClass("hide");
            $(target).find(".remover").addClass("hide");
        }
    }       
</script>
<?php include_once  $GLOBALS['DOCUMENT_ROOT']."/ControlPanel/footer.php"; ?>