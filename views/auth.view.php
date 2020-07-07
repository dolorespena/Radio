<?php

require_once 'views/base.view.php';


class AuthView extends View{

    public function __construct(){
        parent::__construct();

        $isLogged = AuthHelper::isLogged();
        $this->getSmarty()->assign('esUser', $isLogged);
    }

    public function showFormLogin($error = null) {        

        $this->getSmarty()->assign('title', 'Iniciá Sesión');
        $this->getSmarty()->assign('error', $error);
        $this->getSmarty()->display('formLogin.tpl');
    }

    public function showRegistrationForm($error = null){        

        $this->getSmarty()->assign('title', 'Registrate');        
        $this->getSmarty()->assign('error', $error);
        $this->getSmarty()->display('formRegistration.tpl');        
    }

    public function recuperarPassword($error = null){        

        $this->getSmarty()->assign('title', 'Recuperar Contraseña');
        $this->getSmarty()->assign('error', $error);        
        $this->getSmarty()->display('formRecuperarPassword.tpl');
    }

    public function confirmToken($error = null){        
        
        $this->getSmarty()->assign('title', 'Confirmar cambio de Contraseña');        
        $this->getSmarty()->assign('error', $error);
        $this->getSmarty()->display('confirmPassword.tpl');
    }
}