<?php
require_once("../../middleware/auth.php");

$id = $_GET['id'];

if ($userVerified->id_enterprise == $id && ($userVerified->businessman == true || 1)) {
    if ($array = json_decode(file_get_contents("php://input"), true)) :
        $enterpriseVO = new EnterpriseVO;

        $enterpriseVO->setId_enterprise($id);
        $enterpriseVO->setCompany_name($array['company_name']);
        $enterpriseVO->setFantasy_name($array['fantasy_name']);
        $enterpriseVO->setNumber_pj($array['number_pj']);
        $enterpriseVO->setNumber_pf($array['number_pf']);
        $enterpriseVO->setDescription($array['description']);
        $enterpriseVO->setType_company($array['type_company']);

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
