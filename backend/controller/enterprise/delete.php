<?php
/**nesta nestre controller ele somente irá desativar a empresa */
require_once("../../middleware/auth.php");

$id = $_GET['id'];

if ($userVerified->id_enterprise == $id) {
    EnterpriseDAO::disableCompany($userVerified->id, $conn);

    header('HTTP/1.1 200 Disabled');
    ob_clean();
    echo json_encode(["success" => true, "msg" => "Enterprise disabled"]);
} else {
    header('HTTP/1.1 400 ID invalid');
    ob_clean();
    echo json_encode(["error" => true, "msg" => "This is not your ID"]);
    die();
}
