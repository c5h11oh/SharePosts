<?php
    //Load Config
    require_once 'config/config.php';
    
    //Load Libraries (No need anymore because the autoload below)
    // require_once 'libraries/Controller.php';
    // require_once 'libraries/Core.php';
    // require_once 'libraries/Database.php';

    //Autoload Core Libraries
    spl_autoload_register(function($className){
        //Libraries中檔案名稱須和其所包含的Class名稱相同
        require_once 'libraries/' . $className . '.php';    
    });