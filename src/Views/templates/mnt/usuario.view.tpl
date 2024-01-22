<div class="my-4 container text-center">
  <h1>{{modedsc}}</h1>
</div>
<section class="container">
  <div class="row justify-content-center">
    <form action="index.php?page=Mnt_Usuario&mode={{mode}}&usercod={{usercod}}" method="POST"
      class="col-10 align-self-center bg-gris_claro p-4 rounded">
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="usercod" class="col-4 form-label">Código</label>
        <input type="hidden" id="usercod" name="usercod" value="{{usercod}}" />
        <input type="hidden" id="mode" name="mode" value="{{mode}}" />
        <input type="hidden" name="xssToken" value="{{xssToken}}">
        <input type="text" readonly class="form-control" name="usercoddummy" value="{{usercod}}" />
      </section>

      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="useremail" class="col-4 form-label">Useremail</label>
        <input type="text" {{readonly}} class="form-control" name="useremail" value="{{useremail}}" maxlength="45"
          placeholder="Correo de Usuario" />
      </section>
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="username" class="col-4 form-label">Username</label>
        <input type="text" {{readonly}} class="form-control" name="username" value="{{username}}" maxlength="45"
          placeholder="Nombre de Usuario" />
      </section>
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="userpswd" class="col-4 form-label">Password</label>
        <input type="password" {{readonly}} class="form-control" name="userpswd" value="{{userpswd}}" maxlength="45"
          placeholder="Password de Usuario" />
      </section>
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="userpswdest" class="col-4 form-label">userpswdest</label>
        <select id="userpswdest" class="form-select" name="userpswdest" {{if readonly}}disabled{{endif readonly}}>
          <option value="ACT" {{userpswdest_ACT}}>ACTIVO </option>
          <option value="INA" {{userpswdest_INA}}>INACTIVO </option>
        </select>
      </section>
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="userest" class="col-4 form-label">Estado</label>
        <select id="userest" class="form-select" name="userest" {{if readonly}}disabled{{endif readonly}}>
          <option value="ACT" {{userest_ACT}}>ACTIVO </option>
          <option value="INA" {{userest_INA}}>INACTIVO </option>
        </select>
      </section>
      <section class="row mb-3 bg-gris_claro2 p-3 rounded">
        <label for="usertipo" class="col-4 form-label">Tipo</label>
        <select id="usertipo" class="form-select" name="usertipo" {{if readonly}}disabled{{endif readonly}}>
          <option value="NOR" {{usertipo_NOR}}>NORMAL </option>
          <option value="CON" {{usertipo_CON}}>CONSULTOR </option>
          <option value="CLI" {{usertipo_CLI}}>CLIENTE </option>
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
      window.location.assign("index.php?page=Mnt_Usuarios");
    });
  });
</script>