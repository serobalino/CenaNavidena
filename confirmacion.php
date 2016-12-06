<?php
require_once("funciones/autenticacion.php");
acceso();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirmación de Asistencia</title>
    <!-- CCSs --->
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <link rel="stylesheet" href="dependecias/css/bootstrap.min.css">
    <link rel="stylesheet" href="dependecias/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="dependecias/css/animate.min.css">
    <link rel="stylesheet" href="dependecias/css/font-awesome.min.css">
    <link rel="stylesheet" href="dependecias/css/estilos.css">
  </head>
  <body>
    <canvas id="canvas"></canvas>
    <header></header>
    <article class="main">
      <div class="container">
        <div class="well well-lg row text-center">
          <h1 class="navidad animated fadeInUp">Navidad <?php echo date("Y")?></h1>
          <br><br>
          <div class="col-md-11 col-xs-11 text-justify">
            <p id="tiempo" class="text-danger"></p>
            <div id="alerta"></div>

            <form class="entrada" method="post">
              <div class="btn-group">
               <a href="#" class="btn btn-default active">Confirmar Asistencia</a>
               <a href="numeros" class="btn btn-default">Registrar tu participación Artística</a>
               <a href="ayudas" class="btn btn-default">Revisa la lista de materiales</a>
              </div>
              <p class="text-success">Hola, <?php echo $_SESSION["USR_NOM"]?>, formas parte de la familia <?php echo $_SESSION["USR_FNOM"]?></p>
              <p class="text-success" id="filia"></p>
            </form>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
          </div>
        </div>
      </div>
    </article>
    <footer></footer>
    <!-- JSs --->
    <script charset="utf-8" src="dependecias/js/jquery.min.js" ></script>
    <script charset="utf-8" src="dependecias/js/bootstrap.min.js" ></script>
    <script charset="utf-8" src="dependecias/js/bootstrapValidator.js" ></script>
    <script charset="utf-8" src="dependecias/js/confirmacion.js" ></script>
    <script charset="utf-8" src="dependecias/js/nieve-js.js" ></script>
    <script charset="utf-8" src="funciones/login?fecha" ></script>
  </body>
</html>
