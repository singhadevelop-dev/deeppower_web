<?php
$sql = "select ImageName,ImagePath,ImagePath2,ImageDetail from gallery where RefCode = :refCode";
$siteBanner = SelectRow($sql, array('refCode' => "BANNER_$_CURRENT_PAGE_CODE"));
?>
<section class="top-space-margin page-title-big-typography cover-background" style="background-image: url(<?php echo $siteBanner["ImagePath"] ?>)">
	<div class="container">
		<div class="row extra-very-small-screen align-items-center">
			<div class="col-lg-5 col-sm-8 position-relative page-title-extra-small"
				data-anime='{ "el": "childs", "opacity": [0, 1], "translateX": [-30, 0], "duration": 800, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
				<h1 class="mb-20px xs-mb-20px text-white text-shadow-medium">
					<span class="w-30px h-2px bg-yellow d-inline-block align-middle position-relative top-minus-2px me-10px"></span>
					<?php echo $_Util_PageConfig->GetConfig($_CURRENT_PAGE_CODE)->PageName() ?>
				</h1>
				<h2 class="text-white text-shadow-medium fw-500 ls-minus-2px mb-0"><?php echo ConvertNewLine($siteBanner["ImageDetail"]) ?></h2>
			</div>
		</div>
	</div>
</section>