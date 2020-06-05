var pregunta = "";

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

if (horaFinal > 23) {
	horaFinal -= 24;
	diaFinal++;
}

var inicio_pausa;
var termina_pausa;

var finalTiempo = new Date(tiempo.getFullYear(),tiempo.getMonth(),diaFinal,horaFinal,minFinal,segFinal);

console.log(finalTiempo);

console.log(horaFinal+":"+minFinal);

if (hora_inicio != '00:00:00') {
	let array_hora = hora_inicio.split(":");
	console.log(array_hora);
	horaFinal = parseInt(array_hora[0]) + 4;
	minFinal = parseInt(array_hora[1]) + 30;
	if (minFinal > 59) {
		horaFinal++;
		minFinal-= 60;
	}
	segFinal = parseInt(array_hora[2]);
	finalTiempo = new Date(tiempo.getFullYear(),tiempo.getMonth(),diaFinal,horaFinal,minFinal,segFinal);
	$("#divBtnInicio").css('display', 'none');
	$(".div_controles").css('display', 'inline-block');
	$("#contenedorInicio").css('display', 'none');
	$("#contenedorPreguntas").css('display', 'block');
	cronometro();
}

if (estadoP == "S") {
	$("#modalPausaCuest").modal("show");
}

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
				//$("#relog_dato").html(horas+":"+minutos+":"+segundos);
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

function pintaPregunta(textoPregunta){
	if (textoPregunta.length > 200) {
		let preguntaRecortada = textoPregunta.substr(0, 200);
		$("#divPregTxt").html(""+preguntaRecortada+"... <spam id='btnSegLeyendo' preg-edo='contraido'>Seguir leyendo</spam><br><br>");
		pregunta = textoPregunta;
	}else{
		$("#divPregTxt").html(""+textoPregunta+"<br><br>");
		pregunta = textoPregunta;
	}
}

$(document).on('click', '#btnSegLeyendo', function(event) {
	event.preventDefault();
	if ($(this).attr('preg-edo')=="contraido") {
		$("#divPregTxt").html(""+pregunta+"<spam id='btnSegLeyendo' preg-edo='no_contraido'>Mostrar Menos</spam><br><br>");
	}else{
		let preguntaRecortada = pregunta.substr(0, 200);
		$("#divPregTxt").html(""+preguntaRecortada+"... <spam id='btnSegLeyendo' preg-edo='contraido'>Seguir leyendo</spam><br><br>");
	}
});

$.each(pregContest, function(index, val) {
	$("td.preguntaDato[preg-id="+val.pregunta+"]").removeClass('noContestada');
	$("td.preguntaDato[preg-id="+val.pregunta+"]").addClass('contestada');
});

$(document).on('click', '#btn_inicia_examen', function(event) {
	event.preventDefault();
	tiempo = new Date();
	horaFinal = tiempo.getHours() + 4;
	minFinal = tiempo.getMinutes() + 30;
	segFinal = tiempo.getSeconds();
	diaFinal = tiempo.getDate();

	if (minFinal > 59 ) {
		minFinal = minFinal - 60;
		horaFinal++;
	}

	if (horaFinal > 23) {
		horaFinal -= 24;
		diaFinal++;
	}

	inicio_pausa;
	termina_pausa;

	finalTiempo = new Date(tiempo.getFullYear(),tiempo.getMonth(),diaFinal,horaFinal,minFinal,segFinal);
	cronometro();
	$("#divBtnInicio").css('display', 'none');
	$(".div_controles").css('display', 'inline-block');
	var date_inicio = new Date();
	var str_hora_inicio = ""+date_inicio.getHours()+":"+date_inicio.getMinutes()+":"+date_inicio.getSeconds();
	$.post(base_url+'index.php/inicio/guardaHoraInicio', {hora: str_hora_inicio}, function(data, textStatus, xhr) {
		$("#contenedorInicio").css('display', 'none');
		$("#contenedorPreguntas").css('display', 'block');
	});
});

$(document).on('click', '#btn_pausa', function(event) {
	event.preventDefault();
	let vid = document.getElementById("videoP");
	vid.pause();
	$.post(base_url+'index.php/inicio/guardaPausa', {estado: 'S'}, function(data, textStatus, xhr) {
		if (data == "guardado") {
			$("#modalPausaCuest").modal("show");
		}
	});
	//pausa = true;
	//inicio_pausa = new Date();
	
});

