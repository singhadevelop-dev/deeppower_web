<?php

function GetDatabaseList(){
    
    return array(
        "EN" => "deeppower_en",
        "TH" => "deeppower_th",
    );
}

function GetCurrentLang()
{
    $_lang = $_COOKIE["_WEB_LANG"];
    $_lang = empty($_lang) ? "EN" : $_lang;
    return $_lang;
}

function GetDatabase()
{
    return GetDatabaseList()[GetCurrentLang()];
}

function GetPDOConnection($databaseName = ""){
    $servername = "localhost";
    $username = "deeppower_web";
    $password = "9uAJQQLaBKQn5StG6Rps";

    if(empty($databaseName)){
        $dbname = GetDatabase();
    }else{
        $dbname = $databaseName;
    }
    $mysql_connect_str = "mysql:host=$servername;dbname=$dbname";
    $dbConnection = new PDO($mysql_connect_str, $username, $password);

    $dbConnection->exec("set names utf8");
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    return $dbConnection;
}

?>