<?php
namespace Controllers\Mnt;

use Controllers\PrivateController;
use Exception;
use Views\Renderer;
/*
/*
CREATE TABLE `roles_usuarios` (
  `usercod` bigint(10) NOT NULL,
  `rolescod` varchar(15) NOT NULL,
  `roleuserest` char(3) DEFAULT NULL,
  `roleuserfch` datetime DEFAULT NULL,
  `roleuserexp` datetime DEFAULT NULL,
*/

class RolesUsuario extends PrivateController{
    private $redirectTo = "index.php?page=Mnt-RolesUsuarios";
    private $viewData = array(
        "mode" => "DSP",
        "modedsc" => "",
        "usercod" => 0,
        "rolescod" => "",
        "roleuserest" => "DSP",          
        "roleuserexp" => "",      
        "general_errors"=> array(),
        "has_errors" =>false,
        "show_action" => true,
        "readonly" => false,
        "readonly_edit" => false,
        "xssToken" => ""
    );
    private $modes = array(
        "DSP" => "Detalle de %s (%s)",
        "INS" => "Nuevo Rol-Usuario",
        "UPD" => "Editar %s (%s)",
        "DEL" => "Eliminar %s (%s)"

    );
    private $modesAuth = array(
        "DSP" => "mnt_rolesUsuarios_view",
        "INS" => "mnt_rolesUsuarios_new",
        "UPD" => "mnt_rolesUsuarios_edit",
        "DEL" => "mnt_rolesUsuarios_delete"
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
            unset($_SESSION["xssToken_Mnt_RolesUsuarios"]);
            error_log(sprintf("Controller/Mnt/RolesUsuario ERROR: %s", $error->getMessage()));
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
            if(isset($_GET['usercod'])){
                $this->viewData["usercod"] = $_GET["usercod"];
            } else {
                throw new Exception("usercod not found on Query Params");
            }
            if(isset($_GET['rolescod'])){
                $this->viewData["rolescod"] = $_GET["rolescod"];
            } else {
                throw new Exception("rolescod not found on Query Params");
            }
        }
    }
    private function validatePostData(){
        if(isset($_POST["xssToken"])){
            if(isset($_SESSION["xssToken_Mnt_RolesUsuarios"])){
                if($_POST["xssToken"] !== $_SESSION["xssToken_Mnt_RolesUsuarios"]){
                    throw new Exception("Invalid Xss Token no match");
                }
            } else {
                throw new Exception("Invalid xss Token on session");
            }
        } else {
            throw new Exception("Invalid xss Token");
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
        if(isset($_POST["usercod"])){            
            if($this->viewData["usercod"]!== $_POST["usercod"] && $this->viewData["mode"] !== "INS"){
                throw new Exception("usercod value is different from query");
            }
        }else {
            throw new Exception("usercod not present in form");
        }
        if(isset($_POST["rolescod"])){            
            if($this->viewData["rolescod"]!== $_POST["rolescod"] && $this->viewData["mode"] !== "INS"){
                throw new Exception("rolescod value is different from query");
            }
        }else {
            throw new Exception("rolescod not present in form");
        }
        if($this->viewData["mode"] === "INS"){
            $this->viewData["usercod"] = $_POST["usercoddummy"];   
            $this->viewData["rolescod"] = $_POST["rolescoddummy"];       
            
        }     
        
        $this->viewData["roleuserexp"] = $_POST["roleuserexp"];
        if($this->viewData["mode"]!=="DEL"){
            $this->viewData["roleuserest"] = $_POST["roleuserest"];
        }
    }
    private function executeAction(){
        switch($this->viewData["mode"]){
            case "INS":
                $inserted = \Dao\Mnt\RolesUsuarios::insert(
                    $this->viewData["usercod"],
                    $this->viewData["rolescod"],
                    $this->viewData["roleuserest"],
                    $this->viewData["roleuserexp"]                    
                );
                if($inserted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Rol-Usuario Creado Exitosamente"
                    );
                }
                break;
            case "UPD":
                $updated = \Dao\Mnt\RolesUsuarios::update(
                    $this->viewData["usercod"],
                    $this->viewData["rolescod"],
                    $this->viewData["roleuserest"],
                    $this->viewData["roleuserexp"]       
                );
                if($updated > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Rol-Usuario Actualizado Exitosamente"
                    );
                }
            case "DEL":
                $deleted = \Dao\Mnt\RolesUsuarios::delete(
                    $this->viewData["usercod"],
                    $this->viewData["rolescod"]     
                );
                if($deleted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Rol-Usuario Eliminado Exitosamente"
                    );
                }
    }
}
    private function render(){
        $xssToken = md5("ROLES_USUARIO" . rand(0,4000) * rand(5000,9999));
        $this-> viewData["xssToken"] = $xssToken;
        $_SESSION["xssToken_Mnt_RolesUsuarios"] = $xssToken;

        if($this->viewData["mode"] === "INS") {
            $this->viewData["modedsc"] = $this->modes["INS"];
        } else {
            $tmpRoles = \Dao\Mnt\RolesUsuarios::findById($this->viewData["usercod"],$this->viewData["rolescod"]);
            if(!$tmpRoles){
                throw new Exception("Usuario-Rol no existe en DB");
            }
            \Utilities\ArrUtils::mergeFullArrayTo($tmpRoles, $this->viewData);
            $this->viewData["roleuserest_ACT"] = $this->viewData["roleuserest"] === "ACT" ? "selected": "";
            $this->viewData["roleuserest_INA"] = $this->viewData["roleuserest"] === "INA" ? "selected": "";
            $this->viewData["modedsc"] = sprintf(
                $this->modes[$this->viewData["mode"]],
                $this->viewData["rolescod"],
                $this->viewData["usercod"]                
            );
            if($this->viewData["mode"] === "DSP") {
                $this->viewData["show_action"] = false;
            }
            if($this->viewData["mode"] === "UPD"){
                $this->viewData["readonly_edit"] = "readonly";
            }
        }
        Renderer::render("mnt/rolesUsuario", $this->viewData);
    }
}

?>