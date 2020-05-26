<!DOCTYPE html>
<html>
<head>
	<title>Bienvenido al examen de Ingreso</title>
	<base href="<?= base_url() ?>">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<script src="./js/jquery.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<style type="text/css">
		body{
			background-color: #f3f2f1;
		}

		#cuerpo h1, #cuerpo h2{
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3" id="cuerpo" style="text-align: center;">
				<h1>Nombre_sistema</h1>
				<img src="./img/logo-simple.png">
				<h2>Sistema de Ingreso a la UV con el uso de lenguaje de señas mexicana</h2>
				<h2>Bienvenido</h2>
				<a href="<?= base_url() ?>index.php/inicio/entrar" class="btn btn-success btn-lg">Ingresar</a>
			</div>
		</div>
	</div>
</body>
</html>