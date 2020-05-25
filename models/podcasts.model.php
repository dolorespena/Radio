<?php

Class PodcastsModel{

    public function getAll(){
        // 1. abro la conexión con MySQL 
        $db = new PDO('mysql:host=localhost;'.'dbname=db_radio;charset=utf8', 'root', '');
        
        // 2. enviamos la consulta (3 pasos)
        $sentencia = $db->prepare("SELECT pod.*, col.nombre AS columnista FROM podcast pod JOIN columnista col ON col.id_columnista=pod.id_columnista_fk ORDER BY fecha desc"); // Sólo una tabla
        $sentencia->execute(); // ejecuta
        $podcasts = $sentencia->fetchAll(PDO::FETCH_OBJ); // obtiene la respuesta
        
        return $podcasts;
    }


    public function getPodcasts($idColumnist){
        // 1. abro la conexión con MySQL 
        $db = new PDO('mysql:host=localhost;'.'dbname=db_radio;charset=utf8', 'root', '');
        
        // 2. enviamos la consulta (3 pasos)
        $sentencia = $db->prepare("SELECT col.nombre AS columnista, pod.* FROM podcast pod JOIN columnista col ON col.id_columnista=pod.id_columnista_fk WHERE pod.id_columnista_fk= ?"); // Sólo una tabla
        $sentencia->execute([$idColumnist]); // ejecuta
        $podcasts = $sentencia->fetchAll(PDO::FETCH_OBJ); // obtiene la respuesta
        
        return $podcasts;
    }

    public function insertPodcast($nombre, $columnista, $descripcion, $audio, $fecha, $duracion, $etiqueta, $invitado){
        // 1. abro la conexión con MySQL 
        $db = new PDO('mysql:host=localhost;'.'dbname=db_radio;charset=utf8', 'root', '');

        // 2. enviamos la consulta
        $sentencia = $db->prepare("INSERT INTO podcast (nombre, id_columnista_fk, descripcion, url_audio, fecha, duracion, tag, invitado) VALUES(?, ?, ?, ?, ?, ?, ?, ?)"); // prepara la consulta
        $sentencia->execute([$nombre, $columnista, $descripcion, $audio, $fecha, $duracion, $etiqueta, $invitado]); // ejecuta

    }

    public function deletePodcast($idPodcast){

         // 1. abro la conexión con MySQL 
         $db = new PDO('mysql:host=localhost;'.'dbname=db_radio;charset=utf8', 'root', '');

         // 2. enviamos la consulta
         $sentencia = $db->prepare("DELETE FROM podcast WHERE id_podcast = ?"); // prepara la consulta
         $sentencia->execute([$idPodcast]); // ejecuta

    }

}