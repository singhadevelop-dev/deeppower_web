<div>
    <span><b>เมนูข้อมูลตัวแทนจำหน่าย</b></span>
    <hr style="margin-top: 5px;margin-bottom:0" />
    <a class="left-group" data-det-group="ITEM" href="item.php">รายชื่อผู้จำหน่าย <i class="fa fa-caret-right pull-right"></i></a>
    <a class="left-group" data-det-group="CATEGORY" href="itemCategory.php">หมวดหมู่ผู้จำหน่าย <i class="fa fa-caret-right pull-right"></i></a>
</div>
<script>
    $(".left-group[data-det-group='<?php echo $_LEFT_MENU_ACTIVE; ?>']").addClass("active");
</script>