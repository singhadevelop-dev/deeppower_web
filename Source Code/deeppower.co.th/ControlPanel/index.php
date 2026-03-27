<?php include  "header.php"; ?>

<?php

if (isset($_POST["btnSave"])) {

    $uploadFileTarget =  $GLOBALS["ROOT"] . "/_content_images/" . GetCurrentLang() . "/website/";
    $uploadFileTarget2 =  $GLOBALS["ROOT"] . "/ControlPanel/qrcode/images/watermarks/";
    $uploadFileDowloadTarget =  $GLOBALS["ROOT"] . "/_content_images/" . GetCurrentLang() . "/website/FileDownLoad/";
    $fileUploaded = $_FILES["fileUpload"];
    $fileUploaded2 = $_FILES["fileUpload2"];
    $fileUploaded3 = $_FILES["fileUpload3"];
    $fileUploaded4 = $_FILES["fileUpload4"];
    $fileUploadDetail = $_FILES["txtFileUpload"];
    $cuurentDateTime = GetCurrentStringDateTimeServer();
    if (!empty($fileUploaded["name"])) {
        $fileUploadedPath = $uploadFileTarget . UploadFile($_FILES["fileUpload"], $uploadFileTarget, "logo");
        $fileUploadedPath = parse_url($fileUploadedPath, PHP_URL_PATH) . "?vs=" . $cuurentDateTime;
    } else {
        $fileUploadedPath = $_POST["hddBackUpImage"];
    }

    if (!empty($fileUploaded2["name"])) {
        $fileUploadedPath2 = $uploadFileTarget . UploadFile($_FILES["fileUpload2"], $uploadFileTarget, "logo2");
        $fileUploadedPath2 = parse_url($fileUploadedPath2, PHP_URL_PATH) . "?vs=" . $cuurentDateTime;
    } else {
        $fileUploadedPath2 = $_POST["hddBackUpImage2"];
    }

    if (!empty($fileUploaded3["name"])) {
        $fileUploadedPath3 = $uploadFileTarget . UploadFile($_FILES["fileUpload3"], $uploadFileTarget, "logo3");
        $fileUploadedPath3 = parse_url($fileUploadedPath3, PHP_URL_PATH) . "?vs=" . $cuurentDateTime;
    } else {
        $fileUploadedPath3 = $_POST["hddBackUpImage3"];
    }

    if (!empty($fileUploaded4["name"])) {
        $fileUploadedPath4 = $uploadFileTarget . UploadFile($_FILES["fileUpload4"], $uploadFileTarget, "logo4");
        $fileUploadedPath4 = parse_url($fileUploadedPath4, PHP_URL_PATH) . "?vs=" . $cuurentDateTime;
    } else {
        $fileUploadedPath4 = $_POST["hddBackUpImage4"];
    }

    if (!empty($fileUploadDetail["name"])) {
        $fileDownloadPath = $uploadFileDowloadTarget . UploadFile($_FILES["txtFileUpload"], $uploadFileDowloadTarget, $portCode);
        $fileDownloadPath = parse_url($fileDownloadPath, PHP_URL_PATH) . "?vs=" . $cuurentDateTime;
        $fileDownloadName = $fileUploadDetail["name"];
    } else {
        $fileDownloadPath = $_POST["hddBackUpFileDownload"];
        $fileDownloadName = $_POST["hddBackUpFileDownloadName"];
    }

    $sqlUpdate = "update website set
    WebName = :WebName
    ,WebSubName = :WebSubName
    ,WebUrl = :WebUrl
    ,Title = :Title
    ,Description = :Description
    ,Keyword = :Keyword
    ,Email = :Email
    ,Email2 = :Email2
    ,Email3 = :Email3
    ,Address = :AddressTH
    ,AddressEN = :AddressEN
    ,Phone = :Phone
    ,MobilePhone = :MobilePhone
    ,LineID = :LineID1
    ,LineIDURL = :LineIDURL
    ,LineID2 = :LineID2
    ,LineIDURL2 = :LineIDURL2
    ,Facebook = :Facebook1
    ,FacebookURL = :FacebookURL
    ,IG = :IG1
    ,IGURL = :IGURL
    ,Whatsapp = :Whatsapp
    ,Googleplus = :Googleplus
    ,Twitter = :Twitter1
    ,TwitterURL = :TwitterURL
    ,Pinterest = :Pinterest
    ,Dribbble = :Dribbble
    ,RSSWeb = :RSSWeb
    ,Linkedin = :Linkedin
    ,HourWork = :HourWork
    ,DayOff = :DayOff
    ,YoutubeURL = :YoutubeURL
    ,Fax = :Fax
    ,MapLocation = :MapLocation
    ,Image = :Image1
    ,Image2 = :Image2
    ,Image3 = :Image3
    ,Image4 = :Image4
    ,cogs_logo_path = :cogs_logo_path
    ,cogs_google_tag_manager = :cogs_google_tag_manager
    ,cogs_google_pixel = :cogs_google_pixel
    ";
    ExecuteSQL($sqlUpdate, array(
        'WebName' => $_POST["txtWebName"],
        'WebSubName' => $_POST["txtWebSubName"],
        'WebUrl' => $_POST["txtWebURL"],
        'Title' => $_POST["txtSEOTitle"],
        'Description' => $_POST["txtSEODesc"],
        'Keyword' => $_POST["txtSEOKeyword"],
        'Email' => $_POST["txtEmail"],
        'Email2' => $_POST["txtEmail2"],
        'Email3' => $_POST["txtEmail3"],
        'AddressTH' => $_POST["txtAddress"],
        'AddressEN' => $_POST["txtAddressEn"],
        'Phone' => $_POST["txtPhone"],
        'MobilePhone' => $_POST["txtMobilePhone"],
        'LineID1' => $_POST["txtLineID"],
        'LineIDURL' => $_POST["txtLineIDURL"],
        'LineID2' => $_POST["txtLineID2"],
        'LineIDURL2' => $_POST["txtLineIDURL2"],
        'Facebook1' => $_POST["txtFacebook"],
        'FacebookURL' => $_POST["txtFacebookURL"],
        'IG1' => $_POST["txtIG"],
        'IGURL' => $_POST["txtIGURL"],
        'Whatsapp' => $_POST["txtWhatsapp"],
        'Googleplus' => $_POST["txtGoogleplus"],
        'Twitter1' => $_POST["txtTwitter"],
        'TwitterURL' => $_POST["txtTwitterURL"],
        'Pinterest' => $_POST["txtPinterest"],
        'Dribbble' => $_POST["txtDribbble"],
        'RSSWeb' => $_POST["txtRSSWeb"],
        'Linkedin' => $_POST["txtLinkedin"],
        'HourWork' => $_POST["txtHourWork"],
        'DayOff' => $_POST["txtDayOff"],
        'YoutubeURL' => $_POST["txtYoutubeURL"],
        'Fax' => $_POST["txtFax"],
        'MapLocation' => $_POST["txtLatLng"],
        'Image1' => $fileUploadedPath,
        'Image2' => $fileUploadedPath2,
        'Image3' => $fileUploadedPath3,
        'Image4' => $fileUploadedPath4,
        'cogs_logo_path' => $fileUploadedPath,
        'cogs_google_tag_manager' => $_POST["cogs_google_tag_manager"],
        'cogs_google_pixel' => $_POST["cogs_google_pixel"]
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
    <span class="link-history-btn">ข้อมูลทั่วไป</span>



</div>
<div class="mat-box" style="border-radius: 0 0 3px 3px">

    <div class="row">
        <div class="col-md-3">
            <?php
            $_LEFT_MENU_ACTIVE = "HOME";
            include $GLOBALS['DOCUMENT_ROOT'] . "/ControlPanel/home/leftMenu.php";
            ?>
        </div>
        <div class="col-md-9">
            <style>
                .picked td {
                    background-color: rgba(176, 243, 76, 0.4) !important;
                }

                .picked td:first-child {
                    border-left: 3px solid rgba(176, 243, 76, 1);
                }

                .no-picked td {
                    background-color: rgba(255, 0, 0, 0.2) !important;
                }

                .no-picked td:first-child {
                    border-left: 3px solid rgba(255, 0, 0, 1);
                }
            </style>

            <form method="post" enctype="multipart/form-data">

                <?php

                $sql = "select * from website limit 1";
                $data = SelectRow($sql, array());

                $_DEFAULT_MAP_LOCATION = $data["MapLocation"];
                include("GoogleMap/location.php")
                ?>

                <span><b>ข้อมูลเว็บไซต์ทั่วไป</b></span>
                <hr style="margin-top: 5px;" />

                <div class="row">
                    <div class="col-sm-12">
                        <label>ชื่อหลักเว็บไซต์</label>
                        <input type="text" placeholder="ชื่อหลักเว็บไซต์.." class="form-control require" name="txtWebName" value="<?php echo $data["WebName"] ?>" />
                    </div>
                </div>

                <div class="row hide">
                    <div class="col-sm-12">
                        <label>คำอธิบายโดยย่อ (Header)</label>
                        <textarea class="form-control" name="txtWebSubName" placeholder="คำอธิบายโดยย่อ (Header)..."><?php echo $data["WebSubName"] ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label>คำอธิบายโดยย่อ (Footer)</label>
                        <textarea class="form-control require" name="txtSEODesc" placeholder="คำอธิบายโดยย่อ (Footer)..."><?php echo $data["Description"] ?></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <label>Link GoogleMap</label>
                        <input type="text" placeholder="Link GoogleMap.." class="form-control require" name="txtWebURL" value="<?php echo $data["WebUrl"] ?>" />
                    </div>

                </div>

                <div class="panel panel-info">
                    <div class="panel-heading">
                        ข้อมูลการติดต่อ
                    </div>
                    <div class="panel-body">
                        <div class="row hide">

                            <div class="col-sm-6 hide">
                                <label>เวลาทำการ (เพิ่มเติม)</label>
                                <input type="text" placeholder="เวลาทำการ (เพิ่มเติม).." class="form-control" name="txtDayOff" value="<?php echo $data["DayOff"] ?>" />
                            </div>
                            <div class="col-sm-4 hide">
                                <label>เวลาทำการ</label>
                                <input type="text" placeholder="เวลาทำการ.." class="form-control require" name="txtHourWork" value="<?php echo $data["HourWork"] ?>" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Email</label>
                                <input type="text" placeholder="อีเมล์.." class="form-control require" name="txtEmail" value="<?php echo $data["Email"] ?>" />
                            </div>
                            <div class="col-sm-4 hide">
                                <label>Email 2</label>
                                <input type="text" placeholder="อีเมล์ 2.." class="form-control require" name="txtEmail2" value="<?php echo $data["Email2"] ?>" />
                            </div>
                            <div class="col-sm-4 hide">
                                <label>Email 3</label>
                                <input type="text" placeholder="อีเมล์ 3.." class="form-control require" name="txtEmail3" value="<?php echo $data["Email3"] ?>" />
                            </div>
                            <div class="col-sm-6">
                                <label>เบอร์โทร</label>
                                <input type="text" placeholder="เบอร์โทร.." class="form-control require" name="txtPhone" value="<?php echo $data["Phone"] ?>" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>เบอร์โทร 2</label>
                                <input type="text" placeholder="เบอร์โทร 2.." class="form-control require" name="txtMobilePhone" value="<?php echo $data["MobilePhone"] ?>" />
                            </div>
                            <div class="col-sm-6 hide">
                                <label>เบอร์โทร 3</label>
                                <input type="text" placeholder="เบอร์โทร 3.." class="form-control require" name="txtFax" value="<?php echo $data["Fax"] ?>" />
                            </div>
                        </div>

                        <div class="row hide">
                            <div class="col-sm-6 hide">
                                <label>Facebook</label>
                                <input type="text" placeholder="Facebook Name.." class="form-control" name="txtFacebook" value="<?php echo $data["Facebook"] ?>" />
                            </div>
                            <div class="col-sm-6 hide">
                                <label>Facebook URL</label>
                                <input type="text" placeholder="Facebook URL.." class="form-control require" name="txtFacebookURL" value="<?php echo $data["FacebookURL"] ?>" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 hide">
                                <label>Twitter</label>
                                <input type="text" placeholder="Twitter Name.." class="form-control" name="txtTwitter" value="<?php echo $data["Twitter"] ?>" />
                            </div>
                            <div class="col-sm-6 hide">
                                <label>Twitter URL</label>
                                <input type="text" placeholder="Twitter URL.." class="form-control require" name="txtTwitterURL" value="<?php echo $data["TwitterURL"] ?>" />
                            </div>
                            <div class="col-sm-6">
                                <label>TikTok</label>
                                <input type="text" placeholder="TikTok.." class="form-control" name="txtLinkedin" value="<?php echo $data["Linkedin"] ?>" />
                            </div>
                            <div class="col-sm-6 hide">
                                <label>RSS</label>
                                <input type="text" placeholder="RSS.." class="form-control" name="txtRSSWeb" value="<?php echo $data["RSSWeb"] ?>" />
                            </div>
                            <div class="col-sm-6 hide">
                                <label>Google plus</label>
                                <input type="text" placeholder="Googleplus.." class="form-control" name="txtGoogleplus" value="<?php echo $data["Googleplus"] ?>" />
                            </div>
                        </div>
                        <div class="row hide">
                            <div class="col-sm-6 hide">
                                <label>Instagram</label>
                                <input type="text" placeholder="Instagram Name.." class="form-control" name="txtIG" value="<?php echo $data["IG"] ?>" />
                            </div>
                            <div class="col-sm-6">
                                <label>Instagram URL</label>
                                <input type="text" placeholder="Instagram URL.." class="form-control require" name="txtIGURL" value="<?php echo $data["IGURL"] ?>" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 hide">
                                <label>Line ID</label>
                                <input type="text" placeholder="Line ID.." class="form-control" name="txtLineID" value="<?php echo $data["LineID"] ?>" />
                            </div>
                            <div class="col-sm-6">
                                <label>LineID URL</label>
                                <input type="text" placeholder="LineID URL.." class="form-control" name="txtLineIDURL" value="<?php echo $data["LineIDURL"] ?>" />
                            </div>
                        </div>
                        <div class="row hide">
                            <div class="col-sm-6">
                                <label>Youtube</label>
                                <input type="text" placeholder="Youtube URL.." class="form-control" name="txtYoutubeURL" value="<?php echo $data["YoutubeURL"] ?>" />
                            </div>
                        </div>
                        <div class="row hide">
                            <div class="col-sm-4">
                                <label>Backgroup Color:</label>
                                <input type="color" placeholder="Sales Ext.." class="form-control" name="txtPhone2"
                                    value="<?php echo $data["Phone2"] ?>" />
                            </div>
                            <div class="col-sm-4">
                                <label>Title Color:</label>
                                <input type="color" placeholder="Purchasing Officer Ext.." class="form-control" name="txtPhone3"
                                    value="<?php echo $data["Phone3"] ?>" />
                            </div>
                            <div class="col-sm-4">
                                <label>Button Color:</label>
                                <input type="color" placeholder="Administrative Officer Ext.." class="form-control" name="txtPhone4"
                                    value="<?php echo $data["Phone4"] ?>" />
                            </div>
                        </div>
                        <div class="row hide">
                            <div class="col-sm-6 hide">
                                <label>Pinterest</label>
                                <input type="text" placeholder="Pinterest.." class="form-control" name="txtPinterest" value="<?php echo $data["Pinterest"] ?>" />
                            </div>
                            <div class="col-sm-6 hide">
                                <label>Dribbble</label>
                                <input type="text" placeholder="Dribbble URL.." class="form-control" name="txtDribbble" value="<?php echo $data["Dribbble"] ?>" />
                            </div>
                        </div>
                        <div class="row hide">
                            <div class="col-sm-6">
                                <label>Line ID (2)</label>
                                <input type="text" placeholder="Line ID (2).." class="form-control" name="txtLineID2" value="<?php echo $data["LineID2"] ?>" />
                            </div>
                            <div class="col-sm-6">
                                <label>Line URL (2)</label>
                                <input type="text" placeholder="Line URL (2).." class="form-control" name="txtLineIDURL2" value="<?php echo $data["LineIDURL2"] ?>" />
                            </div>
                        </div>
                        <div class="row hide">
                            <div class="col-sm-6 hide">
                                <label>Beetalk</label>
                                <input type="text" placeholder="Beetalk.." class="form-control require" name="txtBeetalk" value="<?php echo $data["Beetalk"] ?>" />
                            </div>
                            <div class="col-sm-6 hide">
                                <label>Whatsapp</label>
                                <input type="text" placeholder="Whatsapp.." class="form-control require" name="txtWhatsapp" value="<?php echo $data["Whatsapp"] ?>" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div>
                                    <span><b>Logo Header</b></span>
                                    <hr style="margin-top: 5px; margin-bottom: 5px;" />
                                    <p>
                                        <small class="text-danger">*ขนาดภาพที่เหมาะสมที่สุดคือ 169 x 144 pixels</small>
                                    </p>
                                    <img id="imge-preview" src="<?php echo (empty($data["Image"]) ? "https://dummyimage.com/190x44" : $data["Image"]) ?>" class="img-responsive hand" onclick="$(this).next().click();" style="width:auto;" />
                                    <input class="hide" type="file" onchange="$(this).validateUploadImage($('#imge-preview'));" name="fileUpload" id="fileUpload" accept="image/*" />
                                    <input type="hidden" name="hddBackUpImage" value="<?php echo $data["Image"] ?>" />
                                    <div class="text-center">
                                        <small>คลิกด้านบนรูปเพื่อเลือกรูปภาพ</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 hide">
                                <div>
                                    <span><b>Logo Footer</b></span>
                                    <hr style="margin-top: 5px; margin-bottom: 5px;" />
                                    <p>
                                        <small class="text-danger">*ขนาดภาพที่เหมาะสมที่สุดคือ 116 x 82 pixels</small>
                                    </p>
                                    <img id="imge-preview2" src="<?php echo (empty($data["Image2"]) ? "https://dummyimage.com/350x82" : $data["Image2"]) ?>" class="img-responsive hand" onclick="$(this).next().click();" style="width:auto;" />
                                    <input class="hide" type="file" onchange="$(this).validateUploadImage($('#imge-preview2'));" name="fileUpload2" id="fileUpload2" accept="image/*" />
                                    <input type="hidden" name="hddBackUpImage2" value="<?php echo $data["Image2"] ?>" />
                                    <div class="text-center">
                                        <small>คลิกด้านบนรูปเพื่อเลือกรูปภาพ</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <span><b>Logo favicon</b></span>
                                    <hr style="margin-top: 5px; margin-bottom: 5px;" />
                                    <p>
                                        <small class="text-danger">*ขนาดภาพที่เหมาะสมที่สุดคือ 50 x 50 pixels</small>
                                    </p>
                                    <img id="imge-preview3" src="<?php echo (empty($data["Image3"]) ? "https://dummyimage.com/350x82" : $data["Image3"]) ?>" class="img-responsive hand" onclick="$(this).next().click();" style="width:auto;" />
                                    <input class="hide" type="file" onchange="$(this).validateUploadImage($('#imge-preview3'));" name="fileUpload3" id="fileUpload3" accept="image/*" />
                                    <input type="hidden" name="hddBackUpImage3" value="<?php echo $data["Image3"] ?>" />
                                    <div class="text-center">
                                        <small>คลิกด้านบนรูปเพื่อเลือกรูปภาพ</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <span><b>QR Code Line</b></span>
                                    <hr style="margin-top: 5px; margin-bottom: 5px;" />
                                    <p>
                                        <small class="text-danger">*ขนาดภาพที่เหมาะสมที่สุดคือ 187 x 198 pixels</small>
                                    </p>
                                    <img id="imge-preview4" src="<?php echo (empty($data["Image4"]) ? "https://dummyimage.com/350x82" : $data["Image4"]) ?>" class="img-responsive hand" onclick="$(this).next().click();" style="width:auto;" />
                                    <input class="hide" type="file" onchange="$(this).validateUploadImage($('#imge-preview4'));" name="fileUpload4" id="fileUpload4" accept="image/*" />
                                    <input type="hidden" name="hddBackUpImage4" value="<?php echo $data["Image4"] ?>" />
                                    <div class="text-center">
                                        <small>คลิกด้านบนรูปเพื่อเลือกรูปภาพ</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 hide">
                                <div>

                                    <span><b>ไฟล์ให้ดาวน์โหลด</b></span>
                                    <hr style="margin-top: 5px; margin-bottom: 5px;" />
                                    <input type="file" name="txtFileUpload" value="" onchange="validateUploadFileUpload(this);" />

                                    <?php if (!empty($data["FileDownload"])) { ?>
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
                                </div>
                            </div>
                        </div>

                        <!-- <hr> -->
                        <div class="row">
                            <div class="col-sm-12">
                                <label>ที่อยู่ (แบบเต็ม)</label>
                                <textarea placeholder="ที่อยู่ (แบบเต็ม).." class="form-control" name="txtAddress"><?php echo $data["Address"] ?></textarea>
                            </div>
                        </div>
                        <div class="row hide">
                            <div class="col-sm-12">
                                <label>ที่อยู่ (แบบเต็ม) (EN)</label>
                                <textarea placeholder="ที่อยู่ (แบบเต็ม) (EN).." class="form-control" name="txtAddressEn"><?php echo $data["AddressEN"] ?></textarea>
                            </div>
                        </div>
                        <div class="row hide">
                            <div class="col-sm-12">
                                <label>Tag Manager</label>
                                <!-- <input type="text" class="form-control" name="cogs_google_tag_manager" placeholder=".." value="<?php //echo $data["cogs_google_tag_manager"] 
                                                                                                                                    ?>"> -->
                                <textarea placeholder="Tag Manager" class="form-control" name="cogs_google_tag_manager"><?php echo $data["cogs_google_tag_manager"] ?></textarea>
                            </div>
                        </div>
                        <div class="row hide">
                            <div class="col-sm-12">
                                <label>Facebook Pixel</label>
                                <textarea placeholder="Facebook Pixel" class="form-control" name="cogs_google_pixel"><?php echo $data["cogs_google_pixel"] ?></textarea>
                            </div>
                        </div>
                        <div class="row" style="display:flex;align-items:center;">
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
                        <div id="mapcheck" class="col-12">
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
                        <div class="panel-footer">
                            <small>สำหรับลูกค้าติดต่อเข้ามายังร้าน</small>
                        </div>
                    </div>

                    <hr>
                    <button type="submit" class="btn btn-success" onclick="return Validate(this);" name="btnSave">
                        <i class="fa fa-save"></i>
                        บันทึกการเปลี่ยนแปลง
                    </button>
                    <button type="reset" class="btn btn-warning" name="btnReset">
                        <i class="fa fa-refresh"></i>
                        ยกเลิกการเปลี่ยนแปลง
                    </button>
            </form>
        </div>
    </div>
</div>

<?php include  "footer.php"; ?>