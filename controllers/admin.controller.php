<?php

include_once 'models/columnists.model.php';
include_once 'models/podcasts.model.php';
include_once 'views/admin.view.php';

class AdminController{

    private $modelColumnists;
    private $modelPodcasts;
    private $view;

    public function __construct() {
        $this->modelColumnists = new ColumnistsModel();
        $this->modelPodcasts = new PodcastsModel();
        $this->view = new AdminView();
    }

    public function showAdmin(){

        $columnists = $this->modelColumnists->getAll();
        $podcasts = $this->modelPodcasts->getAll();
        $this->view->showAdmin($columnists, $podcasts);
    }

    
}

