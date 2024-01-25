<?php
namespace Controllers\Mnt;
use Controllers\PrivateController;
use Views\Renderer;

class Entradassalidas extends PrivateController {
    public function run() :void
    {
        $viewData = array(
            "entradassalidas_view"=>$this->isFeatureAutorized('mnt_entradassalidas_view'),
            "entradassalidas_edit"=>$this->isFeatureAutorized('mnt_entradassalidas_edit'),
            "entradassalidas_delete"=>$this->isFeatureAutorized('mnt_entradassalidas_delete'),
            "entradassalidas_new"=>$this->isFeatureAutorized('mnt_entradassalidas_new')
        );
        $viewData["entradassalidas"] = \Dao\Mnt\Entradassalidas::findAll();
        Renderer::render('mnt/entradassalidas', $viewData);
    }
}
?>