<?php

header("Content-Type:application/json");
include('../../includes/connection.php');
include('../../core/User.php');


$user = new User($con);

$result = $user->read();
$count = $result->num_rows;

if($count>0){
	$user_array = array();
	$user_array['data'] = array();

	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
		extract($row);
		$user_item = array(
			"nom" => $nom,
			"prenom" => $prenom,
			"token" => $token,
			"role" => $role,
			"created_at" => $created_at,
			"update_at" => $update_at
		);
		array_push($user_array['data'],$user_item);
	}
	echo json_encode($user_array);

}else{
	echo json_encode(
        array('message'=>'Pas d\'utilisateur(s) trouvé(s)')
    );
}
