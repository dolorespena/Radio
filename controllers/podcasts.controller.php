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
        $this->view->onePodcast($podcast);
    }

    
}