<?php

require_once('libs/Smarty.class.php');

class AdminView{

    private $smarty;

    public function __construct(){
        $this->smarty = new Smarty();
        
        $this->smarty->assign('base_url', BASE_URL);
        $this->smarty->assign('esAdmin', !empty($_SESSION['ID_USER']));
        $this->smarty->assign('username', $_SESSION['USERNAME']);
        $this->smarty->assign('saludo', '¡Hola ');
    }
   
    public function showAdmin($columnists, $podcasts){        

        $this->smarty->assign('title', 'Administración');
        $this->smarty->assign('columnists', $columnists);  
        $this->smarty->assign('podcasts', $podcasts); 
            
        $this->smarty->display('admin.tpl');
    }

    public function showEditColumnist($old){
        
        $this->smarty->assign('title', 'Editar Columnista');
        $this->smarty->assign('old', $old);        
        $this->smarty->assign('url_columnist','columnistas/');

        $this->smarty->display('editColumnist.tpl');
    }

    public function showEditPodcast($old, $listColumnists){

        $this->smarty->assign('title', 'Editar Podcast');
        $this->smarty->assign('old', $old);  
        $this->smarty->assign('listColumnists', $listColumnists);
     
        $this->smarty->display('editPodcast.tpl');
    }
}