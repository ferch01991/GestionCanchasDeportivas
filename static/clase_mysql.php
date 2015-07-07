
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
		return @mysql_num_rows($this->Consulta_ID);
	}

 	//Devuelve el nombre de un campo de la consulta
	function nombrecampo($numcampo){
		return mysql_field_name($this->Consulta_ID, $numcampo);
	}


	function autenticar($user, $pass){
		$res = mysql_query("Select id, email, password from usuarios");
		while ($row = mysql_fetch_assoc($res)) {
			$usuario = $row['email'];
			$password = $row['password'];
			if($usuario==$user && $password==$pass){
				return 1;
			}
		}	
		return 0;
	}

	function ejecutar($sql){
		$ressql=mysql_query($sql);
		if($ressql==NULL){
			echo mysql_error();	
		}
	}

	function sacarID($sql){
		$res = mysql_query($sql);
		$row = mysql_fetch_assoc($res);
		return $row['id'];
	}

	function datosUsuario($id){
		$sql = "SELECT * FROM usuarios where id='".$id."'";
		$datos = array();
		$res = mysql_query($sql);
		while ($row = mysql_fetch_row($res)){
			array_push($datos, $row[0]);
			array_push($datos, $row[1]);
			array_push($datos, $row[2]);
			array_push($datos, $row[3]);
			array_push($datos, $row[4]);
			array_push($datos, $row[5]);
			array_push($datos, $row[6]);
			array_push($datos, $row[7]);
			array_push($datos, $row[8]);
			array_push($datos, $row[9]);
		}
		return $datos;
	}

	function gruposUsuario($id){
		$sql = "SELECT nombre FROM grupos WHERE id_creador = ".$id."";
		$datos = array();
		$res = mysql_query($sql);
		while ($row = mysql_fetch_row($res)){
			array_push($datos, $row[0]);
		}
		return $datos;
	}

	function idGrupo($nombre, $idUsuario){
		$sql = "SELECT id FROM grupos WHERE nombre ='".$nombre."'";
		$res = mysql_query($sql);
		$idGrupo = 0;
		while ($row = mysql_fetch_row($res)){
			$idGrupo = $row[0];
		}
		return $idGrupo;
	}

	function mapa(){

    //echo "<section class='contenedor'>";
		$datos = array();
		while (@$row = mysql_fetch_array($this->Consulta_ID)) {
			array_push($datos, $row[0]);
			array_push($datos, $row[1]);
			array_push($datos, $row[2]);
			array_push($datos, $row[3]);
			array_push($datos, $row[4]);
			array_push($datos, $row[5]);

		}
		return $datos; 

	}

	function listajugadores(){
		echo "<div id='derecha' align='center' style='float: right;height: 562px; margin: -630px 1em 1em;'>";

		echo "<div id='infoPartidos' style=' height: 520px;'>";
		while (@$row = mysql_fetch_array($this->Consulta_ID)) {
			@$id=$row['imagen'];
			@$nombre=$row['nombres'];
			echo "<img><img src='".$id."' WIDTH=100px HEIGHT=90px></>";
			echo "<h5>".$nombre."</h5>";
			echo "<hr>";

		}
		echo "</div>";  

		echo "</div>";
	}

	function selectcancha(){
		$canchas = array();
		$res = $this->consulta("select id, nombre from canchas");
		return $res;
	}

	function usuarios(){
		$res = $this->consulta("select nombres, apellidos, imagen from usuarios");
		return $res;
	}

	function partidos($idGrupo){
		$res = $this->consulta("select c.nombre, p.fecha, p.hora, p.resultado, p.observacion from partidos p, canchas c where p.id_grupo=".$idGrupo." and p.id_cancha = c.id");
		return $res;
	}

	function partidosUsuario($idUsuario){
		$res = $this->consulta("select DISTINCT  g.nombre, c.nombre, p.fecha, p.hora, p.id from grupos g, canchas c, partidos p, usuarios_grupos u where g.id = p.id_grupo and p.id_cancha = c.id and u.id_usuario=".$idUsuario." ");
		return $res;
	}

	function invitaciones($idUsuario){
		$res = $this->consulta("SELECT * FROM invitaciones WHERE invitaciones.id_usuario =".$idUsuario." ");
		return $res;
	}

	function datosGrupo($idGrupo){
		$res = $this->consulta("SELECT nombre, logo FROM grupos WHERE grupos.id =".$idGrupo." ");
		$grupo = array();
		$row = mysql_fetch_row($res);
		array_push($grupo, $row[0]);
		array_push($grupo, $row[1]);
		return $grupo;
	}

	function controlCancha($cancha, $fecha, $hora){
		$res = $this->consulta("select p.id_cancha, p.fecha, p.hora from partidos p 
								where p.id_cancha = '".$cancha."' and p.fecha = '".$fecha."' and hora = '".$hora."'");
		$datos = array();
		while ($row = mysql_fetch_array($res)) {
			array_push($datos, $row[0]);
			array_push($datos, $row[1]);
			array_push($datos, $row[2]);
		}
		return count($datos);		
	}


}


?>