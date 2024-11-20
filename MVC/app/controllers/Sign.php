<?php

namespace Controller;

use \Model\User as User; 
use \Controller\MainController as MainController;
use \Core\Request as Request;
use \Model\Model as Model;

defined('ROOTPATH') or exit('No direct script acces allowed'); 

class Sign
{
    use MainController;
    use Model;
    
        public function index()
            {   
               
                $data['user'] = new User;
                $req = new Request;
             
                if($req->posted())
                    {  


                        $data['user']->signUp($_POST);
                        $data['errors'] = $data['user'] -> errors;

                    }

                $this->view('sign',$data);
                
                
            }

}