<?php include_once "_cogs.php"; ?>
<?php include_once  $GLOBALS["DOCUMENT_ROOT"] . "/ControlPanel/assets/b4w-framework/UtilService.php"; ?>
<?php

$ClientID = GetCookieClientID();
$action = $_REQUEST["action"];
$RefCode = $_REQUEST["ref_code"];
$RefType = $_REQUEST["ref_type"];

if ($action == "FAVORITE_GET") {
    $sql = "select * from favorite where ClientID = :clinetId and RefCode = :refCode and RefType = :refType";
    $fav = SelectRow($sql, array('clinetId' => $ClientID, 'refCode' => $RefCode, 'refType' => $RefType));
    echo $fav["FavoriteCode"];
} else if ($action == "FAVORITE_SAVE") {

    $sql = "select * from favorite where ClientID = :clinetId and RefCode = :refCode and RefType = :refType";
    $fav = SelectRow($sql, array('clinetId' => $ClientID, 'refCode' => $RefCode, 'refType' => $RefType));
    if ($fav == false) {
        $favCode = GenerateNextID("favorite", "FavoriteCode", 20, "FAV");
        $sql = "insert into favorite (FavoriteCode,ClientID,RefCode,RefType,CreatedOn)
            values(
                :favCode
                ,:clientID
                ,:refCode
                ,:refType
                ,NOW()
            );";
        ExecuteSQL($sql, array(
            'favCode' => $favCode,
            'clientID' => $ClientID,
            'refCode' => $RefCode,
            'refType' => $RefType,
        ));
        echo $favCode;
    } else {
        $favCode = $fav["FavoriteCode"];
        $sql = "delete from favorite where FavoriteCode = :favorite";
        ExecuteSQL($sql, array('favorite' => $favCode));
        echo "";
    }
} else if ($action == "WISHLIST") {
    $sql = "
            select COUNT(*) as count from favorite f
            join product r on f.RefCode = r.ProductCode
            where f.RefType = r.ProductCode and f.ClientID = :clientId
        ";
    $favs = SelectRows($sql, array('clientId' => $ClientID));
    echo $favs["count"];
?>
    
        <?php
        // foreach ($favs as $fav) {
        //     $_PRO_URL = DetailPageURL($fav["Code"], $fav["Name"]);
        ?>

            <!-- <div class="cart_item">
                <div class="cart_img">
                    <a href="<?php //echo $_PRO_URL ?>"><img src="<?php //echo $fav["Image"]; ?>" alt="<?php //echo $fav["Name"] ?>"></a>
                </div>
                <div class="cart_info">
                    <a href="<?php //echo $_PRO_URL ?>"><?php //echo $fav["Name"] ?></a>
                    <p><span>฿<?php //echo number_format($fav["Price"]) ?></span></p>    
                </div>
                <div class="cart_remove">
                    <a href="#" data-action="FAVORITE" data-ref-code="<?php //echo $fav["Code"]; ?>" data-ref-type="PRODUCT" onclick="removeFavoriteItems(this);"><i class="ion-android-close"></i></a>
                </div>
            </div> -->
        <?php //} ?>
    
<?php
} else if ($action == "COMPARE_COUNT") {
    $sql = "select count(f.FavoriteCode) as items 
     from favorite f
     join product r on f.RefCode = r.ProductCode
      where f.ClientID = :clientId and f.RefType = 'COMPARE'";
    $fav = SelectRow($sql, array('clientId' => $ClientID));
    echo number_format($fav["items"]);
} else if ($action == "CART_ADD") {

    $amount = intval($_POST["amount"]);
    $size = $_POST["size"];
    $color = $_POST["color"];
    $sqlProduct = "select p.*,c.CategoryName from product p
                    join product_category c
                    on c.CategoryCode = p.CategoryCode
                    where p.productCode = :refCode";

    $dataPrd = SelectRow($sqlProduct, array('refCode' => $RefCode));
    $dataCart = GetCartRefProduct($ClientID,$RefCode,$size,$color);
    $values = array();
    if(isset($dataCart))
    {
        $sqlInsert = "update cart 
        set QTY = (QTY+$amount) 
        ,Total = (Price * QTY)  
        ,TotalBasePrice = (BasePrice * QTY)
        where ClientID = :ClientID and ProductCode = :ProductCode and SEQ = :SEQ ";
        $values = array(
            'ClientID' => $ClientID,
            'ProductCode' => $RefCode,
            'SEQ' => $dataCart["SEQ"]
        );
    }
    else
    {
        $sqlInsert = "insert into cart (ClientID,ProductCode,Price,BasePrice,QTY,Color,Size,Total,TotalBasePrice,Active,CreatedOn,CheckOutCode) values(
                 :ClientID
                ,:ProductCode
                ,:Price
                ,:BasePrice
                ,:QTY
                ,:Color
                ,:Size
                ,:Total
                ,:TotalBasePrice
                ,1
                ,NOW()
                ,''
            )
        ";
        $values = array(
            'ClientID' => $ClientID,
            'ProductCode' => $RefCode,
            'Price' => $dataPrd["Price"],
            'BasePrice' => $dataPrd["BasePrice"],
            'QTY' => $amount,
            'Color' => $color,
            'Size' => $size,
            'Total' => (floatval($dataPrd["Price"]) * $amount),
            'TotalBasePrice' => (floatval($dataPrd["BasePrice"]) * $amount),
        );
    }
    ExecuteSQL($sqlInsert, $values);
    echo $RefCode;
    
} else if ($action == "CART_DELETE") {
    $cartSEQ = $_POST["seq"];
    $sql = "delete from cart where ClientID = :ClientID and ProductCode = :ProductCode and SEQ = :SEQ ";
    ExecuteSQL($sql, array('ClientID' => $ClientID, 'ProductCode' => $RefCode, 'SEQ' => $cartSEQ));
    echo "";
} else if ($action == "CART_UPDATE") {
    $cartSEQ = $_POST["seq"];
    $cartAmount = intval($_POST["amount"]);
    $sql = "update cart set 
    QTY = :cartAmount
    ,Total = Price * :cartAmount  
    ,TotalBasePrice = BasePrice * :cartAmount
    where ClientID = :ClientID and ProductCode = :ProductCode and SEQ = :SEQ ";
    ExecuteSQL($sql, array('ClientID' => $ClientID, 'ProductCode' => $RefCode, 'SEQ' => $cartSEQ, 'cartAmount' => $cartAmount ));
    echo $cartSEQ;
}
else if($action == "CART_NUMBER")
{
    $sql = "
            select p.ProductCode,p.ProductName,p.Image
                ,c.CategoryName
                ,cart.QTY,cart.Price as CartPrice,cart.Total,cart.SEQ
                ,color.TagName as ColorName
                ,size.TagName  as SizeName
            from cart
            join product p on p.ProductCode = cart.ProductCode
            join product_category c  on c.CategoryCode = p.CategoryCode
            left join tag color on color.TagCode = cart.Color and color.TagType='COLOR'
            left join tag size on size.TagCode = cart.Size and size.TagType='SIZE'
            where cart.ClientID = :ClientID and cart.Active = 1 order by p.seq
        ";
        $carts = SelectRowsArray($sql, array('ClientID' => $ClientID));
    echo  number_format(count($carts));

}
else if($action == "CART_CHECK_BALANCE"){

    $sqlProduct = "select p.seq,p.ProductCode,p.ProductName,p.Image,'SHOP' as ShopCode, d.WebName as ShopName
                    ,c.CategoryName
                    ,cart.QTY,cart.Price as CartPrice,cart.Total,cart.SEQ
                    ,p.Amount
                    from cart
                    join product p
                        on p.ProductCode = cart.ProductCode
                    join product_category c
                        on c.CategoryCode = p.CategoryCode
                    left join website d on 1=1
                    where cart.ClientID = :ClientID and cart.Active = 1 order by p.seq,p.ProductCode,cart.SEQ";
    $dataPrd = SelectRowsArray($sqlProduct,array('ClientID' => $ClientID));
    $isBalance = false;
    if(count($dataPrd) > 0){
        $isBalance = true;
        foreach ($dataPrd as $cart) {
            if($cart["QTY"] > $cart["Amount"]){
                $isBalance = false;
            }
        }
    }
    echo $isBalance;
} 
else if ($action == "CART_LIST") {
    $sql = "
            select p.ProductCode,p.ProductName,p.Image
                ,c.CategoryName
                ,cart.QTY,cart.Price as CartPrice,cart.Total,cart.SEQ
                ,color.TagName as ColorName
                ,size.TagName  as SizeName
            from cart
            join product p on p.ProductCode = cart.ProductCode
            join product_category c  on c.CategoryCode = p.CategoryCode
            left join tag color on color.TagCode = cart.Color and color.TagType='COLOR'
            left join tag size on size.TagCode = cart.Size and size.TagType='SIZE'
            where cart.ClientID = :clientId and cart.Active = 1 order by p.seq
        ";
    $carts = SelectRows($sql, array('clientId' => $ClientID));
?>
        <?php
        $totalSummary = 0;
        foreach ($carts as $cart) {
            $totalSummary += intval($cart["Total"]);
            $_PRO_URL = DetailPageURL($cart["ProductCode"], $cart["ProductName"]);
        ?>
        <li class="cart_item">
			<div class="media">
				<a href="<?php echo $_PRO_URL ?>">
					<img class="me-3" src="<?php echo $cart["Image"]; ?>" alt="<?php echo $cart["ProductName"]; ?>">
				</a>
				<div class="media-body">
					<a href="<?php echo $_PRO_URL ?>"><h4><?php echo $cart["ProductName"]; ?></h4></a>
					<h4><span><?php echo $cart["QTY"]; ?> x ฿<?php echo number_format($cart["CartPrice"], 2); ?></span></h4>
				</div>
			</div>
			<div class="close-circle">
				<a href="#" data-ref-code="<?php echo $cart["ProductCode"] ?>" data-seq="<?php echo $cart["SEQ"] ?>" onclick="removeProductCartItems(this);"><i class="fa fa-times" aria-hidden="true"></i></a>
			</div>
		</li>
        <?php } ?>
        <li>
			<div class="total">
				<h5>subtotal : <span class="minicart-drop-total-price">฿<?php echo number_format($totalSummary, 2); ?></span></h5>
			</div>
		</li>
<?php
}


function GetCartRefProduct($clientID, $product, $size, $color)
{
    $sqlCart = "select * from cart 
    where ClientID = :ClientID 
    and ProductCode=:ProductCode
    and Color=:Color
    and Size=:Size
    and Active = 1";
    $dataCart = SelectRowsArray($sqlCart, array(
        'ClientID' => $clientID,
        'ProductCode' => $product,
        'Color' => $color,
        'Size' => $size
    ));
    if (count($dataCart) > 0) {
        return $dataCart[0];
    }
    return null;
}

?>