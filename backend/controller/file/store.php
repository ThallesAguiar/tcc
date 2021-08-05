<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");


$tipos_permitidos = ['image/gif','image/png','image/jpg','image/jpeg'];

if(!in_array($_FILES['file']['type'], $tipos_permitidos)){
    echo json_encode(['erro'=>true, 'msg'=>'Tipo de arquivo não permitido']);
    die();
}

// echo json_encode($_FILES['file'],JSON_UNESCAPED_SLASHES);
// die();
require "../../vendor/autoload.php";
require "../../global/variablesGlobals.php";

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;


// Instantiate an Amazon S3 client.
$s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'us-east-1',
    'credentials' => [
        'key'    => ACCESS_KEY,
        'secret' => SECRET_KEY
    ]
]);
$name_img = md5(date('H:i:s').rand()).$_FILES['file']['name'];
// Upload a publicly accessible file. The file size and type are determined by the SDK.
try {
    $response = $s3->putObject([
        'Bucket' => "matche",
        'Key'    => $name_img,
        'SourceFile' => $_FILES['file']['tmp_name'],
        // 'Body'   => fopen('https://matche.s3.amazonaws.com/'.$name_img.'', 'r'),
        'ACL'    => 'public-read',
    ]);

    echo json_encode($response['ObjectURL'],JSON_UNESCAPED_SLASHES);

}catch (Exception $e) {
    echo "Erro > {$e->getMessage()}";
}