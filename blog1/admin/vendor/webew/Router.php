<?php

class router
{
    private $routes;
    private $controllerName;
    private $methodName;

    public function __construct()
    {
        $this->routes = include ADMIN_PATH . "/routing/router.php";
    }

    public function isValidRoute(string $action){
        return array_key_exists($action, $this->routes);
    }

    public function callMethodController($action){
        $this->controllerName = $this->routes[$action]["controller"];
        $this->methodName = $this->routes[$action]["method"];
        $controllerFile = 'controller/' . $this->controllerName . ".php";
        require_once $controllerFile ;
        $controller = new $this->controllerName();
        $method = $this->methodName;
        if (method_exists( $controller, $this->methodName)) {
            $controller->$method();
        }
    }

    /**
     * @return mixed
     */
    public function getRoutes()
    {
        return $this->routes;
    }

}