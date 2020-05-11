<?php

require_once('libs/Smarty.class.php');

Class ColumnistsView{

    public function showColumnists($columnists){

        $smarty = new Smarty();

        $smarty->assign('title', 'Columnistas');
        $smarty->assign('columnists', $columnists);
        $smarty->assign('base_url', BASE_URL);
        $smarty->assign('url_columnist','columnistas/');
            
        $smarty->display('columnist.tpl');

        
    }
}