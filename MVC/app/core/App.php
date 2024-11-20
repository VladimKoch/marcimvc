<?php

namespace Core;


defined('ROOTPATH') or exit('No direct script acces allowed');
class App
{
    private $controller = 'Home';
    private $method = 'index';

/** Split URL Function **/
private function splitURL()
    {
        $URL = $_GET['url'] ?? 'Home';
        $URL = explode("/",trim($URL,"/"));
        return $URL;
    }

/** Load Function to initate class **/
public function loadController()
    {
        $URL = $this->splitURL(); 

        // Select controller //
        $filename = "../app/controllers/".ucfirst($URL[0]).".php";
        if(file_exists($filename))
            {
                require $filename;
                $this->controller = ucfirst($URL[0]);
                unset($URL[0]);
            } 
            else
            {     
                $filename = "../app/controllers/_404.php";
                require $filename;
                $this->controller = '_404';
            }


        $controller = new ('\Controller\\'. $this->controller);

        // Select Method //
        if(!empty($URL[1]))
            {
                if(method_exists($controller,$URL[1]))
                {
                    $this->method = $URL[1];
                    unset($URL[1]);
                }
            }

        $controller = new ('\Controller\\'. $this->controller);
        call_user_func_array([$controller,$this->method],$URL);
    }
}

