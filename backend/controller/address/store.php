<?php
require_once("../../middleware/auth.php");

if ($userVerified->id && ($userVerified->businessman == true || 1) && $userVerified->id_enterprise != null) {
    if ($array = json_decode(file_get_contents("php://input"), true)) :

        $addressVO = new AddressVO;
        $addressVO->setStreet($array['street']);
        $addressVO->setNumber($array['number']);
        $addressVO->setComplement($array['complement']);
        $addressVO->setDistrict($array['district']);
        $addressVO->setCity($array['city']);
        $addressVO->setState($array['state']);
        $addressVO->setCountry($array['country']);
        $addressVO->setZipcode($array['zipcode']);

        AddressDAO::saveAddress($addressVO, $conn, $userVerified->id_enterprise);

        $address = AddressDAO::getAddressById($addressVO->getId_address(), $conn);

        header('HTTP/1.1 200 created');
        ob_clean();
        echo json_encode($address);

    endif;
} else {
    header('HTTP/1.1 400 negado');
    ob_clean();
    echo json_encode(["erro" => true, "msg" => "Você não possuí uma empresa ativa na sua conta"]);
}
