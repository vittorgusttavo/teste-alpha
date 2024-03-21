<?php

namespace app\util\classes;

use Exception;

class Router{

    private string $path;
    private string $request;

    /**
     * Valida a rota
     */
    private function routerFound($routes){
        if(!isset($routes[$this->request]))
            throw new Exception("Route {$this->path} does not exist");
        
        
        if(!isset($routes[$this->request][$this->path]))
            throw new Exception("Path {$this->path} does not exist");
        
    }

    /**
     * Valida os controllers e action
     */
    private function controllerFound($controllerPathName, $controller, $action){
        if(!class_exists($controllerPathName))
            throw new Exception("Controller {$controller} não existe");

        if(!method_exists($controllerPathName, $action))
            throw new Exception("Ação {$action} não existe");
    }

    public function execute($routes){
        $this->path = path();
        $this->request = request();

        //Trata os GET
        if(str_contains($this->path, '?')){
            $this->path = substr($this->path, 0, strpos($this->path, "?"));
        }
        
        $this->routerFound($routes);

        //  Busca pelo Controlador e a Action
        list($controller, $action) = explode('@', $routes[$this->request][$this->path]);

        $controllerPathName = "app\\controllers\\{$controller}";

        $this->controllerFound($controllerPathName, $controller, $action);

        $constrollerInstance = new $controllerPathName();
        $constrollerInstance->$action();
        #var_dump($action);
    }

}