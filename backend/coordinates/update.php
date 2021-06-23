<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods:  GET, POST, PATCH, PUT, DELETE, OPTIONS");

require_once("../config/autoLoad.php");
require_once("../config/connection.php");

$token = isset($_SERVER["HTTP_AUTHORIZATION"]) ? $_SERVER["HTTP_AUTHORIZATION"] : null;

$auth = new SessionDAO;

if (!$userVerified = $auth->verifyAuth($token)) {
    header('HTTP/1.1 400 token is not valid!');
    echo json_encode(["error" => true, "msg" => "Token is not valid!"]);
    die();
}

// $id = $_GET['id'];

if ($array = json_decode(file_get_contents("php://input"), true)) :
    if ($userVerified->id == $array['id_user']) {
        $userVO = new UserVO;

        $userVO->setId_user($userVerified->id);
        $userVO->setCoordinates($array['lat'] . " " . $array['lng']);

        UserDAO::updateCoordinatesUser($userVO, $conn);

        $coord = UserDAO::getCoordinates($userVerified->id, $conn);

        header('HTTP/1.1 200 updated');
        ob_clean();
        echo json_encode($coord);
    } else {
        header('HTTP/1.1 400 ID invalid');
        ob_clean();
        echo json_encode(["error" => true, "msg" => "This is not your ID"]);
        die();
    }
endif;
