<link rel="stylesheet" href="Styles/estilos_navbar.css">
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand me-auto" href="#">Casa Lai</a>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Casa Lai</h5>
        <button type="button" class="btn-close" href="?pagina=Dashboard" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
          <?php
          //verificamos que exista la variable nivel
          //que es la que contiene el valor de la sesion
          if (!empty($_SESSION['rango'])) {
          ?>
            <?php
            if ($_SESSION['rango'] == 'admin') {
            ?>

              <li class="nav-item">
                <a class="nav-link active mx-lg-2" aria-current="page" href="?pagina=Dashboard">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-lg-2" href="?pagina=Usuarios">Gestionar<br>Usuarios</a>
              </li>
            <?php
            }
            ?>

            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="?pagina=Recepcion">Gestionar<br>Recepcion</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="?pagina=despacho">Gestionar<br>Despacho</a>
            </li>
            <?php
            if ($_SESSION['rango'] == 'admin') {
            ?>
              <li class="nav-item">
                <a class="nav-link mx-lg-2" href="?pagina=marcas">Gestionar<br>Marcas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-lg-2" href="?pagina=modelos">Gestionar<br>Modelos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-lg-2" href="?pagina=Productos">Gestionar<br>Productos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-lg-2" href="?pagina=clientes">Gestionar<br>Clientes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-lg-2 " href="?pagina=Proveedores">Gestionar<br>Proveedores</a>
              </li>
            <?php
            }
            ?>
          <?php
          }
          ?>
        </ul>

      </div>
    </div>

    <a href="?pagina=Login" class="login-button">Cerrar Sesion</a>
    <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>