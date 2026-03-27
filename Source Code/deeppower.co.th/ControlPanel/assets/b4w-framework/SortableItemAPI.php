<?php
include "UtilService.php";
try{
    $table = $_POST["table"];
    $column_seq = $_POST["column_seq"];
    $column_key = $_POST["column_key"];
    $row_key_array = $_POST["row_key_array"];
    $arrSql = array();
    $values = array();
    $countItem = countval($row_key_array);
    for ($i = 0; $i < $countItem; $i++)
    {
    	$row_key = $row_key_array[$i];
        array_push($arrSql,"update $table set $column_seq = :num$i where $column_key = :row_key$i");
        $values["row_key$i"] = $row_key;
        $values["num$i"] = $i;
    }
    if($countItem > 0){
        ExecuteMultiSQL(join(";  ",$arrSql), $values);
    }
    echo "S";
}
catch(Exception $ex){
    echo $ex->getMessage();
}
?>