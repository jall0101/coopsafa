<?php
namespace Controllers\Mnt;

use Controllers\PrivateController;
use Views\Renderer;

class Marcas extends PrivateController {
    public function run() :void
    {
        $viewData = array(

            "marcas_view" => $this->isFeatureAutorized('mnt_marcas_view'),
            "marcas_edit" => $this->isFeatureAutorized('mnt_marcas_edit'),
            "marcas_delete" => $this->isFeatureAutorized('mnt_marcas_delete'),
            "marcas_new" => $this->isFeatureAutorized('mnt_marcas_new')
            
        );
        $viewData["marcas"] = \Dao\Mnt\Marcas::findAll();
        Renderer::render('mnt/marcas', $viewData);
    }
}
?>