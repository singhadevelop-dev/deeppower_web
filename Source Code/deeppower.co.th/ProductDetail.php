<?php $_CURRENT_PAGE_CODE = "PRODUCT" ?>
<?php include_once "_cogs.php"; ?>
<?php include_once  $GLOBALS["DOCUMENT_ROOT"] . "/ControlPanel/assets/b4w-framework/UtilService.php"; ?>
<?php include_once  $GLOBALS["DOCUMENT_ROOT"] . "/ControlPanel/assets/b4w-framework/DataService.php"; ?>
<?php
$product = DataService::getInstance()->GetProduct("", $_GET["ref"])[0];
$_tags = array();
$dataTags = DataService::getInstance()->GetTagMaster($_CURRENT_PAGE_CODE);
foreach ($dataTags as $tag) {
  if (strpos($product["Tag"], $tag["TagCode"]) !== false) {
    array_push($_tags, $tag["TagName"]);
  }
}

$_CURRENT_PAGE_HEADER = array(
  'URL' => DetailPageURL($product["ProductCode"], $product["ProductName"]),
  'TITLE' => !empty($product["Title"]) ? $product["Title"] : $product["ProductName"],
  'IMAGE' => $product["Image"],
  'DESCRIPTION' => !empty($product["Description"]) ? $product["Description"] : $product["ShortDescription"],
  'KEYWORD' => !empty($product["Keyword"]) ? $product["Keyword"] : join(",", $_tags)
);

$__REF_CAT = $product["CategoryCode"];

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
              <div class="text-15 uppercase mb-30 sm:mb-10"><?php echo $_Util_PageConfig->GetConfig($_CURRENT_PAGE_CODE)->PageName() ?></div>
              <h2 class="text-64 md:text-40 text-green capitalize"><?php echo $product["ProductName"] ?></h2>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- content -->

    <section class="layout-pt-md">
      <div data-anim-wrap class="container">

        <div data-anim-child="slide-up delay-4" class="row pt-10 md:pt-30">
          <div class="col-12">
            <div class="roomsSingleGrid -type-1">
              <?php
              $index = 0;
              $gallerys = DataService::getInstance()->GetGalleryMaster($product["ProductCode"]);
              foreach ($gallerys as $gallery) {
                $index++;
              ?>
                <img src="<?php echo $gallery["ImagePath"]; ?>" alt="<?php echo $product["ProductName"]; ?>">
              <?php } ?>
              <?php if ($index <= 0) { ?>
                <img src="<?php echo $product["Image"]; ?>" alt="<?php echo $product["ProductName"]; ?>">
              <?php } ?>

            </div>
          </div>
        </div>

        <div class="row y-gap-40 justify-between pt-50">
          <div class="col-xl-12 col-lg-12">
            <h2 class="text-40"><?php echo $product["ProductName"]; ?></h2>

            <div class="mt-40"><?php IncludeDynamicPageHTML($product["ProductDetail"], false) ?></div>
          </div>

        </div>
      </div>
    </section>

    <section class="layout-pt-lg layout-pb-lg">
      <div data-anim-wrap class="container">
        <div class="row y-gap-30 justify-between items-end">
          <div data-anim-child="slide-up delay-1" class="col-auto">
            <h2 class="text-64 md:text-40 lh-065">Related Products</h2>
          </div>

          <div data-anim-child="slide-up delay-1" class="col-auto">
            <a href="<?php echo $_Util_PageConfig->GetConfig("PRODUCT")->PageURLName() ?>">
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
              $_datas = SelectRowsArray("select * from product where Active = 1 and ProductCode <> '' and CategoryCode = :CategoryCode order by rand()", array("CategoryCode" => $product["CategoryCode"]));
              foreach ($_datas as $_data) {
                $_URL = DetailPageURL($_data["ProductCode"], $_data["ProductName"]);
              ?>
                <div class="swiper-slide">
                  <div data-anim-child="slide-up delay-4">
                    <a href="<?php echo $_URL; ?>" class="roomCard -type-2 -hover-button-center">
                      <div class="roomCard__image -no-rounded ratio ratio-45:54 -hover-button-center__wrap">
                        <img src="<?php echo $_data["Image"] ?>" alt="<?php echo $_data["ProductName"] ?>" class="img-ratio">
                      </div>

                      <div class="roomCard__content mt-30">
                        <div class="d-flex justify-between items-end">
                          <h3 class="roomCard__title lh-065 text-40 md:text-24"><?php echo $_data["ProductName"] ?></h3>
                        </div>
                      </div>
                    </a>
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