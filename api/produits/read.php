<?php

header("Content-Type:application/json");
include('../../includes/connection.php');


//PARTIE PRODUITS
	$query = "SELECT * FROM `produits`";
	$result = mysqli_query($con,$query);
	$count = $result->num_rows;

	if($count>0){
		$produit_array = array();
		$produit_array['data'] = array();
	
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			extract($row);
			$produit_item = array(
				"nom" => $nom,
				"description" => $description,
				"token" => $token,
				"prix" => $prix,
				"stock" => $stock,
				"reference" => $reference,
				"created_at" => $created_at,
				"update_at" => $update_at
			);
			array_push($produit_array['data'],$produit_item);
		}
		echo json_encode($produit_array);
	
	}else{
		echo json_encode(
			array('message'=>'Pas de produit(s) trouvé(s)')
		);
	}

?>
