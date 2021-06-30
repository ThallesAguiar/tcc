<?php
require_once("../../middleware/auth.php");

$enterprises = EnterpriseDAO::getAllEnterprises($conn);

$arrayAux = array();

foreach ($enterprises as $enterprise) {
    $enterpriseArray['id_enterprise'] = $enterprise->getId_enterprise();
    $enterpriseArray['corporate_name'] = $enterprise->getCorporate_name();
    $enterpriseArray['fantasy_name'] = $enterprise->getFantasy_name();
    $enterpriseArray['numbering_company'] = $enterprise->getNumbering_company();
    $enterpriseArray['numbering_personal'] = $enterprise->getNumbering_personal();
    $enterpriseArray['description'] =  $enterprise->getDescription();
    $enterpriseArray['enterprise_type'] = $enterprise->getEnterprise_type();
    $enterpriseArray['id_address'] = $enterprise->getId_address();
    
    $arrayAux[] = $enterpriseArray;
}

header('HTTP/1.1 200 OK');
ob_clean();
echo json_encode($arrayAux);
