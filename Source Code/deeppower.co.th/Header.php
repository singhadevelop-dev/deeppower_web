<script>
  function _changeLang(lang) {
    const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries());

    var src = "_change_lang.php?lang=" + lang;
    src += "&p=<?php echo $_CURRENT_PAGE_CODE  ?>";
    for (var key in params) {
      src += "&" + key + "=" + params[key];
    }

    location.href = src;
  }
</script>
<?php $_lang = empty($_COOKIE["_WEB_LANG"]) ? "EN" : $_COOKIE["_WEB_LANG"]; ?>
<div class="menuFullScreen js-menuFullScreen">
  <div class="menuFullScreen__topMobile js-menuFullScreen-topMobile">
    <div class="d-flex items-center text-white js-menuFullScreen-toggle">
      <i class="icon-menu text-9"></i>
      <div class="text-15 uppercase ml-30 sm:d-none">Menu</div>
    </div>

    <div class="">
      <a href="<?php echo $_Util_PageConfig->GetConfig("HOME")->PageURLName() ?>">
        <img src="<?php echo $_Util_WebsitDetail["Image"] ?>" alt="<?php echo $_Util_WebsitDetail["WebName"] ?>">
      </a>
    </div>
  </div>

  <div class="menuFullScreen__mobile__bg js-menuFullScreen-mobile-bg"></div>

  <div class="menuFullScreen__left">
    <div class="menuFullScreen__bg js-menuFullScreen-bg">
      <img src="img/menu/bg.png" alt="image">
    </div>

    <button class="menuFullScreen__close js-menuFullScreen-toggle js-menuFullScreen-close-btn">
      <span class="icon">
        <span></span>
        <span></span>
      </span>
      CLOSE
    </button>

    <div class="menuFullScreen-links js-menuFullScreen-links">

      <div class="menuFullScreen-links__item">
        <a href="<?php echo $_Util_PageConfig->GetConfig("HOME")->PageURLName() ?>">
          <?php echo $_Util_PageConfig->GetConfig("HOME")->PageName() ?>
        </a>
      </div>

      <div class="menuFullScreen-links__item js-menuFullScreen-has-children">
        <a href="<?php echo $_Util_PageConfig->GetConfig("ABOUT")->PageURLName() ?>">
          <?php echo $_Util_PageConfig->GetConfig("ABOUT")->PageName() ?>
        </a>
      </div>

      <div class="menuFullScreen-links__item js-menuFullScreen-has-children">
        <a href="#">
          <?php echo $_Util_PageConfig->GetConfig("PRODUCT")->PageName() ?>
          <i class="icon-arrow-right"></i>
          <i class="icon-chevron-right"></i>
        </a>


        <div class="menuFullScreen-links-subnav js-menuFullScreen-subnav">
          <?php
          $cats = DataService::getInstance()->GetCategory("PRODUCT");
          foreach ($cats as $cat) {
            $_URL = DetailPageURL2($cat["CategoryName"]);
          ?>
            <div class="menuFullScreen-links-subnav__item">
              <a href="<?php echo $_URL; ?>"><?php echo $cat["CategoryName"]; ?></a>
            </div>
          <?php } ?>

        </div>


      </div>

      <div class="menuFullScreen-links__item js-menuFullScreen-has-children">
        <a href="#">
          <?php echo $_Util_PageConfig->GetConfig("SERVICE")->PageName() ?>
          <i class="icon-arrow-right"></i>
          <i class="icon-chevron-right"></i>
        </a>
        <div class="menuFullScreen-links-subnav js-menuFullScreen-subnav">
          <?php
          $_scats = DataService::getInstance()->GetCategory("SERVICE");
          foreach ($_scats as $_scat) {
            $_URL = DetailPageURL2($_scat["CategoryName"]);
          ?>
            <div class="menuFullScreen-links-subnav__item">
              <a href="<?php echo $_URL; ?>"><?php echo $_scat["CategoryName"]; ?></a>
            </div>
          <?php } ?>

        </div>


      </div>

      <div class="menuFullScreen-links__item">
        <a href="<?php echo $_Util_PageConfig->GetConfig("WORK")->PageURLName() ?>">
          <?php echo $_Util_PageConfig->GetConfig("WORK")->PageName() ?>
        </a>
      </div>

      <div class="menuFullScreen-links__item">
        <a href="<?php echo $_Util_PageConfig->GetConfig("BLOG")->PageURLName() ?>">
          <?php echo $_Util_PageConfig->GetConfig("BLOG")->PageName() ?>
        </a>
      </div>


      <div class="menuFullScreen-links__item">
        <a href="<?php echo $_Util_PageConfig->GetConfig("CONTACT")->PageURLName() ?>">
          <?php echo $_Util_PageConfig->GetConfig("CONTACT")->PageName() ?>
        </a>
      </div>

    </div>
  </div>

  <div class="menuFullScreen__right js-menuFullScreen-right">
    <div class="text-center">
      <div class="mb-100">
        <img src="<?php echo $_Util_WebsitDetail["Image"] ?>" alt="image">
      </div>

      <div class="mt-40">
        <div class="text-30 text-sec fw-500">
          Location
        </div>
        <div class="mt-10">
          <?php echo $_Util_WebsitDetail["Address"] ?>
        </div>
      </div>

      <div class="mt-40">
        <div class="text-30 text-sec fw-500">
          Phone Support
        </div>
        <div class="mt-10">
          <div>
            <a href="tel:<?php echo $_Util_WebsitDetail["Phone"] ?>"><?php echo $_Util_WebsitDetail["Phone"] ?></a>, <a href="tel:<?php echo $_Util_WebsitDetail["MobilePhone"] ?>"><?php echo $_Util_WebsitDetail["MobilePhone"] ?></a>
          </div>
          <div>
            <a href="mailto:<?php echo $_Util_WebsitDetail["Email"] ?>"><?php echo $_Util_WebsitDetail["Email"] ?></a>
          </div>
        </div>
      </div>

      <div class="mt-40">
        <div class="text-30 text-sec fw-500">
          Connect With Us
        </div>
        <div class="mt-10">
          <a href="tel:<?php echo $_Util_WebsitDetail["Phone"] ?>"><?php echo $_Util_WebsitDetail["Phone"] ?></a>, <a href="tel:<?php echo $_Util_WebsitDetail["MobilePhone"] ?>"><?php echo $_Util_WebsitDetail["MobilePhone"] ?></a>
        </div>
      </div>
    </div>
  </div>

  <div class="menuFullScreen__bottomMobile js-menuFullScreen-buttomMobile">
    <a href="<?php echo $_Util_WebsitDetail["LineIDURL"] ?>" target="_blank">
      <button class="button rounded-200 w-1/1 py-20 -light-1 bg-accent-2">
        GET A QUOTE
      </button>
    </a>

    <a href="tel:<?php echo $_Util_WebsitDetail["Phone"] ?>" class="d-flex items-center mt-40">
      <i class="icon-phone mr-10"></i>
      <span><?php echo $_Util_WebsitDetail["Phone"] ?>, <?php echo $_Util_WebsitDetail["MobilePhone"] ?></span>
    </a>

    <a href="<?php echo $_Util_WebsitDetail["WebUrl"] ?>" class="d-flex mt-20" target="_blank">
      <i class="icon-map mr-10"></i>
      <span>
        <?php echo $_Util_WebsitDetail["Address"] ?>
      </span>
    </a>

    <a href="mailto:<?php echo $_Util_WebsitDetail["Email"] ?>" class="d-flex items-center mt-20">
      <i class="icon-mail mr-10"></i>
      <span><?php echo $_Util_WebsitDetail["Email"] ?></span>
    </a>
  </div>
