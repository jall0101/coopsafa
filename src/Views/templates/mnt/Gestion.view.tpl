<h1>{{modedsc}}</h1>
<!--GESTIONES-->
<section class="row">
  <form action="index.php?page=Mnt_Gestion&mode={{mode}}&gestioncod={{gestioncod}}"
    method="POST"
    class="col-6 col-3-offset"
  >
    <section class="row">
        <label for="gestioncod" class="col-4">Código</label>
        <input type="hidden" id="gestioncod" name="gestioncod" value="{{gestioncod}}"/>
        <input type="hidden" id="mode" name="mode" value="{{mode}}"/>
        <input type="hidden"  name="xssToken" value="{{xssToken}}"/>
        <input type="text" readonly name="gestioncoddummy" value="{{gestioncod}}"/>
    </section>


    <!--2. GESTIÓN DE ENTRADAS Y SALIDAS-->
    <section class="row">
      <label for="tipogestion" class="col-4">Gestion</label>
      <input type="text" {{readonly}} name="tipogestion" value="{{tipogestion}}" maxlength="45" placeholder="Gestión"/>
      {{if general_errors}}
        <span class="error col-12">{{general_errors}}</span>
      {{endif general_errors}}
    </section>

    <!--3. NÚMERO DE INVENTARIO EN ENTRADAS Y SALIDAS-->
    <section class="row">
      <label for="invEquipoGestion" class="col-4">Inventario</label>
      <input type="text" {{readonly}} name="invEquipoGestion" value="{{invEquipoGestion}}" maxlength="45" placeholder="Inventario"/>
      {{if general_errors}}
        <span class="error col-12">{{general_errors}}</span>
      {{endif general_errors}}
    </section>


    <!--4. NOMBRE DE EQUIPO EN ENTRADAS Y SALIDAS-->
    <section class="row">
      <label for="nomEquipoGestion" class="col-4">Nombre de Equipo</label>
      <input type="text" {{readonly}} name="nomEquipoGestion" value="{{nomEquipoGestion}}" maxlength="45" placeholder="Nombre de Equipo"/>
      {{if general_errors}}
        <span class="error col-12">{{general_errors}}</span>
      {{endif general_errors}}
    </section>


    <!--6. DESCRIPCIÓN EN ENTRADAS Y SALIDAS-->
    <section class="row">
      <label for="descripcionGestion" class="col-4">Descripción</label>
      <input type="text" {{readonly}} name="descripcionGestion" value="{{descripcionGestion}}" maxlength="45" placeholder="Descripción"/>
      {{if general_errors}}
        <span class="error col-12">{{general_errors}}</span>
      {{endif general_errors}}
    </section>



    <!--7. FILIAL EN ENTRADAS Y SALIDAS-->
    <section class="row">
      <label for="filialGestion" class="col-4">Filial</label>
      <input type="text" {{readonly}} name="filialGestion" value="{{filialGestion}}" maxlength="45" placeholder="Filial"/>
      {{if general_errors}}
        <span class="error col-12">{{general_errors}}</span>
      {{endif general_errors}}
    </section>



    <!--8. DEPARTAMENTO EN ENTRADAS Y SALIDAS-->
    <section class="row">
      <label for="departamentoGestion" class="col-4">Departamento</label>
      <input type="text" {{readonly}} name="departamentoGestion" value="{{departamentoGestion}}" maxlength="45" placeholder="Departamento"/>
      {{if general_errors}}
        <span class="error col-12">{{general_errors}}</span>
      {{endif general_errors}}
    </section>




    <!--9. ASIGNADO EN ENTRADAS Y SALIDAS-->
    <section class="row">
      <label for="asigGestion" class="col-4">Asignado</label>
      <input type="text" {{readonly}} name="asigGestion" value="{{asigGestion}}" maxlength="45" placeholder="Asignado"/>
      {{if general_errors}}
        <span class="error col-12">{{general_errors}}</span>
      {{endif general_errors}}
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
        window.location.assign("index.php?page=Mnt_Gestiones");
      });
  });
</script>