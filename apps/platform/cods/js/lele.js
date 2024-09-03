var lele = {
	init: function () {
		$(document).ready(function () {
			console.log("RUN LELE");

			$(".method").on("click", function () {
				var father = $(this).attr("father");
				var method = $(this).attr("method");

				$("#" + father).val(method);

				$("." + father).removeClass("sele");
				$("." + father + "_" + method).addClass("sele");

				$("." + father + "_data").slideUp();
				$("." + father + "_data_" + method).slideDown();
				$("." + father + " .iconFA")
					.removeClass("fa-check-circle")
					.addClass("fa-circle");
				$("." + father + "_" + method + " .iconFA")
					.removeClass("fa-circle")
					.addClass("fa-check-circle");
			});

			$(".method2").on("click", function () {
				var father2 = $(this).attr("father2");
				var method2 = $(this).attr("method2");

				$("#" + father2).eq(0).val(method2);
				$("#" + father2).eq(1).val(method2);

				console.log($("#" + father2).val());

				if ($("." + father2).hasClass("sele2")) {
					$("." + father2).removeClass("sele2");
				} else {
					$("." + father2 + "_" + method2).addClass("sele2");
				}
				if ($("." + father2 + " .iconFA").hasClass("fa-circle")) {
					$("." + father2 + " .iconFA")
					.removeClass("fa-circle")
					.addClass("fa-check-circle");
				}else{
					$("." + father2 + "_" + method2 + " .iconFA")
					.removeClass("fa-check-circle")
					.addClass("fa-circle");
				}
			});

			$(".btnListTrabajadores").on("click", function() {
				$(".listTrabajadores").slideToggle();
			});

		});
	},

	red: function(nivel, array){
		// console.log(nivel);
		// console.log(array);
		$("#"+nivel+" .contenido").html('<div class="p10 taC"><img src="'+dominion+'resources/loadion.gif" /></div>');
		$.post(dominion+"models/externo/red.php",{ nivel, array },
		function(data){
			$("#"+nivel+" .contenido").html(data);
		});
	},

	lider: function(b, t, f, act){
		// console.log(b);
		// console.log(t);
		// console.log(f);
		// console.log(act);
		$("#act_lider_grupo").html('<div class="p10 taC"><img src="'+dominion+'resources/loadion.gif" /></div>');
		$.post(dominion+"models/externo/lider.php",{ b, t, f, act },
		function(data){
			$("#act_lider").html(data);
		});
	},

	liderGrupo: function(b, t, f, a, g){
		$("#act_lider").html('<div class="p10 taC"><img src="'+dominion+'resources/loadion.gif" /></div>');
		$.post(dominion+"models/externo/liderGrupo.php",{ b, t, f, a, g },
		function(data){
			$("#act_lider").html(data);
		});
	},

	liderGrupoDinamica: function(b, t, a, d, p, g){
		$("#tabla_miembros_grupo").html('<div class="p10 taC"><img src="'+dominion+'resources/loadion.gif" /></div>');
		$.post(dominion+"models/externo/liderGrupoDinamica.php",{ b, t, a, d, p, g },
		function(data){
			$("#tabla_miembros_grupo").html(data);
		});
	},

	actividad_detalle: function(a, t, e){
		$("#rtn_actividad_detalle").html('<div class="p10 taC"><img src="'+dominion+'resources/loadion.gif" /></div>');
		$.post(dominion+"models/externo/actividad_detalle.php",{ a, t, e },
		function(data){
			$("#rtn_actividad_detalle").html(data);
		});
	},

	get_interactividades: function(a, t, e){
		$("#rtn_actividad_detalle").html('<div class="p10 taC"><img src="'+dominion+'resources/loadion.gif" /></div>');
		$.post(dominion+"models/externo/interactividades.php",{ a, t, e },
		function(data){
			$("#rtn_actividad_detalle").html(data);
		});
	},

	get_interactividad_encuesta: function(enc, a, t, e){
		$("#rtn_encuesta_respuestas_"+enc).html('<div class="p10 taC"><img src="'+dominion+'resources/loadion.gif" /></div>');
		$.post(dominion+"models/externo/interactividad_encuesta.php",{ enc, a, t, e },
		function(data){
			$("#rtn_encuesta_respuestas_"+enc).html(data);
		});
	},







	encuesta_respuestas: function(enc, a, t, e){
		$("#rtn_encuesta_respuestas_"+enc).html('<div class="p10 taC"><img src="'+dominion+'resources/loadion.gif" /></div>');
		$.post(dominion+"models/externo/encuesta_respuestas.php",{ enc, a, t, e },
		function(data){
			$("#rtn_encuesta_respuestas_"+enc).html(data);
		});
	},

	actividad_detalle_reconocimientos: function(enc, a, t, e){
		$("#rtn_encuesta_respuestas_"+enc).html('<div class="p10 taC"><img src="'+dominion+'resources/loadion.gif" /></div>');
		$.post(dominion+"models/externo/actividad_detalle_reconocimientos.php",{ enc, a, t, e },
		function(data){
			$("#rtn_encuesta_respuestas_"+enc).html(data);
		});
	},

	actividad_listado_reconocimientos: function(enc, a, t, e){
		$("#rtn_listado_reconocimientos_"+enc).html('<div class="p10 taC"><img src="'+dominion+'resources/loadion.gif" /></div>');
		$.post(dominion+"models/externo/actividad_listado_reconocimientos.php",{ enc, a, t, e },
		function(data){
			$("#rtn_listado_reconocimientos_"+enc).html(data);
		});
	},

	actividad_detalle_campana: function(enc, a, t, e){
		$("#rtn_encuesta_respuestas_"+enc).html('<div class="p10 taC"><img src="'+dominion+'resources/loadion.gif" /></div>');
		$.post(dominion+"models/externo/actividad_detalle_campana.php",{ enc, a, t, e },
		function(data){
			$("#rtn_encuesta_respuestas_"+enc).html(data);
		});
	},

	actividad_listado_campanas: function(enc, a, t, e){
		$("#rtn_listado_campanas_"+enc).html('<div class="p10 taC"><img src="'+dominion+'resources/loadion.gif" /></div>');
		$.post(dominion+"models/externo/actividad_listado_campanas.php",{ enc, a, t, e },
		function(data){
			$("#rtn_listado_campanas_"+enc).html(data);
		});
	},


};

lele.init();
