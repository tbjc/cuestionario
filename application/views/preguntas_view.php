<!DOCTYPE html>
<html lang="es">
<head>
  <base href="<?= base_url() ?>">
  <title>Cuestionario</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="icon" type="text/css" href="./favicon.ico">
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
      font-size: 20px;
      margin-left: 20px;
      margin-right: 20px;
    }

    table#tablePregunta tbody tr td{
      padding: 3px;
      border: 1px solid black;
      background: #59a533;
      color: white;
      font-weight: bold;
    }

    table#tablePregunta tbody tr td.actual{
      background: #3354a5 !important;
    }

    table#tablePregunta tbody tr td.contestada{
      background: #00bc91;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top" style="border-bottom: 1px solid #aaa">
  <div class="container-fluid">
    <div class="navbar-form navbar-left">
      <div class="form-group" style="padding-right: 5px;">
        <label><?= $this->session->userdata('nombre'); ?></label>
      </div>
      <div class="form-group" id="divBtnInicio">
        <button class="btn btn-primary" type="button" id="btn_inicia_examen"><span class="glyphicon glyphicon-play"></span> Iniciar</button>
      </div>
      <div class="form-group">
        <label id="relog_dato">00:00:00</label>
      </div>
      <div class="form-group" id="div_controles" style="display: none;">
        <button class="btn btn-warning" type="button" id="btn_pausa"><span class="glyphicon glyphicon-pause"></span>Pausar</button>
        <button class="btn btn-success" type="button" id="btnFinalizar">Terminar</button>
      </div>
      
    </div>
  </div>
</nav>

<div class="container" id="contenedorInicio" style="text-align: center; margin-top: 70px;">
  <h2 style="text-align: center; font-weight: bold;">Instrucciones Generales</h2>
  <video controls src="./videos/videoInicio.mp4" style="max-width: 500px; margin-top: 30px;"></video>
  <h2 style="text-align: center; font-weight: bold;">Para iniciar el examen presione el botón "Iniciar"</h1>
</div>
  
<div class="container" id="contenedorPreguntas" style="display: none; margin-top: 70px;">
  <div class="row">
    <div class="col-md-8">
      <div>
        <h2 id="txtPregunta"></h2>
        <div id="divPregTxt" class="collapse"></div>
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
              <td style="background-color: #3354a5;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td style="font-size: 12px;">&nbsp;Pregunta actual &nbsp;</td>
              <td style="background-color: #00bc91;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td style="font-size: 12px;">&nbsp;Contestadas &nbsp;</td>
              <td style="background-color: #59a533;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td style="font-size: 12px;">&nbsp;No contestadas &nbsp;</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div id="divPreguntas">
        <h2>Selecciona la respuesta correcta</h2>
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
      <div class="modal-header" style="background-color: #c60a18;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body" id="modal_fin_msj">
        
      </div>
      <div class="modal-footer">
        <button type="button" id="btn_fin" class="btn btn-success" data-dismiss="modal">Finalizar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<div id="modalGuardaResp" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #122d66;">
        <h4 class="modal-title" style="color: white;">Guardado</h4>
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
      <div class="modal-header" style="background-color: #122d66;">
        <h4 class="modal-title" style="color: white;">Examen Pausado</h4>
      </div>
      <div class="modal-body" id="">
        <h4 style="text-align: center;">Para poder continuar con el examen es necesario que use su FolioUV y Contraseña</h4>
        <div class="">
          <div class="form-group">
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
          <div id="errores_login2"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnQuitaPausa" class="btn btn-success">Continuar Cuestionario</button>
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