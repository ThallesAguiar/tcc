<?php
require_once("../../middleware/auth.php");

$histories = HistoryDAO::getAllHistories($conn);


header('HTTP/1.1 200 OK');
ob_clean();
echo json_encode(["histories" => $histories], JSON_UNESCAPED_SLASHES);
