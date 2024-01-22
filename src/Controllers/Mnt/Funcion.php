<?php
namespace Controllers\Mnt;

use Controllers\PrivateController;
use Exception;
use Views\Renderer;

class Funcion extends PrivateController{
    private $redirectTo = "index.php?page=Mnt-Funciones";
    private $viewData = array(
        "mode" => "DSP",
        "modedsc" => "",
        "fncod" => "",
        "fndsc" => "",
        "fnest" => "ACT",
        "fntyp" => "PGN",
        "fnest_ACT" => "selected",
        "fnest_INA" => "",
        "fntyp_PGN" => "",
        "fntyp_CTR" => "selected",        
        "general_errors"=> array(),
        "has_errors" =>false,
        "show_action" => true,
        "readonly" => false,
        "readonly_edit" => false,
        "xssToken" => ""
    );
    private $modes = array(
        "DSP" => "Detalle de %s (%s)",
        "INS" => "Nueva Función",
        "UPD" => "Editar %s (%s)",
        "DEL" => "Borrar %s (%s)"
    );

    private $modesAuth = array(
        "DSP" => "mnt_funciones_view",
        "INS" => "mnt_funciones_new",
        "UPD" => "mnt_funciones_edit",
        "DEL" => "mnt_funciones_delete"
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
            unset($_SESSION["xssToken_Mnt_Funcion"]);
            error_log(sprintf("Controller/Mnt/Funcion ERROR: %s", $error->getMessage()));
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
            if(isset($_GET['fncod'])){
                $this->viewData["fncod"] = $_GET["fncod"];
            } else {
                throw new Exception("Id not found on Query Params");
            }
        }
    }
    private function validatePostData(){
        if(isset($_POST["xssToken"])){
            if(isset($_SESSION["xssToken_Mnt_Funcion"])){
                if($_POST["xssToken"] !== $_SESSION["xssToken_Mnt_Funcion"]){
                    throw new Exception("Invalid Xss Token no match");
                }
            } else {
                throw new Exception("Invalid xss Token on session");
            }
        } else {
            throw new Exception("Invalid xss Token");
        }
        if(isset($_POST["fndsc"])){
            if(\Utilities\Validators::IsEmpty($_POST["fndsc"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"][] = "La descripción no puede ir vacía!";
            }
        } else {
            throw new Exception("fnDesc not present in form");
        }
        if(isset($_POST["fnest"])){
            if (!in_array( $_POST["fnest"], array("ACT","INA"))){
                throw new Exception("fnest incorrect value");
            }
        }else {
            if($this->viewData["mode"]!=="DEL") {
                throw new Exception("fnest not present in form");
            }
        }
        if(isset($_POST["fntyp"])){
            if (!in_array( $_POST["fntyp"], array("PGN","CTR"))){
                throw new Exception("fntyp incorrect value");
            }
        }else {
            if($this->viewData["mode"]!=="DEL") {
                throw new Exception("fntyp not present in form");
            }
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
        if(isset($_POST["fncod"])){            
            if($this->viewData["fncod"]!== $_POST["fncod"] && $this->viewData["mode"] !== "INS"){
                throw new Exception("fncod value is different from query");
            }
        }else {
            throw new Exception("fncod not present in form");
        }
        if($this->viewData["mode"] === "INS"){
            $this->viewData["fncod"] = $_POST["fncoddummy"];       
            
        }
        
         
        $this->viewData["fndsc"] = $_POST["fndsc"];        
        if($this->viewData["mode"]!=="DEL"){
            $this->viewData["fnest"] = $_POST["fnest"];
        }
        if($this->viewData["mode"]!=="DEL"){
            $this->viewData["fntyp"] = $_POST["fntyp"];
        }
    }
    private function executeAction(){
        switch($this->viewData["mode"]){
            case "INS":
                $inserted = \Dao\Mnt\Funciones::insert(
                    $this->viewData["fncod"],
                    $this->viewData["fndsc"],
                    $this->viewData["fnest"],
                    $this->viewData["fntyp"]
                );
                if($inserted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Función Creada Exitosamente"
                    );
                }
                break;
            case "UPD":
                $updated = \Dao\Mnt\Funciones::update(
                    $this->viewData["fncod"],
                    $this->viewData["fndsc"],
                    $this->viewData["fnest"],
                    $this->viewData["fntyp"]
                );
                if($updated > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Función Actualizada Exitosamente"
                    );
                }
                break;
            case "DEL":
                $deleted = \Dao\Mnt\Funciones::delete(
                    $this->viewData["fncod"]
                );
                if($deleted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Función Eliminada Exitosamente"
                    );
                }
                break;
        }
    }
    private function render(){
        $xssToken = md5("FUNCION" . rand(0,4000) * rand(5000,9999));
        $this-> viewData["xssToken"] = $xssToken;
        $_SESSION["xssToken_Mnt_Funcion"] = $xssToken;

        if($this->viewData["mode"] === "INS") {
            $this->viewData["modedsc"] = $this->modes["INS"];
        } else {
            $tmpFunciones = \Dao\Mnt\Funciones::findById($this->viewData["fncod"]);
            if(!$tmpFunciones){
                throw new Exception("Funcion no existe en DB");
            }
            \Utilities\ArrUtils::mergeFullArrayTo($tmpFunciones, $this->viewData);
            $this->viewData["fnest_ACT"] = $this->viewData["fnest"] === "ACT" ? "selected": "";
            $this->viewData["fnest_INA"] = $this->viewData["fnest"] === "INA" ? "selected": "";
            $this->viewData["fntyp_PGN"] = $this->viewData["fntyp"] === "PGN" ? "selected": "";
            $this->viewData["fnest_CTR"] = $this->viewData["fntyp"] === "CTR" ? "selected": "";
            $this->viewData["modedsc"] = sprintf(
                $this->modes[$this->viewData["mode"]],
                $this->viewData["fndsc"],
                $this->viewData["fncod"]
            );
            if(in_array($this->viewData["mode"], array("DSP","DEL"))){
                $this->viewData["readonly"] = "readonly";
            }
            if($this->viewData["mode"] === "DSP") {
                $this->viewData["show_action"] = false;
            }
            if($this->viewData["mode"] === "UPD"){
                $this->viewData["readonly_edit"] = "readonly";
            }
        }
        Renderer::render("mnt/funcion", $this->viewData);
    }
}

?>