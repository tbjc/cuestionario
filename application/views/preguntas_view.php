<!DOCTYPE html>
<html lang="es">
<head>
  <base href="<?= base_url() ?>">
  <title>Cuestionario</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="icon" type="text/css" href="./favicon.ico">
  <link media="all" href="./css/math.css" type="text/css" rel="stylesheet">
  <link media="all" href="./css/radiobutton.css" type="text/css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <style type="text/css">
    table.table tbody tr td{
      text-align: center;
    }

    body{
      background: #eaeaea;
    }

    .preguntaDato{
      cursor: pointer;
    }

    #relog_dato{
      font-size: 30px;
      margin-left: 20px;
      margin-right: 20px;
      background:#777;
      color:#eee;
      font-weight:bold;
      width:100%;      
    }

    #nombreusuario{
      font-size: 16px;
      color:#eee;
      font-weight:bold;
      width:100%;      
    }

    .div_nombreusuario{
      display: block;
      background:#494E6B;
    }


    #divPregTxt{
      font-size: 20px;
      text-align: justify;
      color: #192B42;
    }

   .liOption.active{
    background: #288C93;
   }

    table#tablePregunta tbody tr td{
      padding: 3px;
      border: 1px solid black;
      background: #98878F;
      color: white;
      font-weight: bold;
    }

    table#tablePregunta tbody tr td.actual{
      background: #E1BE54 !important;
    }

    table#tablePregunta tbody tr td.contestada{
      background: #288C93;
    }

    #btnSegLeyendo{
      color: #2196f3;
      font-weight: bold;
      cursor: pointer;
    }
   
    .checkSpan{
      background-color: white;
      border: 2px solid #6189cb;
      cursor: pointer;
      font-size: 18px;
    }

    input[type="radio"]{
      display: none;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top" style="border-bottom: 1px solid #aaa; background:#494E6B;">
  <div class="container-fluid">
    <div class="row" style="margin-top: 8px;">
      <div class="col-md-2 div_nombreusuario" style="text-align: center;">
        <label id="nombreusuario"><?= $this->session->userdata('nombre'); ?></label>
      </div>
      <div class="col-md-10" id="divBtnInicio" style="text-align: right">
        <button class="btn btn-primary" type="button" id="btn_inicia_examen"><span class="glyphicon glyphicon-play"></span> Iniciar Examen</button>
      </div>
      <div class="col-md-2 div_controles" style="text-align: center; display: none; margin-top: -8px;">        
        <label id="relog_dato">00:00:00</label>
      </div>
      <div class="col-md-4 div_controles" style="text-align: center; display: none;">        
        <button class="btn btn-warning" type="button" id="btn_pausa" style="align:center;"><span class="glyphicon glyphicon-pause"></span>Pausar Examen</button>
      </div>
      <div class="col-md-4 div_controles" style="text-align: right; display: none;">
        <button class="btn btn-success" type="button" id="btnFinalizar">Terminar Examen</button>
      </div>

    </div>
  </div>
</nav>

<div class="container" id="contenedorInicio" style="text-align: center; margin-top: 70px;">
  <h2 style="text-align: center; font-weight: bold;">Instrucciones Generales</h2>
  <video controls src="./videos/videoInicio.mp4" style="max-width: 500px; margin-top: 30px;"></video>
  <h2 style="text-align: center; font-weight: bold;">Para iniciar el examen presione el botón "Iniciar Examen"</h1>
</div>
  
<div class="container" id="contenedorPreguntas" style="display: none; margin-top: 70px;">
  <div class="row">
    <div class="col-md-8">
      <div>
        <h2 id="txtPregunta"></h2>
        <div id="divPregTxt"></div>
        <div id="contentVideo">
        </div>
      </div>
      
      
    </div>
    <div class="col-md-4" style="margin-top: 50px;">
      <div style="padding-top: 15px;">
        <table class="table table-bordered" id="tablePregunta">
          <tbody>
            <?php foreach($preguntas as $renglon){ ?>
              <tr>
              <?php foreach($renglon as $pregunta){ ?>
                <td class="preguntaDato noContestada" preg-id="<?= $pregunta["id"] ?>"><?= $pregunta["numero"] ?></td>
              <?php } ?>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div>
        <table>
          <tbody>
            <tr>
              <td style="background-color: #E1BE54;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td style="font-size: 13px;">&nbsp;Pregunta actual &nbsp;</td>
              <td style="background-color: #288C93;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td style="font-size: 13px;">&nbsp;Contestadas &nbsp;</td>
              <td style="background-color: #98878F; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td style="font-size: 13px;">&nbsp;No contestadas &nbsp;</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div id="divPreguntas">
        <h2>Opciones de respuesta</h2>
        <ul class="list-group" id="listaOpcionesDatos">
        </ul>
      </div>
      <button class="btn btn-primary" id="savePreg">Guardar Respuesta</button>
    </div>
  </div>
  <div style="margin-bottom: 50px;"></div>
</div>

<div id="modalRespuesta" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ver Respuesta</h4>
      </div>
      <div class="modal-body" id="modalVideoResp">
        
      </div>
      <div class="modal-footer">
        <button type="button" id="cierraResp" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div id="modalFinalizar" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #494E6B;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color: white;">Aviso</h4>
      </div>
      <div class="modal-body" id="modal_fin_msj">
        
      </div>
      <div class="modal-footer">
        <button type="button" id="btn_fin" class="btn btn-success" data-dismiss="modal">Sí, Finalizar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">No, Cancelar</button>
      </div>
    </div>
  </div>
</div>

<div id="modalGuardaResp" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #494E6B;">
        <h4 class="modal-title" style="color: white;">Aviso</h4>
      </div>
      <div class="modal-body" id="">
        <h3>Respuesta guardada</h3>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnSigPreg" class="btn btn-success">Siguiente pregunta</button>
      </div>
    </div>
  </div>
</div>

<div id="modalPausaCuest" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #494E6B;">
        <h4 class="modal-title" style="color: white;">Examen en Pausa</h4>
      </div>
      <div class="modal-body" id="">
        <h4 style="text-align: center;">Para poder continuar es necesario se autentique de nuevo</h4>
        <div class="">
          <div class="form-group" style="margin-top: 15px;">
            <div class="input-group">
              <span class="input-group-addon" style="font-weight: bold; width:140px;">Cuenta de Usuario</span>
              <input type="text" id="input_folio" class="form-control" maxlength="9" style="width:400px;">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon" style="font-weight: bold; width:150px;">Contraseña</span>
              <input type="password" id="input_password" class="form-control" style="width:400px;">
            </div>
          </div>
          <div id="errores_login2"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnQuitaPausa" class="btn btn-success">Continuar Examen</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function keepsession(){
    setTimeout(function(){ 
      $.ajax({
        url: "<?= base_url() ?>index.php/inicio/keepsession",
        type: 'GET',
      })
      .done(function(data) {
        keepsession();
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
      
    }, 60000);
  }

  keepsession();
</script>

<script type="text/javascript">
  var hora_inicio = '<?= $hora_inicio ?>';
  var estadoP = '<?= $estadoP ?>';
  var totalPreg = <?= $numPreguntas ?>;
  var primerPreg = <?= $preguntas[0][0]["id"] ?>;
  var base_url = "<?= base_url() ?>";
  var pregContest = <?= json_encode($pregCont) ?>;
</script>
<script src="./js/preguntas.js"></script>
</body>
</html>