<?php 

$_COG_ALLOW_LEFT_MENU = true;
$_COG_ITEM_CODE = 'PRODUCT';
$_COG_ITEM_NAME = " Product";
$_COG_ICON = "fa-cubes";
$__COG_PROPERTIES_OPTION = false;

$_COG_ALLOW_MASTER_PROPERTIES = false;
$_COG_ALLOW_MASTER_PROPERTIES_TITLE = "Feature";

if($_COG_ALLOW_HEADER !== false){
?>

<div class="mat-box" style="margin-bottom: 0; border-radius: 3px 3px 0 0">
    <div class="row" style="margin-bottom: 0;">
        <div class="col-sm-9">
            <h3 style="margin: 0;"><i class="fa <?php echo $_COG_ICON ?> fa-fw"></i>
                <span class="analysis-left-menu-desc"><?php echo $_COG_ITEM_NAME ?></span></h3>
        </div>

        <div class="col-sm-3" style="padding-top: 5px;">
        </div>

    </div>
</div>

<?php } ?>