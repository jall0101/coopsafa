<h1>Adminsitración de Funcion-Rol</h1>
<section class="WWFilter">
</section>

<section class="WWList table-responsive">
  <table class="table table-striped table-hover tb-align">
    <thead>
      <tr class="bg-gris_oscuro tb-align text-white p-5">
        <th scope="col">Código Roles</th>
        <th scope="col">Código Funciones</th>
        <th scope="col">Tipo</th>
        <th scope="col">Fecha de Expiración</th>

        <th>
          {{if funcionesroles_new}}
          <button class="bg-dark rounded" id="btnAdd"><i class="fa-solid fa-plus" style="color: #ffffff;"></i></button>
          {{endif funcionesroles_new}}
        </th>
      </tr>
    </thead>

    <tbody>
      {{foreach funcionesroles}}
      <tr class="bg-white">

        <td>
          {{if ~funcionesroles_view}}
            <a class="text-decoration-none text-success font-weight-bold" 
              href="index.php?page=Mnt_FuncionRol&mode=DSP&rolescod={{rolescod}}">{{rolescod}}</a>
          {{endif ~funcionesroles_view}}
          {{ifnot ~funcionesroles_view}}
            {{rolescod}}
          {{endifnot ~funcionesroles_view}}
        </td>

        <td>
          {{if ~funcionesroles_view}}
           <a class="text-decoration-none text-success font-weight-bold" 
            href="index.php?page=Mnt_FuncionRol&mode=DSP&rolescod={{fncod}}">{{fncod}}</a>
          {{endif ~funcionesroles_view}}
          {{ifnot ~funcionesroles_view}}
            {{fncod}}
          {{endifnot ~funcionesroles_view}}
            
        </td>

        <td>
            <a>{{fnrolest}}</a>
        </td>

        <td>
            <a>{{fnexp}}</a>
        </td>

        <td>
          {{if ~funcionesroles_edit}}

          <form action="index.php" method="get">
             <input type="hidden" name="page" value="Mnt_FuncionRol"/>
              <input type="hidden" name="mode" value="UPD" />
              <input type="hidden" name="rolescod" value={{rolescod}} />
              <input type="hidden" name="fncod" value={{fncod}} />
              <button type="submit" class="bg-success"><i class="fa-solid fa-pen-to-square fa-lg"></i></button>
          </form>

          {{endif ~funcionesroles_edit}}
          {{if ~funcionesroles_delete}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="Mnt_FuncionRol"/>
              <input type="hidden" name="mode" value="DEL" />
              <input type="hidden" name="rolescod" value={{rolescod}} />
              <input type="hidden" name="fncod" value={{fncod}} />
              <button type="submit" class="bg-secondary"><i class="fa-solid fa-trash fa-lg"></i></button>
          </form>
          {{endif ~funcionesroles_delete}}
        </td>

      </tr>
      {{endfor funcionesroles}}
    </tbody>

  </table>
</section>

<script>
   document.addEventListener("DOMContentLoaded", function () {
      document.getElementById("btnAdd").addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=Mnt_funcionrol&mode=INS&rolescod=0");
      });
    });
</script>