<?php




defined('ROOTPATH') or exit('No direct script acces allowed');


    
    spl_autoload_register(function($classname){
    
        $classname = explode("\\", $classname);
        $classname = end($classname);
        require $filename = "../app/models/".ucfirst($classname).".php";
    });
    
    require 'config.php';
    require 'functions.php';
    require 'Database.php';
    require 'Model.php';
    require 'ModelResponses.php';
    require 'MainController.php';
    require 'App.php';

