<?php $_CURRENT_PAGE_CODE = "SERVICE" ?>
<?php include_once "_cogs.php"; ?>
<?php include_once  $GLOBALS["DOCUMENT_ROOT"] . "/ControlPanel/assets/b4w-framework/UtilService.php"; ?>
<?php include_once  $GLOBALS["DOCUMENT_ROOT"] . "/ControlPanel/assets/b4w-framework/DataService.php"; ?>
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
        <?php
        $sqlCondition = " and Active = 1";

        if (!empty($_GET["cat"])) {
            $sqlCondition .= " and CategoryCode = '" . $_GET["cat"] . "'";
        }
        ?>
        <!-- inner banner -->

        <?php $_banner = DataService::getInstance()->GetPortfolio("MASTERDETAIL-SERVICE_BANNER")[0]; ?>
        <?php if ($_banner["Active"] == 1) { ?>
            <section class="layout-pt-lg layout-pb-md bg-beige2 ">
                <div data-anim-wrap class="container">
                    <div class="row justify-center text-center">
                        <div class="col-xl-8 col-lg-10">
                            <div data-split='lines' data-anim-child="split-lines delay-2">
                                <h2 class="text-64 text-green md:text-40 lh-11">
                                    <?php echo $_banner["PortName"] ?>
                                </h2>
                                <p class="mt-40"><?php echo ConvertNewLine($_banner["ShortDescription"]) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>

        <section class="layout-pb-md">
            <div class="container">
                <div id="panel-port-item">

                </div>
            </div>
        </section>

        <?php $_gallery = DataService::getInstance()->GetPortfolio("MASTERDETAIL-GALLERY")[0]; ?>
        <?php if ($_gallery["Active"] == 1) { ?>
            <section data-anim-wrap class="layout-pb-md">
                <div class="container">
                    <div class="row y-gap-30 justify-center text-center">
                        <div data-anim-child="slide-up delay-1" class="col-xl-4 col-lg-6">
                            <h2 class="text-64 md:text-40"><?php echo $_gallery["PortName"] ?></h2>
                        </div>
                    </div>
                </div>

                <div class="imageGrid -type-2">

                    <?php
                    $index = 0;
                    $gallerys = DataService::getInstance()->GetGalleryMaster("GALLERY");
                    foreach ($gallerys as $gallery) {
                        $index++;
                    ?>
                        <div class="imageGrid__item">
                            <div data-anim-child="img-right cover-white delay-2">
                                <a href="javascript:;" class="ratio ratio-1:1">
                                    <img src="<?php echo $gallery["ImagePath"]; ?>" alt="<?php echo $_gallery["PortName"] ?>" class="img-ratio">
                                </a>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </section>
        <?php } ?>

        <?php include("Footer.php"); ?>


    </main>

    <!-- JavaScript -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAz77U5XQuEME6TpftaMdX0bBelQxXRlM"></script>
    <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>

    <script src="js/vendors.js"></script>
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function() {
            _load_port_items();
        });

        function _load_port_items() {
            AlertLoading(true, "Data Loading");
            $("#panel-port-item").load("ServiceLoadData.php", {
                condition: "<?php echo $sqlCondition ?>",
                start: 0,
            }, function() {
                AlertLoading(false);
            });
        }
    </script>
</body>

</html>