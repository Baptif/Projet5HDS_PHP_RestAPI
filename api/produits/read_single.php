<?php

header("Content-Type:application/json");
include('../../includes/connection.php');


//PARTIE PRODUITS
if (isset($_GET['produit_ref']) && $_GET['produit_ref']!="") { //verif que la ref produit existe

	$produit_ref = $_GET['produit_ref'];
	$query = "SELECT * FROM `produits` WHERE reference=$produit_ref";
	$result = mysqli_query($con,$query);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	
	$produitData['nom'] = $row['nom'];
	$produitData['description'] = $row['description'];
	$produitData['token'] = $row['token'];
	$produitData['prix'] = $row['prix'];
	$produitData['stock'] = $row['stock'];
	$produitData['reference'] = $row['reference'];
	$produitData['created_at'] = $row['created_at'];
	$produitData['update_at'] = $row['update_at'];
	
	$response["status"] = "true";	
	$response["message"] = "Details produit";
	$response["produit"] = $produitData;
	
} else{

	$response["status"] = "false";
	$response["message"] = "Aucun produit(s) trouve(s) !";

}

echo json_encode($response); exit;

?>
