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

    public function getColumnists($params = []){
        $columnists = $this->model->getAll(); //obtengo los columnistas
        $this->view->response($columnists, 200); //lo paso a la vista
    }

    public function getColumnist($params = []){
        //obtengo el id de los params
        $idColumnist = $params[':ID'];

        $columnist = $this->model->getColumnist($idColumnist);// traigo el columnista con ese ID si existe
        if ($columnist)
            $this->view->response($columnist, 200); //lo mando a la vista
       else
            $this->view->response("No existe ese Columnista", 404);
    }

    public function deleteColumnist($params = []){
        $idColumnist = $params[':ID'];
        $columnist = $this->model->getColumnist($idColumnist);// traigo el columnista con ese ID si existe
        
        if(!empty($columnist))
            $this->view->response("No existe el Columnista con id {$idColumnist}", 404);
            die();
        
        // Si existe lo elimina
        $this->model->deleteColumnist($idColumnist);//Elimino el columnista en el modelo
        $this->view->response("El columnista con id {$idColumnist} se elimino correctamente", 200);// La vista muestra q fue borrado
    }
}