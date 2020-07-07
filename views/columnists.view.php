<?php

require_once 'views/base.view.php';

Class ColumnistsView extends View{

    public function __construct(){
        parent::__construct();
        
    }

    public function showColumnists($columnists){

        $isLogged = AuthHelper::isLogged();
        $userName = AuthHelper::getUserLogged();

        $this->getSmarty()->assign('username', $userName);
        $this->getSmarty()->assign('esUser', $isLogged);
        $this->getSmarty()->assign('saludo', '¡Hola ');
        $this->getSmarty()->assign('title', 'Columnistas');
        $this->getSmarty()->assign('columnists', $columnists);        
        $this->getSmarty()->assign('url_columnist','columnistas/');
        $this->getSmarty()->display('columnist.tpl');
    }
}