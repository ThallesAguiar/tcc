<?php
/**
 * Este middleware ele verifica se o usuario esta autenticado.
 * Ele deve ser o primeiro a ser chamado antes de tudo, pois se não ta autenticado, ele não pode prosseguir. 
 * */ 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

require_once("../middleware/auth.php");
require_once("../config/connection.php");