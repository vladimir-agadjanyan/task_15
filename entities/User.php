<?php 

require_once "./interfaces/EventIntterface.php";

abstract class User implements EventListenerInterface
{
    public $id;
    public $name;
    public $role;

    abstract function getTextsToEdit();
    abstract function attachEvent ($method);
    abstract function detouchEvent ($method);
}

