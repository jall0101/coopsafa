<div class="my-4 container text-center">
  <h1>{{modedsc}}</h1>
</div>
<section class="container">
  <div class="row justify-content-center">
    <form action="index.php?page=Mnt_Entradasalida&mode={{mode}}&idEntradasalida={{idEntradasalida}}" method="POST"
      class="col-10 align-self-center bg-gris_claro p-4 rounded" enctype="multipart/form-data">

        <section class="row mb-3 bg-gris_claro2 p-3 rounded">
          <label for="idEntradasalida" class="col-4 form-label">Código</label>
          <input type="hidden" id="idEntradasalida" name="idEntradasalida" value="{{idEntradasalida}}" />
          <input type="hidden" id="mode" name="mode" value="{{mode}}" />
          <input type="hidden" name="xssToken" value="{{xssToken}}">
          <input type="text" readonly class="form-control" name="idEntradasalida" value="{{idEntradasalida}}" />
        </section>

        <!--GESTIÓN DE ENTRADAS Y SALIDAS-->
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="gestionEoS" class="col-4 form-label">Tipo de Gestión</label>
        <input type="text" {{readonly}} class="form-control" name="gestionEoS" value="{{gestionEoS}}" maxlength="45"
          placeholder="Tipo de Gestión" />
      </section>

      <!--NÚMERO DE INVENTARIO EN ENTRADAS Y SALIDAS-->
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="inventarioEquipoES" class="col-4 form-label">Número de Inventario</label>
        <input type="text" {{readonly}} class="form-control" name="inventarioEquipoES" value="{{inventarioEquipoES}}" maxlength="45"
          placeholder="Número de Inventario" />
      </section>



      <!--NOMBRE DE EQUIPO EN ENTRADAS Y SALIDAS-->
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="nomEquipo" class="col-4 form-label">Nombre de Equipo</label>
        <input type="text" {{readonly}} class="form-control" name="nomEquipo" value="{{nomEquipo}}" maxlength="255"
          placeholder="Nombre de Equipo" />
      </section>



      <!--CATEGORIA EN ENTRADAS Y SALIDAS-->
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="categoria" class="col-4 form-label">Categoría</label>
        <input type="text" {{readonly}} class="form-control" name="categoria" value="{{categoria}}" maxlength="45"
          placeholder="Categoría" />
      </section>


      <!--DESCRIPCIÓN EN ENTRADAS Y SALIDAS-->
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="descripcion" class="col-4 form-label">Descripción</label>
        <input type="text" {{readonly}} class="form-control" name="descripcion" value="{{descripcion}}" maxlength="255"
          placeholder="Descripción" />
      </section>


      <!--FILIAL EN ENTRADAS Y SALIDAS-->
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="filial" class="col-4 form-label">Filial</label>
        <input type="text" {{readonly}} class="form-control" name="filial" value="{{filial}}" maxlength="45"
          placeholder="Filial" />
      </section>


      <!--DEPARTAMENTO EN ENTRADAS Y SALIDAS-->
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="departamento" class="col-4 form-label">Departamento</label>
        <input type="text" {{readonly}} class="form-control" name="departamento" value="{{departamento}}" maxlength="45"
          placeholder="Departamento" />
      </section>


      <!--ASIGNADO EN ENTRADAS Y SALIDAS-->
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="asignado" class="col-4 form-label">Usuario Asignado</label>
        <input type="text" {{readonly}} class="form-control" name="asignado" value="{{asignado}}" maxlength="45"
          placeholder="Asignado" />
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

      </section>

        
    </form>
  </div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("btnCancelar").addEventListener("click", function (e) {
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=Mnt_Entradasalidas");
    });
  });
</script>