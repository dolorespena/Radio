<?php

require_once('libs/Smarty.class.php');

Class ColumnistsView{

    public function showColumnists($columnists){

        $smarty = new Smarty();

        $smarty->assign('title', 'Columnistas');
        $smarty->assign('base_url', BASE_URL);
        $smarty->assign('columnists', $columnists);        
        $smarty->assign('url_columnist','columnistas/');
            
        $smarty->display('columnist.tpl');

        
    }

    public function showError($message){ // Ultra provisiorio - hay que hacer view del error
        echo($message);
    }

    public function showEditColumnist($old){

        $smarty = new Smarty();

        $smarty->assign('title', 'Editar Columnista');
        $smarty->assign('base_url', BASE_URL);
        $smarty->assign('old', $old);        
        $smarty->assign('url_columnist','columnistas/');
            
        $smarty->display('editColumnist.tpl');
        
    }
}