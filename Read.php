include_once '../config/database.php';
include_once '../models/gioco.php';

$database = new Database();
$db = $database->getConnection();

$gioco = new Gioco($db);
$stmt = $gioco->read();
$num = $stmt->rowCount();

if($num>0){
    $giochi_arr = array();
    $giochi_arr["elenco"] = array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $libro_item = array(
            "Codice" => $codice,
            "Titolo" => $titolo,
            "Anno" => $anno
        );

        array_push($giochi_arr["elenco"], $gioco_item);
    }

    http_response_code(200);
    echo json_encode($giochi_arr);
}else{

    http_response_code(404);

    echo json_encode(
        array("message" => "Nessun gioco trovato a GameStop.")
    );
}
