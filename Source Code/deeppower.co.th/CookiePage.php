<?php $_CURRENT_PAGE_CODE = "COOKIE" ?>
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

        <section class="layout-pt-lg layout-pb-lg">
            <div class="container">
                <div class="row justify-center">
                    <div class="col-xl-12 col-lg-12">
                        <?php IncludeDynamicPageHTML("WEBSITE_COOKIE", false); ?>
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