<?php 

    function loadClass($classname)
    {
        if(file_exists("./entities/". $classname. ".php")){
            require_once "./entities/". $classname. ".php";
        }
    }

    spl_autoload_register("loadClass");

    $test = new FileStorage();



    