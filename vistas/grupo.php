<?php
include("../static/site_config.php"); 
include("../static/clase_mysql.php");
$conexion = new clase_mysql;
$conexion->conectar($db_name,$db_host, $db_user,$db_password);
?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Grupos</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../estilos/estilos.css">
</head>
<body id="bodyMuro">

	<?php
	extract($_GET);
	$grupo = $conexion->datosGrupo($idGrupo);
	$nombreGrupo = $grupo[0];
	$logoGrupo = $grupo[1];
	$idGrupo = $grupo[2];
	$usuario = $conexion->datosUsuario($idUsuario);
	$idUsuario = $usuario[0];
	include("../static/menu1.php");
	?>

	<div class="container" id="izquierda" align="center">
		<div>
			<?php echo "<img id='imagenUsuario' align='center' position='relative' src=".$logoGrupo." WIDTH=140 WEIGTH=140>"?>
			<h4><?php echo $nombreGrupo ?> </h4>
		</div>
		<h4 align="left">Integrantes:</h4>
		<div id="integrantesGrupo">
			
			<?php
			$usuarios = $conexion->usuarios($idGrupo);
			echo "<div align='left'>";
			while ($row = mysql_fetch_row($usuarios)) {
				echo "<img id='imagenUsuarioPequenia' src='".$row[1]."' alt='' width='20' height='20'>";
				echo "<label style='color:black'>".$row[0]." ".$row[2]."</label>";
				echo "<br>";					
			}
			echo "</div>";
			?>
		</div>
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

	<div class="container" id="centro1">
		
		<div class="container" id="formComentarios">
			<br>
			<form enctype="multipart/form-data" action="../controladores/nuevoComentario.php" method="POST">
				<input name="encabezado" class="form-control" type="text" placeholder="Que hay?">
				<br>
				<input type="file" class="form-control" placeholder="" name="imagen">
				<?php echo "<input required type='hidden' class=form-'control' name='idUsuario' value=".$usuario[0]."> "?>
				<?php echo "<input required type='hidden' class=form-'control' name='idGrupo' value=".$idGrupo."> "?>
				<br>
				<div align="center"><button name="botonEnviar" type="submit" class="btn btn-success">Publicar</button></div>
			</form>
		</div>
		<br>
		<br>
		<div id="comentariosGrupo">
			<?php 
			$conexion->comentariosGrupo($idGrupo);
			?>
		</div>
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
				<div align="center">
					<button name="botonEnviar" type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal">Crear Partido</button>
				</div>
			</form>
		</div>
		
		
	</div>
	<div class="container" id="chat">
		<form id="formChat" role="form">
			<div class="panel panel-default">
				<div class="panel-heading">
					<?php
					$grupo = $conexion->grupo_chat($_GET['idGrupo']);
					echo "<h3 class='panel-title'>".$grupo."</h3>";
					?>
				</div>
				<div class="panel-body">
					<div id="conversacion" style="height: 65%; border: 1px solid #CCCCCC; padding: 12p%; border-radius: 5px; overflow-x: hidden;">
					</div>
					<?php echo "<input type='hidden' name='idGrupo' value =".$idGrupo." >"?>
					<?php echo "<input required name='idUsuario' type='hidden' value=".$idUsuario.">"?>
					<div class="panel-footer">
						<div class="input-group">
							<input type="text" class="form-control" id="mensaje" name="mensaje">
							<span class="input-group-btn">
								<button id="enviar" class="btn btn-primary" type="button">Enviar</button>
							</span>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="../bootstrap/js/bootstrap.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script>
	$(document).on("ready", function(){
		registrarMensaje();
		$.ajaxSetup({"cache":false});
		setInterval("loadLdMessages()",200);
	});
	var registrarMensaje = function(){
		$("#enviar").on("click", function(evento){
			evento.preventDefault();
			var frm = $("#formChat").serialize();
			$.ajax({
				type: "POST",
				url: "../controladores/registro_chat.php",
				data: frm
			}).done(function(info){
				var altura = $("#conversacion").prop("scrollHeight");
				$("#conversacion").scrollTop(altura);
				console.log(info);
			})
		});
	}
	var loadLdMessages = function(){
		var frm = $("#formChat").serialize();
		$.ajax({
			type: "POST",
			url: "../controladores/conversacion.php",
			data: frm
		}).done(function(info){
			$("#conversacion").html( info );
			$("#conversacion p:last-child").css({"background-color":"lightgreen", "padding-botton":"20px"});
			var altura = $("#conversation").prop("scrollHeight");
			$("#conversacion").scrollTop(altura);
			console.log(info);
		});
	}	
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>