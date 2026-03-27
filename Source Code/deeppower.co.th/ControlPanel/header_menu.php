<div class="analysis-left-group">
    เมนูจัดการ
</div>
<div class="overflow-left-bar-x">

    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/" data-key="HOME" class="analysis-left-menu">
        <i class="fa fa-home fa-fw"></i>
        <span class="analysis-left-menu-desc">จัดการเว็บไซต์ทั่วไป</span>
    </a>
    <?php if ($__COGS_GLOBAL_CART) { ?>
        <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/order/payment.php" data-key="ORDER" class="analysis-left-menu hide">
            <i class="fa fa-shopping-cart fa-fw"></i>
            <span class="analysis-left-menu-desc">ช่องทางชำระเงิน</span>
        </a>
        <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/order/delivery.php" data-key="DELIVERY" class="analysis-left-menu hide">
            <i class="fa fa-truck fa-fw"></i>
            <span class="analysis-left-menu-desc">การจัดส่ง</span>
        </a>
        <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/delivery/" data-key="DELIVERY" class="analysis-left-menu hide">
            <i class="fa fa-truck fa-fw"></i>
            <span class="analysis-left-menu-desc">การจัดส่ง</span>
        </a>
    <?php } ?>
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/pageConfig/page.php" data-key="CONFIG_PAGE" class="analysis-left-menu">
        <i class="fa fa-file-text-o fa-fw"></i>
        <span class="analysis-left-menu-desc">ตั้งค่าหน้าเพจ</span>
    </a>
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/blogEditorPage/category/masterDetail.php" data-key="CATEGORY" class="analysis-left-menu">
        <i class="fa fa-cube fa-fw"></i>
        <span class="analysis-left-menu-desc">หมวดหมู่สินค้า</span>
    </a>
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/blogEditorPage/gallery/masterDetail.php" data-key="GALLERY" class="analysis-left-menu">
        <i class="fa fa-file-picture-o fa-fw"></i>
        <span class="analysis-left-menu-desc">Gallery</span>
    </a>
</div>

<div class="analysis-left-group">
    เมนูหน้าแรก
</div>
<div class="overflow-left-bar-x">
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/blogEditorPage/hbanner/masterDetail.php" data-key="HOME_BANNER" class="analysis-left-menu">
        <i class="fa fa-trademark fa-fw"></i>
        <span class="analysis-left-menu-desc">แบนเนอร์</span>
    </a>
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/blogEditorPage/habout/masterDetail.php" data-key="HOME_ABOUT" class="analysis-left-menu">
        <i class="fa fa-info-circle fa-fw"></i>
        <span class="analysis-left-menu-desc">About</span>
    </a>
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/blogEditorPage/hproduct/masterDetail.php" data-key="HOME_PRODUCT" class="analysis-left-menu">
        <i class="fa fa-cube fa-fw"></i>
        <span class="analysis-left-menu-desc">สินค้าขายดี</span>
    </a>
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/blogEditorPage/hwhy/masterDetail.php" data-key="HOME_WHY" class="analysis-left-menu">
        <i class="fa fa-question-circle fa-fw"></i>
        <span class="analysis-left-menu-desc">Why Choose Us</span>
    </a>
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/blogEditorPage/hwork/masterDetail.php" data-key="HOME_WORK" class="analysis-left-menu">
        <i class="fa fa-navicon fa-fw"></i>
        <span class="analysis-left-menu-desc">Our Work</span>
    </a>
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/blogEditorPage/hblog/masterDetail.php" data-key="HOME_BLOG" class="analysis-left-menu">
        <i class="fa fa-newspaper-o fa-fw"></i>
        <span class="analysis-left-menu-desc">Blog</span>
    </a>
</div>

<div class="analysis-left-group">
    เมนู About
