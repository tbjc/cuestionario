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
		
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1" id="cuerpo" style="text-align: center;">				
				<h2 style="font-weight: bold; margin-top: 200px;">Examen de Ingeso a la Universidad Veracruzana <br>
					para Aspirantes con discapacidad auditiva <br>
					utilizando Lengua de Señas Mexicana</h2><br>
				<img src="./img/índice.jpg" style="width: 100%;">
				<h2 style="font-weight: bold; margin-top: 30px;">B i e n v e n i d o</h2>
				<a href="<?= base_url() ?>index.php/inicio/entrar" style="margin-top: 100px;" class="btn btn-success btn-lg">Ingresar</a>
			</div>
		</div>
	</div>
</body>
</html>