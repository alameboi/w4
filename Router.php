<?php

class Router {
    public static function run() {
        $routes = include(ROOT . '/router/routes.php');
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $pageExists = false;
        $actionArgs = [];

        foreach ($routes as $uriPattern => $path) {
            if (explode('/', $uriPattern)[1] == explode('/', $uri)[1]) {
                $route = preg_replace("~$uriPattern~", $path, $uri);
                $uriSegments = explode('/', $route);
                
                $controllerName = ucfirst($uriSegments[0]) . 'Controller';
                $actionName = 'action' . ucfirst($uriSegments[1]);
                if (count($uriSegments) > 2)
                    $actionArgs = array_slice($uriSegments, 2, count($uriSegments) - 2);
                
                try {
                    $contrfac = new ControllerFactory($controllerName);
                    $contr = $contrfac->create();

                    if (count($actionArgs) > 0)
                        $response = $contr->$actionName($actionArgs); 
                    else
                        $response = $contr->$actionName(); 
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                
                $pageExists = true;
            }
        }

        if ($pageExists == false) {
            $response = new Response('View', '', '', new View());
        }

        if ($response->getResponse()) 
            print($response->getResponse()->getPageContent());
    }
}