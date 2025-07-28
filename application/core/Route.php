<?php
class Route
{
    public static function start()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
        if ($scriptDir !== '' && strpos($uri, $scriptDir) === 0) {
            $uri = substr($uri, strlen($scriptDir));
        }
        $uri = trim($uri, '/');
        if ($uri === '') {
            $uri = 'about'; // default page
        }

        $name = ucfirst($uri);
        $controllerName = $name . 'Controller';

        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            $controller->action($uri);
            return;
        }

        $viewPath = __DIR__ . '/../views/' . $uri . '.twig';
        if (file_exists($viewPath)) {
            $view = new View();
            $view->render($uri);
            return;
        }
        
        $controller = new NotFoundController();
        $controller->action('404');
    }
}