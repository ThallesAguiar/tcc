<?php
require_once("../global/headersNotAuthorizated.php");

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
    $userVO->setCoordinates($array['lat']." ".$array['lng']);

    $userDAO->saveUser($userVO, $conn);

endif;