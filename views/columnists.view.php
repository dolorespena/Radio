<?php

require_once('libs/Smarty.class.php');

Class ColumnistsView{

    public function showColumnists($columnists){

        $smarty = new Smarty();

        $smarty->assign('title', 'Columnistas');
        $smarty->assign('base_url', BASE_URL);
        $smarty->assign('columnists', $columnists);        
        $smarty->assign('url_columnist','columnistas/');
        $smarty->assign('esAdmin', !empty($_SESSION['ID_USER']));
     
            
        $smarty->display('columnist.tpl');

        
    }

    public function showError($message){ 
        
        $smarty = new Smarty();

        $smarty->assign('title', 'Página no encontrada');
        $smarty->assign('base_url', BASE_URL);
        $smarty->assign('img_url', 'img/radio.png');

        $smarty->assign('error', $message);
        $smarty->assign('esAdmin', !empty($_SESSION['ID_USER']));

        $smarty->display('error.tpl');


    }


}