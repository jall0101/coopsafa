<div class="my-4 container text-center">
  <h1>{{modedsc}}</h1>
</div>

<section class="container">
  <div class="row justify-content-center">
    <form action="index.php?page=Mnt_rolesUsuario&mode={{mode}}&rolescod={{rolescod}}&usercod={{usercod}}" method="POST"
      class="col-10 align-self-center bg-gris_claro p-4 rounded">
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="rolescod" class="col-4 form-label">Código Rol</label>
        <input type="hidden" id="rolescod" name="rolescod" value="{{rolescod}}" />
        <input type="hidden" id="mode" name="mode" value="{{mode}}" />
        <input type="hidden" name="xssToken" value="{{xssToken}}">
        <input type="text" {{readonly_edit}} class="form-control" name="rolescoddummy" value="{{rolescod}}" />
      </section>
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="usercod" class="col-4 form-label">Código Usuario</label>
        <input type="hidden" id="usercod" name="usercod" value="{{usercod}}" />
        <input type="hidden" id="mode" name="mode" value="{{mode}}" />
        <input type="hidden" name="xssToken" value="{{xssToken}}">
        <input type="text" {{readonly_edit}} class="form-control" name="usercoddummy" value="{{usercod}}" />
      </section>
      
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="roleuserest" class="col-4 form-label">Estado</label>
        <select id="roleuserest" class="form-select" name="roleuserest" {{if readonly}}disabled{{endif readonly}}>
          <option value="ACT" {{roleuserest_ACT}}>Activo</option>
          <option value="INA" {{roleuserest_INA}}>Inactivo</option>
        </select>
      </section>

      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="roleuserexp" class="col-4 form-label">Fecha de Expiración</label>
        <input type="date" {{readonly}} name="roleuserexp" class="form-control" value="{{roleuserexp}}"/>
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