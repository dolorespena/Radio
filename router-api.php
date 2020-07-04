<?php

require_once 'libs/router/Router.php';
require_once 'api/api-controllers/comment-api.controller.php';

// creo el ruteador
$router = new Router();

//creo la tabla de ruteo

//--------- Comment ----------
$router->addRoute('comentarios', 'GET', 'CommentApiController', 'getComments');
$router->addRoute('comentario/:ID', 'GET', 'CommentApiController', 'getComment');
$router->addRoute('comentario/:ID', 'DELETE', 'CommentApiController', 'deleteComment');
$router->addRoute('comentario', 'POST', 'CommentApiController', 'addComment');

//ruteo
$router->route($_REQUEST['resource'], $_SERVER['REQUEST_METHOD']);