<?php 
include ("../static/site_config.php");
include ("../static/clase_mysql.php");
$conexion = new clase_mysql;
echo "string";
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
	echo "<script>
	function alerta(){
		alertify.alert('Blog Reaccion Estudio probando Alertify', function () {
		});
";
header("location:../vistas/grupo.php?idGrupo=".$idGrupo."&idUsuario=".$idUsuario."");
}

?>

