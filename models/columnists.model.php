<?php

Class ColumnistsModel{

    public function getAll(){
         // 1. abro la conexión con MySQL 
         $db = new PDO('mysql:host=localhost;'.'dbname=db_radio;charset=utf8', 'root', '');
        
         // 2. enviamos la consulta (3 pasos)
         $sentencia = $db->prepare("SELECT * FROM columnista"); // prepara la consulta
         $sentencia->execute(); // ejecuta
         $columnists = $sentencia->fetchAll(PDO::FETCH_OBJ); // obtiene la respuesta
         
         return $columnists;   
    }

    public function getColumnist($idColumnist){

        $db = new PDO('mysql:host=localhost;'.'dbname=db_radio;charset=utf8', 'root', '');
        
         // 2. enviamos la consulta (3 pasos)
         $sentencia = $db->prepare("SELECT * FROM columnista  WHERE id_columnista = ?"); // prepara la consulta
         $sentencia->execute([$idColumnist]); // ejecuta
         $columnist = $sentencia->fetch(PDO::FETCH_OBJ); // obtiene la respuesta
         
         return $columnist;   

    }

    public function insertColumnist($nombre, $profesion, $descripcion, $imagen){
        // 1. abro la conexión con MySQL 
        $db = new PDO('mysql:host=localhost;'.'dbname=db_radio;charset=utf8', 'root', '');

        // 2. enviamos la consulta
        $sentencia = $db->prepare("INSERT INTO columnista (nombre, profesion, descripcion, url_imagen) VALUES(?, ?, ?, ?)"); // prepara la consulta
        $sentencia->execute([$nombre, $profesion, $descripcion, $imagen]); // ejecuta

    }

    public function updateColumnist($idColumnist, $nombre, $profesion, $descripcion, $imagen){

        // 1. abro la conexión con MySQL 
        $db = new PDO('mysql:host=localhost;'.'dbname=db_radio;charset=utf8', 'root', '');

        // 2. enviamos la consulta
        $sentencia = $db->prepare("UPDATE columnista SET nombre = ?, profesion = ?, descripcion = ? , url_imagen = ? WHERE columnista.id_columnista = ?"); // prepara la consulta
        $success = $sentencia->execute([$nombre, $profesion, $descripcion, $imagen, $idColumnist]); // ejecuta
        return $success;

    }

    public function deleteColumnist($idColumnist){

        // 1. abro la conexión con MySQL 
        $db = new PDO('mysql:host=localhost;'.'dbname=db_radio;charset=utf8', 'root', '');

        // 2. enviamos la consulta
        $sentencia = $db->prepare("DELETE FROM columnista WHERE id_columnista = ?"); // prepara la consulta
        $success = $sentencia->execute([$idColumnist]); // ejecuta
        return $success;
    }

}