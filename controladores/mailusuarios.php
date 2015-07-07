<?php
include("../static/site_config.php"); 
include("../static/clase_mysql.php");
$conexion = new clase_mysql;
$conexion->conectar($db_name,$db_host, $db_user,$db_password);
extract($_POST);
$idUsuarioInvitado = $conexion->idUsuarioMail($email);

if (!$idUsuarioInvitado){
	$claveUsuarioInvitado = generarCodigo(8);
	$sql = "INSERT INTO usuarios values ('','Perfil','Incompleto','$email','$claveUsuarioInvitado','','','','','../imagenes/usuarios/avatarHombre.png')";
	$conexion->ejecutar($sql);
	$mensaje = "Hola ".$email." \nHas sido invitado a unirte al Sistema de Gestion de Canchas deportivas ingresa con estos datos \n usuario: ".$email."\n Contraseña: ".$claveUsuarioInvitado."";
	$mensaje = wordwrap($mensaje, 70, "\r\n");
	$resultado = mail($email, 'Test', $mensaje);

	
}

$idUsuarioInvitado = $conexion->idUsuarioMail($email);
$sql = "INSERT INTO invitaciones values ('$idGrupo','$idUsuarioInvitado')";
$conexion->ejecutar($sql);
header("location:../vistas/grupo.php?idGrupo=".$idGrupo."&idUsuario=".$idUsuario."");

function generarCodigo($longitud) {
	$key = '';
	$pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
	$max = strlen($pattern)-1;
	for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
		return $key;
}
?>