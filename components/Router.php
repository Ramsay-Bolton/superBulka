<?php

class Router {
    private $routes;
    
    public function __construct() {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath); //подключение файла с маршрутами
    }
    
    private function getURI() { //возвращает часть запроса из адресной строки
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/'); //удаляет слэши с концов
        }
    }
    
    public function run() {
        // получить строку запроса
        $uri = $this->getURI();
        
        //Проверить наличие такого запроса в созданных маршрутах routes.php
        foreach ($this->routes as $uriPattern => $path) {
            
            //сравниваем $uriPattern и $uri
            if (preg_match("~$uriPattern~", $uri)) {
                
                //Получаем внутренний маршрут из внешнего
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                
                //Определяем контроллер, метод, параметры
                
                $segments = explode('/', $internalRoute);
                
                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);
                
                $actionName = 'action'.ucfirst(array_shift($segments));
                
                $parametres = $segments;
                
                //Подключаем файл класса контроллера, чтобы создать его объект
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
                
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }
                
                $controllerObject = new $controllerName;
                
                $result = call_user_func_array(array($controllerObject, $actionName), 
                        $parametres);
                
                //Если на данной итерации был создан объект и 
                //вызван соответствующий ему метод
                //прерываем весь цикл на проверку соотвествия заданного паттерна
                if ($result != null) {
                    break;
                }
            }
        }
    }
}