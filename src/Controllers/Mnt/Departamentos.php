<?php
namespace Controllers\Mnt;

use Controllers\PrivateController;
use Views\Renderer;

class Departamentos extends PrivateController {
    public function run() :void
    {
        $viewData = array(
            "departamentos_view"=>$this->isFeatureAutorized('mnt_departamentos_view'),
            "departamentos_edit"=>$this->isFeatureAutorized('mnt_departamentos_edit'),
            "departamentos_delete"=>$this->isFeatureAutorized('mnt_departamentos_delete'),
            "departamentos_new"=>$this->isFeatureAutorized('mnt_departamentos_new')

        );
        $viewData["departamentos"] = \Dao\Mnt\Departamentos::findAll();
        Renderer::render('mnt/departamentos', $viewData);
    }
}
?>