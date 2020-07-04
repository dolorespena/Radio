<?php

include_once 'models/base.model.php';

class ComentModel extends Model{
    
    private $db;

    public function __construct(){
        $this->db = $this->createConection();
    }

    public function insertComment($detalle, $value, $date, $idPodcast, $idUser){
        $sentencia = $this->db->prepare("INSERT INTO comentario (detalle, fecha, valoracion, id_podcast_fk, id_usuario_fk) VALUES (?, ?, ?, ?, ?)"); // prepara la consulta
        $sentencia->execute([$detalle, $value, $date, $idPodcast, $idUser]); 
        return $this->db->lastInsertId();
    }

    public function getComments(){
        $sentencia = $this->db->prepare("SELECT * FROM comentario"); 
        $sentencia->execute(); 
        $comments = $sentencia->fetchAll(PDO::FETCH_OBJ); 
        return $comments;
    }

    public function getCommentsByPodcast($idPodcast){
        $sentencia = $this->db->prepare("SELECT coment.*, user.username FROM comentario coment JOIN user ON coment.id_usuario_fk = user.id_user WHERE coment.id_podcast_fk = ? "); 
        $sentencia->execute([$idPodcast]); 
        $comments = $sentencia->fetchAll(PDO::FETCH_OBJ);
        
        return $comments;
    }

    public function getComment($idComment){
        $sentencia = $this->db->prepare("SELECT * FROM comentario WHERE id_comentario = ? "); 
        $sentencia->execute([$idComment]); 
        $comments = $sentencia->fetch(PDO::FETCH_OBJ); 
        return $comments;
    }

    public function deleteComment($idComment){
        $sentencia = $this->db->prepare("DELETE FROM comentario WHERE id_comentario = ?"); 
        $success = $sentencia->execute([$idComment]);
        return $success;
   }

}