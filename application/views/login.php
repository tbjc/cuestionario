<!DOCTYPE html>
<html>
<head>
	<base href="<?= base_url() ?>">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Examen de ingreso</title>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
	<link rel="icon" type="text/css" href="./favicon.ico">
	<script src="./js/jquery.min.js"></script>
	<style type="text/css">
		body{
			background: #eaeaea;
		}
	</style>
</head>
<body>
	<div class="row justify-content-md-center">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-primary" style="margin-top: 50px;">

				<div class="panel-body">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<div id="formP">
								<div style="text-align: center;">
									<img src="./img/logo-simple.png">
								</div>
								<div style="margin-top: 20px; text-align: center;">Inicio de Sesion</div>
								<div class="form-group" style="margin-top: 30px;">
									<div class="input-group">
										<span class="input-group-addon" style="font-weight: bold;">FolioUV</span>
										<input type="text" id="input_folio" class="form-control" maxlength="9">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon" style="font-weight: bold;">Contraseña</span>
										<input type="password" id="input_password" class="form-control">
									</div>
								</div>
								<div id="errores"></div>
								<div style="text-align: right;">
									<button type="button" id="btnLog" class="btn btn-success">Entrar</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		var base_url = "<?= base_url() ?>";
	</script>
	<script src="<?= base_url() ?>js/login.js"></script>
</body>
</html>