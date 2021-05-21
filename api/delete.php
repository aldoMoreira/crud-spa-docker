<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
   
    include_once '../config/database.php';
    include_once '../class/developers.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Developer($db);
    
    $item->id = isset($_GET['id']) ? $_GET['id'] : die();

    if($item->deleteDeveloper()){
        http_response_code(204);
        echo json_encode('ok');
    } else{
        http_response_code(400);
        echo json_encode('error');
    }
?>