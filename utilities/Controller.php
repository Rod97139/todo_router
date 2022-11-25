<?php

abstract class Controller
{

    public function renderView(string $view_name, array $params = []) : void
    {

        // accès à une variable qui s'appelle $tasks
        /*if(!empty($params))
        {
            foreach ($params as $key => $value)
            {
                $$key = $value;
            }
        }*/

        extract($params);
        ob_start() ;
        require_once "src/views/$view_name.php";
        $content = ob_get_clean();
        require_once 'src/views/layout.php';
    }
}