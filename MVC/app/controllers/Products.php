<?php

namespace Controller;
use \Model\Image as Image;

defined('ROOTPATH') or exit('No direct script acces allowed');

class Products
{
    use MainController;
    
        public function index()
            { 
                $file = 'Tyr.jpg';
                
                $image = new Image;
                $data['file'] = $file;
                $data['thumbnail'] = $image->getThumbnail($file,1000,1000);

            $this->view('products',$data);
            }
    
 
}
