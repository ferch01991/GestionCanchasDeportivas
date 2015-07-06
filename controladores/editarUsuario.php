<?php 
include("../static/site_config.php");
include("../static/clase_mysql.php");
$conexion = new clase_mysql;
$conexion->conectar($db_name,$db_host, $db_user,$db_password);

extract($_POST);

@$target_path = "../imagenes/usuarios/";
@$target_path = $target_path . basename( $_FILES['imagen']['name']); 
if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target_path)) { 
	$imagenUsuario = $target_path;
}else{
	echo "Ha ocurrido un error, trate de nuevo!";
}
$sql = "UPDATE usuarios 
		SET nombres = '$nombres', apellidos = '$apellidos', password = '$password', telefono = '$telefono', direccion = '$direccion', acerca = '$acerca', imagen = '$imagenUsuario'
		WHERE id = '$id'";
$conexion->ejecutar($sql);
chmod($imagenUsuario, 0755); 
header("location:../vistas/muro.php?idUsuario=$id");
?>