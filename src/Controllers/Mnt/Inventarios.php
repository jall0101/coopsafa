<?php
namespace Controllers\Mnt;
use Controllers\PrivateController;
use Views\Renderer;

class Inventarios extends PrivateController {
    public function run() :void
    {
        $viewData = array(
            "inventarios_view"=>$this->isFeatureAutorized('mnt_inventarios_view'),
            "inventarios_edit"=>$this->isFeatureAutorized('mnt_inventarios_edit'),
            "inventarios_delete"=>$this->isFeatureAutorized('mnt_inventarios_delete'),
            "inventarios_new"=>$this->isFeatureAutorized('mnt_inventarios_new')
        );
        $viewData["inventarios"] = \Dao\Mnt\Inventarios::findAll();
        Renderer::render('mnt/inventarios', $viewData);
    }
}
?>