</div>
<div class="overflow-left-bar-x">
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/blogEditorPage/about/masterDetail.php" data-key="ABOUT" class="analysis-left-menu">
        <i class="fa fa-info-circle fa-fw"></i>
        <span class="analysis-left-menu-desc">About</span>
    </a>
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/blogEditorPage/about2/masterDetail.php" data-key="ABOUT2" class="analysis-left-menu">
        <i class="fa fa-info-circle fa-fw"></i>
        <span class="analysis-left-menu-desc">About 2</span>
    </a>
</div>

<div class="analysis-left-group">
    เมนู Product
</div>
<div class="overflow-left-bar-x">
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/blogEditorPage/pbanner/masterDetail.php" data-key="PRODUCT_BANNER" class="analysis-left-menu">
        <i class="fa fa-trademark fa-fw"></i>
        <span class="analysis-left-menu-desc">แบนเนอร์</span>
    </a>
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/product/product.php" data-key="PRODUCT" class="analysis-left-menu">
        <i class="fa fa-cube fa-fw"></i>
        <span class="analysis-left-menu-desc">Product</span>
    </a>
</div>

<div class="analysis-left-group">
    เมนู Service
</div>
<div class="overflow-left-bar-x">
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/blogEditorPage/sbanner/masterDetail.php" data-key="SERVICE_BANNER" class="analysis-left-menu">
        <i class="fa fa-trademark fa-fw"></i>
        <span class="analysis-left-menu-desc">แบนเนอร์</span>
    </a>
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/blogEditorPage/service/item.php" data-key="SERVICE" class="analysis-left-menu">
        <i class="fa fa-navicon fa-fw"></i>
        <span class="analysis-left-menu-desc">Service</span>
    </a>
</div>

<div class="analysis-left-group">
    เมนู Our Work
</div>
<div class="overflow-left-bar-x">
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/blogEditorPage/wbanner/masterDetail.php" data-key="WORK_BANNER" class="analysis-left-menu">
        <i class="fa fa-trademark fa-fw"></i>
        <span class="analysis-left-menu-desc">แบนเนอร์</span>
    </a>
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/blogEditorPage/work/item.php" data-key="WORK" class="analysis-left-menu">
        <i class="fa fa-navicon fa-fw"></i>
        <span class="analysis-left-menu-desc">Our Work</span>
    </a>
</div>

<div class="analysis-left-group">
    เมนู Blog
</div>
<div class="overflow-left-bar-x">
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/blogEditorPage/bbanner/masterDetail.php" data-key="BLOG_BANNER" class="analysis-left-menu">
        <i class="fa fa-trademark fa-fw"></i>
        <span class="analysis-left-menu-desc">แบนเนอร์</span>
    </a>
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/blogEditorPage/blog/item.php" data-key="BLOG" class="analysis-left-menu">
        <i class="fa fa-newspaper-o fa-fw"></i>
        <span class="analysis-left-menu-desc">Blog</span>
    </a>
</div>

<div class="analysis-left-group">
    เมนู Contact
</div>
<div class="overflow-left-bar-x">
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/blogEditorPage/cbanner/masterDetail.php" data-key="CONTACT_BANNER" class="analysis-left-menu">
        <i class="fa fa-trademark fa-fw"></i>
        <span class="analysis-left-menu-desc">แบนเนอร์</span>
    </a>
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/blogEditorPage/contact/masterDetail.php" data-key="CONTACT" class="analysis-left-menu">
        <i class="fa fa-phone fa-fw"></i>
        <span class="analysis-left-menu-desc">Contact</span>
    </a>
</div>


<div class="analysis-left-group">
    เมนูทำรายการ
</div>
<?php if ($__COGS_GLOBAL_CART) { ?>
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/transaction/" data-key="TRANSACTION_LIST" class="analysis-left-menu hide">
        <i class="fa fa-money fa-fw"></i>
        <span class="analysis-left-menu-desc">รายการสั่งซื้อ</span>
    </a>
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/transaction/transaction.php" data-key="TRANSACTION" class="analysis-left-menu hide">
        <i class="fa fa-dollar fa-fw"></i>
        <span class="analysis-left-menu-desc">รายการสั่งซื้อทั้งหมด</span>
    </a>
<?php } ?>

