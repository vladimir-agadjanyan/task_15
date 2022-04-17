<?php 

    function autoload($className)
    {
        spl_autoload_register('./entities/'. $className. ".php");
    }

    autoload(class Text);