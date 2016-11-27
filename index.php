<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenid@ </title>
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
          <h1 class="navidad animated fadeInUp">Feliz Navidad <?php echo date("Y");?></h1>
          <div class="col-md-6">
            <img src="imagenes/arbol.gif" alt="Arbol Navidad Robalino" class="img-responsive center-block">
          </div>
          <br><br>
          <div class="col-md-5 text-justify">
            <p id="tiempo" class="text-danger"></p>
            <p class="text-success">Ingresa tu correo electrónico.</p>
            <div id="alerta"></div>
            <form class="text-center entrada" method="post" id="login" data-toggle="validator">
              <input type="email" name="mail" class="form-control input-lg row" value="" required="" placeholder="mail@hotmail.com" autofocus="">
              <br>
              <button type="submit" class="btn btn-default btn-lg">Ingresar <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
            </form>
            <br><br><br><br><br><br>
          </div>
        </div>
      </div>
    </article>
    <footer></footer>
    <!-- JSs --->
    <script charset="utf-8" src="dependecias/js/jquery.min.js" ></script>
    <script charset="utf-8" src="dependecias/js/bootstrap.min.js" ></script>
    <script charset="utf-8" src="dependecias/js/bootstrapValidator.js" ></script>
    <script charset="utf-8" src="dependecias/js/index.js" ></script>
    <script charset="utf-8" src="dependecias/js/nieve-js.js" ></script>
    <script charset="utf-8" src="funciones/login?fecha" ></script>
  </body>
</html>
