<?php
require_once("../../middleware/auth.php");

$id_user = $_GET['id'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$range = isset($_GET['range']) ? $_GET['range'] : 10;
$unit = isset($_GET['unit']) ? $_GET['unit'] : 'kilometres';

$users = SearchDAO::calculateDistance($id_user, $lat, $lng, $range, $unit, $conn);

foreach ($users as $user) {
    unset($user['coordinates']);
    $makers[] = $user;
}

header('HTTP/1.1 200 OK');
ob_clean();
echo json_encode(["markers" => $makers], JSON_UNESCAPED_SLASHES);
