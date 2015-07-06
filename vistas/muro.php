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
      $cont = 0;
      while ($row = mysql_fetch_row($resPartidos)){
        echo "<a href='../vistas/cancha.php?idPartido=$row[4]' target='blank'>";
        echo $row[0]." ".$row[1]." ".$row[2]." ".$row[3]." ";
        echo "</a>";
        echo "<hr>";
        $cont = $cont+1;
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
        <input type="file" class="form-control" placeholder="" name="imagen">
        <br>
        <?php echo "<input type='hidden' name='idUsuario' value=".$datos[0].">"?>
        <div align="center"><button name="botonEnviar" type="submit" class="btn btn-success">Registrar</button></div>
      </form>
    </div>

    <br>
    <br>
    <div>
      <h4>Te han invitado a unirte</h4>
      <label>Confirmar
      <button type="button" class="btn btn-primary">Aceptar</button>
      <button type="button" class="btn btn-danger">Rechazar</button>
      </label>
      <?php
      $resInvitaciones = $conexion->invitaciones($datos[0]);
      while ($row = mysql_fetch_row($resInvitaciones)){
        $grupo = $conexion->datosGrupo($row[0]);
        echo "<div align='left' style='display: inline-block'><h5>".$grupo[0]."</h5></div>";
        echo "<div align='right' style='display: inline-block'>";
        echo "<button type='submit' class='btn btn-success btn-xs'>Aceptar</button>";
        echo "<button type='submit' class='btn btn-danger btn-xs'>Rechazar</button>";
        echo "</div>";
        echo "<br>";
      }
      ?>
    </div>    
  </div>
  

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../bootstrap/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>