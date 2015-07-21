<?php
include("../static/site_config.php"); 
include("../static/clase_mysql.php");
$conexion = new clase_mysql;
$conexion->conectar($db_name,$db_host, $db_user,$db_password);
extract($_GET);
if ($op == 2){
	$sql = "UPDATE confirmaciones SET estado = 'aceptado' WHERE id_partido = $idPartido AND id_usuario = $idUsuario";
	$conexion->ejecutar($sql);
}

if ($op == 1){
	$sql = "DELETE FROM confirmaciones WHERE id_partido = $idPartido AND id_usuario = $idUsuario";
	$conexion->ejecutar($sql);
}

if ($op == 3){
	$sql = "UPDATE confirmaciones SET estado = 'pendiente' WHERE id_partido = $idPartido AND id_usuario = $idUsuario";
	$conexion->ejecutar($sql);
}

header("location:../vistas/muro.php?idUsuario=$idUsuario");
?>