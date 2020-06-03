<?php

require_once('libs/Smarty.class.php');


Class PodcastsView{

    public function showPodcasts($podcasts){
        
       $smarty = new Smarty();

       $smarty->assign('base_url', BASE_URL);
       $smarty->assign('title', 'Columnistas');
       $smarty->assign('podcasts', $podcasts);
       $smarty->assign('columnista',$podcasts[0]->columnista);
       $smarty->assign('esAdmin', !empty($_SESSION['ID_USER']));

       $smarty->display('podcasts.tpl');
    }

    public function showAdminPodcasts($podcasts){
        
        $smarty = new Smarty();
 
        $smarty->assign('base_url', BASE_URL);
        $smarty->assign('title', 'Columnistas');
        $smarty->assign('podcasts', $podcasts);
        $smarty->assign('columnista',$podcasts[0]->columnista);
        $smarty->assign('esAdmin', !empty($_SESSION['ID_USER']));
        $smarty->assign('saludo', '¡Hola ');
        $smarty->assign('username', $_SESSION['USERNAME']);
 
        $smarty->display('adminPodcast.tpl');
     }
    public function showError($message){ 
        echo($message);
    }

}