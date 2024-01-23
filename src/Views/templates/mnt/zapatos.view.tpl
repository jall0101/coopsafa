<h1>Gestión de Zapatos</h1>
<section class="WWFilter">

</section>
<section class="WWList table-responsive">
  <table class="table table-striped table-hover tb-align">
    <thead>
      <tr class="bg-gris_oscuro tb-align text-white p-5">
        <th scope="col">Código</th>
        <th scope="col">Código Marca</th>
        <th scope="col">Código Departamento</th>
        <th scope="col">precio</th>
        <th scope="col">Estado</th>
        <th scope="col">Imagen Entrada</th>
        <th scope="col">Color</th>
        <th scope="col">Descripción</th>
        <th scope="col">Detalles</th>
        <th scope="col">Nombre Zapato</th>
        <th>
          {{if ~zapatos_new}}
          <button class="bg-dark rounded" id="btnAdd"><i class="fa-solid fa-plus" style="color: #ffffff;"></i></button>
          {{endif ~zapatos_new}}
        </th>
      </tr>
    </thead>

    
    <tbody>
      <!--DATOS DEL GRI DED ZAPATOS-->
      {{foreach zapatos}}
      <tr class="bg-white">
         {{if ~zapatos_view}}
        <td><a href="index.php?page=mnt_zapato&mode=DSP&zapatocod={{zapatocod}}">{{zapatocod}}</a></td>
         {{endif ~zapatos_view}}
         <td>{{marcacod}}</td>
        <td>{{departamentocod}}</td>
        <td>{{precio}}</td>
        <td>{{zapatoest}}</td>
        <td><img src="public\imgs\uploads\{{imagenzapato}}" alt="" class="img-fluid"></td>
        <td>{{color}}</td>
        <td>{{descripcion}}</td>
        <td>{{detalles}}</td>
        <td>{{nombrezapato}}</td>

        <td>
          {{if ~zapatos_edit}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="mnt_zapato"/>
              <input type="hidden" name="mode" value="UPD" />
              <input type="hidden" name="zapatocod" value={{zapatocod}} />
              <button type="submit" class="bg-primary"><i class="fa-solid fa-pen-to-square fa-lg"></i></button>
          </form>
          {{endif ~zapatos_edit}} <br>

          {{if ~zapatos_delete}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="mnt_zapato"/>
              <input type="hidden" name="mode" value="DEL" />
              <input type="hidden" name="zapatocod" value={{zapatocod}} />
              <button type="submit" class="bg-danger"><i class="fa-solid fa-trash fa-lg"></i></button>
          </form>
          {{endif ~zapatos_delete}}
        </td>
      </tr>
      {{endfor zapatos}}
    </tbody>
  </table>
</section>
<script>
   document.addEventListener("DOMContentLoaded", function () {
      document.getElementById("btnAdd").addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=mnt_zapato&mode=INS&zapatocod=0");
      });
    });
</script>