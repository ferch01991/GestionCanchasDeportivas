<?php
include("static/site_config.php");
include("static/clase_mysql.php");

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/estilos.css">

    <section id="encabezado" style="background-image: url('img/header-sprite.png');background-repeat: no-repeat; ">
        <h2>Perfil</h2>
    </section>

</head>
<body style="background-image: url('img/fondo.jpg');background-repeat: no-repeat;">

  
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      </div>
       <?php
        $conexion = new clase_mysql;
        $conexion->conectar($db_name,$db_host, $db_user,$db_password);
        $conexion->consulta("select * from usuarios where id='2'");
        $conexion->verconsulta2();
       ?>

    </div>
    
    </div>
  
</body>
 <footer style="background-image: url('img/fondopie.jpg');">
  <h4>Derechos reservados</h4>
</footer>
</html>