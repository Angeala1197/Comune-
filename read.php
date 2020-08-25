<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// includiamo database.php e gioco.php per poterli usare
include_once '../config/database.php';
include_once '../models/gioco.php';
// creiamo un nuovo oggetto Database e ci colleghiamo al nostro database
$database = new Database();
$db = $database->getConnection();
// Creiamo un nuovo oggetto gioco
$libro = new Gioco($db);
// query products
$stmt = $gioco->read();
$num = $stmt->rowCount();
// se vengono trovati giochi nel database
if($num>0){
    // array dei giochi
    $giochi_arr = array();
    $giochi_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $gioco_item = array(
            "Codice" => $Codice,
            "Titolo" => $Titolo,
            "Anno" => $Anno
        );
        array_push($giochi_arr["records"], $gioco_item);
    }
    echo json_encode($giochi_arr);
}else{
    echo json_encode(
        array("message" => "Nessun Gioco Trovato.")
    );
}
?>
