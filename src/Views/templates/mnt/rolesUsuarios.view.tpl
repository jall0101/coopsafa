<h1>Gestión de Roles Usuarios</h1>
<section class="WWFilter"></section>


<section class="WWList table-responsive">
  <table class="table table-striped table-hover tb-align">
    <thead>
      <tr class="bg-gris_oscuro tb-align text-white p-5">        
        <th scope="col">Código Usuario</th>
        <th scope="col">Codigo Rol</th>
        <th scope="col">Estado</th>
        <th scope="col">Fecha Creación</th>
        <th scope="col">Fecha Expiración</th>        
        {{if rolesUsuarios_new}}   
        <th>
          <button class="bg-dark rounded" id="btnAdd"><i class="fa-solid fa-plus" style="color: #ffffff;"></i></button>
        </th>
        {{endif rolesUsuarios_new}}
      </tr>
    </thead>




    <tbody>
      {{foreach roles_usuarios}}
      <tr class="bg-white">              
        {{if ~rolesUsuarios_view}}
        <b>
          <td><a class="text-decoration-none text-success font-weight-bold" 
          href="index.php?page=mnt_rolesUsuario&mode=DSP&usercod={{usercod}}&rolescod={{rolescod}}">{{usercod}}</a></td>
        </b>
        {{endif ~rolesUsuarios_view}}

        {{ifnot ~rolesUsuarios_view}}
          {{rolesdsc}}
        {{endifnot ~rolesUsuarios_view}}
        <td>{{rolescod}}</td>
        <td>{{roleuserest}}</td>
        <td>{{roleuserfch}}</td>
        <td>{{roleuserexp}}</td>



        <td>
          {{if ~rolesUsuarios_edit}}
          <form action="index.php" method="get">
            <input type="hidden" name="page" value="mnt_rolesUsuario"/>
            <input type="hidden" name="mode" value="UPD" />
            <input type="hidden" name="rolescod" value={{rolescod}} />
            <input type="hidden" name="usercod" value={{usercod}} />
            <button type="submit" class="bg-success"><i class="fa-solid fa-pen-to-square fa-lg"></i></button>
          </form>
          {{endif ~rolesUsuarios_edit}}



          {{if ~rolesUsuarios_delete}}
          <form action="index.php" method="get">
            <input type="hidden" name="page" value="mnt_rolesUsuario"/>
            <input type="hidden" name="mode" value="DEL" />
            <input type="hidden" name="rolescod" value={{rolescod}} />
            <input type="hidden" name="usercod" value={{usercod}} />
            <button type="submit" class="bg-secondary"><i class="fa-solid fa-trash fa-lg"></i></button>
          </form>
          {{endif ~rolesUsuarios_delete}}
        </td>
      </tr>
      {{endfor roles_usuarios}}
    </tbody>
  </table>
</section>



<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("btnAdd").addEventListener("click", function (e) {
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=mnt_rolesUsuario&mode=INS&rolescod=0&usercod=0");
    });
  });
</script>