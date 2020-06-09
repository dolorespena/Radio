<?php

require_once 'views/base.view.php';

Class ColumnistsView extends View{

    public function __construct(){
        parent::__construct();
        
    }

    public function showColumnists($columnists){

        $this->getSmarty()->assign('title', 'Columnistas');
        $this->getSmarty()->assign('columnists', $columnists);        
        $this->getSmarty()->assign('url_columnist','columnistas/');
        $this->getSmarty()->assign('esAdmin', !empty($_SESSION['ID_USER']));
            
        $this->getSmarty()->display('columnist.tpl');
    }
}