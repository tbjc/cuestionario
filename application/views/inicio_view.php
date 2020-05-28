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
			<div class="col-md-10 col-md-offset-1" id="cuerpo" style="text-align: center;">
				<img src="./img/logo-simple.png">
				<h2 style="font-weight: bold; margin-top: 100px;">Examen de Ingeso a la UV <br>Con el uso de Lenguaje de Señas Mexicana</h2>
				<img src="./img/índice.jpg" style="width: 100%;">
				<h2 style="font-weight: bold; margin-top: 30px;">B i e n v e n i d o</h2>
				<a href="<?= base_url() ?>index.php/inicio/entrar" class="btn btn-success btn-lg">Ingresar</a>
			</div>
		</div>
	</div>
</body>
</html>