<?php
namespace Controllers\Mnt;

use Controllers\PublicController;
use Exception;
use Views\Renderer;

class Cliente extends PublicController{
    private $redirectTo = "index.php?page=Mnt-Clientes";
    private $viewData = array(
        "mode" => "DSP",
        "modedsc" => "",
        "clientid" => 0,
        "clientname" => "",
        "clientgender" => "MAS",
        "clientgender_M" =>"selected",
        "clientgender_F" => "",
        "clientphone1" => "",
        "clientphone2" => "",
        "clientemail" => "",
        "clientIdnumber" => "",
        "clientbio" => "",
        "clientstatus" => "ACT",       
        "clientstatus_ACT" => "selected",
        "clientstatus_INA" => "",        
        "general_errors"=> array(),
        "has_errors" =>false,
        "show_action" => true,
        "readonly" => false,
        "xssToken" => ""
    );
    private $modes = array(
        "DSP" => "Detalle de %s (%s)",
        "INS" => "Nuevo Cliente",
        "UPD" => "Editar %s (%s)",
        "DEL" => "Borrar %s (%s)"
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
            unset($_SESSION["xssToken_Mnt_Cliente"]);
            error_log(sprintf("Controller/Mnt/Cliente ERROR: %s", $error->getMessage()));
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
            if(isset($_GET['clientid'])){
                $this->viewData["clientid"] = intval($_GET["clientid"]);
            } else {
                throw new Exception("Id not found on Query Params");
            }
        }
    }
    private function validatePostData(){
        if(isset($_POST["xssToken"])){
            if(isset($_SESSION["xssToken_Mnt_Cliente"])){
                if($_POST["xssToken"] !== $_SESSION["xssToken_Mnt_Cliente"]){
                    throw new Exception("Invalid Xss Token no match");
                }
            } else {
                throw new Exception("Invalid xss Token on session");
            }
        } else {
            throw new Exception("Invalid xss Token");
        }
        if(isset($_POST["clientname"])){
            if(\Utilities\Validators::IsEmpty($_POST["clientname"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"][] = "Name can't be empty!";
            }
        } else {
            throw new Exception("ClientName not present in form");
        }
        if(isset($_POST["clientgender"])){
            if (!in_array( $_POST["clientgender"], array("MAS","FEM"))){
                throw new Exception("clientgender incorrect value");
            }
        }else {
            if($this->viewData["mode"]!=="DEL") {
                throw new Exception("clientegender not present in form");
            }
        }
        if(isset($_POST["clientphone1"])){
            if(\Utilities\Validators::IsEmpty($_POST["clientphone1"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"][] = "Phone 1 can't be empty!";
            }
            if(!(\Utilities\Validators::IsPhoneNumber($_POST["clientphone1"],8,14))){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"][] = "Phone 1 only accepts digits!";
            }
        } else {
            throw new Exception("clientphone1 not present in form");
        }
        if(isset($_POST["clientphone2"])){
            if(\Utilities\Validators::IsEmpty($_POST["clientphone2"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"][] = "Phone 2 can't be empty!";
            }
            if(!(\Utilities\Validators::IsPhoneNumber($_POST["clientphone2"],8,14))){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"][] = "Phone 2 only accepts digits!";
            }
        } else {
            throw new Exception("clientphone2 not present in form");
        }
        if(isset($_POST["clientemail"])){
            if(\Utilities\Validators::IsEmpty($_POST["clientemail"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"][] = "Email can't be empty!";
            }
            if(!(\Utilities\Validators::IsValidEmail($_POST["clientemail"]))){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"][] = "Invalid Email";
            }
        } else {
            throw new Exception("Email not present in form");
        }
        if(isset($_POST["clientIdnumber"])){
            if(\Utilities\Validators::IsEmpty($_POST["clientIdnumber"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"][] = "IDNumber can't be empty!";
            }
            if(!(\Utilities\Validators::onlyNumbers($_POST["clientIdnumber"]))){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"][] = "Invalid IDNumber";
            }
        } else {
            throw new Exception("IIDNumber not present in form");
        }
        if(isset($_POST["clientbio"])){
            if(\Utilities\Validators::IsEmpty($_POST["clientbio"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"][] = "Bio can't be empty!";
            }            
        } else {
            throw new Exception("Bio not present in form");
        }
        if(isset($_POST["clientstatus"])){
            if (!in_array( $_POST["clientstatus"], array("ACT","INA"))){
                throw new Exception("Client Status incorrect value");
            }
        }else {
            if($this->viewData["mode"]!=="DEL") {
                throw new Exception("Client Status not present in form");
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
        if(isset($_POST["clientid"])){
            if(($this->viewData["mode"] !== "INS" && intval($_POST["clientid"])<=0)){
                throw new Exception("clientId is not Valid");
            }
            if($this->viewData["clientid"]!== intval($_POST["clientid"])){
                throw new Exception("clientId value is different from query");
            }
        }else {
            throw new Exception("clientId not present in form");
        }
        $this->viewData["clientname"] = $_POST["clientname"];
        $this->viewData["clientphone1"] = $_POST["clientphone1"];
        $this->viewData["clientphone2"] = $_POST["clientphone2"];
        $this->viewData["clientemail"] = $_POST["clientemail"];
        $this->viewData["clientIdnumber"] = $_POST["clientIdnumber"];
        $this->viewData["clientbio"] = $_POST["clientbio"];
        if($this->viewData["mode"]!=="DEL"){
            $this->viewData["clientgender"] = $_POST["clientgender"];
            $this->viewData["clientstatus"] = $_POST["clientstatus"];
        }
    }
    private function executeAction(){
        switch($this->viewData["mode"]){
            case "INS":
                $inserted = \Dao\Mnt\Clientes::insert(
                    $this->viewData["clientname"],
                    $this->viewData["clientgender"],
                    $this->viewData["clientphone1"],
                    $this->viewData["clientphone2"],
                    $this->viewData["clientemail"],
                    $this->viewData["clientIdnumber"],
                    $this->viewData["clientbio"],
                    $this->viewData["clientstatus"]

                );
                if($inserted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Cliente Creado Exitosamente"
                    );
                }
                break;
            case "UPD":
                $updated = \Dao\Mnt\Clientes::update(
                    $this->viewData["clientid"],
                    $this->viewData["clientname"],
                    $this->viewData["clientgender"],
                    $this->viewData["clientphone1"],
                    $this->viewData["clientphone2"],
                    $this->viewData["clientemail"],
                    $this->viewData["clientIdnumber"],
                    $this->viewData["clientbio"],
                    $this->viewData["clientstatus"]
                );
                if($updated > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Cliente Actualizado Exitosamente"
                    );
                }
                break;
            case "DEL":
                $deleted = \Dao\Mnt\Clientes::delete(
                    $this->viewData["clientid"]
                );
                if($deleted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Cliente Eliminado Exitosamente"
                    );
                }
                break;
        }
    }
    private function render(){
        $xssToken = md5("CLIENTE" . rand(0,4000) * rand(5000,9999));
        $this-> viewData["xssToken"] = $xssToken;
        $_SESSION["xssToken_Mnt_Cliente"] = $xssToken;

        if($this->viewData["mode"] === "INS") {
            $this->viewData["modedsc"] = $this->modes["INS"];
        } else {
            $tmpClientes = \Dao\Mnt\Clientes::findById($this->viewData["clientid"]);
            if(!$tmpClientes){
                throw new Exception("Cliente no existe en DB");
            }
            
            \Utilities\ArrUtils::mergeFullArrayTo($tmpClientes, $this->viewData);
            $this->viewData["clientgender_M"] = $this->viewData["clientgender"] === "MAS" ? "selected": "";
            $this->viewData["clientgender_F"] = $this->viewData["clientgender"] === "FEM" ? "selected": "";
            $this->viewData["modedsc"] = sprintf(
                $this->modes[$this->viewData["mode"]],
                $this->viewData["clientname"],
                $this->viewData["clientid"]
            );
            if(in_array($this->viewData["mode"], array("DSP","DEL"))){
                $this->viewData["readonly"] = "readonly";
            }
            if($this->viewData["mode"] === "DSP") {
                $this->viewData["show_action"] = false;
            }
        }
        Renderer::render("mnt/cliente", $this->viewData);
    }
}

?>