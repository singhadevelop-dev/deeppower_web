<footer class="footer -type-1 -bg-1 relative text-dark">
  <div class="footer__bg -type-1">
    <div class="bg-light-green"></div>
    <div class="bg-beige"></div>
  </div>

  <div class="footer__main">
    <div class="container">
      <div class="footer__grid">
        <div class="">
          <h4 class="text-30 fw-500 text-dark">About Us</h4>

          <div class="text-dark-60 text-15 lh-17 mt-60 md:mt-20 uppercase"><?php echo ConvertNewLine($_Util_WebsitDetail["Description"]) ?></div>
        </div>

        <div class="">
          <h4 class="text-30 fw-500 text-dark">Contact</h4>

          <div class="d-flex flex-column mt-60 md:mt-20">
            <div class="">
              <a class="d-block text-15 text-dark-60 lh-17 uppercase" href="<?php echo $_Util_WebsitDetail["WebUrl"] ?>" target="_blank">
                <?php echo $_Util_WebsitDetail["Address"] ?>
              </a>
            </div>
            <div class="mt-25">
              <a class="d-block text-15 text-dark-60 uppercase" href="mailto:<?php echo $_Util_WebsitDetail["Email"] ?>">
                <?php echo $_Util_WebsitDetail["Email"] ?>
              </a>
            </div>
            <div class="mt-10">
              <a class="d-block text-15 text-dark-60 uppercase" href="tel:<?php echo $_Util_WebsitDetail["Phone"] ?>">
                <?php echo $_Util_WebsitDetail["Phone"] ?>, <?php echo $_Util_WebsitDetail["MobilePhone"] ?>
              </a>
            </div>
          </div>
        </div>

        <div class="">
          <h4 class="text-30 fw-500 text-dark">Links</h4>

          <div class="row x-gap-50 y-gap-15">
            <div class="col-sm-6">
              <div class="y-gap-15 text-15 text-dark-60 mt-60 md:mt-20">

                <a class="d-block uppercase" href="<?php echo $_Util_PageConfig->GetConfig("ABOUT")->PageURLName() ?>">
                  <?php echo $_Util_PageConfig->GetConfig("ABOUT")->PageName() ?>
                </a>

                <a class="d-block uppercase" href="<?php echo $_Util_PageConfig->GetConfig("PRODUCT")->PageURLName() ?>">
                  <?php echo $_Util_PageConfig->GetConfig("PRODUCT")->PageName() ?>
                </a>

                <a class="d-block uppercase" href="<?php echo $_Util_PageConfig->GetConfig("SERVICE")->PageURLName() ?>">
                  <?php echo $_Util_PageConfig->GetConfig("SERVICE")->PageName() ?>
                </a>

                <a class="d-block uppercase" href="<?php echo $_Util_PageConfig->GetConfig("WORK")->PageURLName() ?>">
                  <?php echo $_Util_PageConfig->GetConfig("WORK")->PageName() ?>
                </a>

                <a class="d-block uppercase" href="<?php echo $_Util_PageConfig->GetConfig("BLOG")->PageURLName() ?>">
                  <?php echo $_Util_PageConfig->GetConfig("BLOG")->PageName() ?>
                </a>

              </div>
            </div>

            <div class="col-sm-6">
              <div class="y-gap-15 text-15 text-dark-60 mt-60 md:mt-20">

                <a class="d-block uppercase" href="<?php echo $_Util_PageConfig->GetConfig("PRIVACY")->PageURLName() ?>">
                  <?php echo $_Util_PageConfig->GetConfig("PRIVACY")->PageName() ?>
                </a>

                <a class="d-block uppercase" href="<?php echo $_Util_PageConfig->GetConfig("TERMS")->PageURLName() ?>">
                  <?php echo $_Util_PageConfig->GetConfig("TERMS")->PageName() ?>
                </a>

                <a class="d-block uppercase" href="<?php echo $_Util_PageConfig->GetConfig("COOKIE")->PageURLName() ?>">
                  <?php echo $_Util_PageConfig->GetConfig("COOKIE")->PageName() ?>
                </a>

              </div>
            </div>
          </div>
        </div>

        <div class="">
          <h4 class="text-30 fw-500 text-dark">Line Add Friend</h4>
          <img src="<?php echo $_Util_WebsitDetail["Image4"] ?>" class="pt-50" alt="<?php echo $_Util_WebsitDetail["LineID"] ?>">
        </div>
      </div>
    </div>
  </div>

  <div class="footer__bottom">
    <div class="container">
      <div class="row y-gap-30 justify-between md:justify-center items-center">
        <div class="col-sm-auto">
          <div class="text-15 text-center text-dark-60">All right reserved © 2025 DEEP POWER CO,.LTD.</div>
        </div>

        <span style="display:none;">รับทำเว็บไซต์ by <a href="https://www.singhadevelop.co.th/" target="blank">SiNGHADEVELOP CO.,LTD.</a></span>

        <div class="col-sm-auto">
          <div class="footer__bottom_center">
            <!-- <div class="d-flex justify-center">
                  <img src="img/general/logo-dark.svg" alt="logo">
                </div> -->
          </div>
        </div>

        <div class="col-sm-auto">
          <div class="row x-gap-25 y-gap-10 items-center justify-center">

            <div class="col-auto">
              <a href="<?php echo $_Util_WebsitDetail["Linkedin"] ?>" class="d-block text-dark-60" target="_blank">
                <img src="img/tik-tok.png" alt="<?php echo $_Util_WebsitDetail["Linkedin"] ?>" width="30">
              </a>
            </div>

            <div class="col-auto">
              <a href="<?php echo $_Util_WebsitDetail["LineIDURL"] ?>" class="d-block text-dark-60" target="_blank">
                <img src="img/line.png" alt="<?php echo $_Util_WebsitDetail["LineID"] ?>" width="30">
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</footer>