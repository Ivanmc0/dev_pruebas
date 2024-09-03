var Crudion = {

	init : function(){

		$('#id_publico').on('change', function() {
			var id_publico = $(this).val();
			console.log("Publico... "+id_publico);
			if(id_publico == 2){
				$(".publicoExterno").slideDown();
			} else {
				$(".publicoExterno").slideUp();
			}
		});

	},


	Botoneria : function (mud){
		return {
			name: 'Opciones',
			width: '160px',
			sort: false,
			formatter: (cell, row) => {
				// console.log(row.cells[0].data+" --- "+mud);
				return gridjs.h(
					'div', {
						id : row.cells[0].data,
						row : 'rtn-'+row.cells[0]['_id'],
						className: 'div-options taC',
					}, ' '
				);
			}
		}
	},

	Status : function (){
		return {
			name: 'Estado',
			width: '130px',
			sort: false,
			formatter: (cell, row) => {
				// console.log(row.cells[0].data);
				let status = (row.cells[1].data == 1) ? 'Inactivo' : 'Activo';
				let icon   = (row.cells[1].data == 1) ? 'las la-minus-circle' : 'las la-check-circle';
				let color  = (row.cells[1].data == 1) ? 'bRojo' : 'bVerde';
				let i      = gridjs.h( 'i', { className: icon }, '');
				let span   = gridjs.h( 'span', { className: 'pL5 ff1' }, status);

				return gridjs.h(
					'div', {
						className: color +' dIB colorfff p510 rr5 t14',
					}, [i, span],
				);
			}
		}

	},

	GetList : function(list, father = 0){

		let columns = [];
		let filas   = [];
		let height  = window.innerHeight;


		switch (list) {
			case 'colaboradores':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(), 'Fecha', 'Identificación','Nombre', 'Apellido', 'Email', 'Cargo', Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.uuid, fila.inactivo, null, fila.fecha, fila.identificacion_completa,fila.nombres, fila.apellidos, fila.datos_contacto.correo,  fila.cargo.nombre, null ];
				break;

			case 'organigramas':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(), 'Fecha','Nombre', 'Principal', Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.uuid, fila.inactivo, null,fila.fecha, fila.nombre, fila.principal, null ];
				break;

			case 'org-cargos':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(), 'Nombre', 'Nivel', 'Dependencia', Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.uuid, fila.inactivo, null, fila.nombre, fila.nivel, fila.dependiente.nombre, null ];
				break;

			case 'segmentaciones':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(), 'Fecha', 'Nombre', 'Segmentos', Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.uuid, fila.inactivo, null, fila.fecha, fila.nombre, fila.segmentos_texto, null ];
				break;

			case 'segmento-opciones':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(), 'Nombre', Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.uuid, fila.inactivo, null, fila.nombre, null ];
				break;

			case 'categorias-actividades':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(), 'fecha',  'Nombre', Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.uuid, fila.inactivo, null,fila.fecha, fila.nombre, null ];
				break;

			case 'actividades':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(), 'fecha','Visibilidad','Nombre', 'Asignado a','Desde','hasta', 'Estado',  Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.uuid, fila.inactivo, null, fila.fecha, fila.visiblilidad, fila.nombre,  fila.asignacion.nombre, fila.periodo.desde_front, fila.periodo.hasta_front, fila.estado.tag.text,  null ];
				break;

			case 'interactividades':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(), 'Orden', 'Interactividad', 'Modelo', 'Tipo',  Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.uuid, fila.inactivo, null, fila.prioridad, fila.nombre, fila.modelo.nombre, fila.tipo.nombre, null ];
				break;

			case 'inter-preguntas':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(), 'Orden', 'Pregunta', 'Modo', Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.preg_uuid, fila.preg_inactivo, null, fila.preg_prioridad, fila.preg_nombre, fila.preg_tipo_nombre, null ];
				break;

			case 'inter-respuestas':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(), 'Orden', 'Respuesta', 'Correcta', Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.uuid, fila.inactivo, null, fila.prioridad, fila.nombre, fila.text_correcta, null ];
				break;

			case 'administradores':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(), 'Fecha', 'Colaborador', 'Cargo', Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.uuid, fila.inactivo, null, fila.fecha, fila.colaborador.nombre, fila.colaborador.cargo, null ];
				break;

			case 'insignias':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(), 'fecha', 'Nombre', 'Forma', 'Color', 'Icono', Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.uuid, fila.inactivo, null, fila.fecha, fila.nombre, fila.insignia.forma, fila.insignia.color, fila.insignia.icono, null ];
				break;

			case 'grupos-corporativos':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(),'Fecha', 'Nombre', 'Descripción', 'Miembros', Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.uuid, fila.inactivo, null, fila.fecha, fila.nombre, fila.descripcion, fila.colaboradores, null ];
				break;

			case 'grupos-corporativos-miembros':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(), 'Nombre', 'Cargo', 'Tipo', 'Miembro desde', Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.uuid, fila.inactivo, null, fila.nombre, fila.cargo.nombre, fila.lider, fila.fecha, null ];
				break;

			case 'valoraciones':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(), 'Nombre', 'Descripción', 'Tipo', Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.uuid, fila.inactivo, null, fila.nombre, fila.descripcion, fila.tipo, null ];
				break;

			case 'arquetipos':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(), 'Nombre', 'Cita', Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.uuid, fila.inactivo, null, fila.nombre, fila.cita, null ];
				break;

			case 'encuestas':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(), 'Nombre', 'Descripción', 'Tipo', Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.uuid, fila.inactivo, null, fila.nombre, fila.descripcion, fila.id_tipo, null ];
				break;

			case 'valenc-preguntas':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(), 'Orden', 'Pregunta', 'Modo', Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.uuid, fila.inactivo, null, fila.prioridad, fila.nombre, fila.id_modo, null ];
				break;

			case 'valenc-respuestas':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(), 'Orden', 'Respuesta', 'Valor', Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.uuid, fila.inactivo, null, fila.prioridad, fila.nombre, fila.correcta, null ];
				break;

			case 'proyectos':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(), 'Nombre', 'Descripción', Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.uuid, fila.inactivo, null, fila.nombre, fila.descripcion, null ];
				break;

			case 'listados-externos':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(), 'Nombre', 'Descripción', 'Miembros', Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.uuid, fila.inactivo, null, fila.nombre, fila.descripcion, '-', null ];
				break;

			case 'lista-externa-miembros':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(), 'Nombre', 'Email', 'Celular', 'Empresa', 'Cargo', Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.uuid, fila.inactivo, null, fila.nombre, fila.email, fila.celular, fila.empresa, fila.cargo, null ];
				break;

			case 'listados-internos':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(), 'Nombre', 'Descripción', 'Miembros', Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.uuid, fila.inactivo, null, fila.nombre, fila.descripcion, '-', null ];
				break;

			case 'lista-interna-miembros':
				columns = [ { name: 'UUID', hidden: true }, { name: 'inactivo', hidden: true }, Crudion.Status(), 'Nombre', 'Identificación', 'Cargo', Crudion.Botoneria(list) ];
				filas   = (fila) => [ fila.uuid, fila.inactivo, null, fila.nombre, fila.identificacion, fila.cargo, null ];
				break;


			default: break;
		}

		var myGrid = new gridjs.Grid({
			language: {
				'search': {
					'placeholder': 'Buscador...'
				},
				'pagination': {
					'previous': 'Anterior',
					'next'    : 'Siguiente',
					'showing' : 'Viendo del ',
					'results' : () => 'resultados',
					'of'        : 'de',
					'to'        : ' al ',
				},
				noRecordsFound: 'No se encontraron registros.',
			},
			columns: columns,
			server: {
				url: dominion+'models/admin-list/'+list+'.php' + '?father=' + father,
				then: data => data.map(	filas ),
			},
			sort: true,
			search: true,
			pagination: {
				limit: 10,
				summary: true
			},

		}).render(document.getElementById("front-list"));

	},


	GenerateBottoms : function(modo, mud, app, panel, fath = 0){

		$.post(dominion+"models/transversales/generateBottoms.php",{ modo, mud, app, panel, fath },
		function(data){
			if(modo == 1) $("#rtn-botones-"+mud).html(data);
		});

	},

	LoadOptions : function(mud, fila){

		console.log("Cargando opciones");

		$.post(dominion+"models/transversales/loadOptions.php",{ mud, fila },
		function(data){
			$(fila).html(data);
		});

	},

	Intenso : function(mud){

		$('.div-options').each(function(i, obj) {

			let id = obj.id;

			Crudion.LoadOptions(mud, '#'+id);

			$(this).removeClass("div-options");

		});

		setTimeout(function(){ Crudion.Intenso(mud) }, 1000);

	},

	Run : function(iDinamic, mud = '', even = '', gist = '', fath = 0, panel = 0){

		$("#rtn-"+iDinamic+"").html('<div class="p10 taC"><img src="'+dominion+'resources/loadion.gif" /></div>');
		$.post(dominion+"views/components/modal.php",{ iDinamic, mud, even, gist, fath, panel },
		function(data){
			$("#rtn-modalion-crudion").html(data);
		});

	},

	Launcher : function(iDinamic){

		$('#modal-'+iDinamic).modal();

	},

	Form : function(iDinamic){

		$('#frm-'+iDinamic).on('submit', (function(event){
			event.preventDefault();
			console.log('Formulario activado');
			var rtn		 = "rtn-";
			var frm		 = $(this).attr('id');
			var status   = $('#'+rtn+frm);
			$('#btn-'+iDinamic).hide(1);
			$(this).ajaxSubmit({
				beforeSend: function() { status.html('<img src="'+dominion+'resources/loading.gif" /> Procesando datos...'); },
				complete: function(xhr) {
					xhr.responseText.replace(/\r\n/g, '');
					// console.log(xhr);
					// console.log(xhr.responseText);

					if(xhr.responseText == 1){
						status.html('<div class="alert alert-success">Proceso finalizado exitosamente.</div>');
						setTimeout(function(){
							$('#modal-'+iDinamic).modal('hide');
							location.reload();
						}, 1000);

					}else{

						status.html(xhr.responseText);
						$('#btn-'+iDinamic).show(1);

					}
				}
			});
		}));

	},

	uuid : function () {
		return "10000000-1000-4000-8000-100000000000".replace(/[018]/g, c =>
			(+c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> +c / 4).toString(16)
		);
	},


};

Crudion.init();