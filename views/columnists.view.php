<?php

require_once('libs/Smarty.class.php');

Class ColumnistsView{

    public function showColumnists($columnists){

        $smarty = new Smarty();

        $smarty->assign('title', 'Columnistas');
        $smarty->assign('base_url', BASE_URL);
        $smarty->assign('columnists', $columnists);        
        $smarty->assign('url_columnist','columnistas/');
<<<<<<< HEAD
        $smarty->assign('esAdmin', !empty($_SESSION['ID_USER']));   
=======
        $smarty->assign('esAdmin', !empty($_SESSION['ID_USER']));
        var_dump(!empty($_SESSION['ID_USER']));  
        die();    
>>>>>>> aa12c9f80e02f38104c4fb7270350724e381a3af
     
            
        $smarty->display('columnist.tpl');

        
    }

}