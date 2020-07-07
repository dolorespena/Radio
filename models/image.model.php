<?php

include_once 'models/base.model.php';

class ImageModel extends Model{

    private $db;

    public function __construct(){
        $this->db = $this->createConection();
    }

    public function insertImage($idColumnist, $path){

        $sentencia = $this->db->prepare("INSERT INTO imagen (fk_id_columnista, path) VALUES(?, ?)"); 
        $success = $sentencia->execute([$idColumnist, $path]);
        return $success;

    }

    public function getImages($idColumnist){
        $sentencia = $this->db->prepare("SELECT * FROM imagen WHERE fk_id_columnista = ?");
        $sentencia->execute([$idColumnist]); 
        $imagenes = $sentencia->fetchAll(PDO::FETCH_OBJ); 
         
         return $imagenes;   
    }

    public function getPathColumnist($idColumnist){
        $sentencia = $this->db->prepare("SELECT i.path FROM imagen i WHERE i.fk_id_columnista = ?"); // prepara la consulta
        $sentencia->execute([$idColumnist]); // ejecuta
        $imagenes = $sentencia->fetchAll(PDO::FETCH_OBJ); // obtiene la respuesta
         
         return $imagenes;   

    }


}