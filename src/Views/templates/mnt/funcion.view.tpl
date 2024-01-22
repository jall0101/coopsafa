<div class="my-4 container text-center">
  <h1>{{modedsc}}</h1>
</div>
<section class="container">
  <section class="row justify-content-center">
  <form action="index.php?page=Mnt_Funcion&mode={{mode}}&fncod={{fncod}}"
    method="POST"
    class="col-10 align-self-center bg-gris_claro p-4 rounded"
  >
    <section class="row mb-3 bg-gris_claro2 p-3 rounded">
    <label for="fncod" class="col-4 form-label">Código</label>
    <input type="hidden" id="fncod" name="fncod" value="{{fncod}}"/>
    <input type="hidden" id="mode" name="mode" value="{{mode}}"/>
    <input type="hidden" name="xssToken" value="{{xssToken}}">
    <input type="text" {{readonly_edit}} name="fncoddummy" value="{{fncod}}"/>
    </section>
    <section class="row mb-3 bg-gris_claro2 p-3 rounded">
      <label for="fndsc" class="col-4 form-label">Descripción</label>
      <input type="text" {{readonly}} name="fndsc" value="{{fndsc}}" maxlength="45" placeholder="Nombre de Función"/>
    </section>
    <section class="row mb-3 bg-gris_claro2 p-3 rounded">
      <label for="fnest" class="col-4 form-label">Estado</label>
      <select id="fnest" name="fnest" class="form-select" {{if readonly}}disabled{{endif readonly}}>
        <option value="ACT" {{fnest_ACT}}>Activo</option>
        <option value="INA" {{fnest_INA}}>Inactivo</option>
      </select>
    </section>
    <section class="row mb-3 bg-gris_claro2 p-3 rounded">
      <label for="fntyp" class="col-4 form-label">Tipo</label>
      <select id="fntyp" class="form-select" name="fntyp" {{if readonly}}disabled{{endif readonly}}>
        <option value="CTR" {{fntyp_CTR}}>CTR </option>
        <option value="PGN" {{fntyp_PGN}}>PGN </option>
      </select>
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
      {{endif show_action}}
 <button type="button" id="btnCancelar" class="bg-dark text-white"><i class="fa-solid fa-xmark"
            style="color: #ffffff;"></i>&nbsp;&nbsp;Cancelar</button>    </section>
  </form>
</section>
</section>


<script>
  document.addEventListener("DOMContentLoaded", function(){
      document.getElementById("btnCancelar").addEventListener("click", function(e){
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=Mnt_Funciones");
      });
  });
</script>