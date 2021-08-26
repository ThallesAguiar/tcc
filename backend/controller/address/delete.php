<?php
/**nesta nestre controller ele somente irá desativar a empresa */
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
