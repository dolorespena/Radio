<?php

require_once 'views/base.view.php';

Class PodcastsView extends View{

    public function __construct(){
        parent::__construct();

        $userName = AuthHelper::getUserLogged();
        $isLogged = AuthHelper::isLogged();

        $this->getSmarty()->assign('esUser', $isLogged);
        $this->getSmarty()->assign('username', $userName);
        $this->getSmarty()->assign('saludo', '¡Hola ');  
    }

    public function showPodcasts($podcasts, $images){
 
       $this->getSmarty()->assign('title', 'Columnistas');
       $this->getSmarty()->assign('podcasts', $podcasts);
       $this->getSmarty()->assign('columnista',$podcasts[0]->columnista);
       $this->getSmarty()->assign('images', $images);

       $this->getSmarty()->display('podcasts.tpl');
    }

    public function onePodcast($podcast, $id_user, $esAdmin){
        $this->getSmarty()->assign('podcast', $podcast);
        $this->getSmarty()->assign('id_user', $id_user);
        $this->getSmarty()->assign('esAdmin', $esAdmin);
        $this->getSmarty()->display('podcastExtensor.tpl');
    }
}