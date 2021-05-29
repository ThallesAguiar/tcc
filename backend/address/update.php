<?php
require_once("../middleware/auth.php");

if (!$userVerified->id_enterprise && $userVerified->businessman == false || 0) {
    header('HTTP/1.1 400 businessman false');
    ob_clean();
    echo json_encode(["error" => true, "msg" => "You aren't a businessman"]);
    die();
}

$enterprise = EnterpriseDAO::getEnterpriseById($userVerified->id_enterprise, $conn);

if (!$enterprise['id_endereco']) {
    header('HTTP/1.1 400 address false');
    ob_clean();
    echo json_encode(["error" => true, "msg" => "You don't have an address"]);
    die();
}

if ($array = json_decode(file_get_contents("php://input"), true)) :

    if (!$array['id_address']) {
        header('HTTP/1.1 400 ID null');
        ob_clean();
        echo json_encode(["error" => true, "msg" => "You need to pass a valid id"]);
        die();
    }
    
    $addressVO = new AddressVO;

    $addressVO->setId_address($array['id_address']);
    $addressVO->setStreet($array['street']);
    $addressVO->setNumber($array['number']);
    $addressVO->setComplement($array['complement']);
    $addressVO->setDistrict($array['district']);
    $addressVO->setCity($array['city']);
    $addressVO->setState($array['state']);
    $addressVO->setCountry($array['country']);
    $addressVO->setZipcode($array['zipcode']);

    AddressDAO::updateAddressById($addressVO, $conn);

    $address = AddressDAO::getAddressById($addressVO->getId_address(), $conn);

    header('HTTP/1.1 200 updated');
    ob_clean();
    echo json_encode($address);
endif;