</div>


<!-- cursor start -->
<div class="cursor js-cursor">
  <div class="cursor__wrapper">
    <div class="cursor__follower js-follower"></div>
    <div class="cursor__label js-label"></div>
    <div class="cursor__icon js-icon"></div>
  </div>
</div>
<!-- cursor end -->


<header class="header -h-110 -mx-60 js-header" data-add-bg="bg-light-1" data-x="header" data-x-toggle="-is-menu-opened">
  <div class="header__container">
    <div class="headerMobile__left d-flex items-center">
      <div class="header__logo lg:d-none">
        <a href="<?php echo $_Util_PageConfig->GetConfig("HOME")->PageURLName() ?>">
          <img src="<?php echo $_Util_WebsitDetail["Image"] ?>" alt="<?php echo $_Util_WebsitDetail["WebName"] ?>">
        </a>
      </div>

      <button class="button ml-60 xl:d-none">
        <i class="icon-phone mr-15"></i>
        <?php echo $_Util_WebsitDetail["Phone"] ?>, <?php echo $_Util_WebsitDetail["MobilePhone"] ?>
      </button>

      <div class="items-center d-none lg:d-flex js-menuFullScreen-toggle">
        <i class="icon-menu text-9"></i>
        <div class="text-15 uppercase ml-30 sm:d-none">Menu</div>
      </div>
    </div>

    <div class="header__center">
      <div class="header__logo d-none lg:d-flex">
        <img src="<?php echo $_Util_WebsitDetail["Image"] ?>" alt="<?php echo $_Util_WebsitDetail["WebName"] ?>">
      </div>

      <div class="lg:d-none">
        <div class="desktopNav">
          <div class="desktopNav__item">
            <a href="<?php echo $_Util_PageConfig->GetConfig("HOME")->PageURLName() ?>">
              <?php echo $_Util_PageConfig->GetConfig("HOME")->PageName() ?>
            </a>
          </div>

          <div class="desktopNav__item">
            <a href="<?php echo $_Util_PageConfig->GetConfig("ABOUT")->PageURLName() ?>">
              <?php echo $_Util_PageConfig->GetConfig("ABOUT")->PageName() ?>
            </a>
          </div>

          <div class="desktopNav__item">
            <a href="<?php echo $_Util_PageConfig->GetConfig("PRODUCT")->PageURLName() ?>">
              <?php echo $_Util_PageConfig->GetConfig("PRODUCT")->PageName() ?> <i class="icon-chevron-down"></i>
            </a>

            <div class="desktopNavSubnav">
              <div class="desktopNavSubnav__content">

                <?php
                $cats = DataService::getInstance()->GetCategory("PRODUCT");
                foreach ($cats as $cat) {
                  $_URL = DetailPageURL2($cat["CategoryName"]);
                ?>
                  <div class="desktopNavSubnav__item">
                    <a href="<?php echo $_URL; ?>"><?php echo $cat["CategoryName"]; ?></a>
                  </div>
                <?php } ?>

              </div>
            </div>
          </div>

          <div class="desktopNav__item">
            <a href="<?php echo $_Util_PageConfig->GetConfig("SERVICE")->PageURLName() ?>">
              <?php echo $_Util_PageConfig->GetConfig("SERVICE")->PageName() ?> <i class="icon-chevron-down"></i>
            </a>

            <div class="desktopNavSubnav">
              <div class="desktopNavSubnav__content">

                <?php
                $scats = DataService::getInstance()->GetCategory("SERVICE");
                foreach ($scats as $scat) {
                  $_URL = DetailPageURL2($scat["CategoryName"]);
                ?>
                  <div class="desktopNavSubnav__item">
                    <a href="<?php echo $_URL; ?>"><?php echo $scat["CategoryName"]; ?></a>
                  </div>
                <?php } ?>

              </div>
            </div>
          </div>

          <div class="desktopNav__item">
            <a href="<?php echo $_Util_PageConfig->GetConfig("WORK")->PageURLName() ?>">
              <?php echo $_Util_PageConfig->GetConfig("WORK")->PageName() ?>
            </a>
          </div>

          <div class="desktopNav__item">
            <a href="<?php echo $_Util_PageConfig->GetConfig("BLOG")->PageURLName() ?>">
              <?php echo $_Util_PageConfig->GetConfig("BLOG")->PageName() ?>
            </a>
          </div>

          <div class="desktopNav__item">
            <a href="<?php echo $_Util_PageConfig->GetConfig("CONTACT")->PageURLName() ?>">
              <?php echo $_Util_PageConfig->GetConfig("CONTACT")->PageName() ?>
            </a>
          </div>
        </div>

      </div>
    </div>

    <div class="header__right d-flex items-center h-full">
      <button class="button mr-10 xl:mr-10 lag <?php echo $_lang == "EN" ? "active" : "" ?>" onclick="_changeLang('EN');">EN</button> |
      <button class="button ml-10 mr-30 xl:mr-0 lag <?php echo $_lang == "TH" ? "active" : "" ?>" onclick="_changeLang('TH');">TH</button>

      <a href="<?php echo $_Util_WebsitDetail["LineIDURL"] ?>" class="-md -accent-1 mr-30 xl:d-none" target="_blank">
        <img src="img/line-button.png" alt="">
      </a>

    </div>
  </div>
</header>