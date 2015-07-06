<?php
include("../static/site_config.php");
include("../static/clase_mysql.php");
$conexion = new clase_mysql;
$conexion->conectar($db_name,$db_host, $db_user,$db_password);
extract($_POST);
if ($genero == "Hombre"){
	$imagen = "../imagenes/usuarios/avatarHombre.png";
}else{
	$imagen = "../imagenes/usuarios/avatarMujer.png";
}
$sql = "INSERT INTO usuarios VALUES('','$nombres','$apellidos',	'$email', '$password', '$genero','','','','$imagen')";
$conexion->ejecutar($sql);
$sql = "select id from usuarios where email ='".$email."'";
$id = $conexion->sacarId($sql);
header("location:../vistas/muro.php?idUsuario=$id");
?>