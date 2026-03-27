<?php $_CURRENT_PAGE_CODE = "SERVICE" ?>
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

    <section class="layout-pt-lg">
      <div data-anim-wrap class="container">
        <div class="row justify-center text-center">
          <div class="col-xl-8 col-lg-10">
            <div data-split='lines' data-anim-child="split-lines delay-2">
              <div class="text-15 uppercase mb-20"><?php echo $_Util_PageConfig->GetConfig("SERVICE")->PageName() ?></div>

              <h2 class="text-64 lg:text-50 md:text-40"><?php echo $data["PortName"] ?></h2>

              <p class="lh-18 mt-40 md:mt-30"><?php echo ConvertNewLine($data["ShortDescription"]); ?></p>
            </div>

            <div data-anim-child="slide-up delay-7" class="d-flex justify-center mt-40">
              <button onclick="window.location.href= '<?php echo $_Util_PageConfig->GetConfig('CONTACT')->PageURLName() ?>';" class="button -md -type-2 -accent-1 bg-accent-2">CONTACT US</button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="layout-pt-md px-60 sm:px-0">
      <div data-anim-wrap class="relative">
        <div class="overflow-hidden js-section-slider" data-gap="15" data-slider-cols="xl-4 lg-3 md-2 sm-1 base-1" data-loop data-nav-prev="js-slider1-prev" data-nav-next="js-slider1-next">
          <div class="swiper-wrapper">

            <?php
            $index = 0;
            $gallerys = DataService::getInstance()->GetGalleryMaster($data["PortCode"]);
            foreach ($gallerys as $gallery) {
              $index++;
            ?>
              <div class="swiper-slide">
                <div class="ratio ratio-44:60" data-anim-child="img-right cover-white delay-2">
                  <img src="<?php echo $gallery["ImagePath"]; ?>" alt="<?php echo $data["PortName"] ?>" class="img-ratio">
                </div>
              </div>
            <?php } ?>
            <?php if ($index <= 0) { ?>
              <div class="swiper-slide">
                <div class="ratio ratio-44:60" data-anim-child="img-right cover-white delay-2">
                  <img src="<?php echo $data["Image"] ?>" alt="<?php echo $data["PortName"] ?>" class="img-ratio">
                </div>
              </div>
            <?php } ?>

          </div>
        </div>

        <div class="navAbsolute -type-3">
          <button class="size-80 flex-center bg-accent-1-50 blur-1 rounded-full js-slider1-prev">
            <i class="icon-arrow-left text-24 text-white"></i>
          </button>

          <button class="size-80 flex-center bg-accent-1-50 blur-1 rounded-full js-slider1-next">
            <i class="icon-arrow-right text-24 text-white"></i>
          </button>
        </div>
      </div>
    </div>

    <section class="layout-pt-lg layout-pb-lg">
      <div class="container">
        <div class="row justify-center">
          <div class="col-xl-8 col-lg-10">
            <?php echo IncludeDynamicPageHTML($data["PortDetail"], false) ?>
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