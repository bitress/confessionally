<?php

include_once 'Configuration.php';

spl_autoload_register(function ($class) {

    $file = __DIR__. '/../E/'. $class .'.php';

    if(file_exists($file)){
        include_once $file;
    }

});

    Session::start();

    $login = new Login();
