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

<nav class="navbar navbar-default" style="border-bottom: 1px solid #aaa">
  <div class="container-fluid">
    <div class="navbar-form navbar-right">
      <div class="form-group" style="padding-right: 5px;">
        <label><?= $this->session->userdata('nombre'); ?></label>
      </div>
      <button type="button" id="btnSalir" class="btn btn-success"><span class="glyphicon glyphicon-log-out"></span> Salir</button>
    </div>
  </div>
</nav>
  
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <div>
        <h2 id="txtPregunta"></h2>
        <div id="contentVideo">
        </div>
      </div>
      
      
    </div>
    <div class="col-md-4" style="margin-top: 50px;">
      <h1 id="relog_dato" style="text-align: center;">04:30:00</h1>
      <div style="text-align: center;">
        <button class="btn btn-warning" type="button" id="btn_pausa">Pausar</button>
        <button class="btn btn-success" type="button" id="btnFinalizar">Terminar</button>
      </div>
      <div style="padding: 15px;">
        <table>
          <tbody>
            <tr><td style="background-color: #3354a5;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;Pregunta actual</td></tr>
            <tr><td style="background-color: #00bc91;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;Contestadas</td></tr>
            <tr><td style="background-color: #59a533;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;No contestadas</td></tr>
          </tbody>
        </table>
      </div>
      <div>
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
    </div>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div id="divPreguntas">
        <p>Selecciona la respuesta correcta</p>
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
        <h2>Usted ha pausado el examen</h2>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnQuitaPausa" class="btn btn-success">Continuar Cuestionario</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var totalPreg = <?= $numPreguntas ?>;
  var primerPreg = <?= $preguntas[0][0]["id"] ?>;
  var base_url = "<?= base_url() ?>";
  var pregContest = <?= json_encode($pregCont) ?>;
</script>
<script src="./js/preguntas.js"></script>
</body>
</html>