<?php
   
    require_once 'controllers/columnists.controller.php';
    require_once 'controllers/podcasts.controller.php';
    require_once 'controllers/auth.controller.php';

    // definimos la base url de forma dinamica
    define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

    // define una acción por defecto
    if (empty($_GET['action'])) {
        $_GET['action'] = 'columnistas';
    } 

    // toma la acción que viene del usuario y parsea los parámetros
    $accion = $_GET['action']; 
    $parametros = explode('/', $accion);

    // decide que camino tomar según TABLA DE RUTEO
    switch ($parametros[0]) {
        case 'columnistas': 
            if (empty($parametros[1])){
                $controller = new ColumnistsController;
                $controller->showColumnists();
            }
            else {
                $controller = new PodcastController;
                $controller->showPodcasts($parametros[1]);
            }

        break;

        case 'login': 
            $controller = new AuthController;
            $controller->showLogin();

        break;
        case 'verify': 
            $controller = new AuthController;
            $controller->verify();

        break;
    }

?>
