<?php 
include ("../static/site_config.php");
include ("../static/clase_mysql.php");
$conexion = new clase_mysql;
$conexion->conectar($db_name,$db_host, $db_user,$db_password);
extract($_POST);
$sql = "INSERT INTO partidos VALUES ('','$idGrupo','$cancha','$fecha','$hora','','')";
$conexion->ejecutar($sql);	
header("location:../vistas/grupo.php?idGrupo=".$idGrupo."&idUsuario=".$idUsuario."");
?>

