<?php

require_once 'models/comment.model.php';
require_once 'api/api.view.php';

class CommentApiController {
   
    protected $model;
    protected $view;
    private $data; 

    public function __construct() {
        $this->view = new APIView();
        $this->data = file_get_contents("php://input"); 
        $this->model = new ComentModel();
    }

    function getData(){ 
        return json_decode($this->data); 
    }  

    public function getComments($params = null) {
        $comment = $this->model->getComments();
        $this->view->response($comment, 200);
    }

    public function getComment($params = null) {
        // obtiene el parametro de la ruta
        $idComment = $params[':ID'];
        
        $comment = $this->model->getComment($idComment);
        
        if ($comment) {
            $this->view->response($comment, 200);   
        } else {
            $this->view->response("No existe la tarea con el id={$idComment}", 404);
        }
    }

    public function deleteComment($params = []) {
        $idComment = $params[':ID'];
        $comment = $this->model->getComment($idComment);

        if ($comment) {
            $this->model->deleteComment($idComment);
            $this->view->response("Tarea id=$idComment eliminada con éxito", 200);
        }
        else 
            $this->view->response("Task id=$idComment not found", 404);
    }

    public function addComment($params = []) {     
        $comment = $this->getData(); // la obtengo del body

        // inserta la tarea
        $idComment = $this->model->insertComment($comment->detalle, $comment->fecha, $comment->valoracion, $comment->id_podcast_fk, $comment->id_usuario_fk);

        // obtengo la recien creada
        $newComment = $this->model->getComment($idComment);
        
        if ($newComment)
            $this->view->response($newComment, 200);
        else
            $this->view->response("Error al insertar tarea", 500);

    }

}

