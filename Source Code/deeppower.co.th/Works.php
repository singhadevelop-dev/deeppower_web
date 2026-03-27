<?php $_CURRENT_PAGE_CODE = "WORK" ?>
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

        <!-- inner banner -->
        <?php $_banner = DataService::getInstance()->GetPortfolio("MASTERDETAIL-WORK_BANNER")[0]; ?>
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

        <section class="layout-pb-lg">
            <div class="container">

                <div id="panel-port-item">

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
    <script>
        $(document).ready(function() {
            _load_port_items();
        });

        function _load_port_items() {
            AlertLoading(true, "Data Loading");
            $("#panel-port-item").load("WorkLoadData.php", {
                start: 0,
            }, function() {
                AlertLoading(false);
            });
        }
    </script>
</body>

</html>