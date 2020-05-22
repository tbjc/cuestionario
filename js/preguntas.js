
seleccionaPregunta(primerPreg);

var guardandoRespuesta = false;

var pausa = false;

var setCronometro;

var tiempo = new Date();

var horaFinal = tiempo.getHours() + 4;
var minFinal = tiempo.getMinutes() + 30;
var segFinal = tiempo.getSeconds();
var diaFinal = tiempo.getDate();
if (minFinal > 59 ) {
	minFinal = minFinal - 60;
	horaFinal++;
}

if (minFinal > 59 ) {
	minFinal = minFinal - 60;
	horaFinal++;
}

if (horaFinal > 23) {
	horaFinal -= 24;
	diaFinal++;
}

var inicio_pausa;
var termina_pausa;

var finalTiempo = new Date(tiempo.getFullYear(),tiempo.getMonth(),diaFinal,horaFinal,minFinal,segFinal);

console.log(finalTiempo);

console.log(horaFinal+":"+minFinal);

function cronometro(){
	setCronometro = setInterval(function(){
		if (!pausa) {
			let actual = new Date();
			transcurso = (finalTiempo.getTime() - actual.getTime() + 1000)/1000;
			segundos = ('0' + Math.floor(transcurso % 60)).slice(-2);
			minutos = ('0' + Math.floor(transcurso / 60 % 60)).slice(-2);
			horas = ('0' + Math.floor(transcurso / 3600 % 24)).slice(-2);
			if (horas == "-1") {
				terminaExamen();
			}else{
				$("#relog_dato").html(horas+":"+minutos+":"+segundos);
			}
		}
	},1000);
}

function terminaExamen(){
	clearInterval(setCronometro);
	window.location.href = base_url+"index.php/inicio/salir";
}

cronometro();

$.each(pregContest, function(index, val) {
	$("td.preguntaDato[preg-id="+val.pregunta+"]").removeClass('noContestada');
	$("td.preguntaDato[preg-id="+val.pregunta+"]").addClass('contestada');
});

$(document).on('click', '#btn_pausa', function(event) {
	event.preventDefault();
	pausa = true;
	inicio_pausa = new Date();
	$("#modalPausaCuest").modal("show");
});

$(document).on('click', '#btnQuitaPausa', function(event) {
	event.preventDefault();
	termina_pausa = new Date();
	transcurso_pausa = (termina_pausa.getTime() - inicio_pausa.getTime() + 1000)/1000;
	seg_dat = parseInt(('0' + Math.floor(transcurso_pausa % 60)).slice(-2));
	min_dat = parseInt(('0' + Math.floor(transcurso_pausa / 60 % 60)).slice(-2));
	hor_dat = parseInt(('0' + Math.floor(transcurso_pausa / 3600 % 24)).slice(-2));
	horaFinal += hor_dat;
	minFinal += min_dat;
	segFinal += seg_dat;
	finalTiempo = new Date(tiempo.getFullYear(),tiempo.getMonth(),diaFinal,horaFinal,minFinal,segFinal);
	$("#modalPausaCuest").modal("hide");
	pausa = false;
	console.log(hor_dat+":"+min_dat+":"+seg_dat);
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

