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
        "idEntradasalida" => 0,
        "gestionES" => "", 
        "inventarioEquipoES" => "", 
        "nomEquipo" => "", 
        "categoria" => "", 
        "descripcion" => "", 
        "filial" => "",
        "departamento" => "", 
        "asignado" => "",

        "gestionES_error" => "", 
        "inventarioEquipoES_error" => "", 
        "nomEquipo-error" => "", 
        "categoria_error" => "", 
        "descripcion_error" => "", 
        "filial_error" => "",
        "departamento_error" => "", 
        "asignado_error" => "",
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
            if(isset($_GET['idEntradasalida'])){
                $this->viewData["idEntradasalida"] = intval($_GET["idEntradasalida"]);
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
        if(isset($_POST["gestionES"])){
            if(\Utilities\Validators::IsEmpty($_POST["gestionES"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "La gestión no puede ir vacía!";
            }
        } else {
            throw new Exception("gestionES not present in form");
        }


        //LECTURA DE inventarioEquipoES DE ENTRADAS Y SALIDAS
        if(isset($_POST["inventarioEquipoES"])){
            if(\Utilities\Validators::IsEmpty($_POST["inventarioEquipoES"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"]= "El inventario no puede ir vacío!";
            }
        } else {
            throw new Exception("inventarioEquipoES not present in form");
        }


        //LECTURA DE nomEquipo DE ENTRADAS Y SALIDAS
        if(isset($_POST["nomEquipo"])){
            if(\Utilities\Validators::IsEmpty($_POST["nomEquipo"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "El nombre no puede ir vacío!";
            }
        } else {
            throw new Exception("nomEquipo not present in form");
        }


        //LECTURA DE categoria DE ENTRADAS Y SALIDAS
        if(isset($_POST["categoria"])){
            if(\Utilities\Validators::IsEmpty($_POST["categoria"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "La categoria no puede ir vacía!";
            }
        } else {
            throw new Exception("categoria not present in form");
        }


        //LECTURA DE descripcion DE ENTRADAS Y SALIDAS
        if(isset($_POST["descripcion"])){
            if(\Utilities\Validators::IsEmpty($_POST["descripcion"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "La descripcion no puede ir vacía!";
            }
        } else {
            throw new Exception("descripcion not present in form");
        }


        //LECTURA DE filial DE ENTRADAS Y SALIDAS
        if(isset($_POST["filial"])){
            if(\Utilities\Validators::IsEmpty($_POST["filial"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "La filial no puede ir vacía!";
            }
        } else {
            throw new Exception("filial not present in form");
        }


        //LECTURA DE departamento DE ENTRADAS Y SALIDAS
        if(isset($_POST["departamento"])){
            if(\Utilities\Validators::IsEmpty($_POST["departamento"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "El departamento no puede ir vacío!";
            }
        } else {
            throw new Exception("departamento not present in form");
        }


        //LECTURA DE asignado DE ENTRADAS Y SALIDAS
        if(isset($_POST["asignado"])){
            if(\Utilities\Validators::IsEmpty($_POST["asignado"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "El nombre de asignado no puede ir vacío!";
            }
        } else {
            throw new Exception("asignado not present in form");
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



        if(isset($_POST["idEntradasalida"])){
            if(($this->viewData["mode"] !== "INS" && intval($_POST["idEntradasalida"])<=0)){
                throw new Exception("idEntradasalida is not Valid");
            }
            if($this->viewData["idEntradasalida"]!== intval($_POST["idEntradasalida"])){
                throw new Exception("idEntradasalida value is different from query");
            }
        }else {
            throw new Exception("idEntradasalida not present in form");
        }
        $this->viewData["gestionES"]= $_POST["gestionES"];
        if($this->viewData["mode"]!=="DEL"){
            $this->viewData["gestionES"]= $_POST["gestionES"];
        }

        $this->viewData["inventarioEquipoES"]= $_POST["inventarioEquipoES"];
        if($this->viewData["mode"]!=="DEL"){
            $this->viewData["inventarioEquipoES"]= $_POST["inventarioEquipoES"];
        }

        $this->viewData["nomEquipo"]= $_POST["nomEquipo"];
        if($this->viewData["mode"]!=="DEL"){
            $this->viewData["nomEquipo"]= $_POST["nomEquipo"];
        }

        $this->viewData["categoria"]= $_POST["categoria"];
        if($this->viewData["mode"]!=="DEL"){
            $this->viewData["categoria"]= $_POST["categoria"];
        }

        $this->viewData["descripcion"]= $_POST["descripcion"];
        if($this->viewData["mode"]!=="DEL"){
            $this->viewData["descripcion"]= $_POST["descripcion"];
        }

        $this->viewData["filial"]= $_POST["filial"];
        if($this->viewData["mode"]!=="DEL"){
            $this->viewData["filial"]= $_POST["filial"];
        }

        $this->viewData["departamento"]= $_POST["departamento"];
        if($this->viewData["mode"]!=="DEL"){
            $this->viewData["departamento"]= $_POST["departamento"];
        }

        $this->viewData["asignado"]= $_POST["asignado"];
        if($this->viewData["mode"]!=="DEL"){
            $this->viewData["asignado"]= $_POST["asignado"];
        }
    }



    private function executeAction(){
        switch($this->viewData["mode"]){
            case "INS":
                $inserted = \Dao\Mnt\Gestiones::insert(
                    $this->viewData["gestionES"],
                    $this->viewData["inventarioEquipoES"],
                    $this->viewData["nomEquipo"],
                    $this->viewData["categoria"],
                    $this->viewData["descripcion"],
                    $this->viewData["filial"],
                    $this->viewData["departamento"],
                    $this->viewData["asignado"]
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
                    $this->viewData["gestionES"],
                    $this->viewData["inventarioEquipoES"],
                    $this->viewData["nomEquipo"],
                    $this->viewData["categoria"],
                    $this->viewData["descripcion"],
                    $this->viewData["filial"],
                    $this->viewData["departamento"],
                    $this->viewData["asignado"],
                    $this->viewData["idEntradasalida"]
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
                    $this->viewData["idEntradasalida"]
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
            $tmpGestiones = \Dao\Mnt\Gestiones::findById($this->viewData["idEntradasalida"]);
            if(!$tmpGestiones){
                throw new Exception("Filial no existe en DB");
            }
            
            \Utilities\ArrUtils::mergeFullArrayTo($tmpGestiones, $this->viewData);
            
            $this->viewData["modedsc"] = sprintf(
                $this->modes[$this->viewData["mode"]],
                $this->viewData["gestionEoS"],
                    $this->viewData["inventarioEquipoES"],
                    $this->viewData["nomEquipo"],
                    $this->viewData["categoria"],
                    $this->viewData["descripcion"],
                    $this->viewData["filial"],
                    $this->viewData["departamento"],
                    $this->viewData["asignado"],
                    $this->viewData["idEntradasalida"]
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