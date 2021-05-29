<?php
require_once("../middleware/auth.php");

$id = $_GET['id'];

if ($userVerified->id == $id) {
    if ($array = json_decode(file_get_contents("php://input"), true)) :
        $userVO = new UserVO;

        $userVO->setId_user($userVerified->id);
        $userVO->setCoordinates($array['lat'] . " " . $array['lng']);

        UserDAO::updateCoordinatesUser($userVO, $conn);

        $coord = UserDAO::getCoordinates($userVerified->id, $conn);

        header('HTTP/1.1 200 updated');
        ob_clean();
        echo json_encode($coord);


    endif;
} else {
    header('HTTP/1.1 400 ID invalid');
    ob_clean();
    echo json_encode(["error" => true, "msg" => "This is not your ID"]);
    die();
}
