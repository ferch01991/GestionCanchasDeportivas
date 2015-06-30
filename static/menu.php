<nav class="navbar navbar-inverse" id="menu">
	<div class="container-fluid">
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<a class="navbar-brand" href="index.php">Sistema Canchas</a>
			</ul>
			<form class="navbar-form navbar-right" role="search" action="controladores/login.php" method="POST">
				<div class="form-group">
					<input required name="usuario" type="email" class="form-control" placeholder="E-mail">
					<input required name="password" type="password" class="form-control" placeholder="Contraseña">
				</div>
				<button type="submit" class="btn btn-default">Ingresar</button>
			</form>
		</div>
	</div>
</nav>