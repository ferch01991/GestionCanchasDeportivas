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
  <script> 
  function abrir(url) { 
    open(url,'','top=300,left=300,width=300,height=300') ; 
  } 
  </script> 
</head>
<body id="bodyMuro">
  <?php
  extract($_GET);
  $usuario = $conexion->datosUsuario($idUsuario);
  include("../static/menu1.php");
  ?>
  <div class="container" id="izquierda" align="center">

    <div>
      <?php echo "<a id='botonEditarUsuario' href='editarUsuario.php?idUsuario=".$usuario[0]."'><img align='left' src='../imagenes/sistema/editar.png' WIDTH=20 HEIGHT=20></a>"?>
      <?php echo "<img id='imagenUsuario' align='center' position='relative' src=".$usuario[9]." WIDTH=140 WEIGTH=140>"?>
    </div>

    <h4><?php echo $usuario[1] ?></h4>
    <br>
    <a href=""></a>
    <div class="row" id="infoPartidos">
      <?php
      $resPartidos = $conexion->partidosUsuario($usuario[0], "aceptado");
      while ($row = mysql_fetch_row($resPartidos)){
        echo "<a href='../vistas/cancha.php?idPartido=$row[4]&idUsuario=$usuario[0]' target='blank' style='text-decoration: none; color:black'>";
        echo $row[0]." ".$row[1]." ".$row[2]." ".$row[3]." ";
        echo "</a>";
        echo "<a href='../controladores/gestionarPartido.php?idUsuario=$usuario[0]&idPartido=$row[4]&op=3' style='text-decoration: none; color:black'>Ya no juego :/</a>";
        echo "<hr>";
      }
      ?>
    </div>  
  </div>
  <div id="centro">
    <div class="container" id="formComentarios">
      <br>
      <form enctype="multipart/form-data" action="../controladores/nuevoComentario.php" method="POST">
        <input name="encabezado" class="form-control" type="text" placeholder="Que hay?">
        <br>
        <input type="file" class="form-control" placeholder="" name="imagen">
        <?php echo "<input required type='hidden' class=form-'control' name='idUsuario' value=".$idUsuario."> "?>
        <?php echo "<input required type='hidden' class=form-'control' name='idGrupo' value=0> "?>
        <br>
        <div align="center"><button name="botonEnviar" type="submit" class="btn btn-success">Registrar</button></div>
      </form>
    </div>
    <br>
    <br>
    <div id="comentariosMuro">
      <?php 
      $conexion->comentariosMuro($idUsuario);
      ?>
    </div>
  </div>
  <div id="derecha">
    <div>
      <h4>Crea un grupo! </h4>
      <form action="../controladores/crearGrupo.php" method="POST">
        <input required name="nombre" class="form-control" placeholder="Nombre del grupo">
        <br>
        <!--<label>Logotipo</label>
        <input type="file" class="form-control" placeholder="" name="imagen">
        <?php //echo "<input type='hidden' name='idUsuario' value=".$usuario[0].">"?>
        <h6 style="color: #FFF">* Si no selecciona una imagen se utilizara una por defecto y no podrá ser cambiada luego</h6>
      -->
      <?php echo "<input type='hidden' name='idUsuario' value=".$usuario[0].">"?>
      <br>
      <div align="center"><button name="botonEnviar" type="submit" class="btn btn-success">Registrar</button></div>
    </form>
  </div>

  <br>
  <div>
    <h4>Partidos Nuevos:</h4>
    <div id="infoPartidos1">
      <?php
      $resPartidos = $conexion->partidosUsuario($usuario[0], "pendiente");
      while ($row = mysql_fetch_row($resPartidos)){
        echo "<h5>";
        echo $row[0]." ".$row[1]." ".$row[2]." ".$row[3]." ";
        echo "</h5>";
        echo "<div align='center'><a href='../vistas/mapa.php?nombreCancha=$row[1]&idUsuario=$idUsuario&idPartido=$row[4]&op=2'>Hagale! </a></div>";
        echo "<hr>";
      }
      ?>
    </div>
  </div>    
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>