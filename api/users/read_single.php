<?php

header("Content-Type:application/json");
include('../../includes/connection.php');


//PARTIE UTILISATEURS
if (isset($_GET['user_token']) && $_GET['user_token']!="") {

	$user_token = $_GET['user_token'];
	$query = "SELECT * FROM `users` WHERE token=$user_token";
	$result = mysqli_query($con,$query);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	
	$userData['nom'] = $row['nom'];
	$userData['prenom'] = $row['prenom'];
	$userData['token'] = $row['token'];
	$userData['role'] = $row['role'];
	$userData['created_at'] = $row['created_at'];
	$userData['update_at'] = $row['update_at'];
	
	$response["status"] = "true";	
	$response["message"] = "Details utilisateur";
	$response["users"] = $userData;
	
} else{

	$response["status"] = "false";
	$response["message"] = "Aucun utilisateur(s) trouve(s) !";
	
}

echo json_encode($response); exit;

?>
