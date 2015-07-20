<?php 
include("../static/site_config.php");
include("../static/clase_mysql.php");
$conexion = new clase_mysql;
$conexion->conectar($db_name,$db_host, $db_user,$db_password);
extract($_POST);

$fecha = date("Y")."/".date("m")."/".date("d");

@$target_path = "../imagenes/usuarios/";
@$target_path = $target_path . basename( $_FILES['imagen']['name']); 
if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target_path)) { 
	$imagenC = $target_path;
	echo $imagenC;
	$sql = "INSERT INTO comentarios VALUES  ('','$idUsuario','$idGrupo','$encabezado','$imagenC','$fecha')";
}else{
	$sql = "INSERT INTO comentarios VALUES  ('','$idUsuario','$idGrupo','$encabezado','','$fecha')";
}


$conexion->ejecutar($sql);
chmod($imagenC, 0755); 
if ($idGrupo == 0){
	header("location:../vistas/muro.php?idUsuario=".$idUsuario."");
}else{
	header("location:../vistas/grupo.php?idGrupo=".$idGrupo."&idUsuario=".$idUsuario."");
}
?>