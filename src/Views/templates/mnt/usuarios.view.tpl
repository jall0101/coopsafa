<h1>Gestión de Usuarios</h1>
<section class="WWFilter">

</section>
<section class="WWList table-responsive">
  <table class="table table-striped table-hover tb-align">
    <thead>
      <tr class="bg-gris_oscuro tb-align text-white p-5">
        <th scope="col">Código</th>
        <th scope="col">Email</th>
        <th scope="col">Username</th>
        <th scope="col">User Fetching</th>
        <th scope="col">Estado Password</th>
        <th scope="col">Password Exp</th>
        <th scope="col">Estado usuario</th>
        <th scope="col">Tipo</th>
        <th>
          {{if ~usuarios_new}}
          <button class="bg-dark rounded" id="btnAdd"><i class="fa-solid fa-plus" style="color: #ffffff;"></i></button>
          {{endif ~usuarios_new}}
        </th>
      </tr>
    </thead>
    
    <tbody>
      {{foreach usuarios}}
      <tr class="bg-white">
        <td><b>{{usercod}}</b></td>
        <td>
          {{if ~usuarios_view}}
          <a class="text-decoration-none text-success font-weight-bold" 
            href="index.php?page=mnt_usuario&mode=DSP&usercod={{usercod}}">{{useremail}}</a>
          {{endif ~usuarios_view}}
          {{ifnot ~usuarios_view}}
            {{descripciontalla}}
          {{endifnot ~usuarios_view}}

        </td>

        <td>{{username}}</td>
        <td>{{userfching}}</td>
        <td>{{userpswdest}}</td>
        <td>{{userpswdexp}}</td>
        <td>{{userest}}</td>
        <td>{{usertipo}}</td>
        <td>
          {{if ~usuarios_edit}}
          <form action="index.php" method="get">
            <input type="hidden" name="page" value="mnt_usuario"/>
            <input type="hidden" name="mode" value="UPD" />
            <input type="hidden" name="usercod" value={{usercod}} />
            <button type="submit" class="bg-success"><i class="fa-solid fa-pen-to-square fa-lg"></i></button>
          </form>
          {{endif ~usuarios_edit}} <br>
          {{if ~usuarios_delete}}
          <form action="index.php" method="get">
            <input type="hidden" name="page" value="mnt_usuario"/>
            <input type="hidden" name="mode" value="DEL" />
            <input type="hidden" name="usercod" value={{usercod}} />
            <button type="submit" class="bg-secondary"><i class="fa-solid fa-trash fa-lg"></i></button>
          </form>
          {{endif ~usuarios_delete}}
        </td>
      </tr>
      {{endfor usuarios}}
    </tbody>
  </table>
</section>
<script>
   document.addEventListener("DOMContentLoaded", function () {
      document.getElementById("btnAdd").addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=mnt_usuario&mode=INS&usercod=0");
      });
    });
</script>