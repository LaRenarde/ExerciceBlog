<?php
session_start();
require_once '../config/config.php';
require_once '../config/configBdd.php';
require_once 'classes/Bdd.php';
require_once 'vendor/webew/Router.php';

if(!isset($_SESSION["user"]["id"])){
    if(isset($_POST["formconnexion"])){
        $action = "login";
    }else{
        $action = "connexion";
    }
}else{
    $action = "accueil";
    if(isset($_GET["p"])){
        $action = $_GET["p"] ;
    }
}

$router = new Router();
if($router->isValidRoute($action)){
    $router->callMethodController($action);
}
