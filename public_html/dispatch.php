<?php

require_once '../app/controllers/' . $_REQUEST['controller'] . '.php';

if (!$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    echo 'Requisição inválida!';
    exit;
}
    
$controller = filter_input(INPUT_GET, 'controller', FILTER_DEFAULT);
$method = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
$controllerInstance = new $controller();
$controllerInstance->$method();
