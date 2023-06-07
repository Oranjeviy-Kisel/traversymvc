<?php
    //Loading Config
    require_once 'config/config.php';

    //Loading libraries
    // require_once('libraries/Core.php');
    // require_once('libraries/Controller.php');
    // require_once('libraries/database.php');

    // Autoload
    spl_autoload_register(function($className){
        require_once('libraries/' . $className . '.php');
    })
?>