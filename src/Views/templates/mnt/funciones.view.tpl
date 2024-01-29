<h1>Gestión de Funciones</h1>
<section class="WWFilter"></section>

<section class="WWList table-responsive">
  <table class="table table-striped table-hover tb-align">

    <thead>
      <tr class="bg-gris_oscuro tb-align text-white p-5">
        <th scope="col">Código</th>
        <th scope="col">Descripción</th>
        <th scope="col">Estado</th>
        <th scope="col">Tipo</th>
        {{if ~funciones_new}}
        <th>
          <button class="bg-dark rounded" id="btnAdd"><i class="fa-solid fa-plus" style="color: #ffffff;"></i></button>
        </th>
        {{endif ~funciones_new}}
      </tr>
    </thead>



    <tbody>
      {{foreach funciones}}
      <tr class="bg-white">
        <td><b>{{fncod}}</b></td>
          <td>
            {{if ~funciones_view}}
            <a class="text-decoration-none text-success font-weight-bold" 
              href="index.php?page=mnt_funcion&mode=DSP&fncod={{fncod}}">{{fndsc}}</a>
            {{endif ~funciones_view}}
            {{ifnot ~funciones_view}}
            {{fndsc}}
            {{endifnot ~funciones_view}}
          </td>
        </td>
        <td>{{fnest}}</td>
        <td>{{fntyp}}</td>


        <td>
          {{if ~funciones_edit}}
          <form action="index.php" method="get">
            <input type="hidden" name="page" value="mnt_funcion" />
            <input type="hidden" name="mode" value="UPD" />
            <input type="hidden" name="fncod" value={{fncod}} />
            <button type="submit" class="bg-success"><i class="fa-solid fa-pen-to-square fa-lg"></i></button>
          </form>
          {{endif ~funciones_edit}}
          {{if ~funciones_delete}}
          <form action="index.php" method="get">
            <input type="hidden" name="page" value="mnt_funcion" />
            <input type="hidden" name="mode" value="DEL" />
            <input type="hidden" name="fncod" value={{fncod}} />
            <button type="submit" class="bg-secondary"><i class="fa-solid fa-trash fa-lg"></i></button>
          </form>
          {{endif ~funciones_delete}}
        </td>
      </tr>
      {{endfor funciones}}
    </tbody>

  </table>
</section>



<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("btnAdd").addEventListener("click", function (e) {
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=mnt_funcion&mode=INS&fncod=0");
    });
  });
</script>