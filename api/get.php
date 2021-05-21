<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/developers.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Developer($db);

    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getSingleDeveloper();

    if($item->nome != null){
        $dev_arr = array(
            "id" =>  $item->id,
            "nome" => $item->nome,
            "sexo" => $item->sexo,
            "idade" => $item->idade,
            "hobby" => $item->hobby,
            "dnascto" => $item->dnascto
        );
      
        http_response_code(200);
        echo json_encode($dev_arr);
    } else {
        http_response_code(404);
        echo json_encode('error');
    }
?>