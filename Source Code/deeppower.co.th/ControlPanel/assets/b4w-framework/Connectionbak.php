<?php

function GetDatabaseList(){
    if(strpos(strtolower($_SERVER["HTTP_HOST"]), 'exciting-clarke.150-95-31-141.plesk.page') !== false){
        return array(
            "TH" => "clarke_150_v3_th",
            "EN" => "clarke_150_v3_en"
        );
    }
    return array(
        "TH" => "sonepart_v3_th",
        "EN" => "sonepart_v3_en"
    );
}

function GetCurrentLang()
{
    $_lang = $_COOKIE["_WEB_LANG"];
    $_lang = empty($_lang) ? "TH" : $_lang;
    return $_lang;
}

function GetDatabase()
{
    return GetDatabaseList()[GetCurrentLang()];
}

// function GetConnection($databaseName = "")
// {

//     $servername = "206.189.38.60";
//     $username = "db";
//     $password = "boonting1q2w3e4r";

//     if(strpos(strtolower($_SERVER["HTTP_HOST"]), 'soneparthailand.com') !== false){
//         // $servername = "150.95.31.141";
//         $servername = "localhost";
//         $username = "sonepart";
//         $password = "Q@p3ck96";
//     }else if(strpos(strtolower($_SERVER["HTTP_HOST"]), 'exciting-clarke.150-95-31-141.plesk.page') !== false){
//         // $servername = "150.95.31.141";
//         $servername = "localhost";
//         $username = "clarke_150";
//         $password = "7#flc741F";
//     }
    
//     if(empty($databaseName)){
//         $dbname = GetDatabase();
//     }else{
//         $dbname = $databaseName;
//     }
    
    

//     // Create connection
//     $conn = new mysqli($servername, $username, $password, $dbname);

//     // Check connection
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     } 
    
//     mysqli_query($conn,"SET character_set_results=utf8");
//     mysqli_query($conn,"SET character_set_client=utf8");
//     mysqli_query($conn,"SET character_set_connection=utf8");
    
//     return $conn;
// }

// function GetConnection($databaseName = "")
// {

//     $servername = "206.189.38.60";
//     $username = "db";
//     $password = "boonting1q2w3e4r";

//     if(strpos(strtolower($_SERVER["HTTP_HOST"]), 'soneparthailand.com') !== false){
//         // $servername = "150.95.31.141";
//         $servername = "localhost";
//         $username = "sonepart";
//         $password = "Q@p3ck96";
//     }else if(strpos(strtolower($_SERVER["HTTP_HOST"]), 'exciting-clarke.150-95-31-141.plesk.page') !== false){
//         // $servername = "150.95.31.141";
//         $servername = "localhost";
//         $username = "clarke_150";
//         $password = "7#flc741F";
//     }
    
//     if(empty($databaseName)){
//         $dbname = GetDatabase();
//     }else{
//         $dbname = $databaseName;
//     }
    
//     // Create connection
//     $conn = new mysqli($servername, $username, $password, $dbname);

//     // Check connection
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     } 
    
//     mysqli_query($conn,"SET character_set_results=utf8");
//     mysqli_query($conn,"SET character_set_client=utf8");
//     mysqli_query($conn,"SET character_set_connection=utf8");
    
//     return $conn;
// }


?>