<h1>Gestión de Roles</h1>
<section class="WWFilter">

</section>
<section class="WWList table-responsive">
  <table class="table table-striped table-hover tb-align">
    <thead>
      <tr class="bg-gris_oscuro tb-align text-white p-5">        
        <th scope="col">Código</th>
        <th scope="col">Descripción</th>
        <th scope="col">Estado</th>

        {{if roles_new}}
        <th>          
          <button class="bg-dark rounded" id="btnAdd"><i class="fa-solid fa-plus" style="color: #ffffff;"></i></button>
          
        </th>
        {{endif roles_new}}
        
      </tr>
    </thead>


    <tbody>
      {{foreach roles}}
      <tr class="bg-white">
        <td><b>{{rolescod}}</b></td>
        {{if ~roles_view}}
        <td><a class="text-decoration-none text-success font-weight-bold" 
          href="index.php?page=mnt_rol&mode=DSP&rolescod={{rolescod}}">{{rolesdsc}}</a></td>
        {{endif ~roles_view}}
          {{ifnot ~roles_view}}
          {{rolesdsc}}
        {{endifnot ~roles_view}}
        <td>{{rolesest}}</td>

        <td>
          {{if ~roles_edit}}
          <form action="index.php" method="get">
            <input type="hidden" name="page" value="mnt_rol"/>
            <input type="hidden" name="mode" value="UPD" />
            <input type="hidden" name="rolescod" value={{rolescod}} />
            <button type="submit" class="bg-success"><i class="fa-solid fa-pen-to-square fa-lg"></i></button>
          </form>
          {{endif ~roles_edit}}
          {{if ~roles_delete}}
          <form action="index.php" method="get">
            <input type="hidden" name="page" value="mnt_rol"/>
            <input type="hidden" name="mode" value="DEL" />
            <input type="hidden" name="rolescod" value={{rolescod}} />
            <button type="submit" class="bg-secondary"><i class="fa-solid fa-trash fa-lg"></i></button>
          </form>
          {{endif ~roles_delete}}
        </td>
      </tr>
      {{endfor roles}}
    </tbody>
  </table>
</section>

<script>
      document.addEventListener("DOMContentLoaded", function () {
      document.getElementById("btnAdd").addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=mnt_rol&mode=INS&rolescod=0");
      });
    });
</script>