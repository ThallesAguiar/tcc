<?php
// estes headers são obrigatórios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Headers: *");

require_once("../../config/autoLoad.php");
require_once("../../config/connection.php");

if($array = json_decode(file_get_contents("php://input"), true)):
    $historyVO = new HistoryVO;
    $historyDAO = new HistoryDAO;
    
    $historyVO->setId_user($array['id_user']);
    $historyVO->setDescription($array['description']);

    $historyDAO->saveHistory($historyVO, $conn);

    header('HTTP/1.1 200 created');
    ob_clean();
    echo json_encode(["success" => true, "msg"=>"History created"], JSON_UNESCAPED_SLASHES);

endif;