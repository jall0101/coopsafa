<?php
namespace Controllers\Admin;

class Admin extends \Controllers\PrivateController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }
    /** 
     * Ejecuta el controlador
     */
    public function run() :void
    {
        $viewData = array();
        $userID = \Utilities\Security::getUserId();

        //SEGURIDAD DE ROLES Y USUARIOS
        $viewData["menu_usuarios"] = \Utilities\Security::isAuthorized($userID, "Menu_MntUsuarios");
        $viewData["menu_roles"] = \Utilities\Security::isAuthorized($userID, "Menu_MntRoles");
        $viewData["menu_funciones"] = \Utilities\Security::isAuthorized($userID, "Menu_MntFunciones");
        $viewData["menu_rolesUsuarios"] = \Utilities\Security::isAuthorized($userID, "Menu_MntRolesUsuarios");
        $viewData["menu_funcionesRoles"] = \Utilities\Security::isAuthorized($userID, "Menu_MntFuncionesRoles");

        //MANTENIMIENTO DE APARTADOS
        $viewData["menu_zapatos"] = \Utilities\Security::isAuthorized($userID, "Menu_MntZapatos");
        $viewData["menu_inventarios"] = \Utilities\Security::isAuthorized($userID, "Menu_MntInventarios");
        $viewData["menu_gestiones"] = \Utilities\Security::isAuthorized($userID, "Menu_MntGestiones");
        $viewData["menu_marcas"] = \Utilities\Security::isAuthorized($userID, "Menu_MntMarcas");;
        $viewData["menu_depart"] = \Utilities\Security::isAuthorized($userID, "Menu_MntDepartamentos");
        $viewData["menu_asignados"] = \Utilities\Security::isAuthorized($userID, "Menu_MntAsignados");
        $viewData["menu_filiales"] = \Utilities\Security::isAuthorized($userID, "Menu_MntFiliales");

       
        \Views\Renderer::render("admin/admin", $viewData);
    }
}
?>
