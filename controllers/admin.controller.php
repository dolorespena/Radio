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
        $imagen = $_FILES ['imagen'];

        //Datos del archivo ingresado
        $nombreOriginal =  $_FILES ['imagen']['name'];
        $nombreTemporal = $_FILES ['imagen']['tmp_name'];
        $tipoAudio = $_FILES['imagen']['type'];
        $isValid = $this->isValidType($tipoAudio, 'image');


        // verifica los datos obligatorios
        if (!empty($nombre) && !empty($profesion) &&  !empty($descripcion) && !empty($imagen)) {

            if ($isValid){
                $nombreFinal = "img/profile/" . uniqid("", true) . "." . strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));
                $success = $this->modelColumnists->insertColumnist($nombre, $profesion, $descripcion, $nombreFinal);
                
                if ($success){
                move_uploaded_file($nombreTemporal, $nombreFinal);
                header('Location: ' . BASE_URL . 'admin');
                }
                else{
                    $this->viewMessage->showError("ERROR! Falló la carga del columnista"); 
                } 
            }
            else{
                $this->viewMessage->showError("ERROR! Tipo de archivo no soportado"); 
            }
        } else {
            $this->viewMessage->showError("ERROR! Faltan datos obligatorios"); 
        }
   }

   public function deleteColumnist($idColumnist){
        //Rescatamos la dirección del archivo antes de eliminarlo
        $path = $this->modelColumnists->getPathColumnist($idColumnist)->url_imagen;

        $success = $this->modelColumnists->deleteColumnist($idColumnist);

        if ($success){
            unlink($path);
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
        $imagen = $_FILES['imagen'];
        $url_imagen = $_POST['old_imagen'];

        if (!empty($nombre) && !empty($profesion) &&  !empty($descripcion)) {

            if ($imagen['error'] != 4){
                $nombreOriginal =  $_FILES ['imagen']['name'];
                $nombreTemporal = $_FILES ['imagen']['tmp_name'];
                $tipoArchivo = $_FILES['imagen']['type'];
                $isValid = $this->isValidType($tipoArchivo, 'image');
    
                if ($isValid){
                    unlink($url_imagen);
                    $url_imagen = "img/profile/" . uniqid("", true) . "." . strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));
                    move_uploaded_file($nombreTemporal, $url_imagen);
                } else{
                    $this->viewMessage->showError("ERROR! Tipo de archivo no soportado"); 
                }     
            }
            $success = $this->modelColumnists->updateColumnist($idColumnist, $nombre, $profesion, $descripcion, $url_imagen);
            if ($success){
                header('Location: ' . BASE_URL . 'admin');
            }
            else {
                $this->viewMessage->showError("Error al modificar el columnista"); 
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
        $tipoArchivo = $_FILES['audio']['type'];
        $isValid = $this->isValidType($tipoArchivo, 'audio');
        
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
        $audio = $_FILES['audio'];
        $fecha = $_POST['fecha'];
        $duracion = $_POST['duracion'];
        $etiqueta = $_POST['etiqueta'];
        $invitado = $_POST['invitado'];
        $url_audio = $_POST['old_audio']; // URL que se mantendrá si el usuario no cargó un nuevo archivo

        // verifica los datos obligatorios
        if (!empty($nombre) && !empty($columnista) &&  !empty($descripcion) && !empty($fecha) && !empty($duracion) && !empty($etiqueta)) {
            
            if ($audio['error'] != 4){

                $nombreOriginal =  $_FILES ['audio']['name'];
                $nombreTemporal = $_FILES ['audio']['tmp_name'];
                $tipoArchivo = $_FILES['audio']['type'];
                $isValid = $this->isValidType($tipoArchivo, 'audio');

                if ($isValid){
                    unlink($url_audio);
                    $url_audio = "audio/" . uniqid("", true) . "." . strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));
                    move_uploaded_file($nombreTemporal, $url_audio);
                } else{
                    $this->viewMessage->showError("ERROR! Tipo de archivo no soportado"); 
                }     
            }

            $success = $this->modelPodcasts->updatePodcast($idPodcast, $nombre, $columnista, $descripcion, $url_audio, $fecha, $duracion, $etiqueta, $invitado);
            if ($success){
                header('Location: ' . BASE_URL . 'admin');
            } else{
                $this->viewMessage->showError("ERROR! Falló la carga del podcast"); 
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

    private function isValidType($audioType, $validFormat) {

        switch ($validFormat) {
            case 'audio':
                if ($audioType == "audio/ogg" || $audioType == "audio/mpeg"){
                    return true;
                }else{
                    return false;
                }
                break;
            
            case 'image':
                if ($audioType == "image/gif" || $audioType == "image/jpg" ||
                    $audioType == "image/png" || $audioType == "image/jpeg"){
                    return true;
                }else{
                    return false;
                }
            break;
        }
        
    } 
}