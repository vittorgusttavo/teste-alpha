<?php

use app\util\classes\Engine;
use app\util\classes\Router;

/**
 * Define a URI
 */
function path(){
    return $_SERVER["REQUEST_URI"];
}

/**
 * Define a Requisição
 */
function request(){
    return $_SERVER["REQUEST_METHOD"];
}

/**
 * Monta e valida as rotas.
 */
function routerExecute(){
    try{
        $routes = require 'app/routes/routes.php';
        $router = new Router();
        $router->execute($routes);
    }catch(Exception $ex){
        var_dump($ex->getMessage());
    }
}

function view($view, $data = []){
    try{
        $engine = new Engine();
        echo $engine->render($view, $data);
    }catch(Exception $ex){
        var_dump($ex->getMessage());
    }
}

function redirect($to){
    return header('Location: ' . $to);
}

function encrypt($value){
    $algoritmo = "AES-256-CBC";
    $chave = "minha_chave";
    $iv = "vNYtCnelXfOa6uiP";

    
    
    return base64_encode(openssl_encrypt($value, $algoritmo, $chave, OPENSSL_RAW_DATA, $iv));;
}

function descrypt($value){
    $algoritmo = "AES-256-CBC";
    $chave = "minha_chave";
    $iv = "vNYtCnelXfOa6uiP";

    return base64_decode(openssl_encrypt($value, $algoritmo, $chave, OPENSSL_RAW_DATA, $iv));
}