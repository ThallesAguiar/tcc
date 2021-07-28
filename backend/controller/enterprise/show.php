<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");

require_once("../../config/autoLoad.php");
require_once("../../config/connection.php");

$id = $_GET['id'];

$enterprise = EnterpriseDAO::getEnterpriseById($id, $conn);
header('HTTP/1.1 200 OK');
ob_clean();
echo json_encode($enterprise);
