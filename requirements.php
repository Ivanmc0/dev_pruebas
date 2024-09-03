<?php

/*




Actividad
	Categoria
	modelo
	tipo modelo
	dinamicas
		preguntas  ( cantidad de respuestas, calificacion=(  ) )
			---
			---
			respuestas ( cantidad de evaluadores,   calificacion )
				-------
				Soluciones
					Colaborador
						segmentaciones
							segmento







		[balance_dinamica] => Array
                (
					[correctas]      => Total de soluciones correctas
					[incorrectas]    => Total de solcuiones incorrectas
					[sumatoria]      => Sumatoria del valor de las soluciones correctas
					[c_soluciones]   => Cantidad de soluciones correctas
					[solucionadores] => Cantidad de trabajadores que aportaron soluciones
					[total]          => Promedio de las soluciones correctas ( sumatoria / Cantidad solucionadores )
                )






pregunta  : Cali ?
Respuestas: Si (3,100) / No (1,0) / Talvez ( 1,100 )
Soluciones:
			Maria     : Si ( 50 )
			Juan      : Si ( 50 )
			Pedro     : Si ( 50 )
			Ana       : No ( 0 )
			Diana	  : ****
							Pa-> 100 , 0
							Pb-> 100 , 0 Correcta
							Pc-> 100, 0  Correcta


Respuestas - Evaluadores ( 3 con 100 , 1 con 0)
Prgunta -> Porcentaje correcto = Cantidad correctas / total respuestas  4/ 5 * 100 = 80%   5/7  71.4%

Pregunta - Cali 75% = Proporcion correcto / incorrecto   Suma resultados / Sumatoria evaluadores * evaluadores correctos 100/4 * 3 = 75



1. Si/No
	total solucionadores 3
	2 respondieron bien ( 200 ) 200/3  66.6%
	1 respondio mal  ( 0 )

2. A/B/C/D
   0-50-0-50

   A0-D50 	= 50
   B50-D50	= 100
   B50-C0	= 50

			= 200 / 3 = 66

   A 0 * 1 			= 0*1		= 0
   B 50 + 50		= 100		= 100
   C 0 * 1			= 0*1		= 0
   D 50 + 50   		= 100		= 100

								= 200 / 3 = 66

























GET Actividades
> Dinámicas
>> Encuesta
GET>>> Evaluativa
GET>>>> Preguntas no abiertas
>>>>> Respuestas
>>>>>> Soluciones
GET>>>> Preguntas abierta
>>>>> Soluciones
GET>>> Investigativa
GET>> Reconocimiento
...
GET>> Campaña
...


Reportes leletog
-------------------

ReportActividad (uuid = JJMJKASJKDHASD){ 																1

	ReportDinamicas (id_actividad);

}

ReportDinamicas (id_actividad){																		10

	if dinamica.modelo == 1 && dinamica.tipo == 1 ReportPreguntas(dinamica, evaluativa - respuesta unica y multiple )

	if dinamica.modelo == 1 && dinamica.tipo == 2 ReportPreguntas(dinamica, investigativa)
	if dinamica.modelo == 2 ReportReconocimientos(dinamica)
	if dinamica.modelo == 3 ReportCampañaMejoramiento(dinamica)

}

ReportPreguntas (dinamica, tipo_dinamica) {															100

	if pregunta.abierta;
	if pregunta.cerrada = ReportRespuestas()

}

ReportRespuestas (id_pregunta) {																		10

	ReportSoluciones(id_respuesta)

}

ReportSoluciones (id_respuesta) {																		3216546854351

	[];

}



----------------------

ESTRATEGIA DE REPORTES POR FLUJOS DE DATOS

Report-actividad(act=1);

Report-actividad(act=1; segmento=654586);

Report-actividad(act=1; dinamica=6; pregunta=86);

Report-actividad(act=1; dinamica=15; respuesta=35435486);




Report-actividad (id, segmentacion){

	colaboradores = segmentacion ? GetColoboratorsBySegmentation('2, 6354') : 0;

	construir_reporte_actividad(id_actividad, colaboradores)

}

construir_reporte_actividad (id_actividad, colaboradores){

	Flujo-enc.eval.pre.res::actividad > dinamica > evaluativa > preguntas > respuestas > soluciones(id_trabajador IN [colaboradores])
	Flujo-enc.inve.pre.res::actividad > dinamica > investigativa > preguntas > respuestas > soluciones(id_trabajador IN [colaboradores])
	Flujo-enc.inve.pre.abi::actividad > dinamica > investigativa > preguntas > soluciones(id_trabajador IN [colaboradores])
	Flujo-rec::actividad > dinamica > soluciones(id_trabajador IN [colaboradores])
	Flujo-cam::actividad > dinamica > soluciones(id_trabajador IN [colaboradores])

}



GetColoboratorsBySegmentation (listado_segmentos) {

	condicion = campo IN [dato]

	Colaboradores = SELECT * FROM zoom__users WHERE condicion;

	return "1,2,3,4,5,68,6854";

}










	Reportes leletog
	-------------------

	reporte de participacion ( balance )
		asignaciones de personas
		realizas
		no realizadas

	reporte de solucion ( proceso )


		GetReporteActividad () {

			R = [
				...,
				'dinamicas'
			]

			foreach(dinamicas as dinamica) {

				if (dinamica.modelo == 1 && dinamica.tipo == 1)	['dinamicas'] = GetReporteEncuestaEvaluativa(dinamica)
				if (dinamica.modelo == 1 && dinamica.tipo == 2) GetReporteEncuestaInvestigativa()
				if (dinamica.modelo == 2) GetReporteReconocimientos()
				if (dinamica.modelo == 3) GetReporteCampañaMejoramiento()

			}

			GetReporteEncuestaEvaluativa(dinamica) {

				Return [1] => [
					...
				];

			}

		}


		Lo básico :  id, uuid, nombre, descripcion, inactivo

		ReporteActividad (id = 5215) => [
			'asignadas' => 0, (en su alcance)
			'realizadas' => 0,
			'no_realizadas' => 0,
			'dinamicas' => [
				1 => [
					'nombre'        => 'Evaluación de desempeño',
					'modelo'        => Encuesta',
					'tipo'          => 'Evaluativa',
					'asignadas'     => 0,
					'realizadas'    => 0,
					'no_realizadas' => 0,
					'promedio'      => 0,
					'preguntas'    => [
						1 => [
							'nombre' => 'Cuál no es un plato japonés ¿Sushi o Ramen?',
							'respuestas' => [
								1 => [
									'nombre' => 'Sushi',
									'correcto => 0,
									'soluciones' => [
										1 => [
											'evaluador' => [
												'nombre' => JJ,
												'cargo' => [
													'nombre' => Coordinador,
												],
											],
										],
									],
									'cantidad_soluciones' => 1,
								],
								2 => [
									'nombre' => 'Ramen',
									'correcto => 1,
									'soluciones' => [
										1 => [
											'evaluador' => [
												'nombre' => W,
												'cargo' => [
													'nombre' => TI,
												],
											],
										],
										2 => [
											'evaluador' => [
												'nombre' => D,
												'cargo' => [
													'nombre' => Soporte,
												],
											],
										],
									],
									'cantidad_soluciones' => 2,
								],
							],
							'respuestas_correctas' => 2,
							'respuestas_incorrectas' => 1,
						],
					],
					'total_preguntas'   => 1,
					'total_correctas'   => 2,
					'total_incorrectas' => 1,
					'promedio'          => 66.66,
				],
				2 => [
					'asignadas' => 0,
					'realizadas' => 0,
					'no_realizadas' => 0,
				],
				3 => [
					'asignadas' => 0,
					'realizadas' => 0,
					'no_realizadas' => 0,
				],
			],
		]

		* Encuesta evaluativa ( cuantificativa / resultado porcentual )
			* Consolida la efectividad en la evaluación
				promedio de la evaluacion
				Detalle de la evaluación ( persona )
				Detalle la solución ( Vista de las respuestas )

		* Encuesta investigativa ( recopila información )
			*	Preguntas de respuesta única
					-	Informe estadístico en relación con las respuesta
			*	Preguntas de múltiple respuesta
					-	Informe de preferencia sobre la pregunta
					-	Quienes participaron ( detalle )
			*	Preguntas de respuesta abierta
					-	Listado de respuestas

		*	Dinámica reconocimientos
			*	Reconocimientos más otorgados
			*	Personas más reconocidas
			*	Pesonas que más reconocen

		*	Dinámica campaña de mejoramiento
			*	Cantidad de participaciones
			*	Listado de aportes proporcionados


		*	Filtros por segmentación
		*	Gráfico por segmentos
		*	Comparador gráfico


*/



