var Ion = {

	init : function(){

		$(document).ready(function() {

			console.log ("RUNION");

			$(".apuntador").on('click', function(e) {
				e.preventDefault();
				var destino = $(this).attr("destino");
				$('html,body').animate({
					scrollTop: $("#"+destino).offset().top
				}, 'slow');
			});

			$('[data-toggle="tooltip"]').tooltip();

			$(document).scroll(function() {
				var y = $(this).scrollTop();
				if (y > 50) {
					$( ".menumax" ).stop().animate({
						'padding': 0,
						// 'backgroundColor': 'rgba(68,11,116,0.8)'
					}, 500);
				} else {
					$( ".menumax" ).stop().animate({
						'padding': '20 0',
						// 'backgroundColor': 'rgba(68,11,116,0.4)'
					}, 500);
				}
				if (y > 50) $( ".aLogo" ).stop().animate({ 'padding': '10 0','height': 75 }, 400);
				else 		$( ".aLogo" ).stop().animate({ 'padding': '0','height': 75, }, 400);

				if (y > 50) $( ".menux .h120" ).stop().animate({ 'height': 80 }, 200);
				else 		$( ".menux .h120" ).stop().animate({ 'height': 120, }, 200);
			});

			$('.testimonios').slick({
				dots: true,
				infinite: true,
				speed: 1000,
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: false,
				responsive: [
					{ breakpoint: 1024, settings: { slidesToShow: 1, slidesToScroll: 1 }},
					{ breakpoint: 600, settings: { slidesToShow: 1, slidesToScroll: 1 }},
					{ breakpoint: 480, settings: { slidesToShow: 1, slidesToScroll: 1 }}
				]
			});



			$('.btn-migas').on('click', function() {

				var task = $(this).attr('migas');
				var text = $(this).text();

				console.log("Migas... "+text);

				if(text == 'Mostrar'){

					$(".dMigas").slideUp();
					$(".btn-migas").html("Mostrar");

					$(".dMigas-"+task).slideDown();
					$(".btn-migas-"+task).html("Cerrar");

				}else{

					$(".dMigas").slideUp();
					$(".btn-migas").html("Mostrar");

				}

			});

			$('#id_categoria').on('change', function() {
				var id_categoria = $(this).val();
				if(id_categoria != 0){
					$("#id_competencia").html($("<option></option>").attr("value", 0).text("Cargando datos..."));
					$.post(dominion+"models/general/accion_load_competencias.php",{
						id_categoria
					},function(data){
						$("#id_competencia").html(data);
					});
				} else {
					$("#id_competencia").html($("<option></option>").attr("value", 0).text("Todas"));
				}
				$("#id_comportamiento").html($("<option></option>").attr("value", 0).text("Todos"));

			});


			$('#id_competencia').on('change', function() {
				var id_competencia = $(this).val();
				if(id_competencia != 0){
					$("#id_comportamiento").html($("<option></option>").attr("value", 0).text("Cargando datos..."));
					$.post(dominion+"models/general/accion_load_comportamientos.php",{
						id_competencia
					},function(data){
						$("#id_comportamiento").html(data);
					});
				} else {
					$("#id_comportamiento").html($("<option></option>").attr("value", 0).text("Todos"));
				}
			});


			$( ".capa" ).hover(function() {
				$( this ).find( ".cap32" ).stop().slideDown();
			}, function() {
				$( this ).find( ".cap32" ).stop().slideUp();
			});

			$( ".enfoque" ).hover(function() {
				$( this ).find( ".dN" ).stop().slideDown();
			}, function() {
				$( this ).find( ".dN" ).stop().slideUp();
			});

			$(document).click(function(event) {
				$(event.target).closest(".navbar").length || $(".navbar-collapse.show").length && $(".navbar-collapse.show").collapse("hide");
			});

			$(".btn-cores").click(function() {
				$("#list-cores").slideUp();
				$("#form-cores").slideDown();
			});

			$(".btn-trates").click(function() {
				$("#list-trates").slideUp();
				$("#form-trates").slideDown();
			});

			$(".btn-tuto").click(function() {
				$("#form-trates").slideUp();
				$("#list-trates").slideDown();
			});



			// $("html").niceScroll({
			// 	cursorcolor: "#333",
			// 	cursoropacitymin: 0.5,
			// 	cursoropacitymax: 1,
			// 	cursorwidth: "20px",
			// 	cursorborder: 0,
			// 	cursorborderradius: 0,
			// 	zindex: "99999999999999",
			// 	scrollspeed: 250,
			// 	mousescrollstep: 20,
			// 	cursorminheight: 32,
			// });

			$('.zoom_form').on('submit' ,(function(event){
				event.preventDefault();
				var rtn		 = "rtn-";
				var frm		 = $(this).attr('id');
				var status   = $('#'+rtn+frm);
				$(this).ajaxSubmit({
					beforeSend: function() { status.html('<img src="'+dominion+'resources/loading.gif" /> Procesando datos...'); },
					complete: function(xhr) { status.html(xhr.responseText); }
				});
			}));

			$('.zoom_form_tc').on('submit' ,(function(event){
				event.preventDefault();
				var rtn		 = "rtn-";
				var frm		 = $(this).attr('id');
				var status   = $('#'+rtn+frm);
				$(this).ajaxSubmit({
					beforeSend: function() { status.html('<img src="'+dominion+'resources/loading.gif" /> Procesando datos...'); },
					complete: function(xhr) { status.html(xhr.responseText); }
				});
			}));

			$('.zoom_form2').on('submit' ,(function(event){
				event.preventDefault();
				var rtn		 = "rtn-";
				var frm		 = $(this).attr('id');
				var status   = $('#'+rtn+frm);
				$(this).ajaxSubmit({
					beforeSend: function() { status.html('<img src="'+dominion+'resources/loading.gif" /> Procesando datos...'); },
					complete: function(xhr) { status.html(xhr.responseText); }
				});
			}));

			$( window ).resize(function() {
				Ion.ionman();
				setTimeout(function(){ Ion.ionman(); }, 100);
				setTimeout(function(){ Ion.ionman(); }, 1000);
			});

			Ion.ionman();
			setTimeout(function(){ Ion.ionman(); }, 100);
			setTimeout(function(){ Ion.ionman(); }, 1000);
			setTimeout(function(){ Ion.ionman(); }, 2000);
			setTimeout(function(){ Ion.ionman(); }, 4000);

		});

	},

	// TUCOACH
	logOut : function(zone){
		$("#rtn_logout").html("<span>Cerrando sesión...</span>");
		$.post(dominion+"models/general/logout-tucoach.php",{
			close: 1
		},function(data){
			$("#rtn_logout").html(data);
		});
	},

	moveTask : function(tarea, trabajador, empresa, arrow){
		//$("#rtn_tasks").html(tarea+" - "+trabajador+" - "+empresa);
		$.post(dominion+"models/kr/move-task.php",{
			tarea:tarea, trabajador:trabajador, empresa:empresa, arrow:arrow
		},function(data){
			$("#rtn_tasks").html(data);
		});
	},
	moveTask2 : function(tarea, trabajador, empresa, arrow){
		//$("#rtn_tasks").html(tarea+" - "+trabajador+" - "+empresa);
		$.post(dominion+"models/kr/move-task.php",{
			tarea:tarea, trabajador:trabajador, empresa:empresa, arrow:arrow
		},function(data){
			$("#rtn_tasks").html(data);
		});
	},
	moveTask3 : function(tarea, trabajador, empresa, arrow){
		//$("#rtn_tasks").html(tarea+" - "+trabajador+" - "+empresa);
		$.post(dominion+"models/kr/move-task.php",{
			tarea:tarea, trabajador:trabajador, empresa:empresa, arrow:arrow
		},function(data){
			$("#rtn_tasks").html(data);
		});
	},
	getCriterio : function(valor, id_compo, id_grupo){
		$.post(dominion+"models/modulos/get-criterio.php",{
			valor: valor, id_grupo, id_grupo
		},function(data){
			$("#rtn-resp-"+id_compo).html(data);
		});
	},
	getCriterio2 : function(valor, id_compo, id_grupo){
		$.post(dominion+"models/modulos/get-criterio.php",{
			valor: valor, id_grupo, id_grupo
		},function(data){
			$("#rtn-resp2-"+id_compo).html(data);
		});
	},

	ionman : function(){
		// var alto = $(window).height();
		var alto = window.innerHeight;
		var ancho = $(window).width();
		var tomarAlto = $(".tomarAlto").height();



		var daW = $(".o_wrapper").width(); $(".oEllipsis").width((daW/5)-20);



		var daY = $(".daY").width(); $(".daY").height(daY);
		var alt1 = $(".alt1").width(); $(".alt1").height(alt1);
		var alt2 = $(".alt2").width(); $(".alt2").height(alt2);
		var alt3 = $(".alt3").width(); $(".alt3").height(alt3);
		var alt4 = $(".alt4").width(); $(".alt4").height(alt4);
		var alt5 = $(".alt5").width(); $(".alt5").height(alt5);

		var tomaX4 = $(".daY4").width();
		$(".daY4").height(tomaX4*0.7);


		setTimeout(function(){
			var production = $(".production").height();
			$(".production").height(production);
		}, 1000);
		$(".allion").height(alto);
		if(alto < 550){
			$(".allion").height(550);
		}else{
			$(".allion").height(alto);
		}
		if(ancho < 992){
			$(".allion-landing").height("auto");
		}else{
			$(".allion-landing").height(alto);
		}

	},

	contacto : function(roution){
		$("#rtn_contacto").html("<span class='colorAzul ff2'>Enviando mensaje...</span>");
		var c_nombre = $("#c_nombre").val();
		var c_empresa = $("#c_empresa").val();
		var c_celular = $("#c_celular").val();
		var c_email = $("#c_email").val();
		var c_mensaje = $("#c_mensaje").val();
		$.post(roution+"default/zoom/contacto.php",{
			c_nombre:c_nombre, c_empresa:c_empresa, c_celular:c_celular, c_email:c_email, c_mensaje:c_mensaje, roution:roution
		},function(data){
			$("#rtn_contacto").html(data);
		});
	},

	loadModalCR : function(title, nivel, id_nivel, id_proyecto2, id_empresa2, id_responsable2){
		$("#titleModalCR").html(title);
		$("#nivel").val(nivel);
		$("#id_nivel").val(id_nivel);
		$("#id_proyecto2").val(id_proyecto2);
		$("#id_empresa2").val(id_empresa2);
		$("#id_responsable2").val(id_responsable2);

		$("#list-cores").slideDown();
		$("#form-cores").slideUp();
	},

	deleteCR : function(id_cr){
		var nivel 			= $("#nivel").val();
		var id_nivel 		= $("#id_nivel").val();
		var id_proyecto2 	= $("#id_proyecto2").val();
		var id_empresa2 	= $("#id_empresa2").val();

		var seleccion = confirm("¿Está seguro que desea eliminar este co-responsable?");
		if(seleccion == true) {
			$.post(dominion+"models/kr/delete-cr.php",{
				nivel:nivel, id_nivel:id_nivel, id_proyecto2:id_proyecto2, id_empresa2:id_empresa2, id_cr:id_cr
			},function(data){
				$("#rtn_list_cr").html(data);
			});
		}
	},
	deleteCR_2021 : function(id_cr){
		var nivel 			= $("#nivel").val();
		var id_nivel 		= $("#id_nivel").val();
		var id_proyecto2 	= $("#id_proyecto2").val();
		var id_empresa2 	= $("#id_empresa2").val();

		var seleccion = confirm("¿Está seguro que desea eliminar este co-responsable?");
		if(seleccion == true) {
			$.post(dominion+"models/kr/delete-cr.php",{
				nivel:nivel, id_nivel:id_nivel, id_proyecto2:id_proyecto2, id_empresa2:id_empresa2, id_cr:id_cr
			},function(data){
				$("#rtn_list_cr").html(data);
			});
		}
	},
	deleteCR_20212 : function(id_cr){
		var nivel 			= $("#nivel").val();
		var id_nivel 		= $("#id_nivel").val();
		var id_proyecto2 	= $("#id_proyecto2").val();
		var id_empresa2 	= $("#id_empresa2").val();

		var seleccion = confirm("¿Está seguro que desea eliminar este co-responsable?");
		if(seleccion == true) {
			$.post(dominion+"models/kr/delete-cr.php",{
				nivel:nivel, id_nivel:id_nivel, id_proyecto2:id_proyecto2, id_empresa2:id_empresa2, id_cr:id_cr
			},function(data){
				$("#rtn_list_cr").html(data);
			});
		}
	},
	task_on : function(id){

		var seleccion = confirm("¿Está seguro que desea eliminar esta tarea? Esta decisión no se puede revertir.");
		if(seleccion == true) {
			$.post(dominion+"models/kr/delete-task.php",{
				id:id
			},function(data){
				$("#rtn_task_on").html(data);
			});
		}

	},

	deleteTratos : function(id){
		var id_kr			= $("#id_kr3").val();
		var id_proyecto 	= $("#id_proyecto3").val();
		var id_empresa 		= $("#id_empresa3").val();

		var seleccion = confirm("¿Está seguro que desea eliminar esta estrategia?");
		if(seleccion == true) {
			$.post(dominion+"models/kr/delete-estrategia.php",{
				id_kr:id_kr, id_proyecto:id_proyecto, id_empresa:id_empresa, id:id
			},function(data){
				$("#rtn_list_trates").html(data);
			});
		}
	},
	deleteTaskPer : function(id, trb, emp){

		var seleccion = confirm("¿Está seguro que desea eliminar esta tarea personal?");
		if(seleccion == true) {
			$.post(dominion+"models/kr/delete-tarea-personal.php",{
				id:id, trb:trb, emp:emp
			},function(data){
				$("#delete-taspe").html(data);
			});
		}
	},

	moveTaskPer : function(id, trb, emp, dir){

		$.post(dominion+"models/kr/move-tarea-personal.php",{
			id:id, trb:trb, emp:emp, dir,dir
		},function(data){
			$("#delete-taspe").html(data);
		});

	},

	get_hijos : function(nivel, id, proyecto, week, today){

		$(".xnobel-"+nivel).hide(1);
		$(".nobel-"+nivel).show(1);

		$(".nivel-"+nivel).html('');
		$("#nivel-"+nivel+"-"+id).html('<div class="taC t18 colorMorado2 ff0 pAA20"><img src="'+dominion+'resources/loading_tc.gif" width="40" class="mb0" /> &nbsp;&nbsp; <div class="dIB">Estamos cargando los datos...</div></div>');

		$(".nobel-"+nivel+"-"+id).hide(1);
		$(".xnobel-"+nivel+"-"+id).show(1);

		$.post(dominion+"models/kr/get_hijos.php",{
			id:id, nivel:nivel, proyecto:proyecto, week:week, today:today
		},function(data){
			$("#nivel-"+nivel+"-"+id).html(data);
		});

	},
	get_hijos2 : function(nivel, id, proyecto, week, today){

		$(".xnobel-"+nivel).hide(1);
		$(".nobel-"+nivel).show(1);

		$(".nivel-"+nivel).html('');
		$("#nivel-"+nivel+"-"+id).html('<div class="taC t18 colorMorado2 ff0 pAA20"><img src="'+dominion+'resources/loading_tc.gif" width="40" class="mb0" /> &nbsp;&nbsp; <div class="dIB">Estamos cargando los datos...</div></div>');

		$(".nobel-"+nivel+"-"+id).hide(1);
		$(".xnobel-"+nivel+"-"+id).show(1);

		$.post(dominion+"models/kr/get_hijos.php",{
			id:id, nivel:nivel, proyecto:proyecto, week:week, today:today, vv:2
		},function(data){
			$("#nivel-"+nivel+"-"+id).html(data);
		});

	},

	get_hijosResp : function(nivel, quien, id, proyecto, week, today){

		$(".xnobel-"+nivel).hide(1);
		$(".nobel-"+nivel).show(1);

		$(".nivel-"+nivel).html('');
		$("#nivel-"+nivel+"-"+id).html('<div class="taC t18 colorMorado2 ff0 pAA20"><img src="'+dominion+'resources/loading_tc.gif" width="40" class="mb0" /> &nbsp;&nbsp; <div class="dIB">Estamos cargando los datos...</div></div>');

		$(".nobel-"+nivel+"-"+id).hide(1);
		$(".xnobel-"+nivel+"-"+id).show(1);

		$.post(dominion+"models/kr/get_hijos_resp.php",{
			id:id, nivel:nivel, proyecto:proyecto, week:week, today:today, quien:quien
		},function(data){
			$("#nivel-"+nivel+"-"+id).html(data);
		});

	},

	get_hijosResp2 : function(nivel, quien, id, proyecto, week, today){

		$(".xnobel-"+nivel).hide(1);
		$(".nobel-"+nivel).show(1);

		$(".nivel-"+nivel).html('');
		$("#nivel-"+nivel+"-"+id).html('<div class="taC t18 colorMorado2 ff0 pAA20"><img src="'+dominion+'resources/loading_tc.gif" width="40" class="mb0" /> &nbsp;&nbsp; <div class="dIB">Estamos cargando los datos...</div></div>');

		$(".nobel-"+nivel+"-"+id).hide(1);
		$(".xnobel-"+nivel+"-"+id).show(1);

		$.post(dominion+"models/kr/get_hijos_resp.php",{
			id:id, nivel:nivel, proyecto:proyecto, week:week, today:today, quien:quien
		},function(data){
			$("#nivel-"+nivel+"-"+id).html(data);
		});

	},

	close_hijos : function(nivel, id){

		$(".nobel-"+nivel).show(1);
		$(".xnobel-"+nivel).hide(1);
		$(".nivel-"+nivel).html('');

	},

	registro_form : function(roution){

		$("#rtn_campana").html("<span class='colorAzul3 ff3'>Procesando los datos...</span>");
		var id_site 	= $("#id_site").val();
		var id_campana 	= $("#id_campana").val();
		var r_nombres 	= $("#r_nombres").val();
		var r_apellidos = $("#r_apellidos").val();
		var r_celular 	= $("#r_celular").val();
		var r_email 	= $("#r_email").val();
		var r_ciudad 	= $("#r_ciudad").val();
		$.post(roution+"default/zoom/campana1.php",{
			id_site:id_site, id_campana:id_campana, r_nombres:r_nombres, r_apellidos:r_apellidos, r_celular:r_celular, r_email:r_email, r_ciudad:r_ciudad
		},function(data){
			$("#rtn_campana").html(data);
		});

	},

	otro_resultado : function(id){
		$("#btn-resultado-"+id).hide();
		$("#resultado-"+(id)).show();
		$("#btn-resultado-"+(id+1)).show();
	},

};

Ion.init();











