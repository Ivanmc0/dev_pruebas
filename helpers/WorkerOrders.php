<?php

    function OrderCumpleanios ( $Colaboradores ) {
        if (!$Colaboradores ) return 0;
        $DiaHoy    = date("d");
        $Ordenados = array();
        usort($Colaboradores , 'OrdenarPorDiaCumple');
        foreach ( $Colaboradores  as $key => $Colaborador){
            $DiaCumple = $Colaborador['complementarios']['dia_cumple'] ;
            $periodo = ( $DiaCumple < $DiaHoy ) ? 'pasados' : (( $DiaCumple == $DiaHoy ) ? 'hoy' : 'proximos');
            $Ordenados[$periodo][$key]['id']          = $Colaborador['id'];
            $Ordenados[$periodo][$key]['nombre']      = $Colaborador['nombre_corto'];
            $Ordenados[$periodo][$key]['cumpleanios'] = $Colaborador['complementarios']['fecha_cumpleanios'];
        }
        return $Ordenados;
    }

    function OrderMyActivities ( $Actividades ) {
        if (!$Actividades  ) return 0;
        $MisActividades = array() ;

        foreach  ($Actividades  as $Actividad   ) {
            $IdActividad                                                            = $Actividad['idactividad'];
            $StdoTime                                                               = StateTime($Actividad['fecha_hasta']);                                                              // 0 (Antes), 1 (Durante), 2 (Después)
            $EstadoRporte                                                           = ($StdoTime==0) ? 'proximo' : (($StdoTime==1) ? 'encurso' : 'finalizado');;
            $Estado                                                                 = ($StdoTime <= 1)  ? 'encurso' : 'finalizado';
            $MisActividades[$Estado][$IdActividad]['id']                            = $IdActividad ;
            $MisActividades[$Estado][$IdActividad]['uuid']                          = $Actividad['uuid_actividad'];
            $MisActividades[$Estado][$IdActividad]['nombre']                        = $Actividad['nomactividad'];
            $MisActividades[$Estado][$IdActividad]['periodo']['desde']              = DateFront($Actividad['fecha_desde']);
            $MisActividades[$Estado][$IdActividad]['periodo']['hasta']              = DateFront($Actividad['fecha_hasta']);
            $MisActividades[$Estado][$IdActividad]['periodo']['visible']            = $Actividad['visible'];
            $MisActividades[$Estado][$IdActividad]['periodo']['estado_asignacion']  = $Estado;
            $MisActividades[$Estado][$IdActividad]['periodo']['estado_reporte']     = $EstadoRporte  ;
            $MisActividades[$Estado][$IdActividad]['categoria']['id']               = $Actividad['id_categ'];
            $MisActividades[$Estado][$IdActividad]['categoria']['uuid']             = $Actividad['uuid_categ'];
            $MisActividades[$Estado][$IdActividad]['categoria']['nombre']           = $Actividad['nombre_categ'];
            $MisActividades[$Estado][$IdActividad]['totales']['dinamicas']          = $Actividad['interactividades'];
            $MisActividades[$Estado][$IdActividad]['totales']['encuestas']          = $Actividad['encuestas'];
            $MisActividades[$Estado][$IdActividad]['totales']['campanias']          = $Actividad['campanas'];
            $MisActividades[$Estado][$IdActividad]['totales']['reconocimientos']    = $Actividad['reconocimientos'];
            $MisActividades[$Estado][$IdActividad]['totales']['encuestas_ok']       = $Actividad['encuestas_ok'];
            $MisActividades[$Estado][$IdActividad]['totales']['reconocimientos_ok'] = $Actividad['reconocimientos_ok'];
            $MisActividades[$Estado][$IdActividad]['totales']['campanias_ok']       = $Actividad['campanas_ok'];
            $MisActividades[$Estado][$IdActividad]['totales']['realizadas']         = $Actividad['campanas_ok']+$Actividad['reconocimientos_ok']+$Actividad['encuestas_ok'];
            $MisActividades[$Estado][$IdActividad]['totales']['pendientes']         = $Actividad['interactividades'] - $MisActividades[$Estado][$IdActividad]['totales']['realizadas'];
            $MisActividades[$Estado][$IdActividad]['totales']['avance']             = $Actividad['interactividades'] > 0 ? $MisActividades[$Estado][$IdActividad]['totales']['realizadas'] / $Actividad['interactividades']*100 : 0;
            $MisActividades[$Estado][$IdActividad]['pendiente'] = 'no';
            if ( $MisActividades[$Estado][$IdActividad]['totales']['pendientes'] > 0) $MisActividades[$Estado][$IdActividad]['pendiente'] = 'si' ;
        }

        $MisActividades['pendientes']=0;
        if ( !isset( $MisActividades['encurso'])) return $MisActividades;
        foreach ($MisActividades['encurso']  as  $item) {
           if ( $item['pendiente'] =='si')  $MisActividades['pendientes'] ++;
       }

        return $MisActividades;
    }

    // All-Todos los reconocimientos
    function OrderMyReconocimientos ( $Reconocimientos ) {
        if ( !$Reconocimientos ) return 0;
        $Rcncmntos = array();
        $Cantidad =0;
        foreach ($Reconocimientos  as $Rcncmiento ) {
            $IdSolucion = $Rcncmiento['soluc_rcncmntos_id'];
            $IdReconoc  = $Rcncmiento['soluc_rcncmntos_id_reconocimiento'];

            $Rcncmntos['reconocimientos'][$IdReconoc]['id']          = $IdReconoc;
            $Rcncmntos['reconocimientos'][$IdReconoc]['uuid']        = $Rcncmiento['rcncmntos_uuid'];
            $Rcncmntos['reconocimientos'][$IdReconoc]['nombre']      = $Rcncmiento['rcncmntos_nombre'];
            $Rcncmntos['reconocimientos'][$IdReconoc]['forma']       = $Rcncmiento['rcncmntos_forma'];
            $Rcncmntos['reconocimientos'][$IdReconoc]['color']       = $Rcncmiento['rcncmntos_color'];
            $Rcncmntos['reconocimientos'][$IdReconoc]['icono']       = $Rcncmiento['rcncmntos_icono'];
            if(!isset($Rcncmntos['reconocimientos'][$IdReconoc]['cantidad'])) $Rcncmntos['reconocimientos'][$IdReconoc]['cantidad'] = 0;
            $Rcncmntos['reconocimientos'][$IdReconoc]['cantidad']    += 1;

            $Rcncmntos['soluciones'][$IdSolucion]['id']                            = $Rcncmiento['soluc_rcncmntos_id'];
            $Rcncmntos['soluciones'][$IdSolucion]['uuid']                          = $Rcncmiento['soluc_rcncmntos_uuid'];
            $Rcncmntos['soluciones'][$IdSolucion]['reconocimiento']['id']          = $Rcncmiento['soluc_rcncmntos_id_reconocimiento'];
            $Rcncmntos['soluciones'][$IdSolucion]['reconocimiento']['uuid']        = $Rcncmiento['rcncmntos_uuid'];
            $Rcncmntos['soluciones'][$IdSolucion]['reconocimiento']['nombre']      = $Rcncmiento['rcncmntos_nombre'];
            $Rcncmntos['soluciones'][$IdSolucion]['reconocimiento']['cantidad']    = $Rcncmiento['total_reconocimientos'];
            $Rcncmntos['soluciones'][$IdSolucion]['reconocimiento']['comentarios'] = $Rcncmiento['soluc_rcncmntos_comentarios'];
            $Rcncmntos['soluciones'][$IdSolucion]['reconocimiento']['forma']       = $Rcncmiento['rcncmntos_forma'];
            $Rcncmntos['soluciones'][$IdSolucion]['reconocimiento']['color']       = $Rcncmiento['rcncmntos_color'];
            $Rcncmntos['soluciones'][$IdSolucion]['reconocimiento']['icono']       = $Rcncmiento['rcncmntos_icono'];

            if ($Cantidad <= 2 ){
                $Rcncmntos['ultimos'][$Cantidad]['id']     = $Rcncmiento['rcncmntos_id'];
                $Rcncmntos['ultimos'][$Cantidad]['uuid']   = $Rcncmiento['rcncmntos_uuid'];
                $Rcncmntos['ultimos'][$Cantidad]['nombre'] = $Rcncmiento['rcncmntos_nombre'];
                $Rcncmntos['ultimos'][$Cantidad]['de']     = FullName ( $Rcncmiento['rcncdor_nombres'], $Rcncmiento['rcncdor_apellidos'] );
                $Rcncmntos['ultimos'][$Cantidad]['fecha']  = DateFront (   $Rcncmiento['soluc_rcncmntos_fecha'] );
                $Rcncmntos['ultimos'][$Cantidad]['color']  = $Rcncmiento['rcncmntos_color'];

                $Cantidad++;
            }
        }
        return $Rcncmntos;
    }

    // 1 reconocimientos
    function OrderMyReconocimiento ( $DataReconocimiento ) {
        if ( !$DataReconocimiento ) return 0;
        $Rcncmnto = array();
        $Cantidad =0;
        foreach ($DataReconocimiento  as $Rcncmiento ) {

            $Nombre                                  = $Rcncmiento['rcncdor_nombres'];
            $Apellido                                = $Rcncmiento['rcncdor_apellidos'];
            $IdSolucion                              = $Rcncmiento['soluc_id'];

            $Rcncmnto['id']                                     = $Rcncmiento['rcncmntos_id'];
            $Rcncmnto['nombre']                                 = $Rcncmiento['rcncmntos_nombre'];
            $Rcncmnto['color']                                  = $Rcncmiento['rcncmntos_color'];
            $Rcncmnto['icono']                                  = $Rcncmiento['rcncmntos_icono'];
            $Rcncmnto['actividad']                              = $Rcncmiento['actividad_nombre'];
            $Rcncmnto['dinamica']                               = $Rcncmiento['dinamica_nombre'];
            $Rcncmnto["soluciones"][$IdSolucion]['id']          = $Rcncmiento['soluc_id'] ;
            $Rcncmnto["soluciones"][$IdSolucion]['reconocedor'] = FullName( $Nombre, $Apellido)  ;
            $Rcncmnto["soluciones"][$IdSolucion]['sigla']       = PrimeraLetra($Nombre).PrimeraLetra($Apellido) ;
            $Rcncmnto["soluciones"][$IdSolucion]['comentario']  = $Rcncmiento['soluc_rcncmntos_comentarios'] ;
            $Rcncmnto["soluciones"][$IdSolucion]['fecha']       = DateFront( $Rcncmiento['soluc_rcncmntos_fecha'] ) ;


        }
        return $Rcncmnto;
    }

    function OrdenarPorDiaCumple($a, $b) {
        return $a['complementarios']['dia_cumple'] - $b['complementarios']['dia_cumple'];
    }

    function OrderValoraciones ( $Valoraciones ) {
        if ( !$Valoraciones ) return 0;
        $OrderVal = array ();
        foreach ( $Valoraciones as $Valoracion ) {
            $IdInvestigacion = $Valoracion['invstgcnes_id'];
            $IdEncuesta      = $Valoracion['encuestas_id'];
            $KeyText = $Valoracion['asgncones_completado'] == 0 ? 'encurso' :'finalizdo';

            $OrderVal[$KeyText]['encuestas'][$IdEncuesta ]['id']                                              = $IdEncuesta ;
            $OrderVal[$KeyText]['encuestas'][$IdEncuesta ]['uuid']                                            = $Valoracion['encuestas_iuuid'] ;
            $OrderVal[$KeyText]['encuestas'][$IdEncuesta ]['nombre']                                          = $Valoracion['encuestas_nombre'] ;
            $OrderVal[$KeyText]['encuestas'][$IdEncuesta ]['descripcion']                                     = $Valoracion['encuestas_descripcion'] ;
            $OrderVal[$KeyText]['encuestas'][$IdEncuesta ]['introduccion']                                    = $Valoracion['encuestas_introduccion'] ;
            $OrderVal[$KeyText]['encuestas'][$IdEncuesta ]['investigacion']['id']                             = $Valoracion['invstgcnes_id']  ;
            $OrderVal[$KeyText]['encuestas'][$IdEncuesta ]['investigacion']['uuid']                           = $Valoracion['invstgcnes_uuid']  ;
            $OrderVal[$KeyText]['encuestas'][$IdEncuesta ]['investigacion']['nombre']                         = $Valoracion['invstgcnes_nombre']  ;
            $OrderVal[$KeyText]['encuestas'][$IdEncuesta ]['investigacion']['evento']['id']                   = $Valoracion['evento_id']  ;
            $OrderVal[$KeyText]['encuestas'][$IdEncuesta ]['investigacion']['evento']['uuid']                 = $Valoracion['evento_uuid']  ;
            $OrderVal[$KeyText]['encuestas'][$IdEncuesta ]['investigacion']['evento']['nombre']               = $Valoracion['evento_nombre']  ;
            $OrderVal[$KeyText]['encuestas'][$IdEncuesta ]['investigacion']['evento']['valoracion']['id']     = $Valoracion['vlrcones_id']  ;
            $OrderVal[$KeyText]['encuestas'][$IdEncuesta ]['investigacion']['evento']['valoracion']['uuid']   = $Valoracion['vlrcones_uuid']  ;
            $OrderVal[$KeyText]['encuestas'][$IdEncuesta ]['investigacion']['evento']['valoracion']['nombre'] = $Valoracion['vlrcones_nombre']  ;
        }

        return $OrderVal ;
    }

    function OrderOKR ( $Proyectos ) {
        if ( !$Proyectos ) return 0;
        $OrderPyt = array ();
        $Asignadas = 0 ;  $Pendiente = 0;  $Finalizado = 0;
        $Asignados = COUNT( $Proyectos  );
        foreach ($Proyectos as $Proyecto ) {
            $IdPyt      = $Proyecto['idproyecto'];
            $KeyTex     = ( strtotime( $Proyecto['fecha_hasta'] ) >= strtotime( FechaHoy() )  ) ? 'encurso' : 'finalizado';
            $StdoDone   = $KeyTex == 'finalizado' ? 1 : 0;
            $StdoTime   = StateTime( $Proyecto['fecha_hasta']);
            $StdoText   = StateTag ( $StdoDone, $StdoTime );
            $Pendiente  = $KeyTex == 'encurso' ? $Pendiente++ : $Pendiente;
            $Finalizado = $KeyTex == 'finalizado' ? $Finalizado++ : $Finalizado;

            $OrderPyt[$KeyTex ][$IdPyt]['id']                      = $IdPyt ;
            $OrderPyt[$KeyTex ][$IdPyt]['uuid']                    = $Proyecto['uuid_proyecto'];
            $OrderPyt[$KeyTex ][$IdPyt]['nombre']                  = $Proyecto['nombre'];
            $OrderPyt[$KeyTex ][$IdPyt]['descripcion']             = $Proyecto['descripcion'];
            $OrderPyt[$KeyTex ][$IdPyt]['responsable']['id']       = $Proyecto['id_responsable'];
            $OrderPyt[$KeyTex ][$IdPyt]['responsable']['uuid']     = $Proyecto['uuid_responsable'];
            $OrderPyt[$KeyTex ][$IdPyt]['responsable']['nombre']   = $Proyecto['nom_responsable'];
            $OrderPyt[$KeyTex ][$IdPyt]['periodo']['desde']        = $Proyecto['fecha_desde'];
            $OrderPyt[$KeyTex ][$IdPyt]['periodo']['fecha_hasta']  = $Proyecto['fecha_desde'];
            $OrderPyt[$KeyTex ][$IdPyt]['periodo']['semana_desde'] = $Proyecto['id_semana_desde'];
            $OrderPyt[$KeyTex ][$IdPyt]['periodo']['semana_hasta'] = $Proyecto['id_semana_hasta'];
            $OrderPyt[$KeyTex ][$IdPyt]['estado']['done']          = $StdoDone;
            $OrderPyt[$KeyTex ][$IdPyt]['estado']['time']          = $StdoTime;
            $OrderPyt[$KeyTex ][$IdPyt]['estado']['tag']           = GetEstado( $StdoText);
 
            $OrderPyt['resumen']['asignados']   = $Asignados;
            $OrderPyt['resumen']['pendientes']  = $Pendiente;
            $OrderPyt['resumen']['finalizados'] = $Finalizado;

        }
        return $OrderPyt;

    }
?>