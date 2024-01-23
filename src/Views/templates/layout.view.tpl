<!DOCTYPE html>
<html>
<!--NAVBAR Y FOOTER-->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <title>{{SITE_TITLE}}</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/{{BASE_DIR}}/public/css/appstyle.css" />
  <link rel="stylesheet" href="/{{BASE_DIR}}/public/css/backgrounds.css" />
  <link rel="stylesheet" href="/{{BASE_DIR}}/public/css/crearCuenta.css" />
  <link rel="stylesheet" href="/{{BASE_DIR}}/public/css/inicio.css" />
  <link rel="stylesheet" href="/{{BASE_DIR}}/public/css/login.css" />
  <link rel="stylesheet" href="/{{BASE_DIR}}/public/css/colors.css" />
  <script src="https://kit.fontawesome.com/{{FONT_AWESOME_KIT}}.js" crossorigin="anonymous"></script>
  {{foreach SiteLinks}}
  <link rel="stylesheet" href="/{{~BASE_DIR}}/{{this}}" />
  {{endfor SiteLinks}}
  {{foreach BeginScripts}}
  <script src="/{{~BASE_DIR}}/{{this}}"></script>
  {{endfor BeginScripts}}
</head>

<body>
  <!--NAVBAR DE LA PÁGINA PRINCIPAL DEL SISTEMA DE INVENTARIO-->
  <nav class="navbar navbar-expand-lg bg-body-tertiary p-1" data-bs-theme="dark" style="background-color: var(--negro)!important;">
    <div class="container-fluid bg-negro">
      
      <!--PARTE DEL NAVBAR QUE LLEVA EL LOGO Y EL NOMBRE DE LA EMPRESA-->
      <a class="navbar-brand tb-align txt-blanco" href="index.php?page=index">
        <img src="public\imgs\SAGRADAFAMILIA.png" alt="Logo" width="85" height="55"
          class="d-inline-block align-text-middle">
        Cooperativa Sagrada Familia
      </a>
      
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!--LISTA DE LOS ITEMS DEL NAVBAR VACIA PARA NO DEFORMAR EL ICONO DE INICIAR SESIÓN-->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        </ul>
        <!--ESTO ES DEL BANNER PARA ABAJO-->
        <ul class="navbar-nav mx-3"> 
          <!--ESTO ES PARA EL ICONO DE INICIO DE SESIÓN-->        
          <li class="nav-item mx-4 menuItem2">
          
            <a class="nav-link active" style="color:var(--blanco)" href="index.php?page=sec_login"><i class="fa-regular fa-user fa-lg" style="color: #ffffff;"></i></a>
          </li>          
        </ul>
      </div>
      
    </div>
  </nav>
  <main>
    {{{page_content}}}
  </main>
  

  <!--ESTO ES DEL FOOTER-->
  <footer class="bg-gris_oscuro">
    <div class="container p-4 bg-gris_oscuro">
      <div class="row justify-content-center bg-gris_oscuro pb-0">
          <div class="col-12 text-center">
            <a class="text-white mx-3" style="text-decoration: none;" href="index.php?page=index">INICIO</a>          
          </div>
          <hr class="lineas my-4">
          <div class="row my-4">
            <div class="col-6 text-white">
             JALL | todos los derechos reservados 2023 &copy;
            </div>
            <div class="col-6 text-end">
              <a class="mx-3" href="https://www.youtube.com/@coop.sagradafamiliahondura5496"><i class="fa-brands fa-youtube fa-2xl" style="color: #198800;"></i></a>
              <a class="mx-3" href="https://www.filialelectronica.hn/"><i class="fa-solid fa-desktop fa-2xl" style="color: #198800;"></i></a>
              <a class="mx-3" href="https://www.instagram.com/"><i class="fa-brands fa-instagram fa-2xl" style="color: #198800;"></i></a>
            </div>
          </div>
      </div>

    </div>
  </footer>
  {{foreach EndScripts}}
  <script src="/{{~BASE_DIR}}/{{this}}"></script>
  {{endfor EndScripts}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

</body>

</html>