<?php
namespace Controllers\Mnt;
use Controllers\PrivateController;
use Views\Renderer;

class Zapatos extends PrivateController {
    public function run() :void
    {
        $viewData = array(
            "zapatos_view"=>$this->isFeatureAutorized('mnt_zapatos_view'),
            "zapatos_edit"=>$this->isFeatureAutorized('mnt_zapatos_edit'),
            "zapatos_delete"=>$this->isFeatureAutorized('mnt_zapatos_delete'),
            "zapatos_new"=>$this->isFeatureAutorized('mnt_zapatos_new')
        );
        $viewData["zapatos"] = \Dao\Mnt\Zapatos::findAll();
        Renderer::render('mnt/zapatos', $viewData);
    }
}
?>