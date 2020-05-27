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
        
        case 'admin':

            if (empty($parametros[1])){
                $controller = new AdminController;
                $controller->showAdmin();

            }
            else {
                if ($parametros[1] == 'add'){
                    if ($parametros[2] == 'columnist'){
                        $controller = new AdminController;
                        $controller->addColumnist();
                    }
                    if ($parametros[2] == 'podcast'){
                        $controller = new AdminController;
                        $controller->addPodcast(); 
                    }
                }
                if ($parametros[1] == 'delete'){
                    if ($parametros[2] == 'columnist'){
                        $controller = new AdminController;
                        $controller->deleteColumnist($parametros[3]);
                    }
                    if ($parametros[2] == 'podcast'){
                        $controller = new AdminController;
                        $controller->deletePodcast($parametros[3]); 
                    }
                }
                if ($parametros[1] == 'edit'){
                    if ($parametros[2] == 'columnist'){
                        $controller = new AdminController;
                        $controller->editColumnist($parametros[3]);
                    }
                    if ($parametros[2] == 'podcast'){
                        $controller = new AdminController;
                        $controller->editPodcast($parametros[3]); 
                    }
                }
                if ($parametros[1] == 'update'){
                    if ($parametros[2] == 'columnist'){
                        $controller = new AdminController;
                        $controller->updateColumnist($parametros[3]);
                    }
                    if ($parametros[2] == 'podcast'){
                        $controller = new AdminController;
                        $controller->updatePodcast($parametros[3]); 
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
    }

?>
