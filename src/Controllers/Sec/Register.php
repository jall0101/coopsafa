<?php

namespace Controllers\Sec;

use Controllers\PublicController;
use \Utilities\Validators;
use Exception;

class Register extends PublicController
{
    private $txtEmail = "";
    private $execute = "";
    private $txtPswd = "";
    private $errorEmail ="";
    private $errorPswd = "";

    private $txtNombre = "";
    private $txtApellido = "";
    private $txtGender = "";

    private $txtNombreCompleto = "";
    private $txtPhone = "";
    private $hasErrors = false;
    private $generalErrors = array();
    public function run() :void
    {

        if ($this->isPostBack()) {
            $this->txtEmail = $_POST["txtEmail"];
            $this->txtPswd = $_POST["txtPswd"];
            $this->txtNombreCompleto = $_POST["txtNombre"]." ".$_POST["txtApellido"];
            $this->txtGender = $_POST["txtGender"];
            $this->txtPhone = $_POST["txtPhone"];
            //validaciones
            if (!(Validators::IsValidEmail($this->txtEmail))) {
                $this->errorEmail = "El correo no tiene el formato adecuado";
                $this->hasErrors = true;
            }
            if (!Validators::IsValidPassword($this->txtPswd)) {
                $this->errorPswd = "La contraseña debe tener al menos 8 caracteres una mayúscula, un número y un caracter especial.";
                $this->hasErrors = true;
            }
            if (Validators::IsEmpty($this->txtNombreCompleto)) {
                $this->generalErrors[] = "El nombre no puede ir vacío!";
                error_log($this->txtNombreCompleto);
                $this->hasErrors = true;
            }
            if (Validators::IsEmpty($this->txtPhone)) {
                $this->generalErrors[] = "El número no puede ir vacío!";
                $this->hasErrors = true;
            }
            if (!in_array( $this->txtGender, array("F","M"))){
                $this->generalErrors[] = "El género no coincide con las opciones!";
                $this->hasErrors = true;
            }

            if (!$this->hasErrors) {
                try{
                    //AGREGAR TABLA ADMINISTRADOR
                    if (\Dao\Security\Security::newUsuario($this->txtEmail, $this->txtPswd,\Dao\Security\UsuarioTipo::ADMINISTRADOR, $this->txtNombreCompleto)) {
                        $cod = \Dao\Mnt\Usuarios::findLast();
                        error_log($cod["usercod"]);
                        if (\Dao\Mnt\Clientes::insert($this->txtNombreCompleto, $this->txtGender, $this->txtPhone, $this->txtEmail, "ACT", $cod["usercod"])) {
                            \Utilities\Site::redirectToWithMsg("index.php?page=sec_login", "¡Usuario Registrado Satisfactoriamente!");
                        }
                        \Utilities\Site::redirectToWithMsg("index.php?page=sec_login", "¡Usuario Registrado Satisfactoriamente!");

                    }
                } catch (Error $execute){
                    die($execute);
                }
            }
        }
        $viewData = get_object_vars($this);
        \Views\Renderer::render("security/sigin", $viewData);
    }
}
?>
