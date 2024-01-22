<div class="my-4 container text-center">
  <h1>{{modedsc}}</h1>
</div>
<section class="container">
  <section class="row justify-content-center">
  <form action="index.php?page=Mnt_FuncionRol&mode={{mode}}&rolescod={{rolescod}}&fncod={{fncod}}"
    method="POST"
    class="col-10 align-self-center bg-gris_claro p-4 rounded"
  >

    <section class="row mb-3 bg-gris_claro2 p-3 rounded">
      <label for="rolescod" class="col-4 form-label">Código Rol</label>
      <input type="hidden" id="rolescod" name="rolescod" value="{{rolescod}}"/>
      <input type="hidden" id="mode" name="mode" value="{{mode}}"/>
      <input type="hidden"  name="xssToken" value="{{xssToken}}"/>
      <input type="text" class="form-control" {{readonly}} name="rolescoddummy" value="{{rolescod}}"/>
    </section>
    

    <section class="row mb-3 bg-gris_claro2 p-3 rounded">
      <label for="fncod" class="col-4 form-label">Código Función</label>
      <input type="hidden" id="fncod" name="fncod" value="{{fncod}}"/>
      <input type="hidden" id="mode" name="mode" value="{{mode}}"/>
      <input type="hidden"  name="xssToken" value="{{xssToken}}"/>
      <input type="text" class="form-control" {{readonly}} name="fncoddummy" value="{{fncod}}"/>
    </section>

    <section class="row mb-3 bg-gris_claro2 p-3 rounded">
      <label for="fnrolest" class="col-4 form-label">Estado</label>
      <select id="fnrolest" class="form-select" name="fnrolest" {{if readonly}} disabled{{endif readonly}}>
        <option value="ACT" {{fnrolest_ACT}}>ACTIVO</option>
        <option value="INA" {{fnrolest_INA}}>INACTIVO</option>
      </select>
    </section>

    <section class="row mb-3 bg-gris_claro2 p-3 rounded">
      <label for="fnexp" class="col-4 form-label">Fecha de Expiración</label>
      <input type="date" {{readonly}} name="fnexp" value="{{fnexp}}" />
      {{if fnexp_error}}
        <span class="error col-12">{{fnexp_error}}</span>
      {{endif fnexp_error}}
    </section>
    <hr>

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
        window.location.assign("index.php?page=Mnt_FuncionesRoles");
      });
  });
</script>