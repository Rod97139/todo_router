<?php

require_once 'src/models/Task.php';
require_once 'utilities/Controller.php';

class TaskController extends Controller
{
    /**
     * afficher la liste des tâches
     * @return void
     */
    public function index() :void
    {
        $task = new Task();

        $tasks = $task->findAllBy(['id_user' => 1]);
        $message = 'hello';

        $this->renderView('task/index', compact('tasks', 'message'));
    }

    public function insert()
    {

        if (isset($_POST['submit'])){


            $task = new Task();
            $task->setIdUser(1);
            $task->setName(htmlentities($_POST['name']));
            $task->setToDoAt(new DateTimeImmutable($_POST['to_do_at']));

            $result = $task->insert();

            if ($result ){
                $message =  "insertion bien effectuée";
            }else {
                $message =  "échec";
            }
            $this->renderView('task/insert', [
                'message' => $message
            ]);

        }
        $this->renderView('task/insert');
    }

    public function delete()
    {

        echo "Task controller ".__FUNCTION__;
    }

    public function edit()
    {
        echo "Task controller ".__FUNCTION__;
    }
}