<?php
namespace Controllers\Mnt;

use Controllers\PrivateController;
use Controllers\PublicController;
use Views\Renderer;

class FuncionesRoles extends PrivateController {
    public function run() :void
    {
        $viewData = array(
            "funcionesroles_view"=>$this->isFeatureAutorized('mnt_funcionesroles_view'),
            "funcionesroles_edit"=>$this->isFeatureAutorized('mnt_funcionesroles_edit'),
            "funcionesroles_delete"=>$this->isFeatureAutorized('mnt_funcionesroles_delete'),
            "funcionesroles_new"=>$this->isFeatureAutorized('mnt_funcionesroles_new')
        );
        $viewData["funcionesroles"] = \Dao\Mnt\FuncionesRoles::findAll();
        Renderer::render('mnt/funcionesroles', $viewData);
    }
}
?>