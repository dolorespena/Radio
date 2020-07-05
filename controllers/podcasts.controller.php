<?php

require_once 'models/podcasts.model.php';
require_once 'views/podcasts.view.php';

class PodcastsController{
    
    private $model;
    private $view;

    public function __construct() {
        $this->modelColumnists = new ColumnistsModel(); 
        $this->model = new PodcastsModel();
        $this->view = new PodcastsView();
        
    }

    public function showPodcasts($idColumnist){
        $podcasts = $this->model->getPodcasts($idColumnist);
        $this->view->showPodcasts($podcasts);
    }

    public function getPodcast($idPodcast){
        $podcast = $this->model->getPodcast($idPodcast);
        if(AuthHelper::isLogged()){
            $id_user = AuthHelper::getIdUser();
        } else{
            $id_user = 0; //Aunque no haya usuario logueado, la variable llega con un valor para asignarla en smarty.
        }
        $this->view->onePodcast($podcast, $id_user);
    }

    
}