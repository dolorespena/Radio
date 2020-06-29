<?php
   
    require_once 'controllers/columnists.controller.php';
    require_once 'controllers/podcasts.controller.php';
    require_once 'controllers/auth.controller.php';
    require_once 'controllers/admin.controller.php';
    require_once 'controllers/message.controller.php';

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
        
        case 'admin':

            if (empty($parametros[1])){
                $controller = new AdminController;
                $controller->showAdmin();
            }
            else {
                if ($parametros[1] == 'columnist'){
                    if ($parametros[2] == 'add'){
                        $controller = new AdminController;
                        $controller->addColumnist();
                    }
                    if ($parametros[2] == 'delete'){
                        $controller = new AdminController;
                        $controller->deleteColumnist($parametros[3]); 
                    }
                    if ($parametros[2] == 'edit'){
                        $controller = new AdminController;
                        $controller->editColumnist($parametros[3]);
                    }
                    if ($parametros[2] == 'update'){
                        $controller = new AdminController;
                        $controller->updateColumnist($parametros[3]);
                    }
                }
                if ($parametros[1] == 'podcast'){
                    if ($parametros[2] == 'add'){
                        $controller = new AdminController;
                        $controller->addPodcast();
                    }
                    if ($parametros[2] == 'delete'){
                        $controller = new AdminController;
                        $controller->deletePodcast($parametros[3]); 
                    }
                    if ($parametros[2] == 'edit'){
                        $controller = new AdminController;
                        $controller->editPodcast($parametros[3]);
                    }
                    if ($parametros[2] == 'update'){
                        $controller = new AdminController;
                        $controller->updatePodcast($parametros[3]);
                    }
                    if ($parametros[2] == 'view'){
                        $controller = new AdminController;
                        $controller->viewPodcasts($parametros[3]);
                    }
                }
            }
            
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

        case 'login': 
            $controller = new AuthController;
            $controller->showLogin();
        break;

        case 'logout':
            $controller = new AuthController;
            $controller->logout();
        break;

        case 'verify': 
            $controller = new AuthController;
            $controller->verify();
        break;

        case 'registration':
            $controller = new AuthController;
            $controller->showRegistration();
        break;

        case 'checkIn': 
            $controller = new AuthController;
            $controller->checkIn();
        break;

        default :
            $controller = new MessageController;
            $controller->showError("Error 404 - Página no encontrada");
        break;
    }

?>
