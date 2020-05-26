<?php

require_once 'models/podcasts.model.php';
require_once 'views/podcasts.view.php';

class PodcastsController{
    
    private $modelColumnists; //Chanchada que tendremos que corregir
    private $model;
    private $view;

    public function __construct() {
        $this->modelColumnists = new ColumnistsModel(); // Parte de la chanchada a corregir
        $this->model = new PodcastsModel();
        $this->view = new PodcastsView();
        
    }

    public function showPodcasts($idColumnist){
        $podcasts = $this->model->getPodcasts($idColumnist);
        $this->view->showPodcasts($podcasts);
    }

    
}