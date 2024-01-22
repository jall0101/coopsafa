<?php
namespace Controllers\Mnt;

use Controllers\PrivateController;
use Views\Renderer;

class Asignados extends PrivateController {
    public function run() :void
    {
        $viewData = array(
            "asignados_view"=>$this->isFeatureAutorized('mnt_asignados_view'),
            "asignados_edit"=>$this->isFeatureAutorized('mnt_asignados_edit'),
            "asignados_delete"=>$this->isFeatureAutorized('mnt_asignados_delete'),
            "asignados_new"=>$this->isFeatureAutorized('mnt_asignados_new')

        );
        $viewData["asignados"] = \Dao\Mnt\Asignados::findAll();
        Renderer::render('mnt/asignados', $viewData);
    }
}
?>