<?php

require_once(__DIR__ . "/../controllers/HomeController.php");
require_once(__DIR__ . "/../controllers/NotFoundController.php");
require_once(__DIR__ . "/../controllers/FilmController.php");
require_once(__DIR__ . "/../controllers/UserController.php");


class Router
{
    public static function getController(string $controllerName)
    {
        switch ($controllerName) {

            // Route : /
            case '':
                return new HomeController();
                break;

            case 'film':
                return new FilmController();
                break;
                
                case 'user':
                return new UserController();
                break;

            default:
                // 404
                return new NotFoundController();
                break;
        }
    }
}
