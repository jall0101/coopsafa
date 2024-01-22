<?php
namespace Controllers\Mnt;
use Controllers\PrivateController;
use Exception;
use Views\Renderer;

class Departamento extends PrivateController{
    private $redirectTo = "index.php?page=Mnt-Departamentos";
    private $viewData = array(
        "mode" => "DSP",
        "modedsc" => "",
        "departamentocod" => 0,
        "nombredepartamento" => "",
        "nombredepartamento_error"=> "",
        "general_errors"=> array(),
        "has_errors" =>false,
        "show_action" => true,
        "readonly" => false,
        "xssToken" =>""
    );
    private $modes = array(
        "DSP" => "Detalle de %s (%s)",
        "INS" => "Nuevo Departamento",
        "UPD" => "Editar %s (%s)",
        "DEL" => "Borrar %s (%s)"
    );
    private $modesAuth = array(
        "DSP" => "mnt_departamentos_view",
        "INS" => "mnt_departamentos_new",
        "UPD" => "mnt_departamentos_edit",
        "DEL" => "mnt_departamentos_delete"
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
            unset($_SESSION["xssToken_Mnt_Departamento"]);
            error_log(sprintf("Controller/Mnt/Departamento ERROR: %s", $error->getMessage()));
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
                $this->viewData["mode"] = $_GET['mode'];
            } else {
                throw new Exception("Mode Not available");
            }
        } else {
            throw new Exception("Mode not defined on Query Params");
        }
        if($this->viewData["mode"] !== "INS") {
            if(isset($_GET['departamentocod'])){
                $this->viewData["departamentocod"] = intval($_GET["departamentocod"]);
            } else {
                throw new Exception("Id not found on Query Params");
            }
        }
    }

    private function validatePostData(){
        if(isset($_POST["xssToken"])){
            if(isset($_SESSION["xssToken_Mnt_Departamento"])){
                if($_POST["xssToken"] !== $_SESSION["xssToken_Mnt_Departamento"]){
                    throw new Exception("Invalid Xss Token no match");
                }
            } else {
                throw new Exception("Invalid Xss Token on Session");
            }
        } else {
            throw new Exception("Invalid Xss Token");
        }
        if(isset($_POST["nombredepartamento"])){
            if(\Utilities\Validators::IsEmpty($_POST["nombredepartamento"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["nombredepartamento_error"] = "El nombre del departamento no puede ir vacío!";
            }
        } else {
            throw new Exception("nombredepartamento not present in form");
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
        if(isset($_POST["departamentocod"])){
            if(($this->viewData["mode"] !== "INS" && intval($_POST["departamentocod"])<=0)){
                throw new Exception("departamentocod is not Valid");
            }
            if($this->viewData["departamentocod"]!== intval($_POST["departamentocod"])){
                throw new Exception("departamentocod value is different from query");
            }
        }else {
            throw new Exception("departamentocod not present in form");
        }
        $this->viewData["nombredepartamento"] = $_POST["nombredepartamento"];
        if($this->viewData["mode"]!=="DEL"){
            $this->viewData["nombredepartamento"] = $_POST["nombredepartamento"];
        }
    }
    private function executeAction(){
        switch($this->viewData["mode"]){
            case "INS":
                $inserted = \Dao\Mnt\Departamentos::insert(
                    $this->viewData["nombredepartamento"]
                );
                if($inserted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Departamento Creada Exitosamente"
                    );
                }
                break;
            case "UPD":
                $updated = \Dao\Mnt\Departamentos::update(
                    $this->viewData["nombredepartamento"],
                    $this->viewData["departamentocod"]
                );
                if($updated > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Departamento Actualizada Exitosamente"
                    );
                }
                break;
            case "DEL":
                $deleted = \Dao\Mnt\Departamentos::delete(
                    $this->viewData["departamentocod"]
                );
                if($deleted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Departamento Eliminada Exitosamente"
                    );
                }
                break;
        }
    }
    private function render(){
        $xssToken = md5("DEPARTAMENTO" . rand(0,4000) * rand(5000, 9999));
        $this->viewData["xssToken"] = $xssToken;
        $_SESSION["xssToken_Mnt_Departamento"] = $xssToken;

        if($this->viewData["mode"] === "INS") {
            $this->viewData["modedsc"] = $this->modes["INS"];
        } else {
            $tmpDepartamentos = \Dao\Mnt\Departamentos::findById($this->viewData["departamentocod"]);
            if(!$tmpDepartamentos){
                throw new Exception("Departamento no existe en DB");
            }
            \Utilities\ArrUtils::mergeFullArrayTo($tmpDepartamentos, $this->viewData);
            $this->viewData["modedsc"] = sprintf(
                $this->modes[$this->viewData["mode"]],
                $this->viewData["nombredepartamento"],
                $this->viewData["departamentocod"]
            );
            if(in_array($this->viewData["mode"], array("DSP","DEL"))){  
                $this->viewData["readonly"] = "readonly";
            }
            if($this->viewData["mode"] === "DSP") {
                $this->viewData["show_action"] = false;
            }
        }
        Renderer::render("mnt/departamento", $this->viewData);
    }
}

?>