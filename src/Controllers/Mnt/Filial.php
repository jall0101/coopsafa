<?php

//FILIALES
namespace Controllers\Mnt;
use Controllers\PrivateController;
use Exception;
use Views\Renderer;

class Filial extends PrivateController{
    private $redirectTo = "index.php?page=Mnt-Filiales";
    private $viewData = array(
        "mode" => "DSP",
        "modedsc" => "",
        "filialcod" => 0,
        "nombreFilial" => "",
        "nombreFilial_error"=> "",
        "general_errors"=> array(),
        "has_errors" =>false,
        "show_action" => true,
        "readonly" => false,
        "xssToken" =>""
    );
    private $modes = array(
        "DSP" => "Detalle de %s (%s)",
        "INS" => "Nueva Filial",
        "UPD" => "Editar %s (%s)",
        "DEL" => "Borrar %s (%s)"
    );

    private $modesAuth = array(
        "DSP" => "mnt_filiales_view",
        "INS" => "mnt_filiales_new",
        "UPD" => "mnt_filiales_edit",
        "DEL" => "mnt_filiales_delete"
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
            unset($_SESSION["xssToken_Mnt_Filial"]);
            error_log(sprintf("Controller/Mnt/Filial ERROR: %s", $error->getMessage()));
            \Utilities\Site::redirectToWithMsg(
                $this->redirectTo,
                "Algo Inesperado Sucedió. Intente de Nuevo."
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
            } else {
                throw new Exception("Mode Not available");
            }
        } else {
            throw new Exception("Mode not defined on Query Params");
        }
        if($this->viewData["mode"] !== "INS") {
            if(isset($_GET['filialcod'])){
                $this->viewData["filialcod"] = intval($_GET["filialcod"]);
            } else {
                throw new Exception("Id not found on Query Params");
            }
        }
    }



    private function validatePostData(){
        if(isset($_POST["xssToken"])){
            if(isset($_SESSION["xssToken_Mnt_Filial"])){
                if($_POST["xssToken"] !== $_SESSION["xssToken_Mnt_Filial"]){
                    throw new Exception("Invalid Xss Token no match");
                }
            } else {
                throw new Exception("Invalid Xss Token on Session");
            }
        } else {
            throw new Exception("Invalid Xss Token");
        }


        if(isset($_POST["nombreFilial"])){
            if(\Utilities\Validators::IsEmpty($_POST["nombreFilial"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["nombreFilial_error"] = "El nombre no puede ir vacío!";
            }
        } else {
            throw new Exception("nombreFilial not present in form");
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



        if(isset($_POST["filialcod"])){
            if(($this->viewData["mode"] !== "INS" && intval($_POST["filialcod"])<=0)){
                throw new Exception("filialcod is not Valid");
            }
            if($this->viewData["filialcod"]!== intval($_POST["filialcod"])){
                throw new Exception("filialcod value is different from query");
            }
        }else {
            throw new Exception("filialcod not present in form");
        }
        $this->viewData["nombreFilial"] = $_POST["nombreFilial"];
        if($this->viewData["mode"]!=="DEL"){
            $this->viewData["nombreFilial"] = $_POST["nombreFilial"];
        }
    }



    private function executeAction(){
        switch($this->viewData["mode"]){
            case "INS":
                $inserted = \Dao\Mnt\Filiales::insert(
                    $this->viewData["nombreFilial"]
                );
                if($inserted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Fiial Creada Exitosamente"
                    );
                }
                break;
            case "UPD":
                $updated = \Dao\Mnt\Filiales::update(
                    $this->viewData["nombreFilial"],
                    $this->viewData["filialcod"]
                );
                if($updated > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Filial Actualizada Exitosamente"
                    );
                }
                break;
            case "DEL":
                $deleted = \Dao\Mnt\Filiales::delete(
                    $this->viewData["filialcod"]
                );
                if($deleted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Filial Eliminada Exitosamente"
                    );
                }
                break;
        }
    }


    
    private function render(){
        $xssToken = md5("FILIAL" . rand(0,4000) * rand(5000, 9999));
        $this->viewData["xssToken"] = $xssToken;
        $_SESSION["xssToken_Mnt_Filial"] = $xssToken;

        if($this->viewData["mode"] === "INS") {
            $this->viewData["modedsc"] = $this->modes["INS"];
        } else {
            $tmpFiliales = \Dao\Mnt\Filiales::findById($this->viewData["filialcod"]);
            if(!$tmpFiliales){
                throw new Exception("Filial no existe en DB");
            }
            
            \Utilities\ArrUtils::mergeFullArrayTo($tmpFiliales, $this->viewData);
            
            $this->viewData["modedsc"] = sprintf(
                $this->modes[$this->viewData["mode"]],
                $this->viewData["nombreFilial"],
                $this->viewData["filialcod"]
            );
            
            if(in_array($this->viewData["mode"], array("DSP","DEL"))){
                $this->viewData["readonly"] = "readonly";
            }
            if($this->viewData["mode"] === "DSP") {
                $this->viewData["show_action"] = false;
            }
        }
        Renderer::render("mnt/filial", $this->viewData);
    }
}

?>