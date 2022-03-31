<?php

header("Content-Type:application/json");
include('../../includes/connection.php');
include('../../core/utils.php');

$data = json_decode(file_get_contents("php://input"));


$reference = htmlspecialchars(strip_tags($data->reference));

$query = "DELETE FROM produits WHERE reference=?";

$stmt = $con->prepare($query);
$stmt->bind_param("s", $reference);

if($stmt->execute()){
    echo json_encode(
        array('message'=>'Produit supprimé')
    );
}else{
    echo json_encode(
        array('message'=>'Produit supprimé')
    );
}

?>