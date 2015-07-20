<?php 
include("../static/site_config.php"); 
include("../static/clase_mysql.php");
$miconexion = new clase_mysql;
$miconexion->conectar($db_name,$db_host, $db_user,$db_password);

$id_user = $_POST['idUsuario'];
$id_grupo = $_POST['idGrupo'];
$sms = $_POST['mensaje'];

$chat = $miconexion->chat($id_grupo,$id_user, $sms);

?>