<?php
//BORRAR
namespace Controllers;
class Index extends PublicController
{
    /**
     * Index run method
     *
     * @return void
     */
    public function run() :void
    {
        $viewData = array();
        $viewData["hombres"] = \Dao\Mnt\Zapatos::findTopByDepartment(1);
        $viewData["mujeres"] = \Dao\Mnt\Zapatos::findTopByDepartment(2);
        $viewData["ninos"] = \Dao\Mnt\Zapatos::findTopByDepartment(3);
        \Views\Renderer::render("index", $viewData);

    }
}
?>
