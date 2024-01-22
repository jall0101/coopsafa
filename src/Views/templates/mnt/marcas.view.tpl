<h1>Gestión de Marcas</h1>
<section class="WWFilter">

</section>
<section class="WWList table-responsive">
  <table class="table table-striped table-hover tb-align">
    <thead>
      <tr class="bg-gris_oscuro tb-align text-white p-5">
        <th scope="col">Código</th>
        <th scope="col">Marca</th>
        <th>
          {{if ~marcas_new}}
          <button class="bg-dark rounded" id="btnAdd"><i class="fa-solid fa-plus" style="color: #ffffff;"></i></button>
          {{endif ~marcas_new}}
        </th>
      </tr>
    </thead>


    <tbody>
      {{foreach marcas}}
        <tr class="bg-white">

        <td>{{marcacod}}</td>
        <td>
          {{if ~marcas_view}}
          <a class="text-decoration-none text-success font-weight-bold" 
            href="index.php?page=mnt_marca&mode=DSP&marcacod={{marcacod}}">{{nombremarca}}</a>
          {{endif ~marcas_view}}
        </td>
        
        <td>
        {{if ~marcas_edit}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="mnt_marca"/>
              <input type="hidden" name="mode" value="UPD" />
              <input type="hidden" name="marcacod" value={{marcacod}} />
              <button type="submit" class="bg-success"><i class="fa-solid fa-pen-to-square fa-lg"></i></button>
          </form>
          {{endif ~marcas_edit}}
          <br>

          
          {{if ~marcas_delete}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="Mnt_marca"/>
              <input type="hidden" name="mode" value="DEL" />
              <input type="hidden" name="marcacod" value={{marcacod}} />
              <button type="submit" class="bg-secondary"><i class="fa-solid fa-trash fa-lg"></i></button>
          </form>
          {{endif ~marcas_delete}}
        </td>

      </tr>
      {{endfor marcas}}
    </tbody>
  </table>
</section>
<script>
   document.addEventListener("DOMContentLoaded", function () {
      document.getElementById("btnAdd").addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=mnt_marca&mode=INS&marcacod=0");
      });
    });
</script>
