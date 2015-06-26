<?php 
include("static/site_config.php");
include("static/clase_mysql.php");
$conexion = new clase_mysql;
$conexion->conectar($db_name,$db_host, $db_user,$db_password);

extract($_GET);
		@$id=$_POST['id'];
 		@$nombres=$_POST['nombre'];
 		@$apellidos=$_POST['apellido'];
 		@$email=$_POST['email'];
 		@$pass=$_POST['pass'];
 		@$genero=$_POST['genero'];
 		@$telef=$_POST['telf'];
 		@$dir=$_POST['dir'];
 		@$acerca=$_POST['desc'];
 		@$img=$_POST['imagen'];

 		@$nombrefoto=$_FILES['foto1']['name'];
		@$ruta=$_FILES['foto1']['tmp_name'];
		$destino = "img/".$nombrefoto.$id;
		copy($ruta, $destino);
		


$conexion->consulta("UPDATE usuarios SET nombres='".$nombres."',apellidos='".$apellidos."',email='".$email."',password='".$pass."',sexo='".$genero."',telefono='".$telef."',direccion='".$dir."',acerca='".$acerca."',imagen='".$destino."' where id='".$id."'");
	?>
	<script type="text/javascript">
	 alert("PERFIL ACTUALIZADO");
    location.href = "iditor_usuario.php";
	</script>
	<?php


?>