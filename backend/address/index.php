<?php
require_once("../middleware/auth.php");

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
