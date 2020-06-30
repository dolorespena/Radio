<?php

include_once 'models/base.model.php';

Class PodcastsModel extends Model{
    
    private $db;

    public function __construct(){
        // 1. abro la conexión con MySQL 
        $this->db = $this->createConection();
    }

    public function getAll(){
        // 2. enviamos la consulta (3 pasos)
        $sentencia = $this->db->prepare("SELECT pod.*, col.nombre AS columnista FROM podcast pod JOIN columnista col ON col.id_columnista=pod.id_columnista_fk ORDER BY fecha desc"); // Sólo una tabla
        $sentencia->execute(); // ejecuta
        $podcasts = $sentencia->fetchAll(PDO::FETCH_OBJ); // obtiene la respuesta
        
        return $podcasts;
    }

    public function getPodcast($idPodcast){
         // 2. enviamos la consulta (3 pasos)
         $sentencia = $this->db->prepare("SELECT * FROM podcast  WHERE id_podcast = ?"); // prepara la consulta
         $sentencia->execute([$idPodcast]); // ejecuta
         $podcast = $sentencia->fetch(PDO::FETCH_OBJ); // obtiene la respuesta
         
         return $podcast;   
    }

    public function getPodcasts($idColumnist){
       
        // 2. enviamos la consulta (3 pasos)
        $sentencia = $this->db->prepare("SELECT col.nombre AS columnista, pod.* FROM podcast pod JOIN columnista col ON col.id_columnista=pod.id_columnista_fk WHERE pod.id_columnista_fk= ?"); // Sólo una tabla
        $sentencia->execute([$idColumnist]); // ejecuta
        $podcasts = $sentencia->fetchAll(PDO::FETCH_OBJ); // obtiene la respuesta
        
        return $podcasts;
    }

    public function insertPodcast($nombre, $columnista, $descripcion, $audio, $fecha, $duracion, $etiqueta, $invitado){

        // 2. enviamos la consulta
        $sentencia = $this->db->prepare("INSERT INTO podcast (nombre, id_columnista_fk, descripcion, url_audio, fecha, duracion, tag, invitado) VALUES(?, ?, ?, ?, ?, ?, ?, ?)"); // prepara la consulta
        $success = $sentencia->execute([$nombre, $columnista, $descripcion, $audio, $fecha, $duracion, $etiqueta, $invitado]); // ejecuta
        return $success;
    }

    public function updatePodcast($idPodcast, $nombre, $columnista, $descripcion, $audio, $fecha, $duracion, $etiqueta, $invitado){

        // 2. enviamos la consulta
        $sentencia = $this->db->prepare("UPDATE podcast SET nombre = ?, id_columnista_fk = ?, descripcion = ? , url_audio = ?, fecha = ?, duracion = ?, tag = ?, invitado = ? WHERE podcast.id_podcast = ?"); // prepara la consulta
        $success = $sentencia->execute([$nombre, $columnista, $descripcion, $audio, $fecha, $duracion, $etiqueta, $invitado, $idPodcast]); // ejecuta
        return $success;
    }

    public function deletePodcast($idPodcast){

         // 2. enviamos la consulta
         $sentencia = $this->db->prepare("DELETE FROM podcast WHERE id_podcast = ?"); // prepara la consulta
         $sentencia->execute([$idPodcast]); // ejecuta
    }

    /**
     * Mueve el podcast subido y le asigna un nombre,
     * retorna ese nombre creado.
     */
    public function copiarImagen()
    {
        // Nombre archivo original
        $nombreOriginal = $_FILES['input_name']['name'];
        // Nombre en el file system:
        $nombreFisico = $_FILES['input_name']['tmp_name'];
        
        $nombreFinal = "images/". uniqid("", true) . "." 
        . strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));

        move_uploaded_file($nombreFisico, $nombreFinal); 
        
        return $nombreFinal;
    }

}