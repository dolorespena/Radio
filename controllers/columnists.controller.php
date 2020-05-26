<?php

require_once 'models/columnists.model.php';
require_once 'views/columnists.view.php';

class ColumnistsController{
    private $model;
    private $view;

    public function __construct() {
        $this->model = new ColumnistsModel();
        $this->view = new ColumnistsView();
    }

    public function showColumnists(){
        // Pido los columnistas al MODELO
        $columnists = $this->model->getAll();

        // Actualizo la VISTA
        $this->view->showColumnists($columnists);
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
             $this->model->insertColumnist($nombre, $profesion, $descripcion, $imagen);
             header('Location: ' . BASE_URL . 'admin');
         } else {
             $this->view->showError("ERROR! Faltan datos obligatorios"); //FALTA HACER FUNCION
         }
     
    }

    public function deleteColumnist($idColumnist){
        
        $success = $this->model->deleteColumnist($idColumnist);

        if ($success){
            header('Location: ' . BASE_URL . 'admin');
        }
        else {
            $this->view->showError("Debes eliminar todos los podcasts de este columnista previamente"); //FALTA HACER FUNCION
        }
       
    }

    public function editColumnist($idColumnist){

        $old = $this->model->getColumnist($idColumnist);
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
            $success = $this->model->updateColumnist($idColumnist, $nombre, $profesion, $descripcion, $imagen);
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


}