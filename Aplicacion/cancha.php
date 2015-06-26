<?php
include("static/site_config.php");
include("static/clase_mysql.php");

?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style/estylos.css">
</head>
<body>
	
	

	<script type="text/javascript">
		var cv, cx, objetos, objetoActual=null;
		var inicioX=0, inicioY=0;
		var img = new Image();
			img.src = "img/campo_futbol.gif";


		function actualizar(){
			//cx.fillStyle='#f0f0f0';
			//cx.fillRect(0,0,400,300);
			cx.drawImage(img, 0, 0);
		for(var i =0; i<objetos.length;i++){
			cx.fillStyle = objetos[i].color;
			cx.fillRect(objetos[i].x,objetos[i].y,objetos[i].width,objetos[i].height);
		}
	}
	function dibujar(res){
		var jugadores = res/2;
		objetos = [];
		for(var i=0; i<jugadores; i++){
			
			objetos.push({
				x: 0, y:40,
				width: 20, height: 20,
				color: '#000000'

			});

			objetos.push({
				x: 0, y:80,
				width: 20, height: 20,
				color: '#fff'

			});
			
		}
	}
		window.onload = function(){
			
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

	
	<canvas width="650" height="275" id="lienzo"></canvas>
	 <?php 

	 $conexion = new clase_mysql;
     $conexion->conectar($db_name,$db_host, $db_user,$db_password);
     $conexion->consulta("select * from confirmaciones where id_partido='2'and estado='aceptado'");
     $l=$conexion->numregistros();
     
    
     
            ?> 
            <script language="javascript"> 
            var a= "<?php echo $l; ?>" ;
                 
                    dibujar(a); 
            </script> 
     
            <?php 
        
     ?> 
</body>
</html>