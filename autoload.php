<?php 

    function autoload($className)
    {
        spl_autoload_register('./entities/'. $className. ".php");
    }

    autoload(class Text);
    autoload(class FileStorage);
    autoload(class Storage);
    autoload(class User);
    autoload(class Text);
    autoload(class View);