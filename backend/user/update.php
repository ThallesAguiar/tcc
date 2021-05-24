<?php
require_once("../middleware/auth.php");

$id = $_GET['id'];

if ($userVerified->id === $id) {
    if ($array = json_decode(file_get_contents("php://input"), true)) :
        $userVO = new UserVO;

        $userVO->setId_user($userVerified->id);
        $userVO->setName($array['name']);
        $userVO->setLastname($array['lastname']);
        $userVO->setEmail($array['email']);
        $userVO->setBusinessman($array['businessman']);
        $userVO->setPassword($array['password']);
        $userVO->setBirthday($array['birthday']);
        $userVO->setGender($array['gender']);
        $userVO->setPhone($array['phone']);
        $userVO->setBio($array['bio']);
        $userVO->setCoordinates($array['lat'] . " " . $array['lng']);

        var_dump($userVO);
        // UserDAO::updateUserById($userVO, $conn);

    endif;
} else {
    header('HTTP/1.1 400 ID invalid');
    echo json_encode(["error" => "This is not your ID"]);
    die();
}
