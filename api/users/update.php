<?php

header("Content-Type:application/json");
include('../../includes/connection.php');
include('../../core/User.php');


$user = new User($con);

$data = json_decode(file_get_contents("php://input"));


$user->nom = htmlspecialchars(strip_tags($data->nom));
$user->prenom = htmlspecialchars(strip_tags($data->prenom));
$user->token = htmlspecialchars(strip_tags($data->token));
$user->role = htmlspecialchars(strip_tags($data->role));
//$created_at = date("Y-m-d");
$user->update_at = date("Y-m-d");


if($user->update()){
    echo json_encode(
        array('message'=>'Utilisateur modifié')
    );
}else{
    echo json_encode(
        array('message'=>'Utilisateur pas modifié')
    );
}

?>