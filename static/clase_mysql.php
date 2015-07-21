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
		$sql = "SELECT id_grupo FROM usuarios_grupos WHERE id_usuario = ".$id."";
		$datos = array();
		$res = mysql_query($sql);
		while ($row = mysql_fetch_row($res)){
			array_push($datos, $row[0]);
		}
		return $datos;
	}
	function grupo_chat($id_grupo){
		$res = $this->consulta("SELECT nombre FROM grupos WHERE id = '".$id_grupo."'");
		while ($row = mysql_fetch_row($res)){
			return $row[0];
		}
	}

	function idGrupo($nombre){
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
			echo "<h5 style='color: #000'>".$nombre."</h5>";
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
	function usuarios($idGrupo){
		$res = $this->consulta("SELECT usuarios.nombres, usuarios.imagen, usuarios.apellidos, usuarios.id FROM usuarios, usuarios_grupos WHERE usuarios_grupos.id_grupo = $idGrupo AND usuarios.id = usuarios_grupos.id_usuario");
		return $res;
	}
	function partidos($idGrupo){
		$res = $this->consulta("select c.nombre, p.fecha, p.hora, p.resultado, p.observacion from partidos p, canchas c where p.id_grupo=".$idGrupo." and p.id_cancha = c.id");
		return $res;
	}
	function partidosUsuario($idUsuario, $estado){
		$res = $this->consulta("SELECT DISTINCT grupos.nombre, canchas.nombre, partidos.fecha, partidos.hora, partidos.id FROM grupos, canchas, partidos, usuarios, confirmaciones WHERE grupos.id = partidos.id_grupo AND partidos.id_cancha = canchas.id AND usuarios.id = $idUsuario AND confirmaciones.id_usuario = usuarios.id AND confirmaciones.estado = '$estado' AND confirmaciones.id_partido = partidos.id ");
		return $res;
	}
	function invitaciones($idUsuario){
		$res = $this->consulta("SELECT * FROM invitaciones WHERE invitaciones.id_usuario =".$idUsuario." ");
		return $res;
	}
	function datosGrupo($idGrupo){
		$res = $this->consulta("SELECT nombre, logo, id FROM grupos WHERE grupos.id =".$idGrupo." ");
		$grupo = array();
		$row = mysql_fetch_row($res);
		array_push($grupo, $row[0]);
		array_push($grupo, $row[1]);
		array_push($grupo, $row[2]);
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
	function invitacionesPartido($idUsuario){
		$res = $this->consulta("SELECT * FROM confirmaciones WHERE confirmaciones.id_usuario = $idUsuario AND confirmaciones.estado = 'pendiente'");
		return $res;
	}
	function informacionPartido($idPartido){
		$res = $this->consulta("SELECT grupos.nombre, canchas.nombre, partidos.fecha, partidos.hora  FROM grupos, canchas, partidos WHERE partidos.id = $idPartido AND partidos.id_grupo = grupos.id AND partidos.id_cancha = canchas.id");
		return $res;
	}
	function idPartido($idGrupo, $idCancha, $fecha, $hora){
		$res = $this->consulta("SELECT partidos.id FROM partidos WHERE partidos.id_grupo = $idGrupo AND partidos.id_cancha = $idCancha AND partidos.fecha = '$fecha' AND partidos.hora = '$hora' ");
		$idPartido = 0;
		while ($row = mysql_fetch_row($res)){
			$idPartido = $row[0];
		}
		return $idPartido;
	}
	function infoBD(){
		$res = $this->consulta("SELECT DISTINCT grupos.nombre, canchas.nombre, partidos.fecha, partidos.hora, partidos.id FROM grupos, canchas, partidos, usuarios, confirmaciones ");
		return $res;
	}
	function idUsuarioMail($email){
		$res = $this->consulta("SELECT id FROM usuarios WHERE email= '$email'");
		$r = "";
		while ($row = mysql_fetch_row($res)) {
			$r = $row[0];
		}
		return $r;
	}
	function comentariosGrupo($idGrupo){
		$res = $this->consulta("SELECT * FROM comentarios WHERE idGrupo= '$idGrupo' ORDER BY id DESC");
		while ($row = mysql_fetch_row($res)){
			$usuario = $this->datosUsuario($row[1]);
			echo "<img id='imagenUsuarioPequenia' src='".$usuario[9]."' alt='' width='30' height='30'>";
			echo "<label>".$usuario[1]." ".$row[5]."</label>";
			echo "<h5>".$row[3]."</h5>";
			echo "<div align='center'>";
			if ($row[4]){

				$ruta_imagen = $row[4];
				$miniatura_ancho_maximo = 350;
				$miniatura_alto_maximo = 350;
				$info_imagen = getimagesize($ruta_imagen);
				$imagen_ancho = $info_imagen[0];
				$imagen_alto = $info_imagen[1];
				$imagen_tipo = $info_imagen['mime'];
				$lienzo = imagecreatetruecolor( $miniatura_ancho_maximo, $miniatura_alto_maximo );

				$lienzo = imagecreatetruecolor( $miniatura_ancho_maximo, $miniatura_alto_maximo );

				switch ( $imagen_tipo ){
					case "image/jpg":
					case "image/jpeg":
					$imagen = imagecreatefromjpeg( $ruta_imagen );
					break;
					case "image/png":
					$imagen = imagecreatefrompng( $ruta_imagen );
					break;
					case "image/gif":
					$imagen = imagecreatefromgif( $ruta_imagen );
					break;
				}
				imagecopyresampled($lienzo, $imagen, 0, 0, 0, 0, $miniatura_ancho_maximo, $miniatura_alto_maximo, $imagen_ancho, $imagen_alto);
				#imagejpeg( $lienzo, $row[4], 90 );
				$proporcion_imagen = $imagen_ancho / $imagen_alto;
				$proporcion_miniatura = $miniatura_ancho_maximo / $miniatura_alto_maximo;

				imagecopyresampled($lienzo, $imagen, 0, 0, 0, 0, $miniatura_ancho_maximo, $miniatura_alto_maximo, $imagen_ancho, $imagen_alto);

				#imagejpeg( $lienzo, $row[4], 90 );

				$proporcion_imagen = $imagen_ancho / $imagen_alto;
				$proporcion_miniatura = $miniatura_ancho_maximo / $miniatura_alto_maximo;

				if ( $proporcion_imagen > $proporcion_miniatura ){
					$miniatura_ancho = $miniatura_ancho_maximo;
					$miniatura_alto = $miniatura_ancho_maximo / $proporcion_imagen;
				} else if ( $proporcion_imagen < $proporcion_miniatura ){
					$miniatura_ancho = $miniatura_alto_maximo * $proporcion_imagen;
					$miniatura_alto = $miniatura_alto_maximo;
				} else {
					$miniatura_ancho = $miniatura_ancho_maximo;
					$miniatura_alto = $miniatura_alto_maximo;
				}
				$lienzo = imagecreatetruecolor( $miniatura_ancho, $miniatura_alto );
				imagecopyresampled($lienzo, $imagen, 0, 0, 0, 0, $miniatura_ancho, $miniatura_alto, $imagen_ancho, $imagen_alto);
				imagejpeg($lienzo, $row[4], 80);

				$lienzo = imagecreatetruecolor( $miniatura_ancho, $miniatura_alto );
				imagecopyresampled($lienzo, $imagen, 0, 0, 0, 0, $miniatura_ancho, $miniatura_alto, $imagen_ancho, $imagen_alto);
				imagejpeg($lienzo, $row[4], 80);

				echo "<img src='".$row[4]."' alt='' >";	
			}
			echo "</div>";
			echo "<hr>";
		}
	}
	function comentariosMuro($idUsuario){
		$res = $this->consulta("SELECT * FROM comentarios, usuarios_grupos WHERE comentarios.idGrupo = usuarios_grupos.id_grupo AND usuarios_grupos.id_usuario = 1");
		while ($row = mysql_fetch_row($res)){
			$usuario = $this->datosUsuario($row[1]);
			echo "<img id='imagenUsuarioPequenia' src='".$usuario[9]."' alt='' width='30' height='30'>";
			echo "<label align='rigth'>".$usuario[1]." ".$row[5]."</label>";
			echo "<br>";
			echo "<br>";


			echo "<p style='color:white'>".$row[3]."</p>";
			echo "<div align='center'>";
			if ($row[4]){		
				echo "<img src='".$row[4]."' alt=''>";	
			}
			echo "</div>";
			echo "<hr>";
		}
	}
	function chat($id_grupo,$id_user, $sms){
		$res = $this->consulta("INSERT INTO chat VALUES ('','$id_grupo','$id_user','$sms')");
		return $res;
	}
	function conversacion($id_grupo){
		$res = $this->consulta("select id_usuario, mensaje from chat where id_grupo = '".$id_grupo."' order by id_chat asc");
		return $res;

	}


	


}
?>