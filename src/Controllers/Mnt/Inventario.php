<?php
namespace Controllers\Mnt;

use Controllers\PrivateController;
use Exception;
use Views\Renderer;

class Inventario extends PrivateController{
    private $redirectTo = "index.php?page=Mnt-Inventarios";
        
    private $viewData = array(
        "mode" => "DSP",
        "modedsc" => "",
        "id" => 0,
        "inventarioest" => "ACT",
        "inventarioest_ACT" =>"selected",
        "inventarioest_DES" => "",
        "numInventario" => "",
        "nomEquipo" => "",
        "categoriaEquipo" => "",
        "descripcionEquipo" => "",
        "filialEquipo" => "",
        "general_errors"=> array(),
        "has_errors" =>false,
        "show_action" => true,
        "readonly" => false,
        "xssToken" => "",
        "disabled" => false
    );
    private $modes = array(
        "DSP" => "Detalle de %s (%s)",
        "INS" => "Nuevo Inventario",
        "UPD" => "Editar %s (%s)",
        "DEL" => "Borrar %s (%s)"
    );

    private $modesAuth = array(
        "DSP" => "mnt_inventarios_view",
        "INS" => "mnt_inventarios_new",
        "UPD" => "mnt_inventarios_edit",
        "DEL" => "mnt_inventarios_delete"
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
            unset($_SESSION["xssToken_Mnt_Inventario"]);
            error_log(sprintf("Controller/Mnt/Inventario ERROR: %s", $error->getMessage()));
            \Utilities\Site::redirectToWithMsg(
                $this->redirectTo,
                "Algo Inesperado Sucedió. Intente de Nuevo."
            );
        }
        

    }


    //PÁGINA DE CARGA
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
            if(isset($_GET['id'])){
                $this->viewData["id"] = intval($_GET["id"]);
            } else {
                throw new Exception("Id not found on Query Params");
            }
        }
    }
    private function validatePostData(){
        if(isset($_POST["xssToken"])){
            if(isset($_SESSION["xssToken_Mnt_Inventario"])){
                if($_POST["xssToken"] !== $_SESSION["xssToken_Mnt_Inventario"]){
                    throw new Exception("Invalid Xss Token no match");
                }
            } else {
                throw new Exception("Invalid xss Token on session");
            }
        } else {
            throw new Exception("Invalid xss Token");
        }


        //VALIDACIÓN DE ESTADO
        if(isset($_POST["inventarioest"])){
            if (!in_array( $_POST["inventarioest"], array("ACT","DES"))){
                throw new Exception("inventario state incorrect value");
            }
        }else {
            if($this->viewData["mode"]!=="DEL") {
                throw new Exception("inventarioest not present in form");
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




        
       
        //VALIDACIÓN NUMERO DE INVENTARIO
        if(isset($_POST["numInventario"])){
            if(\Utilities\Validators::IsEmpty($_POST["numInventario"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "El número de inventario no puede ir vacío!";
            }
        } else {
            throw new Exception("numInventario not present in form");
        }

        //VALIDACIÓN NOMBRE DE EQUIPO
        if(isset($_POST["nomEquipo"])){
            if(\Utilities\Validators::IsEmpty($_POST["nomEquipo"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "El nombre de equipo no puede ir vacío!";
            }
        } else {
            throw new Exception("nomEquipo not present in form");
        }
        

        //VALIDACIÓN DE CATEGORIA DE EQUIPO
        if(isset($_POST["categoriaEquipo"])){
            if(\Utilities\Validators::IsEmpty($_POST["categoriaEquipo"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "La categoria no puede ir vacía!";
            }
        } else {
            throw new Exception("categoriaEquipo not present in form");
        }


        //VALIDACIÓN DE DESCRIPCIÓN DE EQUIPO
        if(isset($_POST["descripcionEquipo"])){
            if(\Utilities\Validators::IsEmpty($_POST["descripcionEquipo"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "La descripcion del equipo no puede ir vacía!";
            }
        } else {
            throw new Exception("descripcionEquipo not present in form");
        }


        //VALIDACIÓN DE FILIAL DE EQUIPO
        if(isset($_POST["filialEquipo"])){
            if(\Utilities\Validators::IsEmpty($_POST["filialEquipo"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "El campo de filial no puede ir vacío!";
            }
        } else {
            throw new Exception("filialEquipo not present in form");
        }
        

        //VALIDACIÓN DE ID
        if(isset($_POST["id"])){
            if(($this->viewData["mode"] !== "INS" && intval($_POST["id"])<=0)){
                throw new Exception("id is not Valid");
            }
            if($this->viewData["id"]!== intval($_POST["id"])){
                throw new Exception("id value is different from query");
            }
        }else {
            throw new Exception("id not present in form");
        }
        $this->viewData["numInventario"] = $_POST["numInventario"];
        $this->viewData["nomEquipo"]= $_POST["nomEquipo"];
        $this->viewData["categoriaEquipo"]= $_POST["categoriaEquipo"];    
        $this->viewData["descripcionEquipo"]= $_POST["descripcionEquipo"];
        $this->viewData["filialEquipo"]= $_POST["filialEquipo"];


    }
    private function executeAction(){
        switch($this->viewData["mode"]){
            case "INS":
                $inserted = \Dao\Mnt\Inventarios::insert(

                    $this->viewData["inventarioest"],
                    $this->viewData["numInventario"],
                    $this->viewData["nomEquipo"],
                    $this->viewData["categoriaEquipo"],
                    $this->viewData["descripcionEquipo"],
                    $this->viewData["filialEquipo"]
                );
                if($inserted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Equipo añadido Exitosamente"
                    );
                }
                break;
            case "UPD":
                $updated = \Dao\Mnt\Inventarios::update(
                    $this->viewData["id"],
                    $this->viewData["inventarioest"],
                    $this->viewData["numInventario"],
                    $this->viewData["nomEquipo"],
                    $this->viewData["categoriaEquipo"],
                    $this->viewData["descripcionEquipo"],
                    $this->viewData["filialEquipo"]
                );
                if($updated > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Equipo actualizado exitosamente"
                    );
                }
                break;
            case "DEL":
                $deleted = \Dao\Mnt\Inventarios::delete(
                    $this->viewData["id"]
                );
                if($deleted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Equipo Eliminado Exitosamente"
                    );
                }
                break;
        }
    }
    private function render(){
        $xssToken = md5("INVENTARIO" . rand(0,4000) * rand(5000,9999));
        $this-> viewData["xssToken"] = $xssToken;
        $_SESSION["xssToken_Mnt_Inventario"] = $xssToken;

        if($this->viewData["mode"] === "INS") {
            $this->viewData["modedsc"] = $this->modes["INS"];
        } else {
            $tmpInventarios = \Dao\Mnt\Inventarios::findById($this->viewData["id"]);
            if(!$tmpInventarios){
                throw new Exception("Inventarios no existe en DB");
            }
            \Utilities\ArrUtils::mergeFullArrayTo($tmpInventarios, $this->viewData);
            $this->viewData["inventarioest_ACT"] = $this->viewData["inventarioest"] === "ACT" ? "selected": "";
            $this->viewData["inventarioest_DES"] = $this->viewData["inventarioest"] === "DES" ? "selected": "";
            $this->viewData["modedsc"] = sprintf(
                $this->modes[$this->viewData["mode"]],
                $this->viewData["nomEquipo"],
                $this->viewData["id"]     
                
            );
            if(in_array($this->viewData["mode"], array("DSP","DEL"))){
                $this->viewData["readonly"] = "readonly";
                $this->viewData["disabled"] = "disabled";
            }
            if($this->viewData["mode"] === "DSP") {
                $this->viewData["show_action"] = false;
            }
        }
        Renderer::render("mnt/inventario", $this->viewData);
    }

  
}

?>