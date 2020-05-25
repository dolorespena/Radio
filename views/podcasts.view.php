<?php

require_once('libs/Smarty.class.php');


Class PodcastsView{

    public function showPodcasts($podcasts){
        
       $smarty = new Smarty();

       $smarty->assign('base_url', BASE_URL);
       $smarty->assign('title', 'Columnistas');

       $smarty->assign('podcasts', $podcasts);
       $smarty->assign('columnista',$podcasts[0]->columnista);

       $smarty->display('podcasts.tpl');
    }

    public function showError($message){ // Ultra provisiorio - hay que hacer view del error
        echo($message);
    }

}