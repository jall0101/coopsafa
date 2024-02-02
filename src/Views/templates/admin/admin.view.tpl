<!--***********************************************************-->
<!--ESTA ES LA PÁGINA DE INICIO DEL PROGRAMA PARA ADMINISTRADOR-->
<!--***********************************************************-->



  <!--APARTADO DE EQUIPOS-->
<div class="container-fluid">
  <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb m-4">
      <li class="breadcrumb-item"><a href="#" class="text-dark">Admin</a></li>
      <li class="breadcrumb-item active" aria-current="page">Equipos </li>
    </ol>
  </nav>
  <!--TITULO DEL APARTADO DE EQUIPOS-->
  <h1 class="m-4">EQUIPOS</h1>
  

  <div class="container-fluid">
    <div class="row gy-4 gx-4">


      <!--INVENTARIO-->
      {{if ~menu_inventarios}}
      <button type="button" class="btn btn-outline-secondary p-5 col-md-3 offset-sm-1">
        <i class="fa-solid fa-warehouse fa-2xl" style="color: #000000;"></i><br><br>
        <a href="index.php?page=mnt_inventarios" class="text-decoration-none text-dark">INVENTARIO</a>
      </button>
      {{endif ~menu_inventarios}}

      

      <!--ENTRADAS Y SALIDAS-->
      {{if ~menu_gestiones}}
      <button type="button" class="btn btn-outline-secondary p-5 col-md-3 offset-sm-1">
        <i class="fa-solid fa-truck-ramp-box fa-2xl" style="color: #000000;"></i><br><br>
        <a href="index.php?page=mnt_gestiones" class="text-decoration-none text-dark">ENTRADAS Y SALIDAS</a>
      </button>
      {{endif ~menu_gestiones}}

      

      <!--MARCAS-->
      {{if ~menu_marcas}}
      <button type="button" class="btn btn-outline-secondary p-5 col-md-3 offset-sm-1">
        <i class="fa-solid fa-tag fa-2xl" style="color: #000000;"></i><br><br>
        <a href="index.php?page=mnt_marcas"  class="text-decoration-none text-dark">MARCAS</a>
      </button>
      {{endif ~menu_marcas}}




      <!--ASIGNADOS-->
      {{if ~menu_asignados}}
      <button type="button" class="btn btn-outline-secondary p-5 col-md-3 offset-sm-1">
        <i class="fa-solid fa-circle-user fa-2xl" style="color: #000000;"></i><br><br>
        <a href="index.php?page=mnt_asignados"  class="text-decoration-none text-dark">ASIGNADOS</a>
      </button>
      {{endif ~menu_asignados}}



      <!--FILIALES-->
      {{if ~menu_filiales}}
      <button type="button" class="btn btn-outline-secondary p-5 col-md-3 offset-sm-1">
        <i class="fa-solid fa-house fa-2x1" style="color: #000000;"></i><br><br>
        <a href="index.php?page=mnt_filiales"  class="text-decoration-none text-dark">FILIALES</a>
      </button>
      {{endif ~menu_filiales}}




      {{if ~menu_depart}}
      <button type="button" class="btn btn-outline-secondary p-5 col-md-3 offset-sm-1">
        <i class="fa-solid fa-briefcase fa-2xl" style="color: #000000;"></i><br><br>
        <a href="index.php?page=mnt_departamentos"  class="text-decoration-none text-dark">DEPARTAMENTOS</a>
      </button>
      {{endif ~menu_depart}}
    </div>
  </div>
</div>

  <!--APARTADO DE SEGURIDAD Y PERMISOS-->
<div class="container-fluid">
  <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb m-4">
      <li class="breadcrumb-item"><a href="#" class="text-dark">Admin</a></li>
      <li class="breadcrumb-item active" aria-current="page">Seguridad y Permisos</li>
    </ol>
  </nav>

  
  <!--TITULO DEL APARTADO DE EQUIPOS-->
  <h1 class="m-4">SEGURIDAD Y PERMISOS</h1>
  
  <div class="container-fluid">
    <div class="row gy-4 gx-4">
      <!--USUARIOS-->
        {{if ~menu_usuarios}}
        <button type="button" class="btn btn-outline-secondary p-5 col-md-3 offset-sm-1">
          <i class="fa-regular fa-user fa-2xl" style="color: #000000;"></i> <br><br>
          <a href="index.php?page=mnt_usuarios" class="text-decoration-none text-dark">USUARIOS</a>
        </button>
        {{endif ~menu_usuarios}}


        <!--ROLES-->
        {{if ~menu_roles}}
        <button type="button" class="btn btn-outline-secondary p-5 col-md-3 offset-sm-1">
          <i class="fa-solid fa-table-list fa-2xl" style="color: #000000;"></i><br><br>
          <a href="index.php?page=mnt_roles"  class="text-decoration-none text-dark">ROLES</a>
        </button>
        {{endif ~menu_roles}}


        <!--FUNCIONES-->
        {{if ~menu_funciones}}
        <button type="button" class="btn btn-outline-secondary p-5 col-md-3 offset-sm-1">
          <i class="fa-solid fa-list-check fa-2xl" style="color: #000000;"></i><br><br>
          <a href="index.php?page=mnt_funciones"  class="text-decoration-none text-dark">FUNCIONES</a>
        </button>
        {{endif ~menu_funciones}}


        <!--ROLES USUARIOS-->
        {{if ~menu_rolesUsuarios}}
        <button type="button" class="btn btn-outline-secondary p-5 col-md-3 offset-sm-1">
          <i class="fa-solid fa-users-gear fa-2xl" style="color: #000000;"></i><br><br>
          <a href="index.php?page=mnt_rolesUsuarios"  class="text-decoration-none text-dark">ROLES PARA USUARIOS</a>
        </button>
        {{endif ~menu_rolesUsuarios}}

        
        <!--FUNCIONES ROLES-->
        {{if ~menu_funcionesRoles}}
        <button type="button" class="btn btn-outline-secondary p-5 col-md-3 offset-sm-1">
          <i class="fa-solid fa-shield-halved fa-2xl" style="color: #000000;"></i><br><br>
          <a href="index.php?page=mnt_funcionesroles"  class="text-decoration-none text-dark">FUNCIONES PARA ROLES</a>
        </button>
        {{endif ~menu_funcionesRoles}}
    </div>
  </div>
</div>
</div>
