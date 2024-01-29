<h1>Gestión de Filiales</h1>
<section class="WWFilter"></section>

<!--FILIALES-->
<section class="WWList table-responsive">
  <table class="table table-striped table-hover tb-align">
    <thead>
      <tr class="bg-gris_oscuro tb-align text-white p-5">
        <th scope="col">Código</th>
        <th scope="col">Filial</th>
        <th>
          {{if ~filiales_new}}
          <button class="bg-dark rounded" id="btnAdd"><i class="fa-solid fa-plus" style="color: #ffffff;"></button>
          {{endif ~filiales_new}}
        </th>
      </tr>
    </thead>


    <tbody>
      {{foreach filiales}}
      <tr class="bg-white">
        <td>{{filialcod}}</td>  
        <td>
          <!--VISTA-->
          {{if ~filiales_view}}
            <a class="text-decoration-none text-success font-weight-boldl" 
            href="index.php?page=Mnt_Filial&mode=DSP&filialcod={{filialcod}}">{{nombreFilial}}</a>
        </td>
        {{endif ~filiales_view}}

        {{ifnot ~filiales_view}}
          {{nombreFilial}}
        {{endifnot ~filiales_view}}

        <td>
          <!--EDITAR-->
          {{if ~filiales_edit}}
          <form action="index.php" method="get">
            <input type="hidden" name="page" value="Mnt_Filial"/>
            <input type="hidden" name="mode" value="UPD" />
            <input type="hidden" name="filialcod" value={{filialcod}} />
            <button type="submit" class="bg-success"><i class="fa-solid fa-pen-to-square fa-lg"></i></button>
          </form>
          {{endif ~filiales_edit}}

          <!--ELIMINAR-->
          {{if ~filiales_delete}}
          <form action="index.php" method="get">
            <input type="hidden" name="page" value="Mnt_Filial"/>
            <input type="hidden" name="mode" value="DEL" />
            <input type="hidden" name="filialcod" value={{filialcod}} />
            <button type="submit" class="bg-secondary"><i class="fa-solid fa-trash fa-lg"></i></button>
          </form>
          {{endif ~filiales_delete}}
        </td>
      </tr>
      {{endfor filiales}}

    </tbody>
  </table>
</section>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("btnAdd").addEventListener("click", function (e) {
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=mnt_filial&mode=INS&filialcod=0");
    });
  });
</script>