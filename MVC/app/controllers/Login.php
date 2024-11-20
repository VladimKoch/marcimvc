<?php

namespace Controller;

use \Model\User as User;
use \Core\Request as Request;
use \Core\Session as Session;


defined('ROOTPATH') or exit('No direct script acces allowed');

class Login
{
    
    Use MainController;



        public function index()
            {   
                $req = new Request;
                $data['user'] = new User;
                if($req->posted())
                {
                    if($data['user']->logIn($_POST)===true)
                    {   
                        
                        $this->view('home',$data);
                    }
                    else
                    {
                        $data['errors'] = $data['user'] -> errors;
                    };
                    
                    // show($data);
                    // die;
                }

                $data['errors'] = $data['user'] ->  errors;
                // show($data);
                // die;
                $this->view('login',$data);
            }
    
}

