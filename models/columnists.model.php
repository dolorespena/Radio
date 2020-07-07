<?php

include_once 'models/base.model.php';

Class ColumnistsModel extends Model{

    private $db;

    public function __construct(){
        // 1. abro la conexión con MySQL 
        $this->db = $this->createConection();
    }

    public function getAll(){

         // 2. enviamos la consulta (3 pasos)
         $sentencia = $this->db->prepare("SELECT c.*, i.path FROM columnista c JOIN imagen i ON c.id_columnista = i.fk_id_columnista GROUP BY c.id_columnista"); // prepara la consulta
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

    public function insertColumnist($nombre, $profesion, $descripcion){

        // 2. enviamos la consulta
        $sentencia = $this->db->prepare("INSERT INTO columnista (nombre, profesion, descripcion) VALUES(?, ?, ?)"); // prepara la consulta
        $sentencia->execute([$nombre, $profesion, $descripcion]); // ejecuta
        return $this->db->lastInsertId();

    }

    public function updateColumnist($idColumnist, $nombre, $profesion, $descripcion){

        // 2. enviamos la consulta
        $sentencia = $this->db->prepare("UPDATE columnista SET nombre = ?, profesion = ?, descripcion = ? WHERE columnista.id_columnista = ?"); // prepara la consulta
        $success = $sentencia->execute([$nombre, $profesion, $descripcion, $idColumnist]); // ejecuta
        return $success;
    }

    public function deleteColumnist($idColumnist){

        // 2. enviamos la consulta
        $sentencia = $this->db->prepare("DELETE FROM columnista WHERE id_columnista = ?"); // prepara la consulta
        $success = $sentencia->execute([$idColumnist]); // ejecuta
        return $success;
    }

    public function getNameColumnist($idColumnist){
        $sentencia = $this->db->prepare("SELECT c.nombre FROM columnista c WHERE id_columnista = ?"); // prepara la consulta
        $sentencia->execute([$idColumnist]); // ejecuta
        $columnista = $sentencia->fetch(PDO::FETCH_OBJ); // obtiene la respuesta
         
         return $columnista;   
    }
    
 
}