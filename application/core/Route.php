<?php
class Route
{
    public static function start()
    {
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        if ($uri === '') {
            $uri = 'about'; // default page
        }

        $name = ucfirst($uri);
        $controllerName = $name . 'Controller';

        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            $controller->action($uri);
        } else {
            // No specific controller, just render view
            $view = new View();
            $view->render($uri);
        }
    }
}