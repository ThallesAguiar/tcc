<?php
require_once("../middleware/auth.php");

if ($userVerified->id_enterprise != null) {
    EnterpriseDAO::reactivateCompany($userVerified->id_enterprise, $conn);
    $enterprise = EnterpriseDAO::getEnterpriseById($userVerified->id_enterprise, $conn);
    header('HTTP/1.1 200 reactivated');
    ob_clean();
    echo json_encode($enterprise);
} else if ($userVerified->id && ($userVerified->businessman == false || 0) && $userVerified->id_enterprise == null) {
    if ($array = json_decode(file_get_contents("php://input"), true)) :
        $enterpriseVO = new EnterpriseVO;
        $enterpriseDAO = new EnterpriseDAO;

        $enterpriseVO->setCompany_name($array['company_name']);
        $enterpriseVO->setFantasy_name($array['fantasy_name']);
        $enterpriseVO->setNumber_pj($array['number_pj']);
        $enterpriseVO->setNumber_pf($array['number_pf']);
        $enterpriseVO->setDescription($array['description']);
        $enterpriseVO->setType_company($array['type_company']);

        $enterpriseDAO->saveEnterprise($enterpriseVO, $userVerified->id, $conn);

        $enterprise = EnterpriseDAO::getEnterpriseById($enterpriseVO->getId_enterprise(), $conn);

        header('HTTP/1.1 200 created');
        ob_clean();
        echo json_encode($enterprise);

    endif;
} else {
    header('HTTP/1.1 400 negado');
    ob_clean();
    echo json_encode(["erro" => true, "msg" => "Você já possuí uma empresa ativa na sua conta"]);
}
