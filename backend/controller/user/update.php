<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods:  GET, POST, PATCH, PUT, DELETE, OPTIONS");

require_once("../../config/autoLoad.php");
require_once("../../config/connection.php");

$token = isset($_SERVER["HTTP_AUTHORIZATION"]) ? $_SERVER["HTTP_AUTHORIZATION"] : null;

$auth = new SessionDAO;

if (!$userVerified = $auth->verifyAuth($token)) {
    header('HTTP/1.1 400 token is not valid!');
    echo json_encode(["error" => true, "msg" => "Token is not valid!"]);
    die();
}

if ($array = json_decode(file_get_contents("php://input"), true)) :
    /**Entrará nesta condição se o usuario quando esta se castrando não quiser mais ser do tipo empreendedor */
    if (($array['type_update'] == "ImNotBusinessman")  && ($userVerified->businessman == 1 || true) && ($userVerified->id_enterprise != true)) {
        UserDAO::ImNotBusinessman($array['id_user'], $conn);
        header('HTTP/1.1 200 Success');
        ob_clean();
        echo json_encode(["success" => true, "msg" => "You aren't longer an entrepreneur"]);
        die();
    } else {
        // if ($userVerified->id == $array['id_user']) {
        $userVO = new UserVO;

        $userVO->setId_user($array['id_user']);
        $userVO->setName($array['name']);
        $userVO->setLastname($array['lastname']);
        $userVO->setEmail($array['email']);
        $userVO->setBusinessman($array['businessman']);
        $userVO->setPassword(isset($array['password']) ? $array['password'] : null);
        $userVO->setBirthday($array['birthday']);
        $userVO->setGender($array['gender']);
        $userVO->setPhone($array['phone']);
        $userVO->setBio($array['bio']);
        $userVO->setAvatar($array['avatar']);

        UserDAO::updateUserById($userVO, $conn);

        $user = UserDAO::getUserById($array['id_user'], $conn);

        header('HTTP/1.1 200 updated');
        ob_clean();
        echo json_encode(["user" => $user], JSON_UNESCAPED_SLASHES);
    }
endif;
