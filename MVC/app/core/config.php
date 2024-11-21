<?php

// namespace Core;


defined('ROOTPATH') or exit('No direct script acces allowed');

if((empty($_SERVER['SERVER_NAME']) && php_sapi_name() == 'cli') || (!empty($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == 'localhost'))
    {   
        
        // database config //
        define ('DBNAME','msucto');
        define ('DBHOST','localhost');
        define ('DBUSER','root');
        define ('DBPASS','');
        define ('DBDRIVER','');

        define ('ROOT','http://localhost/marcimvc/MVC/public');
    }
    else
    {   // database config //
        define ('DBNAME','msucto');
        define ('DBHOST','localhost');
        define ('DBUSER','root');
        define ('DBPASS','');
        define ('DBDRIVER','');

        define ('ROOT','https://www.yourwebsite.com');
    }


define('APP_NAME', "MY website" );
define('APP_DESC', "MY cool web is the best website" );

// true means show errors //
define('DEBUG',true);
