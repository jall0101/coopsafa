<?php

namespace Controllers\clientView;

use Controllers\PublicController;
use Views\Renderer;


class Login extends PublicController {
   
    public function run() :void
    {
        $viewData = array();        
        Renderer::render('Admin/login', $viewData);
    }
}
?>