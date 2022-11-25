<?php


const BASE_DIR = '/to_do_poo';


require_once 'config/routes.php';

$request_uri = str_replace(BASE_DIR, '', $_SERVER['REQUEST_URI']);

try {
    Router::resolve($request_uri);
}catch (Exception $e)
{
    echo $e->getMessage();
}