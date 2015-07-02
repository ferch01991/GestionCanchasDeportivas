<?php
include("../static/site_config.php");
include("../static/clase_mysql.php");
$conexion = new clase_mysql;
$conexion->conectar($db_name,$db_host, $db_user,$db_password);
extract($_POST);
echo $usuario;
$resultado = $conexion->autenticar($usuario, $password);
if ($resultado == 0){
	echo "FALLIDO";
}else{
	$sql = "select id from usuarios where email ='".$usuario."'";
	$id = $conexion->sacarId($sql);
	header("location:../vistas/muro.php?id=$id");
}
?>