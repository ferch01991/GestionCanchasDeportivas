<?php
class clase_mysql{

	var $BaseDatos;
	var $Servidor;
	var $Usuario;
	var $Clave;
	var $Conexion_ID = 0;
	var $Consulta_ID = 0;
	var $Errno = 0;
	var $Error = "";
	function clase_mysql(){
 		
	}

	function conectar($db, $host, $user, $pass){
		if($db!="") $this->BaseDatos = $db;
		if($host!="") $this->Servidor = $host;
		if($user!="") $this->Usuario = $user;
		if($pass!="") $this->Clave = $pass;
		$this->Conexion_ID=mysql_connect($this->Servidor,$this->Usuario, $this->Clave);
		if(!$this->Conexion_ID){
			$this->Error="La conexion con el servidor fallida";
			return 0;
		}
		if(!mysql_select_db($this->BaseDatos, $this->Conexion_ID)){
			$this->Error="Imposible abrir ".$this->BaseDatos;
			return 0;
		} 	
		return $this->Conexion_ID;
	}	

	function consulta($sql){
		if($sql==""){
			$this->Error="NO hay ningun sql";
			return 0;
		}
		$this->Consulta_ID = mysql_query($sql, $this->Conexion_ID);
		if(!$this->Consulta_ID){
			$this->Errno = mysql_errno();
			$this->Error = mysql_error();
		}
		return $this->Consulta_ID;
	}

	function numcampos(){
		return @mysql_num_fields($this->Consulta_ID);
	}

	function numregistros(){
		return mysql_num_rows($this->Consulta_ID);
	}

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

}
?>