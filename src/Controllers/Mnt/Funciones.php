<?php
namespace Controllers\Mnt;

use Controllers\PrivateController;
use Views\Renderer;

class Funciones extends PrivateController {
    public function run() :void
    {
        $viewData = array(
            "funciones_view"=>$this->isFeatureAutorized('mnt_funciones_view'),
            "funciones_edit"=>$this->isFeatureAutorized('mnt_funciones_edit'),
            "funciones_delete"=>$this->isFeatureAutorized('mnt_funciones_delete'),
            "funciones_new"=>$this->isFeatureAutorized('mnt_funciones_new')
        );
        $viewData["funciones"] = \Dao\Mnt\Funciones::findAll();
        Renderer::render('mnt/funciones', $viewData);
    }
}
?>