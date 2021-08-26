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

$addresses = AddressDAO::getAllAddresses($conn);

$arrayAux = array();

foreach ($addresses as $address) {
    $addressArray['id_address'] = $address->getId_address();
    $addressArray['street'] = $address->getStreet();
    $addressArray['number'] = $address->getNumber();
    $addressArray['complement'] = $address->getComplement();
    $addressArray['district'] = $address->getDistrict();
    $addressArray['city'] =  $address->getCity();
    $addressArray['state'] = $address->getState();
    $addressArray['country'] = $address->getCountry();
    $addressArray['zipcode'] = $address->getZipcode();

    $arrayAux[] = $addressArray;
}

header('HTTP/1.1 200 OK');
ob_clean();
echo json_encode($arrayAux);
