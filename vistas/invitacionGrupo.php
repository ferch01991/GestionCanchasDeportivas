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
<body id="bodyMuro">
	<?php
	extract($_GET);
	$usuario = $conexion->datosUsuario($idUsuario);
	$idG = $idGrupo;
	$datosGrupo = $conexion->datosGrupo($idGrupo);
	include("../static/menu1.php");
	?>

	<div id="invitacion">
		
		<h4>EL grupo: "<?php echo $datosGrupo[0]?>" te ha invitado a unirteles!</h4>

		<h4>Que dices?</h4>
		<?php echo "ID DEL GRUPO :".$idGrupo ?>

		<?php echo "<div align='center' style='display: inline-block'><a href='../controladores/invitacionGrupos.php?idUsuario=$idUsuario&idGrupo=$idG&decision=1'><button name='botonEnviar' class='btn btn-success'>Acepto</button></a></div>" ?>
		<?php echo "<div align='center' style='display: inline-block'><a href='../controladores/invitacionGrupos.php?idUsuario=$idUsuario&idGrupo=$idG&decision=2'><button name='botonEnviar' class='btn btn-danger'>Na...</button></a></div>" ?>
		
		
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="../bootstrap/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>