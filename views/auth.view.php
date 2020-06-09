<?php

require_once 'views/base.view.php';


class AuthView extends View{

    public function __construct(){
        parent::__construct();
        
    }

    public function showFormLogin($error = null) {

        $isLogged = AuthHelper::isLogged();

        $this->getSmarty()->assign('title', 'Columnistas');
        $this->getSmarty()->assign('error', $error);
        $this->getSmarty()->assign('esAdmin', $isLogged);
        
        $this->getSmarty()->display('formLogin.tpl');
    }
    
}