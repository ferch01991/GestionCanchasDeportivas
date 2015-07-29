<?php
include("static/site_config.php");
include("static/clase_mysql.php");
?>

<html>
<head>
  <title>Sistema Canchas</title>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="estilos/estilos.css">
  <link href="navbar.css" rel="stylesheet">
  <script src="bootstrap/js/ie-emulation-modes-warning.js"></script>
  <script language="javascript" type="text/javascript">
    function validarEmail(){
      with (document.forms['registro']){
        if (email.value == email2.value){
          document.forms['registro'].imgValidar.src='imagenes/sistema/ok.png';
          document.forms['registro'].botonEnviar.disabled=false;
        }else{
          document.forms['registro'].imgValidar.src='imagenes/sistema/no.png';
          document.forms['registro'].botonEnviar.disabled=true;
        }
      }
    }
  </script>
</head>
<body id="bodyInicio">

  <?php
  include("static/menu.php");
  ?>
  <div id="imagenInicio">
  </div>
  <div id="Registro">
    <h3>Aun no eres usuario?</h3>
    <h5>Registrate gratis</h5>
    <br>
    <form name="registro" action="controladores/registro.php" method="POST">
      <div class="row">
        <div class="col-sm-6">
          <input required type="text" class="form-control" placeholder="Nombres" name="nombres">
        </div>
        <div class="col-sm-6">
          <input required type="text" class="form-control" placeholder="Apellidos" name="apellidos">
        </div>
      </div>
      <div class="form-group">
        <br>
        <input required type="email" class="form-control" placeholder="Correo electronico" name="email">
        <img name="imgValidar" src="" WIDTH=20 WEIGTH=20>
        <input autocomplete="off" required type="email"  class="form-control" placeholder="Vuelve a introducir tu correo" name="email2" onKeyup="validarEmail()">
        <br>
        <input required type="password" class="form-control" placeholder="Contraseña" name="password">
        <br>
        <select class="form-control" name="genero">
          <option value="Hombre">Hombre</option>
          <option value="Mujer">Mujer</option>
        </select>
      </div>
      <div align="center"><button name="botonEnviar" type="submit" class="btn btn-success">Registrar</button></div>


    </form>
  </div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="bootstrap/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
