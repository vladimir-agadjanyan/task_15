<?php 

    function loadClass($classname)
    {
        include "FileStorage.php";
        include "Storage.php";
        include "Text.php";
        include "User.php";
        include "View.php";
    }

    spl_autoload_register("loadClass");

    $test = new FileStorage();



    