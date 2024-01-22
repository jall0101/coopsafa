<h1>{{modedsc}}</h1>
<section class="row">
  <form action="index.php?page=Mnt_Marca&mode={{mode}}&marcacod={{marcacod}}"
    method="POST"
    class="col-6 col-3-offset"
  >
    <section class="row">
        <label for="marcacod" class="col-4">Código</label>
        <input type="hidden" id="marcacod" name="marcacod" value="{{marcacod}}"/>
        <input type="hidden" id="mode" name="mode" value="{{mode}}"/>
        <input type="hidden"  name="xssToken" value="{{xssToken}}"/>
        <input type="text" readonly name="marcacoddummy" value="{{marcacod}}"/>
    </section>


    <section class="row">
      <label for="nombremarca" class="col-4">Marca</label>
      <input type="text" {{readonly}} name="nombremarca" value="{{nombremarca}}" maxlength="45" placeholder="Marca"/>
      {{if nombremarca_error}}
        <span class="error col-12">{{nombremarca_error}}</span>
      {{endif nombremarca_error}}
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
</section>


<script>
  document.addEventListener("DOMContentLoaded", function(){
      document.getElementById("btnCancelar").addEventListener("click", function(e){
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=Mnt_Marcas");
      });
  });
</script>