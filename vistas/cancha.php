<?php
include("../static/site_config.php");
include("../static/clase_mysql.php");
$conexion = new clase_mysql;
$conexion->conectar($db_name,$db_host, $db_user,$db_password);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Alineaciones</title>
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../estilos/estilos.css">
  <link href="navbar.css" rel="stylesheet">
  <script src="../bootstrap/js/ie-emulation-modes-warning.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <style>
  #draggable {
    width: 60px;
    height: 60px;
    text-align: center;
    position: relative;
    border: solid;
    border-color: #757171;
    border-radius: 70px;
    position: relative;
    margin-top: 30px;
    display: inline-block;
  }
  #droppable {
    position: absolute;
    left: 380px;
    margin-top: 220px;
    top: 0;
    width: 624px;
    height: 334px;
    background-image: url("../imagenes/fondos/cancha.png");
    color: #fff;
    padding: 10px;
  }
  </style>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
</head>
<body id="bodyMuro">
  <?php
   extract($_GET);
   $usuario = $conexion->datosUsuario($idUsuario);
   include("../static/menu1.php");

   ?>

  <div id="droppable"></div>
  <div id="infoPartidos" style="border: solid;">
    <?php
    extract($_GET);
    $conexion = new clase_mysql;
    $conexion->conectar($db_name,$db_host, $db_user,$db_password);
    $res= $conexion->consulta("SELECT distinct u.imagen,u.nombres from usuarios u, confirmaciones c where (c.estado='aceptado' and c.id_partido='$idPartido')and u.id=c.id_usuario ");
    while (@$row = mysql_fetch_array($res)) {
      @$id=$row['imagen'];
      @$nombre=$row['nombres'];
      echo '<div id="draggable">';
      echo "<img><img src='".$id."' WIDTH=50px HEIGHT=50px style='border-radius: 71px'></>";
      echo "<h5 style='color:white'>".$nombre."</h5>";
        //echo "<hr>";
      echo '</div>';
    }
    ?>
    <script>
    $( "#draggable,#draggable2" ).draggable({
     connectWith:".s1"
    });
    $( "#droppable" ).droppable({
      drop: function() {
    }
    });
    </script>

  </div>
  <form action="../imagenes/captura/img_captura.php" method="POST">
    <center>
      <input type="submit" value="Captura Imagen" class="btn btn-success" name="btnter">
    </center>
  </form>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../bootstrap/js/ie10-viewport-bug-workaround.js"></script>

</body>
</html>