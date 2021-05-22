<?php
require_once("../middleware/auth.php");
require_once('../global/headers.php');
require_once("../config/autoLoad.php");
require_once("../config/connection.php");

echo json_encode(["Ok"=>"Se voce ta vendo isso, é pq ta autenticado"]);