<?php

namespace Controllers\Mnt;
use Controllers\PrivateController;
use Exception;
use Views\Renderer;

class Gestion extends PrivateController{
    private $redirectTo = "index.php?page=Mnt-Gestiones";
    private $viewData = array(
        "mode" => "DSP",
        "modedsc" => "",
        "gestioncod" => 0,
        "tipogestion" => "", 
        "invEquipoGestion" => "", 
        "nomEquipoGestion" => "", 
        "descripcionGestion" => "", 
        "filialGestion" => "",
        "departamentoGestion" => "", 
        "asigGestion" => "",
        "general_errors"=> array(),
        "has_errors" =>false,
        "show_action" => true,
        "readonly" => false,
        "xssToken" =>""
    );
    private $modes = array(
        "DSP" => "Detalle de %s (%s)",
        "INS" => "Nueva Gestión Entrada y Salida",
        "UPD" => "Editar %s (%s)",
        "DEL" => "Borrar %s (%s)"
    );

    private $modesAuth = array(
        "DSP" => "mnt_gestiones_view",
        "INS" => "mnt_gestiones_new",
        "UPD" => "mnt_gestiones_edit",
        "DEL" => "mnt_gestiones_delete"
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
            unset($_SESSION["xssToken_Mnt_Gestion"]);
            error_log(sprintf("Controller/Mnt/Gestion ERROR: %s", $error->getMessage()));
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
            if(isset($_GET['gestioncod'])){
                $this->viewData["gestioncod"] = intval($_GET["gestioncod"]);
            } else {
                throw new Exception("Id not found on Query Params");
            }
        }
    }


    private function validatePostData(){
        if(isset($_POST["xssToken"])){
            if(isset($_SESSION["xssToken_Mnt_Gestion"])){
                if($_POST["xssToken"] !== $_SESSION["xssToken_Mnt_Gestion"]){
                    throw new Exception("Invalid Xss Token no match");
                }
            } else {
                throw new Exception("Invalid Xss Token on Session");
            }
        } else {
            throw new Exception("Invalid Xss Token");
        }



        //LECTURA DE gestionEoS DE ENTRADAS Y SALIDAS
        if(isset($_POST["tipogestion"])){
            if(\Utilities\Validators::IsEmpty($_POST["tipogestion"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "La gestión no puede ir vacía!";
            }
        } else {
            throw new Exception("tipogestion not present in form");
        }


        //LECTURA DE inventarioEquipoES DE ENTRADAS Y SALIDAS
        if(isset($_POST["invEquipoGestion"])){
            if(\Utilities\Validators::IsEmpty($_POST["invEquipoGestion"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"]= "El inventario no puede ir vacío!";
            }
        } else {
            throw new Exception("invEquipoGestion not present in form");
        }


        //LECTURA DE nomEquipo DE ENTRADAS Y SALIDAS
        if(isset($_POST["nomEquipoGestion"])){
            if(\Utilities\Validators::IsEmpty($_POST["nomEquipoGestion"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "El nombre no puede ir vacío!";
            }
        } else {
            throw new Exception("nomEquipoGestion not present in form");
        }

        //LECTURA DE descripcion DE ENTRADAS Y SALIDAS
        if(isset($_POST["descripcionGestion"])){
            if(\Utilities\Validators::IsEmpty($_POST["descripcionGestion"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "La descripcionGestion no puede ir vacía!";
            }
        } else {
            throw new Exception("descripcionGestion not present in form");
        }


        //LECTURA DE filial DE ENTRADAS Y SALIDAS
        if(isset($_POST["filialGestion"])){
            if(\Utilities\Validators::IsEmpty($_POST["filialGestion"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "La filialGestion no puede ir vacía!";
            }
        } else {
            throw new Exception("filialGestion not present in form");
        }


        //LECTURA DE departamento DE ENTRADAS Y SALIDAS
        if(isset($_POST["departamentoGestion"])){
            if(\Utilities\Validators::IsEmpty($_POST["departamentoGestion"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "El departamentoGestion no puede ir vacío!";
            }
        } else {
            throw new Exception("departamentoGestion not present in form");
        }


        //LECTURA DE asignado DE ENTRADAS Y SALIDAS
        if(isset($_POST["asigGestion"])){
            if(\Utilities\Validators::IsEmpty($_POST["asigGestion"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "El nombre de asig Gestion no puede ir vacío!";
            }
        } else {
            throw new Exception("asig Gestion not present in form");
        }



        if(isset($_POST["gestioncod"])){
            if(($this->viewData["mode"] !== "INS" && intval($_POST["gestioncod"])<=0)){
                throw new Exception("gestioncod is not Valid");
            }
            if($this->viewData["gestioncod"]!== intval($_POST["gestioncod"])){
                throw new Exception("gestioncod value is different from query");
            }
        }else {
            throw new Exception("gestioncod not present in form");
        }
        $this->viewData["tipogestion"]= $_POST["tipogestion"];
        $this->viewData["invEquipoGestion"]= $_POST["invEquipoGestion"];
        $this->viewData["nomEquipoGestion"]= $_POST["nomEquipoGestion"];
        $this->viewData["descripcionGestion"]= $_POST["descripcionGestion"];
        $this->viewData["filialGestion"]= $_POST["filialGestion"];
        $this->viewData["departamentoGestion"]= $_POST["departamentoGestion"];
        $this->viewData["asigGestion"]= $_POST["asigGestion"];
    }



    private function executeAction(){
        switch($this->viewData["mode"]){
            case "INS":
                $inserted = \Dao\Mnt\Gestiones::insert(
                    $this->viewData["tipogestion"],
                    $this->viewData["invEquipoGestion"],
                    $this->viewData["nomEquipoGestion"],
                    $this->viewData["descripcionGestion"],
                    $this->viewData["filialGestion"],
                    $this->viewData["departamentoGestion"],
                    $this->viewData["asigGestion"]
                );
                if($inserted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Gestión Creada Exitosamente"
                    );
                }
                break;
            case "UPD":
                $updated = \Dao\Mnt\Gestiones::update(
                    $this->viewData["gestioncod"],
                    $this->viewData["tipogestion"],
                    $this->viewData["invEquipoGestion"],
                    $this->viewData["nomEquipoGestion"],
                    $this->viewData["descripcionGestion"],
                    $this->viewData["filialGestion"],
                    $this->viewData["departamentoGestion"],
                    $this->viewData["asigGestion"]
                    
                );
                if($updated > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Gestión Actualizada Exitosamente"
                    );
                }
                break;
            case "DEL":
                $deleted = \Dao\Mnt\Gestiones::delete(
                    $this->viewData["gestioncod"]
                );
                if($deleted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Gestión Eliminada Exitosamente"
                    );
                }
                break;
        }
    }
    private function render(){
        $xssToken = md5("GESTION" . rand(0,4000) * rand(5000, 9999));
        $this->viewData["xssToken"] = $xssToken;
        $_SESSION["xssToken_Mnt_Gestion"] = $xssToken;

        if($this->viewData["mode"] === "INS") {
            $this->viewData["modedsc"] = $this->modes["INS"];
        } else {
            $tmpGestiones = \Dao\Mnt\Gestiones::findById($this->viewData["gestioncod"]);
            if(!$tmpGestiones){
                throw new Exception("Gestion no existe en DB");
            }
            
            \Utilities\ArrUtils::mergeFullArrayTo($tmpGestiones, $this->viewData);
            $this->viewData["modedsc"] = sprintf(
                $this->modes[$this->viewData["mode"]],
                    $this->viewData["invEquipoGestion"],
                    $this->viewData["gestioncod"]
            );
            
            if(in_array($this->viewData["mode"], array("DSP","DEL"))){
                $this->viewData["readonly"] = "readonly";
            }
            if($this->viewData["mode"] === "DSP") {
                $this->viewData["show_action"] = false;
            }
        }
        Renderer::render("mnt/gestion", $this->viewData);
    }
}

?>