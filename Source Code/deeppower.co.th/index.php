<?php $_CURRENT_PAGE_CODE = "HOME" ?>
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

    <!-- banner section -->
    <?php $_hbanner = DataService::getInstance()->GetPortfolio("MASTERDETAIL-HOME_BANNER")[0]; ?>
    <?php if ($_hbanner["Active"] == 1) { ?>
    <section data-anim-wrap class="hero -type-4" style="padding-bottom: 100px;">
      <div class="container">
        <div data-anim-wrap class="row justify-center">
          <div class="col-auto">
            <div class="hero__content text-center">
              <div data-split='lines' data-anim-child="split-lines delay-3">
                <h1 class="hero__title">
                  <?php echo $_hbanner["PortName"] ?> <br class="lg:d-none">
                  <span class="hero-highlight"><?php echo $_hbanner["Year"] ?></span> <?php echo $_hbanner["ByName"] ?>
                  
                </h1>

                <p class="pt-40 md:pt-20" style="font-size: 20px; font-weight:500;"><?php echo ConvertNewLine($_hbanner["ShortDescription"]) ?></p>
              </div>

              <div data-anim-child="slide-up delay-5" class="d-flex justify-center mt-60 md:mt-30">
                <a href="<?php echo $_Util_PageConfig->GetConfig("WORK")->PageURLName() ?>">
                  <button class="button -type-1">
                    <i class="-icon icon-arrow-circle-right text-30"></i>
                    VIEW OUR WORKS
                  </button>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="marquee mt-60 md:pt-30">


        <?php
        $index = 0;
        $index2 = 0;
        $banners = DataService::getInstance()->GetGalleryMaster("HOME_BANNER");
        foreach ($banners as $banner) {
          $index2++;
          if ($index == 0) {
            echo '<div class="marquee__item">';
          }
        ?>

          <div data-anim-child="img-right cover-white delay-4" class="ratio <?php echo $index2 % 2 == 0 ? "ratio-2:3" : "ratio-1:1" ?>">
            <img src="<?php echo $banner["ImagePath"]; ?>" alt="<?php echo $banner["ImageName"]; ?>" class="img-ratio">
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

      </div>
    </section>
    <?php } ?>

    <!-- about section -->
    <?php $_habout = DataService::getInstance()->GetPortfolio("MASTERDETAIL-HOME_ABOUT")[0]; ?>
    <?php if ($_habout["Active"] == 1) { ?>
      <section class="layout-pt-lg layout-pb-lg pt-74" style="background-image:url(<?php echo $_habout["Image2"] ?>); background-repeat:no-repeat;">
        <div data-anim-wrap class="container">
          <div class="row y-gap-50 items-center justify-between">
            <div class="col-lg-5 col-md-9">
              <div data-anim-child="slide-up delay-1" class="text-15 uppercase mb-30 sm:mb-10"><?php echo $_habout["PortName"] ?> </div>
              <h2 data-anim-child="slide-up delay-2" class="text-64 md:text-40 capitalize about-text"><?php echo ConvertNewLine($_habout["ShortDescription"]) ?></h2>
              <div data-anim-child="slide-up delay-3" class="lh-18 pr-60 lg:pr-0 mt-40 md:mt-30 text-editer">
                <?php echo IncludeDynamicPageHTML($_habout["PortDetail"], false) ?>
              </div>
              <div data-anim-child="slide-up delay-4" class="d-flex mt-50 md:mt-40">
                <a href="<?php echo $_Util_PageConfig->GetConfig("ABOUT")->PageURLName() ?>">
                  <button class="button -type-1">
                    <i class="-icon">
                      <svg width="50" height="30" viewBox="0 0 50 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M35.8 28.0924C43.3451 28.0924 49.4616 21.9759 49.4616 14.4308C49.4616 6.88577 43.3451 0.769287 35.8 0.769287C28.255 0.769287 22.1385 6.88577 22.1385 14.4308C22.1385 21.9759 28.255 28.0924 35.8 28.0924Z" stroke="#122223" />
                        <path d="M33.4808 10.2039L32.9985 10.8031L37.2931 14.2623H0.341553V15.0315H37.28L33.0008 18.4262L33.4785 19.0285L39 14.6492L33.4808 10.2039Z" fill="#122223" />
                      </svg>
                    </i>
                    READ MORE
                  </button>
                </a>
              </div>

              <div data-anim-child="slide-up delay-5" class="row y-gap-30 pt-40 md:pt-0">

                <?php
                $_abouts = DataService::getInstance()->GetPortfolio("HOME_ABOUT");
                foreach ($_abouts as $_about) {
                ?>
                  <div class="col-sm-4 col-auto">
                    <div class="text-92 sm:text-60 text-sec fw-500"><?php echo $_about["ShortDescription"] ?></div>
                    <div class="text-17 fw-500 uppercase"><?php echo $_about["PortName"] ?></div>
                  </div>
                <?php } ?>

              </div>
            </div>

            <div class="col-lg-6">
              <div data-anim-child="img-right cover-white delay-2">
                <img src="<?php echo $_habout["Image"] ?>" alt="<?php echo $_habout["PortName"] ?>">
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php } ?>

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

    <?php $_hproduct = DataService::getInstance()->GetPortfolio("MASTERDETAIL-HOME_PRODUCT")[0]; ?>
    <?php if ($_hproduct["Active"] == 1) { ?>
      <section class="layout-pt-md layout-pt-md" style="background-image: url(<?php echo $_hproduct["Image"] ?>); background-repeat:no-repeat;">
        <div data-anim-wrap class="container">
          <div class="row justify-center text-center">
            <div class="col-auto" data-split='lines' data-anim-child="split-lines delay-2">
              <div class="text-15 uppercase mb-30 sm:mb-10"><?php echo $_hproduct["PortName"] ?></div>
              <h2 class="text-64 md:text-40"><?php echo ConvertNewLine($_hproduct["ShortDescription"]) ?></h2>
            </div>
          </div>

          <div class="overflow-hidden pt-100 pb-100 sm:pt-50 sm:pb-50 js-section-slider" data-gap="30" data-slider-cols="xl-3 lg-3 md-2 sm-1 base-1" data-pagination="js-slider2-pagination">
            <div class="swiper-wrapper">

              <?php
              $sql = "select * from product where Active = 1 and Hot = 1 order by SEQ,ProductCode ";
              $datas = SelectRowsArray($sql, array());
              foreach ($datas as $data) {
                $_URL = DetailPageURL($data["ProductCode"], $data["ProductName"]);
              ?>
                <div class="swiper-slide">
                  <a href="<?php echo $_URL; ?>" class="baseCard -type-1 -padding-lg" data-anim-child="img-right cover-white delay-2">
                    <div class="baseCard__image ratio ratio-45:54">
                      <img src="<?php echo $data["Image"] ?>" alt="<?php echo $data["ProductName"]; ?>" class="img-ratio">
                    </div>

                    <div class="baseCard__content d-flex flex-column justify-end text-center">
                      <h4 class="option-des text-30 md:text-25 text-white"><?php echo $data["ProductName"]; ?></h4>
                    </div>
                  </a>
                </div>
              <?php } ?>

            </div>

          </div>
        </div>
      </section>
    <?php } ?>


    <!-- why choose us -->
    <?php $_hwhy = DataService::getInstance()->GetPortfolio("MASTERDETAIL-HOME_WHY")[0]; ?>
    <?php if ($_hwhy["Active"] == 1) { ?>
      <section class="layout-pt-md layout-pb-md">
        <div data-anim-wrap class="container">
          <div class="row justify-center text-center">
            <div data-split='lines' data-anim-child="split-lines delay-2" class="col-auto">
              <div class="text-15 uppercase mb-30 sm:mb-10"><?php echo $_hwhy["PortName"] ?></div>
              <h2 class="text-64 md:text-40 capitalize"><?php echo ConvertNewLine($_hwhy["ShortDescription"]) ?></h2>
            </div>
          </div>
        </div>
      </section>

      <section class="verticalSlider-images relative z-0 bg-light-green">
        <div class="sectionBg -left-2 w-1/2 lg:w-1/1 z-2">
          <div class="verticalSlider-images__images">

            <?php
            $index = 0;
            $_whys = DataService::getInstance()->GetPortfolio("HOME_WHY");
            foreach ($_whys as $_why) {
              $index++;
            ?>
              <div class="<?php echo $index == 1 ? "is-active" : "" ?>">
                <img src="<?php echo $_why["Image"] ?>" alt="<?php echo $_why["PortName"] ?>" class="img-ratio">
              </div>
            <?php } ?>

          </div>
        </div>

        <div class="container">
          <div class="row">
            <div class="col-xl-3 col-lg-4 offset-lg-7">
              <div class="verticalSlider__wrap">
                <div class="verticalSlider js-verticalSlider" data-gap="130" data-vertical data-slider-cols="xl-3 lg-3 md-1 sm-1 base-1" data-pagination="js-verticalSlider-pagination">
                  <div class="swiper-wrapper flex-column h-auto">

                    <?php
                    $index = 0;
                    $_whys = DataService::getInstance()->GetPortfolio("HOME_WHY");
                    foreach ($_whys as $_why) {
                      $index++;
                    ?>
                      <div class="swiper-slide d-flex items-center">
                        <div class="">
                          <div class="text-30 text-white">
                            <img src="<?php echo $_why["Image2"] ?>" alt="<?php echo $_why["PortName"] ?>">
                          </div>
                          <h4 class="text-40 lg:text-30 sm:text-21 text-white mt-20"><?php echo $_why["PortName"] ?></h4>
                          <p class="text-17 text-white mt-20"><?php echo ConvertNewLine($_why["ShortDescription"]) ?></p>
                        </div>
                      </div>
                    <?php } ?>

                  </div>

                  <div class="verticalSlider__nav js-verticalSlider-pagination"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php } ?>

    <?php $_hwork = DataService::getInstance()->GetPortfolio("MASTERDETAIL-HOME_WORK")[0]; ?>
    <?php if ($_hwork["Active"] == 1) { ?>
      <section class="layout-pt-lg layout-pb-lg bg-light-1">
        <div data-anim-wrap class="container">
          <div class="row y-gap-30 justify-between items-end">
            <div data-split='lines' data-anim-child="split-lines delay-2" class="col-auto">
              <div class="text-15 uppercase mb-30 sm:mb-10"><?php echo $_hwork["PortName"] ?></div>
              <h2 class="text-64 md:text-40"><?php echo ConvertNewLine($_hwork["ShortDescription"]) ?></h2>
            </div>

            <div data-anim-child="slide-up delay-4" class="col-auto">
              <a href="<?php echo $_Util_PageConfig->GetConfig("WORK")->PageURLName() ?>">
                <button class="button -md -type-2 bg-green text-white rounded -accent-1 mt-50 md:mt-30 mx-auto">VIEW ALL OUR WORKS</button>
              </a>
            </div>
          </div>

          <div class="pt-100 sm:pt-50 js-section-slider" data-gap="30" data-slider-cols="xl-3 lg-3 md-2 sm-1 base-1" data-pagination="js-slider2-pagination">
            <div class="swiper-wrapper">

              <?php
              $sql = "select * from portfolio where PortType=:PortType and Active = 1 order by SEQ,PortCode ";
              $datas = SelectRowsArray($sql, array("PortType" => "WORK"));
              foreach ($datas as $data) {
                $_URL = DetailPageURL2($data["PortName"]);
              ?>
                <div class="swiper-slide">
                  <a href="<?php echo $_URL; ?>" class="baseCard -type-1 -padding-lg">
                    <div class="baseCard__image ratio ratio-45:54 rounded-16" data-anim-child="img-right cover-light-1 delay-4">
                      <img src="<?php echo $data["Image"]; ?>" alt="<?php echo $data["PortName"]; ?>" class="img-ratio rounded-16">
                    </div>
                  </a>
                </div>
              <?php } ?>

            </div>
          </div>
        </div>
      </section>
    <?php } ?>

    <?php $_hblog = DataService::getInstance()->GetPortfolio("MASTERDETAIL-HOME_BLOG")[0]; ?>
    <?php if ($_hblog["Active"] == 1) { ?>
      <section class="layout-pt-lg layout-pb-lg">
        <div data-anim-wrap class="container">
          <div class="row y-gap-30 justify-between items-end">
            <div data-split='lines' data-anim-child="split-lines delay-2" class="col-auto">
              <div class="text-15 uppercase mb-30 sm:mb-10"><?php echo $_hblog["PortName"] ?></div>
              <h2 class="text-64 md:text-40"><?php echo ConvertNewLine($_hblog["ShortDescription"]) ?></h2>
            </div>

            <div data-anim-child="slide-up delay-4" class="col-auto">
              <a href="<?php echo $_Util_PageConfig->GetConfig("BLOG")->PageURLName() ?>">
                <button class="button -md -type-2 bg-green text-white rounded -accent-1 mt-50 md:mt-30 mx-auto">VIEW ALL BLOGS</button>
              </a>
            </div>
          </div>

          <div class="row y-gap-30 x-gap-85 justify-between pt-100 sm:pt-50">

            <?php
            $sql = "select * from portfolio where PortType=:PortType and Active = 1 order by PortDateTime limit 3 ";
            $datas = SelectRowsArray($sql, array("PortType" => "BLOG"));
            foreach ($datas as $data) {
              $_URL = DetailPageURL2($data["PortName"]);
            ?>
              <div class="col-lg-4 col-md-6">
                <a href="<?php echo $_URL; ?>" class="baseCard -type-2">
                  <div class="baseCard__image ratio ratio-41:50" data-anim-child="img-right cover-white delay-2">
                    <img src="<?php echo $data["Image"]; ?>" alt="<?php echo $data["PortName"]; ?>" class="img-ratio">
                  </div>

                  <div class="baseCard__content mt-30" data-anim-child="slide-up delay-6">
                    <div class="row x-gap-10 text-accent-1">
                      <div class="col-auto">
                        <?php echo ConvertDateDBToDateDisplayLongFormat($data["PortDateTime"], true) ?>
                      </div>
                    </div>
                    <h4 class="text-30 md:text-25 mt-15"><?php echo $data["PortName"]; ?></h4>
                    <div class="d-flex mt-20">
                      <a href="<?php echo $_URL; ?>">
                        <button class="button -type-1">
                          <i class="-icon">
                            <svg width="50" height="30" viewBox="0 0 50 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M35.8 28.0924C43.3451 28.0924 49.4616 21.9759 49.4616 14.4308C49.4616 6.88577 43.3451 0.769287 35.8 0.769287C28.255 0.769287 22.1385 6.88577 22.1385 14.4308C22.1385 21.9759 28.255 28.0924 35.8 28.0924Z" stroke="#122223" />
                              <path d="M33.4808 10.2039L32.9985 10.8031L37.2931 14.2623H0.341553V15.0315H37.28L33.0008 18.4262L33.4785 19.0285L39 14.6492L33.4808 10.2039Z" fill="#122223" />
                            </svg>
                          </i>
                          READ MORE
                        </button>
                      </a>
                    </div>
                  </div>
                </a>
              </div>
            <?php } ?>

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