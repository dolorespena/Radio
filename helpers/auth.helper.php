<?php

class AuthHelper{

      //verifica que existe un usuario logueado
     public static function checklogged(){
        session_start();
        if (!isset($_SESSION['ID_USER'])){
            header('Location: ' . BASE_URL . 'login');
            die();
        }
    }



}