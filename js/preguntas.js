

seleccionaPregunta(primerPreg);

$(document).on('change', 'input[name=checkrespuesta]:checked', function(event) {
	event.preventDefault();
	let valor = $(this).attr('valor');
	console.log(valor);
	$(".liOption").each(function(index, el) {
		$(this).removeClass('active');
	});
	$(".liOption[valor-opt="+valor+"]").addClass('active');
});

$(document).on('click', '.btn-resp', function(event) {
	event.preventDefault();
	let valor = $(this).attr('valor');
	$("#modalVideoResp").html('<video src="./videos/exam1/resp1/rsp'+valor+'.mp4" width="100%" style="" autoplay controls> </video>');
	$("#modalRespuesta").modal("show");
});

$(document).on('click', '#cierraResp', function(event) {
	$("#modalVideoResp").html("");
});

function seleccionaPregunta(id){
	$.ajax({
		url: base_url+'index.php/inicio/cargaPregById',
		type: 'POST',
		dataType: 'JSON',
		data: {id: id},
	})
	.done(function(data) {
		$("#txtPregunta").html("Pregunta "+data.preg_numero);
		let opcionesResp = '';
		$.each(data.respuestas, function(index, val) {
			opcionesResp += '<li class="list-group-item liOption" valor-opt="'+val.resp_id+'">';
			opcionesResp +=	'<input type="radio" name="checkrespuesta" valor="'+val.resp_id+'">'
			opcionesResp += '<label> &nbsp;&nbsp;Respuesta '+val.resp_opcion+'</label> <button type="button" class="btn btn-info btn-resp" valor="'+val.resp_id+'"><span class="glyphicon glyphicon-eye-open"></span></button>'
			opcionesResp += '</li>';
		});
		$("#contentVideo").html('<video src="./videos/exam'+data.preg_cuestionario+'/videop'+data.preg_numero+'.mp4" width="100%" autoplay controls style="border: 1px solid black; max-height: 500px;"></video>');
		$("#listaOpcionesDatos").html(opcionesResp);
		$(".preguntaDato").each(function(index, el) {
			$(this).removeClass('actual');
		});
		$("td.preguntaDato[preg-id="+id+"]").addClass('actual');
		console.log(data);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
}

$(document).on('click', '.preguntaDato', function(event) {
	event.preventDefault();
	let id = $(this).attr('preg-id');
	seleccionaPregunta(id);
});