<?php

namespace Controllers\Mnt;

use Controllers\PrivateController;
use Views\Renderer;

class Gestiones extends PrivateController {
    public function run() :void
    {
        $viewData = array(
            "gestiones_view"=>$this->isFeatureAutorized('mnt_gestiones_view'),
            "gestiones_edit"=>$this->isFeatureAutorized('mnt_gestiones_edit'),
            "gestiones_delete"=>$this->isFeatureAutorized('mnt_gestiones_delete'),
            "gestiones_new"=>$this->isFeatureAutorized('mnt_gestiones_new')

        );
        $viewData["gestiones"] = \Dao\Mnt\Gestiones::findAll();
        Renderer::render('mnt/gestiones', $viewData);
    }
}
?>