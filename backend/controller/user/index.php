<?php
require_once("../../middleware/auth.php");

$users = UserDAO::getAllUsers($conn);


header('HTTP/1.1 200 OK');
ob_clean();
echo json_encode(["users" => $users], JSON_UNESCAPED_SLASHES);
