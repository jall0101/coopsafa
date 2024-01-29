<h1>Gestiónes de Entradas y Salidas</h1>
<section class="WWFilter">
<!--GESTIONES-->
</section>
<section class="WWList table-responsive">
  <table class="table table-striped table-hover tb-align">
    <thead>
      <tr class="bg-gris_oscuro tb-align text-white p-5">
        <th scope="col">Código</th>
        <th scope="col">Tipo de Gestión</th>
        <th scope="col">Código de Inventario</th>
        <th scope="col">Nombre de Equipo</th>
        <th scope="col">Categoría</th>
        <th scope="col">Descripción</th>
        <th scope="col">Filial</th>
        <th scope="col">Departamento</th>
        <th scope="col">Asignado</th>
        <th>
          {{if ~gestiones_new}}
          <button class="bg-dark rounded" id="btnAdd"><i class="fa-solid fa-plus" style="color: #ffffff;"></button>
          {{endif ~gestiones_new}}
        </th>
      </tr>
    </thead>


    <tbody>
      {{foreach gestiones}}
        <tr class="bg-white">
        <td>{{gestioncod}}</td>
        <td>{{tipogestion}}</td>
        <td>{{invEquipoGestion}}</td>
        <td>
          <!--VISTA-->
           {{if ~gestiones_view}}
          <a class="text-decoration-none text-success font-weight-boldl" 
            href="index.php?page=Mnt_Gestion&mode=DSP&gestioncod={{gestioncod}}">{{nomEquipoGestion}}
            {{endif ~gestiones_view}}
            </a>
        </td>
        <td>{{categoriaGestion}}</td>
        <td>{{descripcionGestion}}</td>
        <td>{{filialGestion}}</td>
        <td>{{departamentoGestion}}</td>
        <td>{{asignadoGestion}}</td>



        <td>
          <!--EDITAR-->
        {{if ~gestiones_edit}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="mnt_gestion"/>
              <input type="hidden" name="mode" value="UPD" />
              <input type="hidden" name="gestioncod" value={{gestioncod}} />
              <button type="submit" class="bg-success"><i class="fa-solid fa-pen-to-square fa-lg"></i></button>
          </form>
        {{endif ~gestiones_edit}}


          <!--ELIMINAR-->
        {{if ~gestiones_delete}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="mnt_gestion"/>
              <input type="hidden" name="mode" value="DEL" />
              <input type="hidden" name="gestioncod" value={{gestioncod}} />
              <button type="submit" class="bg-secondary"><i class="fa-solid fa-trash fa-lg"></i></button>
          </form>
        {{endif ~gestiones_delete}}
        </td>
      </tr>
      {{endfor gestiones}}

    </tbody>
  </table>
</section>
<script>
   document.addEventListener("DOMContentLoaded", function () {
      document.getElementById("btnAdd").addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=mnt_gestion&mode=INS&gestioncod=0");
      });
    });
</script>