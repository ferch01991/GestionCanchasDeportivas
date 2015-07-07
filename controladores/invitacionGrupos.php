<?php 
include("../static/site_config.php");
include("../static/clase_mysql.php");
$conexion = new clase_mysql;
$conexion->conectar($db_name,$db_host, $db_user,$db_password);
extract($_GET);
if ($decision == 1){
	$fecha = date("Y")."/".date("m")."/".date("d");
	$sql = "INSERT INTO usuarios_grupos VALUES ('$idUsuario','$idGrupo','$fecha	')";
	$conexion->ejecutar($sql);	
}
$sql = "DELETE FROM invitaciones WHERE invitaciones.id_grupo = $idGrupo AND invitaciones.id_usuario = $idUsuario";
echo $sql;
$conexion->ejecutar($sql);	

header("location:../vistas/muro.php?idUsuario=$idUsuario");

?>