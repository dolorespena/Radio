<?php

include_once 'models/base.model.php';

class UserModel extends Model{

    private $db;

    public function __construct(){
        $this->db = $this->createConection();
    }

    public function getUser($username){
        $sentencia = $this->db->prepare("SELECT * FROM user WHERE username = ?");
        $sentencia->execute([$username]);
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }
}