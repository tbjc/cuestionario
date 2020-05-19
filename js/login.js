$(document).on('click', '#btnLog', function(event) {
	event.preventDefault();
	let folio = $("#input_folio").val();
	let pass = $("#input_password").val();
	let peticion = {
		"folio" : folio,
		"password" : pass
	};
	if (folio != "" && pass != "") {
		$.ajax({
			url: base_url+'index.php/inicio/login',
			type: 'POST',
			dataType: 'json',
			data: peticion,
		})
		.done(function(data) {
			if (data["pasa"] = "true") {
				window.location.href = base_url+"index.php/inicio/preguntas";
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