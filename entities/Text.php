<?php 

class Text 
{
    private $title;                 /* Заголовок текста */
    private $text;                  /* Текст */
    private $author;                /* Имя автора */
    private $published;             /* Дата */
    private $slug;                  /* Имя для файла */

     public function __construct($author, $slug)
     {
          $this->author = $author;
          $this->slug = $slug;
          $this->published = date("d.m.Y");
     }    

     private function storeText($title, $text)
     {    
          $data = ["title" => $title, "text" => $text, "author" => $this->author, "published" => $this->published];
          file_put_contents($this->slug, serialize($data));
     }

     private function loadText()
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
    
     //  =====  Сеттеры и геттеры  ===========

     public function setAuthor(string $string)
     {
        if(strlen($this->string) > 120) {
            echo "Кооличество символов превышает положенные 120 символов";
        } else {
            $this->author = $string;
        }
     }

     public function getAuthor()
     {
        $this->author;
     }

     public function setSlug($name)
     {
        if (!preg_match('/[0-9A-Za-z—_\/\.]+/', $this->name)) {
            echo "Не коректно введенно название";
         } else {
            $this->slug = $name;
         } 
     }

     public function getSlug()
     {
        $this->slug;
     }

     public function setDate($date)
     {
        if($this->date > date('d.m.Y')) {
            echo "Не верно указанна дата";
         } else {
            $this->published = $date;
        }
     }

     public function getDate()
     {
        $this->published;
     }

     public function __set($name, $value)
     {
        if ($name == "name") {
            $this->storeText($this->title, $this->text);
        }
     }

     public function __get($name) 
     {
        if ($name == "slug") {
            $this->loadText();
        }
     }

}