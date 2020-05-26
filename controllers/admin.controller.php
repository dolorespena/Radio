<?php

class AdminController{


    public function __construct(){
        $this->view = new AdminView();
        $this->model = new UserModel();
    }
    


    public function showAdmin(){

    }

}