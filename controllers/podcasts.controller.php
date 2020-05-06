<?php

require_once 'models/podcasts.model.php';
require_once 'views/podcasts.view.php';

class PodcastController{
    private $model;
    private $view;

    public function __construct() {
        $this->model = new PodcastsModel();
        $this->view = new PodcastsView();
    }

    public function showPodcasts($idColumnist){
        
    }
}