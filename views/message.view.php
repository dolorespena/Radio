<?php

require_once 'views/base.view.php';

class MessageView extends View{

    public function __construct(){
        parent::__construct();
        
    }

    public function showError($message){ 

        $this->getSmarty()->assign('title', 'Página no encontrada');
        $this->getSmarty()->assign('img_url', 'img/radio.png');
        $this->getSmarty()->assign('error', $message);
        $this->getSmarty()->assign('esAdmin', !empty($_SESSION['ID_USER']));

        $this->getSmarty()->display('error.tpl');
    }

}
