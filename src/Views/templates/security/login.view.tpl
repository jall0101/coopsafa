<form class="formulario" method="post"
  
  action="index.php?page=sec_login{{if redirto}}&redirto={{redirto}}{{endif redirto}}">
  <h1>Iniciar Sesión</h1>
  <hr>

  <div class="contenedor">

    <label><b>Correo</b></label>
    <br>
    <input class="correo" type="text" id="txtEmail" name="txtEmail" value="{{txtEmail}}" placeholder="Correo" required>
    <br>
    {{if errorEmail}}
    <div class="error col-12 py-2 col-m-8 offset-m-4">{{errorEmail}}</div>
    {{endif errorEmail}}
    <label><b>Contraseña</b></label>
    <br>
    <input class="contrasena" type="password" id="txtPswd" name="txtPswd" placeholder="Contraseña" value="{{txtPswd}}"
      required>
    <br>
    {{if errorPswd}}
    <div class="error col-12 py-2 col-m-8 offset-m-4">{{errorPswd}}</div>
    {{endif errorPswd}}
    <hr>
    {{if generalError}}
    <div class="row">
      {{generalError}}
    </div>
    {{endif generalError}}
    <p>Creado por JALL©.<a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="botones">
      <button id="btnLogin" type="submit" class="iniciar">Iniciar Sesión</button>
    </div>

    <div class="text-center m-4 h5">
      <b>¿No tienes una cuenta? <a href="index.php?page=sec_register" class="txt-verde">Crear Cuenta</a></b>
    </div>

  </div>

</form>