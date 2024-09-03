// SUBMIT AJAX jQuery Form
$(document).ready(function(){

	var roution = $("#roution").val();

	$('.bl-event').on("click", function() {
		var bl = $(this).attr('bl');
		$("."+bl).slideToggle();
		$(this).each( function( i ) {
		  	if ( $("#"+bl).hasClass("btn-glow")) {
				// console.log("Si");
				$("#"+bl).removeClass("btn-glow btn-outline-primary");
				$("#"+bl).addClass("btn-primary");
			} else {
				// console.log("No");
				$("#"+bl).removeClass("btn-primary");
				$("#"+bl).addClass("btn-glow btn-outline-primary");
			}
		});
	});
	$(".btn-btns-ocultar").on( "click", function() {
		$(".btns-ocultar").slideDown();
	});



	$('.custom-file input').change(function (e) {
		$(this).next('.custom-file-label').html(e.target.files[0].name);
	});

    $('.zoom_form').on('submit' ,(function(event){
		event.preventDefault();
		var rtn		 = "rtn-";
        var frm		 = $(this).attr('id');
        var status   = $('#'+rtn+frm);
		$(this).ajaxSubmit({
			beforeSend: function() { status.html('<img src="'+roution+'resources/loading.gif" /> Procesando datos...'); },
			complete: function(xhr) { status.html(xhr.responseText); }
		});
	}));

});

// Listen Select
$(document).ready(function(){
	$('#id_categoria').on('change', function() {
		var id_categoria = $(this).val();
		if(id_categoria != 0){
			$("#id_subcategoria").html($("<option></option>").attr("value", 0).text("Cargando datos..."));
			$.post("../process/all/accion_load_subcategorias.php",{
				id_categoria: id_categoria
			},function(data){
				$("#id_subcategoria").html(data);
			});
		} else {
			$("#id_subcategoria").html($("<option></option>").attr("value", 0).text("Sin datos"));
		}
	});

});