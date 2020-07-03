<?php

include_once 'models/columnists.model.php';
include_once 'models/podcasts.model.php';
include_once 'views/admin.view.php';
include_once 'views/message.view.php';
include_once 'views/podcasts.view.php';
include_once 'helpers/auth.helper.php';

class AdminController{

    private $modelColumnists;
    private $modelPodcasts;
    private $view;
    private $viewMessage;
    private $viewPodcasts;
    private $modelUser;

    public function __construct() {

        AuthHelper::checklogged();
        $this->modelColumnists = new ColumnistsModel();
        $this->modelPodcasts = new PodcastsModel();
        $this->view = new AdminView();
        $this->viewMessage = new MessageView();
        $this->viewPodcasts = new PodcastsView();
        $this->modelUser = new UserModel();
    }

    public function showAdmin(){
        $columnists = $this->modelColumnists->getAll();
        $podcasts = $this->modelPodcasts->getAll();
        $this->view->showAdmin($columnists, $podcasts);
    }

    public function addColumnist(){

        // toma los valores enviados por el usuario
        $nombre = $_POST['nombre'];
        $profesion = $_POST['profesion'];
        $descripcion = $_POST['descripcion'];
        $imagen = $_POST['imagen'];

        // verifica los datos obligatorios
        if (!empty($nombre) && !empty($profesion) &&  !empty($descripcion) && !empty($imagen)) {
            // inserta en la DB y redirige
            $this->modelColumnists->insertColumnist($nombre, $profesion, $descripcion, $imagen);
            header('Location: ' . BASE_URL . 'admin');
        } else {
            $this->viewMessage->showError("ERROR! Faltan datos obligatorios"); 
        }
   }

   public function deleteColumnist($idColumnist){
   
        $success = $this->modelColumnists->deleteColumnist($idColumnist);

        if ($success){
            header('Location: ' . BASE_URL . 'admin');
        }
        else {
            $this->viewMessage->showError("Debes eliminar todos los podcasts de este columnista previamente"); 
        }
   }

   public function editColumnist($idColumnist){

        $old = $this->modelColumnists->getColumnist($idColumnist);
        $this->view->showEditColumnist($old);
   }

   public function updateColumnist($idColumnist){
   
        $nombre = $_POST['nombre'];
        $profesion = $_POST['profesion'];
        $descripcion = $_POST['descripcion'];
        $imagen = $_POST['imagen'];

        // verifica los datos obligatorios
        if (!empty($nombre) && !empty($profesion) &&  !empty($descripcion) && !empty($imagen)) {
            // inserta en la DB y redirige
            $success = $this->modelColumnists->updateColumnist($idColumnist, $nombre, $profesion, $descripcion, $imagen);
            if ($success){
                header('Location: ' . BASE_URL . 'admin');
            }
            else {
                $this->viewMessage->showError("Error al actualizar la tabla"); 
            }
        } else {
            $this->viewMessage->showError("ERROR! Faltan datos obligatorios"); 
        }
   }

    public function addPodcast(){

        // toma los valores enviados por el usuario
        $nombre = $_POST['nombre'];
        $columnista = $_POST['columnista'];
        $descripcion = $_POST['descripcion'];
        $audio = $_FILES ['audio'];
        $fecha = $_POST['fecha'];
        $duracion = $_POST['duracion'];
        $etiqueta = $_POST['etiqueta'];
        $invitado = $_POST['invitado'];

        //Datos del archivo ingresado
        
        $nombreOriginal =  $_FILES ['audio']['name'];
        $nombreTemporal = $_FILES ['audio']['tmp_name'];
        $tipoAudio = $_FILES['audio']['type'];
        $isValid = $this->isValidType($tipoAudio);
        
        // verifica los datos obligatorios
        if (!empty($nombre) && !empty($columnista) &&  !empty($descripcion) && !empty($audio) && !empty($fecha) && !empty($duracion) && !empty($etiqueta)) {
            // inserta en la DB y redirige

            if ($isValid){
                $nombreFinal = "audio/" . uniqid("", true) . "." . strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));
                $success = $this->modelPodcasts->insertPodcast($nombre, $columnista, $descripcion, $nombreFinal, $fecha, $duracion, $etiqueta, $invitado);
                
                if ($success){
                move_uploaded_file($nombreTemporal, $nombreFinal);
                header('Location: ' . BASE_URL . 'admin');
                }
                else{
                    $this->viewMessage->showError("ERROR! Falló la carga del podcast"); 
                } 
            }
            else{
                $this->viewMessage->showError("ERROR! Tipo de archivo no soportado"); 
            }
            
        } else {
            $this->viewMessage->showError("ERROR! Faltan datos obligatorios"); 
        }
    }

    public function editPodcast($idPodcast){

        $old = $this->modelPodcasts->getPodcast($idPodcast);
        $listColumnists = $this->modelColumnists->getAll(); 

        $this->view->showEditPodcast($old,$listColumnists);
    }

    public function updatePodcast($idPodcast){

        $nombre = $_POST['nombre'];
        $columnista = $_POST['columnista'];
        $descripcion = $_POST['descripcion'];
        $audio = $_POST['audio'];
        $fecha = $_POST['fecha'];
        $duracion = $_POST['duracion'];
        $etiqueta = $_POST['etiqueta'];
        $invitado = $_POST['invitado'];

        // verifica los datos obligatorios
        if (!empty($nombre) && !empty($columnista) &&  !empty($descripcion) && !empty($audio) && !empty($fecha) && !empty($duracion) && !empty($etiqueta)) {
            // inserta en la DB y redirige
            $success = $this->modelPodcasts->updatePodcast($idPodcast, $nombre, $columnista, $descripcion, $audio, $fecha, $duracion, $etiqueta, $invitado);
            if ($success){
                header('Location: ' . BASE_URL . 'admin');
            }
            else {
                $this->viewMessage->showError("Error al actualizar la tabla"); 
            }
        } else {
            $this->viewMessage->showError("ERROR! Faltan datos obligatorios"); 
        }
    }

    public function deletePodcast($idPodcast){

        //Rescatamos la dirección del archivo antes de eliminarlo
        $path = $this->modelPodcasts->getPathPodcast($idPodcast)->url_audio;
        

        //Pasamos como segundo parámetro la dirección para borrarlo de nuestro repositorio ademas de la DB
        $this->modelPodcasts->deletePodcast($idPodcast, $path);
        header('Location: ' . BASE_URL . 'admin');
    }

    public function viewPodcasts($idColumnist){
        
        $podcasts = $this->modelPodcasts->getPodcasts($idColumnist);
        $listColumnists = $this->modelColumnists->getAll();
        $this->view->showAdminPodcasts($podcasts, $listColumnists);
    }

    private function isValidType($audioType) {
        if ($audioType == "audio/ogg" || $audioType == "audio/mpeg"){
            return true;
        }else{
            return false;
        }
    } 
}