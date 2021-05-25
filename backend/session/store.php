<?php
require_once('../global/headersNotAuthorizated.php');

if ($array = json_decode(file_get_contents("php://input"), true)) :
    $userVO = new UserVO;
    $userVO->setEmail($array['email']);
    $userVO->setPassword($array['password']);

    $sessionDAO = new SessionDAO;
    $sessionDAO->verifiryUser($userVO, $conn);

    $token = $sessionDAO->createToken($userVO);

    $array = [
        "user" => [
            "id_user" => $userVO->getId_user(),
            "name" => $userVO->getName(),
            "email" => $userVO->getEmail(),
            "bio" => $userVO->getBio(),
            "businessman" => $userVO->getBusinessman(),
            "id_enterprise" => $userVO->getId_enterprise(),
            "coordinates" => $userVO->getCoordinates()
        ],
        "token" => $token
    ];

    header('HTTP/1.1 200 Login success');
    ob_clean();
    echo json_encode($array);
endif;
