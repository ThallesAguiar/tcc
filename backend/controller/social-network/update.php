<?php
// require_once("../../middleware/auth.php");
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

$array = json_decode(file_get_contents("php://input"), true);

$socialNetworkVO = new SocialNetworkVO;

$socialNetworkVO->setId_social_network($array['id']);
$socialNetworkVO->setName($array['name']);
$socialNetworkVO->setLink($array['link']);

SocialNetworkDAO::update($socialNetworkVO, $conn);

header('HTTP/1.1 200 updated');
ob_clean();
echo json_encode(['success' => true, 'msg' => 'updated success']);