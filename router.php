<?php
   
    require_once 'controllers/columnists.controller.php';
    require_once 'controllers/podcasts.controller.php';
    require_once 'controllers/auth.controller.php';
    require_once 'controllers/admin.controller.php';

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
                $controller = new PodcastsController;
                $controller->showPodcasts($parametros[1]);
            }

        break;

        case 'add': 
            if ($parametros[1] == 'columnist'){
                $controller = new ColumnistsController;
                $controller->addColumnist();
            }
            if ($parametros[1] == 'podcast'){
                $controller = new PodcastsController;
                //$controller->addPodcast(); --> Falta hacer la función
            }

        break;

        case 'admin':
            $controller = new AdminController;
            $controller->showAdmin();

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
