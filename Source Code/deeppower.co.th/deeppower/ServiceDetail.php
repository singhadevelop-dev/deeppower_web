<!DOCTYPE html>
<html lang="en" data-x="html" data-x-toggle="html-overflow-hidden">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="icon" href="img/fav.png" type="image/gif" sizes="20x20">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/vendors.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/custom.css">

    <title>Deep Power - Custom Uniforms, Memorable Souvenirs</title>
</head>

<body>

    <?php include("Header.php"); ?>

    <main>

        <!-- inner banner -->

        <!-- <section class="layout-pt-lg layout-pb-md bg-beige ">
            <div data-anim-wrap class="container">
                <div class="row justify-center text-center">
                    <div class="col-xl-8 col-lg-10">
                        <div data-split='lines' data-anim-child="split-lines delay-2">
                            <div class="text-15 uppercase mb-30 sm:mb-10">
                                Service
                            </div>
                            <h2 class="text-64 md:text-40 text-green capitalize">
                            Custom Printing & Embroidery
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->

    <!-- content -->

    <section class="layout-pt-lg">
      <div data-anim-wrap class="container">
        <div class="row justify-center text-center">
          <div class="col-xl-8 col-lg-10">
            <div data-anim-child="slide-up delay-1">
              <img src="img/icon5.png" class="justify-center mb-30" alt="">
            </div>

            <div data-split='lines' data-anim-child="split-lines delay-2">
              <div class="text-15 uppercase mb-20">
                SERVICE
              </div>

              <h2 class="text-64 lg:text-50 md:text-40">
              Custom Printing & Embroidery
              </h2>

              <p class="lh-18 mt-40 md:mt-30">
              Make your brand stand out with high-quality printing and embroidery on uniforms, souvenirs, and promotional products. Whether you need a vibrant logo print or a premium embroidered design, we ensure every detail is crafted to perfection.
              </p>
            </div>

            <div data-anim-child="slide-up delay-7" class="d-flex justify-center mt-40">
              <button class="button -md -type-2 -accent-1 bg-accent-2">CONTACT US</button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="layout-pt-md px-60 sm:px-0">
      <div data-anim-wrap class="relative">
        <div class="overflow-hidden js-section-slider" data-gap="15" data-slider-cols="xl-4 lg-3 md-2 sm-1 base-1" data-loop data-nav-prev="js-slider1-prev" data-nav-next="js-slider1-next">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="ratio ratio-44:60" data-anim-child="img-right cover-white delay-2">
                <img src="img/servicedetail1.png" alt="image" class="img-ratio">
              </div>
            </div>

            <div class="swiper-slide">
              <div class="ratio ratio-44:60" data-anim-child="img-right cover-white delay-4">
                <img src="img/servicedetail2.png" alt="image" class="img-ratio">
              </div>
            </div>

            <div class="swiper-slide">
              <div class="ratio ratio-44:60" data-anim-child="img-right cover-white delay-6">
                <img src="img/servicedetail3.png" alt="image" class="img-ratio">
              </div>
            </div>

            <div class="swiper-slide">
              <div class="ratio ratio-44:60" data-anim-child="img-right cover-white delay-8">
                <img src="img/servicedetail4.png" alt="image" class="img-ratio">
              </div>
            </div>

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
          <div data-split='lines' data-anim="split-lines delay-1" class="col-xl-8 col-lg-10">
            <h2 class="text-40 md:text-30">
            We offer screen printing, heat transfer, and embroidery techniques, allowing you to choose the best method for your fabric and design. Our expert team ensures long-lasting prints and precise stitching that maintain their quality even after repeated use and washing.
            </h2>

            <p class="lh-17 mt-40">
            From small batches to bulk orders, we handle every project with care and efficiency. Whether it’s for corporate branding, team uniforms, or special events, we help bring your vision to life with top-tier customization.
              <br><br>
              Let’s create something unique together! Contact us today to get started on your custom printing and embroidery needs.
            </p>
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