<?php if ($__COGS_GLOBAL_MEMBER) { ?>
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/user/" data-key="MEMBER" class="analysis-left-menu hide">
        <i class="fa fa-users fa-fw"></i>
        <span class="analysis-left-menu-desc">ข้อมูลสมาชิก</span>
    </a>
<?php } ?>

<a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/transaction/payment.php" data-key="PAYMENT_ACTION" class="analysis-left-menu hide">
    <i class="fa fa-user fa-fw"></i>
    <span class="analysis-left-menu-desc">ผู้เข้ามาแจ้งชำระ</span>
</a>
<a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/contact/contact.php" data-key="CONTACT_ACTION" class="analysis-left-menu">
    <i class="fa fa-user fa-fw"></i>
    <span class="analysis-left-menu-desc">ผู้เข้ามาติดต่อ</span>
</a>
<a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/register/register.php" data-key="REGISTER" class="analysis-left-menu hide">
    <i class="fa fa-file fa-fw"></i>
    <span class="analysis-left-menu-desc">ผู้ติดต่อสั่งซื้อสินค้า</span>
</a>
<a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/register/sampleform.php" data-key="SAMPLE" class="analysis-left-menu hide">
    <i class="fa fa-question-circle fa-fw"></i>
    <span class="analysis-left-menu-desc">ติดต่อสอบถาม</span>
</a>
<a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/contact/subscribe.php" data-key="SUBSCRIBE" class="analysis-left-menu hide">
    <i class="fa fa-eye fa-fw"></i>
    <span class="analysis-left-menu-desc">Subscribe</span>
</a>
<a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/contact/career.php" data-key="CAREER_ACTION" class="analysis-left-menu hide">
    <i class="fa fa-graduation-cap fa-fw"></i>
    <span class="analysis-left-menu-desc">ผู้สมัครงาน</span>
</a>
<a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/question/answer.php" data-key="ANSWER_ACTION" class="analysis-left-menu hide">
    <i class="fa fa-wpforms fa-fw"></i>
    <span class="analysis-left-menu-desc">คำตอบแบบสอบถาม</span>
</a>
<?php if ($__COGS_GLOBAL_CART) { ?>
    <div class="analysis-left-group hide">
        รายงาน
    </div>
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/report/reporttotalpay.php" data-key="SALE_REPORT" class="analysis-left-menu hide">
        <i class="fa fa-bar-chart fa-fw"></i>
        <span class="analysis-left-menu-desc">รายงานยอดขาย</span>
    </a>
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/report/reportsummary.php" data-key="SALE_TOTAL" class="analysis-left-menu hide">
        <i class="fa fa-bar-chart fa-fw"></i>
        <span class="analysis-left-menu-desc">รายงานสรุปยอดขาย</span>
    </a>
<?php } ?>
<?php if (UserService::_IsSuperAdmin()) { ?>
    <div class="analysis-left-group">
        เมนูคอนฟิกระบบ
    </div>
    <a href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/index_cogs.php" class="analysis-left-menu">
        <i class="fa fa-cogs fa-fw"></i>
        <span class="analysis-left-menu-desc">คอนฟิกระบบ</span>
    </a>
<?php } ?>

<script>
    $(document).ready(function() {
        <?php
        if (!empty($_COG_ITEM_CODE)) { ?>
            $("a.analysis-left-menu[data-key='<?php echo $_COG_ITEM_CODE ?>']").addClass("active");
        <?php } else { ?>
            var url = window.location.href;
            var targets = $("a.analysis-left-menu");
            targets.sort(function(a, b) {
                return $(b).attr("href").length - $(a).attr("href").length;
            });
            $(targets).each(function(index) {
                if (url.indexOf($(this).attr("href")) > -1) {
                    $(this).addClass("active");
                    return false;
                }
            });
        <?php } ?>
        $(".mat-box.analysis-left").animate({
            scrollTop: $(".analysis-left-menu.active").offset().top - 95
        }, 400);
    });
</script>