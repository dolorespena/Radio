<?php

include_once 'models/columnists.model.php';
include_once 'models/podcasts.model.php';
include_once 'views/admin.view.php';

class AdminController{

    private $modelColumnists;
    private $modelPodcasts;
    private $view;
    private $viewColumnists;

    public function __construct() {

        $this->checklogged();
        $this->modelColumnists = new ColumnistsModel();
        $this->modelPodcasts = new PodcastsModel();
        $this->view = new AdminView();
        $this->viewColumnists = new ColumnistsView();
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
        if (!empty($nombre) || !empty($profesion) ||  !empty($descripcion) || !empty($imagen)) {
            // inserta en la DB y redirige
            $this->modelColumnists->insertColumnist($nombre, $profesion, $descripcion, $imagen);
            header('Location: ' . BASE_URL . 'admin');
        } else {
            $this->viewColumnists->showError("ERROR! Faltan datos obligatorios"); 
        }
    
   }

   public function deleteColumnist($idColumnist){
   
        $success = $this->modelColumnists->deleteColumnist($idColumnist);

        if ($success){
            header('Location: ' . BASE_URL . 'admin');
        }
        else {
            $this->viewColumnists->showError("Debes eliminar todos los podcasts de este columnista previamente"); 
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
        if (!empty($nombre) || !empty($profesion) ||  !empty($descripcion) || !empty($imagen)) {
            // inserta en la DB y redirige
            $success = $this->modelColumnists->updateColumnist($idColumnist, $nombre, $profesion, $descripcion, $imagen);
            if ($success){
                header('Location: ' . BASE_URL . 'admin');
            }
            else {
                $this->viewColumnists->showError("Error al actualizar la tabla"); 
            }
        } else {
            $this->viewColumnists->showError("ERROR! Faltan datos obligatorios"); 
        }

   }

    public function addPodcast(){

        // toma los valores enviados por el usuario
        $nombre = $_POST['nombre'];
        $columnista = $_POST['columnista'];
        $descripcion = $_POST['descripcion'];
        $audio = $_POST['audio'];
        $fecha = $_POST['fecha'];
        $duracion = $_POST['duracion'];
        $etiqueta = $_POST['etiqueta'];
        $invitado = $_POST['invitado'];

        // verifica los datos obligatorios
        if (!empty($nombre) || !empty($columnista) ||  !empty($descripcion) || !empty($audio) || !empty($fecha) || !empty($duracion) || !empty($etiqueta)) {
            // inserta en la DB y redirige
            $this->modelPodcasts->insertPodcast($nombre, $columnista, $descripcion, $audio, $fecha, $duracion, $etiqueta, $invitado);
            header('Location: ' . BASE_URL . 'admin');
        } else {
            $this->viewColumnists->showError("ERROR! Faltan datos obligatorios"); 
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
        if (!empty($nombre) || !empty($columnista) ||  !empty($descripcion) || !empty($audio) || !empty($fecha) || !empty($duracion) || !empty($etiqueta)) {
            // inserta en la DB y redirige
            $success = $this->modelPodcasts->updatePodcast($idPodcast, $nombre, $columnista, $descripcion, $audio, $fecha, $duracion, $etiqueta, $invitado);
            if ($success){
                header('Location: ' . BASE_URL . 'admin');
            }
            else {
                $this->viewColumnists->showError("Error al actualizar la tabla"); 
            }
        } else {
            $this->viewColumnists->showError("ERROR! Faltan datos obligatorios"); 
        }
    }

    public function deletePodcast($idPodcast){

        $this->modelPodcasts->deletePodcast($idPodcast);
        header('Location: ' . BASE_URL . 'admin');

    }
     //verifica que existe un usuario logueado
     private function checklogged(){
        session_start();
        if (!isset($_SESSION['ID_USER'])){
            header('Location: ' . BASE_URL . 'login');
            die();
        }
    }
}