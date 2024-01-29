<h1>{{modedsc}}</h1>
<section class="row">
  <form action="index.php?page=Mnt_Departamento&mode={{mode}}&departamentocod={{departamentocod}}"
    method="POST"
    class="col-6 col-3-offset"
  >

    <section class="row">
      <label for="departamentocod" class="col-4">Código</label>
      <input type="hidden" id="departamentocod" name="departamentocod" value="{{departamentocod}}"/>
      <input type="hidden" id="mode" name="mode" value="{{mode}}"/>
      <input type="hidden"  name="xssToken" value="{{xssToken}}"/>
      <input type="text" readonly name="departamentocoddummy" value="{{departamentocod}}"/>
    </section>


    <section class="row">
      <label for="nombredepartamento" class="col-4">Departamento</label>
      <input type="text" {{readonly}} name="nombredepartamento" value="{{nombredepartamento}}" maxlength="45" placeholder="Departamento"/>
      {{if nombredepartamento_error}}
        <span class="error col-12">{{nombredepartamento_error}}</span>
      {{endif nombredepartamento_error}}
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
      window.location.assign("index.php?page=Mnt_Departamentos");
      });
  });
</script>