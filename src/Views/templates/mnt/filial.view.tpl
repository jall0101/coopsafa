<h1>{{modedsc}}</h1>
<!--FILIALES-->
<section class="row">
  <form action="index.php?page=Mnt_Filial&mode={{mode}}&filialcod={{filialcod}}"
    method="POST"
    class="col-6 col-3-offset"
  >
    <section class="row">
        <label for="filialcod" class="col-4">Código</label>
        <input type="hidden" id="filialcod" name="filialcod" value="{{filialcod}}"/>
        <input type="hidden" id="mode" name="mode" value="{{mode}}"/>
        <input type="hidden"  name="xssToken" value="{{xssToken}}"/>
        <input type="text" readonly name="filialcoddummy" value="{{filialcod}}"/>
    </section>


    <section class="row">
      <label for="nombreFilial" class="col-4">Filial</label>
      <input type="text" {{readonly}} name="nombreFilial" value="{{nombreFilial}}" maxlength="45" placeholder="Filial"/>
      {{if nombreFilial_error}}
        <span class="error col-12">{{nombreFilial_error}}</span>
      {{endif nombreFilial_error}}
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
        window.location.assign("index.php?page=Mnt_Filiales");
      });
  });
</script>