$(document).on('click', '#btnQuitaPausa', function(event) {
	event.preventDefault();
	let folio = $("#input_folio").val();
	let pass = $("#input_password").val();
	let peticion = {
		"folio" : folio,
		"password" : pass
	};
	if (folio != "" && pass != "") {
		$.ajax({
			url: base_url+'index.php/inicio/quitaPausa',
			type: 'POST',
			dataType: 'json',
			data: peticion,
		})
		.done(function(data) {
			if (data.pasa == "true") {
				$.post(base_url+'index.php/inicio/guardaPausa', {estado: 'N'}, function(data, textStatus, xhr) {
					if (data == "guardado") {
						$("#modalPausaCuest").modal("hide");
						console.log(horaFinal+":"+minFinal+":"+segFinal);
					}
				});
				
				
			}else{
				$("#errores_login2").html('<div class="alert alert-danger" role="alert">'+data.msj+'</div>');
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	}else{
		$("#errores_login2").html('<div class="alert alert-warning" role="alert">Debe introducir el FolioUV y la contraseña</div>');
	}
});

$(document).on('change', 'input[name=checkrespuesta]:checked', function(event) {
	event.preventDefault();
	let valor = $(this).attr('valor');
	console.log(valor);
	$(".liOption").each(function(index, el) {
		$(this).removeClass('active');
	});
	$(".checkSpan").each(function(index, el) {
		$(this).css('background-color', 'white');
	});
	$(".checkSpan[valor="+valor+"]").css('background-color',"#494e6b");
	$(".liOption[valor-opt="+valor+"]").addClass('active');
});

$(document).on('click', '.checkSpan', function(event) {
	event.preventDefault();
	let valor = $(this).attr('valor');
	console.log(valor);
	$(".liOption").each(function(index, el) {
		$(this).removeClass('active');
	});
	$(".checkSpan").each(function(index, el) {
		$(this).css('background-color', 'white');
	});
	$(".checkSpan[valor="+valor+"]").css('background-color',"#494e6b");
	$(".liOption[valor-opt="+valor+"]").addClass('active');
	$("input[type=radio][valor="+valor+"]").prop('checked', true);

});

$(document).on('click', '.btn-resp', function(event) {
	event.preventDefault();

	let valor = $(this).attr('valor');
	$("#modalVideoResp").html('<video src="./videos/exam1/resp1/rsp'+valor+'.mp4" width="100%" style="" controls> </video>');
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
		 $("#txtPregunta").html("Pregunta: "+ data.preg_numero);
		let opcionesResp = '';
		$.each(data.respuestas, function(index, val) {
      		opcionesResp += '<li class="list-group-item liOption " valor-opt="'+val.resp_id+'">';
      		opcionesResp += '<div class="row">';
      		opcionesResp += '<div class="col-md-2" style="padding-right:0 !important; width:12.33333%;">';
      		opcionesResp += '<span class="checkSpan" valor="'+val.resp_id+'">&nbsp;&nbsp;&nbsp;&nbsp;</span><input type="radio" class="opcResp" name="checkrespuesta" id="radio'+val.resp_id+'" valor="'+val.resp_id+'"/><label for="radio'+val.resp_id+'"> <span>&nbsp;&nbsp;'+val.resp_opcion+'</span></label>';
      		opcionesResp += '</div><div class="col-md-9" style="padding-left:0 !important;">';
      		opcionesResp += '<strong for="radio'+val.resp_id+'" style="max-width:610px; margin-left:10px; text-align: justify;">' +val.resp_texto+'</strong> ';
      		opcionesResp += '</div><div class="col-md-1">';
      		opcionesResp += '<button type="button" class="btn btn-info btn-resp" style="float: right;" valor="'+val.resp_id+'"><span class="glyphicon glyphicon-eye-open"></span></button>';
      		opcionesResp += '</div>';
      		opcionesResp += '</div>';
      		opcionesResp += '</li>';

		});
		//$("#divPregTxt").html("<br>"+data.preg_pregunta+"<br><br>");
		pintaPregunta(data.preg_pregunta);
		$("#contentVideo").html('<video id="videoP" src="./videos/exam'+data.preg_cuestionario+'/videop'+data.preg_numero+'.mp4" width="100%" controls style="border: 1px solid black; max-height: 500px;"></video>');
		$("#listaOpcionesDatos").html(opcionesResp);
		$(".preguntaDato").each(function(index, el) {
			$(this).removeClass('actual');
		});
		$("td.preguntaDato[preg-id="+id+"]").addClass('actual');
		if (data.contestada) {
			$(".checkSpan[valor="+data.contestada+"]").css("background-color","#494e6b");
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
	$("#modal_fin_msj").html("<h3 style='text-align:center;'>¿Estás Seguro de querer finalizar el examen?</h3>");
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