<?php
   
    require_once 'controllers/columnists.controller.php';
    require_once 'controllers/podcasts.controller.php';
    require_once 'controllers/auth.controller.php';
<<<<<<< HEAD
=======
    require_once 'controllers/admin.controller.php';
>>>>>>> 387c2d1b0489beb049efa915e4756ae99b4f8294

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
        
        case 'add': 
            if ($parametros[1] == 'columnist'){
                $controller = new ColumnistsController;
                $controller->addColumnist();
            }
            if ($parametros[1] == 'podcast'){
                $controller = new PodcastsController;
                $controller->addPodcast(); 
            }

        break;

        case 'admin':
            $controller = new AdminController;
            $controller->showAdmin();

        break;

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

        case 'delete':
            if ($parametros[1] == 'columnist'){
                $controller = new ColumnistsController;
                $controller->deleteColumnist($parametros[2]);
            }
            if ($parametros[1] == 'podcast'){
                $controller = new PodcastsController;
                $controller->deletePodcast($parametros[2]); 
            }

        break;

        case 'edit':
            if ($parametros[1] == 'columnist'){
                $controller = new ColumnistsController;
                $controller->editColumnist($parametros[2]);
            }
            if ($parametros[1] == 'podcast'){
                $controller = new PodcastsController;
                $controller->editPodcast($parametros[2]); 
            }

        break;


        case 'login': 
            $controller = new AuthController;
            $controller->showLogin();

        break;

        case 'update':
            if ($parametros[1] == 'columnist'){
                $controller = new ColumnistsController;
                $controller->updateColumnist($parametros[2]);
            }
            if ($parametros[1] == 'podcast'){
                $controller = new PodcastsController;
                $controller->updatePodcast($parametros[2]); 
            }

        break;


        case 'verify': 
            $controller = new AuthController;
            $controller->verify();

        break;
    }

?>
