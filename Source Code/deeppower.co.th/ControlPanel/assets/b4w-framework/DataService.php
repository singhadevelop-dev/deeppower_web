<?php 
include_once  $GLOBALS["DOCUMENT_ROOT"] . "/ControlPanel/assets/b4w-framework/UtilService.php";
class DataService
{
    private static $instance = null;
    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (self::$instance == null)
        {
        self::$instance = new DataService();
        }
        return self::$instance;
    }

    public function AddViews($PortCode)
    {
        ExecuteSQL("Update portfolio set View=View+1 where Active = 1 and PortCode= :PortCode ", array('PortCode' => $PortCode));
    }
    public function AddViewProduct($productCode)
    {
        ExecuteSQL("Update product set View=View+1 where Active = 1 and ProductCode= :ProductCode ", array('ProductCode' => $productCode));
    }

    public function GetPortfolio($PortType,$CategoryCode = null,$tagCode = null,$search = null,$colOrderby = null,$nLimit = null,$new = null,$keys = array())
    {
        $values = array();
        $values['PortType'] = $PortType;
        $sql = "select a.*,b.CategoryName , c.SubCategoryName
        from portfolio a
        left join product_category b
            on a.CategoryCode = b.CategoryCode
        left join product_sub_category c
            on a.CategoryCode = c.CategoryCode and a.SubCategoryCode = c.SubCategoryCode
        where a.Active = 1 
        and a.PortType = :PortType ";
        if(!empty($CategoryCode))
        {
            $sql .= "  and b.CategoryCode= :CategoryCode  ";
            $values['CategoryCode'] = $CategoryCode;
        }
        if(!empty($keys["cat2"])){
            $sql .= "  and a.SubCategoryCode= :SubCategoryCode  ";
            $values['SubCategoryCode'] = $keys["cat2"];
        }
        if(!empty($tagCode))
        {
            $sql .= "  and a.Tag like :tagCode  ";
            $values['tagCode'] = "%$tagCode%";
        }
        if(!empty($search))
        {
            $sql .= " and (a.PortName like :search or a.Client like :search or a.PortCode= :portCode ) ";
            $values['search'] = "%$search%";
            $values['portCode'] = $search;
        }
        if(!empty($new) || $new == "0"){
            $sql .= " and new = :new  ";
            $values['new'] = $new;
        }
        $sql .= "  order by ". (empty($colOrderby) ? "" : $colOrderby.",") ." a.SEQ ASC, a.PortCode ASC  ";
        if(!empty($nLimit))
        {
            $sql .= "  limit $nLimit  ";
        }
        $datas = SelectRowsArray($sql, $values);
        return $datas;
    }

    public function GetPortfolioByCode($PortCode)
    {
        $sql = "select a.*,b.CategoryName,c.UserType,c.Image as UserImage
         from portfolio a
        left join product_category b
        on a.CategoryCode = b.CategoryCode
        left join user c
        on a.CreatedBy = c.UserCode
        where a.Active = 1 
        and a.PortCode= :portCode
        order by a.SEQ ASC Limit 1 ";
        $data = SelectRow($sql, array('portCode' => $PortCode));
        return $data;
    }

    public function GetCategory($portGroup,$CategoryCode = null)
    {
        $sql = "select a.*
         from product_category a
        where a.Active = 1 
        and a.CategoryGroup = :portGroup ";
        $values = array();
        $values['portGroup'] = $portGroup;
        if(!empty($CategoryCode))
        {
            $sql .= " and a.CategoryCode = :CategoryCode  ";
            $values['CategoryCode'] = $CategoryCode;
        }
        $sql .= "
            order by a.SEQ ASC , a.CategoryCode ASC
         ";
        $datas = SelectRowsArray($sql, $values);
        return $datas;
    }

    public function GetGallery($portType,$portCode = null)
    {
        $sql = "select b.PortCode,b.PortName, a.ImagePath
        from gallery  a
        INNER join portfolio b on a.RefCode = b.PortCode
        where b.PortType= :PortType
         ";
        $values = array();
        $values['PortType'] = $portType;
         if(!empty($portCode))
         {
            $sql .= " and a.RefCode= :RefCode ";
            $values['RefCode'] = $portCode;
         }
        $sql .= " order by a.ImageCode ";
        $datas = SelectRowsArray($sql, $values);
        return $datas;
    }

    public function GetGalleryMaster($RefCode)
    {
        $sql = "select * from gallery where RefCode = :RefCode and Active=1 order by SEQ,ImageCode ";
        $datas = SelectRowsArray($sql, array('RefCode' => $RefCode));
        return $datas;
    }

    public function GetTagMaster($tagType,$tagCode = null)
    {
        $sql = "select TagCode,TagName,TagType,FreeText from tag
         where Active=1 ";
         $values = array();
        if(!empty($tagCode))
        {
            $sql .= " and TagCode = :TagCode ";
            $values['TagCode'] = $tagCode;
        }
        if(!empty($tagType))
        {
            $sql .= " and TagType= :TagType ";
            $values['TagType'] = $tagType;
        }
        $sql .= " order by  SEQ,TagName ";
        $datas = SelectRowsArray($sql, $values);
        return $datas;
    }

    //Product 
    public function GetProduct($categoryCode,$productCode=null,$brandCode = null,$tagCode = null,$search = null
        ,$limit = null,$keys = array())
    {
        $_DISTINCT = "";
        $_JOIN_PROP = "";
        if(!empty($keys["prop"])){
            $_DISTINCT = " DISTINCT ";
            $_JOIN_PROP = " left join product_properties_mapping f on a.ProductCode = f.ProductCode ";
        }

        $sql = "select $_DISTINCT a.*, b.CategoryName
        ,a.Type as StatusCode
        ,d.TagName as StatusName 
        ,c.BrandName
        ,sub.SubCategoryName
        from product a 
        left join product_category b on a.CategoryCode = b.CategoryCode
        left join product_sub_category sub on a.SubCategoryCode = sub.SubCategoryCode
        left join product_brand c on a.BrandCode = c.BrandCode
        left join tag d on a.Type = d.TagCode and d.TagType='PRODUCT_STATUS'
        $_JOIN_PROP

        where a.Active = 1 ";
        $values = array();
        if(!empty($categoryCode))
        {
            $sql .= " and a.CategoryCode= :CategoryCode ";
            $values['CategoryCode'] = $categoryCode;
        }
        if(!empty($keys["cat2"]))
        {
            $sql .= " and a.SubCategoryCode= :cat2 ";
            $values['cat2'] = $keys["cat2"];
        }
        if(!empty($keys["cat3"]))
        {
            $sql .= " and a.SubCategoryCode3= :cat3 ";
            $values['cat3'] = $keys["cat3"];
        }
        if(!empty($keys["cat4"]))
        {
            $sql .= " and a.SubCategoryCode4= :cat4 ";
            $values['cat4'] = $keys["cat4"];
        }
        if(!empty($productCode))
        {
            $sql .= " and a.ProductCode= :productCode ";
            $values['productCode'] = $productCode;
        }
        if(!empty($brandCode))
        {
            $sql .= " and a.BrandCode= :brandCode ";
            $values['brandCode'] = $brandCode;
        }
        if(!empty($tagCode))
        {
            $sql .= " and a.Tag like :tagCode ";
            $values['tagCode'] = "%$tagCode%";
        }
        if(!empty($keys["New"])){
            $sql .= " and a.New= :New ";
            $values['New'] = $keys["New"];
        }
        if(!empty($keys["Hot"])){
            $sql .= " and a.Hot= :Hot ";
            $values['Hot'] = $keys["Hot"];
        }
        if(!empty($keys["Recommend"])){
            $sql .= " and a.Recommend= :Recommend ";
            $values['Recommend'] = $keys["Recommend"];
        }
        if(!empty($keys["fprice"])){
            $sql .= " and a.Price >= :fprice ";
            $values['fprice'] = $keys["fprice"];
        }
        if(!empty($keys["tprice"])){
            $sql .= " and a.Price <= :tprice ";
            $values['tprice'] = $keys["tprice"];
        }
        

        //***  keys */
        if(!empty($keys["floor"])){
            $sql .= " and a.FloorNumber= :floor ";
            $values['floor'] = $keys["floor"];
        }
        if(!empty($keys["area"])){
            $sql .= " and a.UsableArea= :area ";
            $values['area'] = $keys["area"];
        }
        if(!empty($keys["land"])){
            $sql .= " and a.LandArea= :land ";
            $values['land'] = $keys["land"];
        }
        if(!empty($keys["room"])){
            $sql .= " and a.BedRoom= :room ";
            $values['room'] = $keys["room"];
        }
        if(!empty($keys["toilet"])){
            $sql .= " and a.Toilet= :toilet ";
            $values['toilet'] = $keys["toilet"];
        }
        if(!empty($keys["parking"])){
            $sql .= " and a.ParkingSpace= :parking ";
            $values['parking'] = $keys["parking"];
        }
        if(!empty($keys["prop"])){
            $_props = array();
            $inx = 0;
            foreach ($keys["prop"] as $prop) {
                $inx++;
               array_push($_props,"f.PropCode= :PropCode$inx");
               $values['PropCode' . $inx] = $prop;
            }
            if(count($_props) > 0){
                $sql .= " and (". join(" or ",$_props) .") ";
            }
        }
        //** end */

        if(!empty($search))
        {
            $sql .= " and (
                a.ProductName like :search
                or b.CategoryName like :search
             ) ";
             //or c.BrandName like '%$search%'
             $values['search'] = "%$search%";
        }
        $sql .= " order by ". (empty($keys["orderby"]) ? "" : $keys["orderby"].",") ." a.SEQ asc, a.ProductCode asc ";
        if(!empty($limit)){
            $sql .= " limit $limit ";
        }
        $datas = SelectRowsArray($sql, $values);
        return $datas;
    }


    public function GetProductProperties($productCode,$isAllPropMaster = false)
    {
        $sql = "
          select  prop.*,map.Detail
            from product_properties prop
            ". ($isAllPropMaster ? " LEFT " : " INNER ") ." join product_properties_mapping map
                on map.PropCode = prop.PropCode 
                and map.ProductCode = '$productCode'
            where prop.Active = 1 
            order by prop.SEQ
        ";
        $datas = SelectRowsArray($sql);
        return $datas;
    }

    //end Product

}

