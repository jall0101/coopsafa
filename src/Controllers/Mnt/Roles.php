<?php
namespace Controllers\Mnt;

use Controllers\PrivateController;
use Views\Renderer;

class Roles extends PrivateController {
    public function run() :void
    {
        $viewData = array(
            "roles_view"=>$this->isFeatureAutorized('mnt_roles_view'),
            "roles_edit"=>$this->isFeatureAutorized('mnt_roles_edit'),
            "roles_delete"=>$this->isFeatureAutorized('mnt_roles_delete'),
            "roles_new"=>$this->isFeatureAutorized('mnt_roles_new')
        );
        $viewData["roles"] = \Dao\Mnt\Roles::findAll();
        Renderer::render('mnt/roles', $viewData);
    }
}
?>