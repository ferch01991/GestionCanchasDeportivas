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
  $datos = $conexion->datosUsuario($idUsuario);
  include("../static/menu1.php");
  ?>
  <div id="izquierda" align="center">

    <div>
      <?php echo "<a id='botonEditarUsuario' href='editarUsuario.php?idUsuario=".$datos[0]."'><img align='left' src='../imagenes/sistema/editar.png' WIDTH=20 HEIGHT=20></a>"?>
      <?php echo "<img id='imagenUsuario' align='center' position='relative' src=".$datos[9]." WIDTH=140 WEIGTH=140>"?>
    </div>

    <h4><?php echo $datos[1] ?></h4>
    <br>
    <a href=""></a>
    <div id="infoPartidos">
      <?php
      $resPartidos = $conexion->partidosUsuario($datos[0]);
      while ($row = mysql_fetch_row($resPartidos)){
        echo "<a href='../vistas/cancha.php?idPartido=$row[4]' target='blank'>";
        echo $row[0]." ".$row[1]." ".$row[2]." ".$row[3]." ";
        echo "</a>";
        echo "<hr>";
      }
      ?>
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
        <label>Logotipo</label>
        <input type="file" class="form-control" placeholder="" name="imagen">
        <?php echo "<input type='hidden' name='idUsuario' value=".$datos[0].">"?>
        <h6 style="color: #FFF">* Si no selecciona una imagen se utilizara una por defecto y no podrá ser cambiada luego</h6>
        <br>
        <div align="center"><button name="botonEnviar" type="submit" class="btn btn-success">Registrar</button></div>
      </form>
    </div>

    <br>
    <br>
    <div>
      <h4>Partidos Nuevos:</h4>
      <div>
        <?php
        $resInvitaciones = $conexion->invitacionesPartido($idUsuario);
        while ($invitacion = mysql_fetch_row($resInvitaciones)){
          $resPartido = $conexion->informacionPartido($invitacion[1]);
          while ($partido = mysql_fetch_row($resPartido)){
            echo $partido[0]." ".$partido[1]." ".$partido[2]." ".$partido[3]."";
            echo "<br>";
          }
        }
        ?>
      </div>
    </div>    
  </div>
  

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../bootstrap/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>