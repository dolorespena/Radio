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

    public function insertComent($detalle, $value, $date, $idPodcast, $idUser){
        $sentencia = $this->db->prepare("INSERT INTO comentario (detalle, fecha, valoracion, id_podcast_fk, id_usuario_fk) VALUES (?, ?, ?, ?, ?)"); // prepara la consulta
        $success = $sentencia->execute([$detalle, $date, $value, $idPodcast, $idUser]); 
        return $success;
    }
}