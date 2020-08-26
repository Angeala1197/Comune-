<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/gioco.php';

$database = new Database();
$db = $database->getConnection();
$gioco = new Gioco($db);
$data = json_decode(file_get_contents("php://input"));
if(
    !empty($data->Codice) &&
    !empty($data->Titolo) &&
    !empty($data->Anno)
){
    $libro->ISBN = $data->Codice;
    $libro->Titolo = $data->Titolo;
    $libro->Autore = $data->Anno;

    if($gioco->create()){
        http_response_code(201);
        echo json_encode(array("message" => "Gioco creato correttamente."));
    }
    else{
        //503 servizio non disponibile
        http_response_code(503);
        echo json_encode(array("message" => "Impossibile creare il gioco."));
    }
}
else{
    //400 bad request
    http_response_code(400);
    echo json_encode(array("message" => "Impossibile creare il gioco, i dati sono incompleti."));
}
?>
