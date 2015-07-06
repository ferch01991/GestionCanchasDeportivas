
<?php
include("../static/site_config.php");
include("../static/clase_mysql.php");

?>
<html>
<head>
	<title>Cancha</title>
	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="../estilos/estilos.css">
  <link href="navbar.css" rel="stylesheet">
  <script src="../bootstrap/js/ie-emulation-modes-warning.js"></script>

		
<script type="text/javascript">
		var cv, cx, objetos, objetoActual=null;
		var inicioX=0, inicioY=0;
		var img = new Image();
			img.src = "../imagenes/fondos/campo_futbol.jpg";


		function actualizar(){
			cx.drawImage(img, 0, 0);
			cx.textAlign='center';
		for(var i =0; i<objetos.length;i++){
			cx.fillStyle = objetos[i].color;
			cx.fillRect(objetos[i].x,objetos[i].y,objetos[i].width,objetos[i].height);
		}
	}
	function dibujar(res){
		var jugadores = res/2;
		var numJugadores =Math.floor(jugadores);
		alert("Numero de jugadores confirmados:  " + res);
		objetos = [];

		for(var i=0; i<jugadores; i++){
			
			objetos.push({
				x: 370, y:3,
				width: 20, height: 20,
				color: '#000000'

			});
		}
		for(var i=0; i<numJugadores; i++){

			objetos.push({
				x: 450, y:3,
				width: 20, height: 20,
				color: '#fff'

			});
			
		}
	}



		function imgCanvas(){
			
			cv = document.getElementById('lienzo');
			cx = cv.getContext('2d');

			function dibujar(res){
		
			}

		

			
			actualizar();
			

			cv.onmousedown =function(event){
				for(var i=0;  i<objetos.length; i++){
					if(objetos[i].x<event.clientX && (objetos[i].width+objetos[i].x>event.clientX) && objetos[i].y<event.clientY && (objetos[i].height+objetos[i].y>event.clientY)){
						objetoActual = objetos[i];
						inicioY = event.clientY-objetos[i].y;
						inicioX = event.clientX-objetos[i].x;
						break;


					}
				}

			};
			cv.onmousemove = function(event){
				if (objetoActual!=null) {
					objetoActual.x=event.clientX - inicioX;
					objetoActual.y = event.clientY - inicioY;
					actualizar();
				}
				
			};
			cv.onmouseup = function(event){
				objetoActual=null;
			};

		};


	</script>
	
</head>
<body id="bodyMuro" onload=" imgCanvas()" >
	
	<canvas width="840px" height="560" id="lienzo">No soporta canvas</canvas>
	 <!--</section>-->
	 <?php 
	 $conexion = new clase_mysql;
     $conexion->conectar($db_name,$db_host, $db_user,$db_password);
     $conexion->consulta("select * from confirmaciones where id_partido=2 and estado='aceptado'");
     $l=$conexion->numregistros();
     echo "<p></p>";
    
     
            ?> 
            <script language="javascript"> 
            var a= "<?php echo $l; ?>" ;
                 
                    dibujar(a); 
            </script> 
     
            <?php 
        
     ?> 

     	<?php
     		 $conexion = new clase_mysql;
    		 $conexion->conectar($db_name,$db_host, $db_user,$db_password);
     		 $conexion->consulta("SELECT distinct u.imagen,u.nombres from usuarios u, confirmaciones c where (c.estado='aceptado' and c.id_partido=3)and u.id=c.id_usuario ");
     		 $l=$conexion->numregistros();
     		 echo"<br>";
     		 echo"<br>";
     		 echo"<br>";
     		 
     		 $datos=$conexion->listajugadores();
    
     	?>
    
     
</body>
</html>