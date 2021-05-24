<?php
require_once("../middleware/auth.php");

$id = $_GET['id'];

$user = UserDAO::getUserById($id, $conn);

header('HTTP/1.1 200 OK');
echo json_encode($user,JSON_UNESCAPED_SLASHES);