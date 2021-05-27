<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Headers: *");

echo json_encode(["Ok"=>"Welcome to Mateship's API"]);