/*
	- Indexación de la base datos
	- Recortar espacios en Campos varchar

	Validar tamaño de campo
		apps\platform\views\forms\

	Colaboradores
		// 1.	Validar llamado de getcolaboradores
		// 2.	Reordenar columnas y colocar conveciones establecidas ( CC-, Cargo)
		// 3.	Crear/Editar colaborador
		// 	1.	Identificacion no puede existir en la misma empresa
		// 	2.	Email corporativo debe ser único

	Administradores - Crear
		// 1.	No se puede crear repetido
		// 2.	En la lista(select), dentro de paréntesis, colocar el cargo

	Organigramas
		// 1.	No muestra los cargos -  Dependencia
		// 2.	Principal_texto ( Si / No)
		// 3.	Validar organigramas principales


	Actividades
		// 1.	Add Columnas de visibilidad, 0 en construccion 1, publicado
		// 2.	Add columna alcance,  General = toda la empresa, Específico= Grupos y/o Colaboradoes
		// 3.	Periodo Add dos columnas Fecha ini y Fecha fin
		// 4.	Estado ( tiempo ). Antes durante y después
		// 5.	Detalle categoria
		// 6.	Separar periodo. Desde hasta

	Interactividad
		1. Add fecha de cierre	Add Estado:  Abierto o cerrado
		2. Pregunta y respuesta ( texto_)
		3.	Incluye preguntas y respuestas

		-----------------------------------------------------------


*/







