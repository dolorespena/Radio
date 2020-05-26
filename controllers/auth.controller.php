<?php

require_once 'views/auth.view.php';
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
        }else{
            $this->view->showFormLogin("Datos ingresados inválidos");
        }
    }
    
    //verifica que existe un usuario logueado
    private function checkloged(){
        session_start();
        if (isset($_SESSION['ID_USER'])){
            header('Locarion: ' . BASE_URL . 'login');
        }

    }

    
}

