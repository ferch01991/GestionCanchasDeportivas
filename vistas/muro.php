<?php
include("../static/site_config.php");
include("../static/clase_mysql.php");
$conexion = new clase_mysql;
$conexion->conectar($db_name,$db_host, $db_user,$db_password);
?>

<html>
<head>
  <header></header>
  <title>Sistema Canchas</title>
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../estilos/estilos.css">
  <link href="navbar.css" rel="stylesheet">
  <script src="../bootstrap/js/ie-emulation-modes-warning.js"></script>
</head>
<body id="bodyMuro">
  <?php
  extract($_GET);

  $datos = $conexion->datosUsuario($id);
  include("../static/menu1.php");
  ?>
  <div id="izquierda" align="center">
    
    <div>
      <?php echo "<a id='botonEditarUsuario' href='editarUsuario.php?id=".$datos[0]."'><img align='left' src='../imagenes/sistema/editar.png' WIDTH=20 HEIGHT=20></a>"?>
      <?php echo "<img id='imagenUsuario' align='center' position='relative' src=".$datos[9]." WIDTH=140 WEIGTH=140>"?>
    </div>
     
    <h4><?php echo $datos[1] ?></h4>
    <br>
    
    <div id="infoPartidos">
      
      <h5>partidos</h5>
      <h5>partidos</h5>
      <hr>
      <h5>partidos</h5>
      <h5>partidos</h5>
      <hr>
      <h5>partidos</h5>
      <h5>partidos</h5>
      <hr>
      <h5>partidos</h5>
      <h5>partidos</h5>
      <hr>
      <h5>partidos</h5>
      <h5>partidos</h5>
      <hr>
      <h5>partidos</h5>
      <h5>partidos</h5>
      <h5>partidos</h5>

    </div>  
    
  </div>
  <div id="centro">
    <h4>Información BD</h4>
  </div>
  <div id="derecha">
    <div>
      <h4>Crea un grupo! </h4>
      <form action="../controladores/crearGrupo.php" method="POST">
        <input required name="nombre" class="form-control" placeholder="Nombre del grupo">
        <br>
        <input type="file" class="form-control" placeholder="" name="imagen">
        <br>
        <?php echo "<input type='hidden' name='idUsuario' value=".$datos[0].">"?>
        <div align="center"><button name="botonEnviar" type="submit" class="btn btn-success">Registrar</button></div>
      </form>
    </div>    
  </div>
  

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../bootstrap/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>