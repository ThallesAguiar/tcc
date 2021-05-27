<?php
require_once("../middleware/auth.php");

$id = $_GET['id'];

if ($userVerified->id == $id && $userVerified->businessman == true) {
    if ($array = json_decode(file_get_contents("php://input"), true)) :
        $userVO = new UserVO;

        $userVO->setId_user($userVerified->id);
        $userVO->setName($array['name']);
        $userVO->setLastname($array['lastname']);
        $userVO->setEmail($array['email']);
        $userVO->setPassword(md5($array['password']));
        $userVO->setBirthday($array['birthday']);
        $userVO->setGender($array['gender']);
        $userVO->setPhone($array['phone']);
        $userVO->setBio($array['bio']);
        $userVO->setAvatar($array['avatar']);

        UserDAO::updateUserById($userVO, $conn);

        $user = UserDAO::getUserById($userVerified->id, $conn);

        header('HTTP/1.1 200 updated');
        ob_clean();
        echo json_encode(["user" => $user], JSON_UNESCAPED_SLASHES);


    endif;
} else if ($userVerified->businessman == false) {
    header('HTTP/1.1 400 businessman false');
    ob_clean();
    echo json_encode(["error" => true, "msg" => "You aren't a businessman"]);
    die();
} else {
    header('HTTP/1.1 400 ID invalid');
    ob_clean();
    echo json_encode(["error" => true, "msg" => "This is not your ID"]);
    die();
}
