<!--
Este es el layout principal, a partir de este layout o plantilla se muestran el resto de "vistas"
-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>.: Lb-min - Evilnapsis :.</title>
    <link href="res/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="res/font-awesome/css/font-awesome.min.css">
    <script src="res/js/jquery.min.js"></script>
  </head>

  <body>
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="./"><b>LB MIN</b></a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="./"><i class='glyphicon glyphicon-home'></i> INICIO</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class='glyphicon glyphicon-th-large'></i> MAS <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="./?view=login">Login</a></li>
            <li><a href="./?view=help">Ayuda</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if(isset($_SESSION["user_id"])):?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="./?view=home">Mi inicio</a></li>
            <li><a href="./?view=users&o=all">Usuarios</a></li>
            <li class="divider"></li>
            <li><a href="./?view=access&o=logout">Salir</a></li>
          </ul>
        </li>
        <?php endif; ?>
      </ul>

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
<p class="text-muted text-center">Powered by <a href="http://evilnapsis.com/" target="_blank">Evilnapsis</a> &copy; 2017</p>
</div>
</div>
</div>

<script src="res/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