// 	Mayo 27 2024
//	Login Compatible con GetColaborador

// 	Indexación de base de datos

/*	Leletog
	Balance de actividades del colaborador
	Reporte de actividad

*/



// =============================================== DATA STRUCTURE: ADMIN COMPANY ================================================== //

// Obtener Administradores (zoom__users__roles) --> Colaboradores con Roles Administrativos asignados



$GetAdministratorRol = [
	'id'          => 0,
	'uuid'        => 0,
	'nombre'      => 0,
	'inactivo'    => 0,
	'colaborador' => [
		'id'              => 0,
		'uuid'            => 0,
		'nombre'          => 0,
		'nombre_completo' => 0,
		'sigla'           => 0,
		'inactivo'        => 0,
		'cargo'           => [
			'id'       => 0,
			'uuid'     => 0,
			'nombre'   => 0,
			'inactivo' => 0,
		],
	],
	'rol' => [
		'id'       => 0,
		'uuid'     => 0,
		'nombre'   => 0,
		'inactivo' => 0,
	],
];



// =============================================== DATA STRUCTURE: ADMIN LELETOG ================================================== //


//------------------
/// Implementado
//------------------
// Obtener Categorias de Actividades (grw_lel_actividades)
$GetCategoriasLeletog = [
	'id'         => 0,
	'uuid'       => 0,
	'id_empresa' => 0,
	'nombre'     => 0,
	'inactivo'   => 0,
];


//------------------
/// Implementado
//------------------
// Obtener Reconocimientos (grw_insignias)
$GetReconocimientos = [
	'id'         => 0,
	'uuid'       => 0,
	'id_empresa' => 0,
	'nombre'     => 0,
	'insignia'   => [
		'texto' => 0,		 // mismo que 'nombre'
		'forma' => 0,
		'color' => 0,
		'icono' => 0,
	],
	'inactivo' => 0,
];



