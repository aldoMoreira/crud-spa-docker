<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../class/developers.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Developer($db);

    $data = json_decode(file_get_contents('php://input'));

    $item->nome = $data->nome;
    $item->sexo = $data->sexo;
    $item->idade = $data->idade;
    $item->hobby = $data->hobby;
    $item->dnascto = $data->dnascto;
    
    if($item->createDeveloper()){
        http_response_code(201);
        echo 'ok';
    } else{
        http_response_code(400);
        echo 'error';
    }
?>
