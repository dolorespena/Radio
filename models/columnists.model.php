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

}