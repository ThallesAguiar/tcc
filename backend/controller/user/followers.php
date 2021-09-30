<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods:  GET, POST, PATCH, PUT, DELETE, OPTIONS");

require_once("../../config/autoLoad.php");
require_once("../../config/connection.php");

$token = isset($_SERVER["HTTP_AUTHORIZATION"]) ? $_SERVER["HTTP_AUTHORIZATION"] : null;

$auth = new SessionDAO;

if (!$userVerified = $auth->verifyAuth($token)) {
    header('HTTP/1.1 400 token is not valid!');
    echo json_encode(["error" => true, "msg" => "Token is not valid!"]);
    die();
}

// $id = $_GET['id'];
// $users = UserDAO::followers($id, $conn);

$users = UserDAO::followers($userVerified->id, $conn);

if ($users == false) {
    header('HTTP/1.1 200 OK');
    ob_clean();
    echo json_encode(['vazio' => true, 'msg' => 'You still don\'t have followers']);
    die();
}

$total = count($users);

header('HTTP/1.1 200 OK');
ob_clean();
echo json_encode(['users'=>$users,'total'=>$total],JSON_UNESCAPED_SLASHES);
