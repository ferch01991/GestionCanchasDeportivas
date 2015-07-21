 <?php
 include("../static/site_config.php");
 include("../static/clase_mysql.php");
 $coordenada1='';
 $coordenada2='';
 $nombre='';
 extract($_GET);  
 $conexion = new clase_mysql;
 $conexion->conectar($db_name,$db_host, $db_user,$db_password);
 $rs = mysql_query("SELECT * FROM canchas WHERE nombre='".$nombreCancha."'");
 while($result=mysql_fetch_array($rs))
 {
  $coordenada1 = $result['latitud'];
  $coordenada2 = $result['longitud'];
  $latitud = $coordenada1;
  $longitud = $coordenada2;
  $nombre = $result['nombre'];
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="../estilos/estilos.css">
  <link href="navbar.css" rel="stylesheet">
  <script src="../bootstrap/js/ie-emulation-modes-warning.js"></script>

  <link rel="stylesheet" type="text/css" href="../estilos/estilos2.css"> 
  <title>Mapa</title>

  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
  <script >
  function initialize() {
    var coordenada1= "<?php echo $latitud; ?>";
    var coordenada2= "<?php echo $longitud; ?>";
    var nombre= "<?php echo $nombre; ?>";
    var myLatlng = new google.maps.LatLng(coordenada1,coordenada2);
    var mapOptions = {
     zoom: 16,
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

<body  id="bodyMuro"> 

  <?php 
  extract($_GET);
  $usuario = $conexion->datosUsuario($idUsuario);
  include("../static/menu1.php");
  ?>
  <div class="container">
    <div class='row'>
     <div class='col-md-6' style='padding-bottom: 182px;'>
      <center>
       <?php
       extract($_GET);
       $conexion->consulta("SELECT * FROM canchas WHERE nombre='".$nombreCancha."' ");
       $datos=$conexion->mapa();
       echo "<h3 style='color: #fff;'>".$datos['1']."</h3>";
       echo "<p style='color: #fff;'><h3 style='color: #fff;'>Dirección:".$datos['4']." </h3></p>";
      #echo "<p><h3 style='color: #fff;'>Capacidad de Jugadores: </h3>".$datos['5']."</p>";
       echo "<div class='col-md-6'>";
       echo "<a href='../controladores/gestionarPartido.php?idUsuario=$idUsuario&idPartido=$idPartido&op=2'<button type='submit' class='btn btn-default' style='background: #000000'; color:'#FFFFFF'><img align='left' src='../imagenes/sistema/ok.png' WIDTH=20 HEIGHT=20></button></a>";
       echo "</div>";


       echo "<div class='col-md-6'>";
       echo "<a href='../controladores/gestionarPartido.php?idUsuario=$idUsuario&idPartido=$idPartido&op=1'><button type='submit' class='btn btn-default' style='background: #000000'; color:'#FFFFFF'><img align='left' src='../imagenes/sistema/no.png' WIDTH=20 HEIGHT=20></button></a>";
       echo "<br><br>";
       echo "<br><br>";
       echo "<br><br>";
       echo "<br><br>";

       echo "</div>";
       ?>
     </center>
   </div>
   <div class='col-md-6'>
    <div align="center" id="map">

    </div>
  </div>
</div>

</body>
</html>