<?php

require_once('libs/Smarty.class.php');


class AuthView{

    public function showFormLogin() {

        $smarty = new Smarty();

        $smarty->assign('base_url', BASE_URL);
        $smarty->assign('title', 'Columnistas');

        $smarty->display('formLogin.tpl');
    }
    
}