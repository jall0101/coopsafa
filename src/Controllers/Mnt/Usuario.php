<?php

namespace Controllers\Mnt;
use Controllers\PrivateController;
use Exception;
use Views\Renderer;

class Usuario extends PrivateController
{
    private $redirectTo = "index.php?page=Mnt-Usuarios";

    private $viewData = array(
        "mode" => "DSP",
        "modedsc" => "",
        "usercod" => 0,
        "useremail" => "",
        "username" => "",
        "userpswd" => "",
        "userpswdest" => "ACT",
        "userpswdexp" => "",
        "userest" => "ACT",
        "useractcod" => "",
        "userpswdchg" => "",
        "usertipo" => "NOR",
        "userpswdest_ACT" => "selected",
        "userpswdest_INA" => "",
        "userest_ACT" => "selected",
        "userest_INA" => "",
        "usertipo_NOM" => "selected",
        "usertipo_CON" => "",
        "usertipo_CLI" => "",
        "general_errors" => array(),
        "has_errors" => false,
        "show_action" => true,
        "readonly" => false,
        "xssToken" => "",
    );
    private $modes = array(
        "DSP" => "Detalle de %s (%s)",
        "INS" => "Nuevo Usuario",
        "UPD" => "Editar %s (%s)",
        "DEL" => "Borrar %s (%s)"
    );


    private $modesAuth = array(
        "DSP" => "mnt_usuarios_view",
        "INS" => "mnt_usuarios_new",
        "UPD" => "mnt_usuarios_edit",
        "DEL" => "mnt_usuarios_delete"
    );



    public function run(): void
    {
        try {
            $this->page_loaded();
            if ($this->isPostBack()) {
                $this->validatePostData();
                if (!$this->viewData["has_errors"]) {
                    $this->executeAction();
                }
            }
            $this->render();
        } catch (Exception $error) {
            unset($_SESSION["xssToken_Mnt_Usuario"]);
            error_log(sprintf("Controller/Mnt/Usuario ERROR: %s", $error->getMessage()));
            \Utilities\Site::redirectToWithMsg(
                $this->redirectTo,
                "Algo Inesperado Sucedió. Intente de Nuevo."
            );
        }
    }



