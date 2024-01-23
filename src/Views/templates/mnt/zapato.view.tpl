<div class="my-4 container text-center">
  <h1>{{modedsc}}</h1>
</div>
<section class="container">
  <div class="row justify-content-center">
    <form action="index.php?page=Mnt_Zapato&mode={{mode}}&zapatocod={{zapatocod}}" method="POST"
      class="col-10 align-self-center bg-gris_claro p-4 rounded" enctype="multipart/form-data">

      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="zapatocod" class="col-4 form-label">Código</label>
        <input type="hidden" id="zapatocod" name="zapatocod" value="{{zapatocod}}" />
        <input type="hidden" id="mode" name="mode" value="{{mode}}" />
        <input type="hidden" name="xssToken" value="{{xssToken}}">
        <input type="text" readonly class="form-control" name="zapatocoddummy" value="{{zapatocod}}" />
      </section>


      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
      <label for="marcacod" class="col-4">Código Marca</label>
      <input type="text" {{readonly}} name="marcacod" value="{{marcacod}}" maxlength="45" placeholder="Código Marca"/>
      <!--

      {{if marcacod_error}}
        <span class="error col-12">{{marcacod_error}}</span>
      {{endif marcacod_error}}
      
      
      -->
    </section>

    <section class="row mb-3 bg-gris_claro2 p-3 rounded">
      <label for="departamentocod" class="col-4">Código Departamento</label>
      <input type="text" {{readonly}} name="departamentocod" value="{{departamentocod}}" maxlength="45" placeholder="Código Departamento"/>
    </section>


      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
      <label for="precio" class="col-4">Precio</label>
      <input type="text" {{readonly}} name="precio" value="{{precio}}" maxlength="45" placeholder="Precio"/>
    </section>

      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="zapatoest" class="col-4 form-label">Estado Zapato</label>
        <select id="zapatoest" class="form-select" name="zapatoest" {{if readonly}} disabled{{endif readonly}}>
          <option value="ACT" {{zapatoest_ACT}}>ACTIVO</option>
          <option value="DES" {{zapatoest_DES}}>DESACTIVO</option>
        </select>
      </section>

      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        
          <!--TRAER IMAGEN-->
          
        <label for="my-input">Seleccione una Imagen</label>
        <input type="text" name="verificarImagen" value="{{imagenzapato}}" readonly>
        <input id="my-input" type="file" name="imagenzapato" class="btn btn-light" {{disabled}}>
          
      </section>

      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="color" class="col-4 form-label">Color</label>
        <input type="text" {{readonly}} class="form-control" name="color" value="{{color}}" maxlength="45"
          placeholder="Color Zapato" />
      </section>

      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="descripcion" class="col-4 form-label">Descripcion</label>
        <input type="text" {{readonly}} class="form-control" name="descripcion" value="{{descripcion}}" maxlength="45"
          placeholder="Descripcion Zapato" />
      </section>

      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="detalles" class="col-4 form-label">Detalles</label>
        <input type="text" {{readonly}} class="form-control" name="detalles" value="{{detalles}}" maxlength="45"
          placeholder="Detalles Zapato" />
      </section>

      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="nombrezapato" class="col-4 form-label">Nombre Zapato</label>
        <input type="text" {{readonly}} class="form-control" name="nombrezapato" value="{{nombrezapato}}" maxlength="45"
          placeholder="Nombre Zapato" />
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
      window.location.assign("index.php?page=Mnt_Zapatos");
    });
  });
</script>