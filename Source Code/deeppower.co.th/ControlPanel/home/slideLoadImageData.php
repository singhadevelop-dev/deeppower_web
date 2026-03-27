<?php include_once "../assets/b4w-framework/UtilService.php"; ?>
<?php
    $imageCode = !empty($_POST["ref"]) ? $_POST["ref"] : $_HTML_EDITOR_CODE;
    $sql = "select * from gallery where ImageCode=:ImageCode";
    $data = SelectRow($sql,array("ImageCode" => $imageCode));
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">รายละเอียดรูปภาพ</h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div>
                <span><b>รูปภาพหลัก<?php echo $_COG_ITEM_NAME ?></b></span>
                <hr style="margin-top: 5px; margin-bottom: 5px;" />
                <div class="row" style="padding-top: 10px;">
                    <div class="col-md-12">
                        <small>คลิกด้านบนรูปเพื่อเลือกรูปภาพใหม่</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                            <div id="imge-preview-<?php echo $data["ImageCode"] ?>" class="image-box hand" onclick="$(this).next().click();"
                            style="width: 100%; height: 300px;object-fit: cover;margin-bottom:5px; background-image: url(<?php echo $data["ImagePath"] ?>), url('https://ipsumimage.appspot.com/1920x1080,eee')">
                        </div>
                        <input class="hide" type="file" onchange="$(this).validateUploadImage($('#imge-preview-<?php echo $data["ImageCode"] ?>'));"
                        name="fileUploadChange" accept="image/*" />
                        <input type="hidden" name="hddBackUpImageChange" value="<?php echo $data["ImagePath"] ?>" />
                        <input type="hidden" name="hdfBackUpCategory" value="<?php echo $data["TypeCode"] ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-12 hide">
            <div>
                <span><b>รูปโลโก้ <?php echo $_COG_ITEM_NAME ?></b></span>
                <hr style="margin-top: 5px; margin-bottom: 5px;" />
                <div class="row" style="padding-top: 10px;">
                    <div class="col-md-12">
                        <small>คลิกด้านบนรูปเพื่อเลือกรูปภาพใหม่</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-banner">
                            <div id="imge-preview2-<?php echo $data["ImageCode"] ?>" class="image-box hand" onclick="$(this).next().click();"
                                style="width: 100%; height: 300px;object-fit: cover;margin-bottom:5px; background-image: url(<?php echo $data["ImagePath2"] ?>), url('../assets/images/default/120x150.png');background-color: #f5f5f5de;">
                            </div>
                            <input class="hide" type="file" onchange="$(this).validateUploadImage($('#imge-preview2-<?php echo $data["ImageCode"] ?>'));$(this).closest('.panel-banner').find('.remover').removeClass('hide')"
                            name="fileUploadChange2" accept="image/*" />
                            <input type="hidden" name="hddBackUpImageChange2" value="<?php echo $data["ImagePath2"] ?>" />
                            <i class="fa fa-trash remover <?php echo empty($data["ImagePath2"]) ? "hide" : "" ?>" onclick="deleteImage(this);"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-12 hide">
            <div>
                <span><b>รูปพื้นหลัง<?php echo $_COG_ITEM_NAME ?></b></span>
                <hr style="margin-top: 5px; margin-bottom: 5px;" />
                <div class="row" style="padding-top: 10px;">
                    <div class="col-md-12">
                        <small>คลิกด้านบนรูปเพื่อเลือกรูปภาพใหม่</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-banner">
                            <div id="imge-preview3-<?php echo $data["ImageCode"] ?>" class="image-box hand" onclick="$(this).next().click();"
                                style="width: 100%; height: 300px;object-fit: cover;margin-bottom:5px; background-image: url(<?php echo $data["ImagePath3"] ?>), url('https://ipsumimage.appspot.com/1920x1080,eee')">
                            </div>
                            <input class="hide" type="file" onchange="$(this).validateUploadImage($('#imge-preview3-<?php echo $data["ImageCode"] ?>'));"
                            name="fileUploadChange3" accept="image/*" />
                            <input type="hidden" name="hddBackUpImageChange3" value="<?php echo $data["ImagePath3"] ?>" />
                            <i class="fa fa-trash remover <?php echo empty($data["ImagePath3"]) ? "hide" : "" ?>" onclick="deleteImage(this);"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-6 hide">
            <div>
                <span><b>รูปพื้นหลัง 3 <?php echo $_COG_ITEM_NAME ?></b></span>
                <hr style="margin-top: 5px; margin-bottom: 5px;" />
                <div class="row" style="padding-top: 10px;">
                    <div class="col-md-12">
                        <small>คลิกด้านบนรูปเพื่อเลือกรูปภาพใหม่</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                            <div id="imge-preview4-<?php echo $data["ImageCode"] ?>" class="image-box hand" onclick="$(this).next().click();"
                            style="width: 100%; height: 300px;object-fit: cover;margin-bottom:5px; background-image: url(<?php echo $data["ImagePath4"] ?>), url('https://ipsumimage.appspot.com/1920x1080,eee')">
                        </div>
                        <input class="hide" type="file" onchange="$(this).validateUploadImage($('#imge-preview4-<?php echo $data["ImageCode"] ?>'));"
                        name="fileUploadChange4" accept="image/*" />
                        <input type="hidden" name="hddBackUpImageChange4" value="<?php echo $data["ImagePath4"] ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-12">
            <div>
                <span><b>ข้อมูลเพิ่มเติม<?php echo $_COG_ITEM_NAME ?></b></span>
                <hr style="margin-top: 5px; margin-bottom: 5px;" />
                <div class="row" style="padding-top: 10px;">
                    <div class="col-md-12">
                        <small>คำอธิบายเพิ่มเติมเกี่ยวกับภาพ</small>
                    </div>
                </div>
                <p class="hide">
                    <label>หัวข้อ</label>
                    <!-- <input type="text" class="form-control input-sm" name="txtImageName" value="<?php //echo $data["ImageName"] ?>"> -->
                    <textarea style="min-height:90px;" class="form-control input-sm" name="txtImageName"><?php echo $data["ImageName"] ?></textarea>
                </p>
                <p class="">
                    <label>รายละเอียด</label>
                    <!-- <input type="text" class="form-control input-sm" name="txtImageName2" value="<?php //echo $data["ImageName2"] ?>" /> -->
                    <textarea style="min-height:90px;" class="form-control input-sm" name="txtImageName2"><?php echo $data["ImageName2"] ?></textarea>
                </p>
                <p class="hide">
                    <label>รายละเอียดเพิ่มเติม</label>
                    <textarea style="min-height:90px;" class="form-control input-sm" name="txtImageName3"><?php echo $data["ImageName3"] ?></textarea>
                </p>
                <p class="">
                    <label>ชื่อปุ๋ม</label>
                    <input type="text" class="form-control input-sm" name="txtImageName4" value="<?php echo $data["ImageName4"] ?>">
                    <!-- <textarea style="min-height:90px;" class="form-control input-sm" name="txtImageName4"><?php //echo $data["ImageName4"] ?></textarea> -->
                </p>
                <p class="">
                    <label>ลิ้งเว็บ</label>
                    <input type="text" class="form-control input-sm" name="txtImageDetail" value="<?php echo $data["ImageDetail"] ?>" />
                </p>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" value="<?php echo $data["ImageCode"] ?>" class="btn btn-success" name="btnUpdateImage">บันทึก</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
</div>