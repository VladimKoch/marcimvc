<?php 

namespace Controller;

defined('ROOTPATH') or exit('No direct script acces allowed');
class _404
{
    use MainController;

        public function index()
            {
                $this->view('404');
            }
    
 
}