<?php

require_once '../../app/controller/' . $_REQUEST['controller'] . '.php';

$dispatch = new Dispatch();

class Dispatch {

    public $controller;
    public $mathod;

    public function __construct() {
        if (!$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            header("location: ../home");
        } else {
            
            $controller = $this->getController();
            $obj = new $controller();
            
            $metodo = $this->getMethod();
            $obj->$metodo();
        }
    }

    public function getController() {
        return $this->setController();
    }

    public function setController() {
        return $this->controller = filter_input(INPUT_GET, 'controller', FILTER_DEFAULT);
    }

    public function getMethod() {
        return $this->setMethod();
    }

    public function setMethod() {
        return $this->method = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
    }

}
