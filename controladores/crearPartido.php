<?php 
include ("../static/site_config.php");
include ("../static/clase_mysql.php");
$conexion = new clase_mysql;
$conexion->conectar($db_name,$db_host, $db_user,$db_password);
extract($_POST);
$canOcupadas = $conexion->controlCancha($cancha, $fecha, $hora);
if ($canOcupadas == 0) {
	$sql = "INSERT INTO partidos VALUES ('','$idGrupo','$cancha','$fecha','$hora','','')";
	$conexion->ejecutar($sql);	
	$idPartido = $conexion->idPartido($idGrupo, $cancha, $fecha, $hora);
	$resJugadores = $conexion->usuarios($idGrupo);
	while ($jugador = mysql_fetch_row($resJugadores)){
		$sql = "INSERT INTO confirmaciones VALUES ('','$idPartido','$jugador[3]','pendiente')";
		echo $sql;
		echo "<br>";
		$conexion->ejecutar($sql);
	}
	header("location:../vistas/grupo.php?idGrupo=".$idGrupo."&idUsuario=".$idUsuario."");
}else{
	echo "<script type='text/javascript'>";
	echo "alert('La cancha selecionada no esta disponible a esa hora');";
	echo "location.href = '../vistas/grupo.php?idGrupo=".$idGrupo."&idUsuario=".$idUsuario."';";
	echo "</script>";
}
?>

