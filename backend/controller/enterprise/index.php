<?php
require_once("../../middleware/auth.php");

$enterprises = EnterpriseDAO::getAllEnterprises($conn);

$arrayAux = array();

foreach ($enterprises as $enterprise) {
    $enterpriseArray['id_enterprise'] = $enterprise->getId_enterprise();
    $enterpriseArray['company_name'] = $enterprise->getCompany_name();
    $enterpriseArray['fantasy_name'] = $enterprise->getFantasy_name();
    $enterpriseArray['number_pj'] = $enterprise->getNumber_pj();
    $enterpriseArray['number_pf'] = $enterprise->getNumber_pf();
    $enterpriseArray['description'] =  $enterprise->getDescription();
    $enterpriseArray['type_company'] = $enterprise->getType_company();
    $enterpriseArray['id_address'] = $enterprise->getId_address();
    
    $arrayAux[] = $enterpriseArray;
}

header('HTTP/1.1 200 OK');
ob_clean();
echo json_encode($arrayAux);
