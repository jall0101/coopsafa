<h1>Gestión de Departamentos</h1>
<section class="WWFilter"></section>

<section class="WWList table-responsive">
  <table class="table table-striped table-hover tb-align">
    <thead>
      <tr class="bg-gris_oscuro tb-align text-white p-5">
        <th scope="col">Código</th>
        <th scope="col">Departamento</th>
        <th>
          {{if departamentos_new}}
          <button class="bg-dark rounded" id="btnAdd"><i class="fa-solid fa-plus" style="color: #ffffff;"></i></button>
          {{endif departamentos_new}}
        </th>
      </tr>
    </thead>


    <tbody>
      {{foreach departamentos}}
        <tr class="bg-white">
          <td>{{departamentocod}}</td>
          <td>
            {{if ~departamentos_view}}
            <a class="text-decoration-none text-success font-weight-bold" 
              href="index.php?page=Mnt_Departamento&mode=DSP&departamentocod={{departamentocod}}">{{nombredepartamento}}</a>
            {{endif ~departamentos_view}}
          </td>


          <td>
            {{if ~departamentos_edit}}
            <form action="index.php" method="get">
              <input type="hidden" name="page" value="Mnt_Departamento"/>
              <input type="hidden" name="mode" value="UPD" />
              <input type="hidden" name="departamentocod" value={{departamentocod}} />
              <button type="submit" class="bg-success"><i class="fa-solid fa-pen-to-square fa-lg"></i></button>
            </form>
            {{endif ~departamentos_edit}}
            
            {{if ~departamentos_delete}}
            <form action="index.php" method="get">
              <input type="hidden" name="page" value="Mnt_Departamento"/>
              <input type="hidden" name="mode" value="DEL" />
              <input type="hidden" name="departamentocod" value={{departamentocod}} />
              <button type="submit" class="bg-secondary"><i class="fa-solid fa-trash fa-lg"></i></button>
            </form>
            {{endif ~departamentos_delete}}
          </td>
        </tr>
      {{endfor departamentos}}
    </tbody>
  </table>
</section>


<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("btnAdd").addEventListener("click", function (e) {
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=mnt_departamento&mode=INS&departamentocod=0");
    });
  });
</script>