//Share Social media
function GetUrlShareFacebook($url)
{
    return "window.open('http://www.facebook.com/sharer.php?u=".urlencode($url)."', '_blank', 'top=100,left=100,toolbar=0,status=0,width=620,height=400'); return false;";
}

function GetUrlShareLine($url)
{
    return "window.open('http://line.me/R/msg/text/?".$url."', 'share-dialog', 'width=550, height=436'); return false;";
}

function GetUrlShareLinkedin($url,$pageName)
{
    //return "window.open('https://www.linkedin.com/sharing/share-offsite/?url=".urlencode($url)."', '_blank', 'top=100,left=100,toolbar=0,status=0,width=620,height=400'); return false;";
    return "window.open('https://www.linkedin.com/shareArticle?mini=true&url=".urlencode($url)."&title=".$pageName."&source=LinkedIn', '_blank', 'top=100,left=100,toolbar=0,status=0,width=620,height=400'); return false;";
}

function GetUrlShareIG($url)
{
    return "window.open('https://www.instagram.com/?url=".$url."', '_blank', 'top=100,left=100,toolbar=0,status=0,width=620,height=400'); return false;";
}

function GetUrlShareTwitter($url,$title,$pageName)
{
    return "window.open('https://twitter.com/intent/tweet?source=".urlencode($url)."&text=$pageName".urlencode(" :: ").$title."', '_blank', 'top=100,left=100,toolbar=0,status=0,width=620,height=300'); return false;";
}

function GetUrlSharePinterest($url,$imageFullUrl)
{
    return "window.open('http://pinterest.com/pin/create/button/?url=".urlencode($url).(!empty($imageFullUrl) ? "&media=$imageFullUrl" : "")."', '_blank', 'top=100,left=100,toolbar=0,status=0,width=620,height=400'); return false;";
}

?>