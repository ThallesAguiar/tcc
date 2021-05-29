<?php
/**nesta nestre controller ele somente irá desativar a empresa */
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

    AddressDAO::deleteAddressById($enterprise['id_endereco'], $conn);

    header('HTTP/1.1 200 Deleted');
    ob_clean();
    echo json_encode(["success" => true, "msg" => "Address deleted"]);
