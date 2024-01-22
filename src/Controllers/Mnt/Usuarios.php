<?php
namespace Controllers\Mnt;

use Controllers\PrivateController;
use Views\Renderer;

class Usuarios extends PrivateController {
    public function run() :void
    {
        $viewData = array(
            "usuarios_view"=>$this->isFeatureAutorized('mnt_usuarios_view'),
            "usuarios_edit"=>$this->isFeatureAutorized('mnt_usuarios_edit'),
            "usuarios_delete"=>$this->isFeatureAutorized('mnt_usuarios_delete'),
            "usuarios_new"=>$this->isFeatureAutorized('mnt_usuarios_new')
        );
        $viewData["usuarios"] = \Dao\Mnt\Usuarios::findAll();
        Renderer::render('mnt/usuarios', $viewData);
    }
}
?>