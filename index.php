<?php
define('ROOT', __DIR__ . DIRECTORY_SEPARATOR);
session_start();

if (isset($_GET['action']) && !empty($_GET['action'])) {
    $params = explode("/", $_GET['action']);

    if ($params[0] != "") {
        $controller = ucfirst($params[0]);
        $action = isset($params[1]) ? $params[1] : 'index';
        $controllerFile = ROOT . 'controllers/' . $controller . 'Controller.php';

        if (file_exists($controllerFile)) {
            require_once($controllerFile);

            $controllerClass = $controller . 'Controller';
            if (class_exists($controllerClass)) {
                $controllerInstance = new $controllerClass();

                if (method_exists($controllerInstance, $action)) {
                    if (isset($params[2]) && isset($params[3])) {
                        $controllerInstance->$action($params[2], $params[3]);
                    } elseif (isset($params[2])) {
                        $controllerInstance->$action($params[2]);
                    } else {
                        $controllerInstance->$action();
                    }
                } else {
                    header('HTTP/1.0 404 Not Found');
                    require_once('views/errors/404.php');
                }
            } else {
                header('HTTP/1.0 404 Not Found');
                require_once('views/errors/404.php');
            }
        } else {
            header('HTTP/1.0 404 Not Found');
            require_once('views/errors/404.php');
        }
    }
} else {
    require_once('controllers/HomeController.php');

    if (class_exists('HomeController')) {
        $homeController = new HomeController();
        $homeController->index();
    } else {
        header('HTTP/1.0 404 Not Found');
        require_once('views/errors/404.php');
    }
}
