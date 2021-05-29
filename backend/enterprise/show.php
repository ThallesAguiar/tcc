<?php
require_once("../middleware/auth.php");

$id = $_GET['id'];

$enterprise = EnterpriseDAO::getEnterpriseById($id, $conn);
header('HTTP/1.1 200 OK');
ob_clean();
echo json_encode($enterprise);
