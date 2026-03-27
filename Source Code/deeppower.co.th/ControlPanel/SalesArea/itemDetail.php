<?php include  "../header.php"; ?>
<?php include  "_config.php"; ?>

<?php
$_Is_EditMode = !empty($_GET["ref"]);
$portCode = $_Is_EditMode ? $_GET["ref"] : GenerateNextID("portfolio","PortCode",5,"S");
if(isset($_POST["btnSubmit"])){
    $txtSubject = $_POST["txtSubject"];
    $chkActive = isset($_POST["chkActive"]) ? 1 : 0;
    $txtShortDescription = $_POST["txtShortDescription"];
    $txtAddress = $_POST["txtAddress"];
    $txtLatLng = $_POST["txtLatLng"];
    $ddlProvince = $_POST["ddlProvince"];
    $ddlDistrict = $_POST["ddlDistrict"];

    
    if($_Is_EditMode)
    {
        $sqlUpdate = "update portfolio set 
             PortName = :PortName
            ,PortDetail = ''
            ,ShortDescription = :ShortDescription
            ,Active = :Active
            ,UpdatedOn = NOW()
            ,UpdatedBy = :UpdatedBy
            ,CategoryCode = ''
            ,Address = :Address
            ,MapLocation = :MapLocation
            ,ProvinceCode = :ProvinceCode
            ,DistrictCode = :DistrictCode
            where PortCode = :PortCode
        ";
        ExecuteSQL($sqlUpdate, array(
             'PortName' => $txtSubject
            ,'PortDetail' => ''
            ,'ShortDescription' => $txtShortDescription
            ,'Active' => $chkActive
            ,'UpdatedBy' => UserService::UserCode()
            ,'Address' => $txtAddress
            ,'MapLocation' => $txtLatLng
            ,'ProvinceCode' => $ddlProvince
            ,'DistrictCode' => $ddlDistrict
            ,'PortCode' => $portCode
        ));
    }
    else
    {
        $sqlInsert = "insert into portfolio (PortCode,PortName,ShortDescription
                        ,Active,CreatedOn,CreatedBy,PortType,CategoryCode,Address,MapLocation,ProvinceCode,DistrictCode)
                    VALUES(
                        :PortCode,
                        :PortName,
                        :ShortDescription,
                        :Active,
                        NOW(),
                        :CreatedBy,
                        :PortType,
                        '',
                        :Address,
                        :MapLocation,
                        :ProvinceCode,
                        :DistrictCode
                    );";
        ExecuteSQL($sqlInsert, array(
            'PortCode' => $portCode,
            'PortName' => $txtSubject,
            'ShortDescription' => $txtShortDescription,
            'Active' => $chkActive,
            'CreatedBy' => UserService::UserCode(),
            'PortType' => $_COG_ITEM_CODE,
            'CategoryCode' => '',
            'Address' => $txtAddress,
            'MapLocation' => $txtLatLng,
            'ProvinceCode' => $ddlProvince,
            'DistrictCode' => $ddlDistrict
        ));
    }

    $allCat = "";
    $chkCat = $_POST["chkCat"];
    $sqlCatDelete = " delete from product_category_mapping where ProductCode = :ProductCode ";
    $arrSql = array();
    $values = array();
    for ($i = 0; $i < countval($chkCat); $i++)
    {
        $cat = $chkCat[$i];
        if(empty($cat))
           continue;

           $txtTelephone = $_POST["txtTelephone_$cat"];
           $txtDetail = GeneratePageFile($_POST["txtDetail_$cat"],$_COG_ITEM_CODE."-".$cat."-".$portCode);
           array_push($arrSql,"insert into product_category_mapping (CategoryCode,ProductCode,MappingText,Phone,CategoryDetail) values(:CategoryCode$i,:ProductCode$i, '', :Phone$i, :CategoryDetail$i)");
           $values["CategoryCode$i"] = $cat;
           $values["ProductCode$i"] = $portCode;
           $values["Phone$i"] = $txtTelephone;
           $values["CategoryDetail$i"] = $txtDetail;
    }
    ExecuteSQL($sqlCatDelete, array('ProductCode' => $portCode));
    if(count($arrSql) > 0){
        ExecuteMultiSQL(join(";  ",$arrSql), $values);
    }
    GenerateHTAccess();
    Redirect("item.php");
    exit();
}
if($_Is_EditMode){
    $sqlPrd = "select * from portfolio where PortCode = :PortCode";
    $data = SelectRow($sqlPrd, array('PortCode' => $portCode));
}
?>


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
                    <div class="col-md-9">
                        <div>
                            <span><b><?php echo !$_Is_EditMode ? "เพิ่มข้อมูล" : "แก้ไขข้อมูล <i class='text-primary'>".$data["PortName"]."</i>" ?></b></span>
                            <hr style="margin-top: 5px;" />
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>รายชื่อ<?php echo $_COG_ITEM_NAME ?></label>
                                <input type="text" placeholder="รายชื่อ<?php echo $_COG_ITEM_NAME ?>..." name="txtSubject" id="txtSubject" value="<?php echo $data["PortName"] ?>" class="form-control input-sm require" />
                            </div>
                        </div>
                        <div class="row hide">
                            <div class="col-sm-12">
                                <label>รายละเอียดแบบย่อ</label>
                                <textarea name="txtShortDescription" id="txtShortDescription" class="form-control input-sm require"><?php echo $data["ShortDescription"] ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>จังหวัด</label>
                                <select name="ddlProvince" onchange="loadDistrict(this.value);" class="form-control input-sm require">
                                    <option value="">เลือก</option>
                                        <?php
                                        $sqlProvince = "select * from area_province b
                                                where b.Active = 1";
                                        $datasProvince = SelectRows($sqlProvince);
                                        $cIndex = 0;
                                        foreach ($datasProvince as $province) {
                                        ?>
                                            <option value="<?php echo $province["ProvinceCode"] ?>" <?php echo $data["ProvinceCode"] == $province["ProvinceCode"] ? 'selected="selected"' : '' ?>><?php echo $province["ProvinceName"] ?></option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label>เขต / อำเภอ</label>
                                <select name="ddlDistrict" id="ddlDistrict" class="form-control input-sm require">
                                    <option value="">ไม่ระบุ</option>
                                </select>
                            </div>
                            <script>
                                function loadDistrict(code, setValue) {
                                    $("#ddlDistrict").load("itemOptionLoadData.php?type=DISTRICT&ref=" + code, function () {
                                        if (setValue != undefined) {
                                            $("#ddlDistrict").val(setValue);
                                        }
                                    });
                                }
                                <?php if(!empty($data["PortCode"])){ ?>

                                    loadDistrict('<?php echo $data["ProvinceCode"] ?>', '<?php echo $data["DistrictCode"] ?>');

                                <?php } ?>
                            </script>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>ที่อยู่<?php echo $_COG_ITEM_NAME ?></label>
                                <textarea name="txtAddress" id="txtAddress" class="form-control input-sm require"><?php echo $data["Address"] ?></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <style>
                                    .category-panel {
                                        border-bottom: 1px solid #ccc;
                                        margin-bottom: 0;
                                        padding: 3px 10px;
                                        cursor: pointer;
                                        background: #eee;
                                    }
                                    .category-panel label {
                                        padding-left: 10px;;
                                    }
                                    .category-panel-item{
                                        padding: 20px;
                                        display: none;
                                        border : none;
                                    }
                                    .category-panel-item.active{
                                        display: block;
                                        border: solid 1px;
                                        border-style: dashed;
                                    }
                                </style>
                                <span><b>หมวดหมู่
                                <span class="text-danger">*เลือกอย่างน้อย 1 รายการ
                                </span>
                                </b></span>
                                <hr style="margin-top: 5px; margin-bottom: 5px;" />
                                <?php
                                    $sqlCats = "
                                    SELECT a.CategoryCode,a.CategoryName,case WHEN ifnull(b.CategoryCode,'') <> '' then 1 else 0 end Active
                                        ,b.Phone,b.CategoryDetail
                                    FROM product_category a 
                                    left join product_category_mapping b 
                                            on a.CategoryCode = b.CategoryCode and b.ProductCode= :ProductCode
                                    WHERE a.CategoryGroup= :CategoryGroup
                                    order by a.SEQ asc, a.CategoryCode asc
                                    ";
                                    $dataCats = SelectRowsArray($sqlCats, array('ProductCode' => $data["PortCode"], 'CategoryGroup' => $_COG_ITEM_CODE));
                                    foreach ($dataCats  as $cat) {
                                    ?>
                                    <div class="category-panel" onclick="$(this).find('input').click();switchPanelCategorySelect(this);">
                                        <input onclick="event.stopPropagation();switchPanelCategorySelect($(this).parent());" class="pull-left chk-cat" type="checkbox" <?php echo $cat["Active"] ? "checked" : "" ?> name="chkCat[]" id="chk-<?php echo $cat["CategoryCode"] ?>" value="<?php echo $cat["CategoryCode"] ?>" />
                                        <label onclick="event.stopPropagation();switchPanelCategorySelect($(this).parent());" for="chk-<?php echo $cat["CategoryCode"] ?>" class="hand"><?php echo $cat["CategoryName"] ?></label>
                                    </div>
                                    <div class="category-panel-item category-item-<?php echo $cat["CategoryCode"] ?> <?php echo $cat["Active"] ? "active" : "" ?>">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>เบอร์โทร</label>
                                                <input type="text" placeholder="เบอร์โทร..." name="txtTelephone_<?php echo $cat["CategoryCode"] ?>" id="txtTelephone_<?php echo $cat["CategoryCode"] ?>" value="<?php echo  $cat["Phone"] ?>" class="form-control input-sm" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 summernote-container">
                                                <label>ข้อมูลรายละเอียด</label>
                                                <?php 
                                                // =============== HTML EDITOR =============== 
                                                $_HTML_EDITOR_NAME = "txtDetail_".$cat["CategoryCode"];
                                                $_HTML_EDITOR_CONTENT_ID = $cat["CategoryDetail"];
                                                include $GLOBALS['DOCUMENT_ROOT'].'/ControlPanel/HtmlEditor/HtmlEditor.php'; 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <script>

                                    function switchPanelCategorySelect(obj)
                                    {
                                        if($(obj).find('input').prop('checked')){
                                            $(obj).next().addClass("active");
                                        }else{
                                            $(obj).next().removeClass("active");
                                        }
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                    <?php if($_COG_ALLOW_MAIN_IMAGE){ ?>
                        <div>
                            <span><b>รูปภาพหลัก</b></span>
                            <hr style="margin-top: 5px; margin-bottom: 5px;" />
                            <p>
                                <small class="text-danger">*ขนาดภาพที่เหมาะสมที่สุดคือ 1200 x 900 pixels</small>
                            </p>
                            <img id="imge-preview" src="<?php echo empty($data["Image"]) ? "https://ipsumimage.appspot.com/1200x900,eee" : $data["Image"] ?>" 
                            class="img-responsive hand" onclick="$(this).next().click();"/>
                            <input class="hide" type="file" onchange="$(this).validateUploadImage($('#imge-preview'));"
                                name="fileUpload" id="fileUpload" accept="image/*" />
                            <input type="hidden" name="hddBackUpImage" value="<?php echo $data["Image"] ?>" />
                            <div class="text-center">
                                <small>คลิกด้านบนรูปเพื่อเลือกรูปภาพ</small>
                            </div>
                        </div>
                    <?php } ?>
                  
                    <?php if($_COG_ALLOW_HTML_MAPLOCATION){ ?>
                        <?php 
                            include($GLOBALS['DOCUMENT_ROOT']."/ControlPanel/GoogleMap/location.php") 
                            ?>
                            <div class="product-location-container">
                                <div class="">
                                    <span><b>ตำแหน่งบนแผนที่ (Latitude - Logitude)</b></span>
                                    <hr style="margin-top: 5px; margin-bottom: 5px;" />
                                    <input readonly type="text" class="lat-lng form-control require input-sm" style="display:inline-block;float:left;margin-right:5px;width:200px;" value="<?php echo $data["MapLocation"] ?>" />
                                    <button type="button" class="btn btn-primary btn-sm" onclick="openSuperGridGoogleMapMap(this);">
                                        <i class="fa fa-map-marker text-danger"></i>
                                        ค้นหาตำแหน่งบนแผนที่
                                    </button>
                                    <input type="text" class="lat-lng hide" name="txtLatLng" value="<?php echo $data["MapLocation"] ?>" />
                                </div>
                            </div>
                    <?php } ?>
                         
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
                            var msg = [];
                            if ($(".chk-cat:checked").length == 0) {
                               msg.push("เลือกหมวดหมู่อย่างน้อย 1 รายการ");
                            }
                            if (msg.length > 0) {
                               swal('Please fill in all required fields.', msg.join("\n").split(":").join(""), 'warning');
                               return false;
                            }
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
<?php include_once "../footer.php"; ?>