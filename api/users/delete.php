<?php

header("Content-Type:application/json");
include('../../includes/connection.php');
include('../../core/User.php');


$user = new User($con);

$data = json_decode(file_get_contents("php://input"));


$user->token = htmlspecialchars(strip_tags($data->token));

if($user->delete()){
    echo json_encode(
        array('message'=>'Utilisateur supprimé')
    );
}else{
    echo json_encode(
        array('message'=>'Utilisateur pas supprimé')
    );
}

?>