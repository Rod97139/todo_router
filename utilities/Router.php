<?php

require_once 'src/controllers/UserController.php';
require_once 'src/controllers/TaskController.php';

class Router
{
    private static array $routes = [];

    /**
     * permet d'enregistrer les routes exécutables sur l'application
     * @param string $request
     * @param string $action
     * @return void
     */
    public static function register(string $request, string $action) : void
    {
        self::$routes[$request] = $action;

    }

    /**
     *  vérifier et exécuter la demande de l'utilisateur
     * @param string $request_uri
     * @return void
     * @throws Exception si la page n'existe pas
     */
    public static function resolve(string $request_uri) : void
    {
        $request_uri = explode("?", $request_uri)[0];

        if (!isset(self::$routes[$request_uri])){
            throw new Exception("404 Page not found");
        }

        [$controller_name , $action_name] = explode('::', self::$routes[$request_uri]);


        $instance = new $controller_name();
        $instance->$action_name();
    }
}