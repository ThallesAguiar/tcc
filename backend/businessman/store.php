<?php
// estes headers são obrigatórios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

require_once("../config/autoLoad.php");
require_once("../config/connection.php");

if($array = json_decode(file_get_contents("php://input"), true)):
    $userVO = new UserVO;
    $userDAO = new UserDAO;
    
    $userVO->setName($array['name']);
    $userVO->setLastname($array['lastname']);
    $userVO->setEmail($array['email']);
    $userVO->setBusinessman($array['businessman']);
    $userVO->setPassword($array['password']);
    $userVO->setBirthday($array['birthday']);
    $userVO->setGender($array['gender']);
    $userVO->setPhone($array['phone']);
    $userVO->setBio($array['bio']);
    $userVO->setAvatar($array['avatar']);
    $userVO->setCoordinates($array['lat']." ".$array['lng']);

    $userDAO->saveUser($userVO, $conn);

    header('HTTP/1.1 200 created');
    ob_clean();
    echo json_encode(["success" => true, "msg"=>"User created"], JSON_UNESCAPED_SLASHES);

endif;