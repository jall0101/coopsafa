<?php


//FILIALES
namespace Controllers\Mnt;

use Controllers\PrivateController;
use Views\Renderer;

class Filiales extends PrivateController {
    public function run() :void
    {
        $viewData = array(
            "filiales_view"=>$this->isFeatureAutorized('mnt_filiales_view'),
            "filiales_edit"=>$this->isFeatureAutorized('mnt_filiales_edit'),
            "filiales_delete"=>$this->isFeatureAutorized('mnt_filiales_delete'),
            "filiales_new"=>$this->isFeatureAutorized('mnt_filiales_new')

        );
        $viewData["filiales"] = \Dao\Mnt\Filiales::findAll();
        Renderer::render('mnt/filiales', $viewData);
    }
}
?>