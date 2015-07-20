
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<?php echo "<a class='navbar-brand' href='../vistas/muro.php?idUsuario=".$idUsuario."'>Sistema Canchas</a>"?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Grupos <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php
						$grupos = $conexion->gruposUsuario($idUsuario);
						for ($i = 0; $i < count($grupos); $i++){
							$idGrupo = $conexion->idGrupo($grupos[$i], $idUsuario);
							echo "<li><a href='../vistas/grupo.php?idGrupo=".$idGrupo."&idUsuario=".$idUsuario."'>".$grupos[$i]."</a>";
							echo "</li>";
						}
						?>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Invitaciones <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php 	
						$resInvitaciones = $conexion->invitaciones($idUsuario);
						while ($row = mysql_fetch_row($resInvitaciones)){
							$grupo = $conexion->datosGrupo($row[0]);
							
							echo "<li><a href='../vistas/invitacionGrupo.php?idGrupo=$row[0]&idUsuario=$row[1]	'>".$grupo[0]."</a></li>";
						}
						?>
					</ul>
				</li>
				<li><a href="../index.php"><img src="../imagenes/sistema/logout.png" WIDTH=25 HEIGTH=25></a></li>
			</ul>
		</div>
	</div>
</nav>