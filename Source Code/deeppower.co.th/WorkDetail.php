<?php $_CURRENT_PAGE_CODE = "WORK" ?>
<?php include_once "_cogs.php"; ?>
<?php include_once  $GLOBALS["DOCUMENT_ROOT"] . "/ControlPanel/assets/b4w-framework/UtilService.php"; ?>
<?php include_once  $GLOBALS["DOCUMENT_ROOT"] . "/ControlPanel/assets/b4w-framework/DataService.php"; ?>
<?php
$data = DataService::getInstance()->GetPortfolioByCode($_GET["ref"]);
$_tags = array();
$_tags_code = array();
$dataTags = DataService::getInstance()->GetTagMaster($_CURRENT_PAGE_CODE);
foreach ($dataTags as $tag) {
    if (strpos($data["Tag"], $tag["TagCode"]) !== false) {
        array_push($_tags, $tag["TagName"]);
        array_push($_tags_code, $tag["TagCode"]);
    }
}
$_CURRENT_PAGE_HEADER = array(
    'URL' => DetailPageURL($data["PortCode"], $data["PortName"]),
    'TITLE' => $data["PortName"] . (!empty($data["Title"]) ? "," . $data["Title"] : ""),
    'IMAGE' => $data["Image"],
    'DESCRIPTION' => !empty($data["Description"]) ? $data["Description"] : $data["ShortDescription"],
    'KEYWORD' => count($_tags) <= 0 ? $data["PortName"] : join(",", $_tags)
);
?>
<!DOCTYPE html>
<html lang="en" data-x="html" data-x-toggle="html-overflow-hidden">

<head>

    <?php include_once "_cogs_header.php"; ?>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/vendors.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/custom.css">

</head>

<body>

    <?php include("Header.php"); ?>

    <main>

        <!-- inner banner -->

        <section class="layout-pt-lg layout-pb-md bg-beige2 ">
            <div data-anim-wrap class="container">
                <div class="row justify-center text-center">
                    <div class="col-xl-8 col-lg-10">
                        <div data-split='lines' data-anim-child="split-lines delay-2">
                            <h2 class="text-64 text-green md:text-40 lh-11"><?php echo $data["PortName"] ?></h2>
                            <p class="mt-40"><?php echo ConvertNewLine($data["ShortDescription"]); ?></p>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section class="layout-pt-md md:pt-74">
            <div data-anim="slide-up delay-1" class="relative">
                <div class="js-section-slider-auto">
                    <div class="swiper-wrapper">

                        <?php
                        $index = 0;
                        $gallerys = DataService::getInstance()->GetGalleryMaster($data["PortCode"]);
                        foreach ($gallerys as $gallery) {
                            $index++;
                        ?>
                            <div class="swiper-slide w-auto">
                                <img src="<?php echo $gallery["ImagePath"]; ?>" alt="<?php echo $data["PortName"] ?>" class="">
                            </div>
                        <?php } ?>
                        <?php if ($index <= 0) { ?>
                            <div class="swiper-slide w-auto">
                                <img src="<?php echo $data["Image"] ?>" alt="<?php echo $data["PortName"] ?>" class="">
                            </div>
                        <?php } ?>

                    </div>
                </div>

                <div class="navAbsolute -type-3">
                    <button class="size-80 flex-center bg-accent-1-50 blur-1 rounded-full js-slider-auto-prev">
                        <i class="icon-arrow-left text-24 text-white"></i>
                    </button>

                    <button class="size-80 flex-center bg-accent-1-50 blur-1 rounded-full js-slider-auto-next">
                        <i class="icon-arrow-right text-24 text-white"></i>
                    </button>
                </div>
            </div>

            <div data-anim-wrap class="container">
                <div class="row y-gap-40 justify-between pt-100 sm:pt-50">
                    <div data-anim="slide-up delay-1" class="col-xl-12 col-lg-7">
                        <h1 class="text-64 md:text-40"><?php echo $data["PortName"] ?></h1>

                        <div class="line -horizontal bg-border mt-50 mb-50"></div>


                        <h2 class="text-40">Project Details</h2>
                        <div class="mt-40">
                            <?php echo IncludeDynamicPageHTML($data["PortDetail"], false) ?>
                        </div>

                        <div class="line -horizontal bg-border mt-50 mb-50"></div>
                        <h2 class="text-40">Project Overview</h2>
                        <div class="row x-gap-50 y-gap-20 pt-40">
                            <div class="col-sm-6">
                                <ul class="ulList -type-1">
                                    <li> <span style="font-weight: 600;">Client: </span><?php echo $data["Client"] ?></li>
                                    <li> <span style="font-weight: 600;">Project Type: </span><?php echo $data["PortDetail2"] ?></li>

                                </ul>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </section>

        <!-- similar work -->

        <section class="layout-pt-md layout-pb-lg">
            <div data-anim-wrap class="container">
                <div class="row y-gap-30 justify-between items-end">
                    <div data-anim-child="slide-up delay-1" class="col-auto">
                        <h2 class="text-64 md:text-40 lh-065">Related Posts</h2>
                    </div>

                    <div data-anim-child="slide-up delay-1" class="col-auto">
                        <a href="<?php echo $_Util_PageConfig->GetConfig("WORK")->PageURLName() ?>">
                            <button class="button -type-1">
                                <i class="-icon icon-arrow-circle-right text-30"></i>
                                VIEW ALL MORE
                            </button>
                        </a>
                    </div>
                </div>

                <div class="relative mt-100 sm:mt-50">
                    <div class="overflow-hidden js-section-slider" data-gap="30" data-slider-cols="xl-3 lg-3 md-2 sm-1 base-1" data-nav-prev="js-slider2-prev" data-nav-next="js-slider2-next">
                        <div class="swiper-wrapper">

                            <?php
                            $_datas = SelectRowsArray("select * from portfolio where Active = 1 and PortCode <> '" . $data["PortCode"] . "' and PortType = :PortType order by rand()", array("PortType" => $_CURRENT_PAGE_CODE));
                            foreach ($_datas as $_data) {
                                $_URL = DetailPageURL2($_data["PortName"]);
                            ?>
                                <div class="swiper-slide">
                                    <div data-anim-child="slide-up delay-4">
                                        <a href="<?php echo $_URL ?>" class="roomCard -type-2 -hover-button-center">
                                            <div class="roomCard__image -no-rounded ratio ratio-45:54 -hover-button-center__wrap">
                                                <img src="<?php echo $_data["Image"] ?>" alt="<?php echo $_data["PortName"] ?>" class="img-ratio">
                                            </div>
                                        </a>
                                    </div>

                                    <div class="roomCard__content mt-30">
                                        <div class="d-flex justify-between items-end">
                                            <h3 class="roomCard__title lh-065 text-40 md:text-24"><?php echo $_data["PortName"] ?></h3>
                                        </div>
                                    </div>

                                </div>
                            <?php } ?>

                        </div>
                    </div>

                    <div class="navAbsolute -type-2">
                        <button class="button -outline-accent-1 size-80 md:size-60 flex-center rounded-full js-slider2-prev">
                            <i class="icon-arrow-left text-24"></i>
                        </button>

                        <button class="button -outline-accent-1 size-80 md:size-60 flex-center rounded-full js-slider2-next">
                            <i class="icon-arrow-right text-24"></i>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <?php include("Footer.php"); ?>


    </main>

    <!-- JavaScript -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAz77U5XQuEME6TpftaMdX0bBelQxXRlM"></script>
    <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>

    <script src="js/vendors.js"></script>
    <script src="js/main.js"></script>
</body>

</html>