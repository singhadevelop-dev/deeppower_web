<?php $_CURRENT_PAGE_CODE = "BLOG" ?>
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

        if (!empty($_GET["tag"])) {
            $sqlCondition .= " and Tag like '%" . $_GET["tag"] . "%'";
        }
        ?>
        <!-- inner banner -->
        <?php $_banner = DataService::getInstance()->GetPortfolio("MASTERDETAIL-BLOG_BANNER")[0]; ?>
        <?php if ($_banner["Active"] == 1) { ?>
            <section class="layout-pt-lg layout-pb-md bg-beige2 ">
                <div data-anim-wrap class="container">
                    <div class="row justify-center text-center">
                        <div class="col-xl-8 col-lg-10">
                            <div data-split='lines' data-anim-child="split-lines delay-2">
                                <div class="text-15 uppercase mb-30 sm:mb-10">
                                    <?php echo $_banner["PortName"] ?>
                                </div>
                                <h2 class="text-64 md:text-40 text-green capitalize"><?php echo ConvertNewLine($_banner["ShortDescription"]) ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
        <!-- blogs list -->

        <section class="layout-pt-md layout-pb-md mb-40">
            <div class="container">

                <div id="panel-port-item">

                </div>

            </div>
        </section>

        <!-- cta -->
        <?php $_blog = DataService::getInstance()->GetPortfolio("MASTERDETAIL-BLOG")[0]; ?>
        <?php if ($_blog["Active"] == 1) { ?>
            <section class="cta -type-1 mb-60">
                <div class="cta__bg">
                    <img src="<?php echo $_blog["Image"] ?>" alt="<?php echo $_blog["PortName"] ?>">
                </div>

                <div class="container">
                    <div class="row justify-center text-center">
                        <div class="col-auto">
                            <h2 class="text-92 lg:text-64 md:text-30 text-white"><?php echo $_blog["PortName"] ?></h2>
                            <button onclick="window.location.href= '<?php echo $_Util_PageConfig->GetConfig('CONTACT')->PageURLName() ?>';" class="button -md -type-2 bg-accent-2 -accent-1 mx-auto mt-40">
                                GET A QUOTE NOW
                            </button>
                        </div>
                    </div>
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
            $("#panel-port-item").load("BlogLoadData.php", {
                condition: "<?php echo $sqlCondition ?>",
                start: 0,
            }, function() {
                AlertLoading(false);
            });
        }
    </script>
</body>

</html>