<?php
require_once("../config/autoLoad.php");

$auth = new SessionDAO;

$token = isset($_SERVER["HTTP_AUTHORIZATION"]) ? $_SERVER["HTTP_AUTHORIZATION"] : null;

$tokenVerified = $auth->verifyAuth($token);

if (!$tokenVerified) {
    header("Content-Type: application/json; charset=utf-8");
    header('HTTP/1.1 400 token is not valid!');
    echo json_encode(["error" => "Token is not valid!"]);
    die();
}
