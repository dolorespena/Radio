<?php

class UserModel{

    private $db;

    public function __construct(){
        $this->db = $this->createConection();
    }
    
    /**
     * Creo la conexion
     */
    private function createConection(){
        $host = 'localhost';
        $userName = 'root';
        $password = '';
        $database = 'db_radio';

        try{
            $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $userName, $password);

            //soloen nodo desarrollo
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }catch (Exception $e){
            var_dump($e);
        }
        return $pdo;
    }

    public function getUser($username){
        $sentencia = $this->db->prepare("SELECT * FROM user WHERE username = ?");
        $sentencia->execute([$username]);
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }
}