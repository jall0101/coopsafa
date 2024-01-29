<?php



namespace Controllers\Mnt;
use Controllers\PrivateController;
use Controllers\PublicController;
use Exception;
use Views\Renderer;

class FuncionRol extends PrivateController{
    private $redirectTo = "index.php?page=Mnt-FuncionesRoles";
    private $viewData = array(
        "mode" => "DSP",
        "modedsc" => "",
        "rolescod" => "",
        "fncod" => "",
        "fnroest" => "ACT",        
        "fnroest_ACT" => "selected",
        "fnroest_INA" => "",
        "fnexp" => "",
        "general_errors"=> array(),    
        "fnroest_ACT_errors"=> array(),
        "fnroest_INA_errors"=> array(),
        "has_errors" =>false,
        "show_action" => true,
        "readonly" => false,
        "readonly_edit" => false,
        "xssToken" => "",
        "rolescoddummy" => "",
        "fncoddummy" => ""
    );
    private $modes = array(
        "DSP" => "Detalle de %s (%s)",
        "INS" => "Nuevo Función-Rol",
        "UPD" => "Editar %s (%s)",
        "DEL" => "Borrar %s (%s)"
    );

    private $modesAuth = array(
        "DSP" => "mnt_funcionesroles_view",
        "INS" => "mnt_funcionesroles_new",
        "UPD" => "mnt_funcionesroles_edit",
        "DEL" => "mnt_funcionesroles_delete"
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
            unset($_SESSION["xssToken_Mnt_FuncionRol"]);
            error_log(sprintf("Controller/Mnt/FuncionRol ERROR: %s", $error->getMessage()));
            \Utilities\Site::redirectToWithMsg(
                $this->redirectTo,
                "Algo Inesperado Sucedió. Intente de Nuevo :("
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
            if(isset($_GET['rolescod'])){
                $this->viewData["rolescod"] = $_GET["rolescod"];
            } else {
                throw new Exception("rolescod not found on Query Params");
            }
            if(isset($_GET['fncod'])){
                $this->viewData["fncod"] = $_GET["fncod"];
            } else {
                throw new Exception("fncod not found on Query Params");
            }
        }
    }



    private function validatePostData(){
        if(isset($_POST["xssToken"])){
            if(isset($_SESSION["xssToken_Mnt_FuncionRol"])){
                if($_POST["xssToken"] !== $_SESSION["xssToken_Mnt_FuncionRol"]){
                    throw new Exception("Invalid Xss Token no match");
                }
            } else {
                throw new Exception("Invalid xss Token on session");
            }
        } else {
            throw new Exception("Invalid xss Token");
        }




        if(isset($_POST["fnrolest"])){
            if (!in_array( $_POST["fnrolest"], array("ACT","INA"))){
                throw new Exception("fnrolest incorrect value");
            }
        }else {
            if($this->viewData["mode"]!=="DEL") {
                throw new Exception("fnrolest not present in form");
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
        if(isset($_POST["rolescod"])){            
            if($this->viewData["rolescod"]!== $_POST["rolescod"] && $this->viewData["mode"] !== "INS"){
                throw new Exception("rolescod value is different from query");
            }
        }else {
            throw new Exception("rolescod not present in form");
        }
        if(isset($_POST["fncod"])){            
            if($this->viewData["fncod"]!== $_POST["fncod"] && $this->viewData["mode"] !== "INS"){
                throw new Exception("fncod value is different from query");
            }
        }else {
            throw new Exception("fncod not present in form");
        }
        $this->viewData["fnexp"] = $_POST["fnexp"];
        if($this->viewData["mode"] === "INS"){
            $this->viewData["rolescod"] = $_POST["rolescoddummy"];
            $this->viewData["fncod"] = $_POST["fncoddummy"];
        }         
        if($this->viewData["mode"]!=="DEL"){
            $this->viewData["fnrolest"] = $_POST["fnrolest"];
        }
    }



    private function executeAction(){
        switch($this->viewData["mode"]){
            case "INS":
                $inserted = \Dao\Mnt\FuncionesRoles::insert(
                    $this->viewData["rolescod"],
                    $this->viewData["fncod"],
                    $this->viewData["fnrolest"],
                    $this->viewData["fnexp"]                 
                );
                if($inserted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "FuncionRol Creado Exitosamente"
                    );
                }
                break;
            case "UPD":
                $updated = \Dao\Mnt\FuncionesRoles::update(
                    $this->viewData["rolescod"],
                    $this->viewData["fncod"],
                    $this->viewData["fnrolest"],
                    $this->viewData["fnexp"]
                );
                if($updated > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "FuncionRol Actualizado Exitosamente"
                    );
                }
                break;
            case "DEL":
                $deleted = \Dao\Mnt\FuncionesRoles::delete(
                    $this->viewData["rolescod"],
                    $this->viewData["fncod"]
                );
                if($deleted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "FuncionRol Eliminado Exitosamente"
                    );
                }
                break;
        }
    }



    private function render(){
        $xssToken = md5("FUNCIONROL" . rand(0,4000) * rand(5000,9999));
        $this-> viewData["xssToken"] = $xssToken;
        $_SESSION["xssToken_Mnt_FuncionRol"] = $xssToken;

        if($this->viewData["mode"] === "INS") {
            $this->viewData["modedsc"] = $this->modes["INS"];
        } else {
            $tmpFuncionesRoles = \Dao\Mnt\FuncionesRoles::findById(
                $this->viewData["rolescod"],
                $this->viewData["fncod"]);
            if(!$tmpFuncionesRoles){
                throw new Exception("FuncionRol no existe en DB");
            }
            \Utilities\ArrUtils::mergeFullArrayTo($tmpFuncionesRoles, $this->viewData);
            $this->viewData["fnrolest_ACT"] = $this->viewData["fnrolest"] === "ACT" ? "selected": "";
            $this->viewData["fnrolest_INA"] = $this->viewData["fnrolest"] === "INA" ? "selected": "";
            $this->viewData["modedsc"] = sprintf(
                $this->modes[$this->viewData["mode"]],
                $this->viewData["fncod"],
                $this->viewData["rolescod"]
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
        Renderer::render("mnt/funcionrol", $this->viewData);
    }
}

?>