<?php

header("Content-Type:application/json");
include('../../includes/connection.php');
include('../../utils.php');

$data = json_decode(file_get_contents("php://input"));

//if isset(nom) alors on modifie, etc..
$nom = htmlspecialchars(strip_tags($data->nom));
$description = htmlspecialchars(strip_tags($data->description));
//$token = htmlspecialchars(strip_tags($data->token));
$prix = htmlspecialchars(strip_tags($data->prix));
$stock = htmlspecialchars(strip_tags($data->stock));
$reference = htmlspecialchars(strip_tags($data->reference));
//$created_at = date("Y-m-d");
$update_at = date("Y-m-d");

$query = "UPDATE produits SET nom=?, description=?, prix=?, stock=?, update_at=? WHERE reference=?";

$stmt = $con->prepare($query);
$stmt->bind_param("ssssss", $nom, $description, $prix, $stock, $update_at, $reference);

if($stmt->execute()){
    echo json_encode(
        array('message'=>'Produit modifié')
    );
}else{
    echo json_encode(
        array('message'=>'Produit pas modifié')
    );
}

?>