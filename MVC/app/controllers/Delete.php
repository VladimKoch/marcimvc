<?php

namespace Controller;

use \Model\User as User;
use \Core\Request as Request;
use \Core\Session as Session;


defined('ROOTPATH') or exit('No direct script acces allowed');

class Delete
{
    
    Use MainController;



        public function index()
            {    
                $data= [];
                $data['user'] = new User;
                $req = new Request;
                
                if($req->posted())
                {
                    
                    if($data['user']->deleteUser($_POST)===true)
                    {   
                        // $data['user']->answers['delete'];
                        cookie('flash_message','Váš účet byl úspěšně smazán',60);
                        $data['delete'] = $_COOKIE['flash_message'];
                        // show($data);
                        // die;
                        $this->view('home',$data);
                        redirect('home');
                    

                    }
                    else
                    {
                        $data['errors'] = $data['user']->errors;
                       
                    };
                }
                 
                    
                    $data['errors'] = $data['user']->errors;
                    $this->view('delete',$data);
    
            }
                
                
}