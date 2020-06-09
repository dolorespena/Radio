<?php

require_once 'views/base.view.php';

Class PodcastsView extends View{

    public function __construct(){
        parent::__construct();
        
    }

    public function showPodcasts($podcasts){
        
       $this->getSmarty()->assign('title', 'Columnistas');
       $this->getSmarty()->assign('podcasts', $podcasts);
       $this->getSmarty()->assign('columnista',$podcasts[0]->columnista);
       $this->getSmarty()->assign('esAdmin', !empty($_SESSION['ID_USER']));

       $this->getSmarty()->display('podcasts.tpl');
    }

    public function showAdminPodcasts($podcasts){
 
        $this->getSmarty()->assign('title', 'Podcasts');
        $this->getSmarty()->assign('podcasts', $podcasts);
        $this->getSmarty()->assign('columnista',$podcasts[0]->columnista);
        $this->getSmarty()->assign('esAdmin', !empty($_SESSION['ID_USER']));
        $this->getSmarty()->assign('saludo', '¡Hola ');
        $this->getSmarty()->assign('username', $_SESSION['USERNAME']);
 
        $this->getSmarty()->display('adminPodcast.tpl');
     }


}