<?php

include_once 'models/columnists.model.php';
include_once 'models/podcasts.model.php';
include_once 'views/admin.view.php';

class AdminController{

    private $modelColumnists;
    private $modelPodcasts;
    private $view;

    public function __construct() {
        $this->modelColumnists = new ColumnistsModel();
        $this->modelPodcasts = new PodcastsModel();
        $this->view = new AdminView();
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
            $this->view->showError("ERROR! Faltan datos obligatorios"); //FALTA HACER FUNCION
        }
    
   }

   public function deleteColumnist($idColumnist){
       
       $success = $this->modelColumnists->deleteColumnist($idColumnist);

       if ($success){
           header('Location: ' . BASE_URL . 'admin');
       }
       else {
           $this->view->showError("Debes eliminar todos los podcasts de este columnista previamente"); //FALTA HACER FUNCION
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
               $this->view->showError("Error al actualizar la tabla"); //FALTA HACER FUNCION
           }
       } else {
           $this->view->showError("ERROR! Faltan datos obligatorios"); //FALTA HACER FUNCION
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
            $this->view->showError("ERROR! Faltan datos obligatorios"); //FALTA HACER FUNCION
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
                $this->view->showError("Error al actualizar la tabla"); //FALTA HACER FUNCION
            }
        } else {
            $this->view->showError("ERROR! Faltan datos obligatorios"); //FALTA HACER FUNCION
        }


    }

    public function deletePodcast($idPodcast){

        $this->modelPodcasts->deletePodcast($idPodcast);
        header('Location: ' . BASE_URL . 'admin');

    }
}