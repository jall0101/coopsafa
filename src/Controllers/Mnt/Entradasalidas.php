<?php
namespace Controllers\Mnt;
use Controllers\PrivateController;
use Views\Renderer;

class Entradasalidas extends PrivateController {
    public function run() :void
    {
        $viewData = array(
            "entradasalidas_view"=>$this->isFeatureAutorized('mnt_entradasalidas_view'),
            "entradasalidas_edit"=>$this->isFeatureAutorized('mnt_entradasalidas_edit'),
            "entradasalidas_delete"=>$this->isFeatureAutorized('mnt_entradasalidas_delete'),
            "entradasalidas_new"=>$this->isFeatureAutorized('mnt_entradasalidas_new')
        );
        $viewData["entradasalidas"] = \Dao\Mnt\Entradasalidas::findAll();
        Renderer::render('mnt/entradasalidas', $viewData);
    }
}
?>