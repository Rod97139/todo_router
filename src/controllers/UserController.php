<?php
require_once 'utilities/Controller.php';

class UserController extends Controller
{

    public function login()
    {
        echo "ceci est la méthode login";
    }

    public function register()
    {
        echo "ceci est la méthode register";
    }


    public function logout()
    {
        echo "ceci est la méthode ".__FUNCTION__;
    }
}