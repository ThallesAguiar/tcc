<?php
require_once('../global/headers.php');
require_once("../config/autoLoad.php");
require_once("../config/connection.php");

if ($array = json_decode(file_get_contents("php://input"), true)) :
    $userVO = new UserVO;
    $userVO->setEmail($array['email']);
    $userVO->setPassword($array['password']);

    $sessionDAO = new SessionDAO;
    $userVerified = $sessionDAO->verifiryUser($userVO, $conn);

    if ($userVerified) {
        $token = $sessionDAO->createToken($userVO);

        $array = [
            "user" => [
                "id_user" => $userVO->getId_user(),
                "nome" => $userVO->getName(),
                "email" => $userVO->getEmail(),
                "bio" => $userVO->getBio(),
                "businessman" => $userVO->getBusinessman(),
                "id_enterprise" => $userVO->getId_enterprise(),
                "coordinates" => $userVO->getCoordinates()
            ],
            "token" => $token
        ];
        echo json_encode($array);
    }
endif;
