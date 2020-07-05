<?php

include_once 'models/base.model.php';

class UserModel extends Model{

    private $db;

    public function __construct(){
        $this->db = $this->createConection();
    }

    public function getUsers(){
        $sentencia = $this->db->prepare("SELECT * FROM user");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public function getUser($email){
        $sentencia = $this->db->prepare("SELECT * FROM user WHERE email = ?");
        $sentencia->execute([$email]);
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    public function addUser($username, $email, $password, $admin){
        $sentencia = $this->db->prepare("INSERT INTO user (username, email, password, admin) VALUES (?, ?, ?, ?)");
        $sentencia->execute([$username, $email, $password, $admin]);
    }

    public function deleteUser($id_user){
        $sentencia = $this->db->prepare("DELETE FROM user WHERE id_user = ?"); 
        $success = $sentencia->execute([$id_user]);
        return $success;
    }

    public function updateUserPrivileges($id_user, $esAdmin){
        $sentencia = $this->db->prepare("UPDATE user SET admin = ? WHERE user.id_user = ?");
        $success = $sentencia->execute([$esAdmin, $id_user]);
        return $success;
    }
}