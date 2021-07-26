<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Headers: *");

require_once("../../config/autoLoad.php");
require_once("../../config/connection.php");

$id_user = $_GET['id'];

$history = HistoryDAO::getHistoryByIdUser($id_user, $conn);

header('HTTP/1.1 200 OK');
ob_clean();
echo json_encode(["history" => $history],JSON_UNESCAPED_SLASHES);