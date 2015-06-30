<?php 
include("../static/site_config.php");
include("../static/clase_mysql.php");
$conexion = new clase_mysql;
$conexion->conectar($db_name,$db_host, $db_user,$db_password);

extract($_POST);

$sql = "INSERT INTO grupos VALUES('','$nombre','$idUsuario','')";
$conexion->ejecutar($sql);

$fecha = date("Y")."/".date("m")."/".date("d");

$idGrupo = $conexion->idGrupo($nombre, $idUsuario);
$sql = "INSERT INTO usuarios_grupos VALUES ('$idUsuario','$idGrupo','$fecha')";
$conexion->ejecutar($sql);

header("location:../vistas/muro.php?id=$idUsuario");
?>