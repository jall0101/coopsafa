<h1>{{modedsc}}</h1>
<section class="row">
  <form action="index.php?page=Mnt_Asignado&mode={{mode}}&asignadocod={{asignadocod}}"
    method="POST"
    class="col-6 col-3-offset"
  >

  <!--ASIGNADO COD-->
    <section class="row">
      <label for="asignadocod" class="col-4">Código</label>
      <input type="hidden" id="asignadocod" name="asignadocod" value="{{asignadocod}}"/>
      <input type="hidden" id="mode" name="mode" value="{{mode}}"/>
      <input type="hidden"  name="xssToken" value="{{xssToken}}"/>
      <input type="text" readonly name="asignadocoddummy" value="{{asignadocod}}"/>
    </section>


    <section class="row">
      <label for="nombreDepartamento" class="col-4">Departamento</label>
      <input type="text" {{readonly}} name="nombreDepartamento" value="{{nombreDepartamento}}" maxlength="45" placeholder="Departamento"/>
      {{if nombreDepartamento_error}}
        <span class="error col-12">{{nombreDepartamento_error}}</span>
      {{endif nombreDepartamento_error}}
    </section>
    
    
    <section class="row">
      <label for="nombreAsignado" class="col-4">Usuario Asignado</label>
      <input type="text" {{readonly}} name="nombreAsignado" value="{{nombreAsignado}}" maxlength="45" placeholder="Usuario Asignado"/>
      {{if nombreAsignado_error}}
        <span class="error col-12">{{nombreAsignado_error}}</span>
      {{endif nombreAsignado_error}}
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
      <button type="submit" name="btnGuardar" value="G">Guardar</button>
      {{endif show_action}}
      <button type="button" id="btnCancelar">Cancelar</button>
    </section>
  </form>
</section>


<script>
  document.addEventListener("DOMContentLoaded", function(){
      document.getElementById("btnCancelar").addEventListener("click", function(e){
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=Mnt_Asignados");
      });
  });
</script>