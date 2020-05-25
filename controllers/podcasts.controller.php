<?php

require_once 'models/podcasts.model.php';
require_once 'views/podcasts.view.php';

class PodcastsController{
    private $model;
    private $view;

    public function __construct() {
        $this->model = new PodcastsModel();
        $this->view = new PodcastsView();
    }

    public function showPodcasts($idColumnist){
        $podcasts = $this->model->getPodcasts($idColumnist);
        $this->view->showPodcasts($podcasts);
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
            $this->model->insertPodcast($nombre, $columnista, $descripcion, $audio, $fecha, $duracion, $etiqueta, $invitado);
            header('Location: ' . BASE_URL . 'admin');
        } else {
            $this->view->showError("ERROR! Faltan datos obligatorios"); //FALTA HACER FUNCION
        }
        
    }
}