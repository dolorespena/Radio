<?php

class AdminView{

    public function showAdmin($columnists, $podcasts){
        $smarty = new Smarty();

        $smarty->assign('title', 'Administración');
        $smarty->assign('base_url', BASE_URL);
        $smarty->assign('columnists', $columnists);  
        $smarty->assign('podcasts', $podcasts); 
            
        $smarty->display('admin.tpl');
    }
    
}