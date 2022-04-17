<?php

/* Задание №8 */

class Text 
{
    private $title;                 /* Заголовок текста */
    private $text;                  /* Текст */
    private $author;                /* Имя автора */
    private $published;             /* Дата */
    public  $slug;                   /* Имя для файла */

     public function __construct($author, $slug)
     {
          $this->author = $author;
          $this->slug = $slug;
          $this->published = date( "d-m-Y H:m");
     }    

     public function storeText($title, $text)
     {    
          $data = ["title" => $title, "text" => $text, "author" => $this->author, "published" => $this->published];
          file_put_contents($this->slug, serialize($data));
          // print_r($data);
     }

     public function loadText()
     {
          if(filesize($this->slug)) {
               $data = unserialize(file_get_contents($this->slug));
               $this->title = $data["title"];
               $this->text = $data["text"];
               $this->author = $data["author"];
               $this->published = $data["published"];
          }
     }

     public function editText ($title, $text) 
     {
          $this->title = $title;
          $this->text = $text;
     }
}

$slug = "file.txt";
$text = new Text("Есенин", $slug);
$text->storeText("Hello", "Hello my friend",);
$text->loadText();

// /* Задание №9 */

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

abstract class User implements EventListenerInterface
{
    public $id;
    public $name;
    public $role;

    abstract function getTextsToEdit();
    abstract function attachEvent ($method);
    abstract function detouchEvent ($method);
}

class FileStorage extends Storage 
{
    public function create($text)
    {
        $i = 1;
        $fileName = $text->slug ."_". date("d.m.Y H:m");
        while(file_exists($fileName)) {       
            $fileName = $text->slug ."_". date("d.m.Y") . '_' . $i;
            $i++;
        }
        $text->slug = $fileName;
        file_put_contents($fileName, serialize($text));
        return $fileName;
    }

    public function read($slug)
    { 
        return unserialize(file_get_contents($slug));      
    }

    public function update($slug)
    {
        if (scandir($slug)) {
            $slug = unserialize(file_get_contents($slug));
        }
    }

    public function delete($slug)
    {
        if (file_exists($slug)) {
            unlink($slug);
        }
    }

    public function list($file)
    {
        $texts = [];
        $files = scandir($file);
        foreach ($files as $file) {
            $data = file_get_contents($files);
            $texts[] = unserialize(file_get_contents($data));
        }
        return $texts;
    }

    public function lastMessages($num)
    {
        return $num;
    }

    public function logMessage($stringError)
    {
        $this->logs[] = $stringError;
        // print_r($this->logs);
        file_put_contents($this->slug, serialize($this->logs));
    }

    public function attachEvent ($method)
    {
        call_user_func("method");
    }

    public function detouchEvent ($method)
    {
        call_user_func("method");

    }
    
}

$fileStorage = new FileStorage();
$fileStorage->create($text);

/* Задание №10 */

interface LoggerInterface 
{
    public function logMessage($stringError);
    public function lastMessages($num);
}

class Log implements LoggerInterface
{
    private $slug = "Logs.txt";
    private $logs = [];

    public function logMessage($stringError)
    {
        $this->logs[] = $stringError;
        // print_r($this->logs);
        file_put_contents($this->slug, serialize($this->logs));
    }

    public function lastMessages($num)
    {
        if (file_exists($this->slug)) {
            $logs = unserialize(file_get_contents($this->slug));
            print_r(array_slice($logs, -$num));
        }
    }
}

interface EventListenerInterface
{
   public function attachEvent ($method);
   public function detouchEvent ($method);
}

$log = new Log();
$log->logMessage("Привет");
$log->logMessage("Hello");
$log->logMessage("Mир");
$log->logMessage("World");
$log->lastMessages(2);
