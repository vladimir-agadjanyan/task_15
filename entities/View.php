<?php 

require_once "./Storage.php";

abstract class View 
{
    public $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    abstract public function displayTextById($id);

    abstract public function displayTextByUrl($url);

}