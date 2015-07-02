<?php 
include("../static/site_config.php");
include("../static/clase_mysql.php");
$miconexion = new clase_mysql;
$miconexion->conectar($db_name,$db_host, $db_user,$db_password);
extract($_POST);
	@$tipo = $_GET['tipo'];
	@$id = $_GET['id'];
	if ($tipo == 'cancelado'){
		$miconexion->consulta("INSERT INTO confirmaciones VALUES ('','1','$id','$tipo')");
			
				?>
	<script type="text/javascript">
	 alert("INVITACION RECHAZADA");
    location.href = "../vistas/mapa.php";
	</script>
	<?php

	}else{
		if ($tipo=='aceptado') {
			
			$miconexion->consulta("INSERT INTO confirmaciones VALUES ('','2','$id','$tipo')");
			?>
	<script type="text/javascript">
	 alert("INVITACION ACEPTADA");
    location.href = "../vistas/mapa.php";
	</script>
	<?php

		}
	}


?>
