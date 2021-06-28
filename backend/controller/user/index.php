<?php
require_once("../../middleware/auth.php");

$users = UserDAO::getAllUsers($conn);

$arrayAux = array();

foreach ($users as $user) {
    $userArray['id_user'] = $user->getId_user();
    $userArray['email'] = $user->getEmail();
    $userArray['name'] = $user->getName();
    $userArray['lastname'] = $user->getLastname();
    $userArray['birthday'] = $user->getBirthday();
    $userArray['gender'] =  $user->getGender();
    $userArray['phone'] = $user->getPhone();
    $userArray['avatar'] = $user->getAvatar();
    $userArray['bio'] = $user->getBio();
    $userArray['status'] = $user->getStatus();
    $userArray['businessman'] = $user->getBusinessman();
    $userArray['id_enterprise'] = $user->getId_enterprise();
    $userArray['coordinates'] = $user->getCoordinates();

    $arrayAux[] = $userArray;
}

header('HTTP/1.1 200 OK');
ob_clean();
echo json_encode(["users" => $arrayAux], JSON_UNESCAPED_SLASHES);
