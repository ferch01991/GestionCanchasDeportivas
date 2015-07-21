<?php
include("../static/site_config.php"); 
include("../static/clase_mysql.php");
$conexion = new clase_mysql;
$conexion->conectar($db_name,$db_host, $db_user,$db_password);
?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Grupos</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../estilos/estilos.css">
	<script type="text/javascript">
	function openDialog() {
		$('#overlay').fadeIn('fast', function() {
			$('#popup').css('display','block');
			$('#popup').animate({'left':'30%'},500);
		});
	}

	function closeDialog(id) {
		$('#'+id).css('position','absolute');
		$('#'+id).animate({'left':'-100%'}, 500, function() {
			$('#'+id).css('position','fixed');
			$('#'+id).css('left','100%');
			$('#overlay').fadeOut('fast');
		});
	}
	</script>
</head>
<body id="bodyMuro">

	<div id="popup" class="popup">
    <a onclick="closeDialog('popup');" class="close"></a>
    <div>
        <h5>kakadsjfskjd</h5>
        <a onclick="openDialog();">Mostrar Popup</a>
    </div>
</div>


</body>
</html>