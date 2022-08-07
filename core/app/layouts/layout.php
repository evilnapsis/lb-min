<!--
Este es el layout principal, a partir de este layout o plantilla se muestran el resto de "vistas"
-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>.: Lb-min - Evilnapsis :.</title>
    <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/bootstrap-icons/bootstrap-icons.css">
    <script src="assets/jquery/jquery.min.js"></script>
  </head>

  <body>



<nav class="navbar navbar-expand-lg bg-light">
  <div class="container">
    <a class="navbar-brand" href="./">LegoBox</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./">Inicio</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Mas
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="./?view=register">Registro</a></li>
            <li><a class="dropdown-item" href="./?view=login">Login</a></li>
            <li><a class="dropdown-item" href="./?view=help">Ayuda</a></li>
          </ul>
        </li>
        <?php if(isset($_SESSION["user_id"])):?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Usuario
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="./?view=home">Mi Inicio</a></li>
            <li><a class="dropdown-item" href="./?view=persons&opt=all">Contactos</a></li>
            <li><a class="dropdown-item" href="./?view=users&opt=all">Usuarios</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="./?action=access&opt=logout">Salir</a></li>
          </ul>
        </li>
      <?php endif; ?>
      </ul>
      <!--
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    -->
    </div>
  </div>

</nav>




<?php 
  View::load("index");
?>

<div class="container">
<div class="row">
<div class="col-md-12">
<br>
<hr>
<p class="text-muted text-center">Powered by <a href="http://evilnapsis.com/" target="_blank">Evilnapsis</a> &copy; 2022</p>
</div>
</div>
</div>

<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
