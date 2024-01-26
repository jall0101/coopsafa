<h1>{{modedsc}}</h1>
<!--GESTIONES-->
<section class="row">
  <form action="index.php?page=Mnt_Filial&mode={{mode}}&idEntradasalida={{idEntradasalida}}"
    method="POST"
    class="col-6 col-3-offset"
  >
    <section class="row">
        <label for="idEntradasalida" class="col-4">Código</label>
        <input type="hidden" id="idEntradasalida" name="idEntradasalida" value="{{idEntradasalida}}"/>
        <input type="hidden" id="mode" name="mode" value="{{mode}}"/>
        <input type="hidden"  name="xssToken" value="{{xssToken}}"/>
        <input type="text" readonly name="idEntradasalidadummy" value="{{idEntradasalida}}"/>
    </section>


    <!--GESTIÓN DE ENTRADAS Y SALIDAS-->
    <section class="row">
      <label for="gestionES" class="col-4">Gestion</label>
      <input type="text" {{readonly}} name="gestionEoS" value="{{gestionES}}" maxlength="45" placeholder="Gestión"/>
      {{if gestionES_error}}
        <span class="error col-12">{{gestionES_error}}</span>
      {{endif gestionES_error}}
    </section>

    <!--NÚMERO DE INVENTARIO EN ENTRADAS Y SALIDAS-->
    <section class="row">
      <label for="inventarioEquipoES" class="col-4">Inventario</label>
      <input type="text" {{readonly}} name="inventarioEquipoES" value="{{inventarioEquipoES}}" maxlength="45" placeholder="Inventario"/>
      {{if inventarioEquipoES_error}}
        <span class="error col-12">{{inventarioEquipoES_error}}</span>
      {{endif inventarioEquipoES_error}}
    </section>


    <!--NOMBRE DE EQUIPO EN ENTRADAS Y SALIDAS-->
    <section class="row">
      <label for="nomEquipo" class="col-4">Nombre de Equipo</label>
      <input type="text" {{readonly}} name="nomEquipo" value="{{nomEquipo}}" maxlength="45" placeholder="Nombre de Equipo"/>
      {{if nomEquipo_error}}
        <span class="error col-12">{{nomEquipo_error}}</span>
      {{endif nomEquipo_error}}
    </section>



    <!--CATEGORIA EN ENTRADAS Y SALIDAS-->
    <section class="row">
      <label for="categoria" class="col-4">Categoria</label>
      <input type="text" {{readonly}} name="categoria" value="{{categoria}}" maxlength="45" placeholder="Categoría"/>
      {{if categoria_error}}
        <span class="error col-12">{{categoria_error}}</span>
      {{endif categoria_error}}
    </section>



    <!--DESCRIPCIÓN EN ENTRADAS Y SALIDAS-->
    <section class="row">
      <label for="descripcion" class="col-4">Descripción</label>
      <input type="text" {{readonly}} name="descripcion" value="{{descripcion}}" maxlength="45" placeholder="Descripción"/>
      {{if descripcion_error}}
        <span class="error col-12">{{descripcion_error}}</span>
      {{endif descripcion_error}}
    </section>



    <!--FILIAL EN ENTRADAS Y SALIDAS-->
    <section class="row">
      <label for="filial" class="col-4">Descripción</label>
      <input type="text" {{readonly}} name="filial" value="{{filial}}" maxlength="45" placeholder="Filial"/>
      {{if filial_error}}
        <span class="error col-12">{{filial_error}}</span>
      {{endif filial_error}}
    </section>



    <!--DEPARTAMENTO EN ENTRADAS Y SALIDAS-->
    <section class="row">
      <label for="departamento" class="col-4">Departamento</label>
      <input type="text" {{readonly}} name="departamento" value="{{departamento}}" maxlength="45" placeholder="Departamento"/>
      {{if departamento_error}}
        <span class="error col-12">{{departamento_error}}</span>
      {{endif departamento_error}}
    </section>




    <!--ASIGNADO EN ENTRADAS Y SALIDAS-->
    <section class="row">
      <label for="asignado" class="col-4">Asignado</label>
      <input type="text" {{readonly}} name="asignado" value="{{asignado}}" maxlength="45" placeholder="Asignado"/>
      {{if asignado_error}}
        <span class="error col-12">{{asignado_error}}</span>
      {{endif asignado_error}}
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