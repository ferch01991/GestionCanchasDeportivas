<?php 
include("../static/site_config.php");
include("../static/clase_mysql.php");
$conexion = new clase_mysql;
$conexion->conectar($db_name,$db_host, $db_user,$db_password);

extract($_POST);

@$target_path = "../imagenes/usuarios/";
@$target_path = $target_path . basename( $_FILES['imagen']['name']); 
if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target_path)) { 
	#header("location:../vistas/muro.php");
	$imagenUsuario = $target_path;
}else{
	echo "Ha ocurrido un error, trate de nuevo!";
}



$sql = "UPDATE usuarios 
		SET nombres = '$nombres', apellidos = '$apellidos', email = '$email', password = '$password', sexo = '$sexo', telefono = '$telefono', direccion = '$direccion', acerca = '$acerca', imagen = '$imagenUsuario'
		WHERE id = '$id'";
$conexion->ejecutar($sql);
header("location:../vistas/muro.php?id=$id");
?>