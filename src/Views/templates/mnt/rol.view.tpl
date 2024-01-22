<div class="my-4 container text-center">
  <h1>{{modedsc}}</h1>
</div>

<section class="container">
  <div class="row justify-content-center">
    <form action="index.php?page=Mnt_Rol&mode={{mode}}&rolescod={{rolescod}}" method="POST"
      class="col-10 align-self-center bg-gris_claro p-4 rounded">
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="rolescod" class="col-4 form-label">Código</label>
        <input type="hidden" id="rolescod" name="rolescod" value="{{rolescod}}" />
        <input type="hidden" id="mode" name="mode" value="{{mode}}" />
        <input type="hidden" name="xssToken" value="{{xssToken}}">
        <input type="text" {{readonly_edit}} class="form-control" name="rolescoddummy" value="{{rolescod}}" />
      </section>
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="rolesdsc" class="col-4 form-label">Descripción</label>
        <input type="text" {{readonly}} name="rolesdsc" class="form-control" value="{{rolesdsc}}" maxlength="45"
          placeholder="Nombre de Rol" />
      </section>
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="rolesest" class="col-4 form-label">Estado</label>
        <select id="rolesest" class="form-select" name="rolesest" {{if readonly}}disabled{{endif readonly}}>
          <option value="ACT" {{rolesest_ACT}}>Activo</option>
          <option value="INA" {{rolesest_INA}}>Inactivo</option>
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
      window.location.assign("index.php?page=Mnt_Roles");
    });
  });
</script>