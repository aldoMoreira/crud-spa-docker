<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/developers.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Developer($db);

    $stmt = $items->getDevelopers();
    $itemCount = $stmt->rowCount();
    
    if($itemCount > 0){
        
        $developerArr = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "nome" => $nome,
                "sexo" => $sexo,
                "idade" => $idade,
                "hobby" => $hobby,
                "dnascto" => $dnascto
            );

            array_push($developerArr, $e);
        }
        http_response_code(200);
        echo json_encode($developerArr);
}

    else{
        http_response_code(404);
        echo json_encode(
            array('message' => 'Nenhum registro encontrado.')
        );
    }
?>