<?php 

require_once "D://Skillbox/task 13/project/interfaces/eventIntterface.php";

abstract class User implements EventListenerInterface
{
    public $id;
    public $name;
    public $role;

    abstract function getTextsToEdit();
    abstract function attachEvent ($method);
    abstract function detouchEvent ($method);
}

