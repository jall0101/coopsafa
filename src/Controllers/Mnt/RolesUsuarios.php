<?php
namespace Controllers\Mnt;

use Controllers\PrivateController;
use Views\Renderer;

class RolesUsuarios extends PrivateController {
    public function run() :void
    {
        $viewData = array(
            "rolesUsuarios_view"=>$this->isFeatureAutorized('mnt_rolesUsuarios_view'),
            "rolesUsuarios_edit"=>$this->isFeatureAutorized('mnt_rolesUsuarios_edit'),
            "rolesUsuarios_new"=>$this->isFeatureAutorized('mnt_rolesUsuarios_new'),
            "rolesUsuarios_delete"=>$this->isFeatureAutorized('mnt_rolesUsuarios_delete')
        );
        $viewData["roles_usuarios"] = \Dao\Mnt\RolesUsuarios::findAll();
        Renderer::render('mnt/rolesUsuarios', $viewData);
    }
}
?>