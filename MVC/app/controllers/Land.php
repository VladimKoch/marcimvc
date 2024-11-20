<?php

namespace Controller;

use \Model\Functions as Functions;
use \Model\User as User;
use \Core\Session;
use \Model\Image as Image;
// use \Model\Model as Model;


defined('ROOTPATH') or exit('No direct script acces allowed');


/**
 * Home class
 */

class Land
{
    use MainController;
    
    public function index()
            {   
                
                $file = 'Tyr.jpg';    
                $ses = new Session;
                
                if($ses->is_logged_in())
                {
                    $data['user'] = $_SESSION['USER'];
                }
                
                
                $data['user'] = $file;
              
                $this->view('land',$data);
            }
    

}
