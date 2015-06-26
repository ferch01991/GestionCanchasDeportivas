<head>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

</head>
<?php
 class clase_mysql{
 	/*Variables para la conexion a la db*/
 	var $BaseDatos;
 	var $Servidor;
 	var $Usuario;
 	var $Clave;
 	/*Identificadores de conexion y consulta*/
 	var $Conexion_ID = 0;
 	var $Consulta_ID = 0;
 	/*Numero de error y error de textos*/
 	var $Errno = 0;
 	var $Error = "";
 	function clase_mysql(){
 		//cosntructor
 	}

 	function conectar($db, $host, $user, $pass){
 		if($db!="") $this->BaseDatos = $db;
 		if($host!="") $this->Servidor = $host;
 		if($user!="") $this->Usuario = $user;
 		if($pass!="") $this->Clave = $pass;

 		//conectamos al servidor de db
 		$this->Conexion_ID=mysql_connect($this->Servidor,$this->Usuario, $this->Clave);
 		if(!$this->Conexion_ID){
 			$this->Error="La conexion con el servidor fallida";
 			return 0;
 		}

		//Seleccionamos la base de datos
		if(!mysql_select_db($this->BaseDatos, $this->Conexion_ID)){
			$this->Error="Imposible abrir ".$this->BaseDatos;
 			return 0;
		} 	
		/*Si todo tiene exito, retorno el identificador de la conexion*/
 		return $this->Conexion_ID;
 	}	

 	//Ejecuta cualquier consulta
 	function consulta($sql=""){
 		if($sql==""){
 			$this->Error="NO hay ningun sql";
 			return 0;
 		}
 		//ejecutamos la consulta
 		$this->Consulta_ID = mysql_query($sql, $this->Conexion_ID);
 		if(!$this->Consulta_ID){
 			$this->Errno = mysql_errno();
 			$this->Error = mysql_error();
 		}
 		//retorna la consulta ejecutada
 		return $this->Consulta_ID;
 	}

 	//Devulve el numero de campos de la culsulta
 	function numcampos(){
 		return @mysql_num_fields($this->Consulta_ID);
 	}

 	//Devuleve el numero de registros de la culsulta
 	function numregistros(){
 		return mysql_num_rows($this->Consulta_ID);
 	}

 	//Devuelve el nombre de un campo de la consulta
 	function nombrecampo($numcampo){
 		return mysql_field_name($this->Consulta_ID, $numcampo);
 	}

 	//Muestra los resultados de la consulta
 	
 	function verconsulta2(){
 	while (@$row = mysql_fetch_array($this->Consulta_ID)) {
 		$id=$row['id'];
 		$nombres=$row['nombres'];
 		$apellidos=$row['apellidos'];
 		$email=$row['email'];
 		$pass=$row['password'];
 		$genero=$row['sexo'];
 		$telef=$row['telefono'];
 		$dir=$row['direccion'];
 		$acerca=$row['acerca'];
 		$img=$row['imagen'];
 		

 		echo "<div class='row'>";
    //echo "<div class='col-md-6'>";
    //echo "<img src='img/foto.jpg' alt='logo' width='200' height='200'>";
    //echo "<br><br>";

    echo "<form class='form-horizontal' action='editar.php' enctype='multipart/form-data' method='POST'>";
    //echo "<button type='button' href='#'class='btn btn-primary'>Imagen</button>";
    echo "<div class='col-md-6'>";
    echo '<h3 Perfil: >'.$nombres.'</h3>';
    echo "<img src='$img' alt='logo' width='200' height='200' style=' border: 2px solid;border-radius: 25px;'>";
    echo "<br><br>";
    echo "<label for='ejemplo_archivo_1'>Cambiar Imagen</label>";
    echo "<input  name='foto1' type='file' id='ejemplo_archivo_1'>";
    echo "</div>";
    echo "<div class='col-md-6'>";
  				  echo "<div class='form-group'>";
  					echo "<label for='inputEmail3' class='col-sm-2 control-label'>Nombre</label>";
  					echo "<div class='col-sm-10'>";
  					echo "<input type='hidden' name='id' class='form-control' id='inputEmail3' placeholder='Ingrese su nombre' value='$id'>";

  				    echo "<input type='text' name='nombre' class='form-control' id='inputEmail3' placeholder='Ingrese su nombre' value='$nombres'>";
  					echo "</div>";
  				echo "</div>";

  					echo "<div class='form-group'>";
  					echo "<label for='inputEmail3' class='col-sm-2 control-label'>Apellido</label>";
  					echo "<div class='col-sm-10'>";
  						echo "<input type='text' name='apellido' class='form-control' id='inputEmail3' placeholder='Ingrese su Apellido' value='$apellidos'>";
  					echo "</div>";
  				echo "</div>";

  				echo "<div class='form-group'>";
  					echo "<label for='inputEmail3' class='col-sm-2 control-label'>Correo</label>";
  					echo "<div class='col-sm-10'>";
  						echo "<input type='email' name='email' class='form-control' id='inputEmail3' placeholder='Correo electrónico' value='$email'>";
  					echo "</div>";
  				echo "</div>";
 				

 				echo "<div class='form-group'>";
  					echo "<label for='inputEmail3' class='col-sm-2 control-label'>Genero</label>";
  					echo "<div class='col-sm-10'>";
  						echo "<input type='text' name='genero' class='form-control' id='inputEmail3' placeholder='Genero' value='$genero'>";
  					echo "</div>";
  				echo "</div>";

  				echo "<div class='form-group'>";
  					echo "<label for='inputEmail3' class='col-sm-2 control-label'>Password</label>";
  					echo "<div class='col-sm-10'>";
  						echo "<input type='password' name='pass' class='form-control' id='inputEmail3' placeholder='Password' value='$pass'>";
  					echo "</div>";
  				echo "</div>";

  				echo "<div class='form-group'>";
  					echo "<label for='inputEmail3' class='col-sm-2 control-label'>Teléfono</label>";
  					echo "<div class='col-sm-10'>";
  						echo "<input type='text' name='telf' class='form-control' id='inputEmail3' placeholder='Su número es' value='$telef'>";
  					echo "</div>";
  				echo "</div>";

  				echo "<div class='form-group'>";
  					echo "<label for='inputEmail3' class='col-sm-2 control-label'>Dirección</label>";
  					echo "<div class='col-sm-10'>";
  						echo "<input type='text' name='dir' class='form-control' id='inputEmail3' placeholder='Dirección' value='$dir'>";
  					echo "</div>";
  				echo "</div>";

  				echo "<div class='form-group'>";
  					echo "<label for='inputEmail3' class='col-sm-2 control-label'>Acerca</label>";
  					echo "<div class='col-sm-10'>";
  					//	echo "<input type='text' name='desc' class='form-control' id='inputEmail3' placeholder='Descripción' value='$acerca'>";
  					echo "<textarea class='form-control' rows='3' name='desc'  placeholder='Descripción' value='$acerca'>".$acerca."</textarea>";
            echo "</div>";
  				echo "</div>";

  					echo "<div class='form-group'>";
  					echo "<div class='col-sm-offset-2 col-sm-10'>";
  						echo "<button type='submit' class='btn btn-default'>Sign in</button>";
  					echo "</div>";
            echo "</div>";

  			echo "</form>";
  		echo "</div>";
  	}
 		
 	}
  function mapa(){
  
    echo "<section class='contenedor'>";
    while (@$row = mysql_fetch_array($this->Consulta_ID)) {
        @$id=$row['id'];
        @$nombre=$row['nombre'];
        @$lat=$row['latitud'];
        @$long=$row['longitud'];
        @$dir=$row['direccion'];
        @$capacidad=$row['capacidad'];
          
        echo "<section class='caja'>";
        echo "<h3>".$nombre."</h2>";
        echo "<p><h3>Dirección: </h3>".$dir."</p>";
        echo "<p><h3>Capacidad de Jugadores: </h3>".$capacidad."</p>";
        echo "</section>";

        echo "<div class='row'>";
         echo "<div class='col-md-6'>";
         echo "<a href='actua.php?tipo=aceptado&id=$id'<button type='submit' class='btn btn-default'>Confirmar</button></a>";
         echo "</div>";


          echo "<div class='col-md-6'>";
          echo "<a href='actua.php?tipo=cancelado&id=$id'><button type='submit' class='btn btn-default'>Rechazar</button></a>";
          echo "</div>";

echo "</div>";



        
    }
    
    echo "</section >";
  }
 	function consulta_lista(){
		while (@$row = mysql_fetch_array($this->Consulta_ID)) {
			for ($i=0; $i < $this->numcampos(); $i++) { 
				$row[$i];
			}
			return $row;
		}
	}

	

}
?>