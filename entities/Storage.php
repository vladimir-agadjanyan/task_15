<?php 

include_once "./interfaces/EventIntterface.php";
include_once "./interfaces/LogInterface.php";

abstract class Storage implements LoggerInterface, EventListenerInterface
{
    public $dataBase = [];                        /* Массив для хранения */
    public $id;                                   /* id */
    public $publication;                          /* Дата */
    public $slug;                                 /* Файл для хранения */

    abstract function create(Text $text);
    abstract function read($slug);
    abstract function update($slug);
    abstract function delete($file);
    abstract function list($dataBase);
    abstract function logMessage($stringError);
    abstract function lastMessages($num);
    abstract function attachEvent ($method);
    abstract function detouchEvent ($method);

}