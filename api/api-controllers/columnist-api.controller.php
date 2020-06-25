<?php
require_once 'models/columnists.model.php';
require_once 'api/api.view.php';


class ColumnistApiController{

    private $model;
    private $view;

    public function __construct(){
        $this->model = new ColumnistsModel();
        $this->view = new APIView();
    }

    public function getColumnists(){
        $columnists = $this->model->getAll();
        $this->view->responce($columnists);
    }

    public function getColumnist($params){
        var_dump($params);
    }
}