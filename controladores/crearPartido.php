<?php 
include ("../static/site_config.php");
include ("../static/clase_mysql.php");
$cancha = $_POST['cancha'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'].":00";
extract($_POST);
	$miconexion = new clase_mysql;
	$miconexion->conectar($db_name,$db_host, $db_user,$db_password);
	$idcancha = $miconexion->consulta("select id from canchas where nombre = '".$cancha."'");
	$id = mysql_fetch_row($idcancha);
	$canchasocupadas = $
	$miconexion->consulta("insert into partidos (id_grupo, id_cancha, fecha, hora, resultado) 
						   values ('".$grupo."', '".$id[0]."', '".$fecha."','".$hora."', '".$marcador1."')");
	header("location:../vistas/grupo.php?idGrupo=".$grupo."&idUsuario=".$usuario."");

 ?>
