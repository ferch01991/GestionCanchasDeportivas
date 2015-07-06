<?php
extract($_POST);
$mensaje = "Chuchetumadre";
$mensaje = wordwrap($mensaje, 70, "\r\n");
$resultado = mail($email, 'Test', $mensaje);
echo $resultado;
if ($resultado) {
	echo "mensaje enviado";
		#header("location:../grupo.php");
}else{
	echo "no enviado";
}
?>