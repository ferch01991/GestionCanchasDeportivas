 <?php
include("static/site_config.php");
include("static/clase_mysql.php");
	$miconexion = new clase_mysql;
	$miconexion->conectar($db_name,$db_host, $db_user,$db_password);
	$rs = mysql_query("SELECT * FROM canchas WHERE id='1'");
      while($result=mysql_fetch_array($rs))
        {
        $coordenada1 = $result['latitud'];
        $coordenada2 = $result['longitud'];
        $nombre = $result['nombre'];
            
        }
?>

     <html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">

	<title>Mapa</title>
	<section id="encabezado" style="background-image: url('img/header-sprite.png');background-repeat: no-repeat; ">
	<h1>Confirmar Partido</h1>
	</section>

	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
	<script >
		function initialize() {
	  var myLatlng = new google.maps.LatLng(-3.983246,-79.200836);
	  var mapOptions = {
	    zoom: 15,
	    center: myLatlng
	  }
	  var coordenada1= "<?php echo $coordenada1; ?>";
      var coordenada2= "<?php echo $coordenada2; ?>";
      var nombre= "<?php echo $nombre; ?>";


	  var map = new google.maps.Map(document.getElementById('map'), mapOptions);
	 

	 
	  	var marcador = new google.maps.LatLng(coordenada1,coordenada2);
	  	var marker = new google.maps.Marker({
		      position: marcador,
		      map: map,
		      title: nombre
		  });
	      google.maps.event.addListener(marker, 'click', function(){
	            var popup = new google.maps.InfoWindow();
	            var note = nombre;
	            popup.setContent(note);
	            popup.open(map, this);
	      })
	 
 
	}
	google.maps.event.addDomListener(window, 'load', initialize);
	</script>
	</head>
     
    <body  style="background-image: url('img/fondo.jpg');background-repeat: no-repeat;"> 
    	
     <div class="container">
     	<div class='row'>
     		<div class='col-md-6' style='padding-bottom: 182px;'>
     			<center>
    	<?php
    		$miconexion->consulta("SELECT * FROM canchas WHERE id='1'");
            $miconexion->mapa();
    		 ?>
    		 </center>
    	</div>
    	<div class='col-md-6'>
    <div align="center" id="map">

    </div>
      </div>
        </div>

    </body>
     <footer style="background-image: url('img/fondopie.jpg'); padding:10px; text-align:center; margin-right:-105px;margin-left:-106px">
	<h4>Derechos reservados</h4>
</footer>
    </html>