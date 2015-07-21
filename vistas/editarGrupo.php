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
	$grupo = $conexion->datosGrupo($idGrupo);
	$usuario = $conexion->datosUsuario($idUsuario);
	include("../static/menu1.php");
	?>a
	<div align="center" style="padding:3em; margin:3em">
		<div>
			<?php echo "<img id='imagenGrupo' align='center' position='relative' src=".$grupo[1]." WIDTH=140 WEIGTH=140>"?>
		</div>
		<br>
		<br>
		<div align="center" style="width:50%">
			<form enctype="multipart/form-data" name="registro" action="../controladores/editarGrupo.php" method="POST">
				<?php echo "<input type='text' class='form-control' value=".$grupo[0]." name='nombreGrupo'>" ?>
				<br>
				<br>
				<input required type="file" class="form-control" placeholder="" name="imagen">
				<br>
				<br>
				<?php echo "<input required type='hidden' class=form-'control' name='idUsuario' value=".$usuario[0].">    "?>
				<?php echo "<input required type='hidden' class=form-'control' name='idGrupo' value=".$grupo[2].">    "?>
				<div align="center"><button name="botonEnviar" type="submit" class="btn btn-success">Editar</button></div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bootstrap/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>