<?php

header("Content-Type:application/json");
include('../../includes/connection.php');
include('../../core/utils.php');

$data = json_decode(file_get_contents("php://input"));


$nom = htmlspecialchars(strip_tags($data->nom));
$description = htmlspecialchars(strip_tags($data->description));
$token = randomToken(10);
$prix = htmlspecialchars(strip_tags($data->prix));
$stock = htmlspecialchars(strip_tags($data->stock));
$reference = htmlspecialchars(strip_tags($data->reference));
$created_at = date("Y-m-d");
$update_at = null;

$query = "INSERT INTO produits VALUES (?,?,?,?,?,?,?,?)";

$stmt = $con->prepare($query);
$stmt->bind_param("ssssssss", $nom, $description, $token, $prix, $stock, $reference, $created_at, $update_at);

if($stmt->execute()){
    echo json_encode(
        array('message'=>'Produit créé')
    );
}else{
    echo json_encode(
        array('message'=>'Produit pas créé')
    );
}

?>