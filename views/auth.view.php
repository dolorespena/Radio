<?php

require_once 'views/base.view.php';


class AuthView extends View{

    public function __construct(){
        parent::__construct();
    }

    public function showFormLogin($error = null) {

        $isLogged = AuthHelper::isLogged();

        $this->getSmarty()->assign('title', 'Iniciá Sesión');
        $this->getSmarty()->assign('error', $error);
        $this->getSmarty()->assign('esUser', $isLogged);
        
        $this->getSmarty()->display('formLogin.tpl');
    }

    public function showRegistrationForm($error = null){

        $isLogged = AuthHelper::isLogged();

        $this->getSmarty()->assign('title', 'Registrate');
        $this->getSmarty()->assign('esUser', $isLogged);
        $this->getSmarty()->assign('error', $error);

        $this->getSmarty()->display('formRegistration.tpl');        
    }
}