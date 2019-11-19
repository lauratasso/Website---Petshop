<?php
function __autoload($class){
    if(file_exists('lib/' . $class . '.php'))
        require_once 'lib/' . $class . '.php';
}
class ApplicationController {
    private $controller;
    private $action;

    public function dispatch(){
        $this->loadRoute();
        $controllerFile = $this->controller . 'Controller';
        if ( file_exists($controllerFile) )
            require_once $controllerFile;
        else
            throw new Exception ("Arquivo: '$controllerFile' não encontrado");

        $classController = $this->controller . 'Controller';
        if ( class_exists($classController) )
            $instance = new $classController;
        else
            throw new Exception("Classe: '$classController' não encontrado");
        
        $method = $action . 'Action';
        if ( method_exists($method) )
            $instance->$method();
        else
            throw new Exception("Metodo '$method' não encontrado")
    }

    private function loadRoute(){
        $controller = isset($_REQUEST['controller']) ? $_REQUEST['controller'] : 'Index';
        $action     = isset($_REQUEST['acao']) ? $_REQUEST['acao'] : 'index'; 
    }

    public static function redirect( $uri ){
        header('Location: $uri');
    }

?> 