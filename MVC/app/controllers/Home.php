<?php

namespace Controller;

use Model\User as User;
use \Core\Session as Session;
/**
 * Land class
 */

class Home
{
    use MainController;

    public function index()
    {   
        $data=[];
        $ses = new Session;
        if($ses->is_logged_in())
        {
            $data['user'] = $_SESSION['USER'];
        }
      
       
        if($_SERVER['REQUEST_METHOD'] === 'POST')
            if(!empty($_POST))
            {

                $userResponses = new User;
                if($userResponses->validateResponses($_POST))
                {
                    $userResponses->insertResponses($_POST);
    
                    $data['answer'] = "Vaše údaje byly zaznamenány ozvu se vám hned jakmile to bude možné ";
                }
                $data['errors'] = $userResponses->errors;
                
            }
          

        $this->view('home',$data);
    }
    

}