<?php

require_once 'models/podcasts.model.php';

class PodcastApiController{

    private $model;
    private $view;

    public function __construct(){
        $this->model = new PodcastsModel();
        $this->view = new APIView();
    }
    
    
}
