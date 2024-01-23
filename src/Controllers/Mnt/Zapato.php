<?php
namespace Controllers\Mnt;

use Controllers\PrivateController;
use Exception;
use Views\Renderer;

class Zapato extends PrivateController{
    private $redirectTo = "index.php?page=Mnt-Zapatos";
        
    private $viewData = array(
        "mode" => "DSP",
        "modedsc" => "",
        "zapatocod" => 0,
        "marcacod" => 0,
        "departamentocod" => 0,
        "precio" => 0,
        "zapatoest" => "ACT",
        "zapatoest_ACT" =>"selected",
        "zapatoest_DES" => "",
        "imagenzapato" => "",
        "color" => "", 
        "verificarImagen"=> "",
        "descripcion" => "",        
        "detalles" => "",
        "nombrezapato" => "",
        "general_errors"=> array(),
        "has_errors" =>false,
        "show_action" => true,
        "readonly" => false,
        "xssToken" => "",
        "disabled" => false
    );
    private $modes = array(
        "DSP" => "Detalle de %s (%s)",
        "INS" => "Nuevo Zapato",
        "UPD" => "Editar %s (%s)",
        "DEL" => "Borrar %s (%s)"
    );

    private $modesAuth = array(
        "DSP" => "mnt_zapatos_view",
        "INS" => "mnt_zapatos_new",
        "UPD" => "mnt_zapatos_edit",
        "DEL" => "mnt_zapatos_delete"
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
            unset($_SESSION["xssToken_Mnt_Zapato"]);
            error_log(sprintf("Controller/Mnt/Zapato ERROR: %s", $error->getMessage()));
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
            if(isset($_GET['zapatocod'])){
                $this->viewData["zapatocod"] = intval($_GET["zapatocod"]);
            } else {
                throw new Exception("Id not found on Query Params");
            }
        }
    }
    private function validatePostData(){
        if(isset($_POST["xssToken"])){
            if(isset($_SESSION["xssToken_Mnt_Zapato"])){
                if($_POST["xssToken"] !== $_SESSION["xssToken_Mnt_Zapato"]){
                    throw new Exception("Invalid Xss Token no match");
                }
            } else {
                throw new Exception("Invalid xss Token on session");
            }
        } else {
            throw new Exception("Invalid xss Token");
        }        
        if(isset($_POST["marcacod"])){
            if(\Utilities\Validators::IsEmpty($_POST["marcacod"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "La marca no puede ir vacía!";
            }
        } else {
            throw new Exception("marcacod not present in form");
        }
        if(isset($_POST["departamentocod"])){
            if(\Utilities\Validators::IsEmpty($_POST["departamentocod"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "El departamento no puede ir vacío!";
            }
        } else {
            throw new Exception("departamentocod not present in form");
        }
        if(isset($_POST["precio"])){
            if(\Utilities\Validators::IsEmpty($_POST["precio"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "El precio no puede ir vacío!";
            }
        } else {
            throw new Exception("precio not present in form");
        }
        
        if(isset($_POST["color"])){
            if(\Utilities\Validators::IsEmpty($_POST["color"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "El color no puede ir vacío!";
            }
        } else {
            throw new Exception("color not present in form");
        }

        if(isset($_POST["descripcion"])){
            if(\Utilities\Validators::IsEmpty($_POST["descripcion"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "La descripcion no puede ir vacío!";
            }
        } else {
            throw new Exception("descripcion not present in form");
        }

        if(isset($_POST["detalles"])){
            if(\Utilities\Validators::IsEmpty($_POST["detalles"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "El campo detalles no puede ir vacío!";
            }
        } else {
            throw new Exception("detalles not present in form");
        }

        if(isset($_POST["nombrezapato"])){
            if(\Utilities\Validators::IsEmpty($_POST["nombrezapato"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"] = "El campo nombrezapato no puede ir vacío!";
            }
        } else {
            throw new Exception("nombrezapato not present in form");
        }

        if(isset($_POST["zapatoest"])){
            if (!in_array( $_POST["zapatoest"], array("ACT","DES"))){
                throw new Exception("zapato state incorrect value");
            }
        }else {
            if($this->viewData["mode"]!=="DEL") {
                throw new Exception("zapatoest not present in form");
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

        if(isset($_POST["zapatocod"])){
            if(($this->viewData["mode"] !== "INS" && intval($_POST["zapatocod"])<=0)){
                throw new Exception("zapatocod is not Valid");
            }
            if($this->viewData["zapatocod"]!== intval($_POST["zapatocod"])){
                throw new Exception("zapatocod value is different from query");
            }
        }else {
            throw new Exception("zapatocod not present in form");
        }

        $this->viewData["marcacod"] = $_POST["marcacod"];
        $this->viewData["departamentocod"]= $_POST["departamentocod"];
        $this->viewData["precio"]= $_POST["precio"];    
        $this->viewData["color"]= $_POST["color"];
        $this->viewData["descripcion"]= $_POST["descripcion"];
        $this->viewData["detalles"]= $_POST["detalles"];
        $this->viewData["nombrezapato"]= $_POST["nombrezapato"];

        if($this->viewData["mode"] !== "INS"){
            $error = $_FILES["imagenzapato"]["error"];
            if($error !== 0){
                error_log("aqui-----------------------------1------------");
                $this->viewData["imagenzapato"] = $_POST["verificarImagen"];
            } else{
                error_log("aqui-----------------------------2------------");

                $this->eliminarImagen($_POST["verificarImagen"]);
                $this->ingresarImagen();

            }
        } else{
            error_log("aqui-----------------------------3------------");

           $this->ingresarImagen();
        }
        

    }
    private function executeAction(){
        switch($this->viewData["mode"]){
            case "INS":
                $inserted = \Dao\Mnt\Zapatos::insert(
                    $this->viewData["marcacod"],
                    $this->viewData["departamentocod"],
                    $this->viewData["precio"],
                    $this->viewData["zapatoest"],
                    $this->viewData["imagenzapato"],
                    $this->viewData["color"],
                    $this->viewData["descripcion"],
                    $this->viewData["detalles"],
                    $this->viewData["nombrezapato"]
                );
                if($inserted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Zapato añadido Exitosamente"
                    );
                }
                break;
            case "UPD":
                $updated = \Dao\Mnt\Zapatos::update(
                    $this->viewData["zapatocod"],
                    $this->viewData["marcacod"],
                    $this->viewData["departamentocod"],
                    floatval($this->viewData["precio"]),
                    $this->viewData["zapatoest"],
                    $this->viewData["imagenzapato"],
                    $this->viewData["color"],
                    $this->viewData["descripcion"],
                    $this->viewData["detalles"],
                    $this->viewData["nombrezapato"],
                    
                );
                if($updated > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Zapato Actualizado Exitosamente"
                    );
                }
                break;
            case "DEL":
                $this->eliminarImagen($this->viewData["imagenzapato"]);
                $deleted = \Dao\Mnt\Zapatos::delete(
                    $this->viewData["zapatocod"]
                );
                if($deleted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Zapato Eliminado Exitosamente"
                    );
                }
                break;
        }
    }
    private function render(){
        $xssToken = md5("ZAPATO" . rand(0,4000) * rand(5000,9999));
        $this-> viewData["xssToken"] = $xssToken;
        $_SESSION["xssToken_Mnt_Zapato"] = $xssToken;

        if($this->viewData["mode"] === "INS") {
            $this->viewData["modedsc"] = $this->modes["INS"];
        } else {
            $tmpZapatos = \Dao\Mnt\Zapatos::findById($this->viewData["zapatocod"]);
            if(!$tmpZapatos){
                throw new Exception("Zapatos no existe en DB");
            }
            \Utilities\ArrUtils::mergeFullArrayTo($tmpZapatos, $this->viewData);
            $this->viewData["zapatoest_ACT"] = $this->viewData["zapatoest"] === "ACT" ? "selected": "";
            $this->viewData["zapatoest_DES"] = $this->viewData["zapatoest"] === "DES" ? "selected": "";
            $this->viewData["modedsc"] = sprintf(
                $this->modes[$this->viewData["mode"]],
                $this->viewData["nombrezapato"],
                $this->viewData["zapatocod"]     
                
            );
            if(in_array($this->viewData["mode"], array("DSP","DEL"))){
                $this->viewData["readonly"] = "readonly";
                $this->viewData["disabled"] = "disabled";
            }
            if($this->viewData["mode"] === "DSP") {
                $this->viewData["show_action"] = false;
            }
        }
        Renderer::render("mnt/zapato", $this->viewData);
    }

    private function ingresarImagen(){
        if(isset($_FILES["imagenzapato"])){
            $img_name = $_FILES["imagenzapato"]["name"];
            $img_size = $_FILES["imagenzapato"]["size"];
            $tmp_name = $_FILES["imagenzapato"]["tmp_name"];
            $error = $_FILES["imagenzapato"]["error"];

            if($error === 0){
                if($img_size > 300000){
                    $this->viewData["has_errors"] = true;
                    $this->viewData["general_errors"] = "La imagen es muy grande!";
                } else{
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);
                    $allowed_exs = array("jpg","jpeg","png","webp");

                    if(in_array($img_ex_lc, $allowed_exs)){
                        $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                        $img_upload_path = "public/imgs/uploads/".$new_img_name;
                        move_uploaded_file($tmp_name,$img_upload_path);

                        $this->viewData["imagenzapato"] = $new_img_name;
                    } else {
                        $this->viewData["has_errors"] = true;
                        $this->viewData["general_errors"] = "El formato de imagen no es permitido!";
                    }
                }

            }else{
                
                throw new Exception("error en la imagen");
            }
        }
    }

    

    private function eliminarImagen($nombre){
        $path = "public/imgs/uploads/".$nombre;
        unlink($path);
    }
}

?>