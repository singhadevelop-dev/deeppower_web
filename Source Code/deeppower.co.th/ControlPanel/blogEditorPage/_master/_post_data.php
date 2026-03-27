<?php 
include_once "../../../_cogs.php";
include "../../assets/b4w-framework/UtilService.php";
libxml_use_internal_errors(true);

try {
    $action = $_SERVER['REQUEST_METHOD'];
    switch($action)
    {
        case "POST" :
            if($_POST["action"] == "NEW"){
                $result = updateNew($_POST);
            }else if($_POST["action"] == "ACTIVE"){
                $result = updateActive($_POST);
            }else{
                throw new Exception("Not allowed function!");
            }
            OK("Post success.",$result);
            break;
        default : 
            throw new Exception("Not allowed function!");
    }
} catch (Exception $e) {
    BadRequest($e->getMessage(),null);
}

function updateNew($data)
{
    $active = $data["new"] == "true" ? 1 : 0;
    $sql = "update portfolio set New = :New where PortCode = :PortCode ";
    ExecuteSQL($sql,array('New' => $active,'PortCode' => $data["product"]));
    return $data;
}

function updateActive($data)
{
    $active = $data["active"] == "true" ? 1 : 0;
    $sql = "update portfolio set Active = :Active where PortCode = :PortCode ";
    ExecuteSQL($sql,array('Active' => $active,'PortCode' => $data["product"]));
    return $data;
}

function REP_SG($input){
    return str_replace("\"","",str_replace("'","’",$input));
}

    function OK($message,$result)
    {
        PrivateResponse("OK",200,$message,$result);
    }

    function BadRequest($message,$result)
    {
        PrivateResponse("BadRequest",200,$message,$result);
    }

    function PrivateResponse($status,$status_number,$message,$result)
    {
        header_remove();
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code($status_number);
        $dt = new DateTime("now", new DateTimeZone("Asia/Bangkok"));
        $post_data = array(
            'status' => $status,
            'message' => $message,
            'result' => $result,
            'result_time' => $dt->format(DATE_ISO8601));
        echo json_encode($post_data,JSON_UNESCAPED_UNICODE);
    }

?>
