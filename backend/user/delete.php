<?php
require_once("../middleware/auth.php");

$id = $_GET['id'];

if ($userVerified->id == $id) {
    UserDAO::deleteUserById($userVerified->id, $conn);
    
    header('HTTP/1.1 200 Deleted');
    ob_clean();
    echo json_encode(["success" => true, "msg" => "User deleted"]);
} else {
    header('HTTP/1.1 400 ID invalid');
    ob_clean();
    echo json_encode(["error" => true, "msg" => "This is not your ID"]);
    die();
}
