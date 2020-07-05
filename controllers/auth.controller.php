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

        $email = $_POST['email'];
        $password = $_POST['password'];

        if(!empty($email) && (!empty($password))){
            //busco el usuario
            $user = $this->model->getUser($email);
            if ($user && password_verify($password, $user->password)){
                
                //abro sesion y guardo al usuario
                AuthHelper::login($user);
                if($user->admin == 0){
                    header('Location: ' . BASE_URL . 'columnistas');//redirecciono a columnistas
                }else{
                    header('Location: ' . BASE_URL . 'admin');//redirecciono a admin
                }
            } else if($user) {
                $this->view->showFormLogin("La contraseña es incorrecta");
            } else{
                $this->view->showFormLogin("No reconocemos esta dirección de correo electrónico");
            }
        } else{
            $this->view->showFormLogin("Faltan llenar campos obligatorios");
        }
    }

    public function showRegistration(){
        $this->view->showRegistrationForm();
    }

    public function checkIn(){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $admin = 0;

        if(!empty($username) && !empty($email) && !empty($password)){
            $user = $this->model->getUser($email);
            if($user){
                $this->view->showRegistrationForm("Ese email ya se encuentra registrado");
            } else{
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $this->model->addUser($username, $email, $hash, $admin);
                $user = $this->model->getUser($email);
                AuthHelper::login($user);
                header('Location: ' . BASE_URL . 'columnistas' );

            }


            
        }else{
            $this->view->showFormLogin("Debe ingresar todos los campos");
        }
    }

    public function logout(){
        AuthHelper::logout();
        header('Location: ' . BASE_URL . 'login');// redirecciono a la pag de login
    }
}