    private function page_loaded()
    {
        if (isset($_GET['mode'])) {
            if (isset($this->modes[$_GET['mode']])) {
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
        if ($this->viewData["mode"] !== "INS") {
            if (isset($_GET['usercod'])) {
                $this->viewData["usercod"] = intval($_GET["usercod"]);
            } else {
                throw new Exception("Id not found on Query Params");
            }
        }
    }



    private function validatePostData()
    {
        if (isset($_POST["xssToken"])) {
            if (isset($_SESSION["xssToken_Mnt_Usuario"])) {
                if ($_POST["xssToken"] !== $_SESSION["xssToken_Mnt_Usuario"]) {
                    throw new Exception("Invalid Xss Token no match");
                }
            } else {
                throw new Exception("Invalid xss Token on session");
            }
        } else {
            throw new Exception("Invalid xss Token");
        }
        if (isset($_POST["useremail"])) {
            if (\Utilities\Validators::IsEmpty($_POST["useremail"])) {
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"][] = "El email no puede ir vacío!";
            }
            if (!(\Utilities\Validators::IsValidEmail($_POST["useremail"]))) {
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"][] = "El email no es válido!";
            }
        } else {
            throw new Exception("useremail not present in form");
        }
        if (isset($_POST["username"])) {
            if (\Utilities\Validators::IsEmpty($_POST["username"])) {
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"][] = "El username no puede ir vacío!";
            }
        } else {
            throw new Exception("username not present in form");
        }
        if (isset($_POST["userpswd"])) {
            if (\Utilities\Validators::IsEmpty($_POST["userpswd"])) {
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"][] = "El password no puede ir vacío!";
            }
            if (!(\Utilities\Validators::IsValidPassword($_POST["userpswd"]))) {
                $this->viewData["has_errors"] = true;
                $this->viewData["general_errors"][] = "El password no es válido!";
            }
        } else {
            throw new Exception("userpswd not present in form");
        }
        if (isset($_POST["userpswdest"])) {
            if (!in_array($_POST["userpswdest"], array("ACT", "INA"))) {
                throw new Exception("Password state incorrect value");
            }
        } else {
            if ($this->viewData["mode"] !== "DEL") {
                throw new Exception("userpswdest not present in form");
            }
        }

        if (isset($_POST["userest"])) {
            if (!in_array($_POST["userest"], array("ACT", "INA"))) {
                throw new Exception("User state incorrect value");
            }
        } else {
            if ($this->viewData["mode"] !== "DEL") {
                throw new Exception("userest not present in form");
            }
        }

        if (isset($_POST["usertipo"])) {
            if (!in_array($_POST["usertipo"], array("NOR", "CON", "CLI"))) {
                throw new Exception("User type incorrect value");
            }
        } else {
            if ($this->viewData["mode"] !== "DEL") {
                throw new Exception("usertipo not present in form");
            }
        }
        if (isset($_POST["mode"])) {
            if (!key_exists($_POST["mode"], $this->modes)) {
                throw new Exception("mode has a bad value");
            }
            if ($this->viewData["mode"] !== $_POST["mode"]) {
                throw new Exception("mode value is different from query");
            }
        } else {
            throw new Exception("mode not present in form");
        }
        if (isset($_POST["usercod"])) {
            if (($this->viewData["mode"] !== "INS" && intval($_POST["usercod"]) <= 0)) {
                throw new Exception("usercod is not Valid");
            }
            if ($this->viewData["usercod"] !== intval($_POST["usercod"])) {
                throw new Exception("usercod value is different from query");
            }
        } else {
            throw new Exception("usercod not present in form");
        }
        $this->viewData["useremail"] = $_POST["useremail"];
        $this->viewData["username"] = $_POST["username"];
        $this->viewData["userpswd"] = $_POST["userpswd"];

        if ($this->viewData["mode"] !== "DEL") {
            $this->viewData["userpswdest"] = $_POST["userpswdest"];
        }
        if ($this->viewData["mode"] !== "DEL") {
            $this->viewData["userest"] = $_POST["userest"];
        }
        if ($this->viewData["mode"] !== "DEL") {
            $this->viewData["usertipo"] = $_POST["usertipo"];
        }
    }



    private function executeAction()
    {
        switch ($this->viewData["mode"]) {
            case "INS":
                $inserted = \Dao\Mnt\Usuarios::insert(
                    $this->viewData["useremail"],
                    $this->viewData["username"],
                    $this->viewData["userpswd"],
                    $this->viewData["userpswdest"],
                    $this->viewData["userest"],
                    $this->viewData["usertipo"]
                );
                if ($inserted > 0) {
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Usuario Creado Exitosamente"
                    );
                }
                break;
            case "UPD":
                $updated = \Dao\Mnt\Usuarios::update(
                    $this->viewData["usercod"],
                    $this->viewData["useremail"],
                    $this->viewData["username"],
                    $this->viewData["userpswd"],
                    $this->viewData["userpswdest"],
                    $this->viewData["userest"],
                    $this->viewData["usertipo"]
                );
                if ($updated > 0) {
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Usuario Actualizado Exitosamente"
                    );
                }
                break;
            case "DEL":
                $deleted = \Dao\Mnt\Usuarios::delete(
                    $this->viewData["usercod"]
                );
                if ($deleted > 0) {
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Usuario Eliminado Exitosamente"
                    );
                }
                break;
        }
    }



    private function render()
    {
        $xssToken = md5("Usuario" . rand(0, 4000) * rand(5000, 9999));
        $this->viewData["xssToken"] = $xssToken;
        $_SESSION["xssToken_Mnt_Usuario"] = $xssToken;

        if ($this->viewData["mode"] === "INS") {
            $this->viewData["modedsc"] = $this->modes["INS"];
        } else {
            $tmpUsuarios = \Dao\Mnt\Usuarios::findById($this->viewData["usercod"]);
            if (!$tmpUsuarios) {
                throw new Exception("Usuario no existe en DB");
            }
            \Utilities\ArrUtils::mergeFullArrayTo($tmpUsuarios, $this->viewData);
            $this->viewData["userpswdest_ACT"] = $this->viewData["userpswdest"] === "ACT" ? "selected" : "";
            $this->viewData["userpswdest_INA"] = $this->viewData["userpswdest"] === "INA" ? "selected" : "";
            $this->viewData["userest_ACT"] = $this->viewData["userest"] === "ACT" ? "selected" : "";
            $this->viewData["userest_INA"] = $this->viewData["userest"] === "INA" ? "selected" : "";
            $this->viewData["usertipo_NOR"] = $this->viewData["usertipo"] === "NOR" ? "selected" : "";
            $this->viewData["usertipo_CON"] = $this->viewData["usertipo"] === "CON" ? "selected" : "";
            $this->viewData["usertipo_CLI"] = $this->viewData["usertipo"] === "CLI" ? "selected" : "";
            $this->viewData["modedsc"] = sprintf(
                $this->modes[$this->viewData["mode"]],
                $this->viewData["username"],
                $this->viewData["usercod"]
            );
            if (in_array($this->viewData["mode"], array("DSP", "DEL"))) {
                $this->viewData["readonly"] = "readonly";
            }
            if ($this->viewData["mode"] === "DSP") {
                $this->viewData["show_action"] = false;
            }
        }
        Renderer::render("mnt/usuario", $this->viewData);
    }
}
?>