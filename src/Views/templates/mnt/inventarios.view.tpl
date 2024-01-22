<h1>Gestión de Inventario</h1>
<section class="WWFilter">

</section>
<section class="WWList table-responsive">
  <table class="table table-striped table-hover tb-align">
    <thead>
      <tr class="bg-gris_oscuro tb-align text-white p-5">
        <th scope="col">ID Ingreso</th>
        <th scope="col">Estado de Inventario</th>
        <th scope="col">Número de Inventario</th>
        <th scope="col">Nombre del Equipo</th>
        <th scope="col">Categoria del Equipo</th>
        <th scope="col">Descripción del Equipo</th>
        <th scope="col">Filial del Equipo</th>
        <th>
          {{if ~inventarios_new}}
          <button class="bg-dark rounded" id="btnAdd"><i class="fa-solid fa-plus" style="color: #ffffff;"></i></button>
          {{endif ~inventarios_new}}
        </th>
      </tr>
    </thead>

    
    <tbody>
      <!--DATOS DEL GRI DED ZAPATOS-->
      {{foreach inventarios}}

      <tr class="bg-white">
         {{if ~inventarios_view}}
        <td><a class="text-decoration-none text-success font-weight-bold"
           href="index.php?page=mnt_inventario&mode=DSP&id={{id}}">{{id}}</a></td>
         {{endif ~inventarios_view}}

         <td>{{inventarioest}}</td>
        <td>{{numInventario}}</td>
        <td>{{nomEquipo}}</td>
        <td>{{categoriaEquipo}}</td>
        <td>{{descripcionEquipo}}</td>
        <td>{{filialEquipo}}</td>

        <td>
          {{if ~inventarios_edit}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="mnt_inventario"/>
              <input type="hidden" name="mode" value="UPD" />
              <input type="hidden" name="id" value={{id}} />
              <button type="submit" class="bg-success"><i class="fa-solid fa-pen-to-square fa-lg"></i></button>
          </form>
          {{endif ~inventarios_edit}} <br>



          {{if ~inventarios_delete}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="mnt_inventario"/>
              <input type="hidden" name="mode" value="DEL" />
              <input type="hidden" name="id" value={{id}} />
              <button type="submit" class="bg-secondary"><i class="fa-solid fa-trash fa-lg"></i></button>
          </form>
          {{endif ~inventarios_delete}}
        </td>
      </tr>
      {{endfor inventarios}}
    </tbody>
  </table>
</section>
<script>
   document.addEventListener("DOMContentLoaded", function () {
      document.getElementById("btnAdd").addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=mnt_inventario&mode=INS&id=0");
      });
    });
</script>