// Obtener Actividades (este ya existe, sería implementar)
$GetActividadesLeletog = [
	1 => [
		'id'         => 0,
		'uuid'       => 0,
		'id_empresa' => 0,
		'nombre'     => 0,
		'inactivo'   => 0,
		'categoria'	 => [
			'id'         => 0,
			'uuid'       => 0,
			'id_empresa' => 0,
			'nombre'     => 0,
			'inactivo'   => 0,
		],
		'estado' => [ 'antes', 'durante', 'después' ], // PARA TODOS LOS PROCESOS
		'proceso'	 => [// PARA TODOS LOS PROCESOS
			'id'         => 3,
			'uuid'       => 0,
			'nombre'     => 'Actividad',
			'inactivo'   => 0,
		],
		'alcance' => [], // PARA TODOS LOS PROCESOS
		'periodo' => [], // PARA TODOS LOS PROCESOS
		'visible' => 0, // PARA TODOS LOS PROCESOS
		'launch' => 0, // PARA TODOS LOS PROCESOS
		'app'		 => [ // PARA TODOS LOS PROCESOS
			'id'         => 0,
			'uuid'       => 0,
			'app'     	 => 0,
			'nombre'     => 0,
			'inactivo'   => 0,
		],
	],
];




//------------------
/// Implementado
//------------------
// Obtener Interactividades (grw_lel_interactividades)
$GetInteractividadesLeletog = [
	'id'         => 0,
	'uuid'       => 0,
	'id_empresa' => 0,
	'nombre'     => 0,
	'inactivo'   => 0,
	'actividad'  => [
		'id'        => 0,
		'uuid'      => 0,
		'nombre'    => 0,
		'inactivo'  => 0,
		'categoria' => [
			'id'       => 0,
			'uuid'     => 0,
			'nombre'   => 0,
			'inactivo' => 0,
		],
	],
	'modelo'     => [ 		// olc_modelos
		'id'       => 0,
		'uuid'     => 0,
		'nombre'   => 0,
		'inactivo' => 0,
	],
	'tipo'       => [ 		// olc_modelos_tipos
		'id'       => 0,
		'uuid'     => 0,
		'nombre'   => 0,
		'inactivo' => 0,
	],
];



// Obtener Preguntas de Encuestas (grw_preguntas); esta función es exclusiva para interactividades con modelo.id = 1, osea, Encuestas
$GetPreguntasLeletog = [
	'id'         => 0,
	'uuid'       => 0,
	'id_empresa' => 0,
	'nombre'     => 0,
	'inactivo'   => 0,
	'modo'       => [ 		// olc_preguntas_tipos
		'id'       => 0,
		'uuid'     => 0,
		'nombre'   => 0,
		'inactivo' => 0,
	],
	'respuestas-texto' => '',      // concatenar separado por coma el nombre de todas las respuestas que contenga
	'respuestas'       => [ 		// grw_respuestas
		0 => [
			'id'          => 0,
			'uuid'        => 0,
			'id_pregunta' => 0,
			'nombre'      => 0,
			'correcta'    => 0,
			'inactivo'    => 0,
		],
	],
	'interactividad' => [
		'id'        => 0,
		'uuid'      => 0,
		'nombre'    => 0,
		'inactivo'  => 0,
		'actividad' => [
			'id'        => 0,
			'uuid'      => 0,
			'nombre'    => 0,
			'inactivo'  => 0,
			'categoria' => [
				'id'       => 0,
				'uuid'     => 0,
				'nombre'   => 0,
				'inactivo' => 0,
			],
		],
		'modelo'     => [ 		// olc_modelos
			'id'       => 0,
			'uuid'     => 0,
			'nombre'   => 0,
			'inactivo' => 0,
		],
		'tipo'       => [ 		// olc_modelos_tipos
			'id'       => 0,
			'uuid'     => 0,
			'nombre'   => 0,
			'inactivo' => 0,
		],
	],
];

// Obtener Respuestas de Encuestas (grw_respuestas); esta función es exclusiva para interactividades con modelo.id = 1, osea, Encuestas
$GetRespuestasLeletog = [
	'id'       => 0,
	'uuid'     => 0,
	'nombre'   => 0,
	'correcta' => 0,
	'inactivo' => 0,
	'pregunta' => [
		'id'         => 0,
		'uuid'       => 0,
		'id_empresa' => 0,
		'nombre'     => 0,
		'inactivo'   => 0,
	],
];



// =============================================== DATA STRUCTURE: ADMIN COMPANY ================================================== //


// Obtener Organigramas (grw_organigramas)
$GetOrganigramas = [
	'id'         => 0,
	'uuid'       => 0,
	'id_empresa' => 0,
	'nombre'     => 0,
	'activo'     => 0,
	'inactivo'   => 0,
];


