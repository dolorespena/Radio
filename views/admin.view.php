<?php

class AdminView{

    public function showAdmin($columnists, $podcasts){
        $smarty = new Smarty();

        $smarty->assign('title', 'Administración');
        $smarty->assign('base_url', BASE_URL);
        $smarty->assign('columnists', $columnists);  
        $smarty->assign('podcasts', $podcasts); 
        $smarty->assign('esAdmin', !empty($_SESSION['ID_USER']));
        $smarty->assign('username', $_SESSION['USERNAME']);
        $smarty->assign('saludo', '¡Hola ');
        
      
            
        $smarty->display('admin.tpl');
    }

    public function showEditColumnist($old){

        $smarty = new Smarty();

        $smarty->assign('title', 'Editar Columnista');
        $smarty->assign('base_url', BASE_URL);
        $smarty->assign('old', $old);        
        $smarty->assign('url_columnist','columnistas/');
        $smarty->assign('esAdmin', !empty($_SESSION['ID_USER']));
        $smarty->assign('username', $_SESSION['USERNAME']);
        $smarty->assign('saludo', '¡Hola ');
            
        $smarty->display('editColumnist.tpl');
        
    }

    public function showEditPodcast($old, $listColumnists){

        $smarty = new Smarty();

        $smarty->assign('title', 'Editar Podcast');
        $smarty->assign('base_url', BASE_URL);
        $smarty->assign('old', $old);  
        $smarty->assign('listColumnists', $listColumnists);
        $smarty->assign('esAdmin', !empty($_SESSION['ID_USER'])); 
        $smarty->assign('username', $_SESSION['USERNAME']);
        $smarty->assign('saludo', '¡Hola ');
     
        $smarty->display('editPodcast.tpl');

    }

}