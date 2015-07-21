<?php 
include("../static/site_config.php");
include("../static/clase_mysql.php");
$conexion = new clase_mysql;
$conexion->conectar($db_name,$db_host, $db_user,$db_password);

extract($_POST);


@$target_path = "../imagenes/grupos/";
@$target_path = $target_path . basename( $_FILES['imagen']['name']); 
if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target_path)) { 
	$imagenGrupo = $target_path;
}else{
	echo "Ha ocurrido un error, trate de nuevo!";
}
$sql = "UPDATE grupos 
		SET nombre = '$nombreGrupo', logo = '$imagenGrupo' WHERE grupos.id = ".$idGrupo." ";
$conexion->ejecutar($sql);
chmod($imagenGrupo, 0755); 
 header("location:../vistas/muro.php?idUsuario=$idUsuario");
?>