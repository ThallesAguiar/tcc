<?php
require_once("../../middleware/auth.php");

$id = $_GET['id'];

if ($userVerified->id_enterprise == $id && ($userVerified->businessman == true || 1)) {
    if ($array = json_decode(file_get_contents("php://input"), true)) :
        $enterpriseVO = new EnterpriseVO;

        $enterpriseVO->setId_enterprise($id);
        $enterpriseVO->setCorporate_name($array['corporate_name']);
        $enterpriseVO->setFantasy_name($array['fantasy_name']);
        $enterpriseVO->setNumbering_company($array['numbering_company']);
        $enterpriseVO->getNumbering_personal($array['numbering_personal']);
        $enterpriseVO->setDescription($array['description']);
        $enterpriseVO->setEnterprise_type($array['enterprise_type']);

        EnterpriseDAO::updateEnterpriseById($enterpriseVO, $conn);

        $enterprise = EnterpriseDAO::getEnterpriseById($userVerified->id_enterprise, $conn);

        header('HTTP/1.1 200 updated');
        ob_clean();
        echo json_encode($enterprise);
    endif;
} else if ($userVerified->businessman == false) {
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
