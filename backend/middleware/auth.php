<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json;charset=utf-8");
header("Access-Control-Allow-Headers: *");
// header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
// ob_clean();

$token = isset($_SERVER["HTTP_AUTHORIZATION"]) ? $_SERVER["HTTP_AUTHORIZATION"] : null;

if ($token) {
    require_once("../../config/autoLoad.php");

    $auth = new SessionDAO;

    if (!$userVerified = $auth->verifyAuth($token)) {
        header('HTTP/1.1 400 token is not valid!');
        echo json_encode(["error" => true, "msg" => "Token is not valid!"]);
        die();
    }

    require_once("../../config/connection.php");
    require_once("../../functions/index.php");
    require_once("../../global/variablesGlobals.php");
} else {
    header('HTTP/1.1 400 no token');
    echo json_encode(["error" => true, "msg" => "You need a token to access this route."]);
    die();
}
