<?php

require_once 'views/base.view.php';

class AdminView extends View{


    public function __construct(){
        parent::__construct();
        
        $userName = AuthHelper::getUserLogged();
        $isLogged = AuthHelper::isLogged();

         $this->getSmarty()->assign('esAdmin', $isLogged);
         $this->getSmarty()->assign('username', $userName);
         $this->getSmarty()->assign('saludo', '¡Hola ');
    }
   
    public function showAdmin($columnists, $podcasts){        

         $this->getSmarty()->assign('title', 'Administración');
         $this->getSmarty()->assign('columnists', $columnists);  
         $this->getSmarty()->assign('podcasts', $podcasts); 
            
         $this->getSmarty()->display('adminColumnist.tpl');
    }

    public function showAdminPodcasts($podcasts, $listColumnists){
 
     $this->getSmarty()->assign('title', 'Podcasts');
     $this->getSmarty()->assign('podcasts', $podcasts);
     $this->getSmarty()->assign('columnista',$podcasts[0]->columnista);
     $this->getSmarty()->assign('listColumnists', $listColumnists);
     

     $this->getSmarty()->display('adminPodcast.tpl');
  }

    public function showEditColumnist($old){
        
         $this->getSmarty()->assign('title', 'Editar Columnista');
         $this->getSmarty()->assign('old', $old);        
         $this->getSmarty()->assign('url_columnist','columnistas/');

         $this->getSmarty()->display('editColumnist.tpl');
    }

    public function showEditPodcast($old, $listColumnists){

         $this->getSmarty()->assign('title', 'Editar Podcast');
         $this->getSmarty()->assign('old', $old);  
         $this->getSmarty()->assign('listColumnists', $listColumnists);
     
         $this->getSmarty()->display('editPodcast.tpl');
    }
}