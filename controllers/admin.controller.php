<?php

class AdminController{

    private $modelColumnists;
    private $modelPodcast;
    private $view;

    public function __construct() {
        $this->modelColumnists = new ColumnistsModel();
        $this->modelPodcasts = new PodcastsModel();
        $this->view = new AdminView();
    }

    public function showAdmin(){
        
    }

    
}

