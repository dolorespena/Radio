<?php

require_once 'models/podcasts.model.php';
require_once 'views/podcasts.view.php';

class PodcastsController{
    
    private $imageModel;
    private $model;
    private $view;

    public function __construct() {
        
        $this->model = new PodcastsModel();
        $this->view = new PodcastsView();
        $this->imageModel = new ImageModel();
    }

    public function showPodcasts($idColumnist){
        $podcasts = $this->model->getPodcasts($idColumnist);
        $images = $this->imageModel->getImages($idColumnist);
        $this->view->showPodcasts($podcasts, $images);
    }

    public function getPodcast($idPodcast){
        $podcast = $this->model->getPodcast($idPodcast);
        $esAdmin = AuthHelper::getIsAdmin();
        if(AuthHelper::isLogged()){
            $id_user = AuthHelper::getIdUser();
        } else{
            $id_user = 0; //Aunque no haya usuario logueado, la variable llega con un valor para asignarla en smarty.
        }
        $this->view->onePodcast($podcast, $id_user, $esAdmin);
    }

}