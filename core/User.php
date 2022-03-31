<?php

include('utils.php');

class User{
    private $con;
    private $table = "users";

    public $nom;
    public $prenom;
    public $token;
    public $role;
    public $created_at;
    public $update_at;

    public function __construct($db){
        $this->con = $db;
    }

    public function read(){
        $query = 'SELECT * FROM '.$this->table.'';

        $result = mysqli_query($this->con,$query);

        return $result;
    }

    public function create(){
        
        $query = "INSERT INTO users VALUES (?,?,?,?,?,?)";

        $stmt = $this->con->prepare($query);

        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->prenom = htmlspecialchars(strip_tags($this->prenom));
        $this->token = randomToken(10);
        $this->role = htmlspecialchars(strip_tags($this->role));
        $this->created_at = date("Y-m-d");
        $this->update_at = null;

        $stmt->bind_param("ssssss", $this->nom, $this->prenom, $this->token, $this->role, $this->created_at, $this->update_at);

        if($stmt->execute()){
            return true;
        }else{
            printf("Erreur %s. \n", $stmt->error);
            return false;
        }
    }

    public function update(){
        
        $query = "UPDATE users SET nom=?, prenom=?, role=?, update_at=? WHERE token=?";
        
        $stmt = $this->con->prepare($query);

        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->prenom = htmlspecialchars(strip_tags($this->prenom));
        $this->token = htmlspecialchars(strip_tags($this->token));
        $this->role = htmlspecialchars(strip_tags($this->role));
        //$created_at = date("Y-m-d");
        $this->update_at = date("Y-m-d");

        $stmt->bind_param("sssss", $this->nom, $this->prenom, $this->role, $this->update_at, $this->token);
        
        if($stmt->execute()){
            return true;
        }else{
            printf("Erreur %s. \n", $stmt->error);
            return false;
        }
    }

    public function delete(){

        $query = "DELETE FROM users WHERE token=?";
        
        $stmt = $this->con->prepare($query);

        $this->token = htmlspecialchars(strip_tags($this->token));

        $stmt->bind_param("s", $this->token);
        
        if($stmt->execute()){
            return true;
        }else{
            printf("Erreur %s. \n", $stmt->error);
            return false;
        }
    }
    
}