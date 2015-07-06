<?php
include("../static/site_config.php");
include("../static/clase_mysql.php");
$conexion = new clase_mysql;
$conexion->conectar($db_name,$db_host, $db_user,$db_password);
?>
<!DOCTYPE html>
<html>
<head>
  <header></header>
  <title>Sistema Canchas</title>
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../estilos/estilos.css">
  <link href="navbar.css" rel="stylesheet">
  <script src="../bootstrap/js/ie-emulation-modes-warning.js"></script>
  </head>
<body id="bodyEditarUsuario">
  <?php
  extract($_GET);
  include("../static/menu1.php");
  $datos = $conexion->datosUsuario($idUsuario);
  ?>
  
  <div id="izquierda" align="center">

    <div>
      <?php echo "<img id='imagenUsuario' align='center' position='relative' src=".$datos[9]." WIDTH=140 WEIGTH=140>"?>
    </div>
    
  </div>

  <div id="centro">
    <h4>Datos Personales</h4>
    <br>
    <form enctype="multipart/form-data" name="registro" action="../controladores/editarUsuario.php" method="POST">
      <div class="row">
        <div class="col-sm-6">
          <?php echo "<input type='text' class='form-control' placeholder=".$datos[1]." name='nombres'>" ?>
          
        </div>
        <div class="col-sm-6">
          <?php echo "<input type='text' class='form-control' placeholder=".$datos[2]." name='apellidos'>" ?>
        </div>
      </div>
      <div class="form-group">
        <br>
        <input type="password" class="form-control" placeholder="Contraseña" name="password">
        <br>
        <?php echo "<input type='text' class='form-control' placeholder=".$datos[6]." name='telefono'>" ?>
        <br>
        <?php echo "<input type='text' class='form-control' placeholder=".$datos[7]." name='direccion'>" ?>
        <br>
        <?php echo "<input type='text' class='form-control' placeholder=".$datos[8]." name='acerca'>" ?>
        <br>
        <input required type="file" class="form-control" placeholder="" name="imagen">
        <?php echo "<input required type='hidden' class=form-'control' name='id' value=".$idUsuario.">    "?>
        
      </div>
      <div align="center"><button name="botonEnviar" type="submit" class="btn btn-success">Registrar</button></div>
      
      
    </form>
  </div>
  
  

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="bootstrap/js/ie10-viewport-bug-workaround.js"></script>
</body>

</html>