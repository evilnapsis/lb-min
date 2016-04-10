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
      <a class="navbar-brand" href="./">LB-MIN</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="./">INICIO</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Crud <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Ver</a></li>
            <li><a href="#">Agrear</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>


<?php 
  View::load("index");
?>
<script src="res/bootstrap/js/bootstrap.min.js"></script>


  </body>
</html>
