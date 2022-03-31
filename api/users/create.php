<?php

header("Content-Type:application/json");
include('../../includes/connection.php');
include('../../core/User.php');


$user = new User($con);

$data = json_decode(file_get_contents("php://input"));


$user->nom = htmlspecialchars(strip_tags($data->nom));
$user->prenom = htmlspecialchars(strip_tags($data->prenom));
$user->role = htmlspecialchars(strip_tags($data->role));

if($user->create()){
    echo json_encode(
        array('message'=>'Utilisateur créé')
    );
}else{
    echo json_encode(
        array('message'=>'Utilisateur pas créé')
    );
}

?>