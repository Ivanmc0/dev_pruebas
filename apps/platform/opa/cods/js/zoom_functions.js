var Zoom = {

	init : function(){
		$(document).ready(function() {
			console.log ("RUN ZOOM");
		});
	},

	logOut : function(zone){

		$("#rtn_logout").html("<span class='coloreee'>Cerrando sesión...</span>");

		$.post("../zoom/process/general/logout.php",{
			close: 1
		},function(data){
			$("#rtn_logout").html(data);
		});

	},

	changeDelete : function(tabla, id){
		if(confirm("¿Está seguro que desea eliminar el registro seleccionado?")){
			$("#rtn_list").html('<img src="../resources/loading.gif" />');
			$.post("../zoom/process/general/delete.php",{
				tabla: tabla, id:id
			},function(data){
				$("#rtn_list").html(data);
			});
		}
	},

	getChildren : function(nivel, modulo, rol){
		nivel = nivel+1;
		$("#list-"+nivel).html('<img src="../resources/loading.gif" />');
		for(var oo = nivel; oo<=10; oo++){
			var nov = oo+1;
			$("#list-"+nov).html(' ');
		}
		$(".nivel-"+(nivel-1)).removeClass('bg-primary bg-accent-1');
		$(".mod-"+modulo).addClass('bg-primary bg-accent-1');

		$.post("../zoom/process/configuraciones/load_modulos.php",{
			nivel: nivel, modulo: modulo, rol: rol
		},function(data){
			$("#list-"+nivel).html(data);
		});
	},

	assignModels : function(modulo, rol){
		$(".modicon-"+modulo).html('<img src="../resources/loading.gif" />');
		$.post("../zoom/process/configuraciones/accion-assignModels.php",{
			modulo: modulo, rol: rol
		},function(data){
			$(".modicon-"+modulo).html(data);
		});
	},

	assignProjects : function(proyecto, rol){
		$(".proicon-"+proyecto).html('<img src="../resources/loading.gif" />');
		$.post("../zoom/process/configuraciones/accion-assignProjects.php",{
			proyecto: proyecto, rol: rol
		},function(data){
			$(".proicon-"+proyecto).html(data);
		});
	},

	sendEmailAccess : function(id){

		$("#rtn_send_"+id).html('<img src="../resources/loading.gif" />');

		$.post("../zoom/process/emails/sendAccess.php",{
			id: id
		},function(data){
			$("#rtn_send_"+id).html(data);
		});

	},
	sendEmailKR : function(id){

		$("#rtn_send_"+id).html('<img src="../resources/loading.gif" />');

		$.post("../zoom/process/emails/sendKR.php",{
			id: id
		},function(data){
			$("#rtn_send_"+id).html(data);
		});

	},

	asignEvaluador : function(evaluador, evaluacion){

		$(".rtn_asgEval_"+evaluador).html('<img src="../resources/loading.gif" />');

		$.post("../zoom/process/modulos/accion-asignar-evaluador.php",{
			evaluador:evaluador, evaluacion:evaluacion
		},function(data){
			$(".rtn_asgEval_"+evaluador).html(data);
		});

	},

	createReport : function(id_evaluacion, id_trabajador){

		$("#rtn_report_"+id_evaluacion+"_"+id_trabajador).html('<img src="../resources/loading.gif" />');

		$.post("../zoom/process/modulos/accion-reporte-crear.php",{
			id_evaluacion:id_evaluacion, id_trabajador:id_trabajador
		},function(data){
			$("#rtn_report_"+id_evaluacion+"_"+id_trabajador).html(data);
		});

	},

	createSection : function(){

		$("#rtn-formion-alt").html("<div class='colorAzul'><img src='../resources/img/loading.gif' width='16'> Validando datos...</div>");

		var id					= $("#id").val();
		var id_proyecto			= $("#id_proyecto").val();
		var tabla				= $("#tabla").val();
		var carpeta				= $("#carpeta").val();
		var id_categoria		= $("#id_categoria").val();
		var inactivo			= $("#inactivo").val();
		var titulo1				= $("#titulo1").val();
		var titulo2				= $("#titulo2").val();
		var titulo3				= $("#titulo3").val();
		var titulo4				= $("#titulo4").val();
		var url1				= $("#url1").val();
		var url2				= $("#url2").val();
		var url3				= $("#url3").val();
		var url4				= $("#url4").val();
		var texto1				= $('#texto1').summernote('code');
		var texto2				= $('#texto2').summernote('code');
		var texto3				= $('#texto3').summernote('code');
		var texto4				= $('#texto4').summernote('code');

		$.post("../zoom/process/contenidos/accion-secciones.php",{
			id:id,id_proyecto:id_proyecto,tabla:tabla,carpeta:carpeta,id_categoria:id_categoria,inactivo:inactivo,titulo1:titulo1,titulo2:titulo2,titulo3:titulo3,titulo4:titulo4,url1:url1,url2:url2,url3:url3,url4:url4,texto1:texto1,texto2:texto2,texto3:texto3,texto4:texto4
		},function(data){
			$("#rtn-formion-alt").html(data);
		});

	},

	createArticle : function(){

		$("#rtn-formion-alt").html("<div class='colorAzul'><img src='../resources/img/loading.gif' width='16'> Validando datos...</div>");

		var id					= $("#id").val();
		var id_proyecto			= $("#id_proyecto").val();
		var tabla				= $("#tabla").val();
		var carpeta				= $("#carpeta").val();
		var visible				= $("#visible").val();
		var id_categoria		= $("#id_categoria").val();
		var inactivo			= $("#inactivo").val();
		var id_galeria			= $("#id_galeria").val();
		var nombre				= $("#nombre").val();
		var seo					= $("#seo").val();
		var resumen				= $("#resumen").val();
		var video				= $("#video").val();

		var lugar_evento		= $("#lugar_evento").val();
		var precio_evento		= $("#precio_evento").val();
		var fecha_evento		= $("#fecha_evento").val();
		var hora_evento			= $("#hora_evento").val();
		var detalles_evento		= $("#detalles_evento").val();

		var contenido			= $('#contenido').summernote('code');

		$.post("../zoom/process/contenidos/accion-articulos.php",{
			id:id,id_proyecto:id_proyecto,tabla:tabla,carpeta:carpeta,visible:visible,id_categoria:id_categoria,inactivo:inactivo,id_galeria:id_galeria,nombre:nombre,seo:seo,resumen:resumen,video:video,lugar_evento:lugar_evento,precio_evento:precio_evento,fecha_evento:fecha_evento,hora_evento:hora_evento,detalles_evento:detalles_evento,contenido:contenido
		},function(data){
			$("#rtn-formion-alt").html(data);
		});

	},

	crearGraph : function(id, nombre){

		$("#rtn_adkr_").html('<div class="tabAll"><div class="tabIn taC"><img src="../resources/loading.gif" /></div></div>');

		var allion_json = $("#allion_json").val();

		$.post("../zoom/process/modulos/accion-generar-grafica.php",{
			allion_json:allion_json, id:id, nombre:nombre
		},function(data){
			$("#chartion").html(data);
		});

	},
	preload_Graph : function(id, nombre){
		$("#chartContainer").html('<div class="tabAll"><div class="tabIn taC"><img src="../resources/loading.gif" /></div></div>');

		var segmentions_json = $("#segmentions_json").val();

		$.post("../zoom/process/modulos/accion-generar-grafica-segmentos.php",{
			segmentions_json:segmentions_json, id:id, nombre:nombre
		},function(data){
			$("#chartContainer").html(data);
		});

	},

	change_KR_admin : function(id){

		$("#rtn_adkr_"+id).html('<div class="tabAll"><div class="tabIn taC"><img src="../resources/loading.gif" /></div></div>');

		$.post("../zoom/process/modulos/accion-admin-kr.php",{
			id:id, id:id
		},function(data){
			$("#rtn_adkr_"+id).html(data);
		});

	},

	generateReport : function(report, id, cond = "", cond2 = "", duo = 1){
		$("#rsp_generateReport").html('<div class="taC"><img src="../resources/olc-loading.gif" /></div>');
		$.post("../zoom/process/reportes/"+report+".php",{
			id, cond, cond2, duo
		},function(data){
			$("#rsp_generateReport").html(data);
		});
	},

	generateGraph : function(report, id, cond = "", cond2 = "", duo = 1, conditions = ""){
		$("#rsp_modalGraph").html('<div class="taC"><img src="../resources/olc-loading.gif" /></div>');
		$.post("../zoom/process/reportes/"+report+".php",{
			id, cond, cond2, duo, conditions
		},function(data){
			$("#rsp_modalGraph").html(data);
		});
	},

	modalGraph : function(report, id, cond = "", cond2 = "", duo = 1, conditions = ""){
		$("#rsp_modalGraph").html('<div class="taC"><img src="../resources/olc-loading.gif" /></div>');
		$('#modalGraph').modal();
		Zoom.generateGraph(report, id, cond, cond2, duo, conditions);
	},





};

Zoom.init();