<?php

    // ======================  Función SMART de ordenamiento  ====================== //

    function DataStructure ( $RunThisFunction, $ResponseData, $ReturnRecord = false ) {

        if ( !$ResponseData  ) return 0;

        $Response = [];

        if(!$ReturnRecord){
            foreach ( $ResponseData as $key => $Record) {
                $Response[$key] = $RunThisFunction( $Record );
            }
        }else{
            $Response = $RunThisFunction( $ResponseData );
        }

        return $Response;
    }

    // ======================  Funciones de Exclusiva Estructura de datos  ====================== //

    function AdministratorStructure($Administrator){

        if(!$Administrator) return 0;

         return [
            'id'       => $Administrator['user_roles_id'],
            'uuid'     => $Administrator['user_roles_uuid'],
            'inactivo' => $Administrator['user_roles_inactivo'],
            'fecha'    => DateFront($Administrator['user_roles_fecha']),
            'rol'      => [
                'id'     => $Administrator['rol_id'],
                'uuid'   => $Administrator['rol_uuid'],
                'nombre' => $Administrator['rol_nom'],
            ],
            'colaborador' => [
                'id'     => $Administrator['id'],
                'uuid'   => $Administrator['uuid'],
                'nombre' => $Administrator['nombre'],
                'cargo'  => $Administrator['cargo'],
            ]
        ];

    }


    // ======================  Funciones avanzadas de ordenamiento  ====================== //

    function ReportInvestigacion ( $record ) {

        if ( !$record )  return 0;

        $data = [
            'id'           => $record["investigacion_id"],
            'uuid'         => $record["investigacion_uuid"],
            'nombre'       => $record["investigacion_nombre"],
            'descripcion'  => $record["investigacion_descripcion"],
            'fecha_inicio' => $record["investigacion_fecha_inicio"],
            'fecha_fin'    => $record["investigacion_fecha_fin"],
            'id_lista'     => $record["investigacion_lista_id"],
            'id_publico'   => $record["investigacion_id_publico"],
            'publico'      => $record["investigacion_publico"],
            'valoracion'   => [
                'id'          => $record["valoracion_id"],
                'uuid'        => $record["valoracion_uuid"],
                'nombre'      => $record["valoracion_nombre"],
                'descripcion' => $record["valoracion_descripcion"],
            ],
            'evento' => [
                'id'          => $record["evento_id"],
                'uuid'        => $record["evento_uuid"],
                'nombre'      => $record["evento_nombre"],
                'descripcion' => $record["evento_descripcion"],
                'arquetipo'   => [
                    'nombre' => $record["arquetipo_nombre"],
                    'color'  => $record["arquetipo_color"],
                ],
            ],
            'encuesta' => [
                'id'          => $record["encuesta_id"],
                'uuid'        => $record["encuesta_uuid"],
                'nombre'      => $record["encuesta_nombre"],
                'descripcion' => $record["encuesta_descripcion"],
                'id_tipo'     => $record["encuesta_id_tipo"],
                'tipo'        => $record["encuesta_tipo"],
            ],
        ];

        if($record["investigacion_id_publico"] != 1){ // 1 = Anónimo, 2 = Lista Externa, 3 = Lista Interna; exclusivo para el caso de lista interna y externa
            $data['lista']["id"]     = $record["investigacion_lista_id"];
            $data['lista']["nombre"] = $record["lista_nombre"];
        }

        return $data;

    }

    function SolucionesAnonimas ( $records ) {

        if ( !$records )  return 0;

        $data = [];

        foreach ($records as $key => $record) {

            if(!isset($data[$record["id_anonimo"]])){
                $data[$record["id_anonimo"]] = [
                    'id'  => $record["id_anonimo"],
                    'preguntas' => [
                        $record["id_pregunta"] => [
                            'id'        => $record["id_pregunta"],
                            'respuesta' => $record["respuesta"] != "" ? $record["respuesta"] : ( $record["id_respuesta"] != "" ? $record["id_respuesta"] : $record["id_respuesta_multiple"] ),
                        ],
                    ],
                ];
            }else{

                $data[$record["id_anonimo"]]["preguntas"][$record["id_pregunta"]]["id"]        = $record["id_pregunta"];
                $data[$record["id_anonimo"]]["preguntas"][$record["id_pregunta"]]["respuesta"] = $record["respuesta"] != "" ? $record["respuesta"] : ( $record["id_respuesta"] != "" ? $record["id_respuesta"] : $record["id_respuesta_multiple"] );

            }
        }



        return $data;

    }



    function CategoriasLeletog ( $Categoria ) {
        if ( !$Categoria )  return 0;
        return  [
            'id'         => $Categoria['id'],
            'uuid'       => $Categoria['uuid'],
            'id_empresa' => $Categoria['id_empresa'],
            'nombre'     => $Categoria['nombre'],
            'inactivo'   => $Categoria['inactivo'],
            'fecha'     => DateFront( $Categoria['fecha']),
        ];
    }

    function ReconocimientosLeletog ( $Record) {
        if ( !$Record)  return 0;
        return  [
            'id'         => $Record['id'],
            'uuid'       => $Record['uuid'],
            'id_empresa' => $Record['id_empresa'],
            'nombre'     => $Record['nombre'],
            'fecha'     => DateFront( $Record['fecha']),
            'insignia'   => [
                'texto' => $Record['nombre'],		 // mismo que 'nombre'
                'forma' => $Record['forma'],
                'color' => $Record['color'],
                'icono' => $Record['icono'],
            ],
            'inactivo'   => $Record['inactivo'],
        ];
    }

    function InterActividadesLeletog ( $Record) {
        if ( !$Record)  return 0;
        return  [
            'id'         => $Record['id'],
            'uuid'       => $Record['uuid'],
            'id_empresa' => $Record['id_empresa'],
            'nombre'     => $Record['nombre'],
            'inactivo'   => $Record['inactivo'],
            'prioridad'   => $Record['prioridad'],

            'actividad'  => [
                'id'        => $Record['id'],
                'uuid'      => $Record['uuid'],
                'nombre'    => $Record['activ_nombre'],
                'inactivo'  => $Record['activ_inactivo'],
            ],
            'categoria' => [
                'id'       => $Record['categ_id'],
                'uuid'     => $Record['categ_uuid'],
                'nombre'   => $Record['categ_nombre'],
                'inactivo' => $Record['categ_inactivo'],
            ],
            'modelo'   => [
                'id'       => $Record['modelo_id'],
                'uuid'     => $Record['modelo_uuid'],
                'nombre'   => $Record['modelo_nombre'],
                'inactivo' => $Record['modelo_inactivo'],
            ],
            'tipo'     => [
                'id'       => $Record['tipo_id'],
                'uuid'     => $Record['tipo_uuid'],
                'nombre'   => $Record['tipo_nombre'],
                'inactivo' => $Record['tipo_inactivo'],
            ],

        ];
    }

    function OrganigramasLeletog ( $Record ) {
        if ( !$Record)  return 0;
        return [
            'id'         => $Record['id'],
            'uuid'       => $Record['uuid'],
            'id_empresa' => $Record['id_empresa'],
            'nombre'     => $Record['nombre'],
            'activo'     => $Record['activo'],
            'inactivo'   => $Record['inactivo'],
            'fecha'   => DateFront( $Record['inactivo']),
            'principal'   => $Record['activo'] ==1 ? 'Si' : 'No',

        ];
    }

    function DataStructureSegmentacionesLeletog( $ResponseData ) {

        if (!$ResponseData) return 0;

        $SegmentosUnicos = [];
        foreach ( $ResponseData as $Record) {
            $id = $Record['id'];
            if ( !isset ( $SegmentosUnicos[$id])) {
                $SegmentosUnicos[$id ] = [
                    'id'         => $Record['id'],
                    'uuid'       => $Record['uuid'],
                    'id_empresa' => $Record['id_empresa'],
                    'nombre'     => $Record['nombre'],
                    'inactivo'   => $Record['inactivo'],
                    'fecha'      => DateFront($Record['inactivo']),
                ];
            }
            $Segmentos = [
                'id'       => $Record['opc_id'],
                'uuid'     => $Record['opc_uuid'],
                'nombre'   => $Record['opc_alias'],
                'inactivo' => $Record['opc_inactivo'],
            ];
            $SegmentosUnicos[$id]['segmentos'][] = $Segmentos;

            foreach ($SegmentosUnicos as &$Row) {
                $segmentosTexto = [];
                foreach ($Row['segmentos'] as $segmento) {
                    $segmentosTexto[] = $segmento['nombre'];
                }
                $Row['segmentos_texto'] = implode(', ', $segmentosTexto);
            }

        }
        return array_values($SegmentosUnicos);
    }

    function DataStructurePreguntasLeletog ( $ResponseData ){
        if (!$ResponseData) return 0;
        $RegistrosUnicos = [];
        foreach ( $ResponseData as $Record) {
            $id = $Record['id'];
            if ( !isset ( $RegistrosUnicos[$id])) {
                $RegistrosUnicos[$id ] = [
                    'id'              => $Record['id'],
                    'uuid'            => $Record['uuid'],
                    'id_empresa'      => $Record['id_empresa'],
                    'nombre'          => $Record['nombre'],
                    'inactivo'        => $Record['inactivo'],
                    'prioridad'        => $Record['prioridad'],
                    'modo'       => [
                        'id'       => $Record['modo_id'],
                        'uuid'     => $Record['modo_uuid'],
                        'nombre'   => $Record['modo_nombre'],
                        'inactivo' => $Record['modo_inactivo'],
                    ],
                ];
            };
            $RegistrosUnicos[$id]['respuestas-texto']='';
            $RegistrosUnicos[$id]['respuestas'][] = [
                'id'          => $Record['rspta_id'],
                'uuid'        => $Record['rspta_uuid'],
                'id_pregunta' => $Record['rspta_id_pregunta'],
                'nombre'      => $Record['rspta_nombre'],
                'correcta'    => $Record['rspta_correcta'],
                'inactivo'    => $Record['rspta_inactivo'],
            ];
            $RegistrosUnicos[$id]['interactividad'] = [
                'id'        => $Record['interactiv_id'],
                'uuid'      => $Record['interactiv_uuid'],
                'nombre'    => $Record['interactiv_nombre'],
                'inactivo'  => $Record['interactiv_inactivo'],
                'actividad' => [
                    'id'        => $Record['activ_id'],
                    'uuid'      => $Record['activ_uuid'],
                    'nombre'    => $Record['activ_nombre'],
                    'inactivo'  => $Record['activ_inactivo'],
                    'categoria' => [
                        'id'        => $Record['categ_id'],
                        'uuid'      => $Record['categ_uuid'],
                        'nombre'    => $Record['categ_nombre'],
                        'inactivo'  => $Record['categ_inactivo'],
                    ],
                ],
            ];
            $RegistrosUnicos[$id]['modelo']=[
                'id'        => $Record['modelo_id'],
                'uuid'      => $Record['modelo_uuid'],
                'nombre'    => $Record['modelo_nombre'],
                'inactivo'  => $Record['modelo_inactivo'],
            ];
            $RegistrosUnicos[$id]['tipo']=[
                'id'        => $Record['tipo_id'],
                'uuid'      => $Record['tipo_uuid'],
                'nombre'    => $Record['tipo_nombre'],
                'inactivo'  => $Record['tipo_inactivo'],
            ];
            foreach ($RegistrosUnicos as &$Row) {
                $RespuestasTexto = [];
                foreach ($Row['respuestas'] as $respuesta) {
                    $RespuestasTexto[] = $respuesta['nombre'];
                }
                $Row['respuestas-texto'] = implode(', ', $RespuestasTexto);
            }

        }

        return array_values($RegistrosUnicos);
    }

    function CargosLeletog ( $Record) {
        if ( !$Record ) return 0;

        if ( $Record['dependiente_id'] == '0'){
            $Dependiente = 0;
        }else {
          $Dependiente = [ 		// id_cargo, es el cargo que depende de este, padre
            'id'       => $Record['dependiente_id'],
            'uuid'     => $Record['dependiente_uuid'],
            'nombre'   => $Record['dependiente_nombre'],
            'inactivo' => $Record['dependiente_inactivo'],
          ];
        }

        return [
            'id'          => $Record['id'],
            'uuid'        => $Record['uuid'],
            'id_empresa'  => $Record['id_empresa'],
            'nombre'      => $Record['nombre'],
            'nivel'       => $Record['nivel'],
            'inactivo'    => $Record['inactivo'],
            'dependiente' => $Dependiente,
            'organigrama' => [
                'id'       => $Record['orgngrma_id'],
                'uuid'     => $Record['orgngrma_uuid'],
                'nombre'   => $Record['orgngrma_nombre'],
                'activo'   => $Record['orgngrma_inactivo'],
                'inactivo' => $Record['orgngrma_inactivo'],
            ],
        ];
    }

    function SegmentoLeletog ( $Record) {
        if ( !$Record) return 0;
        return [
            'id'           => $Record['id'],
            'uuid'         => $Record['uuid'],
            'nombre'       => $Record['nombre'],
            'inactivo'     => $Record['inactivo'],
            'segmentacion' => [
                'id'       => $Record['param_id'],
                'uuid'     => $Record['param_uuid'],
                'nombre'   => $Record['param_nombre'],
                'inactivo' => $Record['param_inactivo'],
            ],
        ];
    }

    function RespuestasLeletog ( $Record) {
        if ( !$Record) return 0;
        return [
            'id'            => $Record['id'],
            'uuid'          => $Record['uuid'],
            'nombre'        => $Record['nombre'],
            'inactivo'      => $Record['inactivo'],
            'id_empresa'    => $Record['id_empresa'],
            'correcta'      => $Record['correcta'],
            'text_correcta' => $Record['correcta'] == 1 ? 'Verdadero' : 'Falso',
            'valor'         => $Record['valor'],
            'prioridad'     => $Record['prioridad'],
            'pregunta'      => [
                'id'         => $Record['pregun_id'],
                'uuid'       => $Record['pregun_uuid'],
                'id_empresa' => $Record['pregun_id_empresa'],
                'nombre'     => $Record['pregun_nombre'],
                'inactivo'   => $Record['pregun_inactivo'],
            ],
        ];
    }

    function Actividades ( $Record) {
        $StdoDone = 0;
        if ( !$Record) return 0;

        $StdoTime   = StateTime( $Record['fecha_hasta'] );
        $StdoText   = StateTag ( $StdoDone, $StdoTime );

        return [
            'id'           => $Record['id'],
            'uuid'         => $Record['uuid'],
            'id_empresa'   => $Record['id_empresa'],
            'nombre'       => $Record['nombre'],
            'inactivo'     => $Record['inactivo'],
            'visiblilidad' => $Record['visible'] == 1 ? 'Publicado' : 'En construcción',   // PARA TODOS LOS PROCESOS
            'launch'       => $Record['launch'],
            'descripcion'  => $Record['descripcion'],
            'fecha'     => DateFront( $Record['fecha']),
            'asignacion' => [
                'value' => $Record['asignaciones_actividad'],
                'nombre' => $Record['asignaciones_actividad_nombre']
            ],
            'permisos_reporte' =>  [
                'value' => $Record['permisos_reporte'],
                'nombre' => $Record['permisos_reporte_nombre']
            ],

            'categoria'    => [
                'id'         => $Record['categ_id'],
                'uuid'       => $Record['categ_uuid'],
                'id_empresa' => $Record['categ_id_empresa'],
                'nombre'     => $Record['categ_nombre'],
                'inactivo'   => $Record['categ_inactivo'],
            ],
            'estado' => [
                'done' => $StdoDone ,
                'time' => $StdoTime,
                'tag' => GetEstado( $StdoText) ,
            ],
            'proceso'	 => [                               // PARA TODOS LOS PROCESOS
                'id'         => $Record['actprocess_id'],
                'uuid'       => $Record['actprocess_uuid'],
                'nombre'     => $Record['actprocess_nombre'],
                'inactivo'   => $Record['actprocess_inactivo'],
            ],

            'periodo' => [                                  // PARA TODOS LOS PROCESOS
                'desde' => $Record['fecha_desde'],
                'hasta' => $Record['fecha_hasta'],
                'desde_front' => DateFront( $Record['fecha_desde']),
                'hasta_front' => DateFront( $Record['fecha_hasta']) ,

            ],
                 // PARA TODOS LOS PROCESOS
            'app'		 => [                               // PARA TODOS LOS PROCESOS
                'id'         => $Record['app_id'],
                'uuid'       => $Record['app_uuid'],
                'app'     	 => $Record['app_app'],
                'nombre'     => $Record['app_nombre'],
                'inactivo'   => $Record['app_inactivo'],
            ],
        ];

    }

    function GruposCorporativos ( $Record) {

        if ( !$Record ) return 0;

        return  [
            'id'            => $Record['id'],
            'uuid'          => $Record['uuid'],
            'id_empresa'    => $Record['id_empresa'],
            'nombre'        => $Record['nom_grupo'],
            'descripcion'   => $Record['descrp_grupo'],
            'frase'         => $Record['slogan_grupo'],
            'imagen'        => $Record['imagen'],
            'inactivo'      => $Record['inactivo'],
            'colaboradores' => $Record['total_integrantes'],
            'fecha'         => DateFront($Record['fecha'], 1)
        ];

    }

    function  GruposCorporativosIntegrantes( $Record) {

        if ( !$Record ) return 0;

        $lider = $Record['lider'] == 2 ? "Supervisor" : ($Record['lider'] == 1 ? "Líder" : "Miembro");

        return  [
            'id'       => $Record['id'],
            'uuid'     => $Record['uuid'],
            'nombre'   => trim($Record['user_nombre']),
            'lider'    => $lider,
            'sigla'    => '',
            'inactivo' => $Record['inactivo'],
            'fecha'    => DateFront($Record['fecha']),
            'cargo'    => [
                'id'       => $Record['cargos_id'],
                'uuid'     => $Record['cargos_uuid'],
                'nombre'   => $Record['cargos_nombre'],
                'inactivo' => $Record['cargos_inactivo'],
            ]
        ];

    }

    function Colaborators ( $Registro ) {
        if (!$Registro) return 0;
        $Nombre        = cTrim($Registro['nombres']);
        $primer_nombre = explode(' ', $Nombre);
        $Apellido      = cTrim($Registro['apellidos']);
        $Cumpleanios   = FechaCumple ($Registro['mes_cumple'], $Registro['dia_cumple'] );
        $Corto         = $Apellido ? $primer_nombre[0].' '.PrimeraLetra($Apellido).'.' : $primer_nombre[0].'.';

        return [
            'id'                      => $Registro['id'],
            'uuid'                    => $Registro['uuid'],
            'id_empresa'              => $Registro['id_empresa'],
            'sigla'                   => PrimeraLetra($Nombre).PrimeraLetra($Apellido),
            'nombre_completo'         => $Registro['nombre'],
            'nombre_corto'            => $Corto,
            'nombre'                  => $Registro['nombre'],
            'nombres'                 => $Registro['nombres'],
            'apellidos'               => $Registro['apellidos'],
            'identificacion'          => $Registro['identificacion'],
            'identificacion_tipo'     => $Registro['identificacion_tipo'],
            'identificacion_completa' => $Registro['identificacion_tipo'] . '. ' .  $Registro['identificacion'],
            'id_rol'                  => $Registro['id_rol'],
            'inactivo'                => $Registro['inactivo'],
            'fecha'                   => DateFront($Registro['fecha']),
            'datos_contacto'          => [
                'telefono' => $Registro['telefono'],
                'celular'  => $Registro['celular'],
                'correo'   => $Registro['email'],
            ],
            'complementarios' => [
                'dia_cumple'        => $Registro['dia_cumple'],
                'mes_cumple'        => $Registro['mes_cumple'],
                'anio_cumple'       => $Registro['anio_cumple'],
                'trato'             => $Registro['trato'],
                'fecha_cumpleanios' => $Cumpleanios != '--' ? $Cumpleanios: 'No registrada',
            ],
            'jefe'     => [
                'id'              => $Registro['jefe_id'],
                'uuid'            => $Registro['jefe_uuid'],
                'nombre_completo' => $Registro['jefe_nombre'] .' ' . $Registro['jefe_apellidos']  ,
                'inactivo'        => $Registro['jefe_inactivo'],
                'cargo'           => [
                    'id'       => $Registro['jefe_cargo_id'],
                    'uuid'     => $Registro['jefe_cargo_uuid'],
                    'nombre'   => $Registro['jefe_cargo_nombre'],
                    'inactivo' => $Registro['jefe_cargo_inactivo'],
                ],
            ],
            'cargo' => [
                'id'       => $Registro['cargo_id'],
                'uuid'     => $Registro['cargo_uuid'],
                'nombre'   => $Registro['cargo_nombre'],
                'inactivo' => $Registro['cargo_inactivo'],
            ],

        ];
    }

    function P2bOrdered ( $P2Bs ) {
        $P2bResponse =[]; $Asignadas = 0 ;  $Pendiente = 0;  $Finalizadas = 0;

        if ( !$P2Bs ) return 0;

        $Asignadas   = count( $P2Bs  );

        $Finalizadas = CountArray  ( $P2Bs  , 'realizado', '1');

        foreach ( $P2Bs as $p2b ) {
            $P2bResponse['p2b'][] =  P2bRowBuild ( $p2b );
        }

        $P2bResponse['resumen'] =  [ 'asignadas'  => $Asignadas  ,
                                    'pendientes' => ($Asignadas) - ( $Finalizadas),
                                    'realizadas' => ( $Finalizadas ) ];
        return  $P2bResponse;
    }

    function P2bRowBuild ( $P2p ) {
        $ValueTag = $P2p ['realizado'] == 1 ? 'finalizado' : 'pendiente';
        $RowResponse = [
            'id'          => $P2p ['id_evaluacion'],
            'uuid'        => $P2p ['uuid_evaluacion'],
            'id_empresa'  => $P2p ['id_empresa'],
            'nombre'      => $P2p ['nomevaluacion'],
            'alcance' => [
                'id'     => $P2p ['permisos_reporte'],
                'nombre' => $P2p ['nom_alcance'],
            ],
            'periodo' => [
                'desde' => $P2p ['fecha_desde'],
                'hasta' => $P2p ['fecha_hasta'],
            ],
            'proceso' => [
                'id'     => $P2p ['id_evaluacion'],
                'uuid'   => $P2p ['uuid_evaluacion'],
                'nombre' => $P2p ['nomevaluacion'],
            ],
            'app' => [
                'id'     => $P2p ['id_app'],
                'uuid'   => $P2p ['uuid_app'],
                'nombre' => $P2p ['name_app'],
                'app'    => $P2p ['app'],
            ],
            'estado' => [
                'done' => $P2p ['realizado'] == 1 ? 1 : 0,
                'time' => StateTime ($P2p ['fecha_hasta'] ),
                'tag'  => GetEstado ($ValueTag  )
            ],
        ];
        return $RowResponse ;
    }

    function P2pOrdered ( $P2Ps ) {
        $P2pResponse =[]; $Asignadas = 0 ;  $Pendiente = 0;  $Finalizadas = 0;

        if ( !$P2Ps ) return 0;

        $Asignadas   = count( $P2Ps  );

        $Finalizadas = CountArray  ( $P2Ps  , 'realizado', '1');

        foreach ( $P2Ps as $p2p ) {
            $P2pResponse['p2p'][] =  P2pRowBuild ( $p2p );
        }

        $P2pResponse['resumen'] =  [ 'asignadas'  => $Asignadas  ,
                                     'pendientes' => ($Asignadas) - ( $Finalizadas),
                                     'realizadas' => ( $Finalizadas ) ];
        return  $P2pResponse;
    }

    function P2pRowBuild ( $P2p ) {
    $ValueTag = $P2p ['realizado'] == 1 ? 'finalizado' : 'pendiente';
    $RowResponse = [
        'id'          => $P2p ['id_evaluacion'],
        'uuid'        => $P2p ['uuid_evaluacion'],
        'id_empresa'  => $P2p ['id_empresa'],
        'nombre'      => $P2p ['nomevaluacion'],
        'alcance' => [
            'id'     => $P2p ['permisos_reporte'],
            'nombre' => $P2p ['nom_alcance'],
        ],
        'periodo' => [
            'desde' => $P2p ['fecha_desde'],
            'hasta' => $P2p ['fecha_hasta'],
        ],
        'proceso' => [
            'id'     => $P2p ['id_evaluacion'],
            'uuid'   => $P2p ['uuid_evaluacion'],
            'nombre' => $P2p ['nomevaluacion'],
        ],
        'evaluado' => [
            'id'     => $P2p ['id_evaluado'],
            'uuid'   => $P2p ['uuid_evaluado'],
            'nombre' => $P2p ['nom_evaluado'],
        ],
        'app' => [
            'id'     => $P2p ['id_app'],
            'uuid'   => $P2p ['uuid_app'],
            'nombre' => $P2p ['name_app'],
            'app'    => $P2p ['app'],
        ],
        'estado' => [
            'done' => $P2p ['realizado'] == 1 ? 1 : 0,
            'time' => StateTime ($P2p ['fecha_hasta'] ),
            'tag'  => GetEstado ($ValueTag  )
        ],
    ];
    return $RowResponse ;
    }

    function ActOrdered ( $Actividades ) {
        $ActivityResponse =[]; $Asignadas = 0 ;  $Pendiente = 0;  $Finalizado = 0;

        if ( !$Actividades ) return 0;

        $Asignadas = COUNT( $Actividades );
        foreach ( $Actividades as $key => $Actividad ) {

            $ActivityResponse['act'][] =  ActRowBuild ( $Actividad);
            $TextoEstado = $ActivityResponse['act'][$key]['estado']['tag']['text'];
            if ( $TextoEstado === 'Pendiente' ) $Pendiente++;
            if ( $TextoEstado === 'Finalizado') $Finalizado++;

        }
        $ActivityResponse['act_resumen'] = [ 'asignadas'  => $Asignadas,
                                             'pendientes' => $Pendiente,
                                             'realizadas' => $Finalizado ];
        return $ActivityResponse;
    }

    function ActRowBuild ( $Actividad ) {
        $Encuestas       = $Actividad['encuestas_ok']       === $Actividad['encuestas'];
        $Reconocimientos = $Actividad['reconocimientos_ok'] === $Actividad['reconocimientos'];
        $Campanas        = $Actividad['campanas_ok']        === $Actividad['campanas'];

        $Estado          = ( $Encuestas  &&  $Reconocimientos && $Campanas )
            ? GetEstado('finalizado')
            : GetEstado('pendiente');

        $ActResponse = [
            'id'          => $Actividad['idactividad'],
            'uuid'        => $Actividad['uuid_actividad'],
            'id_empresa'  => $Actividad['id_empresa'],
            'nombre'      => $Actividad['nomactividad'],
            'categoria' => [
                'id'     => $Actividad['id_categ'],
                'nombre' => $Actividad['nombre_categ'],
            ],
            'alcance' => [
                'id'     => $Actividad['permisos_reporte'],
                'nombre' => $Actividad['nom_alcance'],
            ],
            'periodo' => [
                'desde' => $Actividad['fecha_desde'],
                'hasta' => $Actividad['fecha_hasta'],
            ],
            'proceso' => [
                'id'     => $Actividad['idactividad'],
                'uuid'   => $Actividad['uuid_actividad'],
                'nombre' => $Actividad['nomactividad'],
            ],
            'app' => [
                'id'     => $Actividad['id_app'],
                'uuid'   => $Actividad['uuid_app'],
                'nombre' => $Actividad['name_app'],
                'app'    => $Actividad['app'],
            ],
            'estado' => [
                'done' => $Estado['text'] == 'Pendiente' ? 0 : 1,
                'time' => StateTime ( $Actividad['fecha_hasta'] ),
                'tag' => $Estado
            ],
        ];
        return $ActResponse ;
    }

    function PytsOrdered (  $PYTS, $FechaIni, $FechaFin  ) {
        $Asignadas = 0;
        $Pendiente = 0;
        $Finalizado = 0;
        $PytResponse = [];

        if (!$PYTS ) return 0;
            $Asignadas = COUNT( $PYTS );
            foreach ($PYTS as $Pyt ) {
                $PytResponse['pyts'][] =  PytRowBuild ( $Pyt, $FechaIni, $FechaFin );

                if ( strtotime( $Pyt['fecha_hasta'] ) >= strtotime( FechaHoy() )  ) {
                    $Pendiente++;
                }else {
                    $Finalizado++;
                };
        }
        $PytResponse['pyts_resumen'] = [ 'asignadas'  => $Asignadas,
                                        'pendientes' => $Pendiente,
                                        'realizadas' => $Finalizado ];
        return $PytResponse;
    }

    function ValsOrdered ($data, $FechaIni, $FechaFin) {

        if (!$data) return 0;

        $Pendiente = 0;
        $Finalizado = 0;
        $Response = [];
        $Asignadas = COUNT( $data );

        foreach($data as $proceso) {

            if ( $proceso["completado"] ){

                $Finalizado++;
                $Response["finalizados"][] = $proceso;

            }else{

                $Pendiente++;
                $Response["encurso"][] = $proceso;
            }


        }

        $Response['asignadas'] = $Asignadas;
        $Response['pendientes'] = $Pendiente;
        $Response['realizadas'] = $Finalizado;
        $Response['historial'] = $Finalizado;

        return $Response;
    }

    function PytRowBuild ( $PtyRow ,  $FechaIni, $FechaFin ){
        $PytResponse = []; $StdoTime = 0;  $StdoDone = 0; $StdoText ='';
        $Hoy         = strtotime( FechaHoy() );


        $StdoDone = 0;
        $StdoTime = StateTime( $PtyRow['fecha_hasta']);
        $StdoText = StateTag ( $StdoDone, $StdoTime );


        $PytResponse = [
            'id'          => $PtyRow['idproyecto'],
            'uuid'        => $PtyRow['uuid_proyecto'],
            'id_empresa'  => $PtyRow['id_empresa'],
            'id_responsable'  => $PtyRow['id_responsable'],
            'id_semana_desde'  => $PtyRow['id_semana_desde'],
            'id_semana_hasta'  => $PtyRow['id_semana_hasta'],
            'nombre'      => $PtyRow['nombre'],
            'descripcion' => $PtyRow['descripcion'],
            'responsable' => [
                'id'     => $PtyRow['id_responsable'],
                'uuid'   => $PtyRow['uuid_responsable'],
                'nombre' => $PtyRow['nom_responsable'],
            ],
            'alcance' => [
                'id'     => $PtyRow['permisos_reporte'],
                'nombre' => $PtyRow['nom_alcance'],
            ],
            'periodo' => [
                'desde' => $PtyRow['fecha_desde'],
                'hasta' => $PtyRow['fecha_hasta'],
            ],
            'proceso' => [
                'id'     => $PtyRow['idproyecto'],
                'uuid'   => $PtyRow['uuid_proyecto'],
                'nombre' => $PtyRow['nombre'],
            ],
            'app' => [
                'id'     => $PtyRow['id_app'],
                'uuid'   => $PtyRow['uuid_app'],
                'nombre' => $PtyRow['name_app'],
                'app'    => $PtyRow['app'],
            ],
            'estado' => [
                'done' => $StdoDone ,
                'time' => $StdoTime,
                'tag' => GetEstado( $StdoText) ,
            ],

        ];
        return $PytResponse;
    }

    function StateTag ($StdoDone, $StdoTime ) {
        // 0:0 => Próximo, 0:1 => En Curso, 0:2 => Vencido; 1:0 => Próximo, 1:1 => Realizado, 1:2 => Finalizado
        if ( $StdoDone == 0 && $StdoTime == 0 ) return 'Próximo';
        if ( $StdoDone == 0 && $StdoTime == 1 ) return 'En curso';
        if ( $StdoDone == 0 && $StdoTime == 2 ) return 'Vencido';
        if ( $StdoDone == 1 && $StdoTime == 0 ) return 'Próximo';
        if ( $StdoDone == 1 && $StdoTime == 1 ) return 'Realizado';
        if ( $StdoDone == 1 && $StdoTime == 2 ) return 'Finalizado';
    }

    function OrderMyDashBoardTuCoach( $Estudios ) {

        $NewStudios = [
            'encurso'         => [],
            'finalizados'     => [],
            'participaciones' => [
                'p2p' => 0,
                'p2b' => 0
            ],
            'historial' => 0
        ];

        if ( !$Estudios ) return $NewStudios;

        foreach ( $Estudios as $Estudio ) {

            $IdEstudio                                                       = $Estudio['estudio_id'];
            $IdTipo                                                          = $Estudio['alcance_id_proceso_tipo'];
            $IsRealizado                                                     = $Estudio['asign_realizado'];
            $StdoTime                                                        = StateTime($Estudio['alcance_fecha_hasta']);        // 0 (Antes), 1 (Durante), 2 (Después)
            $Estado                                                          = ! $IsRealizado && $StdoTime < 2 ? 'encurso' : 'finalizados';
            $NewStudios[$Estado][$IdEstudio]['id']                           = $Estudio['estudio_id'];
            $NewStudios[$Estado][$IdEstudio]['nombre']                       = $Estudio['estudio_nombre'];
            $NewStudios[$Estado][$IdEstudio]['uuid']                         = $Estudio['estudio_uuid'];
            $NewStudios[$Estado][$IdEstudio]['fecha']                        = $Estudio['estudio_fecha'];
            $NewStudios[$Estado][$IdEstudio]['duracion']                     = $Estudio['estudio_duracion'];
            $NewStudios[$Estado][$IdEstudio]['text_estado']                  = $Estado;
            $NewStudios[$Estado][$IdEstudio]['asignacion']['id']             = $Estudio['asign_id'];
            $NewStudios[$Estado][$IdEstudio]['asignacion']['id_tipo']        = $IdTipo ;
            $NewStudios[$Estado][$IdEstudio]['asignacion']['tipo']           = $IdTipo == 1 ? 'P2P' : 'P2B';
            $NewStudios[$Estado][$IdEstudio]['asignacion']['fecha']          = $Estudio['asign_fecha'];
            $NewStudios[$Estado][$IdEstudio]['asignacion']['realizado']      = $Estudio['asign_realizado'];
            $NewStudios[$Estado][$IdEstudio]['evaluador']['id']              = $Estudio['evaluador_id'];
            $NewStudios[$Estado][$IdEstudio]['evaluador']['nombre']          = $Estudio['evaluador_nombres'];
            $NewStudios[$Estado][$IdEstudio]['evaluador']['apellidos']       = $Estudio['evaluador_apellidos'];
            $NewStudios[$Estado][$IdEstudio]['evaluador']['nom_completo']    = cTrim($Estudio['evaluador_nombres']) . ' ' . cTrim($Estudio['evaluador_apellidos']);
            $NewStudios[$Estado][$IdEstudio]['evaluado']['id']               = $Estudio['evaluado_id'];
            $NewStudios[$Estado][$IdEstudio]['evaluado']['nombre']           = $Estudio['evaluado_nombres'];
            $NewStudios[$Estado][$IdEstudio]['evaluado']['apellidos']        = $Estudio['evaluado_apellidos'];
            $NewStudios[$Estado][$IdEstudio]['evaluado']['nom_completo']     = cTrim($Estudio['evaluado_nombres']) . ' ' . cTrim($Estudio['evaluado_apellidos']);
            $NewStudios[$Estado][$IdEstudio]['evaluado']['perfil']['id']     = $Estudio['perfil_id']   ;
            $NewStudios[$Estado][$IdEstudio]['evaluado']['perfil']['uuid']   = $Estudio['perfil_uuid']   ;
            $NewStudios[$Estado][$IdEstudio]['evaluado']['perfil']['nombre'] = $Estudio['perfil_nombre']   ;
            $NewStudios[$Estado][$IdEstudio]['alcance']['desde']             = DateFront($Estudio['alcance_desde'], 1);
            $NewStudios[$Estado][$IdEstudio]['alcance']['hasta']             = DateFront($Estudio['alcance_fecha_hasta'], 1);
            $NewStudios[$Estado][$IdEstudio]['alcance']['visible']           = $Estudio['alcance_visible'];
            $NewStudios[$Estado][$IdEstudio]['estado']                       = ['done' => $IsRealizado , 'time' => $StdoTime, 'tag'  => GetEstado ( $IsRealizado ) ];

            if ( $IdTipo == 1 && $IsRealizado ) $NewStudios['participaciones']['p2p'] += 1;
            if ( $IdTipo == 2 && $IsRealizado ) $NewStudios['participaciones']['p2b'] += 1;
        }

        if( $NewStudios['participaciones']['p2p'] || $NewStudios['participaciones']['p2b'] ) $NewStudios['historial'] = 1;

        $NewStudios['pendientes'] = 0;

        if ( !isset($NewStudios['encurso'] )) return $NewStudios;
        foreach ($NewStudios['encurso'] as $key => $Estudio) {
            if ($Estudio['estado']['done'] == 0)  $NewStudios['pendientes'] ++ ;
        }

        return $NewStudios;

    }

?>