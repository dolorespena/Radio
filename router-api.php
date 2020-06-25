<?php

require_once 'libs/router/Router.php';
require_once 'api/api-controllers/columnist-api.controller.php';

// creo el ruteador
$router = new Router();

//creo la tabla de ruteo
$router->addRoute('columnistas', 'GET', 'ColimnistApiController', 'getColumnists');

//ruteo
$router->route($_REQUEST['resource'], $_SERVER['REQUEST_METHOD']);