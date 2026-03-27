<?php $_CURRENT_PAGE_CODE = "BLOG" ?>
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
              <div class="text-15 uppercase mb-30 sm:mb-10">
                <?php echo $_Util_PageConfig->GetConfig("BLOG")->PageName() ?>
              </div>
              <h2 class="text-64 md:text-40 text-green capitalize"><?php echo $data["PortName"] ?></h2>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="layout-pt-lg layout-pb-lg">
      <div class="container">
        <div class="row justify-center">
          <div class="col-xl-8 col-lg-9 col-md-10">
            <div>
              <h2 class="text-40"><?php echo $data["PortName"] ?></h2>

              <div class="mt-40">
                <?php echo IncludeDynamicPageHTML($data["PortDetail"], false) ?>
              </div>

              <div class="row y-gap-20 justify-between items-center pt-100 sm:pt-50">
                <div class="col-auto">
                  <div class="d-flex">
                    <div class="fw-500 mr-25">
                      Share
                    </div>
                    <?php
                    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
                    $uri = $protocol . $_SERVER['HTTP_HOST'];
                    $urlName = $uri . $_SERVER['REQUEST_URI'];
                    $urlImage = $uri . $data["Image"];
                    $tileName = $_Util_WebsitDetail["WebName"];
                    ?>
                    <div class="d-flex items-center x-gap-10">
                      <a href="javascript:;" onclick="<?php echo GetUrlShareFacebook($urlName); ?>">Facebook</a>
                      <div>
                        <div class="-circle-2 bg-accent-2"></div>
                      </div>
                      <a href="javascript:;" onclick="<?php echo GetUrlShareTwitter($urlName, $tileName, $data["PortName"]); ?>">Twitter</a>
                      <div>
                        <div class="-circle-2 bg-accent-2"></div>
                      </div>
                      <a href="javascript:;" onclick="<?php echo GetUrlShareIG($urlName); ?>">Instagram</a>
                    </div>
                  </div>
                </div>

                <div class="col-auto">
                  <div class="row x-gap-10 y-gap-10">
                    <?php
                    foreach ($dataTags as $tag) {
                      if (strpos($data["Tag"], $tag["TagCode"]) !== false) {
                        $_URL = $_Util_PageConfig->GetConfig("BLOG")->PageURLName() . "?tag=" . $tag["TagCode"];
                    ?>
                        <div class="col-auto">
                          <a href="<?php echo $_URL ?>" class="d-flex lh-1 px-20 py-15 bg-light-1"><?php echo $tag["TagName"] ?></a>
                        </div>
                    <?php }
                    } ?>

                  </div>
                </div>
              </div>

              <div class="row y-gap-30 pt-100 sm:pt-50">
                <div class="col-12">
                  <h2 class="text-40 mb-20">Related Posts</h2>
                </div>

                <?php
                $_datas = SelectRowsArray("select * from portfolio where Active = 1 and PortCode <> '" . $data["PortCode"] . "' and PortType = :PortType order by rand() limit 2", array("PortType" => "BLOG"));
                foreach ($_datas as $_data) {
                  $_URL = DetailPageURL2($_data["PortName"]);
                ?>
                  <div class="col-md-6">
                    <a href="<?php echo $_URL ?>" class="baseCard -type-2">
                      <div class="baseCard__image ratio ratio-41:50">
                        <img src="<?php echo $_data["Image"] ?>" alt="<?php echo $_data["PortName"] ?>" class="img-ratio">
                      </div>

                      <div class="baseCard__content mt-30">
                        <div class="row x-gap-10">
                          <div class="col-auto">
                            <?php echo ConvertDateDBToDateDisplayLongFormat($_data["PortDateTime"], true) ?>
                          </div>
                        </div>

                        <h4 class="text-30 md:text-25 mt-15"><?php echo $_data["PortName"] ?></h4>
                      </div>
                    </a>
                  </div>
                <?php } ?>

              </div>

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