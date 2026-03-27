<?php include "../assets/b4w-framework/UtilService.php"; ?>
 
<?php 
$__TYPE = $_GET["type"];
$__REFCODE = $_GET["ref"];
if($__TYPE == "DISTRICT"){
?>
    <option value="">ไม่ระบุ</option>
    <?php
        $sql = " select DistrictCode,DistrictName from area_district where Active=1 and ProvinceCode= :ProvinceCode ";
        $datas = SelectRowsArray($sql, array('ProvinceCode' => $__REFCODE));
        foreach ($datas as $data) {
    ?>
        <option value="<?php echo $data["DistrictCode"] ?>"><?php echo $data["DistrictName"] ?></option>
    <?php } ?>

<?php } ?>

