
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<a class="navbar-brand" href="muro.php">Sistema Canchas</a>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Grupos <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php
						$grupos = $conexion->gruposUsuario($id);
						for ($i = 0; $i < count($grupos); $i++){
							$idGrupo = $conexion->idGrupo($grupos[$i], $id);
							echo "<li><a href='../vistas/grupo.php?idGrupo=".$idGrupo."&idUsuario=".$id."'>".$grupos[$i]."</a></li>";
							$idGrupo = $conexion($grupos[$i], $id);
							echo "<li><a href='grupos.php?idGrupo=".$idGrupo."&idUsuario=".$id."'>".$grupos[$i]."</a></li>";
						}
						?>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>