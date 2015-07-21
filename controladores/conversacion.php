<?php 
include("../static/site_config.php"); 
include("../static/clase_mysql.php");
$miconexion = new clase_mysql;
$miconexion->conectar($db_name,$db_host, $db_user,$db_password);
$id_user = $_POST['idUsuario'];
$id_grupo = $_POST['idGrupo'];
$conversacion = $miconexion->conversacion($id_grupo);
while ($row = mysql_fetch_row($conversacion)) {
	$usuario = $miconexion->datosUsuario($row[0]);
	echo "<p><img id='imagenUsuarioPequenia' src='".$usuario[9]."' width=25 heigth=25><b>".$usuario[1]."</b>: ".$row[1]."</p>";			
}
?>