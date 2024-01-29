<h1>Gestión de Entradas y Salidas</h1>
<section class="WWFilter">

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
          {{if ~entradasalidas_new}}
          <button class="bg-dark rounded" id="btnAdd"><i class="fa-solid fa-plus" style="color: #ffffff;"></i></button>
          {{endif ~entradasalidas_new}}
        </th>
      </tr>
    </thead>

    
    <tbody>
      <!--DATOS DEL GRID DE ENTRADAS Y SALIDAS-->
      {{foreach entradasalidas}}
      <tr class="bg-white">
        <td>{{idEntradasalida}}</td>
        <td>{{gestionEoS}}</td>
        <td>{{inventarioEquipoES}}</td>
        <td>{{nomEquipo}}</td>
        <td>{{categoria}}</td>
        <td>{{descripcion}}</td>
        <td>{{filial}}</td>
        <td>{{departamento}}</td>
        <td>{{asignado}}</td>


        <td>
          {{if ~entradasalidas_edit}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="mnt_entradasalida"/>
              <input type="hidden" name="mode" value="UPD" />
              <input type="hidden" name="idEntradasalida" value={{idEntradasalida}} />
              <button type="submit" class="bg-success"><i class="fa-solid fa-pen-to-square fa-lg"></i></button>
          </form>
          {{endif ~entradasalidas_edit}} <br>



          {{if ~entradasalidas_delete}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="mnt_entradasalida"/>
              <input type="hidden" name="mode" value="DEL" />
              <input type="hidden" name="idEntradasalida" value={{idEntradasalida}} />
              <button type="submit" class="bg-secondary"><i class="fa-solid fa-trash fa-lg"></i></button>
          </form>
          {{endif ~entradasalidas_delete}}
        </td>
      </tr>
      {{endfor entradasalidas}}
    </tbody>
  </table>
</section>
<script>
   document.addEventListener("DOMContentLoaded", function () {
      document.getElementById("btnAdd").addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=mnt_entradasalida&mode=INS&idEntradasalida=0");
      });
    });
</script>