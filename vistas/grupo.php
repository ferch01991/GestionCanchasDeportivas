<?php
include("../static/site_config.php"); 
include("../static/clase_mysql.php");
$conexion = new clase_mysql;
$conexion->conectar($db_name,$db_host, $db_user,$db_password);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Grupos</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../estilos/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body id="bodyMuro">
	<?php
	extract($_GET);
	include("../static/menu1.php");
	?>

	<div id="izquierda" align="center">
		<div>
			<?php
			$usuarios = $conexion->usuarios($idGrupo);
			while ($row = mysql_fetch_row($usuarios)) {
				echo "<label>".$row[0]." ".$row[2]."</label>";
				echo "<img src='".$row[1]."' alt='' width='20' height='20'>";
				echo "<br>";					
			}
			?>
		</div>
	</div>

	<div id="centro">
		<?php

		$partidos = $conexion->partidos($idGrupo);
		while ($row = mysql_fetch_row($partidos)) {
			echo "<label>";
			echo $row[0]." ";
			echo $row[1]." ";
			echo $row[2]." ";
			echo $row[3]." ";
			echo "</label>";
			echo "<br>";
		}
		?>
	</div>

	<div id="derecha">
		<div>
			<h4>Crea un Partido!</h4>
			<form action="../controladores/crearPartido.php" method="POST">
				<select required name="cancha" class="form-control" placeholder="Selecciona una cancha">
					<?php
					$resCanchas = $conexion->selectcancha();
					echo "<option>-Seleccione una cancha-</option>";
					while ($row = mysql_fetch_row($resCanchas)){
						echo "<option value=".$row[0].">".$row[1]."</option>";
						echo "<hr>";
					}
					?>
				</select>
				<br>
				<input required name="fecha" class="form-control" type="date" placeholder="Eliga una fecha">
				<br>
				<select required name="hora" class="form-control">
					<?php
					for ($i=8; $i <= 24; $i++) { 
						echo "<option value=".$i.':00:00'.">".$i.":00:00</option>";
					}
					?>
				</select>
				<br>
				<?php echo "<input required name='idGrupo' type='hidden' value=".$idGrupo.">"?>
				<?php echo "<input required name='idUsuario' type='hidden' value=".$idUsuario.">"?>
				<br>
				<div align="center">
					<button name="botonEnviar" type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal">Crear Partido</button>
				</div>
			</form>
		</div>
		<br>
		<li class="Separator"></li>
		<br>
		<div>
			<h4>Invita un parce!</h4>
			<form action="../controladores/mailusuarios.php" method="POST">
				<input name="email" class="form-control" placeholder="Correo Electronico">
				<br>
				<?php echo "<input type='hidden' name='idGrupo' value =".$idGrupo." >"?>
				<?php echo "<input required name='idUsuario' type='hidden' value=".$idUsuario.">"?>
				<div align="center"><button name="botonEnviar" type="submit" class="btn btn-success">Invitar</button></div>
			</form>
		</div>
	</div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="../bootstrap/js/bootstrap.js"></script>
	<script src="../bootstrap/js/npm.js"></script>
	<script src="../bootstrap/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>