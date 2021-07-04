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

$id_user = $_GET['id'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$range = isset($_GET['range']) ? $_GET['range'] : 10;
$unit = isset($_GET['unit']) ? $_GET['unit'] : 'kilometres';

$users = SearchDAO::calculateDistance($id_user, $lat, $lng, $range, $unit, $conn);

foreach ($users as $user) {
    $user['distance'] = number_format($user['distance'], 2, '.', '');
    $makers[] = $user;
}

if($unit == "kilometres"){
    $unit = "Km";
}else if($unit == "miles"){
    $unit = "Mi";
}


header('HTTP/1.1 200 OK');
ob_clean();
echo json_encode(["unit"=>$unit, "range"=>$range, "markers" => $makers], JSON_UNESCAPED_SLASHES);