// Obtener Cargos (grw_cargos)
$GetCargos = [
	'id'          => 0,
	'uuid'        => 0,
	'id_empresa'  => 0,
	'nombre'      => 0,
	'nivel'       => 0,
	'inactivo'    => 0,
	'dependiente' => [ 		// id_cargo, es el cargo que depende de este, padre
		'id'       => 0,
		'uuid'     => 0,
		'nombre'   => 0,
		'inactivo' => 0,
	],
	'organigrama' => [
		'id'       => 0,
		'uuid'     => 0,
		'nombre'   => 0,
		'activo'   => 0,
		'inactivo' => 0,
	],
];

// Obtener Segmentaciones (grw_segmentaciones)
$GetSegmentaciones = [
	'id'              => 0,
	'uuid'            => 0,
	'id_empresa'      => 0,
	'nombre'          => 0,
	'inactivo'        => 0,
	'segmentos-texto' => '',		 // concatenar separado por coma el nombre de todos los segmentos que contenga
	'segmentos'       => [
		0 => [
			'id'       => 0,
			'uuid'     => 0,
			'nombre'   => 0,
			'inactivo' => 0,
		],
	],
];

// Obtener Segmento (grw_segmentos)
$GetSegmento = [
	'id'           => 0,
	'uuid'         => 0,
	'nombre'       => 0,
	'inactivo'     => 0,
	'segmentacion' => [ //id_parametro
		'id'       => 0,
		'uuid'     => 0,
		'nombre'   => 0,
		'inactivo' => 0,
	],
];

// Obtener Grupos Corporativos (grw_grupos)
$GetGruposCorporativos = [
	'id'            => 0,
	'uuid'          => 0,
	'id_empresa'    => 0,
	'nombre'        => 0,
	'descripcion'   => 0,
	'frase'         => 0,
	'imagen'        => 0,
	'inactivo'      => 0,
	'colaboradores' => [
		0 => [
			'id'              => 0,
			'uuid'            => 0,
			'nombre'          => 0,
			'nombre_completo' => 0,
			'sigla'           => 0,
			'inactivo'        => 0,
			'cargo'           => [
				'id'       => 0,
				'uuid'     => 0,
				'nombre'   => 0,
				'inactivo' => 0,
			],
		],
	],
];



// Obtener Trabajadores (olc__empresas__trabajadores)
$GetColaborators = [
	'id'                      => 0,
	'uuid'                    => 0,
	'id_empresa'              => 0,
	'sigla'                   => 0,
	'nombre_completo'         => 0,
	'nombre_corto'            => 0,
	'nombres'                 => 0,
	'apellidos'               => 0,
	'identificacion'          => 0,
	'identificacion_tipo'     => 0,
	'identificacion_completa' => 0,
	'datos-contacto'          => [
		'telefono' => 0,
		'celular'  => 0,
		'correo'   => 0,
	],
	'complementarios' => [
		'dia_cumple',
		'mes_cumple',
		'anio_cumple',
		'trato',
		'fecha_cumpleanios'
	],
	'inactivo' => 0,
	'jefe'     => [
		'id'              => 0,
		'uuid'            => 0,
		'nombre_completo' => 0,
		'inactivo'        => 0,
		'cargo'           => [
			'id'       => 0,
			'uuid'     => 0,
			'nombre'   => 0,
			'inactivo' => 0,
		],
	],
	'cargo' => [
		'id'       => 0,
		'uuid'     => 0,
		'nombre'   => 0,
		'inactivo' => 0,
	],

];






/*

::: Reunión miércoles 7pm
- Ajuste de tabla zoom_users
    ADD COLUMN
		dia_cumple,
		mes_cumple,
		anio_cumple,
		trato,

	REMOVE COLUMN
		clave,
		nombre, (ojo: realmente es eliminar nombres y cambiar nombre por nombres)
		cargo,
		kr,
		boss,
		envioMail,

	// Datos de salida
		sigla, // JM
		nombre_completo, // Juan Anuel Montoya Pérez
		nombre_corto, Juan M.



		identificacion_completa, // CC. 1144100000



mización de la DB (borrado e indexado)
- Crear y actualizar categorías ACT y segmentación por cada empresa (actualizar regs que lo usen)
- Activación del cronjob #1, Panel de control

*/