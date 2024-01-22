<form class="formulario" method="post" action="index.php?page=sec_register">
  <h1>Crear Cuenta</h1>
    <p>Por favor introduzca sus datos para crear una cuenta</p>
  <hr>
  <div class="contenedor">

      <label><b>Nombre</b></label>
      <br>
      <input class="nombre" type="text" placeholder="Nombre" name="txtNombre" value="{{txtNombre}}" required>
      <br>

      <label><b>Apellido</b></label>
      <br>
      <input class="apellido" type="text" placeholder="Apellido" name="txtApellido" value="{{txtApellido}}" required>
      <br>
      
      <label><b>Género</b></label>
      <br>
      <select name="txtGender" id="">
        <option value="M"> Masculino </option>
        <option value="F"> Femenino </option>
      </select>
      <br>

      <label><b>Teléfono</b></label>
      <br>
      <input class="apellido" type="text" placeholder="Teléfono" name="txtPhone" value="{{txtPhone}}" required>
      <br>

      <label><b>Correo</b></label>
      <br>
      <input class="correo" type="text" placeholder="Correo" id="txtEmail" name="txtEmail" value="{{txtEmail}}" required>
      <br>
      {{if errorEmail}}
        <div class="error col-12 py-2 col-m-8 offset-m-4">{{errorEmail}}</div>
      {{endif errorEmail}}
      <label><b>Contraseña</b></label>
      <br>
      <input class="contrasena" type="password" placeholder="Contraseña" id="txtPswd" name="txtPswd" value="{{txtPswd}}" required>
      <br>
      {{if errorPswd}}
        <div class="error col-12 py-2 col-m-8 offset-m-4">{{errorPswd}}</div>
      {{endif errorPswd}}
      <hr>

      {{if hasErrors}}
      <section>
        <ul>
          {{foreach generalErrors}}
          <li>{{this}}</li>
          {{endfor generalErrors}}
        </ul>
      </section>
      {{endif hasErrors}}
      <p>Creado por JALL©.<a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
  
      <div class="botones">
        <button id="btnSignin" type="submit" class="signupbtn">Crear Cuenta</button>
      </div>

      <div class="text-center m-4 h5">
        <b>¿Ya tienes una cuenta? <a href="index.php?page=sec_login" class="txt-verde">Iniciar Sesión</a></b>
      </div>
    </div>
  
</form>