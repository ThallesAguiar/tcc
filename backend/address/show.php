<?php
require_once("../middleware/auth.php");

$id = $_GET['id'];

$address = AddressDAO::getAddressById($id, $conn);
header('HTTP/1.1 200 OK');
ob_clean();
echo json_encode($address);
