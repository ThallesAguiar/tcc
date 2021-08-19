<?php
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

$id_user = $_GET['id'];

$login = SessionDAO::verifyStatusOnline($id_user, $conn);

date_default_timezone_set('America/Sao_Paulo');
$data['atual'] = date('Y-m-d H:i:s');
$data['online'] = strtotime($data['atual'] . "-1 minutes");
$data['online'] = date('Y-m-d H:i:s', $data['online']);


$last_login = new DateTime($login['end']);
$online = new DateTime($data['online']);

if ($last_login >= $online) {
    header('HTTP/1.1 200 OK');
    ob_clean();
    echo json_encode(['online' => true]);
    die();
} else {
    $end = date_create($login['end']);
    $on = date_create($data['online']);
    $diff = date_diff($end, $on);
    $qnt_days = $diff->format("%R%a days");

    if ($qnt_days <= 0) {
        $since_start = $last_login->diff($online);

        $hours =  $since_start->h . ' hours';
        $minutes =  $since_start->i . ' minutes';
        $seconds =  $since_start->s . ' seconds';

        if ($since_start->h == 0) {
            header('HTTP/1.1 200 OK');
            ob_clean();
            echo json_encode(['online' => false, 'time' => $minutes]);
            die();
        } elseif ($since_start->h == 1) {
            header('HTTP/1.1 200 OK');
            ob_clean();
            echo json_encode(['online' => false, 'time' => $since_start->h . ' hour']); //singular
            die();
        }

        header('HTTP/1.1 200 OK');
        ob_clean();
        echo json_encode(['online' => false, 'time' => $hours]);
        die();
    }

    header('HTTP/1.1 200 OK');
    ob_clean();
    echo json_encode(['online' => false, 'time' => $qnt_days]);
    die();
}
