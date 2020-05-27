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
}