<?php

Class ColumnistsModel{

    private $db;

    public function __construct(){
        // 1. abro la conexión con MySQL 
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_radio;charset=utf8', 'root', '');
    }

    public function getAll(){

         // 2. enviamos la consulta (3 pasos)
         $sentencia = $this->db->prepare("SELECT * FROM columnista"); // prepara la consulta
         $sentencia->execute(); // ejecuta
         $columnists = $sentencia->fetchAll(PDO::FETCH_OBJ); // obtiene la respuesta
         
         return $columnists;   
    }

    public function getColumnist($idColumnist){
 
         // 2. enviamos la consulta (3 pasos)
         $sentencia = $this->db->prepare("SELECT * FROM columnista  WHERE id_columnista = ?"); // prepara la consulta
         $sentencia->execute([$idColumnist]); // ejecuta
         $columnist = $sentencia->fetch(PDO::FETCH_OBJ); // obtiene la respuesta
         
         return $columnist;  
    }

    public function insertColumnist($nombre, $profesion, $descripcion, $imagen){

        // 2. enviamos la consulta
        $sentencia = $this->db->prepare("INSERT INTO columnista (nombre, profesion, descripcion, url_imagen) VALUES(?, ?, ?, ?)"); // prepara la consulta
        $sentencia->execute([$nombre, $profesion, $descripcion, $imagen]); // ejecuta
    }

    public function updateColumnist($idColumnist, $nombre, $profesion, $descripcion, $imagen){

        // 2. enviamos la consulta
        $sentencia = $this->db->prepare("UPDATE columnista SET nombre = ?, profesion = ?, descripcion = ? , url_imagen = ? WHERE columnista.id_columnista = ?"); // prepara la consulta
        $success = $sentencia->execute([$nombre, $profesion, $descripcion, $imagen, $idColumnist]); // ejecuta
        return $success;
    }

    public function deleteColumnist($idColumnist){

        // 2. enviamos la consulta
        $sentencia = $this->db->prepare("DELETE FROM columnista WHERE id_columnista = ?"); // prepara la consulta
        $success = $sentencia->execute([$idColumnist]); // ejecuta
        return $success;
    }
}