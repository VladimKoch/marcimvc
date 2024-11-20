<?php

/**
 * Logout class
 */

namespace Controller;

use \Model\Functions as Functions;
use \Core\Session as Session;

defined('ROOTPATH') or exit('No direct script acces allowed');


class Logout
{
    
    
        public function index()
        {   
            $ses = new Session;
            $ses->logout();

            redirect('land');
            
        }
    

}
