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
			background-color: #f3f2f1;
			font-family: 'Roboto', sans-serif !important;
		}

		#cuerpo h1, #cuerpo h2{
			text-align: center;
		}

		@media (max-width: 767px) {
    		#divIzq {
        		margin: 0 auto;
    		}

		}

		#labelsesion{
			font-size: 30px;
			font-family: 'Roboto', sans-serif !important;	
		}
		.pleca {
		    background: #0D47A1;
		    color: #fff;
		    font-size: 16px;
		    font-weight: normal;
		    height: 2em;
		    padding-right: 2em;
		    padding-left: 2em;
		    text-align: right;
		    font-family: "Segoe UI Webfont", -apple-system, "Helvetica Neue", "Lucida Grande", Roboto, Ebrima, "Nirmala UI", Gadugi, "Segoe Xbox Symbol", "Segoe UI Symbol", "Meiryo UI", "Khmer UI", Tunga, "Lao UI", Raavi, "Iskoola Pota", Latha, Leelawadee, "Microsoft YaHei UI", "Microsoft JhengHei UI", "Malgun Gothic", "Estrangelo Edessa", "Microsoft Himalaya", "Microsoft New Tai Lue", "Microsoft PhagsPa", "Microsoft Tai Le", "Microsoft Yi Baiti", "Mongolian Baiti", "MV Boli", "Myanmar Text", "Cambria Math";
		}

		.imgLogin{
			height: 20%;
			width: 20%;
		}			
	</style>
</head>
<body>

  		<div class="container-fluid">
            <div class="row">
                <div class="col-md-10" id="colImg">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="./img/logo-simple.png" class="imgLogin" />
                        </div>
                    </div>
                </div>
                <div id="divIzq" class="col-md-2">
                    <div class="row float-right">
                        <div class="pleca">
                            Universidad Veracruzana
                        </div>
                    </div>
                </div>    
  			</div>	
  		</div>	

	<div class="row justify-content-md-center">
		<div class="col-md-6 col-md-offset-4" style="margin-top: 40px;">
			<video controls style="max-width: 510px; margin-top: 30px; align:center;">
				<source src="./videos/videoInicio.mp4" type="video/mp4">
			</video>
		</div>
	</div>
	<div class="row justify-content-md-center">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-primary" style="">

				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div id="formP">
								<div id="labelsesion" style="text-align: center;">Inicio de Sesión</div>
								<div class="form-group" style="margin-top: 15px;">
									<div class="input-group">
										<span class="input-group-addon" style="font-weight: bold; width:140px;">Cuenta de Usuario</span>
										<input type="text" id="input_folio" class="form-control" maxlength="9" style="width:335px;">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon" style="font-weight: bold; width:140px;">Contraseña</span>
										<input type="password" id="input_password" class="form-control" style="width:335px;">
									</div>
								</div>
								<div id="errores"></div>
								<div style="text-align: right;">
									<button type="button" id="btnLog" class="btn btn-success">Iniciar Sesión</button>
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