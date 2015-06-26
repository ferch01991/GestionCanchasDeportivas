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
	<title>Editor Usuario</title>

</head>
<body>
    <div class="container" style="background: #ccc; text-align:center;">
        <h1>Perfil Usuario</h1>
    </div>
  <div class="container">
  	<div class="row">
  		<div class="col-md-12">
  		<h2>Avance(%)</h2>
  			<div class="progress">
  			<div class="progress-bar" role="progressbar" aria-valuenow="50"
  				aria-valuemin="0" aria-valuemax="100" style="width: 20%;">
  				<span class="sr-only">20% completado</span>
  			</div>
  		</div>
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
 <footer class="footer" style="background: #ccc; padding:10px; text-align:center">
	<h4>Derechos reservados</h4>
</footer>
</html>