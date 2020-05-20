
seleccionaPregunta(primerPreg);

var guardandoRespuesta = false;

$.each(pregContest, function(index, val) {
	$("td.preguntaDato[preg-id="+val.pregunta+"]").removeClass('noContestada');
	$("td.preguntaDato[preg-id="+val.pregunta+"]").addClass('contestada');
});

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
	let vid = document.getElementById("videoP");
	vid.pause();
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
			opcionesResp +=	'<input type="radio" class="opcResp" name="checkrespuesta" valor="'+val.resp_id+'">'
			opcionesResp += '<label> &nbsp;&nbsp;Opción '+val.resp_opcion+'</label> <button type="button" class="btn btn-info btn-resp" valor="'+val.resp_id+'"><span class="glyphicon glyphicon-eye-open"></span></button>'
			opcionesResp += '</li>';
		});
		$("#contentVideo").html('<video id="videoP" src="./videos/exam'+data.preg_cuestionario+'/videop'+data.preg_numero+'.mp4" width="100%" autoplay controls style="border: 1px solid black; max-height: 500px;"></video>');
		$("#listaOpcionesDatos").html(opcionesResp);
		$(".preguntaDato").each(function(index, el) {
			$(this).removeClass('actual');
		});
		$("td.preguntaDato[preg-id="+id+"]").addClass('actual');
		if (data.contestada) {
			$("input.opcResp[valor="+data.contestada+"]").prop('checked', true);
			$("li.liOption[valor-opt="+data.contestada+"]").addClass('active');
		}
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

$(document).on('click', '#btnSalir', function(event) {
	event.preventDefault();
	window.location.href = base_url + "index.php/inicio/logout";
});

$(document).on('click', '#btnFinalizar', function(event) {
	event.preventDefault();
	$("#modal_fin_msj").html("<h3 style='text-align:center;'>¿Estas Seguro de querer finalizar el examen?</h3>");
	let vid = document.getElementById("videoP");
	vid.pause();
	$("#modalFinalizar").modal("show");
});

$(document).on('click', '#savePreg', function(event) {
	event.preventDefault();
	let pregunta = $("td.actual").attr('preg-id');
	let respuesta = $("input.opcResp:checked").attr('valor');
	if (respuesta && !guardandoRespuesta) {
		let peticion = {};
		peticion["pregunta"] = pregunta;
		peticion["respuesta"] = respuesta;
		guardandoRespuesta = true;
		$.ajax({
			url: base_url+'index.php/inicio/guardaRespuesta',
			type: 'POST',
			dataType: 'json',
			data: peticion,
		})
		.done(function(data) {
			console.log(data);
			guardandoRespuesta = false;
			$("td.preguntaDato[preg-id="+data.resp_usu_preg+"]").removeClass('noContestada');
			$("td.preguntaDato[preg-id="+data.resp_usu_preg+"]").addClass('contestada');
			if ($("td.contestada").length == totalPreg) {
				$("#modal_fin_msj").html("<h3 style='text-align:center;'> Respuesta Guardada <br> Has terminado el examen ¿Quieres finalizarlo?</h3>");
				let vid = document.getElementById("videoP");
				vid.pause();
				$("#modalFinalizar").modal("show");
			}else{
				$("#modalGuardaResp").modal("show");
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	}
});

$(document).on('click', '#btnSigPreg', function(event) {
	event.preventDefault();
	let numNoCon = $("td.noContestada").length;
	if (numNoCon > 0) {
		let arrayNoCont = $("td.noContestada").toArray();
		let noCont = arrayNoCont[0];
		seleccionaPregunta($(noCont).attr('preg-id'));
		$("#modalGuardaResp").modal("hide");

	}
});

$(document).on('click', '#btn_fin', function(event) {
	event.preventDefault();
	window.location.href = base_url+"index.php/inicio/salir";
});

