<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");

$autor = $_GET['autor'];

$url = file_get_contents('https://pensador.uol.com.br/'.$autor.'/');


header('HTTP/1.1 200 OK');
ob_clean();
echo json_encode($url,JSON_UNESCAPED_SLASHES);