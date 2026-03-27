<?php $_CURRENT_PAGE_CODE = "BLOG" ?>
<?php include_once "_cogs.php"; ?>
<?php include_once  $GLOBALS["DOCUMENT_ROOT"] . "/ControlPanel/assets/b4w-framework/UtilService.php"; ?>
<?php

$sqlCondition = $_POST["condition"];
$_TAG = $_POST["tag"];

$_START = intval($_POST["start"]);
if ($_START <= 0) {
    $_START = 1;
}
$limitPage = 6;
$sItems = ($_START - 1) * $limitPage;

$values = array();
$values['PortType'] = $_CURRENT_PAGE_CODE;

$sql = "select count(*) as ItemCount from portfolio where PortType=:PortType $sqlCondition";
$itemsCount = SelectRow($sql, $values);

$sql = "select * from portfolio where PortType=:PortType $sqlCondition order by SEQ,PortCode limit $sItems,$limitPage ";
$datas = SelectRowsArray($sql, $values);
$_ITEM_COUNT = intval($itemsCount["ItemCount"]);
$_TOTAL_PAGE = ceil(intval($itemsCount["ItemCount"]) / $limitPage);
?>
<div class="row y-gap-85 x-gap-85">
    <?php
    foreach ($datas as $data) {
        $_URL = DetailPageURL2($data["PortName"]);

    ?>
        <div class="col-lg-4 col-md-6">
            <a href="<?php echo $_URL; ?>" class="baseCard -type-2">
                <div class="baseCard__image ratio ratio-41:50">
                    <img src="<?php echo $data["Image"]; ?>" alt="<?php echo $data["PortName"]; ?>" class="img-ratio">
                </div>

                <div class="baseCard__content mt-30">
                    <div class="row x-gap-10">
                        <div class="col-auto">
                            <?php echo ConvertDateDBToDateDisplayLongFormat($data["PortDateTime"], true) ?>
                        </div>
                    </div>
                    <h4 class="text-30 md:text-25 mt-15"><?php echo $data["PortName"]; ?></h4>
                    <p class="mt-15"><?php echo ConvertNewLine($data["ShortDescription"]); ?></p>
                    <div class="d-flex mt-20">
                        <a href="<?php echo $_URL; ?>">
                            <button class="button -type-1">
                                <i class="-icon">
                                    <svg width="50" height="30" viewBox="0 0 50 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M35.8 28.0924C43.3451 28.0924 49.4616 21.9759 49.4616 14.4308C49.4616 6.88577 43.3451 0.769287 35.8 0.769287C28.255 0.769287 22.1385 6.88577 22.1385 14.4308C22.1385 21.9759 28.255 28.0924 35.8 28.0924Z" stroke="#122223" />
                                        <path d="M33.4808 10.2039L32.9985 10.8031L37.2931 14.2623H0.341553V15.0315H37.28L33.0008 18.4262L33.4785 19.0285L39 14.6492L33.4808 10.2039Z" fill="#122223" />
                                    </svg>
                                </i>
                                READ MORE
                            </button>
                        </a>
                    </div>
                </div>
            </a>
        </div>
    <?php } ?>
</div>

<div class="pagination -type-2 justify-center pt-50">
    <div class="pagination__count">
        <?php
        $output = '';
        if ($_START == 1) {
            $output = $output . '<a href="javascript:;" class="page-item page-item-prev disabled"><i class="icon-arrow-left"></i></a>';
        } else {
            $prev = $_START - 1;
            $output = $output . '<a href="javascript:;" class="page-item page-item-prev" data-page="' . $prev . '"><i class="icon-arrow-left"></i></a>';
        }

        if (($_START - 3) > 0) {
            $output = $output . '<a href="javascript:;" class="page-item page-item-click" aria-current="page" data-page="1">1</a>';
        }
        if (($_START - 3) > 1) {
            $output = $output . '<div class="page-item">...</div>';
        }

        for ($i = ($_START - 2); $i <= ($_START + 2); $i++) {
            if ($i < 1) {
                continue;
            }
            if ($i > $_TOTAL_PAGE) {
                break;
            }
            if ($_START == $i) {
                $output = $output . '<a href="javascript:;" class="page-item page-item-click is-active" data-page="' . $i . '">' . $i . '</a>';
            } else {
                $output = $output . '<a href="javascript:;" class="page-item page-item-click" data-page="' . $i . '">' . $i . '</a>';
            }
        }

        if (($_TOTAL_PAGE - ($_START + 2)) > 1) {
            $output = $output . '<div class="page-item">...</div>';
        }
        if (($_TOTAL_PAGE - ($_START + 2)) > 0) {
            if ($_START == $_TOTAL_PAGE) {
                $output = $output . '<a href="javascript:;" class="page-item page-item-click" data-page="' . ($_TOTAL_PAGE) . '">' . ($_TOTAL_PAGE) . '</a>';
            } else {
                $output = $output . '<a href="javascript:;" class="page-item page-item-click" data-page="' . ($_TOTAL_PAGE) . '">' . ($_TOTAL_PAGE) . '</a>';
            }
        }

        if ($_START == $_TOTAL_PAGE) {
            $output = $output . '<a href="javascript:;" class="page-item page-item-prev disabled"><i class="icon-arrow-right"></i></a>';
        } else {
            $next = $_START + 1;
            $output = $output . '<a href="javascript:;" class="page-item page-item-prev" data-page="' . $next . '"><i class="icon-arrow-right"></i></a>';
        }
        echo $output;
        ?>
    </div>
</div>

<script>
    $(".page-item-click").click(function() {
        var page = $(this).attr("data-page");
        loadItemsPage(page);
    });

    $(".page-item-prev, .page-item-next").click(function() {
        if ($(this).hasClass('disabled')) {
            return;
        }
        var page = $(this).attr("data-page");
        loadItemsPage(page);
    });

    function loadItemsPage(page) {
        AlertLoading(true, "Data Loading");
        $("#panel-port-item").load("BlogLoadData.php", {
            condition: "<?php echo $_POST["condition"] ?>",
            start: page,
        }, function() {
            AlertLoading(false);
        });
    }
</script>