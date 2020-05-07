<?php

Class PodcastsModel{

    public function getPodcasts($idColumnist){
        // 1. abro la conexión con MySQL 
        $db = new PDO('mysql:host=localhost;'.'dbname=db_radio;charset=utf8', 'root', '');
        
        // 2. enviamos la consulta (3 pasos)
        $sentencia = $db->prepare("SELECT col.nombre AS columnista, pod.* FROM podcast pod JOIN columnista col ON col.id_columnista=pod.id_columnista_fk WHERE pod.id_columnista_fk= ?"); // Sólo una tabla
        $sentencia->execute([$idColumnist]); // ejecuta
        $podcasts = $sentencia->fetchAll(PDO::FETCH_OBJ); // obtiene la respuesta
        
        return $podcasts;
    }

}