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
        <!--
        <th scope="col">Foto Equipo</th>
        <th scope="col">Foto Equipo</th>
        <th scope="col">Foto Equipo</th>
        
        -->

        <th>
          {{if ~entradassalidas_new}}
          <button class="bg-dark rounded" id="btnAdd"><i class="fa-solid fa-plus" style="color: #ffffff;"></i></button>
          {{endif ~entradassalidas_new}}
        </th>
      </tr>
    </thead>

    
    <tbody>
      <!--DATOS DEL GRID DE ENTRADAS Y SALIDAS-->
      {{foreach entradassalidas}}
      <tr class="bg-white">
        <td>{{gestionEoS}}</td>
        <td>{{inventarioEquipoES}}</td>
        <td>{{nomEquipo}}</td>
        <td>{{categoria}}</td>
        <td>{{descripcion}}</td>
        <td>{{filial}}</td>
        <td>{{departamento}}</td>
        <td>{{asignado}}</td>
        <!--
        <td><img src="public\imgs\uploads\{{fotoEquipo}}" alt="" class="img-fluid"></td>
        <td><img src="public\imgs\uploads\{{fotoEntrada}}" alt="" class="img-fluid"></td>
        <td><img src="public\imgs\uploads\{{fotoSalida}}" alt="" class="img-fluid"></td>
        -->

        <td>
          {{if ~entradassalidas_edit}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="mnt_entradassalida"/>
              <input type="hidden" name="mode" value="UPD" />
              <input type="hidden" name="idEntradas_salidas" value={{idEntradas_salidas}} />
              <button type="submit" class="bg-primary"><i class="fa-solid fa-pen-to-square fa-lg"></i></button>
          </form>
          {{endif ~entradassalidas_edit}} <br>



          {{if ~entradassalidas_delete}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="mnt_entradassalida"/>
              <input type="hidden" name="mode" value="DEL" />
              <input type="hidden" name="idEntradas_salidas" value={{idEntradas_salidas}} />
              <button type="submit" class="bg-danger"><i class="fa-solid fa-trash fa-lg"></i></button>
          </form>
          {{endif ~entradassalidas_delete}}
        </td>
      </tr>
      {{endfor entradassalidas}}
    </tbody>
  </table>
</section>
<script>
   document.addEventListener("DOMContentLoaded", function () {
      document.getElementById("btnAdd").addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=mnt_entradassalida&mode=INS&idEntradas_salidas=0");
      });
    });
</script>