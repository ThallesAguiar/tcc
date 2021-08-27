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

$addressVO = new AddressVO;

if ($userVerified->id && ($userVerified->businessman == true || 1) && $userVerified->id_enterprise != null) {
    if ($array = json_decode(file_get_contents("php://input"), true)) :
        
        $addressVO->setStreet($array['street']);
        $addressVO->setNumber($array['number']);
        $addressVO->setComplement($array['complement']);
        $addressVO->setDistrict($array['district']);
        $addressVO->setCity($array['city']);
        $addressVO->setState($array['state']);
        $addressVO->setCountry($array['country']);
        $addressVO->setZipcode($array['zipcode']);

        if ($array['street'] == null && $array['district'] == null && $array['zipcode'] == null && $array['state'] == null) {
            UserDAO::addLocation($addressVO, $userVerified->id, $conn);
            header('HTTP/1.1 200 created');
            ob_clean();
            echo json_encode(['success' => true, 'msg' => 'Address added']);
            die();
        }

        AddressDAO::saveAddress($addressVO, $conn, $userVerified->id_enterprise);

        $address = AddressDAO::getAddressById($addressVO->getId_address(), $conn);

        header('HTTP/1.1 200 created');
        ob_clean();
        echo json_encode($address);

    endif;
} else {
    if ($array = json_decode(file_get_contents("php://input"), true)) :

        $addressVO->setCity($array['city']);
        $addressVO->setCountry($array['country']);

        UserDAO::addLocation($addressVO, $userVerified->id, $conn);

        header('HTTP/1.1 200 created');
        ob_clean();
        echo json_encode(['success' => true, 'msg' => 'Address added']);

    endif;
}
