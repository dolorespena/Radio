<?php

include_once 'models/base.model.php';

class UserModel extends Model{

    private $db;

    public function __construct(){
        $this->db = $this->createConection();
    }

    public function getUser($email){
        $sentencia = $this->db->prepare("SELECT * FROM user WHERE email = ?");
        $sentencia->execute([$email]);
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }
}