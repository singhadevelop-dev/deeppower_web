<?php $_CURRENT_PAGE_CODE = "ABOUT" ?>
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

    <!-- about section -->
    <?php $_about = DataService::getInstance()->GetPortfolio("MASTERDETAIL-ABOUT")[0]; ?>
    <?php if ($_about["Active"] == 1) { ?>
      <section class="layout-pt-lg">
        <div data-anim-wrap class="container">
          <div class="row justify-center text-center">
            <div class="col-xl-8 col-lg-10">
              <div data-split='lines' data-anim-child="split-lines delay-2">
                <div class="text-15 uppercase mb-30 sm:mb-10"><?php echo $_Util_WebsitDetail["WebName"] ?></div>
                <h2 class="text-64 md:text-40 capitalize"><?php echo $_about["PortName"] ?></h2>
              </div>

              <div data-anim-child="slide-up delay-4" class="row justify-center">
                <div class="col-lg-8">
                  <p class="mt-40 md:mt-20"><?php echo ConvertNewLine($_about["ShortDescription"]) ?></p>
                </div>
              </div>

              <div data-anim-child="slide-up delay-5">
                <a href="<?php echo $_Util_PageConfig->GetConfig('CONTACT')->PageURLName() ?>">
                  <button class="button -type-1 mx-auto mt-50 md:mt-30">
                    <i class="-icon">
                      <svg width="50" height="30" viewBox="0 0 50 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M35.8 28.0924C43.3451 28.0924 49.4616 21.9759 49.4616 14.4308C49.4616 6.88577 43.3451 0.769287 35.8 0.769287C28.255 0.769287 22.1385 6.88577 22.1385 14.4308C22.1385 21.9759 28.255 28.0924 35.8 28.0924Z" stroke="#122223" />
                        <path d="M33.4808 10.2039L32.9985 10.8031L37.2931 14.2623H0.341553V15.0315H37.28L33.0008 18.4262L33.4785 19.0285L39 14.6492L33.4808 10.2039Z" fill="#122223" />
                      </svg>
                    </i>
                    Contact Us Now
                  </button>
                </a>
              </div>
            </div>
          </div>

          <div class="row x-gap-50 y-gap-30 pt-100 sm:pt-50">
            <div class="col-lg-4 col-sm-6">
              <div data-anim-child="img-right cover-light-1 delay-2" class="rounded-16">
                <img src="<?php echo $_about["Image"] ?>" alt="<?php echo $_about["PortName"] ?>" class="rounded-16 col-12">
              </div>
            </div>
            <div class="col-lg-4 col-sm-6">
              <div class="pt-100 md:pt-0">
                <div data-anim-child="img-right cover-light-1 delay-3" class="rounded-16">
                  <img src="<?php echo $_about["Image2"] ?>" alt="<?php echo $_about["PortName"] ?>" class="rounded-16 col-12">
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-sm-6">
              <div data-anim-child="img-right cover-light-1 delay-4" class="rounded-16">
                <img src="<?php echo $_about["Image3"] ?>" alt="<?php echo $_about["PortName"] ?>" class="rounded-16 col-12">
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php } ?>

    <!-- about 2 -->
    <?php $_about2 = DataService::getInstance()->GetPortfolio("MASTERDETAIL-ABOUT2")[0]; ?>
    <?php if ($_about2["Active"] == 1) { ?>
      <section class="layout-pt-md layout-pb-md mt-50 mb-50 bg-beige">
        <div class="container">
          <div data-anim-wrap class="row y-gap-40 justify-between items-center">
            <div data-anim="img-right cover-white delay-1" class="col-xl-6 col-lg-6">
              <img src="<?php echo $_about2["Image"] ?>" alt="<?php echo $_about2["PortName"] ?>">
            </div>

            <div data-split='lines' data-anim="split-lines delay-3" class="col-xl-5 col-lg-6">
              <h3 class="text-40 md:text-30 capitalize"><?php echo $_about2["PortName"] ?></h3>
              <div class="lh-17 pt-40">
                <?php echo IncludeDynamicPageHTML($_about2["PortDetail"], false) ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php } ?>
    <!-- Categories -->

    <?php $_hcate = DataService::getInstance()->GetPortfolio("MASTERDETAIL-CATEGORY")[0]; ?>
    <?php if ($_hcate["Active"] == 1) { ?>
      <section class="layout-pb-lg">
        <div data-anim-wrap class="container">
          <div class="row justify-center text-center">
            <div data-anim-child="slide-up delay-1" class="col-auto">
              <div class="text-15 uppercase mb-30 sm:mb-10"><?php echo $_hcate["PortName"] ?></div>
              <h2 class="text-64 md:text-40"><?php echo ConvertNewLine($_hcate["ShortDescription"]) ?></h2>
            </div>
          </div>

          <?php
          $index = 0;
          $_cats = DataService::getInstance()->GetCategory("PRODUCT");
          foreach ($_cats as $_cat) {
            $_URL = DetailPageURL2($_cat["CategoryName"]);
            if ($index == 0) {
              echo '<div class="row y-gap-30 justify-between pt-100 sm:pt-50">';
            }
          ?>
            <div data-anim-child="slide-up delay-3" class="col-lg-auto col-6">
              <div class="iconCard -type-1 -hover-1">
                <div class="iconCard__icon text-50">
                  <div class="iconCard__icon__circle bg-light-1"></div>
                  <a href="<?php echo $_URL; ?>">
                    <img src="<?php echo $_cat["Image"]; ?>" alt="<?php echo $_cat["CategoryName"]; ?>">
                  </a>
                </div>
                <h4 class="text-24 text-center mt-20">
                  <a href="<?php echo $_URL; ?>" class="iconCard-link"><?php echo $_cat["CategoryName"]; ?></a>
                </h4>
              </div>
            </div>
          <?php
            $index++;
            if ($index >= 6) {
              $index = 0;
              echo '</div>';
            }
          }
          ?>
          <?php
          if ($index != 0) {
            $index = 0;
            echo '</div>';
          }
          ?>

          <div class="row y-gap-30 justify-between pt-50 sm:pt-50">

            <div data-anim-child="slide-up delay-1">
              <a href="<?php echo $_Util_PageConfig->GetConfig("PRODUCT")->PageURLName() ?>">
                <button class="button -md -type-2 bg-green text-white rounded -accent-1 mt-50 md:mt-30 mx-auto">VIEW ALL SOUVENIR</button>
              </a>
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
</body>

</html>