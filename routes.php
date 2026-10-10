<?php

$url = $_GET['url'] ?? 'auth/login';
$url = explode('/',$url);
$controllerName = ucfirst($url[0]).'Controller';
$method = $url[1];
 require_once 'app/controllers/'.$controllerName.'.php';
    if(isset($_GET["id"])){
        $method=$url[1]."Id";
    }
$controller = new $controllerName;

$controller->$method(); 