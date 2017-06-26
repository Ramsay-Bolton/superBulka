<?php

/*class Router {
    private $routes;
    
    public function __construct() {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath); //подключение файла с маршрутами
    }
    
    private function getURI() {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
            
    
}
*/

print_r(trim($_SERVER['REQUEST_URI'], 'php'));
