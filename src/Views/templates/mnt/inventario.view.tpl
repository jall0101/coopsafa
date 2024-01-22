<div class="my-4 container text-center">
  <h1>{{modedsc}}</h1>
</div>
<section class="container">
  <div class="row justify-content-center">
    <form action="index.php?page=Mnt_Inventario&mode={{mode}}&id={{id}}" method="POST"
      class="col-10 align-self-center bg-gris_claro p-4 rounded" enctype="multipart/form-data">


      <!--CODIGO DE TABLA-->
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="id" class="col-4 form-label">Código</label>
        <input type="hidden" id="id" name="id" value="{{id}}" />
        <input type="hidden" id="mode" name="mode" value="{{mode}}" />
        <input type="hidden" name="xssToken" value="{{xssToken}}">
        <input type="text" readonly class="form-control" name="iddummy" value="{{id}}" />
      </section>



      <!--ESTADO DE EQUIPO EN INVENTARIO-->
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="inventarioest" class="col-4 form-label">Estado Equipo</label>
        <select id="inventarioest" class="form-select" name="inventarioest" {{if readonly}} disabled{{endif readonly}}>
          <option value="ACT" {{inventarioest_ACT}}>ACTIVO</option>
          <option value="DES" {{inventarioest_DES}}>DESACTIVO</option>
        </select>
      </section>



      <!--NUMERO DE INVENTARIO DE EQUIPO-->
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="numInventario" class="col-4 form-label">Número de Inventario</label>
        <input type="text" {{readonly}} class="form-control" name="numInventario" value="{{numInventario}}" maxlength="45"
        placeholder="Número de Inventario" />
      </section>



      <!--NOMBRE DE EQUIPO-->
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="nomEquipo" class="col-4 form-label">Nombre de Equipo</label>
        <input type="text" {{readonly}} class="form-control" name="nomEquipo" value="{{nomEquipo}}" maxlength="45"
        placeholder="Nombre de Equipo" />
      </section>



      <!--CATEGORIA DE EQUIPO EN INVENTARIO-->
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="categoriaEquipo" class="col-4 form-label">Categoría de Equipo</label>
        <input type="text" {{readonly}} class="form-control" name="categoriaEquipo" value="{{categoriaEquipo}}" maxlength="45"
        placeholder="Categoria de Equipo" />
      </section>


      <!--DESCRIPCIÓN DE EQUIPO EN INVENTARIO-->
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="descripcionEquipo" class="col-4 form-label">Descripción de Equipo</label>
        <input type="text" {{readonly}} class="form-control" name="descripcionEquipo" value="{{descripcionEquipo}}" maxlength="255"
        placeholder="Descripción de Equipo" />
      </section>



      <!--FILIAL DE EQUIPO EN INVENTARIO-->
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="filialEquipo" class="col-4 form-label">Filial de Equipo</label>
        <input type="text" {{readonly}} class="form-control" name="filialEquipo" value="{{filialEquipo}}" maxlength="45"
        placeholder="Filial de Equipo" />
      </section>



    

      {{if has_errors}}
        <section>
          <ul>
            {{foreach general_errors}}
            <li>{{this}}</li>
            {{endfor general_errors}}
          </ul>
        </section>
      {{endif has_errors}}


      <section>
        {{if show_action}}
        <button type="submit" name="btnGuardar" class="bg-dark text-white" value="G"><i class="fa-regular fa-floppy-disk" style="color: #ffffff;"></i>&nbsp;&nbsp;Guardar</button>
        &nbsp;&nbsp;&nbsp;
        {{endif show_action}}
        <button type="button" id="btnCancelar" class="bg-dark text-white"><i class="fa-solid fa-xmark"
          style="color: #ffffff;"></i>&nbsp;&nbsp;Cancelar</button>
      </section>
    </form>
  </div>




</section>

 
      




  <script>
  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("btnCancelar").addEventListener("click", function (e) {
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=Mnt_Inventarios");
    });
  });
</script>

</section>

