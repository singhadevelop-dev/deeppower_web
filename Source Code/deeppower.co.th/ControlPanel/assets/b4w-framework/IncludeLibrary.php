<?php include_once $GLOBALS['DOCUMENT_ROOT'] . "/_cogs.php"; ?>
<!-- Meta -->
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<script>
    var _root_path_includelibrary = "<?php echo $GLOBALS["ROOT"] ?>";
    var __dtag__ = "SHOP_CPNTROL_CLIENT_ID_COOKIE";
    var __device__id__ = "<?php echo GetCookieClientID(); ?>";
</script>
<!-- Favicon -->
<?php
$__IMG_LOGO = $_Util_WebsitDetail["Image3"];
if (!file_exists(strtok($_SERVER["DOCUMENT_ROOT"] . $__IMG_LOGO, '?'))) {
    $__IMG_LOGO = $GLOBALS["ROOT"] . "/ControlPanel/assets/images/cp.png";
}
?>
<link rel="shortcut icon" class="img-head-logo" href="<?php echo $__IMG_LOGO ?>">
<!-- Bootstrap Core CSS -->
<link href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/css/bootstrap.min.css" rel="stylesheet">
<!-- Control Panel CSS -->
<link href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/css/control-panel-v2.css" rel="stylesheet">
<!-- Font Icon -->
<link href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/et-line-font/et-line-font.css" rel="stylesheet">
<!-- Google Fonts-->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">
<!-- JS & Library -->
<script src="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/js/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/js/bootstrap.min.js" type="text/javascript"></script>
<link href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/b4w-library/datetimepicker/bootstrap-datetimepicker.css" rel="stylesheet" />
<script src="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/b4w-library/datetimepicker/bootstrap-datetimepicker.js"></script>
<link href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/b4w-library/sweet-alert/sweetalert.css" rel="stylesheet" type="text/css">
<script src="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/b4w-library/sweet-alert/sweetalert.min.js"></script>
<script src="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/b4w-library/script-center/input-mask.js"></script>
<script src="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/b4w-library/script-center/script-center.js?vs=2"></script>
<script src="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/b4w-library/numberformat.js"></script>
<!-- Data Table -->
<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/b4w-library/datatable/media/css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/b4w-library/datatable/resources/syntax/shCore.css" />
<script src="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/b4w-library/datatable/media/js/jquery.dataTables.min.js"></script>
<!-- include summernote css/js-->
<link href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/b4w-library/summernote/summernote.css" rel="stylesheet">
<script src="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/b4w-library/summernote/summernote.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- include summernote css/js-->
<!--<link href="<?php //echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/b4w-library/summernote/summernote.css" rel="stylesheet">-->
<link rel="stylesheet" href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/b4w-library/magnificpopup/magnific-popup.css">
<script src="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/b4w-library/script-center/PostAPI.js?vs=1.01"></script>

<link href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/fontawesome6/css/fontawesome.css" rel="stylesheet">
<link href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/fontawesome6/css/brands.css" rel="stylesheet">
<link href="<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/fontawesome6/css/solid.css" rel="stylesheet">