<?php

require_once('libs/Smarty.class.php');


Class PodcastsView{

    public function showPodcasts($podcasts){
        
       $smarty = new Smarty();

       $smarty->assign('base_url', BASE_URL);
       $smarty->assign('titulo', 'Columnistas');

       $smarty->assign('podcasts', $podcasts);
       $smarty->assign('columnista',$podcasts[0]->columnista);

       $smarty->display('podcasts.tpl');
    }

}