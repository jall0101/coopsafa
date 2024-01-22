<?php
namespace Controllers\Mnt;
use Controllers\PrivateController;
use Exception;
use Views\Renderer;

class Marca extends PrivateController{
    private $redirectTo = "index.php?page=Mnt-Marcas";
    private $viewData = array(
        "mode" => "DSP",
        "modedsc" => "",
        "marcacod" => 0,
        "nombremarca" => "",
        "nombremarca_error"=> "",
        "general_errors"=> array(),
        "has_errors" =>false,
        "show_action" => true,
        "readonly" => false,
        "xssToken" =>""
    );
    private $modes = array(
        "DSP" => "Detalle de %s (%s)",
        "INS" => "Nueva Marca",
        "UPD" => "Editar %s (%s)",
        "DEL" => "Borrar %s (%s)"
    );

    private $modesAuth = array(
        "DSP" => "mnt_marcas_view",
        "INS" => "mnt_marcas_new",
        "UPD" => "mnt_marcas_edit",
        "DEL" => "mnt_marcas_delete"
    );

    public function run() :void
    {
        try {
            $this->page_loaded();
            if($this->isPostBack()){
                $this->validatePostData();
                if(!$this->viewData["has_errors"]){
                    $this->executeAction();
                }
            }
            $this->render();
        } catch (Exception $error) {
            unset($_SESSION["xssToken_Mnt_Marca"]);
            error_log(sprintf("Controller/Mnt/Marca ERROR: %s", $error->getMessage()));
            \Utilities\Site::redirectToWithMsg(
                $this->redirectTo,
                "Algo Inesperado Sucedió. Intente de Nuevo Por Favor."
            );
        }
    }


    private function page_loaded()
    {
        if(isset($_GET['mode'])){
            if(isset($this->modes[$_GET['mode']])){
                if (!$this->isFeatureAutorized($this->modesAuth[$_GET['mode']])) {
                    throw new Exception("Mode is not Authorized!");
                }
                $this->viewData["mode"] = $_GET['mode'];
                if (!$this->isFeatureAutorized($this->modesAuth[$_GET['mode']])) {
                    throw new Exception("Mode is not Authorized!");
                }
                $this->viewData["mode"] = $_GET['mode'];
            } else {
                throw new Exception("Mode Not available");
            }
        } else {
            throw new Exception("Mode not defined on Query Params");
        }
        if($this->viewData["mode"] !== "INS") {
            if(isset($_GET['marcacod'])){
                $this->viewData["marcacod"] = intval($_GET["marcacod"]);
            } else {
                throw new Exception("Id not found on Query Params");
            }
        }
    }

    private function validatePostData(){
        if(isset($_POST["xssToken"])){
            if(isset($_SESSION["xssToken_Mnt_Marca"])){
                if($_POST["xssToken"] !== $_SESSION["xssToken_Mnt_Marca"]){
                    throw new Exception("Invalid Xss Token no match");
                }
            } else {
                throw new Exception("Invalid Xss Token on Session");
            }
        } else {
            throw new Exception("Invalid Xss Token");
        }
        if(isset($_POST["nombremarca"])){
            if(\Utilities\Validators::IsEmpty($_POST["nombremarca"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["nombremarca_error"] = "El nombre no puede ir vacío!";
            }
        } else {
            throw new Exception("nombremarca not present in form");
        }
        if(isset($_POST["mode"])){
            if(!key_exists($_POST["mode"], $this->modes)){
                throw new Exception("mode has a bad value");
            }
            if($this->viewData["mode"]!== $_POST["mode"]){
                throw new Exception("mode value is different from query");
            }
        }else {
            throw new Exception("mode not present in form");
        }
        if(isset($_POST["marcacod"])){
            if(($this->viewData["mode"] !== "INS" && intval($_POST["marcacod"])<=0)){
                throw new Exception("marcacod is not Valid");
            }
            if($this->viewData["marcacod"]!== intval($_POST["marcacod"])){
                throw new Exception("marcacod value is different from query");
            }
        }else {
            throw new Exception("marcacod not present in form");
        }
        $this->viewData["nombremarca"] = $_POST["nombremarca"];
        if($this->viewData["mode"]!=="DEL"){
            $this->viewData["nombremarca"] = $_POST["nombremarca"];
        }
    }
    private function executeAction(){
        switch($this->viewData["mode"]){
            case "INS":
                $inserted = \Dao\Mnt\Marcas::insert(
                    $this->viewData["nombremarca"]
                );
                if($inserted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Marca Creada Exitosamente"
                    );
                }
                break;
            case "UPD":
                $updated = \Dao\Mnt\Marcas::update(
                    $this->viewData["nombremarca"],
                    $this->viewData["marcacod"]
                );
                if($updated > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Marca Actualizada Exitosamente"
                    );
                }
                break;
            case "DEL":
                $deleted = \Dao\Mnt\Marcas::delete(
                    $this->viewData["marcacod"]
                );
                if($deleted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Marca Eliminada Exitosamente"
                    );
                }
                break;
        }
    }
    private function render(){
        $xssToken = md5("MARCA" . rand(0,4000) * rand(5000, 9999));
        $this->viewData["xssToken"] = $xssToken;
        $_SESSION["xssToken_Mnt_Marca"] = $xssToken;

        if($this->viewData["mode"] === "INS") {
            $this->viewData["modedsc"] = $this->modes["INS"];
        } else {
            $tmpMarcas = \Dao\Mnt\Marcas::findById($this->viewData["marcacod"]);
            if(!$tmpMarcas){
                throw new Exception("Marca no existe en DB");
            }
            
            \Utilities\ArrUtils::mergeFullArrayTo($tmpMarcas, $this->viewData);
            $this->viewData["modedsc"] = sprintf(
                $this->modes[$this->viewData["mode"]],
                $this->viewData["nombremarca"],
                $this->viewData["marcacod"]
            );
            if(in_array($this->viewData["mode"], array("DSP","DEL"))){
                $this->viewData["readonly"] = "readonly";
            }
            if($this->viewData["mode"] === "DSP") {
                $this->viewData["show_action"] = false;
            }
        }
        Renderer::render("mnt/marca", $this->viewData);
    }
}

?>