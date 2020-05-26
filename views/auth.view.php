<?php

require_once('libs/Smarty.class.php');


class AuthView{

    public function showFormLogin($error = null) {

        $smarty = new Smarty();

        $smarty->assign('base_url', BASE_URL);
        $smarty->assign('title', 'Columnistas');
        $smarty->assign('error', $error);
        
        $smarty->display('formLogin.tpl');
    }
    
}