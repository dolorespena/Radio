<?php

require_once 'views/base.view.php';


class AuthView extends View{

    public function __construct(){
        parent::__construct();
        
    }

    public function showFormLogin($error = null) {

        $this->getSmarty()->assign('title', 'Columnistas');
        $this->getSmarty()->assign('error', $error);
        $this->getSmarty()->assign('esAdmin', !empty($_SESSION['ID_USER']));
        
        $this->getSmarty()->display('formLogin.tpl');
    }
    
}