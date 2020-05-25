<?php

class LoginModel{

    public function getusser(){

        $alert = '';

        if(!empty($_POST)){
            if(empty($_POST['ussername']) || empty($_POST['password'])){
                $alert = 'Ingrese clave y contraseña';
            }else{
                // 1. abro la conexión con MySQL 
                $db = new PDO('mysql:host=localhost;'.'dbname=db_radio;charset=utf8', 'root', '');

                $usser = $_POST['ussername'];
                $password = $_POST['password'];

                // 2. enviamos la consulta (3 pasos)
                $sentencia = $db->prepare("SELECT * FROM usser WHERE usser = '$usser' AND password = '$password'"); // prepara la consulta
                $sentencia->execute(); // ejecuta
                $result = 
            }
        }
        



         
        

    }
}