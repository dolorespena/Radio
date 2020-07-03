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
        $email = $_POST['email'];
        $password = $_POST['password'];

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
        }else{
            $this->view->showFormLogin("Datos ingresados inválidos");
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
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $this->model->addUser($username, $email, $hash, $admin);
            header('Location: ' . BASE_URL . 'columnistas' );
        }else{
            $this->view->showFormLogin("Debe ingresar todos los campos");
        }
    }

    public function addComent($idPodcast, $idUser){
        $detalle = $_POST['comentario'];
        $value = (int) $_POST['valoracion'];
        $date = $this->buildDate();
        
        if (!empty($detalle) && !empty($value)) {
            $success = $this->model->insertComent($detalle, $value, $date, $idPodcast, $idUser);
            if ($success){
                header('Location: ' . BASE_URL . 'podcast/' . $idPodcast);
            }else{
                echo "chau";
            }        
        }
    }

    public function buildDate(){
        $today = getdate();
        $date = $today['year'] . '-' . $today['mon'] . '-' . $today['mday'];  
        return $date;
    }

    public function logout(){
        AuthHelper::logout();
        header('Location: ' . BASE_URL . 'login');// redirecciono a la pag de login
    }
}

