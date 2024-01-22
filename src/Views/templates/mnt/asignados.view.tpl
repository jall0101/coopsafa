<h1>Gestión de Usuarios Asignados</h1>
<section class="WWFilter">

</section>
<section class="WWList table-responsive">
  <table class="table table-striped table-hover tb-align">
    <thead>
      <tr class="bg-gris_oscuro tb-align text-white p-5">
        <th scope="col">Código</th>
        <th scope="col">Departamento</th>
        <th scope="col">Usuario Asignado</th>
        <th>
          {{if ~asignados_new}}
          <button class="bg-dark rounded" id="btnAdd"><i class="fa-solid fa-plus" style="color: #ffffff;"></i></button>
          {{endif ~asignados_new}}
        </th>
      </tr>
    </thead>


    <tbody>
      {{foreach asignados}}
        <tr class="bg-white">
        <td>{{asignadocod}}</td>
        <td>{{nombreDepartamento}}</td>
        <td>
          {{if ~asignados_view}}
          <a class="text-decoration-none text-success font-weight-bold" 
            href="index.php?page=Mnt_Asignado&mode=DSP&asignadocod={{asignadocod}}">{{nombreAsignado}}</a>
           {{endif ~asignados_view}}

          </td>
        <td>

        {{if ~asignados_edit}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="Mnt_Asignado"/>
              <input type="hidden" name="mode" value="UPD" />
              <input type="hidden" name="asignadocod" value={{asignadocod}} />
              <button type="submit" class="bg-success"><i class="fa-solid fa-pen-to-square fa-lg"></i></button>
          </form>
           {{endif ~asignados_edit}}



          {{if ~asignados_delete}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="Mnt_Asignado"/>
              <input type="hidden" name="mode" value="DEL" />
              <input type="hidden" name="asignadocod" value={{asignadocod}} />
              <button type="submit" class="bg-secondary"><i class="fa-solid fa-trash fa-lg"></i></button>
          </form>
          {{endif ~asignados_delete}}
        </td>
      </tr>
      {{endfor asignados}}
    </tbody>
  </table>
</section>
<script>
   document.addEventListener("DOMContentLoaded", function () {
      document.getElementById("btnAdd").addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=mnt_asignado&mode=INS&asignadocod=0");
      });
    });
</script>
