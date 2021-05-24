<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json;charset=utf-8");

$token = isset($_SERVER["HTTP_AUTHORIZATION"]) ? $_SERVER["HTTP_AUTHORIZATION"] : null;

if ($token) {
    require_once("../config/autoLoad.php");

    $auth = new SessionDAO;

    if (!$userVerified = $auth->verifyAuth($token)) {
        header('HTTP/1.1 400 token is not valid!');
        echo json_encode(["error" => "Token is not valid!"]);
        die();
    }

    require_once("../config/connection.php");
} else {
    header('HTTP/1.1 400 no token');
    echo json_encode(["error" => "You need a token to access this route."]);
    die();
}
