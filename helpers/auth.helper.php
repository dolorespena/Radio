<?php

class AuthHelper{

    static private function start() {
        if (session_status() != PHP_SESSION_ACTIVE)
            session_start();
    }

    static public function isLogged() {
        self::start(); 
        return (isset($_SESSION['IS_LOGGED']));
    }

    static public function getUserLogged() {
        self::start();
        if (isset($_SESSION['USERNAME'])) {
            return $_SESSION['USERNAME'];
        }
        return false;
    }

    static public function getIdUser(){
        self::start();
        if (isset($_SESSION['ID_USER'])) {
            return $_SESSION['ID_USER'];
        }
        return false;
    }

    static public function login($user) {
        //Inicio la sesión y logueo al usuario
        
        self::start();
        $_SESSION['IS_LOGGED'] = true;
        $_SESSION['ID_USER'] = $user->id_user;
        $_SESSION['USERNAME'] = $user->username;
        $_SESSION['ADMIN'] = $user->admin;
    }
 
    static public function logout() {
        self::start();
        session_destroy();
    }

    //verifica que existe un usuario logueado
     public static function checkAdmin(){
        session_start();
        if ((!isset($_SESSION['ID_USER'])) || (empty($_SESSION['ADMIN']))){
            header('Location: ' . BASE_URL . 'login');
            die();
        }
    }
}