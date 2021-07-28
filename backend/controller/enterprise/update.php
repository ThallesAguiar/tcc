<?php
// require_once("../../middleware/auth.php");
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

// $id = $_GET['id'];

$array = json_decode(file_get_contents("php://input"), true);

if ($userVerified->id_enterprise == $array['id_enterprise'] && $userVerified->businessman == 1) {
    $enterpriseVO = new EnterpriseVO;

    $enterpriseVO->setId_enterprise($array['id_enterprise']);
    $enterpriseVO->setCorporate_name($array['corporate_name']);
    $enterpriseVO->setFantasy_name($array['fantasy_name']);
    $enterpriseVO->setNumbering_company($array['numbering_company']);
    $enterpriseVO->setNumbering_personal($array['numbering_personal']);
    $enterpriseVO->setDescription($array['description']);
    $enterpriseVO->setEnterprise_type($array['enterprise_type']);

    EnterpriseDAO::updateEnterpriseById($enterpriseVO, $conn);

    $enterprise = EnterpriseDAO::getEnterpriseById($userVerified->id_enterprise, $conn);

    header('HTTP/1.1 200 updated');
    ob_clean();
    echo json_encode($enterprise);
} else if ($userVerified->businessman == 0) {
    header('HTTP/1.1 400 businessman false');
    ob_clean();
    echo json_encode(["error" => true, "msg" => "You aren't a businessman"]);
    die();
} else {
    header('HTTP/1.1 400 ID invalid');
    ob_clean();
    echo json_encode(["error" => true, "msg" => "This is not your ID"]);
    die();
}
