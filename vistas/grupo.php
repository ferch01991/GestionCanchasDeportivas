<?php
    include("../static/site_config.php"); 
    include("../static/clase_mysql.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Grupos</title>
	
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>
	<?php
	extract($_GET);
	$idUsuario;
	 ?>
	<div class="row" id="color">
		<div class="col-md-6 col-md-offset-3" id="centrarTexto">             
		    <h1>
		    <?php
		    $idUsuario; 
		    ?>
		 </h1>
		</div>
	</div>

	<div class="row" align="center">
		<div id="logo posicion" class="col-xs-6 col-md-4">
			<img src="imagen/logo.jpg" alt="" class="img-rounded" width="150" height="150">
			<h3>Logo</h3>
		</div>
		<div id="centrarTexto" class="col-xs-12 col-sm-6 col-md-8">
			
		</div>
	</div>
	<div class="row" align="center">
		<div class="col-xs-6 col-md-4" id="centrar posicion">
			<?php
			$miconexion = new clase_mysql;
			$miconexion->conectar($db_name,$db_host, $db_user,$db_password);
			$usuarios = $miconexion->usuarios();
			while ($row = mysql_fetch_row($usuarios)) {
				echo "<label>";
				echo $row[0];
				echo "</label>";
				echo "<img src='".$row[1]."' alt='' width='100' height='100'>";
				echo "<br>";					
			}
			 ?>
			 <form class="navbar-form navbar-right" role="search" action="controladores/login.php" method="POST">
				<div class="form-group">
					<input required name="usuario" type="email" class="form-control" placeholder="E-mail">
				</div>
				<button type="submit" class="btn btn-default">Ingresar</button>
			</form>
        </div>
		<div class="col-xs-6 col-md-4" id="infoPartidos posicion">
			<?php
			$miconexion = new clase_mysql;
			$miconexion->conectar($db_name,$db_host, $db_user,$db_password);
			$partidos = $miconexion->partidos();
			
			while ($row = mysql_fetch_row($partidos)) {
				echo "<label>";
				echo $row[0]." ";
				echo $row[1]." ";
				echo $row[2]." ";
				echo $row[3]." ";
				echo "</label>";

			}
			?>
		</div>
		<div class="col-xs-6 col-md-4" id="centrar posicion">
		    <form action="static/partido.php" class="form-horizontal" method="POST">
		    	<div class="form-group">
		    		<div class="form-group">	
		    		<?php
		    		$miconexion = new clase_mysql;
					$miconexion->conectar($db_name,$db_host, $db_user,$db_password);
		    		$canchas = $miconexion->selectcancha();
		    		$numCanchas = count($canchas);
		    		echo "<label>Cancha</label>";
		    		echo "<select name='cancha'class='form-control'>";
		    		echo "<option></option>";
		    		for ($i=0; $i < $numCanchas; $i++) {
		    			echo "<option>".$canchas[$i]."</option>";
		    		}
		    		echo "</select>";
		    		?>
		    		</div>
		    		<div class="form-group">
		    			<label>Fecha:</label>
		    			<input type="date" name="fecha">
		    		</div>
		    		<div class="form-group">
		    			<label>Hora:<input type="time" name="hora"></label>
		    		</div>
		    		<div class="col-xs-2">
		    			<label>EquipoA</label><input type="text" name="golesA" class="form-control"><br>
		    			<input type="text" name="golesB" class="form-control"><label>EquipoB</label>
		    			
		    		</div>
		    	<button type="submit" class="btn btn-default">Ingresar</button>
		    	</div>
            </form>
		</div>
	</div>
	
</body>
</html>