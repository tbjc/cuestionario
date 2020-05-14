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
      background: #3354a5;
    }

    table#tablePregunta tbody tr td.contestada{
      background: #3354a5;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-default" style="border-bottom: 1px solid #aaa">
  <div class="container-fluid">
    <div class="navbar-form navbar-right">
      <div class="form-group" style="padding-right: 5px;">
        <label>Nombre completo del aspirante de licenciatura</label>
      </div>
      <button type="button" class="btn btn-success"><span class="glyphicon glyphicon-log-out"></span> Salir</button>
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
      <div id="divPreguntas">
        <p>Selecciona la respuesta correcta</p>
        <ul class="list-group" id="listaOpcionesDatos">
        </ul>
      </div>
      
    </div>
    <div class="col-md-4" style="margin-top: 50px;">
      <table class="table table-bordered" id="tablePregunta">
        <tbody>
          <?php foreach($preguntas as $renglon){ ?>
            <tr>
            <?php foreach($renglon as $pregunta){ ?>
              <td class="preguntaDato" preg-id="<?= $pregunta["id"] ?>"><?= $pregunta["numero"] ?></td>
            <?php } ?>
            </tr>
          <?php } ?>

        </tbody>
      </table>
      <div style="text-align: center;">
        <button class="btn btn-success btn-lg">Terminar Examen</button>
      </div>
      
    </div>
  </div>
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

<script type="text/javascript">
  var primerPreg = <?= $preguntas[0][0]["id"] ?>;
  var base_url = "<?= base_url() ?>";
</script>
<script src="./js/preguntas.js"></script>
</body>
</html>