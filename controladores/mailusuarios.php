<?php
$mail = $_POST['usuario'];
$mensaje = "Línea 1\r\nLínea 2\r\nLínea 3";
$mensaje = wordwrap($mensaje, 70, "\r\n");
$resultado = mail($mail, 'Mi título', $mensaje);
echo $resultado;
if ($resultado) {
		echo "mensaje enviado";
		#header("location:../grupo.php");
	}
?>