<?php

require_once 'views/auth.view.php';

class AuthController{

    
    private $view;

    public function __construct() {
        
        $this->view = new AuthView();
    }

    public function showLogin(){
        $this->view->showFormLogin();
    }

    public function verify(){
        //hay q hacer la func de verificar que los campos no esten vacios
        $ussername = $_POST["ussername"];
        $password = $_POST["password"];

       

    }

    
}

