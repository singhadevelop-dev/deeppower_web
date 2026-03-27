<?php $_CURRENT_PAGE_CODE = "WORK" ?>
<?php include_once "_cogs.php"; ?>
<?php include_once  $GLOBALS["DOCUMENT_ROOT"] . "/ControlPanel/assets/b4w-framework/UtilService.php"; ?>
<?php

$_START = intval($_POST["start"]);
if ($_START <= 0) {
    $_START = 1;
}
$limitPage = 6;
$sItems = ($_START - 1) * $limitPage;

$values = array();
$values['PortType'] = $_CURRENT_PAGE_CODE;

$sql = "select count(*) as ItemCount from portfolio where PortType=:PortType and Active = 1";
$itemsCount = SelectRow($sql, $values);

$sql = "select * from portfolio where PortType=:PortType and Active = 1 order by SEQ,PortCode limit $sItems,$limitPage ";
$datas = SelectRowsArray($sql, $values);
$_ITEM_COUNT = intval($itemsCount["ItemCount"]);
$_TOTAL_PAGE = ceil(intval($itemsCount["ItemCount"]) / $limitPage);
?>
<div class="row x-gap-30 y-gap-60 pt-50 sm:pt-50">
    <?php
    foreach ($datas as $data) {
        $_URL = DetailPageURL2($data["PortName"]);

    ?>

        <div class="col-lg-4 col-md-6">
            <a href="<?php echo $_URL; ?>" class="roomCard -type-2 -hover-button-center">
                <div class="roomCard__image -no-rounded ratio ratio-45:54 -hover-button-center__wrap">
                    <img src="<?php echo $data["Image"]; ?>" alt="<?php echo $data["PortName"]; ?>" class="img-ratio">
                </div>

                <div class="roomCard__content mt-30">
                    <div class="d-flex justify-between items-end">
                        <h3 class="roomCard__title lh-065 text-40 md:text-24"><?php echo $data["PortName"]; ?></h3>
                    </div>
                    <p class="mt-20"><?php echo ConvertNewLine($data["ShortDescription"]); ?></p>
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
        $("#panel-port-item").load("WorkLoadData.php", {
            start: page,
        }, function() {
            AlertLoading(false);
        });
    }
</script>