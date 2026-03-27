<?php include_once "../assets/b4w-framework/UtilService.php"; ?>
<?php
    $imageCode = !empty($_POST["ref"]) ? $_POST["ref"] : $_HTML_EDITOR_CODE;
    $sql = "select * from gallery where ImageCode=:ImageCode";
    $data = SelectRow($sql,array("ImageCode" => $imageCode));
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">รายละเอียดวิดีโอ</h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div>
                <span><b>วิดีโอ<?php echo $_COG_ITEM_NAME ?></b></span>
                <hr style="margin-top: 5px; margin-bottom: 5px;" />
                <div class="row" style="padding-top: 10px;">
                    <div class="col-md-12">
                        <small>คลิกแก้ไขเพื่อเลือกวิดีโอใหม่</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 panel-video">
                        <div class="slide-banner image-box" style="height: 300px;">
                            <video class="slide-banner video-local-server" controls="" autoplay="" muted="" style="object-fit:cover;border-radius: 5px;width: 100%;height: 300px;">
                                <source src="<?php echo $data["ImagePath"] ?>">
                            </video>
                            <input class="hide" type="file" onchange="$(this).validateUploadVideo($('.video-local-server'));"
                            name="fileUploadChange" accept="video/*" />
                            <input type="hidden" name="hddBackUpImageChange" value="<?php echo $data["ImagePath"] ?>" />
                            <input type="hidden" name="hdfBackUpCategory" value="<?php echo $data["TypeCode"] ?>">
                            <i class="fa fa-pencil editer <?php echo !empty($data["ImagePath"]) ? "" : "hide" ?>" onclick="$(this).closest('.panel-video').find('input[type=file]').click();" style="right: 0px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-12">
            <div>
                <span><b>รูปโลโก้</b></span>
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
        <div class="col-sm-12 col-lg-12">
            <div>
                <span><b>ข้อมูลเพิ่มเติม<?php echo $_COG_ITEM_NAME ?></b></span>
                <hr style="margin-top: 5px; margin-bottom: 5px;" />
                <div class="row" style="padding-top: 10px;">
                    <div class="col-md-12">
                        <small>คำอธิบายเพิ่มเติมเกี่ยวกับภาพ</small>
                    </div>
                </div>
                <p class="">
                    <label>คำอธิบาย</label>
                    <textarea style="min-height:90px;" class="form-control input-sm" name="txtImageName"><?php echo $data["ImageName"] ?></textarea>
                </p>
                <p class="hide">
                    <label>คำอธิบาย 2</label>
                    <input type="text" class="form-control input-sm" name="txtImageName2" value="<?php echo $data["ImageName2"] ?>">
                </p>
                <p class="hide">
                    <label>รายละเอียดเพิ่มเติม</label>
                    <textarea style="min-height:90px;" class="form-control input-sm" name="txtImageName3"><?php echo $data["ImageName3"] ?></textarea>
                </p>
                <p class="hide">
                    <label>รายละเอียดเพิ่มเติม 2</label>
                    <textarea style="min-height:90px;" class="form-control input-sm" name="txtImageName4"><?php echo $data["ImageName4"] ?></textarea>
                </p>
                <p class="hide">
                    <label>ลิ้งเว็บ</label>
                    <input type="text" class="form-control input-sm" name="txtImageDetail" value="<?php echo $data["ImageDetail"] ?>" />
                </p>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" value="<?php echo $data["ImageCode"] ?>" class="btn btn-success" name="btnUpdateVideo">บันทึก</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
</div>