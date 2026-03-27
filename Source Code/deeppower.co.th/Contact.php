<?php $_CURRENT_PAGE_CODE = "CONTACT" ?>
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
        <?php $_banner = DataService::getInstance()->GetPortfolio("MASTERDETAIL-CONTACT_BANNER")[0]; ?>
        <?php if ($_banner["Active"] == 1) { ?>
            <section class="layout-pt-lg layout-pb-md bg-beige2 ">
                <div data-anim-wrap class="container">
                    <div class="row justify-center text-center">
                        <div class="col-xl-8 col-lg-10">
                            <div data-split='lines' data-anim-child="split-lines delay-2">
                                <div class="text-15 uppercase mb-30 sm:mb-10"><?php echo $_banner["PortName"] ?></div>
                                <h2 class="text-64 md:text-40 text-green capitalize"><?php echo ConvertNewLine($_banner["ShortDescription"]) ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
        <!-- form -->

        <section class="layout-pt-md layout-pb-lg">
            <div class="container">
                <div class="row justify-center text-center">
                    <div class="col-xl-8 col-lg-10">

                        <?php $_contact = DataService::getInstance()->GetPortfolio("MASTERDETAIL-CONTACT")[0]; ?>
                        <?php if ($_contact["Active"] == 1) { ?>
                            <h2 class="text-64 md:text-40 capitalize"><?php echo $_contact["PortName"] ?></h2>
                            <p class="lh-17 mt-30"><?php echo ConvertNewLine($_contact["ShortDescription"]) ?></p>
                        <?php } ?>

                        <form id="contact-form" class="contactForm row y-gap-30 pt-60">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="first_name" required="" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="tel" class="form-control" name="phone" required="" placeholder="Phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" required="" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="subject" required="" placeholder="Subject">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="border-1" rows="8" name="message" placeholder="Comment / Details"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="button -md -type-2 w-1/1 bg-accent-2 -accent-1">SEND YOUR MESSAGE</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>

        <section class="relative layout-pt-lg layout-pb-lg md:pt-0 bg-accent-1">
            <div class="sectionBg col-md-6 -left z-1">
                <div class="h-full md:h-map md: mb-40">
                    <iframe src="https://www.google.com/maps/embed?pb=<?php echo $_Util_WebsitDetail["MapLocation"] ?>" width="100%" height="756" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <div class="container">
                <div class="row justify-end">
                    <div class="col-md-5">
                        <div class="text-15 text-white">Deep Power Co., Ltd.</div>
                        <h2 class="text-64 md:text-40 mt-30 text-white">Location</h2>
                        <div class="text-white mt-30">
                            <div><?php echo $_Util_WebsitDetail["Address"] ?></div>
                            <br>
                            <div><a href="mailto:<?php echo $_Util_WebsitDetail["Email"] ?>"><?php echo $_Util_WebsitDetail["Email"] ?></a></div>
                            <div><a href="tel:<?php echo $_Util_WebsitDetail["Phone"] ?>"><?php echo $_Util_WebsitDetail["Phone"] ?></a>, <a href="tel:<?php echo $_Util_WebsitDetail["MobilePhone"] ?>"><?php echo $_Util_WebsitDetail["MobilePhone"] ?></a></div>
                        </div>

                        <a href="<?php echo $_Util_WebsitDetail["WebUrl"] ?>" target="_blank">
                            <button class="button -md -type-2 bg-accent-2 -light-1 mt-40">
                                Get Directions
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <?php $_gallery = DataService::getInstance()->GetPortfolio("MASTERDETAIL-GALLERY")[0]; ?>
        <?php if ($_gallery["Active"] == 1) { ?>
            <section data-anim-wrap class="layout-pt-lg layout-pb-md">
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
        $("#contact-form").submit(function() {
            AlertLoading(true, "Send message");
            var dataFrom = new FormData($("#contact-form")[0]);
            PostFormDataAPI("ControlPanel/api/contact/", dataFrom, function(data, method, ele) {

                if (data.status == "OK") {
                    $('#contact-form')[0].reset();
                    AlertSuccess("Send success");
                } else {
                    AlertError(data.message == undefined ? data : data.message);
                }
                AlertLoading(false);
            });
            return false;
        });
    </script>
</body>

</html>