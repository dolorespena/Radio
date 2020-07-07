<?php

require_once 'views/message.view.php';

class MessageController{

    private $view;

    public function __construct(){
        $this->view = new MessageView();
    }

    public function showError($message){
        $this->view->showError($message);
    }
}