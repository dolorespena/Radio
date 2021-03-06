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

    public function verify(){// Define si el usuario es también Administrador y redirecciona
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
            }else if($user) {
                $this->view->showFormLogin("La contraseña es incorrecta");
            }else{
                $this->view->showFormLogin("No reconocemos esta dirección de correo electrónico");
            }
        }else{
            $this->view->showFormLogin("Faltan llenar campos obligatorios");
        }
    }

    public function showRegistration(){ // Formulario de registro
        $this->view->showRegistrationForm();
    }

    public function checkIn(){ // Verifica que no haya otro email con el mismo nombre
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

    public function logout(){//Cierra sesión
        AuthHelper::logout();
        header('Location: ' . BASE_URL . 'login');// redirecciono a la pag de login
    }

    public function recuperarPassword(){
        $this->view->recuperarPassword();
    }

    public function checkemail(){// Verifica que el email exista y genera un token para recuperar contraseña
        $email = $_POST['email'];
        if(!empty($email)){
            $user = $this->model->getUser($email);
            if($user){
                $userId = $user->id_user;
                $token = uniqid(5);
                $this->model->insertToken($userId, $token);
                $link = BASE_URL . "checkToken";   
                echo ("<p> Para recuperar la contraseña debe ingresar en el siguiente enlace: " . $link . "</p>");
                echo ("<p>E ingrese el siguiente token: " . $token . "</p>"); 
            }else{
                $this->view->recuperarPassword("No se reconoce ese Email");
            }
        }else{
            $this->view->recuperarPassword("Debe ingresar un Email");
        }
    }

    public function checkToken(){
        $this->view->confirmToken();
    }

    public function verifyToken(){//Verifica que los token sean iguales.
        $email = $_POST['email'];
        $tokenUser = $_POST['token'];
        $password = $_POST['password'];
        if(isset($email) && isset($tokenUser) && isset($password)){
            $user = $this->model->getUser($email);
            if($user){
                $idUser = $user->id_user;
                $token = $this->model->getToken($idUser)->token;
                if($token == $tokenUser){
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $this->model->updatePassword($idUser, $hash);
                    $this->view->showFormLogin("La contraseña se ha restaurado exitosamente. Ingrese nuevamente");
                }else{
                    $this->view->confirmToken("Token inválido");
                }
            }
        }
    }
}