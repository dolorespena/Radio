<?php

require_once 'views/auth.view.php';
require_once 'views/admin.view.php';
require_once 'models/user.model.php';

class AuthController{
    
    private $view;
    private $model;

    public function __construct() {
        $this->view = new AuthView();
        $this->model = new UserModel();
    }

    public function showLogin(){
        $this->view->showFormLogin();
    }

    public function verify(){
        //hay q hacer la func de verificar que los campos no esten vacios
        $username = $_POST['username'];
        $password = $_POST['password'];

        //busco el usuario
        $user =$this->model->getUser($username);

        if ($user && password_verify($password, $user->password)){
           //abro sesion y guardo al usuario
           session_start();
           $_SESSION['ID_USER'] = $user->id_user;
           $_SESSION['USERNAME'] = $user->username;
           header('Location: ' . BASE_URL . 'admin');
        }else{
            $this->view->showFormLogin("Datos ingresados inválidos");
        }
    }

    public function logout(){
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL . 'login');


    }


    
}

