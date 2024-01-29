<?php
namespace Controllers\Mnt;
use Controllers\PrivateController;
use Exception;
use Views\Renderer;

class Asignado extends PrivateController{
    private $redirectTo = "index.php?page=Mnt-Asignados";
    private $viewData = array(
        "mode" => "DSP",
        "modedsc" => "",
        "asignadocod" => 0,
        "nombreDepartamento" => "",
        "departamento_error"=> "",
        "nombreAsignado" => "",
        "nombreAsignado_error"=> "",
        "general_errors"=> array(),
        "has_errors" =>false,
        "show_action" => true,
        "readonly" => false,
        "xssToken" =>""
    );


    private $modes = array(
        "DSP" => "Detalle de %s (%s)",
        "INS" => "Nuevo Asignado",
        "UPD" => "Editar %s (%s)",
        "DEL" => "Borrar %s (%s)"
    );
    private $modesAuth = array(
        "DSP" => "mnt_asignados_view",
        "INS" => "mnt_asignados_new",
        "UPD" => "mnt_asignados_edit",
        "DEL" => "mnt_asignados_delete"
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
            unset($_SESSION["xssToken_Mnt_Asignado"]);
            error_log(sprintf("Controller/Mnt/Asignado ERROR: %s", $error->getMessage()));
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
            if(isset($_GET['asignadocod'])){
                $this->viewData["asignadocod"] = intval($_GET["asignadocod"]);
            } else {
                throw new Exception("Id not found on Query Params");
            }
        }
    }

    private function validatePostData(){
        if(isset($_POST["xssToken"])){
            if(isset($_SESSION["xssToken_Mnt_Asignado"])){
                if($_POST["xssToken"] !== $_SESSION["xssToken_Mnt_Asignado"]){
                    throw new Exception("Invalid Xss Token no match");
                }
            } else {
                throw new Exception("Invalid Xss Token on Session");
            }
        } else {
            throw new Exception("Invalid Xss Token");
        }



        if(isset($_POST["nombreDepartamento"])){
            if(\Utilities\Validators::IsEmpty($_POST["nombreDepartamento"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "El campo nombreDepartamento no puede ir vacío!";
            }
        } else {
            throw new Exception("nombreDepartamento not present in form");
        }


        if(isset($_POST["nombreAsignado"])){
            if(\Utilities\Validators::IsEmpty($_POST["nombreAsignado"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["nombreAsignado_error"] = "El nombre del usuario asignado no puede ir vacío!";
            }
        } else {
            throw new Exception("nombreAsignado not present in form");

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

        

        if(isset($_POST["asignadocod"])){
            if(($this->viewData["mode"] !== "INS" && intval($_POST["asignadocod"])<=0)){
                throw new Exception("asignadocod is not Valid");
            }
            if($this->viewData["asignadocod"]!== intval($_POST["asignadocod"])){
                throw new Exception("asignadocod value is different from query");
            }
        }else {
            throw new Exception("asignadocod not present in form");
        }


        $this->viewData["nombreAsignado"] = $_POST["nombreAsignado"];
        $this->viewData["nombreDepartamento"] = $_POST["nombreDepartamento"];
        if($this->viewData["mode"]!=="DEL"){
            $this->viewData["nombreDepartamento"] = $_POST["nombreDepartamento"];
            $this->viewData["nombreAsignado"] = $_POST["nombreAsignado"];
        }
    }

    
    private function executeAction(){
        switch($this->viewData["mode"]){
            case "INS":
                $inserted = \Dao\Mnt\Asignados::insert(
                    $this->viewData["nombreDepartamento"],
                    $this->viewData["nombreAsignado"]
                );
                if($inserted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Asignado Creada Exitosamente"
                    );
                }
                break;
            case "UPD":
                $updated = \Dao\Mnt\Asignados::update(
                    $this->viewData["nombreDepartamento"],
                    $this->viewData["nombreAsignado"],
                    $this->viewData["asignadocod"]
                );
                if($updated > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Asignado Actualizada Exitosamente"
                    );
                }
                break;
            case "DEL":
                $deleted = \Dao\Mnt\Asignados::delete(
                    $this->viewData["asignadocod"]
                );
                if($deleted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Asignados Eliminada Exitosamente"
                    );
                }
                break;
        }
    }





    //FUNCIÓN DE RENDERIZADO PARA EL TOKEN
    private function render(){
        $xssToken = md5("ASIGNADO" . rand(0,4000) * rand(5000, 9999));
        $this->viewData["xssToken"] = $xssToken;
        $_SESSION["xssToken_Mnt_Asignado"] = $xssToken;

        if($this->viewData["mode"] === "INS") {
            $this->viewData["modedsc"] = $this->modes["INS"];
        } else {
            $tmpAsignados = \Dao\Mnt\Asignados::findById($this->viewData["asignadocod"]);
            if(!$tmpAsignados){
                throw new Exception("Asignado no existe en DB");
            }
            \Utilities\ArrUtils::mergeFullArrayTo($tmpAsignados, $this->viewData);
            $this->viewData["modedsc"] = sprintf(
                $this->modes[$this->viewData["mode"]],
                $this->viewData["nombreDepartamento"],
                $this->viewData["nombreAsignado"],
                $this->viewData["asignadocod"],
            );
            if(in_array($this->viewData["mode"], array("DSP","DEL"))){  
                $this->viewData["readonly"] = "readonly";
            }
            if($this->viewData["mode"] === "DSP") {
                $this->viewData["show_action"] = false;
            }
        }
        Renderer::render("mnt/asignado", $this->viewData);
    }
}
?>