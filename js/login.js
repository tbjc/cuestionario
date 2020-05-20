$(document).on('click', '#btnLog', function(event) {
	event.preventDefault();
	let folio = $("#input_folio").val();
	let pass = $("#input_password").val();
	let peticion = {
		"folio" : folio,
		"password" : pass
	};
	if (folio != "" && pass != "") {
		$("#errores").html("");
		$.ajax({
			url: base_url+'index.php/inicio/login',
			type: 'POST',
			dataType: 'json',
			data: peticion,
		})
		.done(function(data) {
			if (data["pasa"] == "true") {
				window.location.href = base_url+"index.php/inicio/instrucciones";
			}else{
				$("#errores").html('<div class="alert alert-danger" role="alert">'+data.msj+'</div>');
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	}else{
		$("#errores").html('<div class="alert alert-warning" role="alert">Debe introducir el FolioUV y la contraseña</div>');
	}
	
});